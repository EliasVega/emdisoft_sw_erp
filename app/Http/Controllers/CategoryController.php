<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Imports\CategoryImport;
use App\Models\CompanyTax;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category.index|category.create|category.show|category.edit|category.destroy', ['only'=>['index']]);
        $this->middleware('permission:category.create', ['only'=>['create','store']]);
        $this->middleware('permission:category.show', ['only'=>['show']]);
        $this->middleware('permission:category.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:category.destroy', ['only'=>['destroy']]);
        $this->middleware('permission:category.categoryStatus', ['only'=>['status']]);
        $this->middleware('permission:category.categoryInactive', ['only'=>['inactive']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::where('status', 'active')->get();

            return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('tax', function (Category $category) {
                return $category->companyTax->name;
            })
            ->addColumn('percentage', function (Category $category) {
                return $category->companyTax->percentage->percentage;
            })
            ->addColumn('btn', 'admin/category/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }

        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$companyTaxes = CompanyTax::where('type_tax', 'tax_item')->get();
        $companyTaxes = CompanyTax::from('company_taxes as ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->where('tt.type_tax', 'tax_item')
        ->get();
        return view('admin.category.create', compact('companyTaxes'));
    }

    public function createImport()
    {
        return view('admin.category.category_import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $message = 'Creada Satisfactoriamente';
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->utility_rate = $request->utility_rate;
        $category->company_tax_id = $request->company_tax_id;
        $category->save();

        toast($message,'success');
        return redirect('category');
    }

    public function storeCategory(Request $request)
    {
        $category = $request->file('category_file');
        //Excel::import(new CategoryImport, $category);

        $message = 'Importacion de Categorias realizada con exito';
        //Alert::success('Categoria', $message);
        toast($message,'success');
        //Alert::success('Categoria','Creada Satisfactoriamente.');
        return redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $companyTaxes = CompanyTax::from('company_taxes as ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->where('tt.type_tax', 'tax_item')->get();
        return view('admin.category.edit', compact('category', 'companyTaxes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->description = $request->description;
        $category->utility_rate = $request->utility_rate;
        $category->company_tax_id = $request->company_tax_id;
        $category->update();
        Alert::success('Categoria','Editada Satisfactoriamente.');
        return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();
        $cont = count($products);
        if ($cont > 0) {
            toast('No puedes Eliminar esta Categoria tiene productos asignados','success');
            return redirect("category");
            //return redirect("category")->with('success', 'No puedes Eliminar esta Categoria tiene productos asignados');

        } else {
            $category->delete();
            toast('Categoria Eliminada con Exito.','warning');
            return redirect("category");
        }
    }

    public function inactive(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::where('status', 'inactive')->get();

            return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('tax_rate', function (Category $category) {
                return $category->companyTax->percentage->percentage;
            })
            ->addColumn('btn', 'admin/category/active')
            ->rawcolumns(['btn'])
            ->make(true);
        }

        return view('admin.category.inactive');
    }

    public function status($id)
    {

        $category = Category::findOrFail($id);
        if ($category->status == 'active') {
            $category->status = 'inactive';
        } else {
            $category->status = 'active';
        }
        $category->update();

        return redirect('category');
    }
}
