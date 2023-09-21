<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSubtype;
use App\Http\Requests\StoreEmployeeSubtypeRequest;
use App\Http\Requests\UpdateEmployeeSubtypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeSubtypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employeeSubtype.index|employeeSubtype.create|employeeSubtype.show|employeeSubtype.edit|employeeSubtype.destroy', ['only'=>['index']]);
        $this->middleware('permission:employeeSubtype.create', ['only'=>['create','store']]);
        $this->middleware('permission:employeeSubtype.show', ['only'=>['show']]);
        $this->middleware('permission:employeeSubtype.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:employeeSubtype.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employeeSubtypes = EmployeeSubtype::get();

            return DataTables::of($employeeSubtypes)
            ->addColumn('edit', 'admin/employeeSubtype/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.employeeSubtype.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employeeSubtype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeSubtypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeSubtypeRequest $request)
    {
        $employeeSubtype = new EmployeeSubtype();
        $employeeSubtype->code = $request->code;
        $employeeSubtype->name = $request->name;
        $employeeSubtype->save();

        return redirect('employeeSubtype');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeSubtype  $employeeSubtype
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeSubtype $employeeSubtype)
    {
        return view("admin.employeeSubtype.show", compact('employeeSubtype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeSubtype  $employeeSubtype
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeSubtype $employeeSubtype)
    {
        return view("admin.employeeSubtype.edit", compact('employeeSubtype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeSubtypeRequest  $request
     * @param  \App\Models\EmployeeSubtype  $employeeSubtype
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeSubtypeRequest $request, EmployeeSubtype $employeeSubtype)
    {
        $employeeSubtype->code = $request->code;
        $employeeSubtype->name = $request->name;
        $employeeSubtype->update();

        return redirect('employeeSubtype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeSubtype  $employeeSubtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeSubtype $employeeSubtype)
    {
        $employeeSubtype->delete();
        toast('Subtipo de empleado eliminado con éxito.','success');
        return redirect('employeeSubtype');

    }
}
