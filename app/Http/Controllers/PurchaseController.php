<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\BranchRawmaterial;
use App\Models\Card;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\CompanyTax;
use App\Models\Discrepancy;
use App\Models\DocumentType;
use App\Models\Environment;
use App\Models\GenerationType;
use App\Models\Indicator;
use App\Models\Municipality;
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
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use App\Traits\InventoryPurchases;
use App\Traits\KardexCreate;
use App\Traits\Taxes;
use App\Traits\RawMaterialPurchases;

class PurchaseController extends Controller
{
    use InventoryPurchases, KardexCreate, Taxes, RawMaterialPurchases;
    function __construct()
    {
        $this->middleware('permission:purchase.index|purchase.create|purchase.show|purchase.edit', ['only'=>['index']]);
        $this->middleware('permission:purchase.create', ['only'=>['create','store', 'createRawmaterial']]);
        $this->middleware('permission:purchase.show', ['only'=>['show']]);
        $this->middleware('permission:purchase.edit', ['only'=>['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $purchase = session('purchase');
        $indicator = Indicator::findOrFail(1);
        $typeDocument = '';
        if ($indicator->pos == 'off') {
            $typeDocument = 'document';
        } else {
            $typeDocument = 'pos';
        }

        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
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
                }elseif ($purchase->status == 'debit_note') {
                    return $purchase->status == 'debit_note' ? 'Nota Debito' : 'Nota Debito';
                } elseif ($purchase->status == 'credit_note'){
                    return $purchase->status == 'credit_note' ? 'Nota Credito' : 'Nota Credito';
                }  elseif ($purchase->status == 'complete'){
                    return $purchase->status == 'complete' ? 'NC - ND' : 'NC - ND';
                } elseif ($purchase->status == 'adjustment_note'){
                    return $purchase->status == 'adjustment_note' ? 'Nota de Ajuste': 'Nota de Ajuste';
                }
            })
            ->addColumn('role', function (Purchase $purchase) {
                return $purchase->user->roles[0]->name;
            })
            ->editColumn('created_at', function(Purchase $purchase){
                return $purchase->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/purchase/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.purchase.index', compact('purchase', 'indicator', 'typeDocument'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $indicator = Indicator::findOrFail(1);
        $cashRegister = CashRegister::select('id')
        ->where('user_id', '=', Auth::user()->id)
        ->where('status', '=', 'open')
        ->first();
        if ($indicator->pos == 'on') {
            if(is_null($cashRegister)){
                toast('Debes tener una caja Abierta para realizar Compras.','danger');
                return redirect("branch");
            }
        }
        $providers = Provider::get();
        $documentTypes = DocumentType::where('prefix', 'DSE')->get();
        $resolutions = Resolution::where('document_type_id', 11)->where('status', 'active')->get();
        $generationTypes = GenerationType::get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $percentages = Percentage::where('status', 'active')->get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $date = Carbon::now();
        $products = Product::where('status', 'active')->where('type_product', 'product')->get();
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();
        $typeProduct = 1;
        $countBranchs = count($branchs);
        return view('admin.purchase.create',
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
        ));
    }

    public function createRawmaterial()
    {
        $indicator = Indicator::findOrFail(1);
        $cashRegister = CashRegister::select('id')
        ->where('user_id', '=', current_user()->id)
        ->where('status', '=', 'open')
        ->first();
        if ($indicator->pos == 'on') {
            if(is_null($cashRegister)){
                toast('Debes tener una caja Abierta para realizar Compras.','danger');
                return redirect("branch");
            }
        }
        $providers = Provider::get();
        $documentTypes = DocumentType::where('prefix', 'DSE')->get();
        $resolutions = Resolution::where('document_type_id', 11)->where('status', 'active')->get();
        $generationTypes = GenerationType::get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $percentages = Percentage::where('status', 'active')->get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $date = Carbon::now();
        $products = RawMaterial::where('status', 'active')->get();
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();
        $typeProduct = 2;
        $countBranchs = count($branchs);
        return view('admin.purchase.create',
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
        ));
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
        $resolution = $request->resolution_id;
        $company = Company::findOrFail(current_user()->company_id);
        $environment = Environment::where('id', 16)->first();
        $indicator = Indicator::findOrFail(1);
        $cashRegister = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();

        //Variables del request
        $product_id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $tax_rate = $request->tax_rate;
        $branch = $request->branch_id[0];//variable de la sucursal de destino
        $total_pay = $request->total_pay;
        $totalpay = $request->totalpay;
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
        if ($documentType == 11 && $indicator->dian == 'on') {
            $data = supportDocumentSend($request);
            $requestResponse = sendDocuments($company, $environment, $data);
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
            $purchase->document = $resolutions->prefix . '-' . $resolutions->consecutive;
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

            if ($indicator->pos == 'on') {
                //actualizar la caja
                    $cashRegister->purchase += $total_pay;
                    //$cashRegister->out_total += $totalpay;
                    $cashRegister->update();
            }
            $document = $purchase;
            if ($request->typeProduct == 1) {
                for ($i=0; $i < count($product_id); $i++) {
                    $id = $product_id[$i];
                    //Metodo para registrar la relacion entre producto y compra
                    $productPurchase = new ProductPurchase();
                    $productPurchase->purchase_id = $purchase->id;
                    $productPurchase->product_id = $id;
                    $productPurchase->quantity = $quantity[$i];
                    $productPurchase->price = $price[$i];
                    $productPurchase->tax_rate = $tax_rate[$i];
                    $productPurchase->subtotal = $quantity[$i] * $price[$i];
                    $productPurchase->tax_subtotal =($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                    $productPurchase->save();

                    //selecciona el producto que viene del array
                    $product = Product::findOrFail($id);
                    //selecciona el producto de la sucursal que sea el mismo del array
                    $branchProducts = BranchProduct::where('product_id', '=', $id)
                    ->where('branch_id', '=', $branch)
                    ->first();

                    $quantityLocal = $quantity[$i];
                    $priceLocal = $price[$i];
                    $this->inventoryPurchases($product, $branchProducts, $quantityLocal, $priceLocal, $branch);//trait para actualizar inventario
                    $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex

                }
            } else {
                for ($i=0; $i < count($product_id); $i++) {
                    $id = $product_id[$i];
                    //Metodo para registrar la relacion entre producto y compra
                    $purchaseRawmaterial = new PurchaseRawmaterial();
                    $purchaseRawmaterial->purchase_id = $purchase->id;
                    $purchaseRawmaterial->raw_material_id = $id;
                    $purchaseRawmaterial->quantity = $quantity[$i];
                    $purchaseRawmaterial->price = $price[$i];
                    $purchaseRawmaterial->tax_rate = $tax_rate[$i];
                    $purchaseRawmaterial->subtotal = $quantity[$i] * $price[$i];
                    $purchaseRawmaterial->tax_subtotal =($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
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
                    $this->rawMaterialPurchases($rawMaterial, $branchRawmaterials, $quantityLocal, $priceLocal, $branch);//trait para actualizar inventario
                    $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex

                }
                $purchase->type_product = 'raw_material';
                $purchase->update();
            }

            //Ingresa los productos que vienen en el array


            $taxes = $this->getTaxesLine($request);//selecciona el impuesto que tiene la categoria IVA o INC
            //TaxesGlobals($document, $quantityBag, $typeDocument);
            taxesLines($document, $taxes, $typeDocument);
            retentions($request, $document, $typeDocument);


            if ($totalpay > 0) {
                pays($request, $document, $typeDocument);
            }
            if ($documentType == 11 && $indicator->dian == 'on') {
                $valid = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['IsValid'];
                $code = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusCode'];
                $description = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusDescription'];
                $statusMessage = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusMessage'];

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

                $pdf = file_get_contents($environmentPdf->url . $company->nit ."/DSS-" . $resolutions->prefix .
                $resolutions->consecutive .".pdf");
                Storage::disk('public')->put('files/graphical_representations/support_documents/' .
                $resolutions->prefix . $resolutions->consecutive . '.pdf', $pdf);

                $resolutions->consecutive += 1;
                $resolutions->update();
            }

            session()->forget('purchase');
            session(['purchase' => $purchase->id]);
            toast('Compra Registrada satisfactoriamente.','success');
            return redirect('purchase');
        }
        toast($errorMessages,'danger');
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


        $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
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
            $indicator = Indicator::findOrFail(1);
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

            if ($indicator->pos == 'on') {
                //actualizar la caja
                if ($date1 == $date2) {
                    $cashRegister = CashRegister::where('user_id', '=', $purchase->user_id)->where('status', '=', 'open')->first();
                    $cashRegister->purchase -= $purchase->total_pay;
                    $cashRegister->update();
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

            if ($indicator->pos == 'on') {
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

                        if ($indicator->pos == 'on') {
                            //metodo para actualizar la caja
                            $cashRegister = CashRegister::where('user_id', '=', $purchase->user_id)->where('status', '=', 'open')->first();
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
                if ($indicator->inventory == 'on') {
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
                    if ($indicator->inventory == 'on') {
                        if ($indicator->product_price == 'automatico') {

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
                    if ($indicator->inventory == 'on') {
                        $branchProducts->stock +=  $quantity[$i];
                        $branchProducts->update();
                        //selecciona el producto que viene del array

                        if ($indicator->product_price == 'automatic') {
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

        $purchase = Purchase::findOrFail($id);
        $products = Product::where('status', 'active')->where('type_product', 'service')->get();
        $discrepancies = Discrepancy::where('id', '>', 6)->where('description', '!=', 'Otros')->get();
        $resolutions = Resolution::where('document_type_id', 26)->where('status', 'active')->where('company_id', current_user()->company_id)->get();
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

        if ($purchase->status == 'complete' || $purchase->status == 'adjustment_note') {
            return redirect("purchase")->with('warning', 'Esta Compra ya no se puede hacer notas');
        }
        return view('admin.ncpurchase.create', compact(
            'purchase',
            'products',
            'productPurchases',
            'discrepancies',
            'resolutions',
            'taxes'
        ));
    }

    public function debitNote($id)
    {
        $purchase = Purchase::where('id', $id)->first();
        $indicator = Indicator::findOrFail(1);
        //$productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->get();
        if ($indicator->inventory == 'on') {
            $products = Product::where('status', 'active')->where('stock', '>', 0)->get();
        } else {
            $products = Product::where('status', 'active')->get();
        }
        if ($purchase->document_type_id == 11) {
            $discrepancies = Discrepancy::where('id', 2)->get();
        } else {
            $discrepancies = Discrepancy::where('id', '<', 5)->where('description', '!=', 'Otros')->get();
        }
        $resolutions = Resolution::where('document_type_id', 13)->where('status', 'active')->where('company_id', Auth::user()->company_id)->get();
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
    public function purchase_pay($id)
    {
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

    public function purchasePdf(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);
        if ($purchase->type_product == 'product') {
            $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        } else {
            $productPurchases = PurchaseRawmaterial::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        }
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
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
        //return $pdf->download("$purchasepdf.pdf");*/
    }

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
        $indicator = Indicator::findOrFail(1);
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
            $retnd = Tax::where('type', 'ndpurchase')->where('retentionable_id', $debitNotes->id)->first();
            $retentionnd = $retnd->retention;
        }
        if ($creditNotes != null) {
            $creditNote = $creditNotes->total_pay;
            $retnc = Tax::where('type', 'ncpurchase')->where('retentionable_id', $creditNotes->id)->first();
            $retentionnc = $retnc->retention;
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
        //return $pdf->download("$purchasepdf.pdf");*/
   }

   public function purchasePos($id)
   {
        $purchase = Purchase::findOrFail($id);
        if ($purchase->type_product == 'product') {
            $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        } else {
            $productPurchases = PurchaseRawmaterial::where('purchase_id', $purchase->id)->where('quantity', '>', 0)->get();
        }
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
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
            $retnd = Tax::where('type', 'ndpurchase')->where('retentionable_id', $debitNotes->id)->first();
            $retentionnd = $retnd->retention;
        }
        if ($creditNotes != null) {
            $creditNote = $creditNotes->total_pay;
            $retnc = Tax::where('type', 'ncpurchase')->where('retentionable_id', $creditNotes->id)->first();
            $retentionnc = $retnc->retention;
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
            'retentionnc'
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

        return $pdf->stream('vista-pdf', "$purchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
   }

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
        $indicator = Indicator::findOrFail(1);
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
            $retnd = Tax::where('type', 'ndpurchase')->where('retentionable_id', $debitNotes->id)->first();
            $retentionnd = $retnd->retention;
        }
        if ($creditNotes != null) {
            $creditNote = $creditNotes->total_pay;
            $retnc = Tax::where('type', 'ncpurchase')->where('retentionable_id', $creditNotes->id)->first();
            $retentionnc = $retnc->retention;
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
            'retentionnc'
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

        return $pdf->stream('vista-pdf', "$purchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
   }

   //Metodo para obtener el municipio de acuerdo al departamento
   public function getMunicipalities(Request $request, $id)
   {
       if($request)
       {
           $municipalities = Municipality::where('department_id', '=', $id)->get();

           return response()->json($municipalities);
       }
   }
}
