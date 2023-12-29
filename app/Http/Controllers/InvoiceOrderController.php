<?php

namespace App\Http\Controllers;

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
use App\Models\DocumentType;
use App\Models\GenerationType;
use App\Models\Indicator;
use App\Models\InvoiceOrderProduct;
use App\Models\PaymentForm;
use App\Models\PaymentMethod;
use App\Models\Percentage;
use App\Models\Product;
use App\Models\Resolution;
use Carbon\Carbon;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

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
        if ($request->ajax()) {
            //Muestra todas las pre compras de la empresa
            $user = current_user()->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las precompras a admin y superadmin
                $invoiceOrders = InvoiceOrder::get();
            } else {
                //Consulta para mostrar precompras de los demas roles
                $invoiceOrders = InvoiceOrder::where('user_id', $user->id)->get();
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
            ->addColumn('pos', function (InvoiceOrder $invoiceOrder) {
                return $invoiceOrder->branch->company->indicator->pos;
            })
            ->editColumn('created_at', function(InvoiceOrder $invoiceOrder) {
                return $invoiceOrder->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/invoiceOrder/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.invoiceOrder.index', compact('invoiceOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $indicator = Indicator::findOrFail(1);
        $cashRegister = cashregisterModel();
        if ($indicator->pos == 'on') {
            if(is_null($cashRegister)){
                Alert::success('danger','Debes tener una caja Abierta para realizar Operaciones');
                return redirect("branch");
            }
        }
        $customers = Customer::get();
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
        return view('admin.invoiceOrder.create',
        compact(
            'customers',
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
    public function store(StoreInvoiceOrderRequest $request)
    {
        //dd($request->all());
        $indicator = Indicator::findOrFail(1);
        $cashRegister = cashregisterModel();

        //Variables del request
        $product_id = $request->product_id;
        $quantity   = $request->quantity;
        $price      = $request->price;
        $tax_rate   = $request->tax_rate;
        $total_pay = $request->total_pay;

        //Crea un registro de orden de venta
        $invoiceOrder = new InvoiceOrder();
        $invoiceOrder->user_id = current_user()->id;
        $invoiceOrder->branch_id = current_user()->branch_id;
        $invoiceOrder->invoice_id = null;
        $invoiceOrder->customer_id = $request->customer_id;
        $invoiceOrder->total = $request->total;
        $invoiceOrder->total_tax = $request->total_tax;
        $invoiceOrder->total_pay = $total_pay;
        $invoiceOrder->status = 'active';
        $invoiceOrder->note = $request->note;
        $invoiceOrder->save();

        if ($indicator->pos == 'on') {
            //actualizar la caja
                $cashRegister->invoice_order += $total_pay;
                $cashRegister->update();
        }

        //Ingresa los productos que vienen en el array
        for ($i=0; $i < count($product_id); $i++) {
            //Metodo para registrar la relacion entre producto y compra
            $invoiceOrderProduct = new InvoiceOrderProduct();
            $invoiceOrderProduct->invoice_order_id = $invoiceOrder->id;
            $invoiceOrderProduct->product_id = $product_id[$i];
            $invoiceOrderProduct->quantity = $quantity[$i];
            $invoiceOrderProduct->price = $price[$i];
            $invoiceOrderProduct->tax_rate = $tax_rate[$i];
            $invoiceOrderProduct->subtotal = $quantity[$i] * $price[$i];
            $invoiceOrderProduct->tax_subtotal =($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
            $invoiceOrderProduct->save();
        }

        session()->forget('invoiceOrder');
        session(['invoiceOrder' => $invoiceOrder->id]);
        toast('Orden de Venta Generada con exito.','success');
        return redirect('invoiceOrder');
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceOrder $invoiceOrder)
    {
        $invoiceOrderProducts = InvoiceOrderProduct::where('invoice_order_id', $invoiceOrder->id)->get();
        return view('admin.invoiceOrder.show', compact('invoiceOrder', 'invoiceOrderProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceOrder $invoiceOrder)
    {
        $indicator = Indicator::findOrFail(1);
        $cashRegister = cashregisterModel();
        if ($indicator->pos == 'on') {
            if(is_null($cashRegister)){
                Alert::success('danger','Debes tener una caja Abierta para realizar Operaciones');
                return redirect("branch");
            }
        }
        $customers = Customer::get();
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

        $invoiceOrderProducts = InvoiceOrderProduct::from('invoice_order_products as iop')
        ->join('products as pro', 'iop.product_id', 'pro.id')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('iop.id', 'iop.quantity', 'iop.price', 'iop.tax_rate', 'pro.id as idP', 'pro.stock', 'pro.name', 'per.percentage', 'tt.id as tt')
        ->where('iop.invoice_order_id', $invoiceOrder->id)
        ->get();
        return view('admin.invoiceOrder.edit',
        compact(
            'invoiceOrder',
            'customers',
            'branchs',
            'advances',
            'products',
            'date',
            'companyTaxes',
            'uvtmax',
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
        $indicator = Indicator::findOrFail(1);
        $cashRegister = cashregisterModel();
        //llamado a variables
        $product_id = $request->product_id;
        $quantity   = $request->quantity;
        $price      = $request->price;
        $tax_rate   = $request->tax_rate;
        $total_pay = $request->total_pay;

        if ($indicator->pos == 'on') {
            //actualizar la caja
            $cashRegister->invoice_order -= $invoiceOrder->total_pay;
            $cashRegister->update();
        }

        //Actualizando un registro de compras
        $invoiceOrder->user_id = current_user()->id;
        $invoiceOrder->branch_id = current_user()->branch_id;
        $invoiceOrder->customer_id = $request->customer_id;
        $invoiceOrder->invoice_id = null;
        $invoiceOrder->total = $request->total;
        $invoiceOrder->total_tax = $request->total_tax;
        $invoiceOrder->total_pay = $total_pay;
        $invoiceOrder->status = 'active';
        $invoiceOrder->note = $request->note;
        $invoiceOrder->update();

        if ($indicator->pos == 'on') {
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

        }

        //Toma el Request del array
        for ($i=0; $i < count($product_id); $i++) {
            $invoiceOrderProduct = InvoiceOrderProduct::where('invoice_order_id', $invoiceOrder->id)
            ->where('product_id', $product_id[$i])->first();

            //Inicia proceso actualizacio pre compra producto si no existe
            if (is_null($invoiceOrderProduct)) {
                $subtotal = $quantity[$i] * $price[$i];
                $tax_subtotal = $subtotal * $tax_rate[$i]/100;

                $invoiceOrderProduct = new InvoiceOrderProduct();
                $invoiceOrderProduct->invoice_order_id = $invoiceOrder->id;
                $invoiceOrderProduct->product_id  = $product_id[$i];
                $invoiceOrderProduct->quantity    = $quantity[$i];
                $invoiceOrderProduct->price       = $price[$i];
                $invoiceOrderProduct->tax_rate    = $tax_rate[$i];
                $invoiceOrderProduct->subtotal    = $subtotal;
                $invoiceOrderProduct->tax_subtotal     = $tax_subtotal;
                $invoiceOrderProduct->save();

            } else {
                if ($quantity[$i] > 0) {

                    $subtotal = $quantity[$i] * $price[$i];
                    $tax_subtotal = $subtotal * $tax_rate[$i]/100;

                    $invoiceOrderProduct->quantity    += $quantity[$i];
                    $invoiceOrderProduct->price       = $price[$i];
                    $invoiceOrderProduct->tax_rate    = $tax_rate[$i];
                    $invoiceOrderProduct->subtotal    += $subtotal;
                    $invoiceOrderProduct->tax_subtotal     += $tax_subtotal;
                    $invoiceOrderProduct->update();

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

    public function invoice($id)
    {
        $invoiceOrder = InvoiceOrder::findOrFail($id);
        $indicator = Indicator::findOrFail(1);
        $cashRegister = cashregisterModel();
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

        $invoiceOrderProducts = InvoiceOrderProduct::from('invoice_order_products as iop')
        ->join('products as pro', 'iop.product_id', 'pro.id')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('iop.id', 'iop.quantity', 'iop.price', 'iop.tax_rate', 'pro.id as idP', 'pro.stock', 'pro.name', 'per.percentage', 'tt.id as tt')
        ->where('iop.invoice_order_id', $invoiceOrder->id)
        ->get();

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
            'uvtmax',
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
        $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

        return $pdf->stream('vista-pdf', "$invoiceOrderpdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");
    }

    public function posInvoiceOrder()
    {
        $invoiceOrders = session('invoiceOrder');
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
        $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

        return $pdf->stream('vista-pdf', "$invoiceOrderpdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");
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
