<?php

namespace App\Http\Controllers;

use App\Models\PrePurchase;
use App\Http\Requests\StorePrePurchaseRequest;
use App\Http\Requests\UpdatePrePurchaseRequest;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Card;
use App\Models\Company;
use App\Models\CompanyTax;
use App\Models\Department;
use App\Models\DocumentType;
use App\Models\GenerationType;
use App\Models\IdentificationType;
use App\Models\Liability;
use App\Models\Municipality;
use App\Models\Organization;
use App\Models\PaymentForm;
use App\Models\PaymentMethod;
use App\Models\Percentage;
use App\Models\PrePurchaseProduct;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Regime;
use App\Models\Resolution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PrePurchaseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:prePurchase.index|prePurchase.create|prePurchase.show|prePurchase.edit', ['only'=>['index']]);
        $this->middleware('permission:prePurchase.create', ['only'=>['create','store']]);
        $this->middleware('permission:prePurchase.show', ['only'=>['show']]);
        $this->middleware('permission:prePurchase.edit', ['only'=>['edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prePurchase = session('prePurchase');
        if ($request->ajax()) {
            //Muestra todas las pre compras de la empresa
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las precompras a admin y superadmin
                $prePurchases = PrePurchase::get();
            } else {
                //Consulta para mostrar precompras de los demas roles
                $prePurchases = PrePurchase::where('user_id', $user->id)->get();
            }
            return DataTables::of($prePurchases)
            ->addIndexColumn()
            ->addColumn('provider', function (PrePurchase $prePurchase) {
                return $prePurchase->third->name;
            })
            ->addColumn('branch', function (PrePurchase $prePurchase) {
                return $prePurchase->branch->name;
            })
            ->addColumn('status', function (PrePurchase $prePurchase) {
                if ($prePurchase->status == 'active') {
                    return $prePurchase->status == 'active' ? 'Precompra' : 'Facturado';
                } elseif ($prePurchase->status == 'generated') {
                    return $prePurchase->status == 'generated' ? 'Facturado' : 'Cancelado';
                } else {
                    return $prePurchase->status == 'canceled' ? 'Anulada' : 'Anulada';
                }
            })

            ->editColumn('created_at', function(PrePurchase $prePurchase) {
                return $prePurchase->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/pre_purchase/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.pre_purchase.index', compact('prePurchase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        $identificationTypes = IdentificationType::get();
        $liabilities = Liability::get();
        $organizations = Organization::get();
        $providers = Provider::get();
        $regimes = Regime::get();
        $branchs = Branch::get();
        $products = Product::where('status', 'active')->get();
        return view('admin.pre_purchase.create',
        compact(
            'departments',
            'municipalities',
            'identificationTypes',
            'liabilities',
            'organizations',
            'providers',
            'regimes',
            'branchs',
            'products'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrePurchaseRequest $request)
    {
        //Variables del request
        $product_id = $request->product_id;
        $quantity   = $request->quantity;
        $price      = $request->price;
        $tax_rate   = $request->tax_rate;

        //Crea un registro de compras
        $prePurchase = new PrePurchase();
        $prePurchase->user_id = current_user()->id;
        $prePurchase->branch_id = current_user()->branch_id;
        $prePurchase->provider_id = $request->provider_id;
        $prePurchase->total = $request->total;
        $prePurchase->total_tax = $request->total_tax;
        $prePurchase->total_pay = $request->total_pay;
        $prePurchase->status = 'active';
        $prePurchase->balance = $request->total_pay;
        $prePurchase->save();

        //Ingresa los productos que vienen en el array
        for ($i=0; $i < count($product_id); $i++) {
            //Metodo para registrar la relacion entre producto y compra
            $prePurchase_product = new PrePurchaseProduct();
            $prePurchase_product->pre_purchase_id = $prePurchase->id;
            $prePurchase_product->product_id = $product_id[$i];
            $prePurchase_product->quantity = $quantity[$i];
            $prePurchase_product->price = $price[$i];
            $prePurchase_product->tax_rate = $tax_rate[$i];
            $prePurchase_product->subtotal = $quantity[$i] * $price[$i];
            $prePurchase_product->tax_subtotal =($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
            $prePurchase_product->save();
        }
        session()->forget('prePurchase');
        session(['prePurchase' => $prePurchase->id]);
        toast('Pre Compra Generada con exito.','success');
        return redirect('prePurchase');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PrePurchase  $prePurchase
     * @return \Illuminate\Http\Response
     */
    public function show(PrePurchase $prePurchase)
    {
        $prePurchaseProducts = PrePurchaseProduct::where('pre_purchase_id', $prePurchase->id)->get();
        return view('admin.pre_purchase.show', compact('prePurchase', 'prePurchaseProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrePurchase  $prePurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(PrePurchase $prePurchase)
    {
        $providers = Provider::get();
        $branchs = Branch::get();
        $products = Product::where('status', 'active')->get();
        $prePurchaseProducts = PrePurchaseProduct::from('pre_purchase_products as pp')
        ->join('products as pro', 'pp.product_id', 'pro.id')
        ->select('pro.id', 'pro.name', 'pro.stock', 'pp.quantity', 'pp.price', 'pp.tax_rate', 'pp.subtotal')
        ->where('pre_purchase_id', $prePurchase->id)
        ->get();
        return view('admin.pre_purchase.edit',
        compact(
            'providers',
            'branchs',
            'products',
            'prePurchase',
            'prePurchaseProducts'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePrePurchaseRequest  $request
     * @param  \App\Models\PrePurchase  $prePurchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrePurchaseRequest $request, PrePurchase $prePurchase)
    {
        //llamado a variables
        $product_id = $request->product_id;
        $quantity   = $request->quantity;
        $price      = $request->price;
        $tax_rate   = $request->tax_rate;

        //Actualizando un registro de compras
        $prePurchase->user_id = Auth::user()->id;
        $prePurchase->branch_id = Auth::user()->branch_id;
        $prePurchase->provider_id = $request->provider_id;
        $prePurchase->total = $request->total;
        $prePurchase->total_tax = $request->total_tax;
        $prePurchase->total_pay = $request->total_pay;
        $prePurchase->balance = $request->total_pay;
        $prePurchase->status = 'active';
        $prePurchase->note = $request->note;
        $prePurchase->update();

        $prePurchaseProducts = PrePurchaseProduct::where('pre_purchase_id', $prePurchase->id)->get();
        foreach ($prePurchaseProducts as $key => $prePurchaseProduct) {
            $prePurchaseProduct->quantity    = 0;
            $prePurchaseProduct->price       = 0;
            $prePurchaseProduct->tax_rate    = 0;
            $prePurchaseProduct->subtotal    = 0;
            $prePurchaseProduct->tax_subtotal = 0;
            $prePurchaseProduct->update();

        }

        //Toma el Request del array
        for ($i=0; $i < count($product_id); $i++) {
            $prePurchaseProduct = PrePurchaseProduct::where('pre_purchase_id', $prePurchase->id)
            ->where('product_id', $product_id[$i])->first();

            //Inicia proceso actualizacio pre compra producto si no existe
            if (is_null($prePurchaseProduct)) {
                $subtotal = $quantity[$i] * $price[$i];
                $tax_subtotal = $subtotal * $tax_rate[$i]/100;

                $prePurchaseProduct = new PrePurchaseProduct();
                $prePurchaseProduct->pre_purchase_id = $prePurchase->id;
                $prePurchaseProduct->product_id  = $product_id[$i];
                $prePurchaseProduct->quantity    = $quantity[$i];
                $prePurchaseProduct->price       = $price[$i];
                $prePurchaseProduct->tax_rate    = $tax_rate[$i];
                $prePurchaseProduct->subtotal    = $subtotal;
                $prePurchaseProduct->tax_subtotal     = $tax_subtotal;
                $prePurchaseProduct->save();

            } else {
                if ($quantity[$i] > 0) {

                    $subtotal = $quantity[$i] * $price[$i];
                    $tax_subtotal = $subtotal * $tax_rate[$i]/100;

                    if ($prePurchaseProduct->quantity > 0) {
                        $prePurchaseProduct->quantity    += $quantity[$i];
                        $prePurchaseProduct->price       = $price[$i];
                        $prePurchaseProduct->tax_rate    = $tax_rate[$i];
                        $prePurchaseProduct->subtotal    += $subtotal;
                        $prePurchaseProduct->tax_subtotal     += $tax_subtotal;
                        $prePurchaseProduct->update();
                    } else {
                        $prePurchaseProduct->quantity    = $quantity[$i];
                        $prePurchaseProduct->price       = $price[$i];
                        $prePurchaseProduct->tax_rate    = $tax_rate[$i];
                        $prePurchaseProduct->subtotal    = $subtotal;
                        $prePurchaseProduct->tax_subtotal     = $tax_subtotal;
                        $prePurchaseProduct->update();
                    }
                }
            }
        }
        session()->forget('prePurchase');
        session(['prePurchase' => $prePurchase->id]);
        toast('Pre Compra Editada con exito.','success');
        return redirect('prePurchase');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrePurchase  $prePurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrePurchase $prePurchase)
    {
        //
    }

    public function invoice($id)
    {
        $prePurchase = PrePurchase::findOrFail($id);
        //\Session()->put('prePurchase', $prePurchase->id, 60 * 24 * 365);
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
        $prePurchaseProducts = PrePurchaseProduct::from('pre_purchase_products as pp')
        ->join('products as pro', 'pp.product_id', 'pro.id')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->select('pro.id', 'pro.name', 'pro.stock', 'pp.quantity', 'pp.price', 'pp.tax_rate', 'pp.subtotal', 'ct.tax_type_id')
        ->where('pre_purchase_id', $prePurchase->id)
        ->get();
        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();

        return view('admin.pre_purchase_product.create', compact(
            'prePurchase',
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
            'prePurchaseProducts',
            'companyTaxes'
        ));
    }

    public function prePurchasePdf(Request $request, $id)
    {
        $prePurchase = PrePurchase::findOrFail($id);
        $prePurchaseProducts = PrePurchaseProduct::where('pre_purchase_id', $id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);

        $prePurchasepdf = "COMP-". $prePurchase->id;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.pre_purchase.pdf', compact('prePurchase', 'prePurchaseProducts', 'company', 'logo'));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$prePurchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
    }

    public function pdfPrePurchase()
    {
        $prePurchases = session('prePurchase');
        $prePurchase = PrePurchase::findOrFail($prePurchases);
        session()->forget('prePurchase');
        $prePurchaseProducts = PrePurchaseProduct::where('pre_purchase_id', $prePurchase->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);

        $prePurchasepdf = "COMP-". $prePurchase->id;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.pre_purchase.pdf', compact('prePurchase', 'prePurchaseProducts', 'company', 'logo'));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$prePurchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
    }

    public function prePurchasePost($id)
    {
        $prePurchase = PrePurchase::where('id', $id)->first();
        $prePurchaseProducts = PrePurchaseProduct::where('pre_purchase_id', $id)->where('quantity', '>', 0)->get();
        $company = Company::where('id', 1)->first();

        $prePurchasepdf = "FACT-". $prePurchase->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.pre_purchase.post', compact(
            'prePurchase',
            'prePurchaseProducts',
            'company',
            'logo',
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

        return $pdf->stream('vista-pdf', "$prePurchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
    }

    public function postPrePurchase()
    {
        $prePurchases = session('prePurchase');
        $prePurchase = PrePurchase::findOrFail($prePurchases);
        session()->forget('prePurchase');
        $prePurchaseProducts = PrePurchaseProduct::where('pre_purchase_id', $prePurchase->id)->where('quantity', '>', 0)->get();
        $company = Company::where('id', 1)->first();

        $prePurchasepdf = "FACT-". $prePurchase->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.pre_purchase.post', compact(
            'prePurchase',
            'prePurchaseProducts',
            'company',
            'logo',
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

        return $pdf->stream('vista-pdf', "$prePurchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
    }

}
