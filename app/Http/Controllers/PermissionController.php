<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permission.index|permission.create|permission.show|permission.edit|permission.destroy|permission.permissionStatus', ['only'=>['index']]);
        $this->middleware('permission:permission.create', ['only'=>['create','store']]);
        $this->middleware('permission:permission.show', ['only'=>['show']]);
        $this->middleware('permission:permission.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:permission.destroy', ['only'=>['destroy']]);
        $this->middleware('permission:permission.permissionStatus', ['only'=>['status']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $permissions = Permission::all();

            return DataTables::of($permissions)
                ->addColumn('actions', 'admin/permission/actions')
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->save();

        return redirect()->route('permission.index')->with('success_message', 'Permiso registrado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('admin.percentage.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, ['name' => 'required', 'description' => 'required']);
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->update();

        return redirect()->route('permission.index')->with('success_message', 'Permiso editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        DB::table('permissions')->where('id', $permission->id)->delete();
        toast('Permiso eliminado con éxito.','success');
        return redirect('permission');
    }

    public function status($id)
    {

        $permission = Permission::findOrFail($id);
        if ($permission->status == 'active') {
            $permission->status = 'locked';
        } else {
            $permission->status = 'active';
        }
        $permission->update();

        return redirect('permission');
    }
}
