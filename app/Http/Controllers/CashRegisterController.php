<?php

namespace App\Http\Controllers;

use App\Models\CashRegister;
use App\Http\Requests\StoreCashRegisterRequest;
use App\Http\Requests\UpdateCashRegisterRequest;
use App\Models\Advance;
use App\Models\Branch;
use App\Models\CashInflow;
use App\Models\CashOutflow;
use App\Models\Company;
use App\Models\Expense;
use App\Models\ExpenseProduct;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Ncinvoice;
use App\Models\Ncpurchase;
use App\Models\Ndinvoice;
use App\Models\Ndpurchase;
use App\Models\NdpurchaseProduct;
use App\Models\Pay;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Purchase;
use App\Models\PurchaseOrder;
use App\Models\RestaurantOrder;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class CashRegisterController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:cashRegister.index|cashRegister.create|cashRegister.show|cashRegister.edit', ['only'=>['index']]);
        $this->middleware('permission:cashRegister.create', ['only'=>['create','store']]);
        $this->middleware('permission:cashRegister.show', ['only'=>['show']]);
        $this->middleware('permission:cashRegister.edit', ['only'=>['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user()->role_id;

        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las cajas a admin y superadmin
                $cashRegisters = CashRegister::get();
            } else {
                //Consulta para mostrar Cajas de los demas roles
                $cashRegisters = CashRegister::where('user_id', $users->id)->get();
            }
            return DataTables::of($cashRegisters)
            ->addIndexColumn()
            ->addColumn('user', function (CashRegister $cashRegister) {
                return $cashRegister->user->name;
            })
            ->addColumn('branch', function (CashRegister $cashRegister) {
                return $cashRegister->branch->name;
            })
            ->addColumn('total', function (CashRegister $cashRegister) {
                return $cashRegister->cash_in_total - $cashRegister->cash_out_total;
            })
            ->addColumn('status', function (CashRegister $cashRegister) {
                return $cashRegister->status == 'open' ? 'Abierta' : 'Cerrada';
            })
            ->editColumn('created_at', function(CashRegister $cashRegister){
                return $cashRegister->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/cash_register/actions')
            ->rawcolumns(['btn'])
            ->make(true);
        }
        return view('admin.cash_register.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('id', '!=', 1)->get();
        $branches = Branch::get();

        return view("admin.cash_register.create", compact('users', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCashRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashRegisterRequest $request)
    {
        $user = Auth::user();
        $branch = $user->branch_id;
        $open = $request->user_open_id;
        $code = $request->verification_code_open;
        $verificationCode = VerificationCode::select('id', 'code')->where('user_id', '=', $open)->first();
        $openCashRegister = CashRegister::where('user_id', '=', $user->id)->where('status', '=', 'open')->first();

        if($verificationCode == null){
            toast( 'Usuario No autorizado para ejercer como administrador','warning');
            return redirect("cashRegister");
        }

        if ($verificationCode->code != $code) {
            toast( 'Error en codigo de verificacion','warning');
            return redirect("cashRegister");
        } elseif($openCashRegister) {
            toast( 'Usuario ya tiene una Caja Abierta','warning');
            return redirect("cashRegister");
        } else {
            $cashRegister = new CashRegister();
            $cashRegister->cash_initial = $request->cash_initial;
            $cashRegister->in_cash = 0;
            $cashRegister->out_cash = 0;
            $cashRegister->in_total = 0;
            $cashRegister->out_total = 0;
            $cashRegister->cash_in_total = $request->cash_initial;
            $cashRegister->cash_out_total = 0;
            $cashRegister->invoice_order = 0;
            $cashRegister->restaurant_order = 0;
            $cashRegister->in_invoice_cash = 0;
            $cashRegister->in_invoice = 0;
            $cashRegister->invoice = 0;
            $cashRegister->in_advance_cash = 0;
            $cashRegister->in_advance = 0;
            $cashRegister->ndinvoice = 0;
            $cashRegister->ndpurchase = 0;
            $cashRegister->ncpurchase = 0;
            $cashRegister->ncinvoice = 0;
            $cashRegister->purchase_order = 0;
            $cashRegister->out_purchase_cash = 0;
            $cashRegister->out_purchase = 0;
            $cashRegister->purchase = 0;
            $cashRegister->out_expense_cash = 0;
            $cashRegister->out_expense = 0;
            $cashRegister->expense = 0;
            $cashRegister->out_advance_cash = 0;
            $cashRegister->out_advance = 0;
            $cashRegister->verification_code_open  = $request->verification_code_open;
            $cashRegister->verification_code_close = null;
            $cashRegister->branch_id = $branch;
            $cashRegister->user_id = $user->id;
            $cashRegister->user_open_id = $request->user_open_id;
            $cashRegister->user_close_id = $request->user_close_id;
            $cashRegister->save();
        }
        Alert::success('Caja','Creada Satisfactoriamente.');
        return redirect("cashRegister");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashRegister  $cashRegister
     * @return \Illuminate\Http\Response
     */
    public function show(CashRegister $cashRegister)
    {
        //dd(current_user());
        $user = current_user()->roles->pluck('name', 'name')->all();
        $cashRegister = CashRegister::findOrFail($cashRegister->user_id);
        $from = $cashRegister->created_at;
        $to = $cashRegister->updated_at;

        if ($user == 'superAdmin' || $user == 'admin') {
            $invoiceProducts = [];
            $cont = 0;
            $products = Product::all();
            foreach ($products as $key => $product ) {
                $invoiceProduct = InvoiceProduct::from('invoice_products as ip')
                ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
                ->join('products as pro', 'ip.product_id', 'pro.id')
                ->whereBetween('ip.created_at', [$from, $to])
                ->where('inv.user_id', $cashRegister->user_id)
                ->where('ip.product_id', $product->id)
                ->sum('quantity');

                $taxSubtotal = InvoiceProduct::from('invoice_products as ip')
                ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
                ->join('products as pro', 'ip.product_id', 'pro.id')
                ->whereBetween('ip.created_at', [$from, $to])
                ->where('inv.user_id', $cashRegister->user_id)
                ->where('ip.product_id', $product->id)
                ->sum('tax_subtotal');

                if ($invoiceProduct) {
                    $invoiceProduts[$cont] = Product::findOrFail($product->id);
                    $invoiceProduts[$cont]->stock = $invoiceProduct;
                    $invoiceProduts[$cont]->price = $taxSubtotal;
                    $cont++;
                }
            }

            $productpurchases = [];
            $cont = 0;
            foreach ($products as $key => $product ) {
                $productPurchase = ProductPurchase::from('product_purchases as pp')
                ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
                ->join('products as pro', 'pp.product_id', 'pro.id')
                ->whereBetween('pp.created_at', [$from, $to])
                ->where('pur.user_id', $cashRegister->user_id)
                ->where('pp.product_id', $product->id)
                ->sum('quantity');

                $taxSubtotal = ProductPurchase::from('product_purchases as pp')
                ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
                ->join('products as pro', 'pp.product_id', 'pro.id')
                ->whereBetween('pp.created_at', [$from, $to])
                ->where('pur.user_id', $cashRegister->user_id)
                ->where('pp.product_id', $product->id)
                ->sum('tax_subtotal');

                if ($productPurchase) {
                    $productPurchase[$cont] = Product::findOrFail($product->id);
                    $productPurchase[$cont]->stock = $productPurchase;
                    $productPurchase[$cont]->price = $taxSubtotal;
                    $cont++;
                }
            }

            $expenseProducts = [];
            $cont = 0;
            foreach ($products as $key => $product ) {
                $expenseProduct = ExpenseProduct::from('expense_products as ep')
                ->join('expenses as exp', 'ep.expense_id', 'exp.id')
                ->join('products as pro', 'ep.product_id', 'pro.id')
                ->whereBetween('ep.created_at', [$from, $to])
                ->where('exp.user_id', current_user()->id)
                ->where('ep.product_id', $product->id)
                ->sum('quantity');

                $tax_subtotal = ProductPurchase::from('expense_products as ep')
                ->join('expenses as exp', 'ep.expense_id', 'exp.id')
                ->join('products as pro', 'ep.product_id', 'pro.id')
                ->whereBetween('ep.created_at', [$from, $to])
                ->where('exp.user_id', current_user()->id)
                ->where('ep.product_id', $product->id)
                ->sum('tax_subtotal');

                if ($expenseProduct) {
                    $expenseProducts[$cont] = Product::findOrFail($product->id);
                    $expenseProducts[$cont]->stock = $expenseProduct;
                    $expenseProducts[$cont]->price = $tax_subtotal;
                    $cont++;
                }
            }
            $purchases = Purchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $purchaseBalance = Purchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('balance');
            $purchasePay = Purchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');
            /*
            $expenses = Expense::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $expbalance = Expense::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('balance');
            $exppay =  Expense::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');
            *//*
            $ncinvoices = Ncinvoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $ncipay =  Ncinvoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');
            *//*
            $ndinvoices = Ndinvoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $ndipay = Ndinvoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');
            */
            $ncpurchases = Ncpurchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
            //$ncppay =  Ncinvoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

            $ndpurchases = Ndpurchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
            //$ndppay = Ndinvoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');
            /*
            $pay_orders = Pay_order::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $sum_pay_orders = Pay_order::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('pay');
            *//*
            $pay_invoices = Pay_invoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $sum_pay_invoices = Pay_invoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('pay');
            */
            $payPurchases = Pay::where('user_id', $cashRegister->user_id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->get();
            $sumPayPurchases = Pay::where('user_id', $cashRegister->user_id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->sum('pay');
            /*
            $pay_expenses = Pay_expense::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $sum_pay_expenses = Pay_expense::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('pay');
            */
            $advanceProviders = Advance::where('user_id', $cashRegister->user_id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->get();
            $sumAdvancesProvider = Advance::where('user_id', $cashRegister->user_id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->sum('pay');

            $advanceCustomers = Advance::where('user_id', $cashRegister->user_id)->where('type_third', 'customer')->whereBetween('created_at', [$from, $to])->get();
            $sumAdvanceCustomer = Advance::where('user_id', $cashRegister->user_id)->where('type_third', 'customer')->whereBetween('created_at', [$from, $to])->sum('pay');

            $advanceEmployees = Advance::where('user_id', $cashRegister->user_id)->where('type_third', 'employee')->whereBetween('created_at', [$from, $to])->get();
            $sumAdvanceEmployee = Advance::where('user_id', $cashRegister->user_id)->where('type_third', 'employee')->whereBetween('created_at', [$from, $to])->sum('pay');

            $cashOutflows = CashOutflow::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $sumCashOutflow = CashOutflow::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('cash');
            /*
            $cashOutflow = CashOutflow::from('cash_outflows AS cas')
            ->join('cashregisteres AS sai', 'cas.cashregister_id', 'sai.id')
            ->join('users AS use', 'cas.user_id', 'use.id')
            ->join('users AS usa', 'cas.admin_id', 'usa.id')
            ->select('cas.id', 'cas.payment', 'cas.created_at', 'usa.name')
            ->where('cas.user_id', '=', $user->id)
            ->whereBetween('cas.created_at', [$from, $to])
            ->get();*/

            $cashInflows = CashInflow::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $sumCashInflow = CashInflow::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('cash_in_total');
            /*
            $cashInflow = CashInflow::from('cash_ins AS cas')
            ->join('cashregisteres AS sal', 'cas.cashregister_id', 'sal.id')
            ->join('users AS use', 'cas.user_id', 'use.id')
            ->join('users AS usa', 'cas.admin_id', 'usa.id')
            ->select('cas.id', 'cas.payment', 'cas.created_at', 'usa.name')
            ->where('cas.user_id', '=', $user->id)
            ->whereBetween('cas.created_at', [$from, $to])
            ->get();*/
        } else {
            $invoiceProducts = [];
            $cont = 0;
            $products = Product::all();
            foreach ($products as $key => $product ) {
                $invoiceProduct = InvoiceProduct::from('invoice_products as ip')
                ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
                ->join('products as pro', 'ip.product_id', 'pro.id')
                ->whereBetween('ip.created_at', [$from, $to])
                ->where('inv.user_id', current_user()->id)
                ->where('ip.product_id', $product->id)
                ->sum('quantity');

                $taxSubtotal = InvoiceProduct::from('invoice_products as ip')
                ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
                ->join('products as pro', 'ip.product_id', 'pro.id')
                ->whereBetween('ip.created_at', [$from, $to])
                ->where('inv.user_id', current_user()->id)
                ->where('ip.product_id', $product->id)
                ->sum('tax_subtotal');

                if ($invoiceProduct) {
                    $producInvoices[$cont] = Product::findOrFail($product->id);
                    $producInvoices[$cont]->stock = $invoiceProduct;
                    $producInvoices[$cont]->price = $taxSubtotal;
                    $cont++;
                }
            }

            $productPurchases = [];
            $cont = 0;
            foreach ($products as $key => $product ) {
                $productPurchase = ProductPurchase::from('product_purchases as pp')
                ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
                ->join('products as pro', 'pp.product_id', 'pro.id')
                ->whereBetween('pp.created_at', [$from, $to])
                ->where('pur.user_id', current_user()->id)
                ->where('pp.product_id', $product->id)
                ->sum('quantity');

                $tax_subtotal = ProductPurchase::from('product_purchases as pp')
                ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
                ->join('products as pro', 'pp.product_id', 'pro.id')
                ->whereBetween('pp.created_at', [$from, $to])
                ->where('pur.user_id', current_user()->id)
                ->where('pp.product_id', $product->id)
                ->sum('tax_subtotal');

                if ($productPurchase) {
                    $productPurchases[$cont] = Product::findOrFail($product->id);
                    $productPurchases[$cont]->stock = $productPurchase;
                    $productPurchases[$cont]->price = $tax_subtotal;
                    $cont++;
                }
            }

            $expenseProducts = [];
            $cont = 0;
            foreach ($products as $key => $product ) {
                $expenseProduct = ExpenseProduct::from('expense_products as ep')
                ->join('expenses as exp', 'ep.expense_id', 'exp.id')
                ->join('products as pro', 'ep.product_id', 'pro.id')
                ->whereBetween('ep.created_at', [$from, $to])
                ->where('exp.user_id', current_user()->id)
                ->where('ep.product_id', $product->id)
                ->sum('quantity');

                $tax_subtotal = ProductPurchase::from('expense_products as ep')
                ->join('expenses as exp', 'ep.expense_id', 'exp.id')
                ->join('products as pro', 'ep.product_id', 'pro.id')
                ->whereBetween('ep.created_at', [$from, $to])
                ->where('exp.user_id', current_user()->id)
                ->where('ep.product_id', $product->id)
                ->sum('tax_subtotal');

                if ($expenseProduct) {
                    $expenseProducts[$cont] = Product::findOrFail($product->id);
                    $expenseProducts[$cont]->stock = $expenseProduct;
                    $expenseProducts[$cont]->price = $tax_subtotal;
                    $cont++;
                }
            }

            $purchases = Purchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
            $purchaseBalance = Purchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('balance');
            $purchasePays = Purchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('pay');

            $purchaseOrders = PurchaseOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();

            $invoices = Invoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
            $invoiceBalance = Invoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('balance');
            $invoicePays = Invoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('pay');

            $restaurantOrders = RestaurantOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();

            $expenses = Expense::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
            $expenseBalance = Expense::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('balance');
            $expensePays =  Expense::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

            $ncpurchases = Ncpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
            $ncpurchaseTotal =  Ncpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

            $ndpurchases = Ndpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
            $ndpurchaseTotal = Ndpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

            $ncinvoices = Ncinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
            $ncinvoiceTotal =  Ncinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

            $ndinvoices = Ndinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
            $ndinvoiceTotal = Ndinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

            $payPurchases = Pay::where('user_id', current_user()->id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->get();
            $sumPayPurchases = Pay::where('user_id', current_user()->id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->sum('pay');

            $payInvoices = Pay::where('user_id', current_user()->id)->where('type', 'invoice')->whereBetween('created_at', [$from, $to])->get();
            $sumPayInvoices = Pay::where('user_id', current_user()->id)->where('type', 'invoice')->whereBetween('created_at', [$from, $to])->sum('pay');

            $payExpenses = Pay::where('user_id', current_user()->id)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->get();
            $sumPayExpenses = Pay::where('user_id', current_user()->id)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->sum('pay');

            $advanceProviders = Advance::where('user_id', current_user()->id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->get();
            $sumAdvanceProvider = Advance::where('user_id', current_user()->id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->sum('pay');

            $advanceCustomers = Advance::where('user_id', current_user()->id)->where('type_third', 'customer')->whereBetween('created_at', [$from, $to])->get();
            $sumAdvanceCustomer = Advance::where('user_id', current_user()->id)->where('type_third', 'customer')->whereBetween('created_at', [$from, $to])->sum('pay');

            $advanceEmployees = Advance::where('user_id', current_user()->id)->where('type_third', 'employee')->whereBetween('created_at', [$from, $to])->get();
            $sumAdvanceEmployee = Advance::where('user_id', current_user()->id)->where('type_third', 'employee')->whereBetween('created_at', [$from, $to])->sum('pay');

            $cashOutflows = CashOutflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
            $sumCashOutflow = CashOutflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('cash');
            $cashInflows = CashInflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
            $sumCashInflow = CashInflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('cash');
        }

        return view('admin.cash_register.show', compact(
            'cashRegister',
            'productPurchases',
            'invoiceProducts',
            'expenseProducts',

            'purchases',
            'purchaseBalance',
            'purchasePays',

            'purchaseOrders',

            'invoices',
            'invoiceBalance',
            'invoicePays',

            'restaurantOrders',

            'expenses',
            'expenseBalance',
            'expensePays',

            'ncpurchases',
            'ncpurchaseTotal',
            'ndpurchases',
            'ndpurchaseTotal',

            'ncinvoices',
            'ncinvoiceTotal',
            'ndinvoices',
            'ndinvoiceTotal',

            'payPurchases',
            'sumPayPurchases',

            'payInvoices',
            'sumPayInvoices',

            'payExpenses',
            'sumPayExpenses',

            'advanceProviders',
            'sumAdvanceProvider',

            'advanceCustomers',
            'sumAdvanceCustomer',

            'advanceEmployees',
            'sumAdvanceEmployee',

            'cashOutflows',
            'sumCashOutflow',

            'cashInflows',
            'sumCashInflow'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashRegister  $cashRegister
     * @return \Illuminate\Http\Response
     */
    public function edit(CashRegister $cashRegister)
    {
        $users = User::where('id', '!=', 1)->get();
        return view('admin.cash_register.edit', compact('cashRegister', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashRegisterRequest  $request
     * @param  \App\Models\CashRegister  $cashRegister
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashRegisterRequest $request, CashRegister $cashRegister)
    {
        $userClose = $request->user_close_id;
        $verific = $request->verification_code_close;
        $verificationCode = VerificationCode::where('user_id', '=', $userClose)->first();

        if($verificationCode == null){
            return redirect("cashRegister")->with('warning', 'Usuario No autorizado para ejercer como administrador');
        }

        if ($verificationCode->code != $verific) {
            return redirect("cashRegister")->with('warning', 'Error en codigo de verificacion');
        } elseif ($cashRegister->status == 'close') {
            return redirect("cashRegister")->with('warning', 'Esta caja ya fue cerrada Anteriormente');
        } else {
            $cashRegister->user_close_id = $userClose;
            $cashRegister->verification_code_close = $verific;
            $cashRegister->status = 'close';
            $cashRegister->update();
        }
        return redirect("cashRegister")->with('success', 'Caja cerrada Satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashRegister  $cashRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashRegister $cashRegister)
    {
        //
    }

    //funcion para registrar una Salida de efectivo de la caja
    public function show_cashOutflow( $id)
    {
        $cashRegister = CashRegister::findOrFail($id);
        if($cashRegister->status == 'close'){
            toast('Esta Caja ya esta cerrada.','warning');
            return redirect("cashRegister");
        }

        Session::put('cashRegister', $cashRegister->user_id, 60 * 24 * 365);
        Session::put('branch', $cashRegister->branch_id, 60 * 24 * 365);
        Session::put('user', $cashRegister->user_id, 60 * 24 * 365);

        $users = User::where('id', '!=', 1)->get();
        $cashRegisters = CashRegister::where('user_id', '=', Auth::user()->id)->where('status', '=', 'open')->first();

        return view("admin.cash_outflow.create", compact('users', 'cashRegister'));
    }

    //funcion para registrar una recarga a la caja de efectivo
    public function show_cashInflow( $id)
    {
        $cashRegister = CashRegister::findOrFail($id);
        if($cashRegister->status == 'close'){
            return redirect("cashRegister")->with('warning', 'Esta Caja ya esta cerrada');
        }

        Session::put('cashRegister', $cashRegister->user_id, 60 * 24 * 365);
        Session::put('branch', $cashRegister->branch_id, 60 * 24 * 365);
        Session::put('user', $cashRegister->user_id, 60 * 24 * 365);

        $users = User::where('id', '!=', 1)->get();
        $cashRegisters = CashRegister::where('user_id', '=', Auth::user()->id)->where('status', '=', 'open')->first();

        return view("admin.cash_inflow.create", compact('users', 'cashRegister'));
    }

    //funcion para ver el cierre de caja de la caja
    public function cashRegisterClose($id)
    {
        $user     = Auth::user();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $cashRegister = CashRegister::findOrFail($id);
        $from     = $cashRegister->created_at;
        $to       = $cashRegister->updated_at;

        $produc = [];
        $cont = 0;
        $products = Product::all();
        /*
        foreach ($products as $key => $product ) {
            $invoice_products = Invoice_product::from('invoice_products as ip')
            ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
            ->join('products as pro', 'ip.product_id', 'pro.id')
            ->select('pro.id', 'pro.name', 'ip.quantity', 'ip.ivasubt', 'ip.subtotal', 'ip.created_at')
            ->whereBetween('ip.created_at', [$from, $to])
            ->where('inv.user_id', $cashregister->user_id)
            ->where('ip.product_id', $product->id)
            ->sum('quantity');

            $ivai = Invoice_product::from('invoice_products as ip')
            ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
            ->join('products as pro', 'ip.product_id', 'pro.id')
            ->select('pro.id', 'pro.name', 'ip.quantity', 'ip.ivasubt', 'ip.subtotal', 'ip.created_at')
            ->whereBetween('ip.created_at', [$from, $to])
            ->where('inv.user_id', $cashregister->user_id)
            ->where('ip.product_id', $product->id)
            ->sum('ivasubt');

            if ($invoice_products) {
                $producInvoice[$cont] = Product::findOrFail($product->id);
                $producInvoice[$cont]->stock = $invoice_products;
                $producInvoice[$cont]->price = $ivai;
                $cont++;
            }
        }*/

        $productPurchases = [];
        $cont = 0;
        foreach ($products as $key => $product ) {
            $quantity = ProductPurchase::from('product_purchases as pp')
            ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
            ->join('products as pro', 'pp.product_id', 'pro.id')
            ->whereBetween('pp.created_at', [$from, $to])
            ->where('pur.user_id', $cashRegister->user_id)
            ->where('pp.product_id', $product->id)
            ->sum('quantity');

            $tax_subtotal = ProductPurchase::from('product_purchases as pp')
            ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
            ->join('products as pro', 'pp.product_id', 'pro.id')
            ->whereBetween('pp.created_at', [$from, $to])
            ->where('pur.user_id', $cashRegister->user_id)
            ->where('pp.product_id', $product->id)
            ->sum('tax_subtotal');

            $subtotal = ProductPurchase::from('product_purchases as pp')
            ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
            ->join('products as pro', 'pp.product_id', 'pro.id')
            ->whereBetween('pp.created_at', [$from, $to])
            ->where('pur.user_id', $cashRegister->user_id)
            ->where('pp.product_id', $product->id)
            ->sum('subtotal');

            if ($quantity) {
                $productPurchases[$cont] = Product::findOrFail($product->id);
                $productPurchases[$cont]->quantity = $quantity;
                $productPurchases[$cont]->tax_subtotal = $tax_subtotal;
                $productPurchases[$cont]->subtotal = $subtotal;
                $cont++;
            }
        }
        $invoiceProducts = [];
        $cont = 0;
        foreach ($products as $key => $product ) {
            $quantity = InvoiceProduct::from('invoice_products as ip')
            ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
            ->join('products as pro', 'ip.product_id', 'pro.id')
            ->whereBetween('ip.created_at', [$from, $to])
            ->where('inv.user_id', $cashRegister->user_id)
            ->where('ip.product_id', $product->id)
            ->sum('quantity');

            $tax_subtotal = InvoiceProduct::from('invoice_products as ip')
            ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
            ->join('products as pro', 'ip.product_id', 'pro.id')
            ->whereBetween('ip.created_at', [$from, $to])
            ->where('inv.user_id', $cashRegister->user_id)
            ->where('ip.product_id', $product->id)
            ->sum('tax_subtotal');

            $subtotal = InvoiceProduct::from('invoice_products as ip')
            ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
            ->join('products as pro', 'ip.product_id', 'pro.id')
            ->whereBetween('ip.created_at', [$from, $to])
            ->where('inv.user_id', $cashRegister->user_id)
            ->where('ip.product_id', $product->id)
            ->sum('subtotal');

            if ($quantity) {
                $invoiceProducts[$cont] = Product::findOrFail($product->id);
                $invoiceProducts[$cont]->quantity = $quantity;
                $invoiceProducts[$cont]->tax_subtotal = $tax_subtotal;
                $invoiceProducts[$cont]->subtotal = $subtotal;
                $cont++;
            }
        }
        $expenseProducts = [];
        $cont = 0;
        foreach ($products as $key => $product ) {
            $quantity = ExpenseProduct::from('expense_products as ep')
            ->join('expenses as exp', 'ep.expense_id', 'exp.id')
            ->join('products as pro', 'ep.product_id', 'pro.id')
            ->whereBetween('ep.created_at', [$from, $to])
            ->where('exp.user_id', $cashRegister->user_id)
            ->where('ep.product_id', $product->id)
            ->sum('quantity');

            $tax_subtotal = ExpenseProduct::from('expense_products as ep')
            ->join('expenses as exp', 'ep.expense_id', 'exp.id')
            ->join('products as pro', 'ep.product_id', 'pro.id')
            ->whereBetween('ep.created_at', [$from, $to])
            ->where('exp.user_id', $cashRegister->user_id)
            ->where('ep.product_id', $product->id)
            ->sum('tax_subtotal');

            $subtotal = ExpenseProduct::from('expense_products as ep')
            ->join('expenses as exp', 'ep.expense_id', 'exp.id')
            ->join('products as pro', 'ep.product_id', 'pro.id')
            ->whereBetween('ep.created_at', [$from, $to])
            ->where('exp.user_id', $cashRegister->user_id)
            ->where('ep.product_id', $product->id)
            ->sum('subtotal');

            if ($quantity) {
                $expenseProducts[$cont] = Product::findOrFail($product->id);
                $expenseProducts[$cont]->quantity = $quantity;
                $expenseProducts[$cont]->tax_subtotal = $tax_subtotal;
                $expenseProducts[$cont]->subtotal = $subtotal;
                $cont++;
            }
        }
        $ndpurchaseProducts = [];
        $cont = 0;
        foreach ($products as $key => $product ) {
            $quantity = NdpurchaseProduct::from('ndpurchase_products as np')
            ->join('ndpurchases as nd', 'np.ndpurchase_id', 'nd.id')
            ->join('products as pro', 'np.product_id', 'pro.id')
            ->whereBetween('np.created_at', [$from, $to])
            ->where('nd.user_id', $cashRegister->user_id)
            ->where('np.product_id', $product->id)
            ->sum('quantity');

            $tax_subtotal = NdpurchaseProduct::from('ndpurchase_products as np')
            ->join('ndpurchases as nd', 'np.ndpurchase_id', 'nd.id')
            ->join('products as pro', 'np.product_id', 'pro.id')
            ->whereBetween('np.created_at', [$from, $to])
            ->where('nd.user_id', $cashRegister->user_id)
            ->where('np.product_id', $product->id)
            ->sum('tax_subtotal');

            $subtotal = NdpurchaseProduct::from('ndpurchase_products as np')
            ->join('ndpurchases as nd', 'np.ndpurchase_id', 'nd.id')
            ->join('products as pro', 'np.product_id', 'pro.id')
            ->whereBetween('np.created_at', [$from, $to])
            ->where('nd.user_id', $cashRegister->user_id)
            ->where('np.product_id', $product->id)
            ->sum('subtotal');

            if ($quantity) {
                $ndpurchaseProducts[$cont] = Product::findOrFail($product->id);
                $ndpurchaseProducts[$cont]->quantity = $quantity;
                $ndpurchaseProducts[$cont]->tax_subtotal = $tax_subtotal;
                $ndpurchaseProducts[$cont]->subtotal = $subtotal;
                $cont++;
            }
        }
        /*
        $sumtotal = Invoice_product::from('invoice_products as ip')
        ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
        ->select('ip.subtotal', 'ip.created_at')
        ->where('inv.user_id', $cashRegister->user_id)
        ->whereBetween('ip.created_at', [$from, $to])
        ->sum('subtotal');*/
        /*
        $iva_subtotal = Invoice_product::from('invoice_products as ip')
        ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
        ->select('ip.subtotal', 'ip.created_at')
        ->where('inv.user_id', $cashRegister->user_id)
        ->whereBetween('ip.created_at', [$from, $to])
        ->sum('ivasubt');*/

        //$invoices = Invoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        //$invbalance = Invoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('balance');
        //$invpay = Invoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');
        //$pay_invoices = Pay_invoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        //$sum_pay_invoices = Pay_invoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');

        //$orders = Order::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        //$ordbalance = Order::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('balance');
        //$ordpay = Order::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');
        //$pay_orders = Pay_order::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        //$sum_pay_orders = Pay_order::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');

        $purchases = Purchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $purchaseBalances = Purchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('balance');
        $purchaseTotalTaxs = Purchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_tax');
        $purchaseTotals = Purchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total');
        $purchaseTotalPays = Purchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $purchasePays = Pay::where('user_id', $cashRegister->user_id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->get();
        $purchaseSumPays = Pay::where('user_id', $cashRegister->user_id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->sum('pay');

        $invoices = Invoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $invoiceBalances = Invoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('balance');
        $invoiceTotalTaxs = Invoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_tax');
        $invoiceTotals = Invoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total');
        $invoiceTotalPays = Invoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $invoicePays = Pay::where('user_id', $cashRegister->user_id)->where('type', 'invoice')->whereBetween('created_at', [$from, $to])->get();
        $invoiceSumPays = Pay::where('user_id', $cashRegister->user_id)->where('type', 'invoice')->whereBetween('created_at', [$from, $to])->sum('pay');

        $expenses = Expense::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $expenseBalances = Expense::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('balance');
        $expenseTotalTaxs = Expense::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_tax');
        $expenseTotals = Expense::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total');
        $expenseTotalPays = Expense::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $expensePays = Pay::where('user_id', $cashRegister->user_id)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->get();
        $expenseSumPays = Pay::where('user_id', $cashRegister->user_id)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->sum('pay');

        //$ncinvoices = Ncinvoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        //$totalnc = Ncinvoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        //$ndinvoices = Ndinvoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        //$totalnd = Ndinvoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $ncpurchases = Ncpurchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $sumNcpurchases = Ncpurchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $ndpurchases = Ndpurchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $sumNdpurchases = Ndpurchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');
        $ndpurchaseTotalTaxs = Ndpurchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_tax');
        $ndpurchaseTotals = Ndpurchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total');

        $ncinvoices = Ncinvoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $sumNcinvoices = Ncinvoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');
        $ncinvoiceTotalTaxs = Ncinvoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_tax');
        $ncinvoiceTotals = Ncinvoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total');

        $ndinvoices = Ndpurchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $sumNdinvoices = Ndpurchase::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $cashInflows = CashInflow::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $sumCashInflows = CashInflow::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('cash');

        $cashOutflows = CashOutflow::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $sumCashOutflows = CashOutflow::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('cash');

        $advanceProviders = Advance::where('user_id', $cashRegister->user_id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->get();
        $sumAdvanceProviders = Advance::where('user_id', $cashRegister->user_id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->sum('pay');

        $advanceCustomers = Advance::where('user_id', $cashRegister->user_id)->where('type_third', 'customer')->whereBetween('created_at', [$from, $to])->get();
        $sumAdvanceCustomers = Advance::where('user_id', $cashRegister->user_id)->where('type_third', 'customer')->whereBetween('created_at', [$from, $to])->sum('pay');

        $advanceEmployees = Advance::where('user_id', $cashRegister->user_id)->where('type_third', 'employee')->whereBetween('created_at', [$from, $to])->get();
        $sumAdvanceEmployees = Advance::where('user_id', $cashRegister->user_id)->where('type_third', 'employee')->whereBetween('created_at', [$from, $to])->sum('pay');



        return view('admin.cash_register.cashRegisterClose', compact(
            'cashRegister',
            'productPurchases',
            'invoiceProducts',
            'expenseProducts',
            'ndpurchaseProducts',

            'purchases',
            'purchaseBalances',
            'purchaseTotalTaxs',
            'purchaseTotals',
            'purchaseTotalPays',
            'purchasePays',
            'purchaseSumPays',

            'invoices',
            'invoiceBalances',
            'invoiceTotalTaxs',
            'invoiceTotals',
            'invoiceTotalPays',
            'invoicePays',
            'invoiceSumPays',

            'expenses',
            'expenseBalances',
            'expenseTotalTaxs',
            'expenseTotals',
            'expenseTotalPays',
            'expensePays',
            'expenseSumPays',

            'ncpurchases',
            'sumNcpurchases',
            'ndpurchases',
            'sumNdpurchases',
            'ndpurchaseTotalTaxs',
            'ndpurchaseTotals',

            'ndinvoices',
            'sumNdinvoices',
            'ncinvoices',
            'sumNcinvoices',
            'ncinvoiceTotalTaxs',
            'ncinvoiceTotals',

            'cashInflows',
            'sumCashInflows',
            'cashOutflows',
            'sumCashOutflows',
            'advanceProviders',
            'sumAdvanceProviders',
            'advanceCustomers',
            'sumAdvanceCustomers',
            'advanceEmployees',
            'sumAdvanceEmployees',
        ));
    }

     //funcion para ver el cierre de caja de la caja
     public function cashRegisterPos($id)
     {
        $userRole = current_user()->roles->pluck('name', 'name')->all();
        $cashRegister = CashRegister::findOrFail($id);
        $from     = $cashRegister->created_at;
        $to       = $cashRegister->updated_at;

        $produc = [];
        $cont = 0;
        $products = Product::all();

        $productPurchases = [];
        $contPurchase = 0;
        foreach ($products as $key => $product ) {
            $quantity = ProductPurchase::from('product_purchases as pp')
            ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
            ->join('products as pro', 'pp.product_id', 'pro.id')
            ->whereBetween('pp.created_at', [$from, $to])
            ->where('pur.user_id', current_user()->id)
            ->where('pp.product_id', $product->id)
            ->sum('quantity');

            $taxSubtotal = ProductPurchase::from('product_purchases as pp')
            ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
            ->join('products as pro', 'pp.product_id', 'pro.id')
            ->whereBetween('pp.created_at', [$from, $to])
            ->where('pur.user_id', current_user()->id)
            ->where('pp.product_id', $product->id)
            ->sum('tax_subtotal');

            $subtotal = ProductPurchase::from('product_purchases as pp')
            ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
            ->join('products as pro', 'pp.product_id', 'pro.id')
            ->whereBetween('pp.created_at', [$from, $to])
            ->where('pur.user_id', current_user()->id)
            ->where('pp.product_id', $product->id)
            ->sum('subtotal');

            if ($quantity) {
                $productPurchases[$contPurchase] = Product::findOrFail($product->id);
                $productPurchases[$contPurchase]->quantity = $quantity;
                $productPurchases[$contPurchase]->tax_subtotal = $taxSubtotal;
                $productPurchases[$contPurchase]->subtotal = $subtotal;
                $contPurchase++;
            }
        }

        $invoiceProducts = [];
        $contInvoice = 0;
        foreach ($products as $key => $product ) {
            $quantity = InvoiceProduct::from('invoice_products as ip')
            ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
            ->join('products as pro', 'ip.product_id', 'pro.id')
            ->whereBetween('ip.created_at', [$from, $to])
            ->where('inv.user_id', current_user()->id)
            ->where('ip.product_id', $product->id)
            ->sum('quantity');

            $taxSubtotal = InvoiceProduct::from('invoice_products as ip')
            ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
            ->join('products as pro', 'ip.product_id', 'pro.id')
            ->whereBetween('ip.created_at', [$from, $to])
            ->where('inv.user_id', current_user()->id)
            ->where('ip.product_id', $product->id)
            ->sum('tax_subtotal');

            $subtotal = InvoiceProduct::from('invoice_products as ip')
            ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
            ->join('products as pro', 'ip.product_id', 'pro.id')
            ->whereBetween('ip.created_at', [$from, $to])
            ->where('inv.user_id', current_user()->id)
            ->where('ip.product_id', $product->id)
            ->sum('subtotal');

            if ($quantity) {
                $invoiceProducts[$contInvoice] = Product::findOrFail($product->id);
                $invoiceProducts[$contInvoice]->quantity = $quantity;
                $invoiceProducts[$contInvoice]->tax_subtotal = $taxSubtotal;
                $invoiceProducts[$contInvoice]->subtotal = $subtotal;
                $contInvoice++;
            }
        }

        $expenseProducts = [];
        $contExpense = 0;
        foreach ($products as $key => $product ) {
            $quantity = ExpenseProduct::from('expense_products as ep')
            ->join('expenses as exp', 'ep.expense_id', 'exp.id')
            ->join('products as pro', 'ep.product_id', 'pro.id')
            ->whereBetween('ep.created_at', [$from, $to])
            ->where('exp.user_id', current_user()->id)
            ->where('ep.product_id', $product->id)
            ->sum('quantity');

            $taxSubtotal = ExpenseProduct::from('expense_products as ep')
            ->join('expenses as exp', 'ep.expense_id', 'exp.id')
            ->join('products as pro', 'ep.product_id', 'pro.id')
            ->whereBetween('ep.created_at', [$from, $to])
            ->where('exp.user_id', current_user()->id)
            ->where('ep.product_id', $product->id)
            ->sum('tax_subtotal');

            $subtotal = ExpenseProduct::from('expense_products as ep')
            ->join('expenses as exp', 'ep.expense_id', 'exp.id')
            ->join('products as pro', 'ep.product_id', 'pro.id')
            ->whereBetween('ep.created_at', [$from, $to])
            ->where('exp.user_id', current_user()->id)
            ->where('ep.product_id', $product->id)
            ->sum('subtotal');

            if ($quantity) {
                $expenseProducts[$contInvoice] = Product::findOrFail($product->id);
                $expenseProducts[$contInvoice]->quantity = $quantity;
                $expenseProducts[$contInvoice]->tax_subtotal = $taxSubtotal;
                $expenseProducts[$contInvoice]->subtotal = $subtotal;
                $contInvoice++;
            }
        }

        $purchases = Purchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();

        $invoices = Invoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();

        $expenses = Expense::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();

        $purchasePays = Pay::where('user_id', current_user()->id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->get();
        $purchaseSumPays = Pay::where('user_id', current_user()->id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->sum('pay');

        $invoicePays = Pay::where('user_id', current_user()->id)->where('type', 'invoice')->whereBetween('created_at', [$from, $to])->get();
        $invoiceSumPays = Pay::where('user_id', current_user()->id)->where('type', 'invoice')->whereBetween('created_at', [$from, $to])->sum('pay');

        $expensePays = Pay::where('user_id', current_user()->id)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->get();
        $expenseSumPays = Pay::where('user_id', current_user()->id)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->sum('pay');

        $ncpurchases = Ncpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumNcpurchases = Ncpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $ndpurchases = Ndpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumNdpurchases = Ndpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $ncinvoices = Ncinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumNcinvoices = Ncinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $ndinvoices = Ndinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumNdinvoices = Ndinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $purchaseOrders = PurchaseOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumPurchaseOrders = PurchaseOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $restaurantOrders = RestaurantOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumRestaurantOrders = RestaurantOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $cashInflows = CashInflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumCashInflows = CashInflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('cash');

        $cashOutflows = CashOutflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumCashOutflows = CashOutflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('cash');

        $advanceProviders = Advance::where('user_id', current_user()->id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->get();
        $sumAdvanceProviders = Advance::where('user_id', current_user()->id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->sum('pay');

        $advanceCustomers = Advance::where('user_id', current_user()->id)->where('type_third', 'customer')->whereBetween('created_at', [$from, $to])->get();
        $sumAdvanceCustomers = Advance::where('user_id', current_user()->id)->where('type_third', 'customer')->whereBetween('created_at', [$from, $to])->sum('pay');

        $advanceEmployees = Advance::where('user_id', current_user()->id)->where('type_third', 'employee')->whereBetween('created_at', [$from, $to])->get();
        $sumAdvanceEmployees = Advance::where('user_id', current_user()->id)->where('type_third', 'employee')->whereBetween('created_at', [$from, $to])->sum('pay');

        $company = Company::findOrFail(1);
        $view = \view('admin.cash_register.cashRegisterPos', compact(
            'company',
            'cashRegister',
            'productPurchases',
            'invoiceProducts',
            'expenseProducts',

            'purchases',
            'invoices',
            'expenses',

            'purchasePays',
            'purchaseSumPays',

            'invoicePays',
            'invoiceSumPays',

            'expensePays',
            'expenseSumPays',

            'ncpurchases',
            'sumNcpurchases',
            'ndpurchases',
            'sumNdpurchases',

            'ncinvoices',
            'sumNcinvoices',
            'ndinvoices',
            'sumNdinvoices',

            'purchaseOrders',
            'sumPurchaseOrders',
            'restaurantOrders',
            'sumRestaurantOrders',

            'cashInflows',
            'sumCashInflows',

            'cashOutflows',
            'sumCashOutflows',

            'advanceProviders',
            'sumAdvanceProviders',
            'advanceCustomers',
            'sumAdvanceCustomers',
            'advanceEmployees',
            'sumAdvanceEmployees'
        ))->render();

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            $pdf->setPaper (array(0,0,226.76,497.64));

            return $pdf->stream('reporte_caja.pdf');
            /*
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            $pdf->setPaper (array(0,0,226.76,497.64));

            return $pdf->stream('reporte_caja.pdf');

            $data = PDF::loadView('vista-pdf', $data)
            ->save(storage_path('app/public/') . 'archivo.pdf');*/
     }



    public function show_posters($id)
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $cashRegister = CashRegister::findOrFail($id);
        $from = $cashRegister->created_at;
        $to = $cashRegister->updated_at;

        /*if ($users->role_id == 1 || $users->role_id == 2) {
            $produc = [];
            $cont = 0;
            $products = Product::all();
            foreach ($products as $key => $product ) {
                $invoice_products = Invoice_product::from('invoice_products as ip')
                ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
                ->join('products as pro', 'ip.product_id', 'pro.id')
                ->select('pro.id', 'pro.name', 'ip.quantity', 'ip.ivasubt', 'ip.subtotal', 'ip.created_at')
                ->whereBetween('ip.created_at', [$from, $to])
                ->where('inv.user_id', $cashregister->user_id)
                ->where('ip.product_id', $product->id)
                ->sum('quantity');

                $ivai = Invoice_product::from('invoice_products as ip')
                ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
                ->join('products as pro', 'ip.product_id', 'pro.id')
                ->select('pro.id', 'pro.name', 'ip.quantity', 'ip.ivasubt', 'ip.subtotal', 'ip.created_at')
                ->whereBetween('ip.created_at', [$from, $to])
                ->where('inv.user_id', $cashregister->user_id)
                ->where('ip.product_id', $product->id)
                ->sum('ivasubt');

                if ($invoice_products) {
                    $produc[$cont] = Product::findOrFail($product->id);
                    $produc[$cont]->stock = $invoice_products;
                    $produc[$cont]->price = $ivai;
                    $cont++;
                }
            }

            $productpurc = [];
            $cont = 0;
            //$products = Product::all();
            foreach ($products as $key => $product ) {
                $product_purchases = Product_purchase::from('product_purchases as pp')
                ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
                ->join('products as pro', 'pp.product_id', 'pro.id')
                ->select('pro.id', 'pro.name', 'pp.quantity', 'pp.ivasubt', 'pp.subtotal', 'pp.created_at')
                ->whereBetween('pp.created_at', [$from, $to])
                ->where('pur.user_id', $cashregister->user_id)
                ->where('pp.product_id', $product->id)
                ->sum('quantity');

                $ivap = Product_purchase::from('product_purchases as pp')
                ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
                ->join('products as pro', 'pp.product_id', 'pro.id')
                ->select('pro.id', 'pro.name', 'pp.quantity', 'pp.ivasubt', 'pp.subtotal', 'pp.created_at')
                ->whereBetween('pp.created_at', [$from, $to])
                ->where('pur.user_id', $cashregister->user_id)
                ->where('pp.product_id', $product->id)
                ->sum('ivasubt');

                if ($product_purchases) {
                    $productpurc[$cont] = Product::findOrFail($product->id);
                    $productpurc[$cont]->stock = $product_purchases;
                    $productpurc[$cont]->price = $ivap;
                    $cont++;
                }
            }

            $invoices = Invoice::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $invbalance = Invoice::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('balance');
            $invpay = Invoice::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');

            $orders = Order::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $ordbalance = Order::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('balance');
            $ordpay = Order::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');

            $purchases = Purchase::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $purbalance = Purchase::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('balance');
            $purpay = Purchase::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');

            $expenses = Expense::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();

            $ncinvoices = Ncinvoice::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $ncipay =  Ncinvoice::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

            $ndinvoices = Ndinvoice::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $ndipay = Ndinvoice::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

            $pay_orders = Pay_order::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $sum_pay_orders = Pay_order::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');

            $pay_invoices = Pay_invoice::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $sum_pay_invoices = Pay_invoice::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');

            $pay_purchases = Pay_purchase::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $sum_pay_purchases = Pay_purchase::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');

            $pay_expenses = Pay_expense::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $sum_pay_expenses = Pay_expense::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');

            $payments = Payment::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $sum_payments = Payment::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');

            $advances = Advance::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $sum_advances = Advance::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('pay');

            //$cash_outs = Cash_out::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->get();
            $sum_pay_cashs = Cash_out::where('user_id', $cashregister->user_id)->whereBetween('created_at', [$from, $to])->sum('payment');
            $cash_outs = Cash_out::from('cash_outs AS cas')
            ->join('cashregisteres AS sai', 'cas.cashregister_id', 'sai.id')
            ->join('users AS use', 'cas.user_id', 'use.id')
            ->join('users AS usa', 'cas.admin_id', 'usa.id')
            ->select('cas.id', 'cas.payment', 'cas.created_at', 'usa.name')
            ->where('cas.user_id', '=', $cashregister->user_id)
            ->whereBetween('cas.created_at', [$from, $to])
            ->get();
        } else {*/
            /*
            $invoiceProduct = [];
            $cont = 0;
            $products = Product::all();

            foreach ($products as $key => $product ) {

                $invoice_products = Invoice_product::from('invoice_products as ip')
                ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
                ->join('products as pro', 'ip.product_id', 'pro.id')
                ->select('pro.id', 'pro.name', 'ip.quantity', 'ip.ivasubt', 'ip.subtotal', 'ip.created_at')
                ->whereBetween('ip.created_at', [$from, $to])
                ->where('inv.user_id', $cashregister->user_id)
                ->where('ip.product_id', $product->id)
                ->sum('quantity');

                $ivai = Invoice_product::from('invoice_products as ip')
                ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
                ->join('products as pro', 'ip.product_id', 'pro.id')
                ->select('pro.id', 'pro.name', 'ip.quantity', 'ip.ivasubt', 'ip.subtotal', 'ip.created_at')
                ->whereBetween('ip.created_at', [$from, $to])
                ->where('inv.user_id', $cashregister->user_id)
                ->where('ip.product_id', $product->id)
                ->sum('ivasubt');

                $total = Invoice_product::from('invoice_products as ip')
                ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
                ->join('products as pro', 'ip.product_id', 'pro.id')
                ->select('pro.id', 'pro.name', 'ip.quantity', 'ip.ivasubt', 'ip.subtotal', 'ip.created_at')
                ->whereBetween('ip.created_at', [$from, $to])
                ->where('inv.user_id', $cashregister->user_id)
                ->where('ip.product_id', $product->id)
                ->sum('subtotal');

                if ($invoice_products) {
                    $invoiceProduct[$cont] = Product::findOrFail($product->id);
                    $invoiceProduct[$cont]->stock = $invoice_products;
                    $invoiceProduct[$cont]->price = $ivai;
                    $invoiceProduct[$cont]->sale_price = $total;
                    $cont++;
                }
            }*/

            $productPurchases = [];
            $cont = 0;
            $products = Product::all();


            foreach ($products as $key => $product ) {
                $productPurchase = ProductPurchase::from('product_purchases as pp')
                ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
                ->join('products as pro', 'pp.product_id', 'pro.id')
                ->select('pro.id', 'pro.name', 'pp.quantity', 'pp.ivasubt', 'pp.subtotal', 'pp.created_at')
                ->whereBetween('pp.created_at', [$from, $to])
                ->where('pur.user_id', $user->id)
                ->where('pp.product_id', $product->id)
                ->sum('quantity');

                $total_iva = ProductPurchase::from('product_purchases as pp')
                ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
                ->join('products as pro', 'pp.product_id', 'pro.id')
                ->select('pro.id', 'pro.name', 'pp.quantity', 'pp.ivasubt', 'pp.subtotal', 'pp.created_at')
                ->whereBetween('pp.created_at', [$from, $to])
                ->where('pur.user_id', $user->id)
                ->where('pp.product_id', $product->id)
                ->sum('iva_subtotal');

                $total = ProductPurchase::from('product_purchases as pp')
                ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
                ->join('products as pro', 'pp.product_id', 'pro.id')
                ->select('pro.id', 'pro.name', 'pp.quantity', 'pp.ivasubt', 'pp.subtotal', 'pp.created_at')
                ->whereBetween('pp.created_at', [$from, $to])
                ->where('pur.user_id', $user->id)
                ->where('pp.product_id', $product->id)
                ->sum('subtotal');

                if ($productPurchase) {
                    $productpurchases[$cont] = Product::findOrFail($product->id);
                    $productpurchases[$cont]->stock = $productPurchase;
                    $productpurchases[$cont]->price = $total_iva;
                    $productpurchases[$cont]->sale_price = $total;
                    $cont++;
                }
            }
            //dd($productpurc);
            /*
            $invoices = Invoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $invTotalPay = Invoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');*/
            //$invbalance = Invoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('balance');
            //$invpay = Invoice::where('user_id', $user)->whereBetween('created_at', [$from, $to])->sum('pay');
            /*
            $orders = Order::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $ordTotalPay = Order::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');*/
            //$ordbalance = Order::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('balance');
            //$ordpay = Order::where('user_id', $user)->whereBetween('created_at', [$from, $to])->sum('pay');

            $purchases = Purchase::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $purchaseTotalPay = Purchase::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');
            //$purbalance = Purchase::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('balance');
            //$purpay = Purchase::where('user_id', $user)->whereBetween('created_at', [$from, $to])->sum('pay');
            /*
            $expenses = Expense::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $expTotalPay = Expense::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');*/
            /*
            $ncinvoices = Ncinvoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $ncipay =  Ncinvoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');*/
            /*
            $ndinvoices = Ndinvoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $ndipay = Ndinvoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');*/
            /*
            $pay_orders = Pay_order::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $sum_pay_orders = Pay_order::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('pay');

            $pay_invoices = Pay_invoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $sum_pay_invoices = Pay_invoice::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('pay');*/

            $payPurchases = Pay::where('user_id', $user->id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->get();
            $sum_payPurchases = Pay::where('user_id', $user->id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->sum('pay');
            /*
            $pay_expenses = Pay_expense::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $sum_pay_expenses = Pay_expense::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('pay');*/

            $advanceProviders = Advance::where('user_id', $user->id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->get();
            $sum_advanceProviders = Advance::where('user_id', $user->id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->sum('pay');

            $advanceCustomers = Advance::where('user_id', $user->id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->get();
            $sum_advanceCustomers = Advance::where('user_id', $user->id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->sum('pay');

            $advanceEmployees = Advance::where('user_id', $user->id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->get();
            $sum_advanceEmployees = Advance::where('user_id', $user->id)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->sum('pay');

            $cashInflows = CashOutflow::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $sum_cashInflows = CashOutflow::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('cash');

            $cashOutflows = CashOutflow::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $sum_cashOutflows = CashOutflow::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('cash');

            /*
            $cashOuts = Cash_out::from('cash_outs AS cas')
            ->join('cashregisteres AS sai', 'cas.cashregister_id', 'sai.id')
            ->join('users AS use', 'cas.user_id', 'use.id')
            ->join('users AS usa', 'cas.admin_id', 'usa.id')
            ->select('cas.id', 'cas.payment', 'cas.created_at', 'usa.name')
            ->where('cas.user_id', '=', $user->id)
            ->whereBetween('cas.created_at', [$from, $to])
            ->get();

            $sum_cash_ins = Cash_in::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->sum('payment');
            $cashIns = Cash_in::from('cash_ins AS cas')
            ->join('cashregisteres AS sai', 'cas.cashregister_id', 'sai.id')
            ->join('users AS use', 'cas.user_id', 'use.id')
            ->join('users AS usa', 'cas.admin_id', 'usa.id')
            ->select('cas.id', 'cas.payment', 'cas.created_at', 'usa.name')
            ->where('cas.user_id', '=', $user->id)
            ->whereBetween('cas.created_at', [$from, $to])
            ->get();*/
        //}

        $view = \view('admin.cash_register.show_pos', compact(
            'cashRegister',
            'productPurchases',
            'purchases',
            'purchaseTotalPay',
            'payPurchases',
            'sum_payPurchases',
            'advanceProviders',
            'sum_advanceProviders',
            'advanceCustomers',
            'sum_advanceCustomers',
            'advanceEmployees',
            'sum_advanceEmployees',
            'cashInflows',
            'sum_cashInflows',
            'cashOutflows',
            'sum_cashOutflows',
            ))->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,497.64));

        return $pdf->stream('reporte_caja.pdf');
        /*
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,497.64));

        return $pdf->stream('reporte_caja.pdf');

        $data = PDF::loadView('vista-pdf', $data)
        ->save(storage_path('app/public/') . 'archivo.pdf');*/
    }
}
