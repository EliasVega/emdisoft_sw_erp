<?php

namespace App\Http\Controllers;

use App\Models\RestaurantOrder;
use App\Http\Requests\StoreRestaurantOrderRequest;
use App\Http\Requests\UpdateRestaurantOrderRequest;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\HomeOrder;
use App\Models\Indicator;
use App\Models\Product;
use App\Models\ProductRawmaterial;
use App\Models\ProductRestaurantOrder;
use App\Models\RawMaterial;
use App\Models\RawmaterialRestaurantorder;
use App\Models\RestaurantTable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

use function PHPUnit\Framework\isEmpty;

class RestaurantOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $restaurantOrder = session('restaurantOrder');
        if ($request->ajax()) {
            //Muestra todas las pre compras de la empresa
            $user = current_user()->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las precompras a admin y superadmin
                $restaurantOrders = RestaurantOrder::where('status', '!=', 'canceled')->get();
            } else {
                //Consulta para mostrar precompras de los demas roles
                $restaurantOrders = RestaurantOrder::where('user_id', $user->id)->where('status', '!=', 'canceled')->get();
            }
            return DataTables::of($restaurantOrders)
            ->addIndexColumn()
            ->addColumn('user', function (RestaurantOrder $restaurantOrder) {
                return $restaurantOrder->user->name;
            })
            ->addColumn('table', function (RestaurantOrder $restaurantOrder) {
                return $restaurantOrder->restaurantTable->name;
            })
            ->addColumn('status', function (RestaurantOrder $restaurantOrder) {
                if ($restaurantOrder->status == 'pending') {
                    return $restaurantOrder->status == 'pending' ? 'Pendiente' : 'Pendiente';
                } elseif ($restaurantOrder->status == 'generated') {
                    return $restaurantOrder->status == 'generated' ? 'Facturada' : 'Facturada';
                } else {
                    return $restaurantOrder->status == 'canceled' ? 'Anulada' : 'Anulada';
                }
            })

            ->editColumn('created_at', function(RestaurantOrder $restaurantOrder) {
                return $restaurantOrder->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/restaurantOrder/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.restaurantOrder.index', compact('restaurantOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $indicator = Indicator::findOrFail(1);
        $cashRegister = CashRegister::select('id')
        ->where('user_id', '=', current_user()->id)
        ->where('status', '=', 'open')
        ->first();
        if ($indicator->pos == 'on') {
            if(is_null($cashRegister)){
                toast('Debes tener una caja Abierta para realizar Ventas.','danger');
                return redirect("branch");
            }
        }
        $products = Product::get();
        $rawMaterials = RawMaterial::get();
        $productRawMaterials = ProductRawmaterial::from('product_rawmaterials as pr')
        ->join('products as pro', 'pr.product_id', 'pro.id')
        ->join('raw_materials as rm', 'pr.raw_material_id', 'rm.id')
        ->select('rm.id', 'rm.name', 'pr.quantity as quantityrm', 'pr.consumer_price', )
        ->get();
        $restaurantTables = RestaurantTable::where('id', '!=', 1)->get();
        return view('admin.restaurantOrder.create', compact(
            'restaurantTables',
            'products',
            'rawMaterials',
            'productRawMaterials'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantOrderRequest $request)
    {
        //dd($request->all());
        //Obteniendo variables
        $service = $request->service;
        $table = $request->restaurant_table_id;
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $price = $request->price;
        $taxRate = $request->tax_rate;
        $quantityrm = $request->quantityrm;
        $pricerm = $request->consumer_price;
        $material = $request->material;
        $idp = $request->idP;
        $pay = $request->pay;
        $rawMaterials[] = [];
        $contRM = 0;

        $ref = $request->ref;
        $referency = $request->referency;
        $raw_material_id = $request->raw_material_id;
        $contRmRo = 0;

        if ($raw_material_id) {

            for ($i=0; $i < count($raw_material_id); $i++) {
                if ($rawMaterials[0] != []) {
                    $contsi = 0;
                    foreach ($rawMaterials as $key => $rawMaterial) {
                        if ($rawMaterial[0] == $raw_material_id[$i]) {
                            $rawMaterial[1] += $quantityrm[$i];
                            $contsi++;
                            $rawMaterials[$key] = $rawMaterial;
                        }
                    }
                    if ($contsi == 0) {
                        $rawMaterials[$contRM] = [$raw_material_id[$i], $quantityrm[$i], $material[$i]];
                            $contRM++;
                    }
                } else {
                    $rawMaterials[$contRM] = [$raw_material_id[$i], $quantityrm[$i], $material[$i]];
                    $contRM++;

                }
            }

            for ($i=0; $i < count($rawMaterials); $i++) {
                $rawMaterialId = $rawMaterials[$i][0];
                $quantityRawmaterial = $rawMaterials[$i][1];
                $nameRawmaterial = $rawMaterials[$i][2];
                $rawMaterial = RawMaterial::findOrFail($rawMaterialId);
                $stock = $rawMaterial->stock;
                $product = Product::findOrFail($idp[$i]);
                $nameProduct = $product->name;

                if ($quantityRawmaterial > $stock && $rawMaterial->type_product == 'product') {
                    toast("$nameRawmaterial" . ' ' . 'no es suficiente para' . ' ' . "$nameProduct",'warning');
                    //Alert::success('Error', "$nameProduct" . ' ' . 'no es suficiente para' . ' ' . "$nameMenu");
                    return redirect()->back();
                }
            }
        }
        if ($service == 0) {
            $restaurantOrdered = RestaurantOrder::where('restaurant_table_id', $table)->where('status', 'pending')->first();
            if (isset($restaurantOrdered)) {
                Alert::success('Error', 'Esta mesa ya tiene una comanda abierta');
                return redirect('restaurantOrder');
            }
        }
        //registro en la tabla restaurant_order
        $restaurantOrder = new RestaurantOrder();
        $restaurantOrder->total = $request->total;
        $restaurantOrder->total_tax = $request->total_tax;
        $restaurantOrder->total_pay = $request->total_pay;
        $restaurantOrder->status = 'pending';
        $restaurantOrder->note = $request->note;
        $restaurantOrder->user_id = current_user()->id;
        if ($service == 0) {
            $restaurantOrder->restaurant_table_id = $request->restaurant_table_id;
        } else {
            $restaurantOrder->restaurant_table_id = 1;
        }
        $restaurantOrder->save();

        //si es un domicilio se crea la tabla Home_orders
        if ($service == 1) {
            $date = Carbon::now();
            $homeOrder = new HomeOrder();
            $homeOrder->name = $request->name;
            $homeOrder->address = $request->address;
            $homeOrder->phone = $request->phone;
            $homeOrder->domiciliary = null;
            $homeOrder->time_receipt = $date->toTimeString();
            $homeOrder->time_sent = null;
            $homeOrder->restaurant_order_id = $restaurantOrder->id;
            $homeOrder->save();
        }
        if ($raw_material_id) {

            for ($i=0; $i < count($product_id); $i++) {
                $cont = 0;

                for ($y=0; $y < count($raw_material_id); $y++) {
                $quantityActual = $quantity[$i] * $quantityrm[$y];

                    if ($ref[$i] == $referency[$y]) {
                        $rawMaterialRestaurantOrder = new RawmaterialRestaurantorder();
                        $rawMaterialRestaurantOrder->referency = $contRmRo;
                        $rawMaterialRestaurantOrder->quantity = $quantityActual;
                        $rawMaterialRestaurantOrder->consumer_price = $pricerm[$y];
                        $rawMaterialRestaurantOrder->restaurant_order_id = $restaurantOrder->id;
                        $rawMaterialRestaurantOrder->raw_material_id = $raw_material_id[$y];
                        $rawMaterialRestaurantOrder->product_id = $product_id[$i];
                        $rawMaterialRestaurantOrder->save();
                        $cont++;
                    }
                }
                if ($cont > 0) {
                    $contRmRo++;
                }
            }
        }

        $sale_box = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        $sale_box->restaurant_order += $restaurantOrder->total_pay;
        $sale_box->update();


        for ($i=0; $i < count($product_id); $i++) {
            //registrando la tabla de orders y productos
            $subtotal = $quantity[$i] * $price[$i];
            $taxSubtotal   = $subtotal * $taxRate[$i]/100;

            $productResstaurantOrder = new ProductRestaurantOrder();
            $productResstaurantOrder->restaurant_order_id = $restaurantOrder->id;
            $productResstaurantOrder->product_id = $product_id[$i];
            $productResstaurantOrder->quantity = $quantity[$i];
            $productResstaurantOrder->price = $price[$i];
            $productResstaurantOrder->tax_rate = $taxRate[$i];
            $productResstaurantOrder->subtotal = $subtotal;
            $productResstaurantOrder->tax_subtotal = $taxSubtotal;
            $productResstaurantOrder->save();
        }
        session(['restaurantOrder' => $restaurantOrder->id]);

        toast('Comanda Registrada satisfactoriamente.','success');
        return redirect('restaurantOrder');
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantOrder $restaurantOrder)
    {
        ///*mostrar detalles*/
        $productRestaurantOrders = ProductRestaurantOrder::where('restaurant_order_id', $restaurantOrder->id)->where('quantity', '>', 0)->get();

        return view('admin.restaurantOrder.show', compact('restaurantOrder', 'productRestaurantOrders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RestaurantOrder $restaurantOrder)
    {
        $restaurantTables = RestaurantTable::where('id', '!=', 1)->get();
        $products = Product::get();
        $rawMaterials = RawMaterial::get();
        $productRestaurantOrders = ProductRestaurantOrder::from('product_restaurant_orders as pr')
        ->join('products as pro', 'pr.product_id', 'pro.id')
        ->join('restaurant_orders as ro', 'pr.restaurant_order_id', 'ro.id')
        ->select('pr.id', 'pro.id as idP', 'pro.name', 'pr.quantity', 'pr.price', 'pr.tax_rate', 'pr.subtotal')
        ->where('restaurant_order_id', $restaurantOrder->id)
        ->get();
        $productRawMaterials = ProductRawmaterial::from('product_rawmaterials as pr')
        ->join('products as pro', 'pr.product_id', 'pro.id')
        ->join('raw_materials as rm', 'pr.raw_material_id', 'rm.id')
        ->select('rm.id', 'rm.name', 'pr.quantity as quantityrm', 'pr.consumer_price', )
        ->get();
        //$rawmaterialRestaurantorders = RawmaterialRestaurantorder::where('restaurant_order_id', $restaurantOrder->id)->get();
        $rawmaterialRestaurantorders = RawmaterialRestaurantorder::from('rawmaterial_restaurantorders as rr')
        ->join('raw_materials as rm', 'rr.raw_material_id', 'rm.id')
        ->select('rr.product_id', 'rr.raw_material_id', 'rr.quantity', 'rr.consumer_price', 'rr.referency', 'rm.name')
        ->where('rr.restaurant_order_id', $restaurantOrder->id)
        ->get();
        $service = $restaurantOrder->restaurant_table_id;
        return view('admin.restaurantOrder.edit', compact(
            'restaurantOrder',
            //'documents',
            'restaurantTables',
            'products',
            'rawMaterials',
            'productRestaurantOrders',
            'productRawMaterials',
            'rawmaterialRestaurantorders',
            'service'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantOrderRequest $request, RestaurantOrder $restaurantOrder)
    {
        //dd($request->all());
        //llamado a variables
        $ed = $request->ed;

        $service = $request->service;
        $table = $request->restaurant_table_id;
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $price = $request->price;
        $taxRate = $request->tax_rate;
        $quantityrm = $request->quantityrm;
        $pricerm = $request->consumer_price;
        $material = $request->material;
        $idp = $request->idP;
        $rawMaterials[] = [];
        $contRM = 0;

        $ref = $request->ref;
        $referency = $request->referency;
        $raw_material_id = $request->raw_material_id;
        $contRmRo = 0;

        $sale_box = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        $sale_box->restaurant_order -= $restaurantOrder->total_pay;
        $sale_box->update();

        if ($raw_material_id) {

            for ($i=0; $i < count($raw_material_id); $i++) {
                if ($rawMaterials[0] != []) {
                    $contsi = 0;
                    foreach ($rawMaterials as $key => $rawMaterial) {
                        if ($rawMaterial[0] == $raw_material_id[$i]) {
                            $rawMaterial[1] += $quantityrm[$i];
                            $contsi++;
                            $rawMaterials[$key] = $rawMaterial;
                        }
                    }
                    if ($contsi == 0) {
                        $rawMaterials[$contRM] = [$raw_material_id[$i], $quantityrm[$i], $material[$i]];
                            $contRM++;
                    }
                } else {
                    $rawMaterials[$contRM] = [$raw_material_id[$i], $quantityrm[$i], $material[$i]];
                    $contRM++;

                }
            }

            for ($i=0; $i < count($rawMaterials); $i++) {
                $rawMaterialId = $rawMaterials[$i][0];
                $quantityRawmaterial = $rawMaterials[$i][1];
                $nameRawmaterial = $rawMaterials[$i][2];
                $rawMaterial = RawMaterial::findOrFail($rawMaterialId);
                $stock = $rawMaterial->stock;
                $product = Product::findOrFail($idp[$i]);
                $nameProduct = $product->name;

                if ($quantityRawmaterial > $stock && $rawMaterial->type_product == 'product') {
                    toast("$nameRawmaterial" . ' ' . 'no es suficiente para' . ' ' . "$nameProduct",'warning');
                    return redirect()->back();
                }
            }
        }

        //registro en la tabla restaurant_order
        $restaurantOrder->total = $request->total;
        $restaurantOrder->total_tax = $request->total_tax;
        $restaurantOrder->total_pay = $request->total_pay;
        $restaurantOrder->note = $request->note;
        if ($service == 0) {
            $restaurantOrder->restaurant_table_id = $table;
        } else {
            $restaurantOrder->restaurant_table_id = 1;
        }
        $restaurantOrder->update();

        $sale_box->restaurant_order += $restaurantOrder->total_pay;
        $sale_box->update();

        //si es un domicilio se crea la tabla Home_orders
        if ($service == 1) {
            $date = Carbon::now();
            $homeOrder = HomeOrder::where('order_id', $restaurantOrder->id)->first();
            $homeOrder->name = $request->name;
            $homeOrder->address = $request->address;
            $homeOrder->phone = $request->phone;
            $homeOrder->domiciliary = $request->domiciliary;
            $homeOrder->time_sent = $date->toTimeString();
            $homeOrder->update();
        }

        $rawMatRestOrders = RawmaterialRestaurantorder::where('restaurant_order_id', $restaurantOrder->id)->get();

        foreach ($rawMatRestOrders as $key => $rawMatRestOrder) {
            $rawMatRestOrder->referency = 0;
            $rawMatRestOrder->quantity = 0;
            $rawMatRestOrder->consumer_price = 0;
            $rawMatRestOrder->save();
        }

        if ($raw_material_id) {
            $contz = 0;
            for ($i=0; $i < count($product_id); $i++) {
                $cont = 0;

                for ($y=0; $y < count($raw_material_id); $y++) {
                $quantityActual = $quantity[$i] * $quantityrm[$y];

                    if ($ref[$i] == $referency[$y]) {
                        if ($contz < count($rawMatRestOrders)) {
                            $rawMatRestOrders[$contz]->referency = $contRmRo;
                            $rawMatRestOrders[$contz]->quantity = $quantityActual;
                            $rawMatRestOrders[$contz]->consumer_price = $pricerm[$y];
                            $rawMatRestOrders[$contz]->restaurant_order_id = $restaurantOrder->id;
                            $rawMatRestOrders[$contz]->raw_material_id = $raw_material_id[$y];
                            $rawMatRestOrders[$contz]->product_id = $product_id[$i];
                            $rawMatRestOrders[$contz]->update();
                            $contz++;
                            $cont++;
                        } else {
                            $rawMaterialRestaurantOrder = new RawmaterialRestaurantorder();
                            $rawMaterialRestaurantOrder->referency = $contRmRo;
                            $rawMaterialRestaurantOrder->quantity = $quantityActual;
                            $rawMaterialRestaurantOrder->consumer_price = $pricerm[$y];
                            $rawMaterialRestaurantOrder->restaurant_order_id = $restaurantOrder->id;
                            $rawMaterialRestaurantOrder->raw_material_id = $raw_material_id[$y];
                            $rawMaterialRestaurantOrder->product_id = $product_id[$i];
                            $rawMaterialRestaurantOrder->save();
                            $cont++;
                        }
                    }
                }
                if ($cont > 0) {
                    $contRmRo++;
                }
            }
        }

        $productRestaurantOrders = ProductRestaurantOrder::where('restaurant_order_id', $restaurantOrder->id)->get();
        foreach ($productRestaurantOrders as $key => $productRestaurantOrder) {

            $productRestaurantOrder->quantity = 0;
            $productRestaurantOrder->price = 0;
            $productRestaurantOrder->tax_rate = 0;
            $productRestaurantOrder->subtotal = 0;
            $productRestaurantOrder->tax_subtotal = 0;
            $productRestaurantOrder->edition = false;
            if ($productRestaurantOrder->status != 'canceled') {
                $productRestaurantOrder->status = 'registered';
            }
            $productRestaurantOrder->update();
        }
        //Toma el Request del array

        for ($i=0; $i < count($product_id); $i++) {
            $productRestaurantOrder = ProductRestaurantOrder::where('product_id', $product_id[$i])->where('edition', false)->first();
            $subtotal = $quantity[$i] * $price[$i];
            $taxSubtotal = $subtotal * $taxRate[$i]/100;

            //Inicia proceso actualizacio order product si no existe
            if (is_null($productRestaurantOrder)) {
                $productRestaurantOrder = new ProductRestaurantOrder();
                $productRestaurantOrder->restaurant_order_id = $restaurantOrder->id;
                $productRestaurantOrder->product_id  = $product_id[$i];
                $productRestaurantOrder->quantity    = $quantity[$i];
                $productRestaurantOrder->price       = $price[$i];
                $productRestaurantOrder->tax_rate         = $taxRate[$i];
                $productRestaurantOrder->subtotal    = $subtotal;
                $productRestaurantOrder->tax_subtotal     = $taxSubtotal;
                $productRestaurantOrder->edition = true;
                if ($ed[$i] == 1) {
                    $productRestaurantOrder->status = 'registered';
                } else {
                    $productRestaurantOrder->status = 'new';
                }
                $productRestaurantOrder->save();
            } else {
                $productRestaurantOrder->restaurant_order_id = $restaurantOrder->id;
                $productRestaurantOrder->product_id  = $product_id[$i];
                $productRestaurantOrder->quantity    = $quantity[$i];
                $productRestaurantOrder->price       = $price[$i];
                $productRestaurantOrder->tax_rate         = $taxRate[$i];
                $productRestaurantOrder->subtotal    = $subtotal;
                $productRestaurantOrder->tax_subtotal     = $taxSubtotal;
                $productRestaurantOrder->edition = true;
                if ($ed[$i] == 1) {
                    $productRestaurantOrder->status = 'registered';
                } else {
                    $productRestaurantOrder->status = 'new';
                }
                $productRestaurantOrder->update();

            }
        }
        $productRestaurantOrders = ProductRestaurantOrder::where('restaurant_order_id', $restaurantOrder->id)->get();
        foreach ($productRestaurantOrders as $key => $productRestaurantOrder) {
            if ($productRestaurantOrder->quantity == 0) {
                $productRestaurantOrder->status = 'canceled';
                $productRestaurantOrder->update();
            }
        }

        session()->forget('restaurantOrder');
        session(['restaurantOrder' => $restaurantOrder->id]);

        toast('Comanda Editada satisfactoriamente.','success');
        return redirect('restaurantOrder');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantOrder $restaurantOrder)
    {
        if($restaurantOrder->status == 'canceled'){
            toast('Comanda Anulada Anteriormente.','success');
            return redirect("restaurantOrder");
        }
        /*
        $balance = $order->balance;
        $valor = $order->total_pay;
        $total = $valor - $balance;*/

        $restaurantOrder->total = 0;
        $restaurantOrder->total_tax = 0;
        $restaurantOrder->total_pay = 0;
        $restaurantOrder->status = 'canceled';
        $restaurantOrder->update();

        toast('Comanda Anulada Satisfactoriamente.','success');
        return redirect("restaurantOrder");
    }

    public function generateInvoice($id)
    {
        $restaurantOrder = RestaurantOrder::findOrFail($id);
        \session()->put('restaurantOrder', $restaurantOrder->id, 60 * 24 * 365);
        \session()->put('total', $restaurantOrder->total, 60 * 24 *365);
        \session()->put('total_tax', $restaurantOrder->total_tax, 60 * 24 *365);
        \session()->put('total_pay', $restaurantOrder->total_pay, 60 * 24 *365);
        \session()->put('status', $restaurantOrder->status, 60 * 24 *365);

        return redirect('productRestaurantOrder/create');
    }

    public function restaurantOrderPos(Request $request, $id)
    {
        $restaurantOrder = RestaurantOrder::where('id', $id)->first();
        $productRestaurantOrders = ProductRestaurantOrder::where('restaurant_order_id', $id)->where('quantity', '>', 0)->get();
        $company = Company::where('id', 1)->first();

        $restaurantOrderpdf = "COMANDA-". $restaurantOrder->id;
        $view = \view('admin.restaurantOrder.pos', compact('restaurantOrder', 'productRestaurantOrders', 'company'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

        return $pdf->stream('vista-pdf', "$restaurantOrderpdf.pdf");
        //return $pdf->download("$orderpdf.pdf");
    }

    public function posRestaurantOrder(Request $request)
    {

        $restaurantOrders = session('restaurantOrder');
        $restaurantOrder = RestaurantOrder::findOrFail($restaurantOrders);
        session()->forget('restaurantOrder');
        $productRestaurantOrders = ProductRestaurantOrder::where('restaurant_order_id', $restaurantOrder->id)->where('quantity', '>', 0)->get();
        $company = Company::where('id', 1)->first();

        $restaurantOrderpos = "COMANDA-". $restaurantOrder->id;
        $view = \view('admin.restaurantOrder.pos', compact('restaurantOrder', 'productRestaurantOrders', 'company'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

        return $pdf->stream('vista-pdf', "$restaurantOrderpos.pdf");
        //return $pdf->download("$orderpdf.pdf");
    }


    public function getRawMaterial(Request $request, $id)
    {
        if($request)
        {
            $productRawMaterials = ProductRawmaterial::from('product_rawmaterials as pr')
            ->join('products as pro', 'pr.product_id', 'pro.id')
            ->join('raw_materials as rm', 'pr.raw_material_id', 'rm.id')
            ->select('rm.id', 'rm.name', 'pro.id as idP', 'pr.quantity as quantityrm', 'pr.consumer_price', )
            ->where('product_id', '=', $id)
            ->get();

            return response()->json($productRawMaterials);
        }
    }
}
