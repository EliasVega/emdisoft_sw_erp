<?php

namespace App\Http\Controllers;

use App\Helpers\Tickets\Ticket;
use App\Models\InvoiceOrder;
use App\Http\Requests\StoreInvoiceOrderRequest;
use App\Http\Requests\UpdateInvoiceOrderRequest;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Card;
use App\Models\Company;
use App\Models\CompanyTax;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\EmployeeInvoiceOrderProduct;
use App\Models\Indicator;
use App\Models\InvoiceOrderProduct;
use App\Models\PaymentForm;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Resolution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use Picqer\Barcode\BarcodeGeneratorPNG;

use function App\Helpers\Tickets\ticketHeight;
use function PHPUnit\Framework\isNull;

class InvoiceOrderController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:invoiceOrder.index|invoiceOrder.create|invoiceOrder.show|invoiceOrder.edit', ['only'=>['index']]);
        $this->middleware('permission:invoiceOrder.create', ['only'=>['create','store']]);
        $this->middleware('permission:invoiceOrder.show', ['only'=>['show']]);
        $this->middleware('permission:invoiceOrder.edit', ['only'=>['edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $invoiceOrder = session('invoiceOrder');
        $typeDocument = session('typeDocument');
        if ($request->ajax()) {
            //Muestra todas las pre compras de la empresa
            $user = current_user()->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las precompras a admin y superadmin
                $invoiceOrders = InvoiceOrder::where('status', '!=', 'canceled')->get();
            } else {
                //Consulta para mostrar precompras de los demas roles
                $invoiceOrders = InvoiceOrder::where('user_id', $user->id)->where('status', '!=', 'canceled')->get();
            }
            return DataTables::of($invoiceOrders)
            ->addIndexColumn()
            ->addColumn('customer', function (InvoiceOrder $invoiceOrder) {
                return $invoiceOrder->third->name;
            })
            ->addColumn('branch', function (InvoiceOrder $invoiceOrder) {
                return $invoiceOrder->branch->name;
            })
            ->addColumn('status', function (InvoiceOrder $invoiceOrder) {
                if ($invoiceOrder->status == 'active') {
                    return $invoiceOrder->status == 'active' ? 'Orden de Venta' : 'Facturado';
                } elseif ($invoiceOrder->status == 'generated') {
                    return $invoiceOrder->status == 'generated' ? 'Facturado' : 'Cancelado';
                } else {
                    return $invoiceOrder->status == 'canceled' ? 'Anulada' : 'Anulada';
                }
            })
            ->addColumn('observation', function (InvoiceOrder $invoiceOrder) {
                return $invoiceOrder->note;
            })
            ->addColumn('pos', function (InvoiceOrder $invoiceOrder) {
                return $invoiceOrder->branch->company->indicator->pos;
            })
            ->editColumn('created_at', function(InvoiceOrder $invoiceOrder) {
                return $invoiceOrder->created_at->format('Y-m-d: h:m');
            })
            ->addColumn('btn', 'admin/invoiceOrder/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.invoiceOrder.index', compact('invoiceOrder', 'typeDocument'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $indicator = indicator();
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $customers = Customer::get();
        $employees = Employee::get();
        $branchs = Branch::get();
        $uvtmax = indicator()->uvt * 5;
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
        $type = 'invoice';
        return view('admin.invoiceOrder.create',
        compact(
            'customers',
            'employees',
            'branchs',
            'advances',
            'products',
            'date',
            'companyTaxes',
            'uvtmax',
            'indicator',
            'type'
        ));
    }

    public function createPosOrder()
    {
        $indicator = indicator();
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $customers = Customer::get();
        $employees = Employee::get();
        $branchs = Branch::get();
        $uvtmax = indicator()->uvt * 5;
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
        return view('admin.invoiceOrder.create',
        compact(
            'customers',
            'employees',
            'branchs',
            'advances',
            'products',
            'date',
            'companyTaxes',
            'uvtmax',
            'indicator',
            'type'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceOrderRequest $request)
    {
        //dd($request->all());
        $cashRegister = cashRegisterComprobation();

        //Variables del request
        $product_id = $request->product_id;
        $quantity   = $request->quantity;
        $price      = $request->price;
        $tax_rate   = $request->tax_rate;
        $total_pay = $request->total_pay;
        $employee_id = $request->employee_id;
        $typeDocument = $request->typeDocument;

        //Crea un registro de orden de venta
        $invoiceOrder = new InvoiceOrder();
        $invoiceOrder->user_id = current_user()->id;
        $invoiceOrder->branch_id = current_user()->branch_id;
        $invoiceOrder->invoice_id = null;
        $invoiceOrder->customer_id = $request->customer_id;
        $invoiceOrder->cash_register_id = $cashRegister->id;
        $invoiceOrder->generation_date = $request->generation_date;
        $invoiceOrder->due_date = $request->due_date;
        $invoiceOrder->total = $request->total;
        $invoiceOrder->total_tax = $request->total_tax;
        $invoiceOrder->total_pay = $total_pay;
        $invoiceOrder->status = 'active';
        $invoiceOrder->note = $request->note;
        $invoiceOrder->save();

        if (indicator()->pos == 'on') {
            //actualizar la caja
                $cashRegister->invoice_order += $total_pay;
                $cashRegister->update();
        }
        //Ingresa los productos que vienen en el array
        for ($i=0; $i < count($product_id); $i++) {
            $subtotal = $quantity[$i] * $price[$i];
            $id = $product_id[$i];
            //Metodo para registrar la relacion entre producto y compra
            $invoiceOrderProduct = new InvoiceOrderProduct();
            $invoiceOrderProduct->invoice_order_id = $invoiceOrder->id;
            $invoiceOrderProduct->product_id = $id;
            $invoiceOrderProduct->quantity = $quantity[$i];
            $invoiceOrderProduct->price = $price[$i];
            $invoiceOrderProduct->tax_rate = $tax_rate[$i];
            $invoiceOrderProduct->subtotal = $subtotal;
            $invoiceOrderProduct->tax_subtotal =($subtotal * $tax_rate[$i])/100;
            $invoiceOrderProduct->save();

            //$product = Product::findOrFail($id);

            //metodo para comisiones de empleados
            if (indicator()->work_labor == 'on') {
                if ($employee_id[$i] != 'null') {
                    $employee = Employee::findOrFail($employee_id[$i]);
                    $commission = $employee->commission;
                    $valueCommission = ($subtotal/100) * $commission;

                    $employeeInvoiceOrderProduct = new EmployeeInvoiceOrderProduct();
                    $employeeInvoiceOrderProduct->invoice_order_product_id = $invoiceOrderProduct->id;
                    $employeeInvoiceOrderProduct->employee_id = $employee_id[$i];
                    $employeeInvoiceOrderProduct->generation_date = $request->generation_date;
                    $employeeInvoiceOrderProduct->quantity = $quantity[$i];
                    $employeeInvoiceOrderProduct->price = $price[$i];
                    $employeeInvoiceOrderProduct->subtotal = $subtotal;
                    $employeeInvoiceOrderProduct->commission = $commission;
                    $employeeInvoiceOrderProduct->value_commission =$valueCommission;
                    $employeeInvoiceOrderProduct->status = 'pendient';
                    $employeeInvoiceOrderProduct->save();
                }
            }
        }
        session()->forget('invoiceOrder');
        session()->forget('typeDocument');
        session(['invoiceOrder' => $invoiceOrder->id]);
        session(['typeDocument' => $typeDocument]);
        toast('Orden de Venta Generada con exito.','success');
        return redirect('invoiceOrder');
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceOrder $invoiceOrder)
    {
        $invoiceOrderProducts = InvoiceOrderProduct::where('invoice_order_id', $invoiceOrder->id)->where('quantity', '>', 0)->get();
        $indicator = indicator();
        return view('admin.invoiceOrder.show', compact('invoiceOrder', 'invoiceOrderProducts', 'indicator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceOrder $invoiceOrder)
    {
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $indicator = indicator();
        $customers = Customer::get();
        $employees = Employee::get();
        $branchs = Branch::get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $date = Carbon::now();
        $generation = $invoiceOrder->generation_date;
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

        $iops = InvoiceOrderProduct::from('invoice_order_products as iop')
        ->join('products as pro', 'iop.product_id', 'pro.id')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('iop.id', 'iop.quantity', 'iop.price', 'iop.tax_rate', 'pro.id as idP', 'pro.stock', 'pro.name', 'per.percentage', 'tt.id as tt')
        ->where('iop.invoice_order_id', $invoiceOrder->id)
        ->get();

        $invoiceOrderProducts = [];

        for ($i=0; $i < count($iops); $i++) {
            $eiop = EmployeeInvoiceOrderProduct::where('invoice_order_product_id', $iops[$i]->id)->first();

            if (is_null($eiop)) {
                //$ioparray = Arr::add($iops[$i], 'employee', 'null');
                $invoiceOrderProducts[$i] = Arr::add($iops[$i], 'employee', 'null');
            } else {
                $invoiceOrderProducts[$i] = Arr::add($iops[$i], 'employee', $eiop->employee_id);
            }

        }
        return view('admin.invoiceOrder.edit',
        compact(
            'invoiceOrder',
            'customers',
            'employees',
            'branchs',
            'advances',
            'products',
            'date',
            'companyTaxes',
            'indicator',
            'invoiceOrderProducts'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceOrderRequest $request, InvoiceOrder $invoiceOrder)
    {
        //dd($request->all());
        //llamado a variables
        $cashRegister = cashRegisterComprobation();
        $product_id = $request->product_id;
        $quantity   = $request->quantity;
        $price      = $request->price;
        $tax_rate   = $request->tax_rate;
        $total_pay = $request->total_pay;
        $employee_id = $request->employee_id;

        if (indicator()->pos == 'on') {
            //actualizar la caja
            $cashRegister->invoice_order -= $invoiceOrder->total_pay;
            $cashRegister->update();
        }

        //Actualizando un registro de compras
        $invoiceOrder->user_id = current_user()->id;
        $invoiceOrder->branch_id = current_user()->branch_id;
        $invoiceOrder->customer_id = $request->customer_id;
        $invoiceOrder->invoice_id = null;
        $invoiceOrder->generation_date = $request->generation_date;
        $invoiceOrder->due_date = $request->due_date;
        $invoiceOrder->total = $request->total;
        $invoiceOrder->total_tax = $request->total_tax;
        $invoiceOrder->total_pay = $total_pay;
        $invoiceOrder->status = 'active';
        $invoiceOrder->note = $request->note;
        $invoiceOrder->update();


        if (indicator()->pos == 'on') {
            //actualizar la caja
            $cashRegister->invoice_order += $total_pay;
            $cashRegister->update();
        }

        $invoiceOrderProducts = InvoiceOrderProduct::where('invoice_order_id', $invoiceOrder->id)->get();

        foreach ($invoiceOrderProducts as $key => $invoiceOrderProduct) {
            $invoiceOrderProduct->quantity    = 0;
            $invoiceOrderProduct->price       = 0;
            $invoiceOrderProduct->tax_rate    = 0;
            $invoiceOrderProduct->subtotal    = 0;
            $invoiceOrderProduct->tax_subtotal = 0;
            $invoiceOrderProduct->update();
            $employeeInvoiceOrderProduct = EmployeeInvoiceOrderProduct::where('invoice_order_product_id', $invoiceOrderProduct->id)->first();
            if (isset($employeeInvoiceOrderProduct)) {
                $employeeInvoiceOrderProduct->generation_date = $request->generation_date;
                $employeeInvoiceOrderProduct->quantity = 0;
                $employeeInvoiceOrderProduct->price = 0;
                $employeeInvoiceOrderProduct->subtotal = 0;
                $employeeInvoiceOrderProduct->commission = 0;
                $employeeInvoiceOrderProduct->value_commission = 0;
                $employeeInvoiceOrderProduct->status = 'canceled';
                $employeeInvoiceOrderProduct->update();
            }
        }

        //Toma el Request del array
        for ($i=0; $i < count($product_id); $i++) {

            $id = $product_id[$i];
            $invoiceOrderProduct = null;
            if (indicator()->sqio == 'on') {
                $invoiceOrderProduct = InvoiceOrderProduct::where('invoice_order_id', $invoiceOrder->id)
                ->where('product_id', $id)->where('quantity', 0)->first();
            } else {
                $invoiceOrderProduct = InvoiceOrderProduct::where('invoice_order_id', $invoiceOrder->id)
                ->where('product_id', $id)->first();
            }
            //Inicia proceso actualizacion pre Venta producto si no existe
            if (isset($invoiceOrderProduct)) {
                if ($quantity[$i] > 0) {

                    $subtotal = $quantity[$i] * $price[$i];
                    $tax_subtotal = $subtotal * $tax_rate[$i]/100;

                    $invoiceOrderProduct->quantity    += $quantity[$i];
                    $invoiceOrderProduct->price       = $price[$i];
                    $invoiceOrderProduct->tax_rate    = $tax_rate[$i];
                    $invoiceOrderProduct->subtotal    += $subtotal;
                    $invoiceOrderProduct->tax_subtotal     += $tax_subtotal;
                    $invoiceOrderProduct->update();
                    if (indicator()->work_labor == 'on') {
                        if ($employee_id[$i] != "null") {
                            $employeeInvoiceOrderProduct = EmployeeInvoiceOrderProduct::where('invoice_order_product_id', $invoiceOrderProduct->id)->first();
                            //metodo para comisiones de empleados
                            $employee = Employee::findOrFail($employee_id[$i]);
                            $commission = $employee->commission;
                            $valueCommission = ($subtotal/100) * $commission;
                            if (isset($employeeInvoiceOrderProduct)) {
                                $employeeInvoiceOrderProduct->employee_id = $employee_id[$i];
                                $employeeInvoiceOrderProduct->generation_date = $request->generation_date;
                                $employeeInvoiceOrderProduct->quantity = $quantity[$i];
                                $employeeInvoiceOrderProduct->price = $price[$i];
                                $employeeInvoiceOrderProduct->subtotal = $subtotal;
                                $employeeInvoiceOrderProduct->commission = $commission;
                                $employeeInvoiceOrderProduct->value_commission = $valueCommission;
                                $employeeInvoiceOrderProduct->status = 'pendient';
                                $employeeInvoiceOrderProduct->update();
                            } else {
                                $employeeInvoiceOrderProduct = new EmployeeInvoiceOrderProduct();
                                $employeeInvoiceOrderProduct->invoice_order_product_id = $invoiceOrderProduct->id;
                                $employeeInvoiceOrderProduct->employee_id = $employee_id[$i];
                                $employeeInvoiceOrderProduct->generation_date = $request->generation_date;
                                $employeeInvoiceOrderProduct->quantity = $quantity[$i];
                                $employeeInvoiceOrderProduct->price = $price[$i];
                                $employeeInvoiceOrderProduct->subtotal = $subtotal;
                                $employeeInvoiceOrderProduct->commission = $commission;
                                $employeeInvoiceOrderProduct->value_commission = $valueCommission;
                                $employeeInvoiceOrderProduct->status = 'pendient';
                                $employeeInvoiceOrderProduct->save();
                            }
                        }
                    }
                }
            } else {
                $subtotal = $quantity[$i] * $price[$i];
                $tax_subtotal = $subtotal * $tax_rate[$i]/100;

                $invoiceOrderProduct = new InvoiceOrderProduct();
                $invoiceOrderProduct->invoice_order_id = $invoiceOrder->id;
                $invoiceOrderProduct->product_id = $id;
                $invoiceOrderProduct->quantity = $quantity[$i];
                $invoiceOrderProduct->price = $price[$i];
                $invoiceOrderProduct->tax_rate = $tax_rate[$i];
                $invoiceOrderProduct->subtotal = $subtotal;
                $invoiceOrderProduct->tax_subtotal = $tax_subtotal;
                $invoiceOrderProduct->save();

                if (indicator()->work_labor == 'on') {
                    //metodo para comisiones de empleados
                    if ($employee_id[$i] != 'null') {
                        $employee = Employee::findOrFail($employee_id[$i]);
                        $commission = $employee->commission;
                        $valueCommission = ($subtotal/100) * $commission;

                        $employeeInvoiceOrderProduct = new EmployeeInvoiceOrderProduct();
                        $employeeInvoiceOrderProduct->invoice_order_product_id = $invoiceOrderProduct->id;
                        $employeeInvoiceOrderProduct->employee_id = $employee_id[$i];
                        $employeeInvoiceOrderProduct->generation_date = $request->generation_date;
                        $employeeInvoiceOrderProduct->quantity = $quantity[$i];
                        $employeeInvoiceOrderProduct->price = $price[$i];
                        $employeeInvoiceOrderProduct->subtotal = $subtotal;
                        $employeeInvoiceOrderProduct->commission = $commission;
                        $employeeInvoiceOrderProduct->value_commission = $valueCommission;
                        $employeeInvoiceOrderProduct->status = 'pendient';
                        $employeeInvoiceOrderProduct->save();
                    }
                }
            }
        }
        session()->forget('invoiceOrder');
        session(['invoiceOrder' => $invoiceOrder->id]);
        toast('Orden de Venta Editada con exito.','success');
        return redirect('invoiceOrder');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceOrder $invoiceOrder)
    {
        //
    }

    public function invoiceOrderDelete($id)
    {
        $invoiceOrder = InvoiceOrder::findOrFail($id);

        if ($invoiceOrder->status != 'canceled') {
            $invoiceOrder->status = 'canceled';
        }
        $invoiceOrder->update();

        return redirect('invoiceOrder');
    }

    public function invoice($id)
    {
        $indicator = indicator();
        $invoiceOrder = InvoiceOrder::findOrFail($id);
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $customers = Customer::get();
        $resolutions = Resolution::where('document_type_id', 1)->where('status', 'active')->get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::get();
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

        $iops = InvoiceOrderProduct::from('invoice_order_products as iop')
        ->join('products as pro', 'iop.product_id', 'pro.id')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('iop.id', 'iop.quantity', 'iop.price', 'iop.tax_rate', 'pro.id as idP', 'pro.stock', 'pro.name', 'per.percentage', 'tt.id as tt')
        ->where('iop.invoice_order_id', $invoiceOrder->id)
        ->get();

        $invoiceOrderProducts = [];

        for ($i=0; $i < count($iops); $i++) {
            $eiop = EmployeeInvoiceOrderProduct::where('invoice_order_product_id', $iops[$i]->id)->first();

            if (is_null($eiop)) {
                //$ioparray = Arr::add($iops[$i], 'employee', 'null');
                $invoiceOrderProducts[$i] = Arr::add($iops[$i], 'employee', 'null');
            } else {
                $invoiceOrderProducts[$i] = Arr::add($iops[$i], 'employee', $eiop->employee_id);
            }

        }

        return view('admin.invoiceOrderProduct.create',
        compact(
            'invoiceOrder',
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
            'indicator',
            'invoiceOrderProducts'
        ));
    }
    public function invoiceOrderPdf(Request $request, $id)
    {
        $invoiceOrder = InvoiceOrder::findOrFail($id);
        $invoiceOrderProducts = InvoiceOrderProduct::where('invoice_order_id', $id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
        $invoiceOrderpdf = "COMP-". $invoiceOrder->id;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.invoiceOrder.pdf', compact(
            'invoiceOrder',
            'invoiceOrderProducts',
            'company',
            'logo',
            'indicator'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$invoiceOrderpdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");
    }

    public function pdfInvoiceOrder()
    {
        $invoiceOrders = session('invoiceOrder');
        $invoiceOrder = InvoiceOrder::findOrFail($invoiceOrders);
        session()->forget('invoiceOrder');
        $invoiceOrderProducts = InvoiceOrderProduct::where('invoice_order_id', $invoiceOrder->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
        $invoiceOrderpdf = "COMP-". $invoiceOrder->id;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.invoiceOrder.pdf', compact(
            'invoiceOrder',
            'invoiceOrderProducts',
            'company',
            'indicator',
            'logo'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$invoiceOrderpdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");
    }

    public function invoiceOrderPos($id)
    {
        $invoiceOrder = InvoiceOrder::where('id', $id)->first();
        $invoiceOrderProducts = InvoiceOrderProduct::where('invoice_order_id', $id)->where('quantity', '>', 0)->get();
        $company = Company::where('id', 1)->first();
        $indicator = Indicator::findOrFail(1);
        $invoiceOrderpdf = "FACT-". $invoiceOrder->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.invoiceOrder.pos', compact(
            'invoiceOrder',
            'invoiceOrderProducts',
            'company',
            'indicator',
            'logo',
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,297.64,1246.53), 'portrait');

        return $pdf->stream('vista-pdf', "$invoiceOrderpdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");
    }

    public function posInvoiceOrder()
    {
        $invoiceOrders = session('invoiceOrder');
        //dd($invoiceOrders);
        $invoiceOrder = InvoiceOrder::findOrFail($invoiceOrders);
        session()->forget('invoiceOrder');
        $invoiceOrderProducts = InvoiceOrderProduct::where('invoice_order_id', $invoiceOrder->id)->where('quantity', '>', 0)->get();

        $company = Company::where('id', 1)->first();
        $indicator = Indicator::findOrFail(1);
        $invoiceOrderpdf = "FACT-". $invoiceOrder->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.invoiceOrder.pos', compact(
            'invoiceOrder',
            'invoiceOrderProducts',
            'company',
            'indicator',
            'logo',
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,297.64,1246.53), 'portrait');

        return $pdf->stream('vista-pdf', "$invoiceOrderpdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");
    }

    public function posPdfInvoiceOrder(Request $request, InvoiceOrder $invoiceOrder)
    {

        $typeDocument = 'invoiceOrder';
        $title = 'ORDEN DE VENTA';

        $document = $invoiceOrder;
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

        $pdfHeight = ticketHeight($logoHeight, company(), $invoiceOrder, "invoiceOrder");

        $pdf = new Ticket('P', 'mm', array(80, $pdfHeight), true, 'UTF-8');
        $pdf->SetMargins(2, 10, 6);
        $pdf->SetTitle('ORDEN DE VENTA' . ' ' . $invoiceOrder->id);
        $pdf->SetAutoPageBreak(false);
        $pdf->addPage();



        if (indicator()->logo == 'on') {
            if (file_exists($logo)) {
                $pdf->generateLogo($logo, $width, $height);
            }
        }
        $pdf->generateTitle($title);
        $pdf->generateCompanyInformation();

        $barcodeGenerator = new BarcodeGeneratorPNG();
        $barcodeCode = $barcodeGenerator->getBarcode($invoiceOrder->id, $barcodeGenerator::TYPE_CODE_128);
        $barcode = "data:image/png;base64," . base64_encode($barcodeCode);

        $pdf->generateBarcode($barcode);
        $pdf->generateBranchInformation($document);
        $pdf->generateThirdPartyInformation($invoiceOrder->third, $thirdPartyType);
        $pdf->generateProductsTable($document, $typeDocument);
        $pdf->generateSummaryInformation($document);

        /*
        if (indicator()->dian == 'on') {
            $pdf->generateInvoiceInformation($document);
            $cufe =  $invoiceOrder->invoiceResponse->cufe;
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
            ];*/
            /*
            $writer = new PngWriter();
            $qrCode = new QrCode(implode("\n", $data));
            $qrCode->setSize(300);
            $qrCode->setMargin(10);
            $result = $writer->write($qrCode);

            $qrCodeImage = $result->getString();
            $qrImage = "data:image/png;base64," . base64_encode($qrCodeImage);
            $pdf->generateQr($qrImage);

            //$confirmationCode = formatText("CUFE: " . $invoice->response->cufe);
            $confirmationCode = formatText("CUFE: " . $invoice->invoiceResponse->cufe);
            //$confirmationCode = formatText("CUFE: " . $invoice->invoiceResponse->cufe);
            $pdf->generateConfirmationCode($confirmationCode);
        }*/


        $refund = formatText("*** Para realizar un reclamo o devolución debe de presentar este ticket ***");
        $pdf->generateDisclaimerInformation($refund);

        $pdf->footer();

        $pdf->Output("I", $invoiceOrder->id . ".pdf", true);
        exit;
    }

    public function getProduct(Request $request)
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
