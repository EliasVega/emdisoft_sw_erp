<?php

namespace App\Http\Controllers;

use App\Models\BranchRawmaterial;
use App\Http\Requests\StoreBranchRawmaterialRequest;
use App\Http\Requests\UpdateBranchRawmaterialRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BranchRawmaterialController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:branchRawmaterial.index', ['only'=>['index']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $user = current_user()->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar productos de las sucursales a admin y superAdmin
                //$branchProducts = BranchProduct::get();
                $branchRawmaterials = BranchRawmaterial::get();
            } else {
                //Consulta para mostrar productos sucursales de los demas roles
                $branchProducts = BranchRawmaterial::where('branch_id', $user->branch_id)->get();
            }

            return DataTables::of($branchRawmaterials)
            ->addIndexColumn()
            ->addColumn('idMaterial', function (BranchRawmaterial $branchRawmaterial) {
                return $branchRawmaterial->rawMaterial->id;
            })

            ->addColumn('code', function (BranchRawmaterial $branchRawmaterial) {
                return $branchRawmaterial->rawMaterial->code;
            })
            ->addColumn('name', function (BranchRawmaterial $branchRawmaterial) {
                return $branchRawmaterial->rawMaterial->name;
            })
            ->addColumn('price', function (BranchRawmaterial $branchRawmaterial) {
                return number_format($branchRawmaterial->rawMaterial->price, 2);
            })
            ->addColumn('btn', 'admin/branchRawMaterial/actions')
            ->rawcolumns(['btn'])
            ->make(true);
        }
        return view('admin.branchRawMaterial.index');
    }
}
