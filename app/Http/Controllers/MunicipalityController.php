<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use App\Http\Requests\StoreMunicipalityRequest;
use App\Http\Requests\UpdateMunicipalityRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class MunicipalityController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:municipality.index|municipality.create|municipality.show|municipality.edit|municipality.destroy', ['only'=>['index']]);
        $this->middleware('permission:municipality.create', ['only'=>['create','store']]);
        $this->middleware('permission:municipality.show', ['only'=>['show']]);
        $this->middleware('permission:municipality.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:municipality.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $municipalities = Municipality::get();
            return DataTables()::of($municipalities)
            ->addIndexColumn()
            ->addColumn('department', function (Municipality $municipality) {
                return $municipality->department->name;
            })
            ->addColumn('edit', 'admin/municipality/actions')
            ->rawColumns(['edit'])
            ->toJson();
        }
        return view('admin.municipality.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::get();
        return view("admin.municipality.create", compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMunicipalityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMunicipalityRequest $request)
    {
        $municipality = new Municipality();
        $municipality->department_id = $request->department_id;
        $municipality->code = $request->code;
        $municipality->name = $request->name;
        $municipality->save();

        return redirect('municipality');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function show(Municipality $municipality)
    {
        return view("admin.municipality.show", compact('municipality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function edit(Municipality $municipality)
    {
        $departments = department::get();

        return view("admin.municipality.edit", compact('municipality', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMunicipalityRequest  $request
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMunicipalityRequest $request, Municipality $municipality)
    {
        $municipality->department_id = $request->department_id;
        $municipality->code = $request->code;
        $municipality->name = $request->name;
        $municipality->update();
        return redirect('municipality');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Municipality $municipality)
    {
        $municipality->delete();
        toast('Municipio eliminado con éxito.','success');
        return redirect('municipality');
    }
}
