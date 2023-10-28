<?php

namespace App\Http\Controllers;

use App\Models\Ncpurchase;
use App\Http\Requests\StoreNcpurchaseRequest;
use App\Http\Requests\UpdateNcpurchaseRequest;
use App\Models\BranchProduct;
use App\Models\BranchRawmaterial;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\Indicator;
use App\Models\NcpurchaseProduct;
use App\Models\NcpurchaseRawmaterial;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\RawMaterial;
use App\Models\Resolution;
use App\Models\Tax;
use App\Models\VoucherType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Traits\InventoryPurchases;
use App\Traits\KardexCreate;
use App\Traits\Taxes;

class NcpurchaseController extends Controller
{
    use InventoryPurchases, KardexCreate, Taxes;
    function __construct()
    {
        $this->middleware('permission:ncpurchase.index|ncpurchase.store|ncpurchase.show', ['only'=>['index']]);
        $this->middleware('permission:ncpurchase.store', ['only'=>['create','store']]);
        $this->middleware('permission:ncpurchase.show', ['only'=>['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ncpurchase = session('ncpurchase');
        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las notas credito a admin y superadmin
                $ncpurchases = Ncpurchase::get();
            } else {
                //Consulta para mostrar notas credito de los demas roles
                $ncpurchases = Ncpurchase::where('user_id', $user->id)->get();
            }
            return DataTables::of($ncpurchases)
            ->addIndexColumn()
            ->addColumn('branch', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->branch->name;
            })
            ->addColumn('provider', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->third->name;
            })
            ->addColumn('document', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->purchase->document;
            })

