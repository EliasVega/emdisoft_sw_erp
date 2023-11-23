<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Card;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\CompanyTax;
use App\Models\Customer;
use App\Models\Discrepancy;
use App\Models\Environment;
use App\Models\HomeOrder;
use App\Models\Indicator;
use App\Models\InvoiceProduct;
use App\Models\InvoiceResponse;
use App\Models\Ncinvoice;
use App\Models\Ndinvoice;
use App\Models\PaymentForm;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Resolution;
use App\Models\RestaurantOrder;
use App\Models\Tax;
use App\Models\VoucherType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use App\Traits\InventoryInvoices;
use App\Traits\KardexCreate;
use App\Traits\Taxes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    use InventoryInvoices, KardexCreate, Taxes;
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
        $invoice = session('invoice');
        $indicator = Indicator::findOrFail(1);
        $typeDocument = '';
        if ($indicator->pos == 'off') {
            $typeDocument = 'document';
        } else {
            $typeDocument = 'pos';
        }
        if ($request->ajax()) {
            $users = current_user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Muestra todas las compras de la empresa
                $invoices = Invoice::get();
            } else {
                //Muestra todas las compras de la empresa por usuario
                $invoices = Invoice::where('user_id', $users->id)->get();
            }
            return DataTables::of($invoices)
            ->addIndexColumn()
            ->addColumn('customer', function (Invoice $invoice) {
                return $invoice->third->name;
            })
            ->addColumn('branch', function (Invoice $invoice) {
                return $invoice->branch->name;
            })
            ->addColumn('retention', function (Invoice $invoice) {
                return $invoice->retention;
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
            ->addColumn('role', function (Invoice $invoice) {
                return $invoice->user->roles[0]->name;
            })
            ->addColumn('restaurant', function (Invoice $invoice) {
                return $invoice->branch->company->indicator->restaurant;
            })
            ->editColumn('created_at', function(Invoice $invoice){
                return $invoice->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/invoice/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.invoice.index', compact('invoice', 'indicator', 'typeDocument'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $indicator = Indicator::findOrFail(1);
        $cashRegister = CashRegister::select('id')
        ->where('user_id', '=', current_user()->id)
        ->where('status', '=', 'open')
        ->first();
        if ($indicator->pos == 'on') {
            if(is_null($cashRegister)){
                Alert::success('danger','Debes tener una caja Abierta para realizar Operaciones');
                return redirect("branch");
            }
        }
        $customers = Customer::get();
        $resolutions = Resolution::where('document_type_id', 1)->where('status', 'active')->get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $uvtmax = $indicator->uvt * 5;
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $date = Carbon::now();
        if ($indicator->inventory == 'on') {
            $products = BranchProduct::from('branch_products as bp')
            ->join('products as pro', 'bp.product_id', 'pro.id')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.stock', 'pro.sale_price', 'pro.name', 'per.percentage', 'tt.id as tt')
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
        return view('admin.invoice.create',
        compact(
            'customers',
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
            'uvtmax',
            'indicator'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //dd($request->all());
        $company = Company::findOrFail(current_user()->company_id);
        $environment = Environment::where('id', 11)->first();
        $indicator = Indicator::findOrFail(1);
        $cashRegister = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        $resolutions = '';
        $resolut = $request->resolution_id;
        //dd($resolut);
        if ($resolut == null) {
            if ($indicator->dian == 'on') {
                $resolutions = Resolution::findOrFail(4);
            } else {
                $resolutions = Resolution::findOrFail(13);
            }
        } else {
            $resolutions = Resolution::findOrFail($request->resolution_id);
        }
        $typeDocument = 'invoice';
        $documentType = '';

        if ($indicator->pos == 'on' && $request->fe == 2) {
            $voucherType = 2;
            $documentType = 12;
        } else {
            $voucherType = 1;
            $documentType = 1;
        }

        $voucherTypes = VoucherType::findOrFail($voucherType);

        //Variables del request
        $product_id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $tax_rate = $request->tax_rate;
        $branch = current_user()->branch_id;
        $total_pay = $request->total_pay;
        $totalpay = $request->totalpay;
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
        if ($documentType == 1 && $indicator->dian == 'on') {
            $data = invoiceSend($request);
            //dd($data);
            $requestResponse = sendDocuments($company, $environment, $data);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
        } else {
            $store = true;
        }
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
            $invoice->document = $resolutions->prefix . '-' . $resolutions->consecutive;
            $invoice->voucher_type_id = $voucherType;
            $invoice->status = 'invoice';
            $invoice->generation_date = $request->generation_date;
            $invoice->due_date = $request->due_date;
            $invoice->retention = $retention;
            $invoice->total = $request->total;
            $invoice->total_tax = $request->total_tax;
            $invoice->total_pay = $total_pay;
            if ($totalpay > 0) {
                $invoice->pay = $totalpay;
            } else {
                $invoice->pay = 0;
            }
            $invoice->balance = $total_pay - $totalpay;
            $invoice->grand_total = $total_pay - $retention;
            $invoice->save();

            $voucherTypes->consecutive += 1;
            $voucherTypes->update();

            if ($indicator->pos == 'on') {
                //actualizar la caja
                    $cashRegister->invoice += $total_pay;
                    //$cashRegister->in_total += $totalpay;
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
                //selecciona el producto de la sucursal que sea el mismo del array
                $branchProducts = BranchProduct::where('product_id', '=', $id)
                ->where('branch_id', '=', $branch)
                ->first();

                $quantityLocal = $quantity[$i];
                $this->inventoryInvoices($product, $branchProducts, $quantityLocal, $branch);//trait para actualizar inventario
                $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex

            }

            $taxes = $this->getTaxesLine($request);//selecciona el impuesto que tiene la categoria IVA o INC
            taxesGlobals($document, $quantityBag, $typeDocument);
            taxesLines($document, $taxes, $typeDocument);
            retentions($request, $document, $typeDocument);


            if ($totalpay > 0) {
                pays($request, $document, $typeDocument);
            }
            if ($documentType == 1 && $indicator->dian == 'on') {
                $valid = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['IsValid'];
                $code = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusCode'];
                $description = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusDescription'];
                $statusMessage = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusMessage'];

                $invoiceResponse = new InvoiceResponse();
                $invoiceResponse->document = $invoice->document;
                $invoiceResponse->message = $service['message'];
                $invoiceResponse->valid = $valid;
                $invoiceResponse->code = $code;
                $invoiceResponse->description = $description;
                $invoiceResponse->status_message = $statusMessage;
                $invoiceResponse->cufe = $service['cufe'];
                $invoiceResponse->invoice_id = $invoice->id;
                $invoiceResponse->save();

                $environmentPdf = Environment::where('code', 'PDF')->first();

                $pdf = file_get_contents($environmentPdf->url . $company->nit ."/FES-" . $resolutions->prefix .
                $resolutions->consecutive .".pdf");
                Storage::disk('public')->put('files/graphical_representations/invoices/' .
                $resolutions->prefix . $resolutions->consecutive . '.pdf', $pdf);
            }
            $resolutions->consecutive += 1;
            $resolutions->update();

            session()->forget('invoice');
            session(['invoice' => $invoice->id]);
            toast('Venta Registrada satisfactoriamente.','success');
            return redirect('invoice');
        }
        toast($errorMessages,'danger');
        return redirect('invoice');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
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
        $invoice = Invoice::findOrFail($id);
        $products = Product::where('status', 'active')->where('type_product', 'service')->get();
        $discrepancies = Discrepancy::where('id', '>', 6)->where('description', '!=', 'Otros')->get();
        $resolutions = Resolution::where('document_type_id', 26)->where('status', 'active')->where('company_id', current_user()->company_id)->get();
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
        $invoice = Invoice::where('id', $id)->first();
        $indicator = Indicator::findOrFail(1);
        //$invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->get();
        if ($indicator->inventory == 'on') {
            $products = Product::where('status', 'active')->where('stock', '>', 0)->get();
        } else {
            $products = Product::where('status', 'active')->get();
        }
        if ($invoice->document_type_id == 11) {
            $discrepancies = Discrepancy::where('id', 2)->get();
        } else {
            $discrepancies = Discrepancy::where('id', '<', 5)->where('description', '!=', 'Otros')->get();
        }
        $resolutions = Resolution::where('document_type_id', 4)->where('status', 'active')->where('company_id', current_user()->company_id)->get();
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

    public function invoice_pay($id)
    {
        $document = Invoice::findOrFail($id);
        $banks = Bank::get();
        $paymentMethods = PaymentMethod::get();
        $cards = Card::get();
        $advances = Advance::where('status', '!=', 'applied')->where('advanceable_id', $document->third->id)->get();
        $tipeDocument = 'Venta';

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
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
        $debitNotes = Ndinvoice::where('invoice_id', $id)->first();
        $creditNotes = Ncinvoice::where('invoice_id', $id)->first();
        $days = $invoice->created_at->diffInDays($invoice->due_date);
        $invoicepdf = $invoice->document;
        //$logo = './imagenes/logos'.$company->logo;
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
            'company',
            'indicator',
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

    public function pdfInvoice(Request $request)
   {
        $invoices = session('invoice');
        $invoice = Invoice::findOrFail($invoices);
        session()->forget('invoice');
        $invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
        $debitNotes = Ndinvoice::where('invoice_id', $invoice->id)->first();
        $creditNotes = Ncinvoice::where('invoice_id', $invoice->id)->first();
        $days = $invoice->created_at->diffInDays($invoice->due_date);
        $invoicepdf = $invoice->document;
        //$logo = './imagenes/logos'.$company->logo;
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
        $view = \view('admin.invoice.pdf', compact(
            'invoice',
            'days',
            'invoiceProducts',
            'company',
            'indicator',
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

        return $pdf->stream('vista-pdf', "$invoicepdf.pdf");
   }

    public function invoicePos($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->where('quantity', '>', 0)->get();
        $restaurantOrder = RestaurantOrder::where('invoice_id', $id)->first();
        $homeOrder = HomeOrder::where('restaurant_order_id', $restaurantOrder->id)->first();
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
        $debitNotes = Ndinvoice::where('invoice_id', $id)->first();
        $creditNotes = Ncinvoice::where('invoice_id', $id)->first();
        $days = $invoice->created_at->diffInDays($invoice->due_date);
        $invoicepdf = $invoice->document;
        $logo = './imagenes/logos'.$company->logo;
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
            'company',
            'indicator',
            'debitNotes',
            'creditNotes',
            'retentions',
            'retentionsum',
            'debitNote',
            'creditNote',
            'retentionnd',
            'retentionnc'
        ))->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

            return $pdf->stream('vista-pdf', "$invoicepdf.pdf");
    }

    public function posInvoice(Request $request)
    {
        $invoices = session('invoice');
        $invoice = Invoice::findOrFail($invoices);
        session()->forget('invoice');
        $restaurantOrder = RestaurantOrder::where('invoice_id', $invoice->id)->first();
        $homeOrder = HomeOrder::where('restaurant_order_id', $restaurantOrder->id)->first();
        $invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
        $debitNotes = Ndinvoice::where('invoice_id', $invoice->id)->first();
        $creditNotes = Ncinvoice::where('invoice_id', $invoice->id)->first();
        $days = $invoice->created_at->diffInDays($invoice->due_date);
        $invoicepdf = $invoice->document;
        $logo = './imagenes/logos'.$company->logo;
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
            'company',
            'indicator',
            'debitNotes',
            'creditNotes',
            'retentions',
            'retentionsum',
            'debitNote',
            'creditNote',
            'retentionnd',
            'retentionnc'
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

        return $pdf->stream('vista-pdf', "$invoicepdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");
    }
}
