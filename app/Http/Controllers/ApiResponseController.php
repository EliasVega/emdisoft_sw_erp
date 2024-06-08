<?php

namespace App\Http\Controllers;

use App\Models\ApiResponse;
use App\Http\Requests\StoreApiResponseRequest;
use App\Http\Requests\UpdateApiResponseRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ApiResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $apiResponses = ApiResponse::get();

            return DataTables::of($apiResponses)
            ->addColumn('edit', 'admin/apiResponse/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.apiResponse.index');
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
    public function store(StoreApiResponseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ApiResponse $apiResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApiResponse $apiResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApiResponseRequest $request, ApiResponse $apiResponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApiResponse $apiResponse)
    {
        $apiResponse->delete();
        toast('response eliminado con éxito.','success');
        return redirect("apiResponse");
    }
}
