<?php

namespace App\Http\Controllers;

use App\Models\BranchProduct;
use App\Http\Requests\StoreBranchProductRequest;
use App\Http\Requests\UpdateBranchProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class BranchProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:branchProduct.index', ['only'=>['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {


            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar productos de las sucursales a admin y superAdmin
                //$branchProducts = BranchProduct::get();
                $branchProducts = BranchProduct::get();
            } else {
                //Consulta para mostrar productos sucursales de los demas roles
                $branchProducts = BranchProduct::where('branch_id', $users->branch_id)->get();
            }

            return DataTables::of($branchProducts)
            ->addIndexColumn()
            ->addColumn('idProduct', function (BranchProduct $branchProduct) {
                return $branchProduct->product->id;
            })

            ->addColumn('code', function (BranchProduct $branchProduct) {
                return $branchProduct->product->code;
            })
            ->addColumn('name', function (BranchProduct $branchProduct) {
                return $branchProduct->product->name;
            })
            ->addColumn('price', function (BranchProduct $branchProduct) {
                return number_format($branchProduct->product->price, 2);
            })
            ->addColumn('btn', 'admin/branchProduct/actions')
            ->rawcolumns(['btn'])
            ->make(true);
        }
        return view('admin.branchProduct.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBranchProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBranchProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BranchProduct  $branchProduct
     * @return \Illuminate\Http\Response
     */
    public function show(BranchProduct $branchProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BranchProduct  $branchProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(BranchProduct $branchProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBranchProductRequest  $request
     * @param  \App\Models\BranchProduct  $branchProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBranchProductRequest $request, BranchProduct $branchProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BranchProduct  $branchProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(BranchProduct $branchProduct)
    {
        //
    }
}
