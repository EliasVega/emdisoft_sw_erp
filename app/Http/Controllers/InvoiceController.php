<?php

namespace App\Http\Controllers;

use App\Helpers\Tickets\Ticket;
use App\Helpers\Pdfs\PdfDocuments;
use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Advance;
use App\Models\ApiResponse;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Card;
use App\Models\CompanyTax;
use App\Models\Configuration;
use App\Models\Customer;
use App\Models\Discrepancy;
use App\Models\Employee;
use App\Models\EmployeeInvoiceProduct;
use App\Models\Environment;
use App\Models\HomeOrder;
use App\Models\InvoiceProduct;
use App\Models\InvoiceResponse;
use App\Models\Ncinvoice;
use App\Models\Ndinvoice;
use App\Models\PaymentForm;
use App\Models\PaymentMethod;
use App\Models\PaymentReturn;
use App\Models\Product;
use App\Models\Resolution;
use App\Models\RestaurantOrder;
use App\Models\Tax;
use App\Models\VoucherType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Traits\InventoryInvoices;
use App\Traits\KardexCreate;
use App\Traits\GetTaxesLine;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Picqer\Barcode\BarcodeGeneratorPNG;

use function App\Helpers\Tickets\formatText;
use function App\Helpers\Tickets\ticketHeight;

