<?php

namespace App\Http\Controllers;

use App\Models\Resolution;
use App\Http\Requests\StoreResolutionRequest;
use App\Http\Requests\UpdateResolutionRequest;
use App\Models\Company;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ResolutionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:resolution.index|resolution.create|resolution.show|resolution.edit|resolution.destroy', ['only'=>['index']]);
        $this->middleware('permission:resolution.create', ['only'=>['create','store']]);
        $this->middleware('permission:resolution.show', ['only'=>['show']]);
        $this->middleware('permission:resolution.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:resolution.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $resolutions = Resolution::get();

            return DataTables::of($resolutions)
            ->addIndexColumn()
            ->addColumn('company', function (Resolution $resolution) {
                return $resolution->company->name;
            })
            ->addColumn('document', function (Resolution $resolution) {
                return $resolution->documentType->name;
            })
            ->addColumn('numeration', function(Resolution $resolution){
                return $resolution->start_number . ' -- ' . $resolution->end_number;
            })

            ->addColumn('edit', 'admin/resolution/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.resolution.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::findOrFail(1);
        $documentTypes = DocumentType::get();
        return view('admin.resolution.create', compact('documentTypes', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResolutionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResolutionRequest $request)
    {
        $resolution = new Resolution();
        $resolution->company_id = 1;
        $resolution->document_type_id = $request->document_type_id;
        $resolution->consecutive = $request->consecutive;
        $resolution->prefix = $request->prefix;
        $resolution->resolution = $request->resolution;
        $resolution->resolution_date = $request->resolution_date;
        $resolution->technical_key = $request->technical_key;
        $resolution->start_number = $request->start_number;
        $resolution->end_number = $request->end_number;
        $resolution->start_date = $request->start_date;
        $resolution->end_date = $request->end_date;
        $resolution->status = 'active';
        $resolution->save();

        Alert::success('Resolucion','Creada Satisfactoriamente.');
        return redirect('resolution');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function show(Resolution $resolution)
    {
        $companies = Company::findOrFail(1);
        $documentTypes = DocumentType::get();
        return view('admin.resolution.edit', compact('resolution', 'documentTypes', 'companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function edit(Resolution $resolution)
    {
        $companies = Company::findOrFail(1);
        $documentTypes = DocumentType::get();
        return view('admin.resolution.edit', compact('resolution', 'documentTypes', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResolutionRequest  $request
     * @param  \App\Models\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResolutionRequest $request, Resolution $resolution)
    {

        $resolution->company_id = 1;
        $resolution->document_type_id = $request->document_type_id;
        $resolution->consecutive = $request->consecutive;
        $resolution->prefix = $request->prefix;
        $resolution->resolution = $request->resolution;
        $resolution->resolution_date = $request->resolution_date;
        $resolution->technical_key = $request->technical_key;
        $resolution->start_number = $request->start_number;
        $resolution->end_number = $request->end_number;
        $resolution->start_date = $request->start_date;
        $resolution->end_date = $request->end_date;
        $resolution->status = 'active';
        $resolution->update();
        Alert::success('Resolucion','Editada con exito.');
        return redirect('resolution');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resolution $resolution)
    {
        $resolution->delete();
        toast('Resolucion Eliminada con Exito.','success');
        return redirect("resolution");
    }
}
