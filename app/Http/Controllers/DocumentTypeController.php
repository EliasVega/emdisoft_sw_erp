<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Http\Requests\StoreDocumentTypeRequest;
use App\Http\Requests\UpdateDocumentTypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DocumentTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:documentType.index|documentType.create|documentType.show|documentType.edit|documentType.destroy', ['only'=>['index']]);
        $this->middleware('permission:documentType.create', ['only'=>['create','store']]);
        $this->middleware('permission:documentType.show', ['only'=>['show']]);
        $this->middleware('permission:documentType.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:documentType.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $documentTipes = DocumentType::get();

            return DataTables::of($documentTipes)
            ->addColumn('edit', 'admin/documentType/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.documentType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.documentType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentTypeRequest $request)
    {
        $documentType = new DocumentType();
        $documentType->code = $request->code;
        $documentType->name = $request->name;
        $documentType->prefix = $request->prefix;
        $documentType->cufe_algorithm = $request->cufe_algorithm;
        $documentType->save();
        return redirect("documentType");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentType $documentType)
    {
        return view('admin.documentType.show', compact('documentType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentType $documentType)
    {
        return view('admin.documentType.edit', compact('documentType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentTypeRequest  $request
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentTypeRequest $request, DocumentType $documentType)
    {
        $documentType->code = $request->code;
        $documentType->name = $request->name;
        $documentType->prefix = $request->prefix;
        $documentType->cufe_algorithm = $request->cufe_algorithm;
        $documentType->update();
        return redirect('documentType');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentType $documentType)
    {
        $documentType->delete();
        toast('Tipo de documento eliminado con éxito.','success');
        return redirect('documentType');
    }
}
