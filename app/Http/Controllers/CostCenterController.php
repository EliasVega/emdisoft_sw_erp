<?php

namespace App\Http\Controllers;

use App\Models\CostCenter;
use App\Http\Requests\StoreCostCenterRequest;
use App\Http\Requests\UpdateCostCenterRequest;

class CostCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCostCenterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CostCenter $costCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostCenter $costCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCostCenterRequest $request, CostCenter $costCenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostCenter $costCenter)
    {
        //
    }
}
