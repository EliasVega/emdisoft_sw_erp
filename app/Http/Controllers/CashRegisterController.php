<?php

namespace App\Http\Controllers;

use App\Helpers\Tickets\TicketCashRegister;
use App\Models\CashRegister;
use App\Http\Requests\StoreCashRegisterRequest;
use App\Http\Requests\UpdateCashRegisterRequest;
use App\Models\Advance;
use App\Models\CashInflow;
use App\Models\CashOutflow;
use App\Models\Company;
use App\Models\Expense;
use App\Models\ExpenseProduct;
use App\Models\Invoice;
use App\Models\InvoiceOrder;
use App\Models\InvoiceProduct;
use App\Models\Ncinvoice;
use App\Models\NcinvoiceProduct;
use App\Models\Ncpurchase;
use App\Models\NcpurchaseProduct;
use App\Models\Ndinvoice;
use App\Models\Ndpurchase;
use App\Models\NdpurchaseProduct;
use App\Models\Pay;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\ProductRemission;
use App\Models\Purchase;
use App\Models\PurchaseOrder;
use App\Models\Remission;
use App\Models\RestaurantOrder;
use App\Models\SalePoint;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

use function App\Helpers\Tickets\ticketHeightCashRegister;

class CashRegisterController extends Controller
{
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
            if ($user == 'superAdmin' || $user == 'admin') {
                //Consulta para mostrar todas las cajas a admin y superadmin
                //$cashRegisters = CashRegister::get();
                $cashRegisters = CashRegister::where('id', '!=', 1)->get();
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
                    return $cashRegister->salePoint->branch->name;
                })
                ->addColumn('total', function (CashRegister $cashRegister) {
                    return $cashRegister->cash_in_total - $cashRegister->cash_out_total;
                })
                ->addColumn('status', function (CashRegister $cashRegister) {
                    return $cashRegister->status == 'open' ? 'Abierta' : 'Cerrada';
                })
                ->editColumn('created_at', function (CashRegister $cashRegister) {
                    return $cashRegister->created_at->format('Y-m-d: h:m');
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
        $salePoints = SalePoint::get();
        $points = 0;
        if (count($salePoints) == 1) {
            $points = 1;
        }
        return view("admin.cash_register.create", compact('users', 'salePoints', 'points'));
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
        $open = $request->user_open_id;
        $code = $request->verification_code_open;
        $verificationCode = VerificationCode::select('id', 'code')->where('user_id', '=', $open)->first();
        $openCashRegister = CashRegister::where('user_id', '=', $user->id)->where('status', '=', 'open')->first();

        if ($verificationCode == null) {
            toast('Usuario No autorizado para ejercer como administrador', 'warning');
            return redirect("cashRegister");
        }

        if ($verificationCode->code != $code) {
            toast('Error en codigo de verificacion', 'warning');
            return redirect("cashRegister");
        } elseif ($openCashRegister) {
            toast('Usuario ya tiene una Caja Abierta', 'warning');
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
            $cashRegister->in_remission_cash = 0;
            $cashRegister->in_remission = 0;
            $cashRegister->remission = 0;
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
            $cashRegister->start_date = $request->start_date;
            $cashRegister->end_date = null;
            $cashRegister->sale_point_id = $request->sale_point_id;
            $cashRegister->user_id = $user->id;
            $cashRegister->user_open_id = $request->user_open_id;
            $cashRegister->user_close_id = $request->user_close_id;
            $cashRegister->save();
        }
        Alert::success('Caja', 'Creada Satisfactoriamente.');
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
        $from = $cashRegister->created_at;
        $to = $cashRegister->updated_at;

        if ($user == 'superAdmin' || $user == 'admin') {
            $userId = User::findOrFail($cashRegister->user_id);
        } else {
            $userId = current_user()->id;
        }


        $invoiceProducts = [];
        $cont = 0;
        $products = Product::all();
        foreach ($products as $key => $product) {
            $invoiceProduct = InvoiceProduct::from('invoice_products as ip')
                ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
                ->join('products as pro', 'ip.product_id', 'pro.id')
                ->whereBetween('ip.created_at', [$from, $to])
                ->where('inv.user_id', $userId)
                ->where('ip.product_id', $product->id)
                ->sum('quantity');

            $taxSubtotal = InvoiceProduct::from('invoice_products as ip')
                ->join('invoices as inv', 'ip.invoice_id', 'inv.id')
                ->join('products as pro', 'ip.product_id', 'pro.id')
                ->whereBetween('ip.created_at', [$from, $to])
                ->where('inv.user_id', $userId)
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
        foreach ($products as $key => $product) {
            $productPurchase = ProductPurchase::from('product_purchases as pp')
                ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
                ->join('products as pro', 'pp.product_id', 'pro.id')
                ->whereBetween('pp.created_at', [$from, $to])
                ->where('pur.user_id', $userId)
                ->where('pp.product_id', $product->id)
                ->sum('quantity');

            $tax_subtotal = ProductPurchase::from('product_purchases as pp')
                ->join('purchases as pur', 'pp.purchase_id', 'pur.id')
                ->join('products as pro', 'pp.product_id', 'pro.id')
                ->whereBetween('pp.created_at', [$from, $to])
                ->where('pur.user_id', $userId)
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
        foreach ($products as $key => $product) {
            $expenseProduct = ExpenseProduct::from('expense_products as ep')
                ->join('expenses as exp', 'ep.expense_id', 'exp.id')
                ->join('products as pro', 'ep.product_id', 'pro.id')
                ->whereBetween('ep.created_at', [$from, $to])
                ->where('exp.user_id', $userId)
                ->where('ep.product_id', $product->id)
                ->sum('quantity');

            $tax_subtotal = ExpenseProduct::from('expense_products as ep')
                ->join('expenses as exp', 'ep.expense_id', 'exp.id')
                ->join('products as pro', 'ep.product_id', 'pro.id')
                ->whereBetween('ep.created_at', [$from, $to])
                ->where('exp.user_id', $userId)
                ->where('ep.product_id', $product->id)
                ->sum('tax_subtotal');

            if ($expenseProduct) {
                $expenseProducts[$cont] = Product::findOrFail($product->id);
                $expenseProducts[$cont]->stock = $expenseProduct;
                $expenseProducts[$cont]->price = $tax_subtotal;
                $cont++;
            }
        }

        $productRemissions = [];
        $cont = 0;
        foreach ($products as $key => $product) {
            $productRemission = ProductRemission::from('product_remissions as pr')
                ->join('remissions as rem', 'pr.remission_id', 'rem.id')
                ->join('products as pro', 'pr.product_id', 'pro.id')
                ->whereBetween('pr.created_at', [$from, $to])
                ->where('rem.user_id', $userId)
                ->where('pr.product_id', $product->id)
                ->sum('quantity');

            $tax_subtotal = ProductRemission::from('product_remissions as pr')
                ->join('remissions as rem', 'pr.remission_id', 'rem.id')
                ->join('products as pro', 'pr.product_id', 'pro.id')
                ->whereBetween('pr.created_at', [$from, $to])
                ->where('rem.user_id', $userId)
                ->where('pr.product_id', $product->id)
                ->sum('tax_subtotal');
            if ($productRemission) {
                $productRemissions[$cont] = Product::findOrFail($product->id);
                $productRemissions[$cont]->stock = $productRemission;
                $productRemissions[$cont]->price = $tax_subtotal;
                $cont++;
            }
        }
        $purchases = Purchase::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->get();
        $purchaseBalance = Purchase::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('balance');
        $purchasePays = Purchase::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('pay');

        $purchaseOrders = PurchaseOrder::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->get();

        $invoices = Invoice::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->get();
        $invoiceBalance = Invoice::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('balance');
        $invoicePays = Invoice::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('pay');

        $invoiceOrders = InvoiceOrder::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->get();
        $restaurantOrders = RestaurantOrder::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->get();

        $remissions = Remission::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->get();
        $remissionBalance = Remission::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('balance');
        $remissionPays = Remission::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('pay');

        $expenses = Expense::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->get();
        $expenseBalance = Expense::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('balance');
        $expensePays =  Expense::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $ncpurchases = Ncpurchase::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->get();
        $ncpurchaseTotal =  Ncpurchase::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $ndpurchases = Ndpurchase::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->get();
        $ndpurchaseTotal = Ndpurchase::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $ncinvoices = Ncinvoice::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->get();
        $ncinvoiceTotal =  Ncinvoice::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $ndinvoices = Ndinvoice::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->get();
        $ndinvoiceTotal = Ndinvoice::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $payPurchases = Pay::where('user_id', $userId)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->get();
        $sumPayPurchases = Pay::where('user_id', $userId)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->sum('pay');

        $payInvoices = Pay::where('user_id', $userId)->where('type', 'invoice')->whereBetween('created_at', [$from, $to])->get();
        $sumPayInvoices = Pay::where('user_id', $userId)->where('type', 'invoice')->whereBetween('created_at', [$from, $to])->sum('pay');

        $payRemissions = Pay::where('user_id', $userId)->where('type', 'remission')->whereBetween('created_at', [$from, $to])->get();
        $sumPayRemissions = Pay::where('user_id', $userId)->where('type', 'remission')->whereBetween('created_at', [$from, $to])->sum('pay');

        $payExpenses = Pay::where('user_id', $userId)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->get();
        $sumPayExpenses = Pay::where('user_id', $userId)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->sum('pay');

        $advanceProviders = Advance::where('user_id', $userId)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->get();
        $sumAdvanceProvider = Advance::where('user_id', $userId)->where('type_third', 'provider')->whereBetween('created_at', [$from, $to])->sum('pay');

        $advanceCustomers = Advance::where('user_id', $userId)->where('type_third', 'customer')->whereBetween('created_at', [$from, $to])->get();
        $sumAdvanceCustomer = Advance::where('user_id', $userId)->where('type_third', 'customer')->whereBetween('created_at', [$from, $to])->sum('pay');

        $advanceEmployees = Advance::where('user_id', $userId)->where('type_third', 'employee')->whereBetween('created_at', [$from, $to])->get();
        $sumAdvanceEmployee = Advance::where('user_id', $userId)->where('type_third', 'employee')->whereBetween('created_at', [$from, $to])->sum('pay');

        $cashOutflows = CashOutflow::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->get();
        $sumCashOutflow = CashOutflow::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('cash');
        $cashInflows = CashInflow::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->get();
        $sumCashInflow = CashInflow::where('user_id', $userId)->whereBetween('created_at', [$from, $to])->sum('cash');

        return view('admin.cash_register.show', compact(
            'cashRegister',
            'productPurchases',
            'invoiceProducts',
            'expenseProducts',
            'productRemissions',

            'purchases',
            'purchaseBalance',
            'purchasePays',

            'purchaseOrders',

            'invoices',
            'invoiceBalance',
            'invoicePays',

            'invoiceOrders',
            'restaurantOrders',

            'remissions',
            'remissionBalance',
            'remissionPays',

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

            'payRemissions',
            'sumPayRemissions',

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
        if ($cashRegister->status == 'close') {
            toast('Esta caja ya se encuentra cerrada.','warning');
            return redirect("cashRegister");
        }
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

        if ($verificationCode == null) {
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
            $cashRegister->end_date = $request->end_date;
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
    public function show_cashOutflow($id)
    {
        $cashRegister = CashRegister::findOrFail($id);
        if ($cashRegister->status == 'close') {
            toast('Esta Caja ya esta cerrada.', 'warning');
            return redirect("cashRegister");
        }

        Session::put('cashRegister', $cashRegister->user_id, 60 * 24 * 365);
        Session::put('salePoint', $cashRegister->sale_point_id, 60 * 24 * 365);
        Session::put('user', $cashRegister->user_id, 60 * 24 * 365);

        $users = User::where('id', '!=', 1)->get();
        $cashRegisters = CashRegister::where('user_id', '=', Auth::user()->id)->where('status', '=', 'open')->first();

        return view("admin.cash_outflow.create", compact('users', 'cashRegister'));
    }

    //funcion para registrar una recarga a la caja de efectivo
    public function show_cashInflow($id)
    {
        $cashRegister = CashRegister::findOrFail($id);
        if ($cashRegister->status == 'close') {
            return redirect("cashRegister")->with('warning', 'Esta Caja ya esta cerrada');
        }

        Session::put('cashRegister', $cashRegister->user_id, 60 * 24 * 365);
        Session::put('salePoint', $cashRegister->sale_point_id, 60 * 24 * 365);
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

        $productPurchases = [];
        $cont = 0;
        foreach ($products as $key => $product) {
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
        foreach ($products as $key => $product) {
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

        $productRemissions = [];
        $cont = 0;
        foreach ($products as $key => $product) {
            $quantity = ProductRemission::from('product_remissions as pr')
                ->join('remissions as rem', 'pr.remission_id', 'rem.id')
                ->join('products as pro', 'pr.product_id', 'pro.id')
                ->whereBetween('pr.created_at', [$from, $to])
                ->where('rem.user_id', $cashRegister->user_id)
                ->where('pr.product_id', $product->id)
                ->sum('quantity');

            $tax_subtotal = ProductRemission::from('product_remissions as pr')
                ->join('remissions as rem', 'pr.remission_id', 'rem.id')
                ->join('products as pro', 'pr.product_id', 'pro.id')
                ->whereBetween('pr.created_at', [$from, $to])
                ->where('rem.user_id', $cashRegister->user_id)
                ->where('pr.product_id', $product->id)
                ->sum('tax_subtotal');

            $subtotal = ProductRemission::from('product_remissions as pr')
                ->join('remissions as rem', 'pr.remission_id', 'rem.id')
                ->join('products as pro', 'pr.product_id', 'pro.id')
                ->whereBetween('pr.created_at', [$from, $to])
                ->where('rem.user_id', $cashRegister->user_id)
                ->where('pr.product_id', $product->id)
                ->sum('subtotal');

            if ($quantity) {
                $productRemissions[$cont] = Product::findOrFail($product->id);
                $productRemissions[$cont]->quantity = $quantity;
                $productRemissions[$cont]->tax_subtotal = $tax_subtotal;
                $productRemissions[$cont]->subtotal = $subtotal;
                $cont++;
            }
        }

        $expenseProducts = [];
        $cont = 0;
        foreach ($products as $key => $product) {
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
        foreach ($products as $key => $product) {
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

        $ncpurchaseProducts = [];
        $cont = 0;
        foreach ($products as $key => $product) {
            $quantity = NcpurchaseProduct::from('ncpurchase_products as np')
                ->join('ncpurchases as nc', 'np.ncpurchase_id', 'nc.id')
                ->join('products as pro', 'np.product_id', 'pro.id')
                ->whereBetween('np.created_at', [$from, $to])
                ->where('nc.user_id', $cashRegister->user_id)
                ->where('np.product_id', $product->id)
                ->sum('quantity');

            $tax_subtotal = NcpurchaseProduct::from('ncpurchase_products as np')
                ->join('ncpurchases as nc', 'np.ncpurchase_id', 'nc.id')
                ->join('products as pro', 'np.product_id', 'pro.id')
                ->whereBetween('np.created_at', [$from, $to])
                ->where('nc.user_id', $cashRegister->user_id)
                ->where('np.product_id', $product->id)
                ->sum('tax_subtotal');

            $subtotal = NcpurchaseProduct::from('ncpurchase_products as np')
                ->join('ncpurchases as nc', 'np.ncpurchase_id', 'nc.id')
                ->join('products as pro', 'np.product_id', 'pro.id')
                ->whereBetween('np.created_at', [$from, $to])
                ->where('nc.user_id', $cashRegister->user_id)
                ->where('np.product_id', $product->id)
                ->sum('subtotal');

            if ($quantity) {
                $ncpurchaseProducts[$cont] = Product::findOrFail($product->id);
                $ncpurchaseProducts[$cont]->quantity = $quantity;
                $ncpurchaseProducts[$cont]->tax_subtotal = $tax_subtotal;
                $ncpurchaseProducts[$cont]->subtotal = $subtotal;
                $cont++;
            }
        }

        $ncinvoiceProducts = [];
        $cont = 0;
        foreach ($products as $key => $product) {
            $quantity = NcinvoiceProduct::from('ncinvoice_products as np')
                ->join('ncinvoices as nc', 'np.ncinvoice_id', 'nc.id')
                ->join('products as pro', 'np.product_id', 'pro.id')
                ->whereBetween('np.created_at', [$from, $to])
                ->where('nc.user_id', $cashRegister->user_id)
                ->where('np.product_id', $product->id)
                ->sum('quantity');

            $tax_subtotal = NcinvoiceProduct::from('ncinvoice_products as np')
                ->join('ncinvoices as nc', 'np.ncinvoice_id', 'nc.id')
                ->join('products as pro', 'np.product_id', 'pro.id')
                ->whereBetween('np.created_at', [$from, $to])
                ->where('nc.user_id', $cashRegister->user_id)
                ->where('np.product_id', $product->id)
                ->sum('tax_subtotal');

            $subtotal = NcinvoiceProduct::from('ncinvoice_products as np')
                ->join('ncinvoices as nc', 'np.ncinvoice_id', 'nc.id')
                ->join('products as pro', 'np.product_id', 'pro.id')
                ->whereBetween('np.created_at', [$from, $to])
                ->where('nc.user_id', $cashRegister->user_id)
                ->where('np.product_id', $product->id)
                ->sum('subtotal');

            if ($quantity) {
                $ncinvoiceProducts[$cont] = Product::findOrFail($product->id);
                $ncinvoiceProducts[$cont]->quantity = $quantity;
                $ncinvoiceProducts[$cont]->tax_subtotal = $tax_subtotal;
                $ncinvoiceProducts[$cont]->subtotal = $subtotal;
                $cont++;
            }
        }

        $ndinvoiceProducts = [];
        $cont = 0;
        foreach ($products as $key => $product) {
            $quantity = NcinvoiceProduct::from('ndinvoice_products as np')
                ->join('ndinvoices as nd', 'np.ndinvoice_id', 'nd.id')
                ->join('products as pro', 'np.product_id', 'pro.id')
                ->whereBetween('np.created_at', [$from, $to])
                ->where('nd.user_id', $cashRegister->user_id)
                ->where('np.product_id', $product->id)
                ->sum('quantity');

            $tax_subtotal = NcinvoiceProduct::from('ndinvoice_products as np')
                ->join('ndinvoices as nd', 'np.ndinvoice_id', 'nd.id')
                ->join('products as pro', 'np.product_id', 'pro.id')
                ->whereBetween('np.created_at', [$from, $to])
                ->where('nd.user_id', $cashRegister->user_id)
                ->where('np.product_id', $product->id)
                ->sum('tax_subtotal');

            $subtotal = NcinvoiceProduct::from('ndinvoice_products as np')
                ->join('ndinvoices as nd', 'np.ndinvoice_id', 'nd.id')
                ->join('products as pro', 'np.product_id', 'pro.id')
                ->whereBetween('np.created_at', [$from, $to])
                ->where('nd.user_id', $cashRegister->user_id)
                ->where('np.product_id', $product->id)
                ->sum('subtotal');

            if ($quantity) {
                $ncinvoiceProducts[$cont] = Product::findOrFail($product->id);
                $ncinvoiceProducts[$cont]->quantity = $quantity;
                $ncinvoiceProducts[$cont]->tax_subtotal = $tax_subtotal;
                $ncinvoiceProducts[$cont]->subtotal = $subtotal;
                $cont++;
            }
        }

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

        $remissions = Remission::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $remissionBalances = Remission::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('balance');
        $remissionTotalTaxs = Remission::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_tax');
        $remissionTotals = Remission::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total');
        $remissionTotalPays = Remission::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $remissionPays = Pay::where('user_id', $cashRegister->user_id)->where('type', 'remission')->whereBetween('created_at', [$from, $to])->get();
        $remissionSumPays = Pay::where('user_id', $cashRegister->user_id)->where('type', 'remission')->whereBetween('created_at', [$from, $to])->sum('pay');

        $expenses = Expense::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $expenseBalances = Expense::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('balance');
        $expenseTotalTaxs = Expense::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_tax');
        $expenseTotals = Expense::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total');
        $expenseTotalPays = Expense::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $expensePays = Pay::where('user_id', $cashRegister->user_id)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->get();
        $expenseSumPays = Pay::where('user_id', $cashRegister->user_id)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->sum('pay');

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

        $ndinvoices = Ndinvoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $sumNdinvoices = Ndinvoice::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

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
            'ncpurchaseProducts',
            'ncinvoiceProducts',
            'ndinvoiceProducts',
            'productRemissions',

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

            'remissions',
            'remissionBalances',
            'remissionTotalTaxs',
            'remissionTotals',
            'remissionTotalPays',
            'remissionPays',
            'remissionSumPays',

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
    public function posCashRegister(Request $request, CashRegister $cashRegister)
    {
        $cashRegister = CashRegister::findOrFail($cashRegister->id);
        $from     = $cashRegister->created_at;
        $to       = $cashRegister->updated_at;

        $produc = [];
        $cont = 0;
        $products = Product::all();
        //$cant1 = cantidad de productPurchases
        $productPurchases = [];
        $contPurchase = 0;
        foreach ($products as $key => $product) {
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

        $expenseProducts = [];
        $contExpense = 0;
        foreach ($products as $key => $product) {
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
                $expenseProducts[$contExpense] = Product::findOrFail($product->id);
                $expenseProducts[$contExpense]->quantity = $quantity;
                $expenseProducts[$contExpense]->tax_subtotal = $taxSubtotal;
                $expenseProducts[$contExpense]->subtotal = $subtotal;
                $contExpense++;
            }
        }

        $invoiceProducts = [];
        $contInvoice = 0;
        foreach ($products as $key => $product) {
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

        $productRemissions = [];
        $cont = 0;
        foreach ($products as $key => $product) {
            $quantity = ProductRemission::from('product_remissions as pr')
                ->join('remissions as rem', 'pr.remission_id', 'rem.id')
                ->join('products as pro', 'pr.product_id', 'pro.id')
                ->whereBetween('pr.created_at', [$from, $to])
                ->where('rem.user_id', $cashRegister->user_id)
                ->where('pr.product_id', $product->id)
                ->sum('quantity');

            $tax_subtotal = ProductRemission::from('product_remissions as pr')
                ->join('remissions as rem', 'pr.remission_id', 'rem.id')
                ->join('products as pro', 'pr.product_id', 'pro.id')
                ->whereBetween('pr.created_at', [$from, $to])
                ->where('rem.user_id', $cashRegister->user_id)
                ->where('pr.product_id', $product->id)
                ->sum('tax_subtotal');

            $subtotal = ProductRemission::from('product_remissions as pr')
                ->join('remissions as rem', 'pr.remission_id', 'rem.id')
                ->join('products as pro', 'pr.product_id', 'pro.id')
                ->whereBetween('pr.created_at', [$from, $to])
                ->where('rem.user_id', $cashRegister->user_id)
                ->where('pr.product_id', $product->id)
                ->sum('subtotal');

            if ($quantity) {
                $productRemissions[$cont] = Product::findOrFail($product->id);
                $productRemissions[$cont]->quantity = $quantity;
                $productRemissions[$cont]->tax_subtotal = $tax_subtotal;
                $productRemissions[$cont]->subtotal = $subtotal;
                $cont++;
            }
        }

        $purchases = Purchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $purchasePays = Pay::where('user_id', current_user()->id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->get();
        $purchaseSumPays = Pay::where('user_id', current_user()->id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->sum('pay');
        $ncpurchases = Ncpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumNcpurchases = Ncpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');
        $ndpurchases = Ndpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumNdpurchases = Ndpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $invoices = Invoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $invoicePays = Pay::where('user_id', current_user()->id)->where('type', 'invoice')->whereBetween('created_at', [$from, $to])->get();
        $invoiceSumPays = Pay::where('user_id', current_user()->id)->where('type', 'invoice')->whereBetween('created_at', [$from, $to])->sum('pay');
        $ncinvoices = Ncinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumNcinvoices = Ncinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');
        $ndinvoices = Ndinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumNdinvoices = Ndinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $remissions = Remission::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $remissionPays = Pay::where('user_id', current_user()->id)->where('type', 'remission')->whereBetween('created_at', [$from, $to])->get();
        $remissionSumPays = Pay::where('user_id', current_user()->id)->where('type', 'remission')->whereBetween('created_at', [$from, $to])->sum('pay');

        $expenses = Expense::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $expensePays = Pay::where('user_id', current_user()->id)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->get();
        $expenseSumPays = Pay::where('user_id', current_user()->id)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->sum('pay');

        $purchaseOrders = PurchaseOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumPurchaseOrders = PurchaseOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $invoiceOrders = InvoiceOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumInvoiceOrders = InvoiceOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

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

        $pdfHeight = ticketHeightCashRegister(
            $cashRegister,
            $logoHeight,
            $productPurchases,
            $invoiceProducts,
            $expenseProducts,
            $productRemissions,
            $purchases,
            $expenses,
            $invoices,
            $remissions,
            $purchaseOrders,
            $invoiceOrders,
            $restaurantOrders,
            $ncinvoices,
            $ndinvoices,
            $ncpurchases,
            $ndpurchases,
            $invoicePays,
            $remissionPays,
            $purchasePays,
            $expensePays,
            $cashInflows,
            $cashOutflows,
            $advanceProviders,
            $advanceCustomers,
            $advanceEmployees,
            $sumAdvanceCustomers,
            $sumAdvanceEmployees,
            $sumAdvanceProviders
        );
        //dd($pdfHeight);
        $pdf = new TicketCashRegister('P', 'mm', array(70, $pdfHeight), true, 'UTF-8');
        $pdf->SetMargins(1, 10, 4);
        $pdf->SetTitle('CAJA ' . $cashRegister->created_at);
        $pdf->SetAutoPageBreak(false);
        $pdf->addPage();

        if (indicator()->logo == 'on') {
            if (file_exists($logo)) {
                $pdf->cashRegisterLogo($logo, $width, $height);
            }
        }
        //Reortes de movimientos de items
        $pdf->cashRegisterName();
        if ($cashRegister->purchase > 0) {
            $documentItems = $productPurchases;
            $name = 'Reporte de articulos compras';
            $totales = $cashRegister->purchase;
            $pdf->reportItemDocuments($documentItems, $name, $totales);
        } else {
            $documentNull = 'No hay Reporte de Compras';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->expense > 0) {
            $documentItems = $expenseProducts;
            $name = 'Reporte de gastos servicios';
            $totales = $cashRegister->expense;
            $pdf->reportItemDocuments($documentItems, $name, $totales);
        } else {
            $documentNull = 'No hay Reporte de Gastos';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->invoice > 0) {
            $documentItems = $invoiceProducts;
            $name = 'Reporte de articulos ventas';
            $totales = $cashRegister->invoice;
            $pdf->reportItemDocuments($documentItems, $name, $totales);
        } else {
            $documentNull = 'No hay Reporte Vendidos';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->remission > 0) {
            $documentItems = $productRemissions;
            $name = 'Reporte de articulos remisiones';
            $totales = $cashRegister->remission;
            $pdf->reportItemDocuments($documentItems, $name, $totales);
        } else {
            $documentNull = 'No hay Reporte remisionados';
            $pdf->reportNull($documentNull);
        }


        //reportes de documentos
        if ($cashRegister->purchase > 0) {
            $documents = $purchases;
            $type = 'doc';
            $name = 'Comprobantes de Compras';
            $totales = $cashRegister->purchase;
            $pdf->reportDocuments($documents, $name, $totales, $type);
        } else {
            $documentNull = 'No hay Comprobantes de Compras';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->expense > 0) {
            $documents = $expenses;
            $type = 'doc';
            $name = 'Comprobantes de Gastos';
            $totales = $cashRegister->expense;
            $pdf->reportDocuments($documents, $name, $totales, $type);
        } else {
            $documentNull = 'No hay Comprobantes de Gastos';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->invoice > 0) {
            $documents = $invoices;
            $type = 'doc';
            $name = 'Comprobantes de Ventas';
            $totales = $cashRegister->invoice;
            $pdf->reportDocuments($documents, $name, $totales, $type);
        } else {
            $documentNull = 'No hay Comprobantes de Ventas';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->remission > 0) {
            $documents = $remissions;
            $type = 'doc';
            $name = 'Comprobantes de Remisiones';
            $totales = $cashRegister->remission;
            $pdf->reportDocuments($documents, $name, $totales, $type);
        } else {
            $documentNull = 'No hay Comprobantes de Remisiones';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->purchase_order > 0) {
            $documents = $purchaseOrders;
            $type = 'order';
            $name = 'Comprobantes de Ordenes de compra';
            $totales = $cashRegister->purchase_order;
            $pdf->reportDocuments($documents, $name, $totales, $type);
        } else {
            $documentNull = 'No hay Comprobantes de Ord de Compra';
            $pdf->reportNull($documentNull);
        }
        if (indicator()->restaurant == 'off') {
            if ($cashRegister->invoice_order > 0) {
                $documents = $invoiceOrders;
                $type = 'order';
                $name = 'Comprobantes de Ordenes de venta';
                $totales = $cashRegister->invoice_order;
                $pdf->reportDocuments($documents, $name, $totales, $type);
            } else {
                $documentNull = 'No hay Comprobantes de Ord de Venta';
                $pdf->reportNull($documentNull);
            }
        } else {
            if ($cashRegister->restaurant_order > 0) {
                $documents = $restaurantOrders;
                $type = 'restOrder';
                $name = 'Comprobantes de NC en ventas';
                $totales = $cashRegister->restaurant_order;
                $pdf->reportDocuments($documents, $name, $totales, $type);
            } else {
                $documentNull = 'No hay Comprobantes de NC en ventas';
                $pdf->reportNull($documentNull);
            }
        }
        if ($cashRegister->ncinvoice > 0) {
            $documents = $ncinvoices;
            $type = 'doc';
            $name = 'Comprobantes de NC en ventas';
            $totales = $cashRegister->ncinvoice;
            $pdf->reportDocuments($documents, $name, $totales, $type);
        } else {
            $documentNull = 'No hay Comprobantes de NC en ventas';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->ndinvoice > 0) {
            $documents = $ndinvoices;
            $type = 'doc';
            $name = 'Comprobantes de ND en ventas';
            $totales = $cashRegister->ndinvoice;
            $pdf->reportDocuments($documents, $name, $totales, $type);
        } else {
            $documentNull = 'No hay Comprobantes de ND en ventas';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->ncpurchase > 0) {
            $documents = $ncpurchases;
            $type = 'doc';
            $name = 'Comprobantes de NC en Compras';
            $totales = $cashRegister->ncpurchase;
            $pdf->reportDocuments($documents, $name, $totales, $type);
        } else {
            $documentNull = 'No hay Comprobantes de NC en Compras';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->ndpurchase > 0) {
            $documents = $ndpurchases;
            $type = 'doc';
            $name = 'Comprobantes de ND en Compras';
            $totales = $cashRegister->ndpurchase;
            $pdf->reportDocuments($documents, $name, $totales, $type);
        } else {
            $documentNull = 'No hay Comprobantes de ND en Compras';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->in_invoice > 0) {
            $documents = $invoicePays;
            $type = 'comp';
            $name = 'Comprobantes Abonos a Fac Venta';
            $totales = $cashRegister->in_invoice;
            $pdf->reportVouchers($documents, $name, $totales, $type);
        } else {
            $documentNull = 'No hay Comprobantes Abonos a Fac Venta';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->in_remission > 0) {
            $documents = $remissionPays;
            $type = 'comp';
            $name = 'Comprobantes Abonos a Remisiones';
            $totales = $cashRegister->in_remission;
            $pdf->reportVouchers($documents, $name, $totales, $type);
        } else {
            $documentNull = 'No hay Comprobantes Abonos a Remisiones';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->out_purchase > 0) {
            $documents = $purchasePays;
            $type = 'comp';
            $name = 'Comprobantes Pagos a Compras';
            $totales = $cashRegister->out_purchase;
            $pdf->reportVouchers($documents, $name, $totales, $type);
        } else {
            $documentNull = 'No hay Comprobantes Pagos a Compras';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->out_expense > 0) {
            $documents = $expensePays;
            $type = 'comp';
            $name = 'Comprobantes Pagos a Gastos';
            $totales = $cashRegister->out_expense;
            $pdf->reportVouchers($documents, $name, $totales, $type);
        } else {
            $documentNull = 'No hay Comprobantes Pagos a Gastos';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->in_cash > 0) {
            $documents = $cashInflows;
            $name = 'Comprobantes Entrada de efectivo';
            $totales = $cashRegister->in_cash;
            $pdf->reportMovementCash($documents, $name, $totales);
        } else {
            $documentNull = 'No hay Entradas de Efectivo';
            $pdf->reportNull($documentNull);
        }
        if ($cashRegister->out_cash > 0) {
            $documents = $cashOutflows;
            $name = 'Comprobantes Salida de efectivo';
            $totales = $cashRegister->out_cash;
            $pdf->reportMovementCash($documents, $name, $totales);
        } else {
            $documentNull = 'No hay Salidas de Efectivo';
            $pdf->reportNull($documentNull);
        }
        if ($sumAdvanceProviders > 0) {
            $documents = $advanceProviders;
            $name = 'Comprobantes Anticipo a Proveedor';
            $totales = $sumAdvanceProviders;
            $pdf->reportMovementCash($documents, $name, $totales);
        } else {
            $documentNull = 'No hay Anticipo a Proveedores';
            $pdf->reportNull($documentNull);
        }
        if ($sumAdvanceCustomers > 0) {
            $documents = $advanceCustomers;
            $name = 'Comprobantes Anticipo de Clientes';
            $totales = $sumAdvanceCustomers;
            $pdf->reportMovementCash($documents, $name, $totales);
        } else {
            $documentNull = 'No hay Anticipo de Clientes';
            $pdf->reportNull($documentNull);
        }
        if ($sumAdvanceEmployees > 0) {
            $documents = $advanceEmployees;
            $name = 'Comprobantes Anticipo a Empleados';
            $totales = $sumAdvanceEmployees;
            $pdf->reportMovementCash($documents, $name, $totales);
        } else {
            $documentNull = 'No hay Anticipo a Empleados';
            $pdf->reportNull($documentNull);
        }

        $pdf->cashRegisterTitle($cashRegister);
        $pdf->reportTotals($cashRegister);
        $pdf->cashRegisterTitleTotals($cashRegister);
        $pdf->reportTotalEnds($cashRegister);
        $pdf->footer();
        $pdf->Output("I", $cashRegister->id . ".pdf", true);
        exit;

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
        foreach ($products as $key => $product) {
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
        foreach ($products as $key => $product) {
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

        $productRemissions = [];
        $cont = 0;
        foreach ($products as $key => $product) {
            $quantity = ProductRemission::from('product_remissions as pr')
                ->join('remissions as rem', 'pr.remission_id', 'rem.id')
                ->join('products as pro', 'pr.product_id', 'pro.id')
                ->whereBetween('pr.created_at', [$from, $to])
                ->where('rem.user_id', $cashRegister->user_id)
                ->where('pr.product_id', $product->id)
                ->sum('quantity');

            $tax_subtotal = ProductRemission::from('product_remissions as pr')
                ->join('remissions as rem', 'pr.remission_id', 'rem.id')
                ->join('products as pro', 'pr.product_id', 'pro.id')
                ->whereBetween('pr.created_at', [$from, $to])
                ->where('rem.user_id', $cashRegister->user_id)
                ->where('pr.product_id', $product->id)
                ->sum('tax_subtotal');

            $subtotal = ProductRemission::from('product_remissions as pr')
                ->join('remissions as rem', 'pr.remission_id', 'rem.id')
                ->join('products as pro', 'pr.product_id', 'pro.id')
                ->whereBetween('pr.created_at', [$from, $to])
                ->where('rem.user_id', $cashRegister->user_id)
                ->where('pr.product_id', $product->id)
                ->sum('subtotal');

            if ($quantity) {
                $productRemissions[$cont] = Product::findOrFail($product->id);
                $productRemissions[$cont]->quantity = $quantity;
                $productRemissions[$cont]->tax_subtotal = $tax_subtotal;
                $productRemissions[$cont]->subtotal = $subtotal;
                $cont++;
            }
        }

        $expenseProducts = [];
        $contExpense = 0;
        foreach ($products as $key => $product) {
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
                $expenseProducts[$contExpense] = Product::findOrFail($product->id);
                $expenseProducts[$contExpense]->quantity = $quantity;
                $expenseProducts[$contExpense]->tax_subtotal = $taxSubtotal;
                $expenseProducts[$contExpense]->subtotal = $subtotal;
                $contExpense++;
            }
        }

        $purchases = Purchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $purchasePays = Pay::where('user_id', current_user()->id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->get();
        $purchaseSumPays = Pay::where('user_id', current_user()->id)->where('type', 'purchase')->whereBetween('created_at', [$from, $to])->sum('pay');
        $ncpurchases = Ncpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumNcpurchases = Ncpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');
        $ndpurchases = Ndpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumNdpurchases = Ndpurchase::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $invoices = Invoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $invoicePays = Pay::where('user_id', current_user()->id)->where('type', 'invoice')->whereBetween('created_at', [$from, $to])->get();
        $invoiceSumPays = Pay::where('user_id', current_user()->id)->where('type', 'invoice')->whereBetween('created_at', [$from, $to])->sum('pay');
        $ncinvoices = Ncinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumNcinvoices = Ncinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');
        $ndinvoices = Ndinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumNdinvoices = Ndinvoice::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $remissions = Remission::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $remissionPays = Pay::where('user_id', current_user()->id)->where('type', 'remission')->whereBetween('created_at', [$from, $to])->get();
        $remissionSumPays = Pay::where('user_id', current_user()->id)->where('type', 'remission')->whereBetween('created_at', [$from, $to])->sum('pay');

        $expenses = Expense::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $expensePays = Pay::where('user_id', current_user()->id)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->get();
        $expenseSumPays = Pay::where('user_id', current_user()->id)->where('type', 'expense')->whereBetween('created_at', [$from, $to])->sum('pay');

        $purchaseOrders = PurchaseOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumPurchaseOrders = PurchaseOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

        $invoiceOrders = InvoiceOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumInvoiceOrders = InvoiceOrder::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('total_pay');

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
            'productRemissions',

            'purchases',
            'purchasePays',
            'purchaseSumPays',
            'ncpurchases',
            'sumNcpurchases',
            'ndpurchases',
            'sumNdpurchases',

            'invoices',
            'invoicePays',
            'invoiceSumPays',
            'ncinvoices',
            'sumNcinvoices',
            'ndinvoices',
            'sumNdinvoices',

            'remissions',
            'remissionPays',
            'remissionSumPays',

            'expenses',
            'expensePays',
            'expenseSumPays',

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
        $pdf->setPaper(array(0, 0, 297.76, 3276.64));

        return $pdf->stream('reporte_caja.pdf');
    }
}
