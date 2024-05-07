<?php

namespace App\Http\Controllers;

use App\Models\Software;
use App\Http\Requests\StoreSoftwareRequest;
use App\Http\Requests\UpdateSoftwareRequest;

class SoftwareController extends Controller
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
    public function store(StoreSoftwareRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Software $software)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Software $software)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSoftwareRequest $request, Software $software)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Software $software)
    {
        //
    }
}
