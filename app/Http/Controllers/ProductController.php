<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\BranchProduct;
use App\Models\Category;
use App\Models\Indicator;
use App\Models\Kardex;
use App\Models\MeasureUnit;
use App\Models\ProductRawmaterial;
use App\Models\RawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::get();
            return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('category', function (Product $product) {
                return $product->category->name;
            })
            ->addColumn('tax_rate', function (Product $product) {
                return $product->category->companyTax->percentage->percentage;
            })
            ->addColumn('edit', 'admin/product/actions')
            ->rawcolumns(['edit'])
            ->toJson();
        }
        return view('admin.product.index');
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
        return view('admin.product.create', compact('categories', 'measureUnits', 'rawMaterials', 'indicator'));
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
        $indicator = Indicator::findOrFail(1);
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->measure_unit_id = $request->measure_unit_id;
        $product->code = $request->code;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->type_product = $request->type_product;
        $product->stock = 0;
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
        $branchProduct->stock = 0;
        $branchProduct->save();

        if ($indicator->raw_material == 'on') {
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

        return view("admin.product.edit", compact(
            'product',
            'indicator',
            'rawMaterials',
            'categories',
            'measureUnits',
            'productRawMaterials'
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
        $product->category_id = $request->category_id;
        $product->measure_unit_id = $request->measure_unit_id;
        $product->code = $request->code;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->type_product = $request->type_product;
        $product->stock = $product->stock;

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
}
