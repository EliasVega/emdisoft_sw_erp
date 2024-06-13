<?php

namespace App\Http\Controllers;

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
use App\Models\PaymentForm;
use App\Models\PaymentMethod;
use App\Models\paymentReturn;
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
use Illuminate\Support\Facades\Redirect;

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
        /*
        if ($indicator->pos == 'off') {
            $typeDocument = 'document';
        } else {
            $typeDocument = 'pos';
        }*/
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
                    return $remission->status == 'active' ? 'Orden de Venta' : 'Facturado';
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
        $type = 'pos';
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
        $customer = $request->customer_id;
        if (is_null($customer)) {
            return Redirect::back()->withErrors(['msg' => 'no selecionaste el cliente']);
        }
        $typeDocument = 'remission';
        $documentType = 107;
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

        //asignando pago para pos activo
        if (indicator()->pos == 'on'  && $paymentForm == 1) {
            $totalpay = $request->total_pay;
        } else if(indicator()->pos == 'on'  && $paymentForm == 2){
            $totalpay = 0;
        } else {
            $totalpay = $request->totalpay;
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
        if ($totalpay > 0) {
            $remission->pay = $totalpay;
        } else {
            $remission->pay = 0;
        }
        $remission->balance = $total_pay - $totalpay;
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
        if ($totalpay > 0) {
            pays($request, $document, $typeDocument);
        }
        $resolutions->consecutive += 1;
        $resolutions->update();

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
        $typeDocument = 'remission';
        $documentType = 107;
        $resolutions = Resolution::findOrFail(14);
        $voucherTypes = VoucherType::findOrFail(25);

        //datos para hacer reversiones
        $cashRegister = cashRegisterComprobation();
        $date1 = Carbon::now()->toDateString();
        $date2 = Remission::find($remission->id)->created_at->toDateString();
        $reverse = $request->reverse;//1 si desea volver valor a caja 2 si desea crear un avance
        $remissionPayments = $request->remission_payments;
        $payNew = $request->total_pay;
        $surplusPayments = (($payNew - $remissionPayments) *(-1));
        $totalPayRemission = $remissionPayments + $totalpay;

        //salida de efectivo de caja
        if (indicator()->pos == 'on') {
            if ($remissionPayments > $payNew) {
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
                            $cashRegister->remission -= $advancePay;
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
        if ($totalPayRemission > $payNew) {
            $remission->pay = $total_pay;
            $remission->balance = 0;
            $remission->update();
        } else {
            $remission->pay = $remissionPayments;
            $remission->balance = $payNew - $remissionPayments;
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

    public function pdfRemission(Request $request)
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
        $paymentReturns = paymentReturn::where('remission_id', $remission->id)->first();
        $view = \view('admin.remission.pos', compact(
            'remission',
            'days',
            'productRemissions',
            'paymentReturns',
            'user'
        ))->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            //$pdf->setPaper('b7', 'portrait');
            $pdf->setPaper (array(0,0,226.76,1246.64), 'portrait');
            return $pdf->stream('vista-pdf', "$remissionPdf.pdf");
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
}
