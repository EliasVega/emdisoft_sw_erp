<?php

namespace App\Http\Controllers;

use App\Models\EmployeeType;
use App\Http\Requests\StoreEmployeeTypeRequest;
use App\Http\Requests\UpdateEmployeeTypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employeeType.index|employeeType.create|employeeType.show|employeeType.edit|employeeType.destroy', ['only'=>['index']]);
        $this->middleware('permission:employeeType.create', ['only'=>['create','store']]);
        $this->middleware('permission:employeeType.show', ['only'=>['show']]);
        $this->middleware('permission:employeeType.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:employeeType.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employeeTypes = EmployeeType::get();

            return DataTables::of($employeeTypes)
            ->addColumn('edit', 'admin/employeeType/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.employeeType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employeeType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeTypeRequest $request)
    {
        $employeeType = new EmployeeType();
        $employeeType->code = $request->code;
        $employeeType->name = $request->name;
        $employeeType->save();

        return redirect('employeeType');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeType  $employeeType
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeType $employeeType)
    {
        return view("admin.employeeType.show", compact('employeeType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeType  $employeeType
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeType $employeeType)
    {
        return view("admin.employeeType.edit", compact('employeeType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeTypeRequest  $request
     * @param  \App\Models\EmployeeType  $employeeType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeTypeRequest $request, EmployeeType $employeeType)
    {
        $employeeType->code = $request->code;
        $employeeType->name = $request->name;
        $employeeType->update();

        return redirect('employeeType');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeType  $employeeType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeType $employeeType)
    {
        $employeeType->delete();
        toast('Tipo de empleado eliminado con éxito.','success');
        return redirect('employeeType');
    }
}