class InvoiceController extends Controller
{
    use InventoryInvoices, KardexCreate, GetTaxesLine;
    function __construct()
    {
        $this->middleware('permission:invoice.index|invoice.create|invoice.show|invoice.edit', ['only'=>['index']]);
        $this->middleware('permission:invoice.create', ['only'=>['create','store']]);
        $this->middleware('permission:invoice.show', ['only'=>['show']]);
        $this->middleware('permission:invoice.edit', ['only'=>['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $invoice = '';
        $typeDocument = '';
        if ($request->ajax()) {
            $users = current_user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Muestra todas las compras de la empresa
                $invoices = Invoice::get();
            } else {
                if (indicator()->pos == 'off') {
                    $invoices = Invoice::get();
                } else {
                    //Muestra todas las compras de la empresa por usuario
                    $invoices = Invoice::where('user_id', $users->id)->get();
                }
            }
            return DataTables::of($invoices)
            ->addIndexColumn()
            ->addColumn('customer', function (Invoice $invoice) {
                return $invoice->third->name;
            })
            ->addColumn('state', function (Invoice $invoice) {
                if ($invoice->status == 'invoice') {
                    return $invoice->status == 'invoice' ? 'F. Venta' : 'F. Venta';
                } elseif ($invoice->status == 'debit_note') {
                    return $invoice->status == 'debit_note' ? 'Nota Debito' : 'Nota Debito';
                } elseif ($invoice->status == 'credit_note'){
                    return $invoice->status == 'credit_note' ? 'Nota Credito' : 'Nota Credito';
                }  elseif ($invoice->status == 'complete'){
                    return $invoice->status == 'complete' ? 'NC - ND' : 'NC - ND';
                }
            })
            ->addColumn('btn', 'admin/invoice/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.invoice.index', compact('invoice', 'typeDocument'));
    }

    public function indexInvoice(Request $request)
    {
        $invoice = session('invoice');
        $typeDocument = session('typeDocument');
        if ($request->ajax()) {
            $users = current_user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Muestra todas las compras de la empresa
                $invoices = Invoice::get();
            } else {
                if (indicator()->pos == 'off') {
                    $invoices = Invoice::get();
                } else {
                    //Muestra todas las compras de la empresa por usuario
                    $invoices = Invoice::where('user_id', $users->id)->get();
                }
            }
            return DataTables::of($invoices)
            ->addIndexColumn()
            ->addColumn('customer', function (Invoice $invoice) {
                return $invoice->third->name;
            })
            ->addColumn('status', function (Invoice $invoice) {
                if ($invoice->status == 'invoice') {
                    return $invoice->status == 'invoice' ? 'F. Venta' : 'F. Venta';
                } elseif ($invoice->status == 'debit_note') {
                    return $invoice->status == 'debit_note' ? 'Nota Debito' : 'Nota Debito';
                } elseif ($invoice->status == 'credit_note'){
                    return $invoice->status == 'credit_note' ? 'Nota Credito' : 'Nota Credito';
                }  elseif ($invoice->status == 'complete'){
                    return $invoice->status == 'complete' ? 'NC - ND' : 'NC - ND';
                }
            })
            ->addColumn('btn', 'admin/invoice/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.invoice.index', compact('invoice', 'typeDocument'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pos = indicator()->pos;
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $cols = 10;
        if (indicator()->cvpinvoice == 'off') {
            $cols--;
        }
        if (indicator()->work_labor == 'off') {
            $cols--;
        }
        $customers = Customer::get();
        $employees = Employee::get();
        $resolutions = Resolution::where('document_type_id', 1)->where('branch_id', current_user()->branch_id)->where('status', 'active')->get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::where('status', 'active')->get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $date = Carbon::now();
        if (indicator()->inventory == 'on') {
            $products = BranchProduct::from('branch_products as bp')
            ->join('products as pro', 'bp.product_id', 'pro.id')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.code', 'pro.stock', 'pro.sale_price', 'pro.name', 'per.percentage', 'cat.utility_rate', 'tt.id as tt')
            ->where('bp.branch_id', current_user()->branch_id)
            ->where('bp.stock', '>', 0)
            ->where('pro.status', '=', 'active')
            ->get();
        } else {
            $products = Product::from('products as pro')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.code', 'pro.stock', 'pro.sale_price', 'pro.name', 'cat.utility_rate', 'per.percentage', 'tt.id as tt')
            ->where('pro.status', '=', 'active')
            ->get();
        }
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();
        $type = 'invoice';
        return view('admin.invoice.create',
        compact(
            'customers',
            'employees',
            'resolutions',
            'paymentForms',
            'paymentMethods',
            'banks',
            'cards',
            'branchs',
            'advances',
            'products',
            'date',
            'companyTaxes',
            'cols',
            'type'
        ));
    }

    public function createPos()
    {
        //$pos = indicator()->pos;
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }

        $cols = 10;
        if (indicator()->cvpinvoice == 'off') {
            $cols--;
        }
        if (indicator()->work_labor == 'off') {
            $cols--;
        }
        $customers = Customer::get();
        $employees = Employee::get();
        $resolutions = Resolution::where('document_type_id', 15)->where('branch_id', current_user()->branch_id)->where('status', 'active')->get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::where('status', 'active')->get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $date = Carbon::now();
        if (indicator()->inventory == 'on') {
            $products = BranchProduct::from('branch_products as bp')
            ->join('products as pro', 'bp.product_id', 'pro.id')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.code', 'pro.stock', 'pro.sale_price', 'pro.name', 'per.percentage', 'cat.utility_rate', 'tt.id as tt')
            ->where('bp.branch_id', current_user()->branch_id)
            ->where('bp.stock', '>', 0)
            ->where('pro.status', '=', 'active')
            ->get();
        } else {
            $products = Product::from('products as pro')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.code', 'pro.stock', 'pro.sale_price', 'pro.name', 'cat.utility_rate', 'per.percentage', 'tt.id as tt')
            ->where('pro.status', '=', 'active')
            ->get();
        }
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();
        $type = 'pos';
        return view('admin.invoice.create',
        compact(
            'customers',
            'employees',
            'resolutions',
            'paymentForms',
            'paymentMethods',
            'banks',
            'cards',
            'branchs',
            'advances',
            'products',
            'date',
            'companyTaxes',
            'cols',
            'type'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //dd($request->all());
        set_time_limit(120);
        $totalpayment = $request->totalpay;
        if ($totalpayment == null) {
            toast('No adicionaste ningun tipo de pago.','error');
            return redirect('invoice');
        }

        $configuration = Configuration::findOrFail(company()->id);
        $cashRegister = cashRegisterComprobation();
        $resolutions = '';
        //$resolut = $request->resolution_id;

        $typeDocument = $request->typeDocument;
        $documentType = '';
        $voucherType = '';


        //Metodo si los envios a la dian es si trae resolucion
        //asignacion del vaucher y document type
        if (indicator()->dian == 'on') {
            $resolutions = Resolution::findOrFail($request->resolution_id);
            if ($typeDocument == 'invoice') {
                $voucherType = 1;
                $documentType = 1;
            } else {
                $voucherType = 2;
                $documentType = 15;
            }
        } else {
            if ($typeDocument == 'invoice') {
                $resolutions = Resolution::findOrFail(13);
                $voucherType = 1;
                $documentType = 1;
            } else {
                $resolutions = Resolution::findOrFail(4);
                $voucherType = 24;
                $documentType = 104;
            }
        }
        //dd($voucherType);
        $voucherTypes = VoucherType::findOrFail(24);
        //Variables del request

        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $price = $request->price;
        $tax_rate = $request->tax_rate;
        $branch = current_user()->branch_id;
        $total_pay = $request->total_pay;
        $employee_id = $request->employee_id;
        $paymentForm = $request->payment_form_id;
        $cvp = $request->cv;
        $totalpay = 0;
        $payment = 0;

        if ($typeDocument == 'invoice') {
            $totalpay = $request->totalpay;
        } else {
            $payment = $request->pay;
            if ($payment[0] >= $total_pay) {
                $totalpay = $total_pay;
            } else {
                $totalpay = $payment[0];
            }
        }


        if (isset($employee_id)) {
            $employee_id = $request->employee_id;
        } else {
            $employee_id = "null";
        }

        $retention = 0;
        //variables del request
        $quantityBag = $request->bags;
        if ($request->total_retention != null) {
            $retention = $request->total_retention;
        }

        //$documentType = $request->document_type_id;
        $service = '';
        $errorMessages = '';
        $store = false;
        if (indicator()->dian == 'on') {
            if ($typeDocument == 'invoice') {
                $data = invoiceData($request);
                $environment = Environment::where('id', 11)->first();
                $url = $environment->protocol . $configuration->ip . $environment->url;
            } else {
                $data = equiDocPosData($request);
                $environment = Environment::where('id', 21)->first();
                $url = $environment->protocol . $configuration->ip . $environment->url;
            }
            dd($data);
            $requestResponse = sendDocuments($url, $data);
            //dd($requestResponse);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
            $responseApi = json_encode($service);

            $apiResponse = new ApiResponse();
            $apiResponse->document = $resolutions->prefix . $resolutions->consecutive;
            $apiResponse->response_api = $responseApi;
            $apiResponse->save();
        } else {
            $store = true;
        }
        //dd($service);
        //Crea un registro de Ventas
        if ($store == true) {

            $invoice = new Invoice();
            $invoice->user_id = current_user()->id;
            $invoice->branch_id = current_user()->branch_id;
            $invoice->customer_id = $request->customer_id;
            $invoice->payment_form_id = $request->payment_form_id;
            $invoice->payment_method_id = $request->payment_method_id[0];
            $invoice->resolution_id = $resolutions->id;
            $invoice->document_type_id = $documentType;
            $invoice->document = $resolutions->prefix . $resolutions->consecutive;
            $invoice->voucher_type_id = $voucherType;
            $invoice->cash_register_id = $cashRegister->id;
            $invoice->status = 'invoice';
            $invoice->note = $request->note;
            $invoice->generation_date = $request->generation_date;
            $invoice->due_date = $request->due_date;
            $invoice->retention = $retention;
            $invoice->total = $request->total;
            $invoice->total_tax = $request->total_tax;
            $invoice->total_pay = $total_pay;
            $invoice->pay = $totalpay;
            if ($typeDocument == 'invoice') {
                $invoice->balance = $total_pay - $totalpay;
            } else {
                if ($paymentForm == 1) {
                    if ($total_pay >= $payment) {
                        $invoice->balance = $total_pay - $payment;
                    } else {
                        $invoice->balance = 0;
                    }
                } else {
                    $invoice->balance = $total_pay;
                }
            }
            $invoice->grand_total = $total_pay - $retention;
            $invoice->save();



            $voucherTypes->consecutive += 1;
            $voucherTypes->update();

            if (indicator()->pos == 'on') {
                //actualizar la caja
                    $cashRegister->invoice += $total_pay;
                    $cashRegister->update();
            }
            $document = $invoice;
            //Ingresa los productos que vienen en el array
            for ($i=0; $i < count($product_id); $i++) {
                $id = $product_id[$i];
                //Metodo para registrar la relacion entre producto y compra
                $invoiceProduct = new InvoiceProduct();
                $invoiceProduct->invoice_id = $invoice->id;
                $invoiceProduct->product_id = $id;
                $invoiceProduct->quantity = $quantity[$i];
                $invoiceProduct->price = $price[$i];
                $invoiceProduct->tax_rate = $tax_rate[$i];
                $invoiceProduct->subtotal = $quantity[$i] * $price[$i];
                $invoiceProduct->tax_subtotal =($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                $invoiceProduct->save();

                //selecciona el producto que viene del array
                $product = Product::findOrFail($id);

                if (indicator()->cvpinvoice == 'on' && $cvp[$i] == 1) {
                    $product->sale_price = $price[$i];
                    $product->update();
                }
                //selecciona el producto de la sucursal que sea el mismo del array
                $branchProducts = BranchProduct::where('product_id', '=', $id)
                ->where('branch_id', '=', $branch)
                ->first();

                $quantityLocal = $quantity[$i];
                $this->inventoryInvoices($product, $branchProducts, $quantityLocal, $branch);//trait para actualizar inventario
                $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex

                if (indicator()->work_labor == 'on') {
                    //metodo para comisiones de empleados
                    if ($employee_id[$i] != "null") {
                        $employee = Employee::findOrFail($employee_id[$i]);
                        $subtotal = $quantity[$i] * $price[$i];
                        if (indicator()->cmep == 'employee') {
                            $commission = $employee->commission;
                        } else {
                            $commission = $product->commission;
                        }
                        $valueCommission = ($subtotal/100) * $commission;

                        $employeeInvoiceProduct = new EmployeeInvoiceProduct();
                        $employeeInvoiceProduct->invoice_product_id = $invoiceProduct->id;
                        $employeeInvoiceProduct->employee_id = $employee_id[$i];
                        $employeeInvoiceProduct->generation_date = $request->generation_date;
                        $employeeInvoiceProduct->quantity = $quantity[$i];
                        $employeeInvoiceProduct->price = $price[$i];
                        $employeeInvoiceProduct->subtotal = $subtotal;
                        $employeeInvoiceProduct->commission = $commission;
                        $employeeInvoiceProduct->value_commission =$valueCommission;
                        $employeeInvoiceProduct->status = 'pendient';
                        $employeeInvoiceProduct->save();
                    }
                }
            }

            $taxes = $this->getTaxesLine($request);//selecciona el impuesto que tiene la categoria IVA o INC
            taxesGlobals($document, $quantityBag, $typeDocument);
            taxesLines($document, $taxes, $typeDocument);
            retentions($request, $document, $typeDocument);


                if ($typeDocument == 'pos') {
                    $return = 0;
                    if ($totalpay > 0) {
                        $return = $payment[0] - $totalpay;
                        /*
                        $paymentMethod = $request->payment_method_id;
                        $bank = 1;
                        $card = 1;
                        $advance_id = null;
                        $payment = $request->pay;
                        $transaction = 00;
                        $payAdvance = 0;
                        $return = $payment[0] - $totalpay;
                            //Metodo para crear un nuevo pago y su realcion polimorfica dependiendo del tipo de documento
                        $pay = new Pay();
                        $pay->user_id = current_user()->id;
                        $pay->branch_id = current_user()->branch_id;
                        $pay->pay = $totalpay;
                        $pay->balance = $document->balance;
                        $pay->type = 'invoice';

                        $invoice = $document;
                        $invoice->pays()->save($pay);

                        //Metodo para registrar la relacion entre pago y metodo de pago
                        $pay_paymentMethod = new PayPaymentMethod();
                        $pay_paymentMethod->pay_id = $pay->id;
                        $pay_paymentMethod->payment_method_id = $paymentMethod;
                        $pay_paymentMethod->bank_id = $bank;
                        $pay_paymentMethod->card_id = $card;
                        $pay_paymentMethod->pay = $payment[0];
                        $pay_paymentMethod->transaction = $transaction;
                        $pay_paymentMethod->save();
                        */
                        pays($request, $document, $typeDocument);
                        if (indicator()->pos == 'on') {
                            //metodo para actualizar la caja
                            $cashRegister->in_invoice_cash += $totalpay;
                            $cashRegister->cash_in_total += $totalpay;

                            $cashRegister->in_invoice += $totalpay;
                            $cashRegister->in_total += $totalpay;
                            $cashRegister->update();
                        }
                    }

                    $paymentReturn = new PaymentReturn();
                    $paymentReturn->payment = $request->pay[0];
                    $paymentReturn->return = $return;
                    $paymentReturn->invoice_id = $invoice->id;
                    $paymentReturn->save();
                } else {
                    if ($totalpay > 0) {
                        pays($request, $document, $typeDocument);
                    }
                }

            $resolutions->consecutive += 1;
                $resolutions->update();

            if (indicator()->dian == 'on') {
                $valid = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['IsValid'];
                $code = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusCode'];
                $description = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusDescription'];
                $statusMessage = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusMessage'];
                $resolutionleft = $service['resolution_days_left'];

                $invoiceResponse = new InvoiceResponse();
                $invoiceResponse->invoice_id = $invoice->id;
                $invoiceResponse->document = $invoice->document;
                $invoiceResponse->message = $service['message'];
                $invoiceResponse->valid = $valid;
                $invoiceResponse->code = $code;
                $invoiceResponse->description = $description;
                $invoiceResponse->status_message = $statusMessage;
                $invoiceResponse->cufe = $service['cufe'];
                $invoiceResponse->response_api = null;
                $invoiceResponse->save();

                $environmentPdf = Environment::findOrFail(10);
                $urlpdf = $environmentPdf->protocol . $configuration->ip . $environmentPdf->url;

                if ($typeDocument == 'invoice') {
                    $pdf = file_get_contents($urlpdf . company()->nit ."/FES-" . $invoice->document .".pdf");
                    Storage::disk('public')->put('files/graphical_representations/invoices/' .
                    $invoice->document . '.pdf', $pdf);

                }/* else if ($typeDocument == 'pos') {
                    $pdf = file_get_contents($urlpdf . company()->nit ."/POSS-" . $invoice->document .".pdf");
                    Storage::disk('public')->put('files/graphical_representations/invoices/' .
                    $invoice->document . '.pdf', $pdf);
                }*/

                $environmentXml = Environment::findOrFail(23);
                $urlxmldocument = "Attachment-" . $invoice->document . ".xml/BASE64";
                $urlxml = $environmentXml->protocol . $configuration->ip . $environmentXml->url . company()->nit . $urlxmldocument;
                $xml = file_get_contents($urlxml);

                Storage::disk('public')->put('files/graphical_representations/xmlinvoices/' .
                $invoice->document . '.xml', $xml);
            }
            session()->forget('invoice');
            session()->forget('typeDocument');
            session(['invoice' => $invoice->id]);
            session(['typeDocument' => $typeDocument]);
            toast('Venta Registrada satisfactoriamente.','success');
            return redirect('invoice');
        }
        toast($errorMessages,'danger');
        return redirect('indexInvoice');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $voucher = VoucherType::findOrFail(1);
        $debitNotes = Ndinvoice::where('invoice_id', $invoice->id)->first();
        $creditNotes = Ncinvoice::where('invoice_id', $invoice->id)->first();
        $taxLines = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'invoice')
        ->where('tax.taxable_id', $invoice->id)
        ->where('tt.type_tax', 'tax_item')->get();
        $taxLinesum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'invoice')
        ->where('tax.taxable_id', $invoice->id)
        ->where('tt.type_tax', 'tax_item')->sum('tax_value');
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'invoice')
        ->where('tax.taxable_id', $invoice->id)
        ->where('tt.type_tax', 'retention')->get();
        $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'invoice')
        ->where('tax.taxable_id', $invoice->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        //$retention = 0;
        $debitNote = 0;
        $creditNote = 0;
        $retentionnd = 0;
        $retentionnc = 0;
        if ($debitNotes != null) {
            $debitNote = $debitNotes->total_pay;
            $retnd = Tax::from('taxes as tax')
            ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('tax.tax_value', 'ct.name')
            ->where('tax.type', 'ndinvoice')
            ->where('tax.taxable_id', $debitNotes->id)
            ->where('tt.type_tax', 'retention')
            ->sum('tax_value');
            //$retnd = Retention::where('type', 'ndinvoice')->where('retentionable_id', $debitNotes->id)->first();
            if ($retnd) {
                $retentionnd = $retnd;
            } else {
                $retentionnd = 0;
            }
        }
        if ($creditNotes != null) {
            $creditNote = $creditNotes->total_pay;
            //$retnc = Retention::where('type', 'ncinvoice')->where('retentionable_id', $creditNotes->id)->first();
            $retnc = Tax::from('taxes as tax')
            ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('tax.tax_value', 'ct.name')
            ->where('tax.type', 'ncinvoice')
            ->where('tax.taxable_id', $creditNotes->id)
            ->where('tt.type_tax', 'retention')
            ->sum('tax_value');

            if ($retnc) {
                $retentionnc = $retnc;
            } else {
                $retentionnc = 0;
            }
        }

        $invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->where('quantity', '>', 0)->get();
        return view('admin.invoice.show', compact(
            'invoice',
            'debitNotes',
            'creditNotes',
            'debitNote',
            'creditNote',
            'retentionnd',
            'retentionnc',
            'taxLines',
            'taxLinesum',
            'retentions',
            'retentionsum',
            'invoiceProducts',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $cashRegister = cashRegisterComprobation();
        $customers = Customer::get();
        $employees = Employee::get();
        $branchs = Branch::get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $date = Carbon::now();
        if (indicator()->inventory == 'on') {
            $products = BranchProduct::from('branch_products as bp')
            ->join('products as pro', 'bp.product_id', 'pro.id')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.code', 'pro.stock', 'pro.sale_price', 'pro.name', 'per.percentage', 'tt.id as tt')
            ->where('bp.branch_id', current_user()->branch_id)
            ->where('bp.stock', '>=', 0)
            ->where('pro.status', '=', 'active')
            ->get();
        } else {
            $products = Product::where('status', 'active')->get();
        }
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();

        $iops = InvoiceProduct::from('invoice_products as ip')
        ->join('products as pro', 'ip.product_id', 'pro.id')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('ip.id', 'ip.quantity', 'ip.price', 'ip.tax_rate', 'pro.id as idP', 'pro.stock', 'pro.name', 'per.percentage', 'tt.id as tt')
        ->where('ip.invoice_id', $invoice->id)
        ->get();

        $invoiceProducts = [];

        for ($i=0; $i < count($iops); $i++) {
            $eiop = EmployeeInvoiceProduct::where('invoice_product_id', $iops[$i]->id)->first();

            if (is_null($eiop)) {
                //$ioparray = Arr::add($iops[$i], 'employee', 'null');
                $invoiceProducts[$i] = Arr::add($iops[$i], 'employee', 'null');
                $invoiceProducts[$i] = Arr::add($iops[$i], 'employeeName', 'null');
            } else {
                $invoiceProducts[$i] = Arr::add($iops[$i], 'employee', $eiop->employee_id);
                $invoiceProducts[$i] = Arr::add($iops[$i], 'employeeName', $eiop->employee->name);
            }

        }
        return view('admin.invoice.edit',
        compact(
            'invoice',
            'customers',
            'employees',
            'date',
            'invoiceProducts'
        ));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //dd($request->all());
        $employee_id = $request->employee_id;
        $quantity = $request->quantity;
        $price = $request->price;
        $invoiceProduct = InvoiceProduct::where('invoice_id', $invoice->id)->get();
        for ($i=0; $i < count($invoiceProduct); $i++) {

            $employeeInvoiceProduct = EmployeeInvoiceProduct::where('invoice_product_id', $invoiceProduct[$i]->id)->first();

            $subtotal = $invoiceProduct[$i]->subtotal;
            if ($employee_id[$i] != "null") {
                $id = $employee_id[$i];
                $employee = Employee::findOrFail($id);
                $commission = $employee->commission;
                $valueCommission = ($subtotal/100) * $commission;
                if (isset($employeeInvoiceProduct)) {
                    $employeeInvoiceProduct->commission = $commission;
                    $employeeInvoiceProduct->value_commission = $valueCommission;
                    $employeeInvoiceProduct->employee_id = $id;
                    $employeeInvoiceProduct->update();
                } else {
                    $employeeInvoiceProduct = new EmployeeInvoiceProduct();
                    $employeeInvoiceProduct->invoice_product_id = $invoiceProduct[$i]->id;
                    $employeeInvoiceProduct->employee_id = $id;
                    $employeeInvoiceProduct->generation_date = $request->generation_date;
                    $employeeInvoiceProduct->quantity = $quantity[$i];
                    $employeeInvoiceProduct->price = $price[$i];
                    $employeeInvoiceProduct->subtotal = $subtotal;
                    $employeeInvoiceProduct->commission = $commission;
                    $employeeInvoiceProduct->value_commission =$valueCommission;
                    $employeeInvoiceProduct->status = 'pendient';
                    $employeeInvoiceProduct->save();

                }

            } else {
                if (isset($employeeInvoiceProduct)) {
                    $employeeInvoiceProduct->quantity = 0;
                    $employeeInvoiceProduct->price = 0;
                    $employeeInvoiceProduct->subtotal = 0;
                    $employeeInvoiceProduct->commission = 0;
                    $employeeInvoiceProduct->value_commission = 0;
                    $employeeInvoiceProduct->status = 'canceled';
                    $employeeInvoiceProduct->update();
                }

            }
        }
        toast('Operario Actualizado satisfactoriamente.','success');
            return redirect('invoice');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function debitNote($id)
    {
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $invoice = Invoice::findOrFail($id);
        $products = Product::where('status', 'active')->where('type_product', 'service')->get();
        $discrepancies = Discrepancy::where('id', '>', 6)->where('description', '!=', 'Otros')->get();
        $resolutions = Resolution::where('document_type_id', 26)->where('status', 'active')->where('branch_id', current_user()->branch_id)->get();
        $taxes = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'ct.tax_type_id', 'tax.tax_value', 'per.percentage', 'per.base')
        ->where('tax.type', 'invoice')
        ->where('tt.type_tax', 'retention')
        ->where('tax.taxable_id', $id)
        ->get();
        $invoiceProducts = InvoiceProduct::from('invoice_products as ip')
        ->join('products as pro', 'ip.product_id', 'pro.id')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('ip.id', 'pro.id as idP', 'pro.name', 'pro.stock', 'ip.quantity', 'ip.price', 'ip.tax_rate', 'ip.subtotal', 'tt.id as idtt', 'tt.name as namett')
        ->where('invoice_id', $id)
        ->get();
        if ($invoice->status == 'complete' || $invoice->status == 'adjustment_note') {
            return redirect("invoice")->with('warning', 'Esta Compra ya no se puede hacer notas');
        }
        return view('admin.ndinvoice.create', compact(
            'invoice',
            'products',
            'invoiceProducts',
            'discrepancies',
            'resolutions',
            'taxes'
        ));
    }

    public function creditNote($id)
    {
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $invoice = Invoice::where('id', $id)->first();
        //$invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->get();
        if (indicator()->inventory == 'on') {
            $products = Product::where('status', 'active')->where('stock', '>', 0)->get();
        } else {
            $products = Product::where('status', 'active')->get();
        }
        if ($invoice->document_type_id == 11) {
            $discrepancies = Discrepancy::where('id', 2)->get();
        } else {
            $discrepancies = Discrepancy::where('id', '<', 5)->where('description', '!=', 'Otros')->get();
        }
        $resolutions = Resolution::where('document_type_id', 4)->where('status', 'active')->where('branch_id', current_user()->branch_id)->get();
        $taxes = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'ct.tax_type_id', 'tax.tax_value', 'per.percentage', 'per.base')
        ->where('tax.type', 'invoice')
        ->where('tt.type_tax', 'retention')
        ->where('tax.taxable_id', $id)
        ->get();
        $invoiceProducts = InvoiceProduct::from('invoice_products as ip')
         ->join('products as pro', 'ip.product_id', 'pro.id')
         ->join('categories as cat', 'pro.category_id', 'cat.id')
         ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
         ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
         ->select('ip.id', 'pro.id as idP', 'pro.name', 'pro.stock', 'ip.quantity', 'ip.price', 'ip.tax_rate', 'ip.subtotal', 'tt.id as idtt', 'tt.name as namett')
         ->where('invoice_id', $id)
         ->get();
         if ($invoice->status == 'complete' || $invoice->status == 'adjustment_note') {
            return redirect("invoice")->with('warning', 'Esta Compra ya no se puede hacer notas');
        }
        return view('admin.ncinvoice.create', compact(
            'invoice',
            'products',
            'invoiceProducts',
            'discrepancies',
            'resolutions',
            'taxes'
        ));
    }

    public function invoicePay($id)
    {
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $document = Invoice::findOrFail($id);
        $banks = Bank::get();
        $paymentMethods = PaymentMethod::get();
        $cards = Card::get();
        $advances = Advance::where('status', '!=', 'applied')->where('advanceable_id', $document->third->id)->get();
        $tipeDocument = 'invoice';

        return view('admin.pay.create', compact(
            'document',
            'banks',
            'paymentMethods',
            'cards',
            'advances',
            'tipeDocument'
        ));
    }

    public function invoicePdf(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->where('quantity', '>', 0)->get();
        $debitNotes = Ndinvoice::where('invoice_id', $id)->first();
        $creditNotes = Ncinvoice::where('invoice_id', $id)->first();
        $days = $invoice->created_at->diffInDays($invoice->due_date);
        $invoicepdf = $invoice->document;
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'invoice')
        ->where('tax.taxable_id', $invoice->id)
        ->where('tt.type_tax', 'retention')->get();
        $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'invoice')
        ->where('tax.taxable_id', $invoice->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        //$retention = 0;
        $debitNote = 0;
        $creditNote = 0;
        $retentionnd = 0;
        $retentionnc = 0;
        if ($debitNotes != null) {
            $debitNote = $debitNotes->total_pay;
            $retnd = Tax::from('taxes as tax')
            ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('tax.tax_value', 'ct.name')
            ->where('tax.type', 'ndinvoice')
            ->where('tax.taxable_id', $debitNotes->id)
            ->where('tt.type_tax', 'retention')
            ->sum('tax_value');
            if ($retnd) {
                $retentionnd = $retnd;
            } else {
                $retentionnd = 0;
            }
        }
        if ($creditNotes != null) {
            $creditNote = $creditNotes->total_pay;
            $retnc = Tax::from('taxes as tax')
            ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('tax.tax_value', 'ct.name')
            ->where('tax.type', 'ncinvoice')
            ->where('tax.taxable_id', $creditNotes->id)
            ->where('tt.type_tax', 'retention')
            ->sum('tax_value');

            if ($retnc) {
                $retentionnc = $retnc;
            } else {
                $retentionnc = 0;
            }
        }
        $view = \view('admin.invoice.pdf', compact(
            'invoice',
            'days',
            'invoiceProducts',
            'debitNotes',
            'creditNotes',
            'retentions',
            'retentionsum',
            'debitNote',
            'creditNote',
            'retentionnd',
            'retentionnc'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$invoicepdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");*/
    }

    public function invoicePos($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->where('quantity', '>', 0)->get();
        if (indicator()->restaurant == 'on') {
            $restaurantOrder = RestaurantOrder::where('invoice_id', $invoice->id)->first();
            $homeOrder = HomeOrder::where('restaurant_order_id', $restaurantOrder->id)->first();
        } else {
            $restaurantOrder = null;
            $homeOrder = null;
        }
        $debitNotes = Ndinvoice::where('invoice_id', $id)->first();
        $creditNotes = Ncinvoice::where('invoice_id', $id)->first();
        $days = $invoice->created_at->diffInDays($invoice->due_date);
        $invoicepdf = $invoice->document;
        $user = current_user()->name;
        $retention = Tax::where('type', 'invoice')->where('taxable_id', $invoice->id)->get();
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'invoice')
        ->where('tax.taxable_id', $invoice->id)
        ->where('tt.type_tax', 'retention')->get();
        $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'invoice')
        ->where('tax.taxable_id', $invoice->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');
        $paymentReturns = PaymentReturn::where('invoice_id', $invoice->id)->first();

        $debitNote = 0;
        $creditNote = 0;
        $retentionnd = 0;
        $retentionnc = 0;
        if ($debitNotes != null) {
            $debitNote = $debitNotes->total_pay;
            $retnd = Tax::where('type', 'ndinvoice')->where('retentionable_id', $debitNotes->id)->first();
            $retentionnd = $retnd->retention;
        }
        if ($creditNotes != null) {
            $creditNote = $creditNotes->total_pay;
            $retnc = Tax::where('type', 'ncinvoice')->where('retentionable_id', $creditNotes->id)->first();
            $retentionnc = $retnc->retention;
        }
        $view = \view('admin.invoice.pos', compact(
            'invoice',
            'restaurantOrder',
            'homeOrder',
            'days',
            'invoiceProducts',
            'debitNotes',
            'creditNotes',
            'retentions',
            'retentionsum',
            'debitNote',
            'creditNote',
            'retentionnd',
            'retentionnc',
            'paymentReturns',
            'user'
        ))->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            //$pdf->setPaper('b7', 'portrait');
            $pdf->setPaper (array(0,0,297.64,1246.53), 'portrait');
            return $pdf->stream('vista-pdf', "$invoicepdf.pdf");
    }

    public function posInvoice(Request $request)
    {
        $invoices = session('invoice');
        $invoice = Invoice::findOrFail($invoices);
        $request->session()->forget('invoice');
        //session()->forget('invoice');
        if (indicator()->restaurant == 'on') {
            $restaurantOrder = RestaurantOrder::where('invoice_id', $invoice->id)->first();
            $homeOrder = HomeOrder::where('restaurant_order_id', $restaurantOrder->id)->first();
        } else {
            $restaurantOrder = null;
            $homeOrder = null;
        }
        $invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->where('quantity', '>', 0)->get();
        $user = current_user()->name;
        $debitNotes = Ndinvoice::where('invoice_id', $invoice->id)->first();
        $creditNotes = Ncinvoice::where('invoice_id', $invoice->id)->first();
        $days = $invoice->created_at->diffInDays($invoice->due_date);
        $invoicepdf = $invoice->document;
        //$retention = Tax::where('type', 'invoice')->where('taxable_id', $invoice->id)->get();
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'invoice')
        ->where('tax.taxable_id', $invoice->id)
        ->where('tt.type_tax', 'retention')->get();
        $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'invoice')
        ->where('tax.taxable_id', $invoice->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        $paymentReturns = PaymentReturn::where('invoice_id', $invoice->id)->first();

        $debitNote = 0;
        $creditNote = 0;
        $retentionnd = 0;
        $retentionnc = 0;
        if ($debitNotes != null) {
            $debitNote = $debitNotes->total_pay;
            $retnd = Tax::where('type', 'ndinvoice')->where('retentionable_id', $debitNotes->id)->first();
            $retentionnd = $retnd->retention;
        }
        if ($creditNotes != null) {
            $creditNote = $creditNotes->total_pay;
            $retnc = Tax::where('type', 'ncinvoice')->where('retentionable_id', $creditNotes->id)->first();
            $retentionnc = $retnc->retention;
        }
        $view = \view('admin.invoice.pos', compact(
            'invoice',
            'homeOrder',
            'days',
            'invoiceProducts',
            'restaurantOrder',
            'debitNotes',
            'creditNotes',
            'retentions',
            'retentionsum',
            'debitNote',
            'creditNote',
            'retentionnd',
            'retentionnc',
            'paymentReturns',
            'user'
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,297.64,1246.53), 'portrait');
        //$pdf->setPaper('b7', 'portrait');
        return $pdf->stream('vista-pdf', "$invoicepdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");
    }

    public function getProductInvoice(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::from('products as pro')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.name', 'pro.stock', 'pro.sale_price', 'per.percentage', 'tt.id as tt')
            ->where('pro.code', $request->code)
            ->first();
            if ($products) {
                return response()->json($products);
            }
        }
    }

    public function posPdf(Request $request, Invoice $invoice)
    {
        //Session::forget('newPrinter');
        $document = $invoice;
        $typeDocument = 'invoice';
        $title = '';
        $consecutive = $document->document;
        if ($invoice->document_type_id == 1) {
            $title = 'FACTURA ELECTRONICA DE VENTA';
        } else {
            $title = 'DOCUMENTO EQUIVALENTE ELECTRONICO DEL TIQUETE DE MAQUINA REGISTRADORA CON SISTEMA P.O.S.';
        }

        $thirdPartyType = 'customer';
        $logoHeight = 26;

        if (indicator()->logo == 'on') {
            $logo = storage_path('app/public/images/logos/' . company()->imageName);

            $image = list($width, $height, $type, $attr) = getimagesize($logo);
            $multiplier = $image[0]/$image[1];
            $height = 26;
            $width = $height * $multiplier;
            if ($width > 60) {
                $width = 60;
                $height = 60/$multiplier;
            }
        }

        $pdfHeight = ticketHeight($logoHeight, company(), $document, $typeDocument);

        $pdf = new Ticket('P', 'mm', array(70, $pdfHeight), true, 'UTF-8');
        $pdf->SetMargins(2, 10, 2);
        $pdf->SetTitle($invoice->document);
        $pdf->SetAutoPageBreak(false);
        $pdf->addPage();



        if (indicator()->logo == 'on') {
            if (file_exists($logo)) {
                $pdf->generateLogo($logo, $width, $height);
            }
        }
        $pdf->generateTitle($title, $consecutive);
        $pdf->generateCompanyInformation();

        $barcodeGenerator = new BarcodeGeneratorPNG();
        $barcodeCode = $barcodeGenerator->getBarcode($invoice->id, $barcodeGenerator::TYPE_CODE_128);
        $barcode = "data:image/png;base64," . base64_encode($barcodeCode);

        $pdf->generateBarcode($barcode);
        $pdf->generateBranchInformation($document);
        $pdf->generateThirdPartyInformation($invoice->third, $thirdPartyType);
        $pdf->generateProductsTable($document, $typeDocument);
        $pdf->generateSummaryInformation($document, $typeDocument);


        if (indicator()->dian == 'on') {
            $pdf->generateInvoiceInformation($document);
            $cufe =  $invoice->invoiceResponse->cufe;
            //$cufe =  '9e414128ba184d66d5d2e2ea3225191ad50ba84bf64224c5090f4f26f0501e317c94a86a14e84905bf34619273c4f5a4';
            $url = 'https://catalogo-vpfe.dian.gov.co/document/searchqr?documentkey=';
            $data = [
                'NumFac' => $invoice->document,
                'FecFac' => $invoice->created_at->format('Y-m-d'),
                'NitFac' => company()->nit,
                'DocAdq' => $invoice->third->identification,
                'ValFac' => $invoice->total,
                'ValIva' => $invoice->total_tax,
                'ValOtroIm' => '0.00',
                'ValTotal' => $invoice->total_pay,
                'CUFE' => $cufe,
                'URL' => $url . $cufe,
            ];

            $writer = new PngWriter();
            $qrCode = new QrCode(implode("\n", $data));
            $qrCode->setSize(300);
            $qrCode->setMargin(10);
            $result = $writer->write($qrCode);

            $qrCodeImage = $result->getString();
            $qrImage = "data:image/png;base64," . base64_encode($qrCodeImage);
            $pdf->generateQr($qrImage);

            //$confirmationCode = formatText("CUFE: " . $invoice->response->cufe);
            $confirmationCode = formatText("CUFE: " . $cufe);
            //$confirmationCode = formatText("CUFE: " . $invoice->invoiceResponse->cufe);
            $pdf->generateConfirmationCode($confirmationCode);
        }


        $refund = formatText("*** Para realizar un reclamo o devolución debe de presentar este ticket ***");
        $pdf->generateDisclaimerInformation($refund);

        $pdf->footer();

        $pdf->Output("I", $invoice->document . ".pdf", true);
        exit;
    }

    public function pdfInvoice(Request $request, Invoice $invoice) {
        //Session::forget('newPrinter');
        $typeDocument = 'invoice';
        $title = '';
        if ($invoice->document_type_id == 1) {
            $title = 'FACTURA DE VENTA';
            //$title = 'DOCUMENTO EQUIVALENTE ELECTRONICO DEL TIQUETE DE MAQUINA REGISTRADORA CON SISTEMA P.O.S.';
        } else {
            $title = 'DOCUMENTO EQUIVALENTE ELECTRONICO DEL TIQUETE DE MAQUINA REGISTRADORA CON SISTEMA P.O.S.';
        }


        $document = $invoice;
        $thirdPartyType = 'customer';
        $logoHeight = 26;
        $logo = '';
        $width = 0;
        $height = 0;
        if (indicator()->logo == 'on') {
            $logo = storage_path('app/public/images/logos/' . company()->imageName);

            $image = list($width, $height, $type, $attr) = getimagesize($logo);
            $multiplier = $image[0]/$image[1];
            $height = 26;
            $width = $height * $multiplier;
            if ($width > 60) {
                $width = 60;
                $height = 60/$multiplier;
            }
        }

        //$pdfHeight = ticketHeight($logoHeight, company(), $invoice, "invoice");

        $pdf = new PdfDocuments('P', 'mm', 'Letter', true, 'UTF-8');
        $pdf->SetMargins(10, 10, 6);
        $pdf->SetTitle($document->document);
        $pdf->SetAutoPageBreak(false);
        $pdf->addPage();

        if (indicator()->dian == 'on') {
            //$pdf->generateInvoiceInformation($document);
            $cufe =  $document->invoiceResponse->cufe;
            $url = 'https://catalogo-vpfe.dian.gov.co/document/searchqr?documentkey=';
            $data = [
                'NumFac' => $document->document,
                'FecFac' => $document->created_at->format('Y-m-d'),
                'NitFac' => company()->nit,
                'DocAdq' => $document->third->identification,
                'ValFac' => $document->total,
                'ValIva' => $document->total_tax,
                'ValOtroIm' => '0.00',
                'ValTotal' => $document->total_pay,
                'CUFE' => $cufe,
                'URL' => $url . $cufe,
            ];

            $writer = new PngWriter();
            $qrCode = new QrCode(implode("\n", $data));
            $qrCode->setSize(300);
            $qrCode->setMargin(10);
            $result = $writer->write($qrCode);

            $qrCodeImage = $result->getString();
            $qrImage = "data:image/png;base64," . base64_encode($qrCodeImage);
            //$pdf->generateQr($qrImage);

            //$confirmationCode = formatText("CUFE: " . $invoice->response->cufe);
            //$confirmationCode = formatText("CUFE: " . $invoice->invoiceResponse->cufe);
            //$confirmationCode = formatText("CUFE: " . $invoice->invoiceResponse->cufe);
            //$pdf->generateConfirmationCode($confirmationCode);
        } else {
            //$pdf->generateInvoiceInformation($document);
            $cufe =  '00';
            $url = '#';
            $data = [
                'NumFac' => $document->document,
                'FecFac' => $document->created_at->format('Y-m-d'),
                'NitFac' => company()->nit,
                'DocAdq' => $document->third->identification,
                'ValFac' => $document->total,
                'ValIva' => $document->total_tax,
                'ValOtroIm' => '0.00',
                'ValTotal' => $document->total_pay,
                'CUFE' => $cufe,
                //'URL' => $url . $cufe,
            ];

            $writer = new PngWriter();
            $qrCode = new QrCode(implode("\n", $data));
            $qrCode->setSize(300);
            $qrCode->setMargin(10);
            $result = $writer->write($qrCode);

            $qrCodeImage = $result->getString();
            $qrImage = "data:image/png;base64," . base64_encode($qrCodeImage);
            //$pdf->generateQr($qrImage);
        }

        $pdf->generateHeader($logo, $width, $height, $title, $document);
        $pdf->generateInformation($document->third, $thirdPartyType, $document, $qrImage);
        $pdf->generateTablePdf($document, $typeDocument);
        $pdf->generateTotals($document, $typeDocument);


        $pdf->footer($document, $cufe);
        $pdf->documentInformation($document, $cufe);
        $pdf->footer();
        //$pdf->generateHeader($logo, $width, $height);
        //$refund = formatText("*** Para realizar un reclamo o devolución debe de presentar este ticket ***");
        //$pdf->generateDisclaimerInformation($refund);

        $pdf->Output("I", $document->document . ".pdf", true);
        exit;
    }

    public function getAdvance(Request $request, $id)
    {
        if($request)
        {
            $advances = Advance::where('type_third', 'customer')->where('advanceable_id', $id)->get();
            return response()->json($advances);
        }
    }

    public function downloadPdfXmlInvoice(Request $request, Invoice $invoice)
    {
        //http://144.126.135.31:81/api/ubl2.1/download/89008003/Attachment-SETP990000399.xml/BASE64
        $configuration = Configuration::findOrFail(1);
        $environmentPdf = Environment::findOrFail(10);
        $typeDocument = $invoice->document_type_id;
        $urlpdf = $environmentPdf->protocol . $configuration->ip . $environmentPdf->url;
        if ($typeDocument == 1) {
            $pdf = file_get_contents($urlpdf . company()->nit ."/FES-" . $invoice->document .".pdf");

        } else if ($typeDocument == 15) {
            $pdf = file_get_contents($urlpdf . company()->nit ."/POSS-" . $invoice->document .".pdf");
        }

        Storage::disk('public')->put('files/graphical_representations/invoices/' .
        $invoice->document . '.pdf', $pdf);

        //$environmentPdf = Environment::findOrFail(10);
        $environmentXml = Environment::findOrFail(23);
        $urlxmldocument = "Attachment-" . $invoice->document . ".xml/BASE64";
        $urlxml = $environmentXml->protocol . $configuration->ip . $environmentXml->url . company()->nit . $urlxmldocument;
        $xml = file_get_contents($urlxml);

        Storage::disk('public')->put('files/graphical_representations/xmlinvoices/' .
        $invoice->document . '.xml', $xml);

        return redirect('invoice');
    }
    public function sendEmailInvoice(Request $request, Invoice $invoice)
    {
        return redirect('invoice');
    }

    public function getProviders(Request $request)
    {
        if($request)
        {
            $providers = Customer::get();
            return response()->json($providers);
        }
    }
}
