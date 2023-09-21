<?php

namespace App\Http\Controllers;

use App\Models\Percentage;
use App\Http\Requests\StorePercentageRequest;
use App\Http\Requests\UpdatePercentageRequest;
use App\Models\TaxType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PercentageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:percentage.index|percentage.create|percentage.show|percentage.edit|percentage.destroy|percentage.percentageStatus', ['only'=>['index']]);
        $this->middleware('permission:percentage.create', ['only'=>['create','store']]);
        $this->middleware('permission:percentage.show', ['only'=>['show']]);
        $this->middleware('permission:percentage.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:percentage.destroy', ['only'=>['destroy']]);
        $this->middleware('permission:percentage.percentageStatus', ['only'=>['status']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $percentages = Percentage::get();

            return DataTables::of($percentages)
            ->addColumn('edit', 'admin/percentage/accesos/edit')
            ->addColumn('status', 'admin/percentage/accesos/status')
            ->addColumn('destroy', 'admin/percentage/accesos/destroy')
            ->rawColumns(['edit', 'status', 'destroy'])
            ->make(true);
        }
        return view('admin.percentage.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taxTypes = TaxType::get();
        return view('admin.percentage.create', compact('taxTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePercentageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePercentageRequest $request)
    {
        $percentage = new Percentage();
        $percentage->name = $request->name;
        $percentage->percentage = $request->percentage;
        $percentage->base = $request->base;
        $percentage->base_uvt = $request->base_uvt;
        $percentage->concept = $request->concept;
        $percentage->status = 'active';
        $percentage->tax_type_id = $request->tax_type_id;
        $percentage->save();
        toast('Porcentaje Registrado satisfactoriamente.','success');
        return redirect("percentage");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Percentage  $percentage
     * @return \Illuminate\Http\Response
     */
    public function show(Percentage $percentage)
    {
        return view('admin.percentage.show', compact('percentage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Percentage  $percentage
     * @return \Illuminate\Http\Response
     */
    public function edit(Percentage $percentage)
    {
        $taxTypes = TaxType::get();
        return view('admin.percentage.edit', compact('percentage', 'taxTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePercentageRequest  $request
     * @param  \App\Models\Percentage  $percentage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePercentageRequest $request, Percentage $percentage)
    {
        $percentage->name = $request->name;
        $percentage->percentage = $request->percentage;
        $percentage->base = $request->base;
        $percentage->base_uvt = $request->base_uvt;
        $percentage->concept = $request->concept;
        $percentage->status = 'active';
        $percentage->tax_type_id = $request->tax_type_id;
        $percentage->update();
        toast('Porcentaje Editado satisfactoriamente.','success');
        return redirect("percentage");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Percentage  $percentage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Percentage $percentage)
    {
        $percentage->delete();
        toast('Porcentage eliminado con éxito.','success');
        return redirect('percentage');
    }

    public function status($id)
    {

        $percentage = Percentage::findOrFail($id);
        if ($percentage->status == 'active') {
            $percentage->status = 'inactive';
        } else {
            $percentage->status = 'active';
        }
        $percentage->update();

        return redirect('percentage');
    }
}
