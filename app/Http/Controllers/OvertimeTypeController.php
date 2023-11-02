<?php

namespace App\Http\Controllers;

use App\Models\OvertimeType;
use App\Http\Requests\StoreOvertimeTypeRequest;
use App\Http\Requests\UpdateOvertimeTypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OvertimeTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:overtimeType.index|overtimeType.create|overtimeType.show|overtimeType.edit|overtimeType.destroy', ['only'=>['index']]);
        $this->middleware('permission:overtimeType.create', ['only'=>['create','store']]);
        $this->middleware('permission:overtimeType.show', ['only'=>['show']]);
        $this->middleware('permission:overtimeType.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:overtimeType.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $overtimeTypes = OvertimeType::get();

            return DataTables::of($overtimeTypes)
            ->addColumn('edit', 'admin/overtimeType/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.overtimeType.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.overtimeType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOvertimeTypeRequest $request)
    {
        $overtimeType = new OvertimeType();
        $overtimeType->code = $request->code;
        $overtimeType->hour_type = $request->hour_type;
        $overtimeType->apply_time = $request->apply_time;
        $overtimeType->percentage = $request->percentage;
        $overtimeType->save();
        return redirect("overtimeType");
    }

    /**
     * Display the specified resource.
     */
    public function show(OvertimeType $overtimeType)
    {
        return view('admin.overtimeType.show', compact('overtimeType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OvertimeType $overtimeType)
    {
        return view('admin.overtimeType.edit', compact('overtimeType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOvertimeTypeRequest $request, OvertimeType $overtimeType)
    {
        $overtimeType->code = $request->code;
        $overtimeType->hour_type = $request->hour_type;
        $overtimeType->apply_time = $request->apply_time;
        $overtimeType->percentage = $request->percentage;
        $overtimeType->update();
        return redirect('overtimeType');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OvertimeType $overtimeType)
    {
        $overtimeType->delete();
        toast('Tipo de Hora extra eliminada con éxito.','success');
        return redirect('overtimeType');
    }
}
