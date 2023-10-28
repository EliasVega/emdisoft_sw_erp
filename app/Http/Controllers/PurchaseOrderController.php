<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Http\Requests\StorePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Card;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\CompanyTax;
use App\Models\DocumentType;
use App\Models\GenerationType;
use App\Models\Indicator;
use App\Models\PaymentForm;
use App\Models\PaymentMethod;
use App\Models\Percentage;
use App\Models\Product;
use App\Models\Provider;
use App\Models\PurchaseOrderProduct;
use App\Models\Resolution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;

class PurchaseOrderController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:purchaseOrder.index|purchaseOrder.create|purchaseOrder.show|purchaseOrder.edit', ['only'=>['index']]);
        $this->middleware('permission:purchaseOrder.create', ['only'=>['create','store']]);
        $this->middleware('permission:purchaseOrder.show', ['only'=>['show']]);
        $this->middleware('permission:purchaseOrder.edit', ['only'=>['edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $purchaseOrder = session('purchaseOrder');
        if ($request->ajax()) {
            //Muestra todas las pre compras de la empresa
            $user = current_user()->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las precompras a admin y superadmin
                $purchaseOrders = purchaseOrder::get();
            } else {
                //Consulta para mostrar precompras de los demas roles
                $purchaseOrders = PurchaseOrder::where('user_id', $user->id)->get();
            }
            return DataTables::of($purchaseOrders)
            ->addIndexColumn()
            ->addColumn('provider', function (PurchaseOrder $purchaseOrder) {
                return $purchaseOrder->third->name;
            })
            ->addColumn('branch', function (PurchaseOrder $purchaseOrder) {
                return $purchaseOrder->branch->name;
            })
            ->addColumn('status', function (PurchaseOrder $purchaseOrder) {
                if ($purchaseOrder->status == 'active') {
                    return $purchaseOrder->status == 'active' ? 'Orden Compra' : 'Facturado';
                } elseif ($purchaseOrder->status == 'generated') {
                    return $purchaseOrder->status == 'generated' ? 'Facturado' : 'Cancelado';
                } else {
                    return $purchaseOrder->status == 'canceled' ? 'Anulada' : 'Anulada';
                }
            })

            ->editColumn('created_at', function(PurchaseOrder $purchaseOrder) {
                return $purchaseOrder->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/purchaseOrder/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.purchaseOrder.index', compact('purchaseOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $providers = Provider::get();
        $branchs = Branch::get();
        $products = Product::where('status', 'active')->get();
        return view('admin.purchaseOrder.create',
        compact(
            'providers',
            'branchs',
            'products'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseOrderRequest $request)
    {
        $indicator = Indicator::findOrFail(1);
        $cashRegister = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        //Variables del request
        $product_id = $request->product_id;
        $quantity   = $request->quantity;
        $price      = $request->price;
        $tax_rate   = $request->tax_rate;
        $total_pay = $request->total_pay;

        //Crea un registro de compras
        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->user_id = current_user()->id;
        $purchaseOrder->branch_id = current_user()->branch_id;
        $purchaseOrder->provider_id = $request->provider_id;
        $purchaseOrder->total = $request->total;
        $purchaseOrder->total_tax = $request->total_tax;
        $purchaseOrder->total_pay = $total_pay;
        $purchaseOrder->status = 'active';
        $purchaseOrder->balance = $total_pay;
        $purchaseOrder->save();

        if ($indicator->pos == 'on') {
            //actualizar la caja
                $cashRegister->purchase_order += $total_pay;
                $cashRegister->update();
        }

        //Ingresa los productos que vienen en el array
        for ($i=0; $i < count($product_id); $i++) {
            //Metodo para registrar la relacion entre producto y compra
            $purchaseOrderProduct = new PurchaseOrderProduct();
            $purchaseOrderProduct->purchase_order_id = $purchaseOrder->id;
            $purchaseOrderProduct->product_id = $product_id[$i];
            $purchaseOrderProduct->quantity = $quantity[$i];
            $purchaseOrderProduct->price = $price[$i];
            $purchaseOrderProduct->tax_rate = $tax_rate[$i];
            $purchaseOrderProduct->subtotal = $quantity[$i] * $price[$i];
            $purchaseOrderProduct->tax_subtotal =($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
            $purchaseOrderProduct->save();
        }
        session()->forget('purchaseOrder');
        session(['purchaseOrder' => $purchaseOrder->id]);
        toast('Pre Compra Generada con exito.','success');
        return redirect('purchaseOrder');
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrderProducts = PurchaseOrderProduct::where('purchase_order_id', $purchaseOrder->id)->get();
        return view('admin.purchaseOrder.show', compact('purchaseOrder', 'purchaseOrderProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $providers = Provider::get();
        $branchs = Branch::get();
        $products = Product::where('status', 'active')->get();
        $purchaseOrderProducts = PurchaseOrderProduct::from('purchase_order_products as pop')
        ->join('products as pro', 'pop.product_id', 'pro.id')
        ->select('pro.id', 'pro.name', 'pro.stock', 'pop.quantity', 'pop.price', 'pop.tax_rate', 'pop.subtotal')
        ->where('purchase_order_id', $purchaseOrder->id)
        ->get();
        return view('admin.purchaseOrder.edit',
        compact(
            'providers',
            'branchs',
            'products',
            'purchaseOrder',
            'purchaseOrderProducts'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseOrderRequest $request, PurchaseOrder $purchaseOrder)
    {
        $indicator = Indicator::findOrFail(1);
        $cashRegister = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        //llamado a variables
        $product_id = $request->product_id;
        $quantity   = $request->quantity;
        $price      = $request->price;
        $tax_rate   = $request->tax_rate;
        $total_pay = $request->total_pay;

        if ($indicator->pos == 'on') {
            //actualizar la caja
            $cashRegister->purchase_order -= $purchaseOrder->total_pay;
            $cashRegister->update();
        }

        //Actualizando un registro de compras
        $purchaseOrder->user_id = current_user()->id;
        $purchaseOrder->branch_id = current_user()->branch_id;
        $purchaseOrder->provider_id = $request->provider_id;
        $purchaseOrder->total = $request->total;
        $purchaseOrder->total_tax = $request->total_tax;
        $purchaseOrder->total_pay = $total_pay;
        $purchaseOrder->balance = $total_pay;
        $purchaseOrder->status = 'active';
        $purchaseOrder->note = $request->note;
        $purchaseOrder->update();

        if ($indicator->pos == 'on') {
            //actualizar la caja
            $cashRegister->purchase_order += $total_pay;
            $cashRegister->update();
        }

        $purchaseOrderProducts = PurchaseOrderProduct::where('purchase_order_id', $purchaseOrder->id)->get();
        foreach ($purchaseOrderProducts as $key => $purchaseOrderProduct) {
            $purchaseOrderProduct->quantity    = 0;
            $purchaseOrderProduct->price       = 0;
            $purchaseOrderProduct->tax_rate    = 0;
            $purchaseOrderProduct->subtotal    = 0;
            $purchaseOrderProduct->tax_subtotal = 0;
            $purchaseOrderProduct->update();

        }

        //Toma el Request del array
        for ($i=0; $i < count($product_id); $i++) {
            $purchaseOrderProduct = PurchaseOrderProduct::where('purchase_order_id', $purchaseOrder->id)
            ->where('product_id', $product_id[$i])->first();

            //Inicia proceso actualizacio pre compra producto si no existe
            if (is_null($purchaseOrderProduct)) {
                $subtotal = $quantity[$i] * $price[$i];
                $tax_subtotal = $subtotal * $tax_rate[$i]/100;

                $purchaseOrderProduct = new PurchaseOrderProduct();
                $purchaseOrderProduct->purchase_order_id = $purchaseOrder->id;
                $purchaseOrderProduct->product_id  = $product_id[$i];
                $purchaseOrderProduct->quantity    = $quantity[$i];
                $purchaseOrderProduct->price       = $price[$i];
                $purchaseOrderProduct->tax_rate    = $tax_rate[$i];
                $purchaseOrderProduct->subtotal    = $subtotal;
                $purchaseOrderProduct->tax_subtotal     = $tax_subtotal;
                $purchaseOrderProduct->save();

            } else {
                if ($quantity[$i] > 0) {

                    $subtotal = $quantity[$i] * $price[$i];
                    $tax_subtotal = $subtotal * $tax_rate[$i]/100;

                    if ($purchaseOrderProduct->quantity > 0) {
                        $purchaseOrderProduct->quantity    += $quantity[$i];
                        $purchaseOrderProduct->price       = $price[$i];
                        $purchaseOrderProduct->tax_rate    = $tax_rate[$i];
                        $purchaseOrderProduct->subtotal    += $subtotal;
                        $purchaseOrderProduct->tax_subtotal     += $tax_subtotal;
                        $purchaseOrderProduct->update();
                    } else {
                        $purchaseOrderProduct->quantity    = $quantity[$i];
                        $purchaseOrderProduct->price       = $price[$i];
                        $purchaseOrderProduct->tax_rate    = $tax_rate[$i];
                        $purchaseOrderProduct->subtotal    = $subtotal;
                        $purchaseOrderProduct->tax_subtotal     = $tax_subtotal;
                        $purchaseOrderProduct->update();
                    }
                }
            }
        }
        session()->forget('purchaseOrder');
        session(['purchaseOrder' => $purchaseOrder->id]);
        toast('Pre Compra Editada con exito.','success');
        return redirect('purchaseOrder');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }

    public function invoice($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        //\Session()->put('purchaseOrder', $purchaseOrder->id, 60 * 24 * 365);
        $providers = Provider::get();
        $documentTypes = DocumentType::where('prefix', 'dse')->get();
        $resolutions = Resolution::where('document_type_id', 11)->where('status', 'active')->get();
        $generationTypes = GenerationType::get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $percentages = Percentage::get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $products = Product::where('status', 'active')->get();
        $date = Carbon::now();
        $purchaseOrderProducts = PurchaseOrderProduct::from('purchase_order_products as pop')
        ->join('products as pro', 'pop.product_id', 'pro.id')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->select('pro.id', 'pro.name', 'pro.stock', 'pop.quantity', 'pop.price', 'pop.tax_rate', 'pop.subtotal', 'ct.tax_type_id')
        ->where('purchase_order_id', $purchaseOrder->id)
        ->get();
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();

        return view('admin.purchase_order_product.create', compact(
            'purchaseOrder',
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
            'purchaseOrderProducts',
            'companyTaxes'
        ));
    }

    public function purchaseOrderPdf(Request $request, $id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $purchaseOrderProducts = PurchaseOrderProduct::where('purchase_order_id', $id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
        $purchaseOrderpdf = "COMP-". $purchaseOrder->id;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.purchaseOrder.pdf', compact('purchaseOrder', 'purchaseOrderProducts', 'company', 'logo'));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$purchaseOrderpdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
    }

    public function pdfPurchaseOrder()
    {
        $purchaseOrders = session('purchaseOrder');
        $purchaseOrder = PurchaseOrder::findOrFail($purchaseOrders);
        session()->forget('purchaseOrder');
        $purchaseOrderProducts = PurchaseOrderProduct::where('purchase_order_id', $purchaseOrder->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);

        $purchaseOrderpdf = "COMP-". $purchaseOrder->id;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.purchaseOrder.pdf', compact(
            'purchaseOrder',
            'purchaseOrderProducts',
            'company',
            'indicator',
            'logo'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$purchaseOrderpdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
    }

    public function purchaseOrderPos($id)
    {
        $purchaseOrder = PurchaseOrder::where('id', $id)->first();
        $purchaseOrderProducts = PurchaseOrderProduct::where('purchase_order_id', $id)->where('quantity', '>', 0)->get();
        $company = Company::where('id', 1)->first();
        $indicator = Indicator::findOrFail(1);
        $purchaseOrderpdf = "FACT-". $purchaseOrder->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.purchaseOrder.pos', compact(
            'purchaseOrder',
            'purchaseOrderProducts',
            'company',
            'indicator',
            'logo',
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

        return $pdf->stream('vista-pdf', "$purchaseOrderpdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
    }

    public function posPurchaseOrder()
    {
        $purchaseOrders = session('purchaseOrder');
        $purchaseOrder = PurchaseOrder::findOrFail($purchaseOrders);
        session()->forget('purchaseOrder');
        $purchaseOrderProducts = PurchaseOrderProduct::where('purchase_order_id', $purchaseOrder->id)->where('quantity', '>', 0)->get();
        $company = Company::where('id', 1)->first();
        $indicator = Indicator::findOrFail(1);
        $purchaseOrderpdf = "FACT-". $purchaseOrder->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.purchase_order.pos', compact(
            'purchaseOrder',
            'purchaseOrderProducts',
            'company',
            'indicator',
            'logo',
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

        return $pdf->stream('vista-pdf', "$purchaseOrderpdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
    }
}
