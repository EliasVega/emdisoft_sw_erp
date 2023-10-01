<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\DocumentType;
use App\Models\IdentificationType;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user.index|user.create|user.show|user.edit|user.destroy|user.status|user.locked', ['only'=>['index']]);
        $this->middleware('permission:user.create', ['only'=>['create','store']]);
        $this->middleware('permission:user.show', ['only'=>['show']]);
        $this->middleware('permission:user.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:user.destroy', ['only'=>['destroy']]);
        $this->middleware('permission:user.status', ['only'=>['status']]);
        $this->middleware('permission:user.locked', ['only'=>['inactive']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('id', '!=', 1)->where('status', 'active')->get();

            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('identificationType', function (User $user) {
                return $user->identificationType->initial;
            })

            ->addColumn('role', function (User $user) {
                foreach ($user->getRoleNames() as $key => $rolName) {
                    return $rolName;
                }
            })
            ->addColumn('branch', function (User $user) {
                return $user->branch->name;
            })
            ->addColumn('edit', 'admin/user/actions')
            ->rawcolumns(['edit'])
            ->make(true);
        }

        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::select('id', 'name')->get();
        $branches = Branch::select('id', 'name')->get();
        $documentTypes = DocumentType::get();
        $roles = Role::whereNotIn('name', ['superAdmin'])->pluck('name','name')->all();
        $identificationTypes = IdentificationType::get();
        return view('admin.user.create', compact('companies', 'documentTypes', 'branches', 'roles', 'identificationTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->company_id = 1;
        $user->branch_id = $request->branch_id;
        $user->identification_type_id = $request->identification_type_id;
        $user->name = $request->name;
        $user->number = $request->number;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->position = $request->position;
        $user->transfer = $request->transfer;
        $user->status = 'active';
        $user->save();

        $user->assignRole($request->input('roles'));

        Alert::success('Usuario','Creado Satisfactoriamente.');
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $companies = Company::get();
        $branches = Branch::get();
        $identificationTypes = IdentificationType::get();
        $roles = Role::where('id', '!=', 1)->pluck('name','name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('admin.user.edit', compact(
            'user',
            'companies',
            'branches',
            'identificationTypes',
            'roles',
            'userRole'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->company_id = 1;
        $user->branch_id = $request->branch_id;
        $user->identification_type_id = $request->identification_type_id;
        $user->name = $request->name;
        $user->number = $request->number;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->position = $request->position;
        $user->transfer = $request->transfer;
        $user->status = 'active';
        $user->update();

        DB::table('model_has_roles')->where('model_id', $user->id)->delete();

        $user->assignRole($request->input('roles'));

        Alert::success('Usuario','Editado con exito.');
        return redirect('user');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        toast('Usuario Eliminado con Exito.','success');
        return redirect('user');
    }

    public function logout(Request $request)
    {
        if(session()->has('user'))
        {
            $request->session()->forget('user');
        }
        return redirect('login');
    }

    public function status($id)
    {
        $user = User::findOrFail($id);

        if ($user->status == 'active') {
            $user->status = 'inactive';
        } else {
            $user->status = 'active';
        }
        $user->update();

        return redirect('user');
    }

    public function inactive(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('status', 'inactive')->get();

            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('identificationType', function (User $user) {
                return $user->identificationType->initial;
            })
            ->addColumn('branch', function (User $user) {
                return $user->branch->name;
            })
            ->addColumn('btn', 'admin/user/active')
            ->rawcolumns(['btn'])
            ->make(true);
        }

        return view('admin.user.inactive');
    }
}
