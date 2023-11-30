<?php

namespace App\Http\Controllers;

use App\Models\RestaurantTable;
use App\Http\Requests\StoreRestaurantTableRequest;
use App\Http\Requests\UpdateRestaurantTableRequest;
use App\Models\Branch;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RestaurantTableController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:restaurantTable.index|restaurantTable.create|restaurantTable.show|restaurantTable.edit|restaurantTable.destroy', ['only'=>['index']]);
        $this->middleware('permission:restaurantTable.create', ['only'=>['create','store']]);
        $this->middleware('permission:restaurantTable.show', ['only'=>['show']]);
        $this->middleware('permission:restaurantTable.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:restaurantTable.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $restaurantTables = RestaurantTable::get();

            return DataTables::of($restaurantTables)
            ->addIndexColumn()
            ->addColumn('branch', function (RestaurantTable $restaurantTable) {
                return $restaurantTable->branch->name;
            })
            ->addColumn('edit', 'admin/restaurantTable/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.restaurantTable.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branchs = Branch::get();
        return view('admin.restaurantTable.create', compact('branchs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantTableRequest $request)
    {
        $restaurantTable = new RestaurantTable();
        $restaurantTable->name = $request->name;
        $restaurantTable->branch_id = $request->branch_id;
        $restaurantTable->save();

        return redirect('restaurantTable');
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantTable $restaurantTable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RestaurantTable $restaurantTable)
    {
        $branchs = Branch::get();
        return view('admin.restaurantTable.edit', compact('restaurantTable', 'branchs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantTableRequest $request, RestaurantTable $restaurantTable)
    {
        $restaurantTable->name = $request->name;
        $restaurantTable->branch_id = $request->branch_id;
        $restaurantTable->update();

        return redirect('restaurantTable');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantTable $restaurantTable)
    {
        $restaurantTable->delete();
        toast('Impuesto Eliminado con Exito.','success');
        return redirect("restaurantTable");
    }
}
