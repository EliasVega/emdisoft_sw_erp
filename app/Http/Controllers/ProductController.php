<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\BranchProduct;
use App\Models\Category;
use App\Models\Kardex;
use App\Models\MeasureUnit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

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
            $products = product::get();
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
        $categories = Category::get();
        $measureUnits = MeasureUnit::where('status', 'active')->get();
        return view('admin.product.create', compact('categories', 'measureUnits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
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
            //FileName to store
            $fileNameToStore = time().'.'.$extension;
            //Upload Image
            $path = $request->file('image')->move('images/products',$fileNameToStore);
            } else{
                $fileNameToStore="noimagen.jpg";
            }
            $product->image=$fileNameToStore;
        $product->save();

        //metodo para agregar producto a la sucursal
        $branchProduct = new BranchProduct();
        $branchProduct->branch_id = 1;
        $branchProduct->product_id = $product->id;
        $branchProduct->stock = 0;
        $branchProduct->order_product = 0;
        $branchProduct->save();
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
        $categories = Category::select('id', 'name')->get();
        $measureUnits = MeasureUnit::where('status', 'active')->get();

        return view("admin.product.edit", compact(
            'product',
            'categories',
            'measureUnits'
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
        $product->category_id = $request->category_id;
        $product->measure_unit_id = $request->measure_unit_id;
        $product->code = $request->code;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->type_product = $request->type_product;
        $product->stock = $product->stock;

        //Handle File Upload
        if($request->hasFile('image')){
            //Get filename with the extension
            $filenamewithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image')->guessClientExtension();
            //FileName to store
            $fileNameToStore = time().'.'.$extension;
            //Upload Image
            $path = $request->file('image')->move('images/products',$fileNameToStore);
            } else{
                $fileNameToStore="noimagen.jpg";
            }
            $product->image=$fileNameToStore;
        $product->update();
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
}
