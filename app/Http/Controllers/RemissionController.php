<?php

namespace App\Http\Controllers;

use App\Helpers\Pdfs\PdfDocuments;
use App\Helpers\Tickets\Ticket;
use App\Models\Remission;
use App\Http\Requests\StoreRemissionRequest;
use App\Http\Requests\UpdateRemissionRequest;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Card;
use App\Models\CashOutflow;
use App\Models\CompanyTax;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Kardex;
use App\Models\Pay;
use App\Models\PaymentForm;
use App\Models\PaymentMethod;
use App\Models\PaymentRemissionReturn;
use App\Models\paymentReturn;
use App\Models\PayPaymentMethod;
use App\Models\Product;
use App\Models\ProductRemission;
use App\Models\Resolution;
use App\Models\VoucherType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;
use App\Traits\InventoryInvoices;
use App\Traits\KardexCreate;
use App\Traits\AdvanceCreate;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Redirect;
use Picqer\Barcode\BarcodeGeneratorPNG;

use function App\Helpers\Tickets\formatText;
use function App\Helpers\Tickets\ticketHeight;
use function PHPUnit\Framework\isNull;

class RemissionController extends Controller
{
    use InventoryInvoices, KardexCreate, AdvanceCreate;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $remission = session('remission');
        $indicator = indicator();
        $typeDocument = session('typeDocument');

