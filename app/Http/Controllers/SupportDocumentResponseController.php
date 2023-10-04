<?php

namespace App\Http\Controllers;

use App\Models\SupportDocumentResponse;
use App\Http\Requests\StoreSupportDocumentResponseRequest;
use App\Http\Requests\UpdateSupportDocumentResponseRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SupportDocumentResponseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:supportDocumentResponse.index|supportDocumentResponse.create|supportDocumentResponse.show|supportDocumentResponse.edit', ['only'=>['index']]);
        $this->middleware('permission:supportDocumentResponse.create', ['only'=>['create','store']]);
        $this->middleware('permission:supportDocumentResponse.show', ['only'=>['show']]);
        $this->middleware('permission:supportDocumentResponse.edit', ['only'=>['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $responses = SupportDocumentResponse::get();

            return DataTables::of($responses)
            ->addIndexColumn()
            /*
                ->addColumn('provider', function (SupportDocumentResponse $response) {
                    return $response->purchase->provider->name;
                })
                ->editColumn('created_at', function(SupportDocumentResponse $response) {
                    return $response->created_at->format('yy-m-d');
                })*/

            ->addColumn('edit', 'admin/supportDocumentResponse/actions')
            ->rawcolumns(['edit'])
            ->make(true);
        }
        return view('admin.supportDocumentResponse.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supportDocumentResponse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupportDocumentResponseRequest $request)
    {
        $supportDocumentResponse = new SupportDocumentResponse();
        $supportDocumentResponse->document = $request->document;
        $supportDocumentResponse->cuds = $request->cuds;
        $supportDocumentResponse->message = $request->message;
        $supportDocumentResponse->valid = $request->valid;
        $supportDocumentResponse->code = $request->code;
        $supportDocumentResponse->description = $request->description;
        $supportDocumentResponse->status_message = $request->status_message;
        $supportDocumentResponse->purchase_id = $request->purchase_id;
        $supportDocumentResponse->save();

        return redirect('supportDocumentResponse');
    }

    /**
     * Display the specified resource.
     */
    public function show(SupportDocumentResponse $supportDocumentResponse)
    {
        return view('admin.supportDocumentResponse.chow', compact('supportDocumentResponse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupportDocumentResponse $supportDocumentResponse)
    {
        return view('admin.supportDocumentResponse.edit', compact('supportDocumentResponse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupportDocumentResponseRequest $request, SupportDocumentResponse $supportDocumentResponse)
    {
        $supportDocumentResponse->document = $request->document;
        $supportDocumentResponse->cuds = $request->cuds;
        $supportDocumentResponse->message = $request->message;
        $supportDocumentResponse->valid = $request->valid;
        $supportDocumentResponse->code = $request->code;
        $supportDocumentResponse->description = $request->description;
        $supportDocumentResponse->status_message = $request->status_message;
        $supportDocumentResponse->purchase_id = $request->purchase_id;
        $supportDocumentResponse->update();

        toast('Response DS Editado satisfactoriamente.','success');
        return redirect('supportDocumentResponse');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupportDocumentResponse $supportDocumentResponse)
    {
        //
    }
}
