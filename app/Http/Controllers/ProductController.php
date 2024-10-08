<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Imports\ProductsImport;
use App\Models\BranchProduct;
use App\Models\Category;
use App\Models\Indicator;
use App\Models\Kardex;
use App\Models\MeasureUnit;
use App\Models\ProductRawmaterial;
use App\Models\RawMaterial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product.index|product.create|product.show|product.edit|product.destroy', ['only'=>['index']]);
        $this->middleware('permission:product.create', ['only'=>['create','store']]);
        $this->middleware('permission:product.show', ['only'=>['show']]);
        $this->middleware('permission:product.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:product.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBarcode()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::get();
            return DataTables::of($products)
            ->addColumn('edit', 'admin/product/actions')
            ->rawcolumns(['edit'])
            ->toJson();
        }
        return view('admin.product.index');
    }

    public function indexMin(Request $request)
    {
        if ($request->ajax()) {
            $prods = Product::get();
            $products = [];
            $cont = 0;
            foreach ($prods as $key => $prod) {
                if ($prod->stock <= $prod->stoct_min) {
                    $products[$cont] = $prod;
                    $cont++;
                }
            }
            return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('category', function (Product $product) {
                return $product->category->name;
            })
            ->addColumn('edit', 'admin/product/actions')
            ->rawcolumns(['edit'])
            ->toJson();
        }
        return view('admin.product.index_min');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $indicator = Indicator::findOrFail(1);
        $rawMaterials = RawMaterial::get();
        $categories = Category::get();
        $measureUnits = MeasureUnit::where('status', 'active')->get();
        $operation = 'create';
        $cols = 5;
        return view('admin.product.create', compact(
            'categories',
            'measureUnits',
            'rawMaterials',
            'indicator',
            'operation',
            'cols'
        ));
    }

    public function productImport()
    {
        return view('admin.product.products_import');
    }
    /*
    public function productStore(Request $request)
    {
        Excel::import(new ProductsImport, request()->file('products'));

        $message = 'Importacion de Productos realizada con exito';
        //Alert::success('Categoria', $message);
        toast($message,'success');
        //Alert::success('Categoria','Creada Satisfactoriamente.');
        return redirect('product');
    }*/

    public function productStore(Request $request)
    {
        $validatedData = $request->validate([

            'code' => 'required|string|max:20',
            'name' => 'required|string|max:200',
            'price' => 'required|numeric',
            'sale_price' => '',
            'stock' => '',
            'stock_min' => 'nullable',
            'commission' => '',
            'status' => 'required|in:active,inactive',
            'type_product' => 'required|in:product,service,consumer',
            'imageName' => '',
            'name' => '',
            'category_id' => '',
            'measure_unit_id' => ''
        ]);

        $product = Product::create($validatedData);

        $branchProduct = new BranchProduct();
        $branchProduct->branch_id = current_user()->branch_id;
        $branchProduct->product_id = $product->id;
        $branchProduct->stock = $request->stock;
        $branchProduct->save();
        $data = Product::from('products as pro')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('pro.id', 'pro.code', 'pro.stock', 'pro.sale_price', 'pro.name', 'cat.utility_rate', 'per.percentage', 'tt.id as tt')
        ->where('pro.status', '=', 'active')
        ->where('pro.id', '=', $product->id)
        ->first();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //dd($request->all());
        $commission = $request->commission;
        if ($commission == null) {
            $commission = '0.00';
        }

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->measure_unit_id = $request->measure_unit_id;
        $product->code = $request->code;
        $product->name = $request->name_product;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->commission = $commission;
        $product->type_product = $request->type_product;
        $product->stock = $request->stock;
        $product->stock_min = $request->stock_min;
        $product->status = $request->status;
        //$product->stock = 0;
        //Handle File Upload
        if($request->hasFile('image')){
            //Get filename with the extension
            $filenamewithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image')->guessClientExtension();

            $image = Image::make($request->file('image'))->encode('jpg', 75);
            $image->resize(512,448,function($constraint) {
                $constraint->upsize();
            });
            //FileName to store
            $fileNameToStore = time() . '.jpg';
            $product->imageName = $fileNameToStore;
            //Upload Image
            Storage::disk('public')->put("images/products/$fileNameToStore", $image->stream());
            $fileNameToStore = Storage::url("images/products/$fileNameToStore");
        } else{
            $product->imageName = 'noimage.jpg';
            $fileNameToStore="/storage/images/products/noimage.jpg";
        }
        $product->image=$fileNameToStore;
        $product->save();

        $branchProduct = new BranchProduct();
        $branchProduct->branch_id = 1;
        $branchProduct->product_id = $product->id;
        $branchProduct->stock = $request->stock;

        $branchProduct->save();

        if (indicator()->raw_material == 'on') {
            $quantity = $request->quantity;
            $consumer = $request->consumer_price;
            $rawMaterial = $request->raw_material_id;
            if ($quantity) {
                for ($i=0; $i < count($quantity); $i++) {
                    $productRawmaterials = new ProductRawmaterial();
                    $productRawmaterials->quantity = $quantity[$i];
                    $productRawmaterials->consumer_price = $consumer[$i];
                    $productRawmaterials->subtotal = $quantity[$i] * $consumer[$i];
                    $productRawmaterials->raw_material_id = $rawMaterial[$i];
                    $productRawmaterials->product_id = $product->id;
                    $productRawmaterials->save();
                }
            }
        }
        Alert::success('Producto','Creado con éxito.');
        return redirect('product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $indicator = Indicator::findOrFail(1);
        $rawMaterials = RawMaterial::get();
        $categories = Category::get();
        $measureUnits = MeasureUnit::where('status', 'active')->get();
        $productRawMaterials = ProductRawmaterial::from('product_rawmaterials as prm')
        ->join('products as pro', 'prm.product_id', 'pro.id')
        ->join('raw_materials as rm', 'prm.raw_material_id', 'rm.id')
        ->select('rm.id', 'rm.name', 'prm.quantity', 'prm.consumer_price')
        ->where('product_id', $product->id)
        ->get();
        $operation = 'edit';
        $cols = 6;

        return view("admin.product.edit", compact(
            'product',
            'indicator',
            'rawMaterials',
            'categories',
            'measureUnits',
            'productRawMaterials',
            'operation',
            'cols'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //dd($request->all());
        $commission = 0;
        $commissions = $request->commission;
        if ($commissions) {
            $commission = $request->commission;
        }

        $product->category_id = $request->category_id;
        $product->measure_unit_id = $request->measure_unit_id;
        $product->code = $request->code;
        $product->name = $request->name_product;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->commission = $commission;
        $product->type_product = $request->type_product;
        $product->stock = $request->stock;
        $product->stock_min = $request->stock_min;
        $product->status = $request->status;
        $currentImage = $product->imageName;
        //Handle File Upload
        if($request->hasFile('image')){
            if ($currentImage != 'noimage.jpg') {
                Storage::disk('public')->delete("images/products/$currentImage");
            }
            //Get filename with the extension
            $filenamewithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image')->guessClientExtension();

            $image = Image::make($request->file('image'))->encode('jpg', 75);
            $image->resize(512,448,function($constraint) {
                $constraint->upsize();
            });
            //FileName to store
            $fileNameToStore = time() . '.jpg';
            $product->imageName = $fileNameToStore;
            //Upload Image
            Storage::disk('public')->put("images/products/$fileNameToStore", $image->stream());
            $fileNameToStore = Storage::url("images/products/$fileNameToStore");
        } else{
            $product->imageName = 'noimage.jpg';
            $fileNameToStore="/storage/images/products/noimage.jpg";
        }
        $product->image=$fileNameToStore;

        $product->update();

        $branchProduct = BranchProduct::where('branch_id', 1)->where('product_id', $product->id)->first();
        $branchProduct->stock = $request->stock;
        $branchProduct->save();

        $indicator = Indicator::findOrFail(1);
        if ($indicator->raw_material == 'on') {
            $quantity = $request->quantity;
            $consumer_price = $request->consumer_price;
            $rawMaterial = $request->raw_material_id;

            for ($i=0; $i < count($quantity); $i++) {
                $productRawmaterials = ProductRawmaterial::where('product_id', $product->id)->where('raw_material_id', $rawMaterial[$i])->first();
                if ($productRawmaterials) {
                    $productRawmaterials->quantity = $quantity[$i];
                    $productRawmaterials->consumer_price = $consumer_price[$i];
                    $productRawmaterials->subtotal = $quantity[$i] * $consumer_price[$i];
                    $productRawmaterials->update();
                } else {
                    $productRawmaterials = new ProductRawmaterial();
                    $productRawmaterials->quantity = $quantity[$i];
                    $productRawmaterials->consumer_price = $consumer_price[$i];
                    $productRawmaterials->subtotal = $quantity[$i] * $consumer_price[$i];
                    $productRawmaterials->raw_material_id = $rawMaterial[$i];
                    $productRawmaterials->product_id = $product->id;
                    $productRawmaterials->save();
                }
            }
        }

        toast('Producto Editado con éxito.','success');
        return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $kardex = Kardex::where('product_id', $product->id)->get();
        $cont = count($kardex);
        if ($cont > 0) {
            toast('No puedes Eliminar este Producto tiene Movimientos asignados','warning');
            return redirect("product");

        } else {
            $product->delete();
            toast('Producto Eliminado con Exito.','success');
            return redirect("category");
        }
    }

    public function status($id)
    {

        $product = Product::findOrFail($id);
        if ($product->status == 'active') {
            $product->status = 'inactive';
        } else {
            $product->status = 'active';
        }
        $product->update();

        return redirect('product');
    }

    public function getProduct(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::from('products as pro')
            ->join('categories as cat', 'pro.category_id', 'cat.id')
            ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
            ->join('percentages as per', 'ct.percentage_id', 'per.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('pro.id', 'pro.name', 'pro.stock', 'pro.stock_min', 'pro.price', 'pro.sale_price', 'per.percentage', 'tt.id as tt')
            ->where('pro.code', $request->code)
            ->first();
            if ($products) {
                return response()->json($products);
            }
        }
    }

    public function kardexProduct(Request $request, $id)
    {
        if ($request->ajax()) {
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date');
            $endDate = $request->id;
            if ($startDate && $endDate) {
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDate . ' 00:00:00');
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $endDate . ' 23:59:59');

                $kardexes = Kardex::where('kardexeable_id', $id)->whereBetween('created_at', [$startDateTime, $endDateTime])->get();
            } else {
                $kardexes = Kardex::where('kardexeable_id', $id)->get();
            }
            return DataTables::of($kardexes)
            ->addIndexColumn()
            ->addColumn('branch', function (Kardex $kardex) {
                return $kardex->branch->name;
            })
            ->addColumn('operation', function (Kardex $kardex) {
                if ($kardex->movement == 'purchase') {
                    return $kardex->movement == 'purchase' ? 'Compra' : 'Compra';
                } elseif ($kardex->movement == 'expense') {
                    return $kardex->movement == 'expense' ? 'Gasto' : 'Gasto';
                }elseif ($kardex->movement == 'ndpurchase') {
                    return $kardex->movement == 'ndpurchase' ? 'ND compra' : 'ND compra';
                } elseif ($kardex->movement == 'ncpurchase'){
                    return $kardex->movement == 'ncpurchase' ? 'Nc compra' : 'Nc compra';
                } elseif ($kardex->movement == 'invoice') {
                    return $kardex->movement == 'invoice' ? 'Venta' : 'Venta';
                }elseif ($kardex->movement == 'ndinvoice') {
                    return $kardex->movement == 'ndinvoice' ? 'ND venta' : 'ND venta';
                } elseif ($kardex->movement == 'ncinvoice'){
                    return $kardex->movement == 'ncinvoice' ? 'Nc venta' : 'Nc venta';
                }
            })

            ->addColumn('product_id', function (Kardex $kardex) {
                return $kardex->kardexable->id;
            })
            ->addColumn('product', function (Kardex $kardex) {
                return $kardex->kardexable->name;
            })
            ->editColumn('created_at', function(Kardex $kardex){
                return $kardex->created_at->format('Y-m-d');
            })
            ->addColumn('edit', 'admin/kardex/actions')
            ->rawcolumns(['edit'])
            ->toJson();
        }
        return view('admin.kardex.kardexProduct');
    }

    public function kardexPro($id)
    {
        $product = Product::findOrFail($id);
        Session::put('product', $product->id, 60 * 24 * 365);

        return redirect('kardexProduct');
    }
}
