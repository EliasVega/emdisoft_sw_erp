<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Models\BranchProduct;
use App\Models\Company;
use App\Models\Department;
use App\Models\Indicator;
use App\Models\Municipality;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class BranchController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:branch.index|branch.create|branch.show|branch.edit|branch.destroy', ['only'=>['index']]);
        $this->middleware('permission:branch.create', ['only'=>['create','store']]);
        $this->middleware('permission:branch.show', ['only'=>['show']]);
        $this->middleware('permission:branch.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:branch.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $indicator = Indicator::findOrFail(1);
        $rawMaterial = $indicator->raw_material;
        if (request()->ajax()) {
            $user = current_user()->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar sucursales a admin y superadmin
                $branches = Branch::get();
            } else {
                //Consulta para mostrar sucursales de los demas roles
                $branches = Branch::where('id', current_user()->branch_id)->get();
            }
            return DataTables::of($branches)
            ->addIndexColumn()
            ->addColumn('department', function (Branch $branch) {
                return $branch->department->name;
            })
            ->addColumn('municipality', function (Branch $branch) {
                return $branch->municipality->name;
            })
            ->addColumn('company', function (Branch $branch) {
                return $branch->company->nit;
            })
            ->addColumn('restaurant', function (Branch $branch) {
                return $branch->company->indicator->restaurant;
            })
            ->addColumn('cashRegister', function (Branch $branch) {
                return $branch->company->indicator->pos;
            })/*
            //->addColumn('order', 'admin/branch/btn/order')
            ->addColumn('invoice', 'admin/branch/btn/invoice')
            ->addColumn('box', 'admin/branch/btn/box')
            ->addColumn('purchase', 'admin/branch/btn/purchase')
            ->addColumn('expense', 'admin/branch/btn/expense')
            ->addColumn('product', 'admin/branch/btn/product')
            ->addColumn('transfer', 'admin/branch/btn/transfer')
            ->addColumn('edit', 'admin/branch/btn/edit')
            ->addColumn('show', 'admin/branch/btn/show')
            ->rawColumns(['invoice', 'box', 'purchase', 'expense', 'product', 'transfer', 'edit', 'show'])*/


            ->addColumn('btn', 'admin/branch/actions')
            ->addColumn('accesos', 'admin/branch/accesos')
            ->rawcolumns(['btn', 'accesos'])
            ->make(true);
        }
        return view('admin.branch.index', compact('rawMaterial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        return view('admin.branch.create', compact(
            'departments',
            'municipalities'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBranchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBranchRequest $request)
    {
        $company = Company::where('id', Auth::user()->company_id)->first();
        $branch = new Branch();
        $branch->department_id = $request->department_id;
        $branch->municipality_id = $request->municipality_id;
        $branch->company_id = $company->id;
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->mobile = $request->mobile;
        $branch->email = $request->email;
        $branch->manager = $request->manager;
        $branch->save();
        Alert::success('Sucursal','Creada Satisfactoriamente.');
        return redirect('branch');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {

        return view('admin.branch.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        $companies = Company::get();
        return view('admin.branch.edit', compact(
            'branch',
            'departments',
            'municipalities',
            'companies'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBranchRequest  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $company = Company::where('id', '=', 1)->first();

        $branch->department_id = $request->department_id;
        $branch->municipality_id = $request->municipality_id;
        $branch->company_id = $company->id;
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->mobile = $request->mobile;
        $branch->email = $request->email;
        $branch->manager = $request->manager;
        $branch->update();
        Alert::success('Sucursal','Editada Satisfactoriamente.');
        return redirect('branch');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        toast('Sucursal eliminada con éxito.','success');
        return redirect("branch");
    }

    //metodo para traer el municipio dependiendo del departamento
    public function getMunicipalities(Request $request, $id)
    {
        if($request)
        {
            $municipalities = Municipality::where('department_id', '=', $id)->get();

            return response()->json($municipalities);
        }
    }

    //metodo para cerrar session
    public function logout()
    {
        session()->forget('branch');

        return redirect('branch');
    }

    public function product($id)
    {
        $branch = Branch::findOrFail($id);
        Session::put('branch', $branch->id, 60 * 24 * 365);
        Session::put('name', $branch->name, 60 * 24 * 365);

        return redirect('branchProduct');
    }

    public function transfer($id)
    {
        $user = Auth::user();

        if ($user->transfer == 1) {
            $branch = Branch::findOrFail($id);
            $branches = Branch::select('id', 'name')->where('id', '!=', $branch->id)->get();
            $branchProducts = BranchProduct::where('branch_id', $branch->id)->where('stock', '>', 0)->get();
        } else {
            toast('Usuario no autorizado para hacer Traslados.','warning');
            return redirect("branch");
        }
        return view("admin.transfer.create", compact('branches', 'branchProducts', 'branch'));
    }
}
