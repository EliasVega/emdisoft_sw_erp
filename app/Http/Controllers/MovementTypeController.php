<?php

namespace App\Http\Controllers;

use App\Models\MovementType;
use App\Http\Requests\StoreMovementTypeRequest;
use App\Http\Requests\UpdateMovementTypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MovementTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $movementTypes = MovementType::get();

            return DataTables::of($movementTypes)
            ->make(true);
        }

        return view('admin.movementType.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.movementType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovementTypeRequest $request)
    {
        //dd($request->all());
        $movementType = new MovementType();
        $movementType->name = $request->name;
        $movementType->description = $request->description;
        $movementType->save();
        return redirect("movementType");
    }

    /**
     * Display the specified resource.
     */
    public function show(MovementType $movementType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MovementType $movementType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovementTypeRequest $request, MovementType $movementType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovementType $movementType)
    {
        //
    }
}
