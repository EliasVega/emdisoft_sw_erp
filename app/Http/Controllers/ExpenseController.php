<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Card;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\Department;
use App\Models\ExpenseProduct;
use App\Models\IdentificationType;
use App\Models\Indicator;
use App\Models\Liability;
use App\Models\Municipality;
use App\Models\Organization;
use App\Models\Pay;
use App\Models\PaymentForm;
use App\Models\PaymentMethod;
use App\Models\PayPaymentMethod;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Regime;
use App\Models\VoucherType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

use function PHPUnit\Framework\isNull;

class ExpenseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:expense.index|expense.create|expense.show|expense.edit', ['only'=>['index']]);
        $this->middleware('permission:expense.create', ['only'=>['create','store']]);
        $this->middleware('permission:expense.show', ['only'=>['show']]);
        $this->middleware('permission:expense.edit', ['only'=>['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $expense = session('expense');
        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Muestra todas las compras de la empresa
                $expenses = Expense::get();
            } else {
                //Muestra todas las compras de la empresa por usuario
                $expenses = Expense::where('user_id', $users->id)->get();
            }
            return DataTables::of($expenses)
            ->addIndexColumn()

            ->addColumn('provider', function (Expense $expense) {
                return $expense->third->name;
            })
            ->addColumn('branch', function (Expense $expense) {
                return $expense->branch->name;
            })
            ->addColumn('role', function (Expense $expense) {
                return $expense->user->roles[0]->name;
            })
            ->editColumn('created_at', function(Expense $expense){
                return $expense->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/expense/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.expense.index', compact('expense'));
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
        if ($indicator->post == 'on') {
            if(is_null($cashRegister)){
                return redirect("branch")->with('warning', 'Debes tener una caja Abierta para realizar Compras');
            }
        }
        $departments = Department::get();
        $municipalities = Municipality::get();
        $identificationTypes = IdentificationType::get();
        $liabilities = Liability::get();
        $organizations = Organization::get();
        $providers = Provider::get();
        $regimes = Regime::get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $advances = Advance::get();
        $products = Product::where('status', 'active')->where('type', 'service')->get();

        return view('admin.expense.create',
        compact(
            'departments',
            'municipalities',
            'identificationTypes',
            'liabilities',
            'organizations',
            'providers',
            'regimes',
            'paymentForms',
            'paymentMethods',
            'banks',
            'cards',
            'branchs',
            'advances',
            'products',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExpenseRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreExpenseRequest $request)
    {
        $indicator = Indicator::findOrFail(1);
        $user = Auth::user();

        //Variables del request
        $product_id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $tax_rate = $request->tax_rate;
        $branch = $user->branch_id;//variable de la sucursal de destino
        $total_pay = $request->total_pay;
        $totalpay = $request->totalpay;
        //variables del request
        $paymentMethod = $request->payment_method_id;
        $bank = $request->bank_id;
        $card = $request->card_id;
        $advance_id = $request->advance_id;
        $payment = $request->pay;
        $transaction = $request->transaction;
        $payAdvance = $request->payment;

        //Crea un registro de compras
        $expense = new Expense();
        $expense->user_id = $user->id;
        $expense->branch_id = $user->branch_id;
        $expense->provider_id = $request->provider_id;
        $expense->payment_form_id = $request->payment_form_id;
        $expense->payment_method_id = $request->payment_method_id[0];
        $voucherTypes = VoucherType::findOrFail(20);
        $expense->document = $voucherTypes->code . '-' . $voucherTypes->consecutive;
        $expense->voucher_type_id = 20;
        $voucherTypes->consecutive += 1;
        $voucherTypes->update();
        $expense->generation_date = $request->generation_date;
        $expense->total = $request->total;
        $expense->total_tax = $request->total_tax;
        $expense->total_pay = $total_pay;
        if ($totalpay > 0) {
            $expense->pay = $totalpay;
        } else {
            $expense->pay = 0;
        }
        $expense->balance = $total_pay - $totalpay;
        $expense->grand_total = $total_pay;
        $expense->save();

        if ($indicator->post == 'on') {
            //actualizar la caja
            $cashRegister = CashRegister::where('user_id', '=', $expense->user_id)->where('status', '=', 'open')->first();
            $cashRegister->expense += $expense->total_pay;
            $cashRegister->out_total += $totalpay;
            $cashRegister->update();
        }
        //Toma el Request del array
        //Ingresa los productos que vienen en el array

        for ($i=0; $i < count($product_id); $i++) {
            $id = $product_id[$i];
            //Metodo para registrar la relacion entre producto y compra
            $expenseProduct = new ExpenseProduct();
            $expenseProduct->expense_id = $expense->id;
            $expenseProduct->product_id = $id;
            $expenseProduct->quantity = $quantity[$i];
            $expenseProduct->price = $price[$i];
            $expenseProduct->tax_rate = $tax_rate[$i];
            $expenseProduct->subtotal = $quantity[$i] * $price[$i];
            $expenseProduct->tax_subtotal =($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
            $expenseProduct->save();
            //selecciona el producto que viene del array
            $product = Product::where('id', $id)->first();

            //selecciona el producto de la sucursal que sea el mismo del array
            $branchProducts = BranchProduct::where('product_id', '=', $id)
            ->where('branch_id', '=', $branch)
            ->first();
            if ($product->type == 'product') {
                if ($indicator->inventory == 'on') {
                    //Actualizar stock y precio del producto
                    $product->stock += $quantity[$i]; //reempazando triguer
                    $product->price = $price[$i];
                    $product->sale_price = $price[$i];
                    $product->update();


                    //Actualizando o creando productos en determinada sucursal
                    if (isset($branchProducts)) {
                        //metodo para actualizar el producto en la sucursal stock
                        $branchProducts->stock += $quantity[$i];
                        $branchProducts->update();
                    } else {
                        //metodo para crear el producto en la sucursal y asignar stock
                        $branchProduct = new BranchProduct();
                        $branchProduct->branch_id = $branch;
                        $branchProduct->product_id = $product_id[$i];
                        $branchProduct->stock = $quantity[$i];
                        $branchProduct->order_product = 0;
                        $branchProduct->save();
                    }
                }
            } else {
                //Actualizar stock y precio del producto
                $product->price = $price[$i];
                $product->sale_price = $price[$i];
                $product->update();

                //Actualizando o creando productos en determinada sucursal
                if (isset($branchProducts)) {
                    //metodo para actualizar el producto en la sucursal stock
                    $branchProducts->stock += $quantity[$i];
                    $branchProducts->update();
                } else {
                    //metodo para crear el producto en la sucursal y asignar stock
                    $branchProduct = new BranchProduct();
                    $branchProduct->branch_id = $branch;
                    $branchProduct->product_id = $product_id[$i];
                    $branchProduct->stock = $quantity[$i];
                    $branchProduct->order_product = 0;
                    $branchProduct->save();
                }

            }
        }
        //variables necesarias

        if ($totalpay > 0) {
            //Metodo para crear un nuevo pago y su realcion polimorfica dependiendo del tipo de documento
            $pay = new pay();
            $pay->user_id = $user->id;
            $pay->branch_id = $user->branch_id;
            $pay->pay = $totalpay;
            $pay->balance = $expense->balance;
            $pay->type = 'expense';
            $expense->pays()->save($pay);


            for ($i=0; $i < count($payment); $i++) {

                //Metodo que descuenta el valor del pago de un anticipo
                if ($payAdvance != 0) {

                    $advance = Advance::findOrFail( $request->advance_id);
                        //si el pago es utilizado en su totalidad agregar el destino aplicado
                        if ($advance->pay > $advance->balance) {
                            $advance->destination = $advance->destination . '<->' . $expense->document;
                        } else {
                            $advance->destination = $expense->document;
                        }
                        //variable si hay saldo en el pago anticipado
                        $payAdvance_total = $advance->balance - $payAdvance;
                        //cambiar el status del pago anticipado
                        if ($payAdvance_total == 0) {
                            $advance->status      = 'applied';
                        } else {
                            $advance->status      = 'partial';
                        }
                        //actualizar el saldo del pago anticipado
                        $advance->balance = $payAdvance_total;
                        $advance->update();
                }

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
                if ($indicator->post == 'on') {
                    //metodo para actualizar la caja

                    $cashRegister = CashRegister::where('user_id', '=', $expense->user_id)->where('status', '=', 'open')->first();
                    if($mp == 10){
                        $cashRegister->out_expense_cash += $payment[$i];
                        $cashRegister->cash_out_total += $payment[$i];
                    }
                    $cashRegister->out_expense += $payment[$i];
                    $cashRegister->update();
                }

            }
        }

        session(['expense' => $expense->id]);

        //Alert::success('Compra','Creada Satisfactoriamente.');
        toast('Gasto Registrado satisfactoriamente.','success');
        return redirect('expense');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        $voucher = VoucherType::findOrFail(20);

        $expenseProducts = ExpenseProduct::where('expense_id', $expense->id)->where('quantity', '>', 0)->get();
        return view('admin.expense.show', compact(
            'expense',
            'expenseProducts'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $providers = Provider::get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $products = Product::where('status', 'active')->where('type', 'service')->get();
        $expenseProducts = ExpenseProduct::from('expense_products as pp')
        ->join('products as pro', 'pp.product_id', 'pro.id')
        ->select('pp.id', 'pro.id as idP', 'pro.name', 'pro.stock', 'pp.quantity', 'pp.price', 'pp.tax_rate', 'pp.subtotal')
        ->where('expense_id', $expense->id)
        ->get();
        $payExpenses = Pay::where('type', 'expense')->where('payable_id', $expense->id)->sum('pay');
        return view('admin.expense.edit',
        compact(
            'expense',
            'providers',
            'paymentForms',
            'paymentMethods',
            'banks',
            'cards',
            'branchs',
            'advances',
            'products',
            'expenseProducts',
            'payExpenses'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpenseRequest  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {

            $indicator = Indicator::findOrFail(1);
            $user = Auth::user();

            //Variables del request
            $product_id = $request->product_id;
            $quantity   = $request->quantity;
            $price      = $request->price;
            $tax_rate   = $request->tax_rate;
            $branch     = $expense->branch_id;
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

            //llamado de todos los pagos y pago nuevo para la diferencia
            $payOld = Pay::where('type', 'expense')->where('payable_id', $expense->id)->sum('pay');
            $payNew = $totalpay;
            $payTotal = $payNew + $payOld;
            $date1 = Carbon::now()->toDateString();
            $date2 = Expense::find($expense->id)->created_at->toDateString();

            if ($payOld > $total_pay) {

                $voucherTypes = VoucherType::findOrFail(18);
                //Metodo para crear un nuevo advance
                $advance = new Advance();
                $advance->user_id = Auth::user()->id;
                $advance->branch_id = Auth::user()->branch_id;
                $advance->voucher_type_id = 18;
                $advance->document = $voucherTypes->code . '-' . $voucherTypes->consecutive;
                $advance->origin = 'Expense' . '-' . $expense->document;
                $advance->destination = null;
                $advance->pay = $payOld - $total_pay;
                $advance->balance = $payOld - $total_pay;;
                $advance->note = 'Anticipo generado por edicion de Gasto' . '-' . $expense->document;
                $advance->status = 'pending';
                $provider = Provider::findOrFail($request->provider_id);
                $advance->type = 'provider';
                $provider->advances()->save($advance);

                if ($indicator->post == 'on') {
                    //actualizar la caja
                    $cashRegister = CashRegister::where('user_id', '=', $expense->user_id)->where('status', '=', 'open')->first();
                    $cashRegister->out_advance = $advance->pay;
                    $cashRegister->update();
                }
            }

            if ($indicator->post == 'on') {
                //actualizar la caja
                if ($date1 == $date2) {
                    $cashRegister = CashRegister::where('user_id', '=', $expense->user_id)->where('status', '=', 'open')->first();
                    $cashRegister->expense -= $expense->total_pay;
                    $cashRegister->update();
                }
            }

            //Actualizando un registro de compras

            $expense->provider_id = $request->provider_id;
            $expense->payment_form_id = $request->payment_form_id;
            $expense->payment_method_id = $request->payment_method_id[0];
            $expense->total = $request->total;
            $expense->total_iva = $request->total_iva;
            $expense->total_pay = $total_pay;
            if ($payTotal <= $total_pay) {
                $expense->pay = $payTotal;
                $expense->balance = $total_pay - $payTotal;
            } else {
                $expense->pay = $total_pay;
                $expense->balance = 0;
            }
            $expense->update();

            if ($indicator->post == 'on') {
                //actualizar la caja
                if ($date1 == $date2) {
                    $cashRegister = CashRegister::where('user_id', '=', $expense->user_id)->where('status', '=', 'open')->first();
                    $cashRegister->expense += $expense->total_pay;
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
                $pay->balance = $expense->balance;
                $pay->type = 'expense';
                $expense->pays()->save($pay);

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
                            $advance->destination = $advance->destination . '<->' . $expense->document;
                        } else {
                            $advance->destination = $expense->document;
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

                        if ($indicator->post == 'on') {
                            //metodo para actualizar la caja
                            $cashRegister = CashRegister::where('user_id', '=', $expense->user_id)->where('status', '=', 'open')->first();
                            if($mp == 10){
                                $cashRegister->out_expense_cash += $pay;
                                $cashRegister->cash_out_total += $pay;
                            }
                            $cashRegister->out_expense += $pay;
                            $cashRegister->update();
                        }
                    }
                }

            }

            //Toma el Request del array
            //Ingresa los productos que vienen en el array
            for ($i=0; $i < count($product_id); $i++) {

                $expenseProduct = ExpenseProduct::where('expense_id', $expense->id)
                ->where('product_id', $product_id[$i])->first();

                $subtotal = $quantity[$i] * $price[$i];
                $iva_subtotal   = $subtotal * $tax_rate[$i]/100;
                //Inicia proceso actualizacio product expense si no existe
                if (is_null($expenseProduct)) {
                    $expenseProduct = new ExpenseProduct();
                    $expenseProduct->expense_id = $expense->id;
                    $expenseProduct->product_id = $product_id[$i];
                    $expenseProduct->quantity = $quantity[$i];
                    $expenseProduct->price = $price[$i];
                    $expenseProduct->tax_rate = $tax_rate[$i];
                    $expenseProduct->subtotal = $subtotal;
                    $expenseProduct->iva_subtotal = $iva_subtotal;
                    $expenseProduct->save();
                } else {
                    if ($quantity[$i] > 0) {
                        $expenseProduct->quantity = $quantity[$i];
                        $expenseProduct->price = $price[$i];
                        $expenseProduct->tax_rate = $tax_rate[$i];
                        $expenseProduct->subtotal = $subtotal;
                        $expenseProduct->iva_subtotal = $iva_subtotal;
                        $expenseProduct->update();
                    }
                }
            }
        if ($payOld > $total_pay) {
            Alert::success('Gasto','Editado Satisfactoriamente. Con creacion de anticipo de Proveedor');
            return redirect('expense');

        } else {
            return redirect("expense")->with('success', 'Compra Editada Satisfactoriamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }

    public function expensePay($id)
    {
        $document = Expense::findOrFail($id);
        $banks = Bank::get();
        $paymentMethods = PaymentMethod::get();
        $cards = Card::get();
        $advances = Advance::where('status', '!=', 'applied')->where('advanceable_id', $document->third->id)->get();
        $tipeDocument = 'Gasto';

        return view('admin.pay.create', compact(
            'document',
            'banks',
            'paymentMethods',
            'cards',
            'advances',
            'tipeDocument'
        ));
    }

    public function expensePdf(Request $request, $id)
   {
        $expense = Expense::findOrFail($id);
        $expenseProducts = ExpenseProduct::where('expense_id', $expense->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $expensepdf = "COMP-". $expense->document;
        $logo = './imagenes/logos'.$company->logo;

        $view = \view('admin.expense.pdf', compact(
            'expense',
            'expenseProducts',
            'company',
            'logo'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$expensepdf.pdf");
   }

   public function pdfExpense(Request $request)
   {
        $expenses = session('expense');
        $expense = Expense::findOrFail($expenses);
        session()->forget('expense');
        $expenseProducts = ExpenseProduct::where('expense_id', $expense->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $expensepdf = "COMP-". $expense->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.expense.pdf', compact(
            'expense',
            'expenseProducts',
            'company',
            'logo'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$expensepdf.pdf");
   }

   public function expensePost($id)
   {
        $expense = Expense::where('id', $id)->first();
        $expenseProducts = ExpenseProduct::where('expense_id', $id)->where('quantity', '>', 0)->get();
        $company = Company::where('id', 1)->first();
        $expensepdf = "FACT-". $expense->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.expense.post', compact(
            'expense',
            'expenseProducts',
            'company',
            'logo'
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

        return $pdf->stream('vista-pdf', "$expensepdf.pdf");
   }

   public function postExpense(Request $request)
   {
        $expenses = session('expense');
        $expense = Expense::findOrFail($expenses);
        session()->forget('expense');
        $expenseProducts = ExpenseProduct::where('expense_id', $expense->id)->where('quantity', '>', 0)->get();
        $company = Company::where('id', 1)->first();

        $expensepdf = "FACT-". $expense->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.expense.post', compact(
            'expense',
            'expenseProducts',
            'company',
            'logo'
            ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

        return $pdf->stream('vista-pdf', "$expensepdf.pdf");
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
