<?php

namespace App\Http\Controllers;

use App\Models\MeasureUnit;
use App\Http\Requests\StoreMeasureUnitRequest;
use App\Http\Requests\UpdateMeasureUnitRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MeasureUnitController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:measureUnit.index|measureUnit.create|measureUnit.show|measureUnit.edit|measureUnit.destroy', ['only'=>['index']]);
        $this->middleware('permission:measureUnit.create', ['only'=>['create','store']]);
        $this->middleware('permission:measureUnit.show', ['only'=>['show']]);
        $this->middleware('permission:measureUnit.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:measureUnit.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $measureUnits = MeasureUnit::where('status', 'active')->get();

            return DataTables::of($measureUnits)
            ->addColumn('edit', 'admin/measureUnit/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.measureUnit.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.measureUnit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMeasureUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeasureUnitRequest $request)
    {
        $measureUnit = new MeasureUnit();
        $measureUnit->name = $request->name;
        $measureUnit->code = $request->code;
        $measureUnit->save();

        return redirect('measureUnit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MeasureUnit  $measureUnit
     * @return \Illuminate\Http\Response
     */
    public function show(MeasureUnit $measureUnit)
    {
        return view('admin.measureUnit.show', compact('measureUnit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MeasureUnit  $measureUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(MeasureUnit $measureUnit)
    {
        return view('admin.measureUnit.edit', compact('measureUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMeasureUnitRequest  $request
     * @param  \App\Models\MeasureUnit  $measureUnit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMeasureUnitRequest $request, MeasureUnit $measureUnit)
    {
        $measureUnit->name = $request->name;
        $measureUnit->code = $request->code;
        $measureUnit->update();

        return redirect('measureUnit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MeasureUnit  $measureUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeasureUnit $measureUnit)
    {
        $measureUnit->delete();
        toast('Unidad de medida eliminada con éxito.','success');
        return redirect('measureUnit');
    }
}