        if ($request->ajax()) {
            $users = current_user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Muestra todas las compras de la empresa
                $remissions = Remission::get();
            } else {
                if (indicator()->pos == 'off') {
                    $remissions = Remission::get();
                } else {
                    //Muestra todas las compras de la empresa por usuario
                    $remissions = Remission::where('user_id', $users->id)->get();
                }
            }
            return DataTables::of($remissions)
            ->addIndexColumn()
            ->addColumn('customer', function (Remission $remission) {
                return $remission->third->name;
            })
            ->addColumn('branch', function (Remission $remission) {
                return $remission->branch->name;
            })
            ->addColumn('retention', function (Remission $remission) {
                return $remission->retention;
            })
            ->addColumn('status', function (Remission $remission) {
                if ($remission->status == 'active') {
                    return $remission->status == 'active' ? 'Remission' : 'Facturado';
                } elseif ($remission->status == 'generated') {
                    return $remission->status == 'generated' ? 'Facturado' : 'Cancelado';
                } else {
                    return $remission->status == 'canceled' ? 'Anulada' : 'Anulada';
                }
            })
            ->addColumn('role', function (Remission $remission) {
                return $remission->user->roles[0]->name;
            })
            ->addColumn('pos', function (Remission $remission) {
                return $remission->branch->company->indicator->pos;
            })
            ->editColumn('created_at', function(Remission $remission){
                return $remission->generation_date;
            })
            ->addColumn('btn', 'admin/remission/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.remission.index', compact('remission', 'indicator', 'typeDocument'));
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
        $customers = Customer::get();
        $resolutions = Resolution::where('document_type_id', 107)->get();
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
            ->where('bp.stock', '>=', 0)
            ->where('pro.status', '=', 'active')
            ->get();
        } else {
            $products = Product::from('products as pro')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.code', 'pro.stock', 'pro.sale_price', 'pro.name', 'cat.utility_rate', 'per.percentage', 'tt.id as tt')
            ->where('pro.stock', '>=', 0)
            ->where('pro.status', '=', 'active')
            ->get();
        }
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();
        $type = 'remission';
        $typeOperation = 'creation';
        return view('admin.remission.create',
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
            'type',
            'typeOperation'
        ));
    }

    public function createPosRemission()
    {
        //$pos = indicator()->pos;
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }

        $customers = Customer::get();
        $employees = Employee::get();
        $resolutions = Resolution::where('document_type_id', 107)->get();
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
            ->where('bp.stock', '>=', 0)
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
        $type = 'remissionPos';
        $typeOperation = 'creation';
        return view('admin.remission.create',
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
            'type',
            'typeOperation'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRemissionRequest $request)
    {
        //dd($request->all());
        $totalpayment = $request->totalpay;
        if ($totalpayment == null) {
            toast('No adicionaste ningun tipo de pago.','error');
            return redirect('remission');
        }
        $customer = $request->customer_id;
        if (is_null($customer)) {
            return Redirect::back()->withErrors(['msg' => 'no selecionaste el cliente']);
        }
        $documentType = 107;
        $typeDocument = $request->typeDocument;
        $resolutions = Resolution::findOrFail(14);
        $voucherTypes = VoucherType::findOrFail(25);
        $cashRegister = cashRegisterComprobation();

        //Variables del request
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $price = $request->price;
        $tax_rate = $request->tax_rate;
        $branch = current_user()->branch_id;
        $total_pay = $request->total_pay;
        $paymentForm = $request->payment_form_id;
        $totalpay = 0;
        $payment = 0;

        if ($typeDocument == 'remission') {
            $totalpay = $request->totalpay;
        } else {
            $payment = $request->pay;
            if ($payment[0] >= $total_pay) {
                $totalpay = $total_pay;
            } else {
                $totalpay = $payment[0];
            }
        }

        $retention = 0;
        //variables del request
        if ($request->total_retention != null) {
            $retention = $request->total_retention;
        }

        $remission = new Remission();
        $remission->user_id = current_user()->id;
        $remission->branch_id = current_user()->branch_id;
        $remission->customer_id = $request->customer_id;
        $remission->payment_form_id = $request->payment_form_id;
        $remission->payment_method_id = $request->payment_method_id[0];
        $remission->resolution_id = $resolutions->id;
        $remission->document_type_id = $documentType;
        $remission->document = $resolutions->prefix . $resolutions->consecutive;
        $remission->voucher_type_id = $voucherTypes->id;
        $remission->cash_register_id = cashRegisterComprobation()->id;
        $remission->status = 'active';
        $remission->note = $request->note;
        $remission->generation_date = $request->generation_date;
        $remission->due_date = $request->due_date;
        $remission->retention = $retention;
        $remission->total = $request->total;
        $remission->total_tax = $request->total_tax;
        $remission->total_pay = $total_pay;
        $remission->pay = $totalpay;
        if ($typeDocument == 'remission') {
            $remission->balance = $total_pay - $totalpay;
        } else {
            if ($paymentForm == 1) {
                if ($total_pay >= $payment) {
                    $remission->balance = $total_pay - $payment;
                } else {
                    $remission->balance = 0;
                }
            } else {
                $remission->balance = $total_pay;
            }
        }
        $remission->grand_total = $total_pay - $retention;
        $remission->save();

        $voucherTypes->consecutive += 1;
        $voucherTypes->update();

        if (indicator()->pos == 'on') {
            //actualizar la caja
                $cashRegister->remission += $total_pay;
                $cashRegister->update();
        }
        $document = $remission;
        //$typeDocument = $request->typeDocument;
        //Ingresa los productos que vienen en el array
        for ($i=0; $i < count($product_id); $i++) {
            $id = $product_id[$i];
            //Metodo para registrar la relacion entre producto y compra
            $productRemission = new ProductRemission();
            $productRemission->remission_id = $remission->id;
            $productRemission->product_id = $id;
            $productRemission->quantity = $quantity[$i];
            $productRemission->price = $price[$i];
            $productRemission->tax_rate = $tax_rate[$i];
            $productRemission->subtotal = $quantity[$i] * $price[$i];
            $productRemission->tax_subtotal =($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
            $productRemission->save();

            //selecciona el producto que viene del array
            $product = Product::findOrFail($id);
            //selecciona el producto de la sucursal que sea el mismo del array
            $branchProducts = BranchProduct::where('product_id', '=', $id)
            ->where('branch_id', '=', $branch)
            ->first();

            $quantityLocal = $quantity[$i];
            $voucherType = $voucherTypes->id;
            $this->inventoryInvoices($product, $branchProducts, $quantityLocal, $branch);//trait para actualizar inventario
            $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex
        }


            if ($typeDocument == 'remissionPos') {
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
                    $pay->type = 'remission';
                    $document->pays()->save($pay);

                    //Metodo para registrar la relacion entre pago y metodo de pago
                    $pay_paymentMethod = new PayPaymentMethod();
                    $pay_paymentMethod->pay_id = $pay->id;
                    $pay_paymentMethod->payment_method_id = $paymentMethod;
                    $pay_paymentMethod->bank_id = $bank;
                    $pay_paymentMethod->card_id = $card;
                    $pay_paymentMethod->pay = $payment[0];
                    $pay_paymentMethod->transaction = $transaction;
                    $pay_paymentMethod->save();*/

                    pays($request, $document, $typeDocument);
                    if (indicator()->pos == 'on') {
                        //metodo para actualizar la caja
                        $cashRegister->in_remission_cash += $totalpay;
                        $cashRegister->cash_in_total += $totalpay;

                        $cashRegister->in_remission += $totalpay;
                        $cashRegister->in_total += $totalpay;
                        $cashRegister->update();
                    }
                }

                $paymentRemissionReturn = new PaymentRemissionReturn();
                $paymentRemissionReturn->payment = $request->pay[0];
                $paymentRemissionReturn->return = $return;
                $paymentRemissionReturn->remission_id = $document->id;
                $paymentRemissionReturn->save();
            } else {
                if ($totalpay > 0) {
                    pays($request, $document, $typeDocument);
                }
            }
        $resolutions->consecutive += 1;
        $resolutions->update();
        //$typeDocument = 'remission';

        session()->forget('remission');
        session()->forget('typeDocument');
        session(['remission' => $remission->id]);
        session(['typeDocument' => $typeDocument]);
        toast('Remission Registrada satisfactoriamente.','success');
        return redirect('remission');
    }

    /**
     * Display the specified resource.
     */
    public function show(Remission $remission)
    {
        $voucher = VoucherType::findOrFail(25);

        $productRemissions = ProductRemission::where('remission_id', $remission->id)->where('quantity', '>', 0)->get();
        return view('admin.remission.show', compact(
            'remission',
            'productRemissions',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Remission $remission)
    {
        $pos = indicator()->pos;
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $customers = Customer::get();
        $resolutions = Resolution::where('document_type_id', 107)->get();
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
            ->where('bp.stock', '>=', 0)
            ->where('pro.status', '=', 'active')
            ->get();
        } else {
            $products = Product::from('products as pro')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.code', 'pro.stock', 'pro.sale_price', 'pro.name', 'cat.utility_rate', 'per.percentage', 'tt.id as tt')
            ->where('pro.stock', '>=', 0)
            ->where('pro.status', '=', 'active')
            ->get();
        }
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();
        $productRemissions = ProductRemission::from('product_remissions as pr')
        ->join('products as pro', 'pr.product_id', 'pro.id')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('pr.id', 'pr.quantity', 'pr.price', 'pr.tax_rate', 'pro.id as idP', 'pro.stock', 'pro.name', 'per.percentage', 'tt.id as tt')
        ->where('pr.remission_id', $remission->id)
        ->get();
        $type = 'remission';
        $typeOperation = 'edition';
        return view('admin.remission.edit',
        compact(
            'remission',
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
            'productRemissions',
            'type',
            'typeOperation'
        ));
    }

    public function editPosRemission($id)
    {
        $remission = Remission::findOrFail($id);
        $pos = indicator()->pos;
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $customers = Customer::get();
        $resolutions = Resolution::where('document_type_id', 107)->get();
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
            ->where('bp.stock', '>=', 0)
            ->where('pro.status', '=', 'active')
            ->get();
        } else {
            $products = Product::from('products as pro')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.code', 'pro.stock', 'pro.sale_price', 'pro.name', 'cat.utility_rate', 'per.percentage', 'tt.id as tt')
            ->where('pro.stock', '>=', 0)
            ->where('pro.status', '=', 'active')
            ->get();
        }
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();
        $productRemissions = ProductRemission::from('product_remissions as pr')
        ->join('products as pro', 'pr.product_id', 'pro.id')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('pr.id', 'pr.quantity', 'pr.price', 'pr.subtotal', 'pr.tax_subtotal', 'pr.tax_rate', 'pro.id as idP', 'pro.stock', 'pro.name', 'per.percentage', 'tt.id as tt')
        ->where('pr.remission_id', $remission->id)
        ->get();
        $type = 'remissionPos';
        $typeOperation = 'edition';
        return view('admin.remission.edit',
        compact(
            'remission',
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
            'productRemissions',
            'type',
            'typeOperation'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRemissionRequest $request, Remission $remission)
    {
        //dd($request->all());
        //Variables del request
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $price = $request->price;
        $tax_rate = $request->tax_rate;
        $branch = current_user()->branch_id;
        $total_pay = $request->total_pay;
        $totalpay = $request->totalpay;
        if (is_null($totalpay)) {
            $totalpay = 0;
        }
        $typeDocument = $request->typeDocument;
        $documentType = 107;
        $resolutions = Resolution::findOrFail(14);
        $voucherTypes = VoucherType::findOrFail(25);

        //datos para hacer reversiones
        $cashRegister = cashRegisterComprobation();
        $date1 = Carbon::now()->toDateString();
        $date2 = Remission::find($remission->id)->created_at->toDateString();
        $reverse = $request->reverse;//1 si desea volver valor a caja 2 si desea crear un avance
        $remissionPayments = $request->remission_payments;
        $payNew = $request->totalpay + $remissionPayments;
        $surplusPayments = (($total_pay - $payNew) *(-1));

        //salida de efectivo de caja
        if (indicator()->pos == 'on') {
            if ($remissionPayments > $total_pay) {
                if ($reverse == 1) {
                    $cashOutflow = new CashOutflow();
                    $cashOutflow->user_id = current_user()->id;
                    $cashOutflow->cash_register_id = cashRegisterComprobation()->id;
                    $cashOutflow->branch_id = current_user()->branch_id;
                    $cashOutflow->admin_id = 2;
                    $cashOutflow->cash = $surplusPayments;
                    $cashOutflow->reason = 'salida de caja por devolucion en remision :' . '-' . $remission->document;
                    $cashOutflow->save();
                    $cashRegister->out_cash += $surplusPayments;
                    $cashRegister->out_total += $surplusPayments;
                    $cashRegister->cash_out_total += $surplusPayments;
                    $cashRegister->update();
                } else {
                    //creando registro d avance a clientes
                    $documentOrigin = $remission;
                    $advancePay = $surplusPayments;
                    $this->advanceCreate($voucherTypes, $documentOrigin, $advancePay, $typeDocument);

                    if (indicator()->pos == 'on') {
                        $cashRegister->in_advance += $advancePay;
                        if ($date1 == $date2) {
                            $cashRegister->in_remission -= $advancePay;
                        }
                        $cashRegister->update();
                    }
                }
            }
        }

        if (indicator()->pos == 'on') {
            if ($date1 == $date2) {
                $cashRegister->remission -= $remission->total_pay;
                $cashRegister->update();
            }
        }
        $retention = 0;
        //variables del request
        if ($request->total_retention != null) {
            $retention = $request->total_retention;
        }

        $remission->user_id = current_user()->id;
        $remission->branch_id = current_user()->branch_id;
        $remission->customer_id = $request->customer_id;
        $remission->payment_form_id = $request->payment_form_id;
        $remission->payment_method_id = $request->payment_method_id[0];
        $remission->resolution_id = $resolutions->id;
        $remission->document_type_id = $documentType;
        $remission->document = $resolutions->prefix . $resolutions->consecutive;
        $remission->voucher_type_id = $voucherTypes->id;
        $remission->cash_register_id = cashRegisterComprobation()->id;
        $remission->status = 'active';
        $remission->note = $request->note;
        $remission->generation_date = $request->generation_date;
        $remission->due_date = $request->due_date;
        $remission->retention = $retention;
        $remission->total = $request->total;
        $remission->total_tax = $request->total_tax;
        $remission->total_pay = $total_pay;
        if ($totalpay > 0) {
            $remission->pay = $totalpay;
        } else {
            $remission->pay = 0;
        }
        $remission->balance = $total_pay - $totalpay;
        $remission->grand_total = $total_pay - $retention;
        $remission->update();

        $voucherTypes->consecutive += 1;
        $voucherTypes->update();

        //poner en cero los productos productRemission
        $productRemission = ProductRemission::where('remission_id', $remission->id)->get();

        for ($i=0; $i < count($productRemission); $i++) {

            $product = Product::findOrFail($productRemission[$i]->product_id);
            if (indicator()->inventory == 'on') {//si se maneja inventario
                $product->stock += $productRemission[$i]->quantity;
                $product->update();
                $branchProducts = BranchProduct::where('product_id', $product->id)->first();
                $branchProducts->stock += $productRemission[$i]->quantity;
                $branchProducts->update();

                $kardex = new Kardex();
                $kardex->branch_id = $branch;
                $kardex->voucher_type_id = $voucherTypes->id;
                $kardex->document = $remission->document;
                $kardex->quantity = $productRemission[$i]->quantity;
                $kardex->stock = $product->stock;
                $kardex->movement = $typeDocument;
                $product->kardexes()->save($kardex);
            }
            $productRemission[$i]->quantity = 0;
            $productRemission[$i]->price = 0;
            $productRemission[$i]->subtotal = 0;
            $productRemission[$i]->tax_subtotal = 0;
            $productRemission[$i]->update();
        }

        //poner en cero los productos productRemission

        $document = $remission;
        for ($i=0; $i < count($product_id); $i++) {

            $id = $product_id[$i];
            $productRemission = ProductRemission::where('remission_id', $remission->id)->where('product_id', $id)->first();


            if (isset($productRemission)) {
                //Actualiza el campo existente
                $productRemission->quantity = $quantity[$i];
                $productRemission->price = $price[$i];
                $productRemission->subtotal = $quantity[$i] * $price[$i];
                $productRemission->tax_subtotal =($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                $productRemission->update();
            } else {
                //Ingresa los productos que vienen en el array
                //Metodo para registrar la relacion entre producto y compra
                $productRemission = new ProductRemission();
                $productRemission->remission_id = $remission->id;
                $productRemission->product_id = $id;
                $productRemission->quantity = $quantity[$i];
                $productRemission->price = $price[$i];
                $productRemission->tax_rate = $tax_rate[$i];
                $productRemission->subtotal = $quantity[$i] * $price[$i];
                $productRemission->tax_subtotal =($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                $productRemission->save();
            }
            //selecciona el producto que viene del array
            $product = Product::findOrFail($id);
            //selecciona el producto de la sucursal que sea el mismo del array
            $branchProducts = BranchProduct::where('product_id', '=', $id)
            ->where('branch_id', '=', $branch)
            ->first();
            $quantityLocal = $quantity[$i];
            $voucherType = $voucherTypes->id;
            $this->inventoryInvoices($product, $branchProducts, $quantityLocal, $branch);//trait para actualizar inventario
            $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex
        }

        if (indicator()->pos == 'on') {
            //actualizar la caja
                $cashRegister->remission += $total_pay;
                $cashRegister->update();
        }
        if ($totalpay > 0) {
            pays($request, $document, $typeDocument);
        }
        if ($payNew > $total_pay) {
            $remission->pay = $total_pay;
            $remission->balance = 0;
            $remission->update();
        } else {
            $remission->pay = $payNew;
            $remission->balance = $total_pay - $payNew;
            $remission->update();
        }


        session()->forget('remission');
        session()->forget('typeDocument');
        session(['remission' => $remission->id]);
        session(['typeDocument' => $typeDocument]);
        toast('Remission Editada satisfactoriamente.','success');
        return redirect('remission');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Remission $remission)
    {
        //
    }

    public function invoiceRemission($id)
    {
        //dd($request->all());
        $remission = Remission::findOrFail($id);
        $pos = indicator()->pos;
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }

        $cols = 7;
        if (indicator()->work_labor == 'off') {
            $cols--;
        }
        $customers = Customer::get();
        $resolutions = Resolution::where('document_type_id', 1)->where('status', 'active')->get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::where('status', 'active')->get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $employees = Employee::get();
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
            ->where('bp.stock', '>=', 0)
            ->where('pro.status', '=', 'active')
            ->get();
        } else {
            $products = Product::from('products as pro')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.code', 'pro.stock', 'pro.sale_price', 'pro.name', 'cat.utility_rate', 'per.percentage', 'tt.id as tt')
            ->where('pro.stock', '>=', 0)
            ->where('pro.status', '=', 'active')
            ->get();
        }
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();
        $productRemissions = ProductRemission::from('product_remissions as pr')
        ->join('products as pro', 'pr.product_id', 'pro.id')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('pr.id', 'pr.quantity', 'pr.price', 'pr.tax_rate', 'pro.id as idP', 'pro.stock', 'pro.name', 'per.percentage', 'tt.id as tt')
        ->where('pr.remission_id', $remission->id)
        ->get();
        $type = 'invoice';
        $typeOperation = 'edition';
        return view('admin.productRemission.create',
        compact(
            'remission',
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
            'productRemissions',
            'type',
            'typeOperation',
            'cols'
        ));
    }

    public function invoicePosRemission($id)
    {
        //dd($request->all());
        $remission = Remission::findOrFail($id);
        //$pos = indicator()->pos;
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }

        $cols = 7;
        if (indicator()->work_labor == 'off') {
            $cols--;
        }
        $customers = Customer::get();
        $resolutions = Resolution::where('document_type_id', 15)->where('status', 'active')->get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::where('status', 'active')->get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $employees = Employee::get();
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
            ->where('bp.stock', '>=', 0)
            ->where('pro.status', '=', 'active')
            ->get();
        } else {
            $products = Product::from('products as pro')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.code', 'pro.stock', 'pro.sale_price', 'pro.name', 'cat.utility_rate', 'per.percentage', 'tt.id as tt')
            ->where('pro.stock', '>=', 0)
            ->where('pro.status', '=', 'active')
            ->get();
        }
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();
        $productRemissions = ProductRemission::from('product_remissions as pr')
        ->join('products as pro', 'pr.product_id', 'pro.id')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('pr.id', 'pr.quantity', 'pr.price', 'pr.tax_rate', 'pro.id as idP', 'pro.stock', 'pro.name', 'per.percentage', 'tt.id as tt')
        ->where('pr.remission_id', $remission->id)
        ->get();
        $type = 'pos';
        $typeOperation = 'edition';
        return view('admin.productRemission.create',
        compact(
            'remission',
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
            'productRemissions',
            'type',
            'typeOperation',
            'cols'
        ));
    }

    public function remissionPay($id)
    {
        if (cashRegisterComprobation() == null) {
            return redirect('branch');
        }
        $document = Remission::findOrFail($id);
        $banks = Bank::get();
        $paymentMethods = PaymentMethod::get();
        $cards = Card::get();
        $advances = Advance::where('status', '!=', 'applied')->where('advanceable_id', $document->third->id)->get();
        $tipeDocument = 'Remission';

        return view('admin.pay.create', compact(
            'document',
            'banks',
            'paymentMethods',
            'cards',
            'advances',
            'tipeDocument'
        ));
    }

    public function remissionPdf(Request $request, $id)
    {
        $remission = Remission::findOrFail($id);
        $productRemissions = ProductRemission::where('remission_id', $remission->id)->where('quantity', '>', 0)->get();
        $days = $remission->created_at->diffInDays($remission->due_date);
        $remissionPdf = $remission->document;
        //$logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.remission.pdf', compact(
            'remission',
            'days',
            'productRemissions'

        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$remissionPdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");*/
    }

    public function pdfDosRemission(Request $request)
   {
        $invoices = session('remission');
        $remission = Remission::findOrFail($invoices);
        session()->forget('remission');
        $productRemissions = ProductRemission::where('remission_id', $remission->id)->where('quantity', '>', 0)->get();
        $remissionPdf = $remission->document;
        $days = $remission->created_at->diffInDays($remission->due_date);
        $view = \view('admin.remission.pdf', compact(
            'remission',
            'days',
            'productRemissions'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('vista-pdf', "$remissionPdf.pdf");
   }

    public function remissionPos($id)
    {
        $remission = Remission::findOrFail($id);
        $productRemissions = ProductRemission::where('remission_id', $remission->id)->where('quantity', '>', 0)->get();
        $days = $remission->created_at->diffInDays($remission->due_date);
        $remissionPdf = $remission->document;
        $user = current_user()->name;
        $view = \view('admin.remission.pos', compact(
            'remission',
            'days',
            'productRemissions',
            'user'
        ))->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            //$pdf->setPaper('b7', 'portrait');
            $pdf->setPaper (array(0,0,226.76,1246.64), 'portrait');
            return $pdf->stream('vista-pdf', "$remissionPdf.pdf");
    }

    public function posRemission(Request $request)
    {
        $remissions = session('remission');
        $remission = Remission::findOrFail($remissions);
        $request->session()->forget('remission');
        $productRemissions = ProductRemission::where('remission_id', $remission->id)->where('quantity', '>', 0)->get();
        $days = $remission->created_at->diffInDays($remission->due_date);
        $remissionPdf = $remission->document;
        $user = current_user()->name;
        $paymentRemissionReturns = PaymentRemissionReturn::where('remission_id', $remission->id)->first();
        $view = \view('admin.remission.pos', compact(
            'remission',
            'days',
            'productRemissions',
            'paymentRemissionReturns',
            'user'
        ))->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            //$pdf->setPaper('b7', 'portrait');
            $pdf->setPaper (array(0,0,226.76,1246.64), 'portrait');
            return $pdf->stream('vista-pdf', "$remissionPdf.pdf");
    }

    public function getProductRemission(Request $request)
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

    public function getAdvance(Request $request, $id)
    {
        if($request)
        {
            $advances = Advance::where('type_third', 'customer')->where('advanceable_id', $id)->get();
            return response()->json($advances);
        }
    }

    public function posPdfRemission(Request $request, Remission $remission)
    {
        //Session::forget('newPrinter');
        $document = $remission;
        $typeDocument = 'remission';
        $title = '';
        $title = 'REMISION';

        $thirdPartyType = 'customer';
        $consecutive = $document->document;
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
        $pdf->SetTitle($remission->document);
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
        $barcodeCode = $barcodeGenerator->getBarcode($remission->id, $barcodeGenerator::TYPE_CODE_128);
        $barcode = "data:image/png;base64," . base64_encode($barcodeCode);

        $pdf->generateBarcode($barcode);
        $pdf->generateBranchInformation($document);
        $pdf->generateThirdPartyInformation($remission->third, $thirdPartyType);
        $pdf->generateProductsTable($document, $typeDocument);
        $pdf->generateSummaryInformation($document, $typeDocument);

        /*
        if (indicator()->dian == 'on') {
            $pdf->generateInvoiceInformation($document);
            $cufe =  $remission->invoiceResponse->cufe;
            $cufe =  'REMISION';
            //$url = 'https://catalogo-vpfe.dian.gov.co/document/searchqr?documentkey=';
            $data = [
                'NumFac' => $remission->document,
                'FecFac' => $remission->created_at->format('Y-m-d'),
                'NitFac' => company()->nit,
                'DocAdq' => $remission->third->identification,
                'ValFac' => $remission->total,
                'ValIva' => $remission->total_tax,
                'ValOtroIm' => '0.00',
                'ValTotal' => $remission->total_pay,
                'CUFE' => $cufe,
                'URL' => $cufe,
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
        }*/


        $refund = formatText("*** Para realizar un reclamo o devolución debe de presentar este ticket ***");
        $pdf->generateDisclaimerInformation($refund);

        $pdf->footer();

        $pdf->Output("I", $remission->document . ".pdf", true);
        exit;
    }

    public function pdfRemission(Request $request, Remission $remission) {
        //Session::forget('newPrinter');
        $typeDocument = 'remission';
        $title = 'REMISION';

        $document = $remission;
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
        $pdf->SetTitle($remission->document);
        $pdf->SetAutoPageBreak(false);
        $pdf->addPage();

        //$pdf->generateInvoiceInformation($document);
        $cufe =  'remission';
        //$url = '#';
        $data = [
            'NumFac' => $remission->document,
            'FecFac' => $remission->created_at->format('Y-m-d'),
            'NitFac' => company()->nit,
            'DocAdq' => $remission->third->identification,
            'ValFac' => $remission->total,
            'ValIva' => $remission->total_tax,
            'ValOtroIm' => '0.00',
            'ValTotal' => $remission->total_pay,
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


        $pdf->generateHeader($logo, $width, $height, $title, $remission);
        $pdf->generateInformation($remission->third, $thirdPartyType, $document, $qrImage);
        $pdf->generateTablePdf($document, $typeDocument);
        $pdf->generateTotals($document, $typeDocument);
        $pdf->footer($document, $cufe);
        $pdf->documentInformation($document, $cufe);
        $pdf->footer();
        //$pdf->generateHeader($logo, $width, $height);
        //$refund = formatText("*** Para realizar un reclamo o devolución debe de presentar este ticket ***");
        //$pdf->generateDisclaimerInformation($refund);

        $pdf->Output("I", $remission->document . ".pdf", true);
        exit;
    }
}
