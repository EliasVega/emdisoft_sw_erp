<?php

namespace App\Http\Controllers;

use App\Helpers\Pdfs\PdfDocuments;
use App\Helpers\Tickets\Ticket;
use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\BranchRawmaterial;
use App\Models\Card;
use App\Models\CompanyTax;
use App\Models\Configuration;
use App\Models\Discrepancy;
use App\Models\DocumentType;
use App\Models\Environment;
use App\Models\GenerationType;
use App\Models\Ncpurchase;
use App\Models\Ndpurchase;
use App\Models\PaymentForm;
use App\Models\PaymentMethod;
use App\Models\Percentage;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Provider;
use App\Models\PurchaseRawmaterial;
use App\Models\RawMaterial;
use App\Models\Resolution;
use App\Models\SupportDocumentResponse;
use App\Models\Tax;
use App\Models\VoucherType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Traits\InventoryPurchases;
use App\Traits\KardexCreate;
use App\Traits\RawMaterialPurchases;
use App\Traits\GetTaxesLine;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Picqer\Barcode\BarcodeGeneratorPNG;

use function App\Helpers\Tickets\formatText;
use function App\Helpers\Tickets\ticketHeight;

class PurchaseController extends Controller
{
    use InventoryPurchases, KardexCreate, GetTaxesLine, RawMaterialPurchases;
    function __construct()
    {
        $this->middleware('permission:purchase.index|purchase.create|purchase.show|purchase.edit', ['only' => ['index']]);
        $this->middleware('permission:purchase.create', ['only' => ['create', 'store', 'createRawmaterial']]);
        $this->middleware('permission:purchase.show', ['only' => ['show']]);
        $this->middleware('permission:purchase.edit', ['only' => ['edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $purchase = '';
        $typeDocument = '';

        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' || $user == 'admin') {
                //Muestra todas las compras de la empresa
                $purchases = Purchase::get();
            } else {
                //Muestra todas las compras de la empresa por usuario
                $purchases = Purchase::where('user_id', $users->id)->get();
            }
            return DataTables::of($purchases)
                ->addIndexColumn()
                ->addColumn('provider', function (Purchase $purchase) {
                    return $purchase->third->name;
                })
                ->addColumn('branch', function (Purchase $purchase) {
                    return $purchase->branch->name;
                })
                ->addColumn('retention', function (Purchase $purchase) {
                    return $purchase->retention;
                })
                ->addColumn('status', function (Purchase $purchase) {
                    if ($purchase->status == 'purchase') {
                        return $purchase->status == 'purchase' ? 'F. Compra' : 'Compra';
                    } elseif ($purchase->status == 'support_document') {
                        return $purchase->status == 'support_document' ? 'Documento Soporte' : 'Documento Soporte';
                    } elseif ($purchase->status == 'debit_note') {
                        return $purchase->status == 'debit_note' ? 'Nota Debito' : 'Nota Debito';
                    } elseif ($purchase->status == 'credit_note') {
                        return $purchase->status == 'credit_note' ? 'Nota Credito' : 'Nota Credito';
                    } elseif ($purchase->status == 'complete') {
                        return $purchase->status == 'complete' ? 'NC - ND' : 'NC - ND';
                    } elseif ($purchase->status == 'adjustment_note') {
                        return $purchase->status == 'adjustment_note' ? 'Nota de Ajuste' : 'Nota de Ajuste';
                    }
                })
                ->addColumn('pos', function (Purchase $purchase) {
                    return $purchase->branch->company->indicator->pos;
                })
                ->addColumn('role', function (Purchase $purchase) {
                    return $purchase->user->roles[0]->name;
                })
                ->editColumn('created_at', function (Purchase $purchase) {
                    return $purchase->created_at->format('Y-m-d: h:m');
                })
                ->addColumn('btn', 'admin/purchase/actions')
                ->rawColumns(['btn'])
                ->make(true);
        }
        return view('admin.purchase.index', compact('purchase', 'typeDocument'));
    }

    public function indexPurchase(Request $request)
    {
        $purchase = session('purchase');
        $typeDocument = session('typeDocument');
        
        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' || $user == 'admin') {
                //Muestra todas las compras de la empresa
                $purchases = Purchase::get();
            } else {
                //Muestra todas las compras de la empresa por usuario
                $purchases = Purchase::where('user_id', $users->id)->get();
            }
            return DataTables::of($purchases)
                ->addIndexColumn()
                ->addColumn('provider', function (Purchase $purchase) {
                    return $purchase->third->name;
                })
                ->addColumn('branch', function (Purchase $purchase) {
                    return $purchase->branch->name;
                })
                ->addColumn('retention', function (Purchase $purchase) {
                    return $purchase->retention;
                })
                ->addColumn('status', function (Purchase $purchase) {
                    if ($purchase->status == 'purchase') {
                        return $purchase->status == 'purchase' ? 'F. Compra' : 'Compra';
                    } elseif ($purchase->status == 'support_document') {
                        return $purchase->status == 'support_document' ? 'Documento Soporte' : 'Documento Soporte';
                    } elseif ($purchase->status == 'debit_note') {
                        return $purchase->status == 'debit_note' ? 'Nota Debito' : 'Nota Debito';
                    } elseif ($purchase->status == 'credit_note') {
                        return $purchase->status == 'credit_note' ? 'Nota Credito' : 'Nota Credito';
                    } elseif ($purchase->status == 'complete') {
                        return $purchase->status == 'complete' ? 'NC - ND' : 'NC - ND';
                    } elseif ($purchase->status == 'adjustment_note') {
                        return $purchase->status == 'adjustment_note' ? 'Nota de Ajuste' : 'Nota de Ajuste';
                    }
                })
                ->addColumn('pos', function (Purchase $purchase) {
                    return $purchase->branch->company->indicator->pos;
                })
                ->addColumn('role', function (Purchase $purchase) {
                    return $purchase->user->roles[0]->name;
                })
                ->editColumn('created_at', function (Purchase $purchase) {
                    return $purchase->created_at->format('Y-m-d: h:m');
                })
                ->addColumn('btn', 'admin/purchase/actions')
                ->rawColumns(['btn'])
                ->make(true);
        }
        return view('admin.purchase.index', compact('purchase', 'typeDocument'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $indicator = indicator();
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $providers = Provider::get();
        $documentTypes = DocumentType::where('prefix', 'DSE')->get();
        $resolutions = Resolution::where('document_type_id', 11)->where('branch_id', current_user()->branch_id)->where('status', 'active')->get();
        $generationTypes = GenerationType::get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $percentages = Percentage::where('status', 'active')->get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $date = Carbon::now();
        $products = Product::from('products as pro')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.code', 'pro.stock', 'pro.price', 'pro.sale_price', 'pro.name', 'per.percentage', 'tt.id as tt')
            ->where('pro.status', '=', 'active')
            ->get();
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
            ->where('tt.type_tax', 'retention')->get();
        $typeProduct = 'product';

        $countBranchs = count($branchs);
        return view(
            'admin.purchase.create',
            compact(
                'indicator',
                'providers',
                'documentTypes',
                'resolutions',
                'generationTypes',
                'paymentForms',
                'paymentMethods',
                'banks',
                'cards',
                'branchs',
                'percentages',
                'advances',
                'products',
                'date',
                'companyTaxes',
                'typeProduct',
                'countBranchs'
            )
        );
    }

    public function createRawmaterial()
    {
        $indicator = indicator();
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $providers = Provider::get();
        $documentTypes = DocumentType::where('prefix', 'DSE')->get();
        $resolutions = Resolution::where('document_type_id', 11)->where('branch_id', current_user()->branc_id)->where('status', 'active')->get();
        $generationTypes = GenerationType::get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $percentages = Percentage::where('status', 'active')->get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $date = Carbon::now();
        $products = RawMaterial::from('raw_materials as rm')
            ->join('categories as cat', 'rm.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('rm.id', 'rm.code', 'rm.stock', 'rm.price', 'rm.name', 'per.percentage', 'tt.id as tt')
            ->where('rm.status', '=', 'active')
            ->get();

        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();
        $typeProduct = 'raw_material';
        $countBranchs = count($branchs);
        return view(
            'admin.purchase.create',
            compact(
                'indicator',
                'providers',
                'documentTypes',
                'resolutions',
                'generationTypes',
                'paymentForms',
                'paymentMethods',
                'banks',
                'cards',
                'branchs',
                'percentages',
                'advances',
                'products',
                'date',
                'companyTaxes',
                'typeProduct',
                'countBranchs'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {
        //dd($request->all());
        $totalpay = $request->totalpay;
        if ($totalpay == null) {
            toast('No adicionaste ningun tipo de pago.', 'error');
            return redirect('purchase');
        }
        $resolution = $request->resolution_id;
        $company = company();

        $cashRegister = cashRegisterComprobation();

        //Variables del request
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $price = $request->price;
        $salePrice = $request->sale_price;
        $tax_rate = $request->tax_rate;
        $branch = $request->branch_id; //variable de la sucursal de destino
        $total_pay = $request->total_pay;
        $retention = 0;
        //variables del request
        $quantityBag = 0;
        if ($request->total_retention != null) {
            $retention = $request->total_retention;
        }
        $documentType = $request->document_type_id;
        $typeDocument = 'purchase';
        $voucherType = '';
        if ($documentType == 11) {
            $voucherType = 12;
        } else {
            $voucherType = 7;
            $resolution = 1;
        }

        $resolutions = Resolution::findOrFail($resolution);
        $service = '';
        $errorMessages = '';
        $store = false;
        if ($documentType == 11 && indicator()->dian == 'on') {
            $environment = Environment::where('id', 16)->first();
            $configuration = Configuration::where('company_id', company()->id)->first();
            $url = $environment->protocol . $configuration->ip . $environment->url;
            $data = supportDocumentData($request);
            $requestResponse = sendDocuments($url, $data);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
        } else {
            $store = true;
        }

        //Crea un registro de compras
        if ($store == true) {
            $purchase = new Purchase();
            $purchase->user_id = current_user()->id;
            $purchase->branch_id = current_user()->branch_id;
            $purchase->provider_id = $request->provider_id;
            $purchase->payment_form_id = $request->payment_form_id;
            $purchase->payment_method_id = $request->payment_method_id[0];
            $purchase->resolution_id = $resolution;
            $purchase->generation_type_id = $request->generation_type_id;
            $purchase->document_type_id = $documentType;
            $purchase->cash_register_id = $cashRegister->id;
            $purchase->document = $resolutions->prefix . $resolutions->consecutive;
            if ($documentType == 11) {
                $voucherTypes = VoucherType::findOrFail(12);
                $purchase->invoice_code = $voucherTypes->code . '-' . $voucherTypes->consecutive;
                $purchase->voucher_type_id = 12;
                $purchase->status = 'support_document';

                $voucherTypes->consecutive += 1;
                $voucherTypes->update();
            } else {
                $voucherTypes = VoucherType::findOrFail(7);
                $purchase->invoice_code = $request->invoice_code;
                $purchase->voucher_type_id = 7;
                $purchase->status = 'purchase';
                $voucherTypes->consecutive += 1;
                $voucherTypes->update();

                $resolutions->consecutive += 1;
                $resolutions->update();
            }
            $purchase->generation_date = $request->generation_date;
            $purchase->due_date = $request->due_date;
            $purchase->retention = $retention;
            $purchase->total = $request->total;
            $purchase->total_tax = $request->total_tax;
            $purchase->total_pay = $total_pay;

            if ($totalpay > 0) {
                $purchase->pay = $totalpay;
            } else {
                $purchase->pay = 0;
            }
            $purchase->balance = $total_pay - $totalpay;
            $purchase->grand_total = $total_pay - $retention;
            $purchase->start_date = $request->start_date;
            $purchase->save();

            $voucher = VoucherType::findOrFail(19);
            $voucher->consecutive = $purchase->id;
            $voucher->update();

            if (indicator()->pos == 'on') {
                //actualizar la caja
                $cashRegister->purchase += $total_pay;
                $cashRegister->update();
            }

            $document = $purchase;
            if ($request->typeProduct == 'product') {
                for ($i = 0; $i < count($product_id); $i++) {
                    $id = $product_id[$i];
                    //Metodo para registrar la relacion entre producto y compra
                    $productPurchase = new ProductPurchase();
                    $productPurchase->purchase_id = $purchase->id;
                    $productPurchase->product_id = $id;
                    $productPurchase->quantity = $quantity[$i];
                    $productPurchase->price = $price[$i];
                    $productPurchase->tax_rate = $tax_rate[$i];
                    $productPurchase->subtotal = $quantity[$i] * $price[$i];
                    $productPurchase->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i]) / 100;
                    $productPurchase->save();

                    //selecciona el producto que viene del array
                    $product = Product::findOrFail($id);
                    //selecciona el producto de la sucursal que sea el mismo del array
                    $branchProducts = BranchProduct::where('product_id', '=', $id)
                        ->where('branch_id', '=', $branch)
                        ->first();

                    $quantityLocal = $quantity[$i];
                    $priceLocal = $price[$i];
                    $salePriceLocal = $salePrice[$i];
                    $this->inventoryPurchases(
                        $product,
                        $branchProducts,
                        $quantityLocal,
                        $priceLocal,
                        $branch,
                        $salePriceLocal
                    ); //trait para actualizar inventario
                    $this->kardexCreate(
                        $product,
                        $branch,
                        $voucherType,
                        $document,
                        $quantityLocal,
                        $typeDocument
                    ); //trait crear Kardex
                }
            } else {
                for ($i = 0; $i < count($product_id); $i++) {
                    $id = $product_id[$i];
                    //Metodo para registrar la relacion entre producto y compra
                    $purchaseRawmaterial = new PurchaseRawmaterial();
                    $purchaseRawmaterial->purchase_id = $purchase->id;
                    $purchaseRawmaterial->raw_material_id = $id;
                    $purchaseRawmaterial->quantity = $quantity[$i];
                    $purchaseRawmaterial->price = $price[$i];
                    $purchaseRawmaterial->tax_rate = $tax_rate[$i];
                    $purchaseRawmaterial->subtotal = $quantity[$i] * $price[$i];
                    $purchaseRawmaterial->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i]) / 100;
                    $purchaseRawmaterial->save();

                    //selecciona el producto que viene del array
                    $rawMaterial = RawMaterial::findOrFail($id);
                    //selecciona el producto de la sucursal que sea el mismo del array
                    $branchRawmaterials = BranchRawmaterial::where('raw_material_id', '=', $id)
                        ->where('branch_id', '=', $branch)
                        ->first();
                    $product = $rawMaterial;
                    $quantityLocal = $quantity[$i];
                    $priceLocal = $price[$i];
                    $this->rawMaterialPurchases(
                        $rawMaterial,
                        $branchRawmaterials,
                        $quantityLocal,
                        $priceLocal,
                        $branch
                    ); //trait para actualizar inventario
                    $this->kardexCreate(
                        $product,
                        $branch,
                        $voucherType,
                        $document,
                        $quantityLocal,
                        $typeDocument
                    ); //trait crear Kardex
                }
                $purchase->type_product = 'raw_material';
                $purchase->update();
            }

            //Ingresa los productos que vienen en el array


            $taxes = $this->getTaxesLine($request); //selecciona el impuesto que tiene la categoria IVA o INC
            //TaxesGlobals($document, $quantityBag, $typeDocument);
            taxesLines($document, $taxes, $typeDocument);
            retentions($request, $document, $typeDocument);


            if ($totalpay > 0) {
                pays($request, $document, $typeDocument);
            }

            if ($documentType == 11 && indicator()->dian == 'on') {
                $valid = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['IsValid'];
                $code = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['StatusCode'];
                $description = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['StatusDescription'];
                $statusMessage = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['StatusMessage'];

                $supportDocumentResponse = new SupportDocumentResponse();
                $supportDocumentResponse->document = $purchase->document;
                $supportDocumentResponse->message = $service['message'];
                $supportDocumentResponse->valid = $valid;
                $supportDocumentResponse->code = $code;
                $supportDocumentResponse->description = $description;
                $supportDocumentResponse->status_message = $statusMessage;
                $supportDocumentResponse->cuds = $service['cuds'];
                $supportDocumentResponse->purchase_id = $purchase->id;
                $supportDocumentResponse->save();

                $environmentPdf = Environment::where('code', 'PDF')->first();
                $urlpdf = $environmentPdf->protocol . $configuration->ip . $environmentPdf->url;
                $pdf = file_get_contents($urlpdf . $company->nit . "/DSS-" . $resolutions->prefix .
                    $resolutions->consecutive . ".pdf");
                Storage::disk('public')->put('files/graphical_representations/support_documents/' .
                    $resolutions->prefix . $resolutions->consecutive . '.pdf', $pdf);
                $resolutions->consecutive += 1;
                $resolutions->update();
            }
            $typeDocument = $request->type_document;
            session()->forget('purchase');
            session()->forget('typeDocument');
            session(['purchase' => $purchase->id]);
            session(['typeDocument' => $typeDocument]);
            toast('Compra Registrada satisfactoriamente.', 'success');
            return redirect('indexPurchase');
        }
        toast($errorMessages, 'danger');
        return redirect('purchase');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        $voucher = VoucherType::findOrFail(19);
        $debitNotes = Ndpurchase::where('purchase_id', $purchase->id)->first();
        $creditNotes = Ncpurchase::where('purchase_id', $purchase->id)->first();
        $retentions = Tax::from('taxes as tax')
            ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('tax.tax_value', 'ct.name')
            ->where('tax.type', 'purchase')
            ->where('tax.taxable_id', $purchase->id)
            ->where('tt.type_tax', 'retention')->get();
        $retentionsum = Tax::from('taxes as tax')
            ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('tax.tax_value', 'ct.name')
            ->where('tax.type', 'purchase')
            ->where('tax.taxable_id', $purchase->id)
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
                ->where('tax.type', 'ndpurchase')
                ->where('tax.taxable_id', $debitNotes->id)
                ->where('tt.type_tax', 'retention')
                ->sum('tax_value');
            //$retnd = Retention::where('type', 'ndpurchase')->where('retentionable_id', $debitNotes->id)->first();
            if ($retnd) {
                $retentionnd = $retnd;
            } else {
                $retentionnd = 0;
            }
        }
        if ($creditNotes != null) {
            $creditNote = $creditNotes->total_pay;
            //$retnc = Retention::where('type', 'ncpurchase')->where('retentionable_id', $creditNotes->id)->first();
            $retnc = Tax::from('taxes as tax')
                ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
                ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
                ->select('tax.tax_value', 'ct.name')
                ->where('tax.type', 'ncpurchase')
                ->where('tax.taxable_id', $creditNotes->id)
                ->where('tt.type_tax', 'retention')
                ->sum('tax_value');

            if ($retnc) {
                $retentionnc = $retnc;
            } else {
                $retentionnc = 0;
            }
        }
        if ($purchase->type_product == 'product') {
            $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        } else {
            $productPurchases = PurchaseRawmaterial::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        }
        $type = $purchase->type_product;

        //$productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        return view('admin.purchase.show', compact(
            'purchase',
            'debitNotes',
            'creditNotes',
            'debitNote',
            'creditNote',
            'retentionnd',
            'retentionnc',
            'retentions',
            'retentionsum',
            'productPurchases',
            'type'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        /*
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $retention = Retention::where('type', 'purchase')->where('retentionable_id', $purchase->id)->first();
        $providers = Provider::get();
        $documentTypes = DocumentType::where('prefix', 'dse')->get();
        $resolutions = Resolution::get();
        $generationTypes = GenerationType::get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $percentages = Percentage::where('status', 'active')->get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $products = Product::where('status', 'active')->get();
        $date = Carbon::now();
        $productPurchases = ProductPurchase::from('product_purchases as pp')
        ->join('products as pro', 'pp.product_id', 'pro.id')
        ->select('pp.id', 'pro.id as idP', 'pro.name', 'pro.stock', 'pp.quantity', 'pp.price', 'pp.tax_rate', 'pp.subtotal')
        ->where('purchase_id', $purchase->id)
        ->get();
        $payPurchases = Pay::where('type', 'purchase')->where('payable_id', $purchase->id)->sum('pay');
        return view('admin.purchase.edit',
        compact(
            'purchase',
            'retention',
            'providers',
            'documentTypes',
            'resolutions',
            'generationTypes',
            'paymentForms',
            'paymentMethods',
            'banks',
            'cards',
            'branchs',
            'percentages',
            'advances',
            'products',
            'date',
            'productPurchases',
            'payPurchases'
        ));*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        /*
            $cashRegister = cashRegisterComprobation();
            $user = Auth::user();

            //Variables del request
            $product_id = $request->product_id;
            $quantity   = $request->quantity;
            $price      = $request->price;
            $tax_rate        = $request->tax_rate;
            $branch     = $request->branch_id;
            $totalpay = $request->totalpay;
            $total_pay = $request->total_pay;

            //variables del request
            $paymentMethod = $request->payment_method_id;
            $bank = $request->bank_id;
            $card = $request->card_id;
            $advance_id = $request->advance_id;
            $payment = $request->pay;
            $transaction = $request->transaction;
            $advance = $request->advance;
            $percentage = $request->percentageold;

            //llamado de todos los pagos y pago nuevo para la diferencia
            $payOld = Pay::where('type', 'purchase')->where('payable_id', $purchase->id)->sum('pay');
            $payNew = $totalpay;
            $payTotal = $payNew + $payOld;
            $retention = Retention::where('type', 'purchase')->where('retentionable_id', $purchase->id)->first();
            $date1 = Carbon::now()->toDateString();
            $date2 = Purchase::find($purchase->id)->created_at->toDateString();

            if ($payOld > $total_pay) {

                $voucherTypes = VoucherType::findOrFail(18);
                //Metodo para crear un nuevo advance
                $advance = new Advance();
                $advance->user_id = Auth::user()->id;
                $advance->branch_id = Auth::user()->branch_id;
                $advance->voucher_type_id = 18;
                $advance->document = $voucherTypes->code . '-' . $voucherTypes->consecutive;
                $advance->origin = 'Compra' . '-' . $purchase->document;
                $advance->destination = null;
                $advance->pay = $payOld - $total_pay;
                $advance->balance = $payOld - $total_pay;;
                $advance->note = 'Anticipo generado por edicion de factura' . '-' . $purchase->document;
                $advance->status = 'pending';
                $provider = Provider::findOrFail($request->provider_id);
                $advance->type_third = 'provider';
                $provider->advances()->save($advance);

            }

            if (indicator()->pos == 'on') {
                //actualizar la caja
                if ($date1 == $date2) {
                    $cashRegister = CashRegister::where('user_id', '=', $purchase->user_id)->where('status', '=', 'open')->first();
                    $cashRegister->purchase -= $purchase->total_pay;
                    cashregisterModel()->update();
                }
            }

            //Actualizando un registro de compras

            $purchase->provider_id = $request->provider_id;
            $purchase->payment_form_id = $request->payment_form_id;
            $purchase->payment_method_id = $request->payment_method_id[0];
            $purchase->generation_date = $request->generation_date;
            $purchase->due_date = $request->due_date;
            $purchase->total = $request->total;
            $purchase->total_tax = $request->total_tax;
            $purchase->total_pay = $total_pay;
            $purchase->status = 'active';
            if ($payTotal <= $total_pay) {
                $purchase->pay = $payTotal;
                $purchase->balance = $total_pay - $payTotal - $retention;
            } else {
                $purchase->pay = $total_pay;
                $purchase->balance = 0;
            }
            $purchase->grand_total = $total_pay;
            $purchase->start_date = $request->start_date;
            $purchase->update();

            if ($percentage != null) {
                if ($retention != null) {
                    $retention->retention = $request->retention;
                    $retention->percentage_id = $percentage;
                    $retention->update();
                } else {
                    $retention = new Retention();
                    $retention->retention = $request->retention;
                    $retention->type = 'purchase';
                    $retention->percentage_id = $percentage;
                    $purchase->retentions()->save($retention);
                }
            }

            if (indicator()->pos == 'on') {
                //actualizar la caja
                if ($date1 == $date2) {
                    $cashRegister = CashRegister::where('user_id', '=', $purchase->user_id)->where('status', '=', 'open')->first();
                    $cashRegister->purchase += $purchase->total_pay;
                    $cashRegister->update();
                }
            }

            //inicio proceso si hay pagos
            if($totalpay > 0){

                //Metodo para crear un nuevo pago y su realcion polimorfica dependiendo del tipo de documento
                $pay = new pay();
                $pay->user_id = $user->id;
                $pay->branch_id = $user->branch_id;
                $pay->pay = $totalpay;
                $pay->balance = $purchase->balance;
                $pay->type = 'purchase';
                $purchase->pays()->save($pay);

                for ($i=0; $i < count($payment); $i++) {
                    # code...

                    //variable si el pago fue de un pago anticipado
                    $payAdvance = $request->advance[$i];
                    //inicio proceso si hay pago po abono anticipado
                    if ($payAdvance > 0) {
                        //llamado al pago anticipado
                        $advance = Advance::findOrFail( $request->advance_id);
                        //si el pago es utilizado en su totalidad agregar el destino aplicado
                        if ($advance->pay > $advance->balance) {
                            $advance->destination = $advance->destination . '<->' . $purchase->document;
                        } else {
                            $advance->destination = $purchase->document;
                        }
                        //variable si hay saldo en el pago anticipado
                        $payAdvance_total = $advance->balance - $payAdvance;
                        //cambiar el status del pago anticipado
                        if ($payAdvance_total == 0) {
                            $advance->status      = 'aplicado';
                        } else {
                            $advance->status      = 'parcial';
                        }
                        //actualizar el saldo del pago anticipado
                        $advance->balance = $payAdvance_total;
                        $advance->update();
                    } else {

                         //Metodo para registrar la relacion entre pago y metodo de pago
                        $pay_paymentMethod = new PayPaymentMethod();
                        $pay_paymentMethod->pay_id = $pay->id;
                        $pay_paymentMethod->payment_method_id = $paymentMethod[$i];
                        $pay_paymentMethod->bank_id = $bank[$i];
                        $pay_paymentMethod->card_id = $card[$i];
                        if (isset($advance_id[$i])){
                            $pay_paymentMethod->advance_id = $advance_id[$i];
                        }
                        $pay_paymentMethod->pay = $payment[$i];
                        $pay_paymentMethod->transaction = $transaction[$i];
                        $pay_paymentMethod->save();

                        $mp = $paymentMethod[$i];

                        if (indicator()->pos == 'on') {
                            //metodo para actualizar la caja

                            if($mp == 10){
                                $cashRegister->out_purchase_cash += $pay;
                                $cashRegister->cash_out_total += $pay;
                            }
                            $cashRegister->out_purchase += $pay;
                            $cashRegister->update();
                        }
                    }
                }

            }

            $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->get();
            foreach ($productPurchases as $key => $productPurchase) {
                //selecciona el producto que viene del array

                //$product = Product::findOrFail($id);
                if (indicator()->inventory == 'on') {
                    $products = Product::where('id', $productPurchase->product_id)->first();
                    $products->stock -= $productPurchase->quantity;
                    $products->update();

                    //selecciona el producto de la sucursal que sea el mismo del array
                    $branchProducts = BranchProduct::where('product_id', '=', $productPurchase->product_id)
                    ->where('branch_id', '=', $branch)
                    ->first();

                    $branchProducts->stock -= $productPurchase->quantity;
                    $branchProducts->update();
                }

                //Actualiza la tabla del Kardex
                $kardex = Kardex::where('voucher_type_id', $purchase->voucher_type_id)->where('document', $purchase->document)->first();
                $kardex->quantity -= $productPurchase->quantity;
                $kardex->stock -= $productPurchase->quantity;
                $kardex->save();

                $productPurchase->quantity = 0;
                $productPurchase->price = 0;
                $productPurchase->tax_rate = 0;
                $productPurchase->subtotal = 0;
                $productPurchase->tax_subtotal = 0;
                $productPurchase->update();

            }

            //Toma el Request del array
            //Ingresa los productos que vienen en el array
            for ($i=0; $i < count($product_id); $i++) {
                # code...
                $productPurchase = ProductPurchase::where('purchase_id', $purchase->id)
                ->where('product_id', $product_id[$i])->first();
                $subtotal = $quantity[$i] * $price[$i];
                $tax_subtotal   = $subtotal * $tax_rate[$i]/100;
                //Inicia proceso actualizacio product purchase si no existe
                if (is_null($productPurchase)) {
                    $productPurchase = new ProductPurchase();
                    $productPurchase->purchase_id = $purchase->id;
                    $productPurchase->product_id = $product_id[$i];
                    $productPurchase->quantity = $quantity[$i];
                    $productPurchase->price = $price[$i];
                    $productPurchase->tax_rate = $tax_rate[$i];
                    $productPurchase->subtotal = $subtotal;
                    $productPurchase->tax_subtotal = $tax_subtotal;
                    $productPurchase->save();
                    //selecciona el producto que viene del array

                    $products = Product::where('id', $productPurchase->product_id)->first();
                    //selecciona el producto de la sucursal que sea el mismo del array
                    $branchProducts = BranchProduct::where('product_id', '=', $productPurchase->product_id)
                        ->where('branch_id', '=', $branch)
                        ->first();
                    if (indicator()->inventory == 'on') {
                        if (indicator()->product_price == 'automatico') {

                            $utility = $products->category->utility;
                            $priceProduct = $products->price;
                            $priceSale = $priceProduct + ($priceProduct * $utility / 100);
                            //Cambia el valor de venta del producto
                            //$product = Product::findOrFail($id);
                            $products->sale_price = $priceSale;
                            $products->update();
                        }
                        //selecciona el producto de la sucursal que sea el mismo del array


                        if (isset($branchProducts)) {
                            $branchProducts->stock += $quantity[$i];
                            $branchProducts->update();
                        } else {
                            //metodo para crear el producto en la sucursal y asignar stock
                            $branchProduct = new BranchProduct();
                            $branchProduct->branch_id = $branch;
                            $branchProduct->product_id = $productPurchase->product_id;
                            $branchProduct->stock = $productPurchase->quantity;
                            $branchProduct->save();
                        }
                    } else {


                        if ($branchProducts == null) {
                            //metodo para crear el producto en la sucursal y asignar stock
                            $branchProduct = new BranchProduct();
                            $branchProduct->branch_id = $branch;
                            $branchProduct->product_id = $productPurchase->product_id;
                            $branchProduct->stock = $productPurchase->quantity;
                            $branchProduct->save();
                        }
                    }
                    //Actualiza la tabla del Kardex
                    $kardex = new Kardex();
                    $kardex->product_id = $product_id[$i];
                    $kardex->branch_id = $branch;
                    if ($purchase->documentType == 11) {
                        $kardex->voucher_type_id = 12;
                    } else {
                        $kardex->voucher_type_id = 7;
                    }
                    $kardex->document = $purchase->document;
                    $kardex->quantity = $quantity[$i];
                    $kardex->stock = $products->stock;
                    $kardex->save();
                } else {
                    if ($quantity[$i] > 0) {

                        $subtotal = $quantity[$i] * $price[$i];
                        $tax_subtotal = $subtotal * $tax_rate[$i]/100;

                        $productPurchase->quantity = $quantity[$i];
                        $productPurchase->price = $price[$i];
                        $productPurchase->tax_rate = $tax_rate[$i];
                        $productPurchase->subtotal = $subtotal;
                        $productPurchase->tax_subtotal = $tax_subtotal;
                        $productPurchase->update();
                    }

                    $products = Product::findOrFail($product_id[$i]);
                    //selecciona el producto de la sucursal que sea el mismo del array
                    $branchProducts = BranchProduct::where('product_id', '=', $productPurchase->product_id)
                    ->where('branch_id', '=', $branch)
                    ->first();
                    if (indicator()->inventory == 'on') {
                        $branchProducts->stock +=  $quantity[$i];
                        $branchProducts->update();
                        //selecciona el producto que viene del array

                        if (indicator()->product_price == 'automatic') {
                            $utility = $products->category->utility;
                            $priceProduct = $products->price;
                            $priceSale = $priceProduct + ($priceProduct * $utility / 100);
                            //Cambia el valor de venta del producto
                            $products->sale_price = $priceSale;
                            $products->stock += $quantity[$i];
                            $products->update();
                        } else {
                            $products->stock += $quantity[$i];
                            $products->update();
                        }
                    }
                    //Actualiza la tabla del Kardex
                    $kardex = Kardex::where('voucher_type_id', $purchase->voucher_type_id)->where('document', $purchase->document)->first();
                    $kardex->quantity += $quantity[$i];
                    $kardex->stock += $quantity[$i];
                    $kardex->update();
                }
            }
        if ($payOld > $total_pay) {
            Alert::success('Compra','Editada Satisfactoriamente. Con creacion de anticipo de Proveedor');
            return redirect('purchase');

        } else {
            return redirect("purchase")->with('success', 'Compra Editada Satisfactoriamente');
        }*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }

    public function creditNote($id)
    {
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $purchase = Purchase::findOrFail($id);
        $products = Product::where('status', 'active')->where('type_product', 'service')->get();
        $discrepancies = Discrepancy::where('id', '>', 6)->where('description', '!=', 'Otros')->get();
        $resolutions = Resolution::where('document_type_id', 26)->where('status', 'active')->where('branch_id', current_user()->branch_id)->get();
        $taxes = Tax::from('taxes as tax')
            ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->select('ct.id', 'ct.name', 'ct.tax_type_id', 'tax.tax_value', 'per.percentage', 'per.base')
            ->where('tax.type', 'purchase')
            ->where('tt.type_tax', 'retention')
            ->where('tax.taxable_id', $id)
            ->get();
        $purchase = Purchase::findOrFail($id);
        if ($purchase->type_product == 'product') {
            $productPurchases = ProductPurchase::from('product_purchases as pp')
                ->join('products as pro', 'pp.product_id', 'pro.id')
                ->join('categories as cat', 'pro.category_id', 'cat.id')
                ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
                ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
                ->select('pp.id', 'pro.id as idP', 'pro.name', 'pro.stock', 'pp.quantity', 'pp.price', 'pp.tax_rate', 'pp.subtotal', 'tt.id as idtt', 'tt.name as namett')
                ->where('purchase_id', $id)
                ->get();
        } else {
            $productPurchases = PurchaseRawmaterial::from('purchase_rawmaterials as pp')
                ->join('raw_materials as pro', 'pp.raw_material_id', 'pro.id')
                ->join('categories as cat', 'pro.category_id', 'cat.id')
                ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
                ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
                ->select('pp.id', 'pro.id as idP', 'pro.name', 'pro.stock', 'pp.quantity', 'pp.price', 'pp.tax_rate', 'pp.subtotal', 'tt.id as idtt', 'tt.name as namett')
                ->where('purchase_id', $id)
                ->get();
        }
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();
        if ($purchase->status == 'complete' || $purchase->status == 'adjustment_note') {
            return redirect("purchase")->with('warning', 'Esta Compra ya no se puede hacer notas');
        }
        return view('admin.ncpurchase.create', compact(
            'purchase',
            'products',
            'productPurchases',
            'discrepancies',
            'resolutions',
            'companyTaxes',
            'taxes'
        ));
    }

    public function debitNote($id)
    {
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $purchase = Purchase::where('id', $id)->first();
        //$productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->get();
        if (indicator()->inventory == 'on') {
            $products = Product::where('status', 'active')->where('stock', '>', 0)->get();
        } else {
            $products = Product::where('status', 'active')->get();
        }
        if ($purchase->document_type_id == 11) {
            $discrepancies = Discrepancy::where('id', 2)->get();
        } else {
            $discrepancies = Discrepancy::where('id', '<', 5)->where('description', '!=', 'Otros')->get();
        }
        $resolutions = Resolution::where('document_type_id', 13)->where('status', 'active')->where('branch_id', Auth::user()->branch_id)->get();
        $taxes = Tax::from('taxes as tax')
            ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->select('ct.id', 'ct.name', 'ct.tax_type_id', 'tax.tax_value', 'per.percentage', 'per.base')
            ->where('tax.type', 'purchase')
            ->where('tt.type_tax', 'retention')
            ->where('tax.taxable_id', $id)
            ->get();
        if ($purchase->type_product == 'product') {
            $productPurchases = ProductPurchase::from('product_purchases as pp')
                ->join('products as pro', 'pp.product_id', 'pro.id')
                ->join('categories as cat', 'pro.category_id', 'cat.id')
                ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
                ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
                ->select('pp.id', 'pro.id as idP', 'pro.name', 'pro.stock', 'pp.quantity', 'pp.price', 'pp.tax_rate', 'pp.subtotal', 'tt.id as idtt', 'tt.name as namett')
                ->where('purchase_id', $id)
                ->get();
        } else {
            $productPurchases = PurchaseRawmaterial::from('purchase_rawmaterials as pp')
                ->join('raw_materials as pro', 'pp.raw_material_id', 'pro.id')
                ->join('categories as cat', 'pro.category_id', 'cat.id')
                ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
                ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
                ->select('pp.id', 'pro.id as idP', 'pro.name', 'pro.stock', 'pp.quantity', 'pp.price', 'pp.tax_rate', 'pp.subtotal', 'tt.id as idtt', 'tt.name as namett')
                ->where('purchase_id', $id)
                ->get();
        }
        if ($purchase->status == 'complete' || $purchase->status == 'adjustment_note') {
            return redirect("purchase")->with('warning', 'Esta Compra ya no se puede hacer notas');
        }
        return view('admin.ndpurchase.create', compact(
            'purchase',
            'products',
            'productPurchases',
            'discrepancies',
            'resolutions',
            'taxes'
        ));
    }

    //Metodo para registrar pago o abono de factura de compra
    public function purchasePay($id)
    {
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $document = Purchase::findOrFail($id);
        $banks = Bank::get();
        $paymentMethods = PaymentMethod::get();
        $cards = Card::get();
        $advances = Advance::where('status', '!=', 'applied')->where('advanceable_id', $document->third->id)->get();
        $tipeDocument = 'Compra';

        return view('admin.pay.create', compact(
            'document',
            'banks',
            'paymentMethods',
            'cards',
            'advances',
            'tipeDocument'
        ));
    }
    /*
    public function purchasePdf(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);
        if ($purchase->type_product == 'product') {
            $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        } else {
            $productPurchases = PurchaseRawmaterial::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        }
        $company = Company::findOrFail(1);
        $indicator = indicator();
        $debitNotes = Ndpurchase::where('purchase_id', $id)->first();
        $creditNotes = Ncpurchase::where('purchase_id', $id)->first();
        $days = $purchase->created_at->diffInDays($purchase->due_date);
        $purchasepdf = "COMP-". $purchase->document;
        $logo = './imagenes/logos'.$company->logo;
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'purchase')
        ->where('tax.taxable_id', $purchase->id)
        ->where('tt.type_tax', 'retention')->get();
        $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'purchase')
        ->where('tax.taxable_id', $purchase->id)
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
            ->where('tax.type', 'ndpurchase')
            ->where('tax.taxable_id', $debitNotes->id)
            ->where('tt.type_tax', 'retention')
            ->sum('tax_value');
            //$retnd = Retention::where('type', 'ndpurchase')->where('retentionable_id', $debitNotes->id)->first();
            if ($retnd) {
                $retentionnd = $retnd;
            } else {
                $retentionnd = 0;
            }
        }
        if ($creditNotes != null) {
            $creditNote = $creditNotes->total_pay;
            //$retnc = Retention::where('type', 'ncpurchase')->where('retentionable_id', $creditNotes->id)->first();
            $retnc = Tax::from('taxes as tax')
            ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('tax.tax_value', 'ct.name')
            ->where('tax.type', 'ncpurchase')
            ->where('tax.taxable_id', $creditNotes->id)
            ->where('tt.type_tax', 'retention')
            ->sum('tax_value');

            if ($retnc) {
                $retentionnc = $retnc;
            } else {
                $retentionnc = 0;
            }
        }
        $view = \view('admin.purchase.pdf', compact(
            'purchase',
            'days',
            'productPurchases',
            'company',
            'indicator',
            'logo',
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

        return $pdf->stream('vista-pdf', "$purchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
    }*/
    /*
   public function pdfPurchase(Request $request)
   {
        $purchases = session('purchase');
        $purchase = Purchase::findOrFail($purchases);
        session()->forget('purchase');
        if ($purchase->type_product == 'product') {
            $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        } else {
            $productPurchases = PurchaseRawmaterial::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        }
        $company = Company::findOrFail(1);
        $indicator = indicator();
        $debitNotes = Ndpurchase::where('purchase_id', $purchase->id)->first();
        $creditNotes = Ncpurchase::where('purchase_id', $purchase->id)->first();
        $days = $purchase->created_at->diffInDays($purchase->due_date);
        $purchasepdf = "COMP-". $purchase->document;
        $logo = './imagenes/logos'.$company->logo;
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'purchase')
        ->where('tax.taxable_id', $purchase->id)
        ->where('tt.type_tax', 'retention')->get();
        $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'purchase')
        ->where('tax.taxable_id', $purchase->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        $debitNote = 0;
        $creditNote = 0;
        $retentionnd = 0;
        $retentionnc = 0;
        if ($debitNotes != null) {
            $debitNote = $debitNotes->total_pay;
            $retnd = Tax::where('type', 'ndpurchase')->where('taxable_id', $debitNotes->id)->first();
            $retentionnd = $retnd->tax_value;
        }
        if ($creditNotes != null) {
            $creditNote = $creditNotes->total_pay;
            $retnc = Tax::where('type', 'ncpurchase')->where('taxable_id', $creditNotes->id)->first();
            $retentionnc = $retnc->tax_value;
        }
        $view = \view('admin.purchase.pdf', compact(
            'purchase',
            'days',
            'productPurchases',
            'company',
            'indicator',
            'logo',
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

        return $pdf->stream('vista-pdf', "$purchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
   }*/
    /*
   public function purchasePos($id)
   {
        $purchase = Purchase::findOrFail($id);
        if ($purchase->type_product == 'product') {
            $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        } else {
            $productPurchases = PurchaseRawmaterial::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        }
        $user = current_user()->name;
        $company = Company::findOrFail(1);
        $indicator = indicator();
        $debitNotes = Ndpurchase::where('purchase_id', $id)->first();
        $creditNotes = Ncpurchase::where('purchase_id', $id)->first();
        $days = $purchase->created_at->diffInDays($purchase->due_date);
        $purchasepdf = "COMP-". $purchase->document;
        $logo = './imagenes/logos'.$company->logo;
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'purchase')
        ->where('tax.taxable_id', $purchase->id)
        ->where('tt.type_tax', 'retention')->get();
        $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'purchase')
        ->where('tax.taxable_id', $purchase->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        $debitNote = 0;
        $creditNote = 0;
        $retentionnd = 0;
        $retentionnc = 0;
        if ($debitNotes != null) {
            $debitNote = $debitNotes->total_pay;
            $retnd = Tax::where('type', 'ndpurchase')->where('taxable_id', $debitNotes->id)->first();
            if (isset($retnd)) {
                $retentionnd = $retnd->tax_value;
            } else {
                $retentionnd = 0;
            }


        }
        if ($creditNotes != null) {
            $creditNote = $creditNotes->total_pay;
            $retnc = Tax::where('type', 'ncpurchase')->where('taxable_id', $creditNotes->id)->first();
            if (isset($retnc)) {
                $retentionnc = $retnc->tax_value;
            } else {
                $retentionnc = 0;
            }
        }
        $view = \view('admin.purchase.pos', compact(
            'purchase',
            'days',
            'productPurchases',
            'user',
            'company',
            'indicator',
            'logo',
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
        $pdf->setPaper (array(0,0,297.64,1246.53), 'portrait');

        return $pdf->stream('vista-pdf', "$purchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
   }*/
    /*
   public function posPurchase(Request $request)
   {
        $purchases = session('purchase');
        $purchase = Purchase::findOrFail($purchases);
        session()->forget('purchase');
        if ($purchase->type_product == 'product') {
            $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        } else {
            $productPurchases = PurchaseRawmaterial::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        }
        $company = Company::findOrFail(1);
        $indicator = indicator();
        $debitNotes = Ndpurchase::where('purchase_id', $purchase->id)->first();
        $creditNotes = Ncpurchase::where('purchase_id', $purchase->id)->first();
        $days = $purchase->created_at->diffInDays($purchase->due_date);
        $purchasepdf = "COMP-". $purchase->document;
        $logo = './imagenes/logos'.$company->logo;
        $user = current_user()->name;
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'purchase')
        ->where('tax.taxable_id', $purchase->id)
        ->where('tt.type_tax', 'retention')->get();
        $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'purchase')
        ->where('tax.taxable_id', $purchase->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        $debitNote = 0;
        $creditNote = 0;
        $retentionnd = 0;
        $retentionnc = 0;
        if ($debitNotes != null) {
            $debitNote = $debitNotes->total_pay;
            $retnd = Tax::where('type', 'ndpurchase')->where('retentionable_id', $debitNotes->id)->first();
            if (isset($retnd)) {
                $retentionnd = $retnd->tax_value;
            } else {
                $retentionnd = 0;
            }
        }
        if ($creditNotes != null) {
            $creditNote = $creditNotes->total_pay;
            $retnc = Tax::where('type', 'ncpurchase')->where('retentionable_id', $creditNotes->id)->first();
            if (isset($retnc)) {
                $retentionnc = $retnc->tax_value;
            } else {
                $retentionnc = 0;
            }
        }
        $view = \view('admin.purchase.pos', compact(
            'purchase',
            'days',
            'productPurchases',
            'company',
            'indicator',
            'logo',
            'debitNotes',
            'creditNotes',
            'retentions',
            'retentionsum',
            'debitNote',
            'creditNote',
            'retentionnd',
            'retentionnc',
            'user'
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ('b7', 'portrait');
        $pdf->setPaper (array(0,0,297.64,1246.53), 'portrait');
        return $pdf->stream('vista-pdf', "$purchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
   }*/

    public function posPdfPurchase(Request $request, Purchase $purchase)
    {
        $document = $purchase;
        $typeDocument = 'purchase';
        $title = '';
        $consecutive = $document->document;
        $documentType = $purchase->document_type_id;
        if ($documentType == 11) {
            $title = 'DOCUMENTO SOPORTE ELECTRONICO';
        } else {
            $title = 'COMPROBANTE DE COMPRA';
        }

        $thirdPartyType = 'provider';
        $logoHeight = 26;

        if (indicator()->logo == 'on') {
            $logo = storage_path('app/public/images/logos/' . company()->imageName);

            $image = list($width, $height, $type, $attr) = getimagesize($logo);
            $multiplier = $image[0] / $image[1];
            $height = 26;
            $width = $height * $multiplier;
            if ($width > 60) {
                $width = 60;
                $height = 60 / $multiplier;
            }
        }

        $pdfHeight = ticketHeight($logoHeight, company(), $purchase, $typeDocument);

        $pdf = new Ticket('P', 'mm', array(70, $pdfHeight), true, 'UTF-8');
        $pdf->SetMargins(1, 10, 4);
        $pdf->SetTitle($purchase->document);
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
        $barcodeCode = $barcodeGenerator->getBarcode($purchase->id, $barcodeGenerator::TYPE_CODE_128);
        $barcode = "data:image/png;base64," . base64_encode($barcodeCode);

        $pdf->generateBarcode($barcode);
        $pdf->generateBranchInformation($document);
        $pdf->generateThirdPartyInformation($purchase->third, $thirdPartyType);
        $pdf->generateProductsTable($document, $typeDocument);
        $pdf->generateSummaryInformation($document, $typeDocument);

        if (indicator()->dian == 'on' && $documentType == 11) {
            $pdf->generateInvoiceInformation($document);
            $cufe =  $purchase->supportDocumentResponse->cuds;
            $url = 'https://catalogo-vpfe.dian.gov.co/document/searchqr?documentkey=';
            $data = [
                'NumFac' => $purchase->document,
                'FecFac' => $purchase->created_at->format('Y-m-d'),
                'NitFac' => company()->nit,
                'DocAdq' => $purchase->third->identification,
                'ValFac' => $purchase->total,
                'ValIva' => $purchase->total_tax,
                'ValOtroIm' => '0.00',
                'ValTotal' => $purchase->total_pay,
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
            $confirmationCode = formatText("CUFE: " . $purchase->invoiceResponse->cufe);
            //$confirmationCode = formatText("CUFE: " . $invoice->invoiceResponse->cufe);
            $pdf->generateConfirmationCode($confirmationCode);
        }


        $refund = formatText("*** Para realizar un reclamo o devolución debe de presentar este ticket ***");
        $pdf->generateDisclaimerInformation($refund);

        $pdf->footer();

        $pdf->Output("I", $purchase->document . ".pdf", true);
        exit;
    }

    public function pdfPurchase(Request $request, Purchase $purchase)
    {
        $typeDocument = 'purchase';
        $title = '';
        //$consecutive = $document->document;
        $documentType = $purchase->document_type_id;
        if ($documentType == 11) {
            $title = 'DOCUMENTO SOPORTE ELECTRONICO';
        } else {
            $title = 'COMPROBANTE DE COMPRA';
        }


        $document = $purchase;
        $thirdPartyType = 'provider';
        $logoHeight = 26;
        $logo = '';
        $width = 0;
        $height = 0;
        if (indicator()->logo == 'on') {
            $logo = storage_path('app/public/images/logos/' . company()->imageName);

            $image = list($width, $height, $type, $attr) = getimagesize($logo);
            $multiplier = $image[0] / $image[1];
            $height = 26;
            $width = $height * $multiplier;
            if ($width > 60) {
                $width = 60;
                $height = 60 / $multiplier;
            }
        }

        //$pdfHeight = ticketHeight($logoHeight, company(), $invoice, "invoice");

        $pdf = new PdfDocuments('P', 'mm', 'Letter', true, 'UTF-8');
        $pdf->SetMargins(10, 10, 6);
        $pdf->SetTitle($document->document);
        $pdf->SetAutoPageBreak(false);
        $pdf->addPage();

        if (indicator()->dian == 'on' && $documentType == 11) {
            //$pdf->generateInvoiceInformation($document);
            $cufe =  $document->supportDocumentResponse->cufe;
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

        $pdf->generateHeaderPurchase($logo, $width, $height, $title, $document);
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

    public function getProductPurchase(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::from('products as pro')
                ->join('categories as cat', 'pro.category_id', 'cat.id')
                ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
                ->join('percentages as per', 'ct.percentage_id', 'per.id')
                ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
                ->select('pro.id', 'pro.name', 'pro.stock', 'pro.price', 'pro.sale_price', 'per.percentage', 'tt.id as tt')
                ->where('pro.code', $request->code)
                ->first();
            if ($products) {
                return response()->json($products);
            }
        }
    }

    public function getProviders(Request $request)
    {
        if ($request) {
            $providers = Provider::get();
            return response()->json($providers);
        }
    }
}