            ->addColumn('user', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->user->name;
            })

            ->editColumn('created_at', function(Ncpurchase $ncpurchase){
                return $ncpurchase->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/ncpurchase/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.ncpurchase.index', compact('ncpurchase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNcpurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNcpurchaseRequest $request)
    {
        //dd($request->all());
        $typeDocument = 'ncpurchase';
        $voucherType = 10;
        $quantity = $request->quantity;
        $price = $request->price;
        $total_pay = $request->total_pay;
        $product_id = $request->product_id;
        $discrepancy = $request->discrepancy_id;
        $tax_rate = $request->tax_rate;
        $retention = 0;
        //variables del request
        if ($request->total_retention != null) {
            $retention = $request->total_retention;
        }

        $resolution = Resolution::findOrFail(2);
        $purchase = Purchase::findOrFail($request->purchase_id);
        $indicator = Indicator::findOrFail(1);
        $cashRegister = CashRegister::where('user_id', '=', $purchase->user_id)->where('status', '=', 'open')->first();

        //gran total de la compra
        $grandTotalold = $purchase->grand_total;
        $grandTotalNd = $total_pay - $retention;
        $newGrandTotal = $grandTotalold + $grandTotalNd;
        $newBalance = $newGrandTotal - $purchase->pay;

        $branch = $purchase->branch_id;

        //Registrar tabla Nota Credito
        $ncpurchase = new Ncpurchase();
        $ncpurchase->document = $resolution->prefix . '-' . $resolution->consecutive;
        $ncpurchase->user_id = current_user()->id;
        $ncpurchase->branch_id = current_user()->branch_id;
        $ncpurchase->purchase_id = $purchase->id;
        $ncpurchase->provider_id = $purchase->provider_id;
        $ncpurchase->resolution_id = $resolution->id;
        $ncpurchase->discrepancy_id = $discrepancy;
        $ncpurchase->voucher_type_id = 10;
        $ncpurchase->retention = $retention;
        $ncpurchase->total = $request->total;
        $ncpurchase->total_tax = $request->total_tax;
        $ncpurchase->total_pay = $request->total_pay;
        $ncpurchase->save();

        if ($indicator->pos == 'on') {
            //actualizar la caja
            $cashRegister->ncpurchase += $total_pay;
            $cashRegister->update();
        }

        //Seleccionar los productos de la compra
        switch($discrepancy) {
            case(7):
                if ($total_pay <= 0) {
                    toast(' Nota credito no debe ser menor o igual a 0.','warning');
                    return redirect("purchase");
                }
                for ($i=0; $i < count($product_id); $i++) {
                    $id = $product_id[$i];
                    //selecciona el producto que viene del array
                    if ($purchase->type_product == 'product') {
                        $product = Product::findOrFail($id);
                        $branchProducts = BranchProduct::where('branch_id', $purchase->branch_id)->where('product_id', $id)->first();

                        //registrando nota debito productos
                        $ncpurchaseProduct = new NcpurchaseProduct();
                        $ncpurchaseProduct->ncpurchase_id = $ncpurchase->id;
                        $ncpurchaseProduct->product_id = $id;
                        $ncpurchaseProduct->quantity = $quantity[$i];
                        $ncpurchaseProduct->price = $price[$i];
                        $ncpurchaseProduct->tax_rate = $tax_rate[$i];
                        $ncpurchaseProduct->subtotal = $quantity[$i] * $price[$i];
                        $ncpurchaseProduct->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                        $ncpurchaseProduct->save();
                        $quantityLocal = $quantity[$i];
                        $priceLocal = $price[$i];

                        $this->inventoryPurchases($product, $branchProducts, $quantityLocal, $priceLocal, $branch);//trait para actualizar inventario
                    } else {
                        $product = RawMaterial::findOrFail($id);
                        $branchProducts = BranchRawmaterial::where('branch_id', $purchase->branch_id)->where('product_id', $id)->first();

                        //registrando nota debito productos
                        $ncpurchaseRawmaterial = new NcpurchaseRawmaterial();
                        $ncpurchaseRawmaterial->ncpurchase_id = $ncpurchase->id;
                        $ncpurchaseRawmaterial->raw_material_id = $id;
                        $ncpurchaseRawmaterial->quantity = $quantity[$i];
                        $ncpurchaseRawmaterial->price = $price[$i];
                        $ncpurchaseRawmaterial->tax_rate = $tax_rate[$i];
                        $ncpurchaseRawmaterial->subtotal = $quantity[$i] * $price[$i];
                        $ncpurchaseRawmaterial->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                        $ncpurchaseRawmaterial->save();

                        $quantityLocal = $quantity[$i];
                        $priceLocal = $price[$i];

                        $this->rawMaterialPurchases($product, $branchProducts, $quantityLocal, $priceLocal, $branch);//trait para actualizar inventario
                    }


                }
                break;
            case(8):

                if ($total_pay <= 0) {
                    toast(' Nota credito no debe ser menor o igual a 0 en ningun item.','warning');
                    return redirect("purchase");
                }
                for ($i=0; $i < count($product_id); $i++) {
                    $id = $product_id[$i];

                    $product = Product::findOrFail($id);
                    //registrando nota debito productos
                    $ncpurchaseProduct = new NcpurchaseProduct();
                    $ncpurchaseProduct->ncpurchase_id = $ncpurchase->id;
                    $ncpurchaseProduct->product_id = $id;
                    $ncpurchaseProduct->quantity = $quantity[$i];
                    $ncpurchaseProduct->price = $price[$i];
                    $ncpurchaseProduct->tax_rate = $tax_rate[$i];
                    $ncpurchaseProduct->subtotal = $quantity[$i] * $price[$i];
                    $ncpurchaseProduct->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                    $ncpurchaseProduct->save();

                    //selecciona el impuesto que tiene la categoria IVA o INC
                }
                break;
        }

        $document = $ncpurchase;
        $taxes = $this->getTaxesLine($request);//selecciona el impuesto que tiene la categoria IVA o INC
        taxesLines($document, $taxes, $typeDocument);//Helper para impuestos de linea
        retentions($request, $document, $typeDocument);//Helper para retenciones

        $voucherTypes = VoucherType::findOrFail(10);
        $voucherTypes->consecutive += 1;
        $voucherTypes->update();

        $resolution->consecutive += 1;
        $resolution->update();

        $purchase->grand_total = $newGrandTotal;
        $purchase->balance = $newBalance;
        if ($purchase->status == 'purchase') {
            $purchase->status = 'credit_note';
        } elseif ($purchase->status == 'debit_note') {
            $purchase->status = 'complete';
        }
        $purchase->update();

        session()->forget('ncpurchase');
        session(['ncpurchase' => $ncpurchase->id]);

        toast('Nota Credito Registrada satisfactoriamente.','success');
        return redirect('ncpurchase');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ncpurchase  $ncpurchase
     * @return \Illuminate\Http\Response
     */
    public function show(Ncpurchase $ncpurchase)
    {
        $ncpurchaseProducts = NcpurchaseProduct::where('ncpurchase_id', $ncpurchase->id)->where('quantity', '>', 0)->get();
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncpurchase')
        ->where('tax.taxable_id', $ncpurchase->id)
        ->where('tt.type_tax', 'retention')->get();

       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncpurchase')
        ->where('tax.taxable_id', $ncpurchase->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        return view('admin.ncpurchase.show', compact(
            'ncpurchase',
            'ncpurchaseProducts',
            'retentions',
            'retentionsum'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ncpurchase  $ncpurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Ncpurchase $ncpurchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNcpurchaseRequest  $request
     * @param  \App\Models\Ncpurchase  $ncpurchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNcpurchaseRequest $request, Ncpurchase $ncpurchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ncpurchase  $ncpurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ncpurchase $ncpurchase)
    {
        //
    }

    public function ncpurchasePdf(Request $request, $id)
    {
        $ncpurchase = Ncpurchase::findOrFail($id);
        $ncpurchaseProducts = NcpurchaseProduct::where('ncpurchase_id', $id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
        $retentions = Tax::from('taxes as tax')
            ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('tax.tax_value', 'ct.name')
            ->where('tax.type', 'ncpurchase')
            ->where('tax.taxable_id', $ncpurchase->id)
            ->where('tt.type_tax', 'retention')->get();
        $retentionsum = Tax::from('taxes as tax')
            ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('tax.tax_value', 'ct.name')
            ->where('tax.type', 'ncpurchase')
            ->where('tax.taxable_id', $ncpurchase->id)
            ->where('tt.type_tax', 'retention')->sum('tax_value');

        $ncpurchasepdf = $ncpurchase->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.ncpurchase.pdf', compact(
                'ncpurchase',
                'ncpurchaseProducts',
                'company',
                'indicator',
                'logo',
                'retentions',
                'retentionsum'
            ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$ncpurchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");*/
    }

    public function pdfNcpurchase(Request $request)
    {
        $ncpurchases = session('ncpurchase');
        $ncpurchase = Ncpurchase::findOrFail($ncpurchases);
        session()->forget('ncpurchase');
        $ncpurchaseProducts = ncpurchaseProduct::where('ncpurchase_id', $ncpurchase->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);

        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncpurchase')
        ->where('tax.taxable_id', $ncpurchase->id)
        ->where('tt.type_tax', 'retention')->get();
       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncpurchase')
        ->where('tax.taxable_id', $ncpurchase->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        $ncpurchasepdf = $ncpurchase->document;
        $view = \view('admin.ncpurchase.pdf', compact(
            'ncpurchase',
            'ncpurchaseProducts',
            'company',
            'retentions',
            'retentionsum'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('vista-pdf', "$ncpurchasepdf.pdf");
    }
}
