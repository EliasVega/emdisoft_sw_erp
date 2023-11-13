<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use App\Http\Requests\StoreRawMaterialRequest;
use App\Http\Requests\UpdateRawMaterialRequest;
use App\Models\BranchRawmaterial;
use App\Models\Category;
use App\Models\Kardex;
use App\Models\MeasureUnit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class RawMaterialController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:rawMaterial.index|rawMaterial.create|rawMaterial.show|rawMaterial.edit|rawMaterial.destroy', ['only'=>['index']]);
        $this->middleware('permission:rawMaterial.create', ['only'=>['create','store']]);
        $this->middleware('permission:rawMaterial.show', ['only'=>['show']]);
        $this->middleware('permission:rawMaterial.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:rawMaterial.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rawMaterials = RawMaterial::get();
            return DataTables::of($rawMaterials)
            ->addIndexColumn()
            ->addColumn('category', function (RawMaterial $rawMaterial) {
                return $rawMaterial->category->name;
            })
            ->addColumn('tax_rate', function (RawMaterial $rawMaterial) {
                return $rawMaterial->category->companyTax->percentage->percentage;
            })
            ->addColumn('edit', 'admin/rawMaterial/actions')
            ->rawcolumns(['edit'])
            ->toJson();
        }
        return view('admin.rawMaterial.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $measureUnits = MeasureUnit::where('status', 'active')->get();
        return view('admin.rawMaterial.create', compact('categories', 'measureUnits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRawMaterialRequest $request)
    {
        $rawMaterial = new RawMaterial();
        $rawMaterial->category_id = $request->category_id;
        $rawMaterial->measure_unit_id = $request->measure_unit_id;
        $rawMaterial->code = $request->code;
        $rawMaterial->name = $request->name;
        $rawMaterial->price = $request->price;
        $rawMaterial->type_product = $request->type_product;
        $rawMaterial->stock = 0;
        $rawMaterial->save();

        $branchRawmaterials = new BranchRawmaterial();
        $branchRawmaterials->branch_id = 1;
        $branchRawmaterials->raw_material_id = $rawMaterial->id;
        $branchRawmaterials->stock = 0;
        $branchRawmaterials->save();

        Alert::success('Materia Prima','Creada con éxito.');
        return redirect('rawMaterial');
    }

    /**
     * Display the specified resource.
     */
    public function show(RawMaterial $rawMaterial)
    {
        return view('admin.rawMaterial.show', compact('rawMaterial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RawMaterial $rawMaterial)
    {
        $categories = Category::select('id', 'name')->get();
        $measureUnits = MeasureUnit::where('status', 'active')->get();

        return view("admin.rawMaterial.edit", compact(
            'rawMaterial',
            'categories',
            'measureUnits'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRawMaterialRequest $request, RawMaterial $rawMaterial)
    {
        $rawMaterial->category_id = $request->category_id;
        $rawMaterial->measure_unit_id = $request->measure_unit_id;
        $rawMaterial->code = $request->code;
        $rawMaterial->name = $request->name;
        $rawMaterial->price = $request->price;
        $rawMaterial->sale_price = $request->sale_price;
        $rawMaterial->type_product = $request->type_product;
        $rawMaterial->stock = $rawMaterial->stock;
        $rawMaterial->update();

        toast('Materia Prima Editada con éxito.','success');
        return redirect('rawMaterial');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RawMaterial $rawMaterial)
    {
        $kardex = Kardex::where('rawMaterial_id', $rawMaterial->id)->get();
        $cont = count($kardex);
        if ($cont > 0) {
            toast('No puedes Eliminar este Producto tiene Movimientos asignados','warning');
            return redirect("rawMaterial");

        } else {
            $rawMaterial->delete();
            toast('Materia Prima Eliminada con Exito.','success');
            return redirect("category");
        }
    }

    public function status($id)
    {

        $rawMaterial = RawMaterial::findOrFail($id);
        if ($rawMaterial->status == 'active') {
            $rawMaterial->status = 'inactive';
        } else {
            $rawMaterial->status = 'active';
        }
        $rawMaterial->update();

        return redirect('rawMaterial');
    }


}
