<?php

namespace App\Http\Controllers;

use App\Models\NdinvoiceResponse;
use App\Http\Requests\StoreNdinvoiceResponseRequest;
use App\Http\Requests\UpdateNdinvoiceResponseRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NdinvoiceResponseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ndinvoiceResponse.index|ndinvoiceResponse.create|ndinvoiceResponse.show|ndinvoiceResponse.edit', ['only'=>['index']]);
        $this->middleware('permission:ndinvoiceResponse.create', ['only'=>['create','store']]);
        $this->middleware('permission:ndinvoiceResponse.show', ['only'=>['show']]);
        $this->middleware('permission:ndinvoiceResponse.edit', ['only'=>['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $responses = NdinvoiceResponse::get();

            return DataTables::of($responses)
            ->addIndexColumn()
                ->addColumn('provider', function (NdinvoiceResponse $response) {
                    return $response->ndpurchase->provider->name;
                })
                ->editColumn('created_at', function(NdinvoiceResponse $response) {
                    return $response->created_at->format('yy-m-d');
                })

            ->addColumn('edit', 'admin/ndinvoiceResponse/actions')
            ->rawcolumns(['edit'])
            ->make(true);
        }
        return view('admin.ndinvoiceResponse.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ndinvoiceResponse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNdinvoiceResponseRequest $request)
    {
        $ndinvoiceResponse = new NdinvoiceResponse();
        $ndinvoiceResponse->document = $request->document;
        $ndinvoiceResponse->cude = $request->cude;
        $ndinvoiceResponse->message = $request->message;
        $ndinvoiceResponse->valid = $request->valid;
        $ndinvoiceResponse->code = $request->code;
        $ndinvoiceResponse->description = $request->description;
        $ndinvoiceResponse->status_message = $request->status_message;
        $ndinvoiceResponse->ndinvoice_id = $request->ndinvoice_id;
        $ndinvoiceResponse->save();

        return redirect('ndinvoiceResponse');
    }

    /**
     * Display the specified resource.
     */
    public function show(NdinvoiceResponse $ndinvoiceResponse)
    {
        return view('admin.ndinvoiceResponse.chow', compact('ndinvoiceResponse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NdinvoiceResponse $ndinvoiceResponse)
    {
        return view('admin.ndinvoiceResponse.edit', compact('ndinvoiceResponse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNdinvoiceResponseRequest $request, NdinvoiceResponse $ndinvoiceResponse)
    {
        $ndinvoiceResponse->document = $request->document;
        $ndinvoiceResponse->cude = $request->cude;
        $ndinvoiceResponse->message = $request->message;
        $ndinvoiceResponse->valid = $request->valid;
        $ndinvoiceResponse->code = $request->code;
        $ndinvoiceResponse->description = $request->description;
        $ndinvoiceResponse->status_message = $request->status_message;
        $ndinvoiceResponse->ndinvoice_id = $request->ndinvoice_id;
        $ndinvoiceResponse->update();

        toast('Response Nota Debito Editada satisfactoriamente.','success');
        return redirect('ndinvoiceResponse');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NdinvoiceResponse $ndinvoiceResponse)
    {
        //
    }
}
