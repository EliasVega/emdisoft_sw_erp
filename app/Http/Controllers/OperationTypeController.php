<?php

namespace App\Http\Controllers;

use App\Models\OperationType;
use App\Http\Requests\StoreOperationTypeRequest;
use App\Http\Requests\UpdateOperationTypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OperationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $operationTypes = OperationType::get();

            return DataTables::of($operationTypes)
            ->make(true);
        }

        return view('admin.operationType.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.operationType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOperationTypeRequest $request)
    {
        //dd($request->all());
        $operationType = new OperationType();
        $operationType->name = $request->name;
        $operationType->description = $request->description;
        $operationType->save();
        return redirect("operationType");
    }

    /**
     * Display the specified resource.
     */
    public function show(OperationType $operationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OperationType $operationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOperationTypeRequest $request, OperationType $operationType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OperationType $operationType)
    {
        //
    }
}
