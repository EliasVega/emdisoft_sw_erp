<?php

namespace App\Http\Controllers;

use App\Models\RestaurantOrder;
use App\Http\Requests\StoreRestaurantOrderRequest;
use App\Http\Requests\UpdateRestaurantOrderRequest;
use App\Models\Branch;
use App\Models\CashRegister;
use App\Models\CommandRawmaterial;
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
use function PHPUnit\Framework\isNull;

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
        $branch = Branch::findOrFail(current_user()->branch_id);
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
        $restaurantTables = RestaurantTable::where('id', '!=', 1)->where('branch_id', $branch->id)->get();
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

        $indicator = Indicator::findOrFail(1);
        $cashRegister = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        //Obteniendo variables
        $service = $request->service;//obteniendo el tipo servicio sede o domisilio o rapi
        $table = $request->restaurant_table_id;//obtenendo la mesa
        //variables de producto
        $product_id = $request->product_id;//obteniendo el producto
        $quantity = $request->quantity;//cantidad de productos
        $price = $request->price;//precio de venta del producto
        $taxRate = $request->tax_rate;//obteniendo el impuesto del producto
        $total_pay = $request->total_pay;//valor total a pagar
        $ref = $request->ref;//obteniendo la referencia asignada al producto

        //variables de materias primas
        $raw_material_id = $request->raw_material_id;//obteniendo el id de la materia prima
        $quantityrm = $request->quantityrm;//obteniendo la cantidad de materia primas
        $pricerm = $request->consumer_price;//obteniendo el precio de la materia prima
        $material = $request->material;//nombre de la materia prima
        $idp = $request->idP;//obteniendo el id a que pertenece la materia prima
        $referency = $request->referency;//obteniendo la referencia producto en la materia prima

        $contRmRo = 0;//contador para asignar referencia en rawmaterialRestauantOrders
        $rawMaterials[] = [];//array de las materias primas reales
        $contRM = 0;//contador para el array de $rawMaterials

        //metodo para llenar un array con materias primas
        if ($raw_material_id) {//si existe algun productos con materia prima
            //raw_material_comprobation($request);

            for ($i=0; $i < count($raw_material_id); $i++) {

                $quantityPro = 0;
                $idProd = 0;
                for ($x=0; $x < count($product_id); $x++) {
                    if ($referency[$i] == $ref[$x]) {
                        $quantityPro = $quantity[$x];
                        $idProd = $product_id[$x];
                    }
                }

                $quantityProRm = $quantityPro * $quantityrm[$i];

                if ($rawMaterials[0] != []) {//si aun no hay registro en el array $rawMaterials
                    $contsi = 0;//contador para saber si existe esa materia prima
                    foreach ($rawMaterials as $key => $rawMaterial) {//recorriendo el array $rawMaterials
                        if ($rawMaterial[0] == $raw_material_id[$i]) {//si ya existe en el array esa materia prima
                            $rawMaterial[1] += $quantityProRm;//le suma la nueva cantidad
                            $contsi++;//aumenta el contador para decir que este producto ya esta sumado
                            $rawMaterials[$key] = $rawMaterial;//actualiza el array $rawMaterials
                        }
                    }
                    if ($contsi == 0) {//si contador es igual a 0 quiere decir que no existia la materia prima
                        //si no existe la materia prima crea una nueva linea en el array $rawMaterials
                        $rawMaterials[$contRM] = [$raw_material_id[$i], $quantityProRm, $material[$i]];
                            $contRM++;//aumenta el contador de lineas del array $rawMaterials
                    }
                } else {//si no hay ningun dato en el array crea la primera linea
                    $rawMaterials[$contRM] = [$raw_material_id[$i], $quantityProRm, $material[$i]];
                    $contRM++;

                }
            }
            //metodo que verifica si hay suficiente materias primas para esta comanda
            for ($i=0; $i < count($rawMaterials); $i++) {

                $rawMaterialId = $rawMaterials[$i][0];
                $quantityRawmaterial = $rawMaterials[$i][1];
                $nameRawmaterial = $rawMaterials[$i][2];
                $rawMaterial = RawMaterial::findOrFail($rawMaterialId);
                $stock = $rawMaterial->stock;
                $product = Product::findOrFail($idProd);
                $nameProduct = $product->name;
                if ($quantityRawmaterial > $stock && $rawMaterial->type_product == 'product') {
                    toast("$nameRawmaterial" . ' ' . 'no es suficiente para' . ' ' . "$nameProduct",'warning');
                    //Alert::success('Error', "$nameProduct" . ' ' . 'no es suficiente para' . ' ' . "$nameMenu");
                    return redirect()->back();
                }
            }

        }

        if ($service == 0) {//si el servicio es en mesa o sede
            //metodo que verifica que la mesa esta libre
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
        $restaurantOrder->total_pay = $total_pay;
        $restaurantOrder->status = 'pending';
        $restaurantOrder->note = $request->note;
        $restaurantOrder->user_id = current_user()->id;
        if ($service == 0) {//si el servicio es de mesa
            $restaurantOrder->restaurant_table_id = $request->restaurant_table_id;
        } else {//si el servicio es domicilio
            $restaurantOrder->restaurant_table_id = 1;
        }
        $restaurantOrder->save();

        if (indicator()->pos == 'on') {
            //actualizar la caja
            cashregisterModel()->restaurant_order += $total_pay;
            cashregisterModel()->update();
        }

        //si es un domicilio se crea la tabla Home_orders
        if ($service == 1) {
            $date = Carbon::now();
            $homeOrder = new HomeOrder();
            $homeOrder->type = 'home';
            $homeOrder->name = $request->name;
            $homeOrder->address = $request->address;
            $homeOrder->phone = $request->phone;
            $homeOrder->domiciliary = null;
            $homeOrder->domicile_value = null;
            $homeOrder->time_receipt = $date->toTimeString();
            $homeOrder->time_sent = null;
            $homeOrder->restaurant_order_id = $restaurantOrder->id;
            $homeOrder->save();
        } elseif ($service == 2) {
            $date = Carbon::now();
            $homeOrder = new HomeOrder();
            $homeOrder->type = 'rappi';
            $homeOrder->name = $request->name;
            $homeOrder->address = $request->address;
            $homeOrder->phone = $request->phone;
            $homeOrder->domiciliary = null;
            $homeOrder->domicile_value = null;
            $homeOrder->time_receipt = $date->toTimeString();
            $homeOrder->time_sent = null;
            $homeOrder->restaurant_order_id = $restaurantOrder->id;
            $homeOrder->save();
        }

        if ($raw_material_id) {//si existen materias primas en los productos
            //tomamos los productos que se operan en esta comanda
            for ($i=0; $i < count($product_id); $i++) {

                $productRawmaterial = ProductRawmaterial::where('product_id', $product_id[$i])->get();

                $cont = 0;//contador para subir el contRmRo si es mayor a 0
                $crmstop = 0;//variable para parar el recurso de eliminar en la primera pasada
                //tomamos las materias primas que vienen en esta comanda
                for ($y=0; $y < count($raw_material_id); $y++) {
                    //cantidad de productos por cantidad de materia prima
                    $quantityActual = $quantity[$i] * $quantityrm[$y];
                    //ref hace referencia al producto
                    //referency hace referencia del producto en las materias primas
                    if ($ref[$i] == $referency[$y]) {//si son iguales las referencias
                        //se registra una nueva materia prima comanda
                        $rawMaterialRestaurantOrder = new RawmaterialRestaurantorder();
                        $rawMaterialRestaurantOrder->referency = $contRmRo;
                        $rawMaterialRestaurantOrder->quantity = $quantityrm[$y];
                        $rawMaterialRestaurantOrder->total_quantity = $quantityActual;
                        $rawMaterialRestaurantOrder->consumer_price = $pricerm[$y];
                        $rawMaterialRestaurantOrder->restaurant_order_id = $restaurantOrder->id;
                        $rawMaterialRestaurantOrder->raw_material_id = $raw_material_id[$y];
                        $rawMaterialRestaurantOrder->product_id = $product_id[$i];
                        $rawMaterialRestaurantOrder->save();
                        $cont++;


                        //metodo para editar o poener una materia prima a un producto CommandRawmaterial
                        $crm = 'no';
                        if (count($productRawmaterial) == 0) {
                            $commandRawmaterial = new CommandRawmaterial();
                            $commandRawmaterial->quantity = $quantityrm[$y];
                            $rawMaterialRestaurantOrder->total_quantity = $quantityActual;
                            $commandRawmaterial->referency = $contRmRo;
                            $commandRawmaterial->status = 'add';
                            $commandRawmaterial->restaurant_order_id = $restaurantOrder->id;
                            $commandRawmaterial->product_id = $product_id[$i];
                            $commandRawmaterial->raw_material_id = $raw_material_id[$y];
                            $commandRawmaterial->save();
                        } else {
                            //recorrer array de las materias primas del producto

                            for ($z=0; $z < count($productRawmaterial); $z++) {

                                $quantityPr = $productRawmaterial[$z]->quantity;
                                if ($productRawmaterial[$z]->raw_material_id == $raw_material_id[$y]) {
                                    $crm = 'yes';
                                    if ($quantityPr != $quantityrm[$y]) {
                                        $quantityNew = $quantityrm[$y] - $quantityPr;

                                        //aumenta o disminuye una materia prima a un producto CommandRawmaterial
                                        $commandRawmaterial = new CommandRawmaterial();
                                        $commandRawmaterial->quantity = $quantityNew;
                                        $commandRawmaterial->referency = $contRmRo;
                                        if ($quantityrm[$y] > $quantityPr) {
                                            $commandRawmaterial->status = 'add';
                                        } else {
                                            $commandRawmaterial->status = 'decrease';
                                        }
                                        $commandRawmaterial->restaurant_order_id = $restaurantOrder->id;
                                        $commandRawmaterial->product_id = $product_id[$i];
                                        $commandRawmaterial->raw_material_id = $raw_material_id[$y];
                                        $commandRawmaterial->save();
                                    }
                                }
                                $crmInv = 'no';
                                for ($a=0; $a < count($raw_material_id); $a++) {
                                    if ($ref[$i] == $referency[$a]) {

                                        if ($productRawmaterial[$z]->raw_material_id == $raw_material_id[$a]) {
                                            $crmInv = 'yes';
                                        }
                                    }
                                }
                                if ($crmInv == 'no' && $crmstop == 0) {
                                    $commandRawmaterial = new CommandRawmaterial();
                                    $commandRawmaterial->quantity = $productRawmaterial[$z]->quantity;
                                    $commandRawmaterial->referency = $ref[$i];
                                    $commandRawmaterial->status = 'cancel';
                                    $commandRawmaterial->restaurant_order_id = $restaurantOrder->id;
                                    $commandRawmaterial->product_id = $product_id[$i];
                                    $commandRawmaterial->raw_material_id = $productRawmaterial[$z]->raw_material_id;
                                    $commandRawmaterial->save();
                                }
                            }
                            $crmstop++;//variable para parar el recurso de eliminar en la primera pasada
                            //adiciona una materia prima a un producto CommandRawmaterial
                            if ($crm == 'no') {
                                $commandRawmaterial = new CommandRawmaterial();
                                $commandRawmaterial->quantity = $quantityrm[$y];
                                $commandRawmaterial->referency = $rawMaterialRestaurantOrder->referency;
                                $commandRawmaterial->status = 'add';
                                $commandRawmaterial->restaurant_order_id = $restaurantOrder->id;
                                $commandRawmaterial->product_id = $rawMaterialRestaurantOrder->product_id;
                                $commandRawmaterial->raw_material_id = $rawMaterialRestaurantOrder->raw_material_id;
                                $commandRawmaterial->save();
                            }
                        }

                    }
                }
                if ($cont > 0) {//sube si se crea un $rawMaterialRestaurantOrder

                    $contRmRo++;//aumenta si se crea $rawMaterialRestaurantOrder
                }

            }
        }
        //se aumenta el valor de las comandas en caja
        $sale_box = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        $sale_box->restaurant_order += $restaurantOrder->total_pay;
        $sale_box->update();

        //registro de una relacion entre productos y comandas
        for ($i=0; $i < count($product_id); $i++) {
            //registrando la tabla de orders y productos
            $subtotal = $quantity[$i] * $price[$i];
            $taxSubtotal   = $subtotal * $taxRate[$i]/100;

            $productRestaurantOrder = new ProductRestaurantOrder();
            $productRestaurantOrder->restaurant_order_id = $restaurantOrder->id;
            $productRestaurantOrder->product_id = $product_id[$i];
            $productRestaurantOrder->referency = $ref[$i];
            $productRestaurantOrder->quantity = $quantity[$i];
            $productRestaurantOrder->price = $price[$i];
            $productRestaurantOrder->tax_rate = $taxRate[$i];
            $productRestaurantOrder->subtotal = $subtotal;
            $productRestaurantOrder->tax_subtotal = $taxSubtotal;
            $productRestaurantOrder->save();
        }
        session()->forget('restaurantOrder');
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
        //$indicator = Indicator::findOrFail(1);
        //$cashRegister = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        //llamado a variables
        $ed = $request->ed;//variable para saber si es un producto nuevo

        $service = $request->service;//variable que me dice si es mesa o domicilio
        $table = $request->restaurant_table_id;// variable numero de mesa
        //variables del producto
        $product_id = $request->product_id;//id del producto
        $quantity = $request->quantity;//cantidad de productos
        $price = $request->price;//precio del producto
        $ref = $request->ref;//referencia asignada al producto
        $taxRate = $request->tax_rate;//impuesto de los productos
        $total_pay = $request->total_pay;//total a de la comanda

        //variables de las materias primas
        $raw_material_id = $request->raw_material_id;//id de la MP
        $quantityrm = $request->quantityrm;//cantidad materia prima
        $pricerm = $request->consumer_price;//precio materia prima
        $material = $request->material;//nombre de la materia prima
        $idp = $request->idP;//id del producto que pertenece la MP
        $referency = $request->referency;//referencia asignada a la MP
        $rawMaterials[] = [];//array para sumar las materias primas

        $contRM = 0;
        $contRmRo = 0;//contador para asignar referencia en rawmaterialRestauantOrders

        if (indicator()->pos == 'on') {
            //actualizar la caja
            cashregisterModel()->restaurant_order -= $restaurantOrder->total_pay;
            cashregisterModel()->update();
        }

        if ($raw_material_id) {//si existe request materias primas

            //metodo llenado array materias primas reales para esta comanda
            //raw_material_comprobation($request);

            for ($i=0; $i < count($raw_material_id); $i++) {

                $quantityPro = 0;
                $idProd = 0;
                for ($x=0; $x < count($product_id); $x++) {
                    if ($referency[$i] == $ref[$x]) {
                        $quantityPro = $quantity[$x];
                        $idProd = $product_id[$x];
                    }
                }
                //hallando cantidad total de MP
                $quantityProRm = $quantityPro * $quantityrm[$i];

                if ($rawMaterials[0] != []) {//si aun no hay registro en el array $rawMaterials
                    $contsi = 0;//contador para saber si existe esa materia prima
                    foreach ($rawMaterials as $key => $rawMaterial) {//recorriendo el array $rawMaterials
                        if ($rawMaterial[0] == $raw_material_id[$i]) {//si ya existe en el array esa materia prima
                            $rawMaterial[1] += $quantityProRm;//le suma la nueva cantidad
                            $contsi++;//aumenta el contador para decir que este producto ya esta sumado
                            $rawMaterials[$key] = $rawMaterial;//actualiza el array $rawMaterials
                        }
                    }
                    if ($contsi == 0) {//si contador es igual a 0 quiere decir que no existia la materia prima
                        //si no existe la materia prima crea una nueva linea en el array $rawMaterials
                        $rawMaterials[$contRM] = [$raw_material_id[$i], $quantityProRm, $material[$i]];
                            $contRM++;//aumenta el contador de lineas del array $rawMaterials
                    }
                } else {//si no hay ningun dato en el array crea la primera linea
                    $rawMaterials[$contRM] = [$raw_material_id[$i], $quantityProRm, $material[$i]];
                    $contRM++;

                }
            }
            //metodo que verifica si hay suficiente materias primas para esta comanda
            for ($i=0; $i < count($rawMaterials); $i++) {

                $rawMaterialId = $rawMaterials[$i][0];
                $quantityRawmaterial = $rawMaterials[$i][1];
                $nameRawmaterial = $rawMaterials[$i][2];
                $rawMaterial = RawMaterial::findOrFail($rawMaterialId);
                $stock = $rawMaterial->stock;
                $product = Product::findOrFail($idProd);
                $nameProduct = $product->name;
                if ($quantityRawmaterial > $stock && $rawMaterial->type_product == 'product') {
                    toast("$nameRawmaterial" . ' ' . 'no es suficiente para' . ' ' . "$nameProduct",'warning');
                    //Alert::success('Error', "$nameProduct" . ' ' . 'no es suficiente para' . ' ' . "$nameMenu");
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

        if (indicator()->pos == 'on') {
            //actualizar la caja
            cashregisterModel()->restaurant_order += $total_pay;
            cashregisterModel()->update();
        }

        //si es un domicilio se crea la tabla Home_orders
        if ($service == 1) {
            $date = Carbon::now();
            $homeOrder = HomeOrder::where('order_id', $restaurantOrder->id)->first();
            $homeOrder->name = $request->name;
            $homeOrder->address = $request->address;
            $homeOrder->phone = $request->phone;
            $homeOrder->domiciliary = $request->domiciliary;
            $homeOrder->domicile_value = $request->domicile_value;
            $homeOrder->time_sent = $date->toTimeString();
            $homeOrder->update();
        }
        //llamado de la relacion materias primas con la comanda
        $rawMatRestOrders = RawmaterialRestaurantorder::where('restaurant_order_id', $restaurantOrder->id)->get();
        //volviendo los registros a 0
        foreach ($rawMatRestOrders as $key => $rawMatRestOrder) {
            $rawMatRestOrder->referency = 0;
            $rawMatRestOrder->quantity = 0;
            $rawMatRestOrder->consumer_price = 0;
            $rawMatRestOrder->save();
        }
        //llamado a los registros de commandRawmaterial  que pertenecen a esta orden
        $commandRawmaterials = CommandRawmaterial::where('restaurant_order_id', $restaurantOrder->id)->get();

        //volvemos los registros con los datoa a 0 y estado anulado
        for ($b=0; $b < count($commandRawmaterials); $b++) {
            $commandRawmaterials[$b]->quantity = 0;
            $commandRawmaterials[$b]->referency = 0;
            $commandRawmaterials[$b]->status = 'anulled';
            $commandRawmaterials[$b]->update();
        }

        //si hay registros de materias primas en la edicion
        if ($raw_material_id) {
            //contador para actualizar registros que ya estan
            $contz = 0;//contador para actualizar registros que ya estan
            $contcrm = 0;//contador para poner valor al editar un registro commandRawmaterial
            //llamado de request de productos
            for ($i=0; $i < count($product_id); $i++) {
                //llamado de la relacion productos materias primas
                $productRawmaterial = ProductRawmaterial::where('product_id', $product_id[$i])->get();
                $cont = 0;
                $crmstop = 0;//variable para parar el recurso de eliminar en la primera pasada
                //llamado al request de materias primas
                for ($y=0; $y < count($raw_material_id); $y++) {
                    //cantidad de materia prima para este producto
                    $quantityActual = $quantity[$i] * $quantityrm[$y];
                    //si la referencia es la misma entra
                    if ($ref[$i] == $referency[$y]) {
                        //edicion o creacion de un registro rawmaterialRestaurantorder
                        //si hay registros para esa comanda los actualiza si no crea uno nuevo
                        if ($contz < count($rawMatRestOrders)) {
                            $rawMatRestOrders[$contz]->referency = $ref[$i];
                            $rawMatRestOrders[$contz]->quantity = $quantityrm[$y];
                            $rawMatRestOrders[$contz]->total_quantity = $quantityActual;
                            $rawMatRestOrders[$contz]->consumer_price = $pricerm[$y];
                            $rawMatRestOrders[$contz]->restaurant_order_id = $restaurantOrder->id;
                            $rawMatRestOrders[$contz]->raw_material_id = $raw_material_id[$y];
                            $rawMatRestOrders[$contz]->product_id = $product_id[$i];
                            $rawMatRestOrders[$contz]->update();
                            $contz++;
                            $cont++;
                        } else {
                            //si no existe ese registro crea uno nuevo
                            $rawMaterialRestaurantOrder = new RawmaterialRestaurantorder();
                            $rawMaterialRestaurantOrder->referency = $ref[$i];
                            $rawMaterialRestaurantOrder->quantity = $quantityrm[$y];
                            $rawMaterialRestaurantOrder->total_quantity = $quantityActual;
                            $rawMaterialRestaurantOrder->consumer_price = $pricerm[$y];
                            $rawMaterialRestaurantOrder->restaurant_order_id = $restaurantOrder->id;
                            $rawMaterialRestaurantOrder->raw_material_id = $raw_material_id[$y];
                            $rawMaterialRestaurantOrder->product_id = $product_id[$i];
                            $rawMaterialRestaurantOrder->save();
                            $cont++;
                        }

                        //metodo para editar o poener una materia prima a un producto CommandRawmaterial
                        $crm = 'no';//variable para si es addicion de materia prima nueva

                        /* -- si el producto no tiene materias primas pero se agregaron -- */
                        //si este producto tiene materias primas entramos a crear un registro
                        if (count($productRawmaterial) == 0) {
                            //Si fueron agregadas materias primas a este producto
                            //si hay registros en 0 lo editamos con nuevos valores

                            /* ---- PASO 1 ----- */
                            /* ----  ADICIONA MATERIAS PRIMAS QUE NO EXISTIAN EN EL PRODUCTO ----- */

                            if ($contcrm < count($commandRawmaterials)) {
                                $commandRawmaterials[$contcrm]->quantity = $quantityrm[$y];
                                $commandRawmaterials[$contcrm]->referency = $contRmRo;
                                $commandRawmaterials[$contcrm]->status = 'add';
                                $commandRawmaterials[$contcrm]->restaurant_order_id = $restaurantOrder->id;
                                $commandRawmaterials[$contcrm]->product_id = $product_id[$i];
                                $commandRawmaterials[$contcrm]->raw_material_id = $raw_material_id[$y];
                                $commandRawmaterials[$contcrm]->update();
                                $contcrm++;
                            } else {
                                //si no hay registros en 0 creamos uno nuevo
                                $commandRawmaterial = new CommandRawmaterial();
                                $commandRawmaterial->quantity = $quantityrm[$y];
                                $commandRawmaterial->referency = $contRmRo;
                                $commandRawmaterial->status = 'add';
                                $commandRawmaterial->restaurant_order_id = $restaurantOrder->id;
                                $commandRawmaterial->product_id = $product_id[$i];
                                $commandRawmaterial->raw_material_id = $raw_material_id[$y];
                                $commandRawmaterial->save();
                                $contcrm++;
                            }

                        } else {
                            /* -- si el producto tiene materias primas y se edita -- */
                            //recorrer array de las materias primas del producto
                            for ($z=0; $z < count($productRawmaterial); $z++) {
                                //hallar la cantidad de materia primma que tiene asignada este producto
                                $quantityPr = $productRawmaterial[$z]->quantity;
                                //comparamos si la materia prima de este producto es igual a la materia prima del request
                                if ($productRawmaterial[$z]->raw_material_id == $raw_material_id[$y]) {
                                    //cambio la variable para no ejecutar como materia prima agregada
                                    $crm = 'yes';//si existe materia prima

                                    //si la cantidad asiganada es diferente a la cantidad del request
                                    if ($quantityPr != $quantityrm[$y]) {
                                        //hallamos la diferencia
                                        $quantityNew = $quantityrm[$y] - $quantityPr;

                                        /* ---- PASO 2 ----- */
                                            /* ----  SUMA O RESTA MATERIAS PRIMAS A ESTE PRODUCTO EDICION ----- */
                                        //si hay registros en 0 lo editamos con nuevos valores
                                        if ($contcrm < count($commandRawmaterials)) {

                                            //aumenta o disminuye una materia prima a un producto CommandRawmaterial
                                            //edita un registro existente pero que esta en 0
                                            $commandRawmaterials[$contcrm]->quantity = $quantityNew;
                                            $commandRawmaterials[$contcrm]->referency = $contRmRo;
                                            if ($quantityrm[$y] > $quantityPr) {
                                                $commandRawmaterials[$contcrm]->status = 'add';
                                            } else {
                                                $commandRawmaterials[$contcrm]->status = 'decrease';
                                            }
                                            $commandRawmaterials[$contcrm]->restaurant_order_id = $restaurantOrder->id;
                                            $commandRawmaterials[$contcrm]->product_id = $product_id[$i];
                                            $commandRawmaterials[$contcrm]->raw_material_id = $raw_material_id[$y];
                                            $commandRawmaterials[$contcrm]->update();
                                            $contcrm++;
                                        } else {
                                            //aumenta o disminuye una materia prima a un producto CommandRawmaterial
                                            //crea un nuevo registro porque no hay registros en 0
                                            $commandRawmaterial = new CommandRawmaterial();
                                            $commandRawmaterial->quantity = $quantityNew;
                                            $commandRawmaterial->referency = $contRmRo;
                                            if ($quantityrm[$y] > $quantityPr) {
                                                $commandRawmaterial->status = 'add';
                                            } else {
                                                $commandRawmaterial->status = 'decrease';
                                            }
                                            $commandRawmaterial->restaurant_order_id = $restaurantOrder->id;
                                            $commandRawmaterial->product_id = $product_id[$i];
                                            $commandRawmaterial->raw_material_id = $raw_material_id[$y];
                                            $commandRawmaterial->save();
                                            $contcrm++;
                                        }
                                    }
                                }
                                /* ---- PASO 3 ----- */
                                /* ----  QUITA UNA MP QUE ESTA EN EL PRODUCTO Y SE ELIMINA ----- */
                                $crmInv = 'no';//variable para actualizar un registro que se quita una MP
                                //recoremos las materias primas del request
                                for ($a=0; $a < count($raw_material_id); $a++) {
                                    //si las referencias coinciden
                                    if ($ref[$i] == $referency[$a]) {
                                        if ($productRawmaterial[$z]->raw_material_id == $raw_material_id[$a]) {
                                            $crmInv = 'yes';//quiere decir que la MP esta en este producto
                                        }
                                    }
                                }
                                //si la MP no esta se registra como eliminar
                                //$crmstop para el registro en la primera pasada y no se duplica
                                if ($crmInv == 'no' && $crmstop == 0) {
                                    //si hay registros en 0 lo editamos con nuevos valores
                                    if ($contcrm < count($commandRawmaterials)) {
                                        $commandRawmaterials[$contcrm]->quantity = $productRawmaterial[$z]->quantity;
                                        $commandRawmaterials[$contcrm]->referency = $ref[$i];
                                        $commandRawmaterials[$contcrm]->status = 'cancel';
                                        $commandRawmaterials[$contcrm]->restaurant_order_id = $restaurantOrder->id;
                                        $commandRawmaterials[$contcrm]->product_id = $product_id[$i];
                                        $commandRawmaterials[$contcrm]->raw_material_id = $productRawmaterial[$z]->raw_material_id;
                                        $commandRawmaterials[$contcrm]->update();
                                        $contcrm++;
                                    } else {
                                        //crea un nuevo registro porque no hay registros en 0
                                        $commandRawmaterial = new CommandRawmaterial();
                                        $commandRawmaterial->quantity = $productRawmaterial[$z]->quantity;
                                        $commandRawmaterial->referency = $ref[$i];
                                        $commandRawmaterial->status = 'cancel';
                                        $commandRawmaterial->restaurant_order_id = $restaurantOrder->id;
                                        $commandRawmaterial->product_id = $product_id[$i];
                                        $commandRawmaterial->raw_material_id = $productRawmaterial[$z]->raw_material_id;
                                        $commandRawmaterial->save();
                                        $contcrm++;
                                    }
                                }
                            }
                            $crmstop++;//variable que me indica que ya se hizo el registro

                            /* ---- PASO 4 ----- */
                            /* ----  ADICIONA UNA MP QUE NO EXISTIA EN ESE PRODUCTO ----- */
                            //adiciona una materia prima a un producto CommandRawmaterial
                            if ($crm == 'no') {//si no existia MP
                                //si hay registros en 0 lo editamos con nuevos valores
                                if ($contcrm < count($commandRawmaterials)) {
                                    $commandRawmaterials[$contcrm]->quantity = $quantityrm[$y];
                                    $commandRawmaterials[$contcrm]->referency = $referency[$y];
                                    $commandRawmaterials[$contcrm]->status = 'add';
                                    $commandRawmaterials[$contcrm]->restaurant_order_id = $restaurantOrder->id;
                                    $commandRawmaterials[$contcrm]->product_id = $product_id[$i];
                                    $commandRawmaterials[$contcrm]->raw_material_id = $raw_material_id[$y];
                                    $commandRawmaterials[$contcrm]->update();
                                    $contcrm++;
                                } else {
                                    //crea un nuevo registro porque no hay registros en 0
                                    $commandRawmaterial = new CommandRawmaterial();
                                    $commandRawmaterial->quantity = $quantityrm[$y];
                                    $commandRawmaterial->referency = $referency[$y];;
                                    $commandRawmaterial->status = 'add';
                                    $commandRawmaterial->restaurant_order_id = $restaurantOrder->id;
                                    $commandRawmaterial->product_id = $product_id[$i];
                                    $commandRawmaterial->raw_material_id = $raw_material_id[$y];
                                    $commandRawmaterial->save();
                                    $contcrm++;
                                }
                            }
                        }



                    }
                }
                if ($cont > 0) {
                    $contRmRo++;
                }
            }
        }

        //actualizando los registros de ProductRestaurantOrder
        //llamado a las relaciones de productos con esta comanda
        $productRestaurantOrders = ProductRestaurantOrder::where('restaurant_order_id', $restaurantOrder->id)->get();
        //recorriendo los registros para volverlos a 0
        foreach ($productRestaurantOrders as $key => $productRestaurantOrder) {

            $productRestaurantOrder->referency = 0;
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

        //Recorriendo el array del request de productos
        for ($i=0; $i < count($product_id); $i++) {
            //obteniendo las relaciones de este producto con esta comanda que no este editada
            $productRestaurantOrder = ProductRestaurantOrder::where('restaurant_order_id', $restaurantOrder->id)->where('product_id', $product_id[$i])->where('edition', false)->first();

            $subtotal = $quantity[$i] * $price[$i];
            $taxSubtotal = $subtotal * $taxRate[$i]/100;

            //Inicia proceso actualizacio order product si no existe
            if (is_null($productRestaurantOrder)) {//si no existe lo creo
                $productRestaurantOrder = new ProductRestaurantOrder();
                $productRestaurantOrder->restaurant_order_id = $restaurantOrder->id;
                $productRestaurantOrder->product_id  = $product_id[$i];
                $productRestaurantOrder->referency = $ref[$i];
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
            } else {//si existe se actualiza
                $productRestaurantOrder->restaurant_order_id = $restaurantOrder->id;
                $productRestaurantOrder->product_id  = $product_id[$i];
                $productRestaurantOrder->referency = $ref[$i];
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
        //obteniendo los registros de productosRestaurantOrders
        $productRestaurantOrders = ProductRestaurantOrder::where('restaurant_order_id', $restaurantOrder->id)->get();
        //recorrer registros para cancelar registros que en la edicion ya no van
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
        $commandRawmaterials = CommandRawmaterial::where('restaurant_order_id', $id)->get();

        //dd($commandRawmaterials);
        $company = Company::where('id', 1)->first();
        $indicator = Indicator::findOrFail(1);
        $restaurantOrderpdf = "COMANDA-". $restaurantOrder->id;
        $view = \view('admin.restaurantOrder.pos', compact(
            'restaurantOrder',
            'productRestaurantOrders',
            'commandRawmaterials',
            'company',
            'indicator'
            ))->render();
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
        $commandRawmaterials = CommandRawmaterial::where('restaurant_order_id', $restaurantOrder->id)->get();
        $company = Company::where('id', 1)->first();
        $indicator = Indicator::findOrFail(1);
        $restaurantOrderpos = "COMANDA-". $restaurantOrder->id;
        $view = \view('admin.restaurantOrder.pos', compact(
            'restaurantOrder',
            'productRestaurantOrders',
            'commandRawmaterials',
            'company',
            'indicator'
            ))->render();
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
