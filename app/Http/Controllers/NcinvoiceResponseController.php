<?php

namespace App\Http\Controllers;

use App\Models\NcinvoiceResponse;
use App\Http\Requests\StoreNcinvoiceResponseRequest;
use App\Http\Requests\UpdateNcinvoiceResponseRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NcinvoiceResponseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ncinvoiceResponse.index|ncinvoiceResponse.create|ncinvoiceResponse.show|ncinvoiceResponse.edit', ['only'=>['index']]);
        $this->middleware('permission:ncinvoiceResponse.create', ['only'=>['create','store']]);
        $this->middleware('permission:ncinvoiceResponse.show', ['only'=>['show']]);
        $this->middleware('permission:ncinvoiceResponse.edit', ['only'=>['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $responses = NcinvoiceResponse::get();

            return DataTables::of($responses)
            ->addIndexColumn()
                ->addColumn('provider', function (NcinvoiceResponse $response) {
                    return $response->ndpurchase->provider->name;
                })
                ->editColumn('created_at', function(NcinvoiceResponse $response) {
                    return $response->created_at->format('yy-m-d');
                })

            ->addColumn('edit', 'admin/ncinvoiceResponse/actions')
            ->rawcolumns(['edit'])
            ->make(true);
        }
        return view('admin.ncinvoiceResponse.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ncinvoiceResponse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNcinvoiceResponseRequest $request)
    {
        $ncinvoiceResponse = new NcinvoiceResponse();
        $ncinvoiceResponse->document = $request->document;
        $ncinvoiceResponse->cude = $request->cude;
        $ncinvoiceResponse->message = $request->message;
        $ncinvoiceResponse->valid = $request->valid;
        $ncinvoiceResponse->code = $request->code;
        $ncinvoiceResponse->description = $request->description;
        $ncinvoiceResponse->status_message = $request->status_message;
        $ncinvoiceResponse->ndinvoice_id = $request->ndinvoice_id;
        $ncinvoiceResponse->save();

        return redirect('ncinvoiceResponse');
    }

    /**
     * Display the specified resource.
     */
    public function show(NcinvoiceResponse $ncinvoiceResponse)
    {
        return view('admin.ncinvoiceResponse.chow', compact('ncinvoiceResponse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NcinvoiceResponse $ncinvoiceResponse)
    {
        return view('admin.ncinvoiceResponse.edit', compact('ncinvoiceResponse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNcinvoiceResponseRequest $request, NcinvoiceResponse $ncinvoiceResponse)
    {
        $ncinvoiceResponse->document = $request->document;
        $ncinvoiceResponse->cude = $request->cude;
        $ncinvoiceResponse->message = $request->message;
        $ncinvoiceResponse->valid = $request->valid;
        $ncinvoiceResponse->code = $request->code;
        $ncinvoiceResponse->description = $request->description;
        $ncinvoiceResponse->status_message = $request->status_message;
        $ncinvoiceResponse->ndinvoice_id = $request->ndinvoice_id;
        $ncinvoiceResponse->update();

        toast('Response Nota Credito Editada satisfactoriamente.','success');
        return redirect('ncinvoiceResponse');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NcinvoiceResponse $ncinvoiceResponse)
    {
        //
    }
}
