<?php

namespace App\Http\Controllers;

use App\Models\TriggerMethod;
use App\Http\Requests\StoreTriggerMethodRequest;
use App\Http\Requests\UpdateTriggerMethodRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TriggerMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $triggerMethods = TriggerMethod::get();

            return DataTables::of($triggerMethods)
            ->make(true);
        }

        return view('admin.triggerMethod.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.triggerMethod.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTriggerMethodRequest $request)
    {
        //dd($request->all());
        $triggerMethod = new TriggerMethod();
        $triggerMethod->name = $request->name;
        $triggerMethod->description = $request->description;
        $triggerMethod->save();
        return redirect("triggerMethod");
    }

    /**
     * Display the specified resource.
     */
    public function show(TriggerMethod $triggerMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TriggerMethod $triggerMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTriggerMethodRequest $request, TriggerMethod $triggerMethod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TriggerMethod $triggerMethod)
    {
        //
    }
}
