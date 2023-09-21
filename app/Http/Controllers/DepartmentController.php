<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class DepartmentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:department.index|department.create|department.show|department.edit|department.destroy', ['only'=>['index']]);
        $this->middleware('permission:department.create', ['only'=>['create','store']]);
        $this->middleware('permission:department.show', ['only'=>['show']]);
        $this->middleware('permission:department.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:department.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $departments = Department::get();

            return DataTables::of($departments)
                ->addColumn('edit', 'admin/department/actions')
                ->rawColumns(['edit'])
                ->make(true);
        }

        return view('admin.department.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
        $department = new Department;
        $department->name = $request->name;
        $department->dane_code = $request->dane_code;
        $department->iso_code = $request->iso_code;
        $department->save();

        return redirect('department');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view("admin.department.show", compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view("admin.department.edit", compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepartmentRequest  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->name = $request->name;
        $department->dane_code = $request->dane_code;
        $department->iso_code = $request->iso_code;
        $department->update();

        return redirect('department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        toast('Departamento eliminado con éxito.','success');
        return redirect('department');
    }
}
