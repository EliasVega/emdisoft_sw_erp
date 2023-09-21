<?php

namespace App\Http\Controllers;

use App\Models\IdentificationType;
use App\Http\Requests\StoreIdentificationTypeRequest;
use App\Http\Requests\UpdateIdentificationTypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IdentificationTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:identificationType.index|identificationType.create|identificationType.show|identificationType.edit|identificationType.destroy', ['only'=>['index']]);
        $this->middleware('permission:identificationType.create', ['only'=>['create','store']]);
        $this->middleware('permission:identificationType.show', ['only'=>['show']]);
        $this->middleware('permission:identificationType.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:identificationType.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $identificationTipes = IdentificationType::get();

            return DataTables::of($identificationTipes)
            ->addColumn('edit', 'admin/identificationType/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.identificationType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.identificationType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIdentificationTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIdentificationTypeRequest $request)
    {
        $identificationType = new IdentificationType();
        $identificationType->code = $request->code;
        $identificationType->name = $request->name;
        $identificationType->initial = $request->initial;
        $identificationType->save();
        return redirect("identificationType");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function show(IdentificationType $identificationType)
    {
        return view('admin.identificationType.show', compact('identificationType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function edit(IdentificationType $identificationType)
    {
        return view('admin.identificationType.edit', compact('identificationType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIdentificationTypeRequest  $request
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIdentificationTypeRequest $request, IdentificationType $identificationType)
    {
        $identificationType->code = $request->code;
        $identificationType->name = $request->name;
        $identificationType->initial = $request->initial;
        $identificationType->update();
        return redirect('identificationType');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentificationType $identificationType)
    {
        $identificationType->delete();
        toast('Tipo de identificacion eliminado con éxito.','success');
        return redirect('identificationType');
    }
}
