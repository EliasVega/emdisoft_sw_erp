<?php

namespace App\Http\Controllers;

use App\Models\ContratType;
use App\Http\Requests\StoreContratTypeRequest;
use App\Http\Requests\UpdateContratTypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContratTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:contratType.index|contratType.create|contratType.show|contratType.edit|contratType.destroy', ['only'=>['index']]);
        $this->middleware('permission:contratType.create', ['only'=>['create','store']]);
        $this->middleware('permission:contratType.show', ['only'=>['show']]);
        $this->middleware('permission:contratType.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:contratType.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contratTypes = ContratType::get();

            return DataTables::of($contratTypes)
                ->addColumn('edit', 'admin/contratType/actions')
                ->rawColumns(['edit'])
                ->make(true);
        }

        return view('admin.contratType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contratType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContratTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContratTypeRequest $request)
    {
        $contratType = new ContratType();
        $contratType->code = $request->code;
        $contratType->name = $request->name;
        $contratType->save();

        return redirect('contratType');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContratType  $contratType
     * @return \Illuminate\Http\Response
     */
    public function show(ContratType $contratType)
    {
        return view("admin.contratType.show", compact('contratType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContratType  $contratType
     * @return \Illuminate\Http\Response
     */
    public function edit(ContratType $contratType)
    {
        return view("admin.contratType.edit", compact('contratType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContratTypeRequest  $request
     * @param  \App\Models\ContratType  $contratType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContratTypeRequest $request, ContratType $contratType)
    {
        $contratType->code = $request->code;
        $contratType->name = $request->name;
        $contratType->update();

        return redirect('contratType');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContratType  $contratType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContratType $contratType)
    {
        $contratType->delete();
        toast('Tipo de contrato eliminado con éxito.','success');
        return redirect('contratType');
    }
}
