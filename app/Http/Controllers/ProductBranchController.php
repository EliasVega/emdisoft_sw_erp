<?php

namespace App\Http\Controllers;

use App\Models\ProductBranch;
use App\Http\Requests\StoreProductBranchRequest;
use App\Http\Requests\UpdateProductBranchRequest;
use Yajra\DataTables\DataTables;

class ProductBranchController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:productBranch.index', ['only'=>['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {/*
        if (request()->ajax()) {
            $productBranches = ProductBranch::get();

            return DataTables::of($productBranches)
            ->addIndexColumn()
            ->addColumn('user', function (ProductBranch $productBranch) {
                return $productBranch->user->name;
            })
            ->addColumn('product', function (ProductBranch $productBranch) {
                return $productBranch->product->name;
            })
            ->addColumn('branch', function (ProductBranch $productBranch) {
                return $productBranch->branch->name;
            })
            ->addColumn('originBranch', function (ProductBranch $productBranch) {
                return $productBranch->originBranch->name;
            })
            ->editColumn('created_at', function(ProductBranch $productBranch){
                return $productBranch->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('edit', 'admin/productBranch/actions')
            ->rawcolumns(['edit'])
            ->toJson();
        }
        return view('admin.productBranch.index');*/
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
     * @param  \App\Http\Requests\StoreProductBranchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductBranchRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductBranch  $productBranch
     * @return \Illuminate\Http\Response
     */
    public function show(ProductBranch $productBranch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductBranch  $productBranch
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductBranch $productBranch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductBranchRequest  $request
     * @param  \App\Models\ProductBranch  $productBranch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductBranchRequest $request, ProductBranch $productBranch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductBranch  $productBranch
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductBranch $productBranch)
    {
        //
    }
}
