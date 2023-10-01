<?php

namespace App\Http\Controllers;

use App\Models\SupportDocumentResponse;
use App\Http\Requests\StoreSupportDocumentResponseRequest;
use App\Http\Requests\UpdateSupportDocumentResponseRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SupportDocumentResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $responses = SupportDocumentResponse::get();

            return DataTables::of($responses)
            ->addIndexColumn()
                ->addColumn('provider', function (SupportDocumentResponse $response) {
                    return $response->purchase->provider->name;
                })
                ->editColumn('created_at', function(SupportDocumentResponse $response) {
                    return $response->created_at->format('yy-m-d');
                })

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupportDocumentResponseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SupportDocumentResponse $supportDocumentResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupportDocumentResponse $supportDocumentResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupportDocumentResponseRequest $request, SupportDocumentResponse $supportDocumentResponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupportDocumentResponse $supportDocumentResponse)
    {
        //
    }
}
