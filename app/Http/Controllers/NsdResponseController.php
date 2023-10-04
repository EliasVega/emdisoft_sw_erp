<?php

namespace App\Http\Controllers;

use App\Models\NsdResponse;
use App\Http\Requests\StoreNsdResponseRequest;
use App\Http\Requests\UpdateNsdResponseRequest;
use App\Models\Ndpurchase;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NsdResponseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:nsdResponse.index|nsdResponse.create|nsdResponse.show|nsdResponse.edit', ['only'=>['index']]);
        $this->middleware('permission:nsdResponse.create', ['only'=>['create','store']]);
        $this->middleware('permission:nsdResponse.show', ['only'=>['show']]);
        $this->middleware('permission:nsdResponse.edit', ['only'=>['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $responses = NsdResponse::get();

            return DataTables::of($responses)
            ->addIndexColumn()
                ->addColumn('provider', function (NsdResponse $response) {
                    return $response->ndpurchase->provider->name;
                })
                ->editColumn('created_at', function(NsdResponse $response) {
                    return $response->created_at->format('yy-m-d');
                })

            ->addColumn('edit', 'admin/nsdResponse/actions')
            ->rawcolumns(['edit'])
            ->make(true);
        }
        return view('admin.nsdResponse.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.nsdResponse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNsdResponseRequest $request)
    {
        $nsdResponse = new NsdResponse();
        $nsdResponse->document = $request->document;
        $nsdResponse->cuds = $request->cuds;
        $nsdResponse->message = $request->message;
        $nsdResponse->valid = $request->valid;
        $nsdResponse->code = $request->code;
        $nsdResponse->description = $request->description;
        $nsdResponse->status_message = $request->status_message;
        $nsdResponse->ndpurchase_id = $request->ndpurchase_id;
        $nsdResponse->save();

        return redirect('nsdResponse');
    }

    /**
     * Display the specified resource.
     */
    public function show(NsdResponse $nsdResponse)
    {
        return view('admin.nsdResponse.chow', compact('nsdResponse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NsdResponse $nsdResponse)
    {
        return view('admin.nsdResponse.edit', compact('nsdResponse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNsdResponseRequest $request, NsdResponse $nsdResponse)
    {
        $nsdResponse->document = $request->document;
        $nsdResponse->cuds = $request->cuds;
        $nsdResponse->message = $request->message;
        $nsdResponse->valid = $request->valid;
        $nsdResponse->code = $request->code;
        $nsdResponse->description = $request->description;
        $nsdResponse->status_message = $request->status_message;
        $nsdResponse->ndpurchase_id = $request->ndpurchase_id;
        $nsdResponse->update();

        toast('Response NDS Editado satisfactoriamente.','success');
        return redirect('nsdResponse');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NsdResponse $nsdResponse)
    {
        //
    }
}
