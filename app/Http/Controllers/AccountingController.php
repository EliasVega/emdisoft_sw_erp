<?php

namespace App\Http\Controllers;

use App\Models\Accounting;
use App\Http\Requests\StoreAccountingRequest;
use App\Http\Requests\UpdateAccountingRequest;

class AccountingController extends Controller
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
    public function store(StoreAccountingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Accounting $accounting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accounting $accounting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountingRequest $request, Accounting $accounting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accounting $accounting)
    {
        //
    }
}
