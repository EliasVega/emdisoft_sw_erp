<?php

namespace App\Http\Controllers;

use App\Models\ApiResponse;
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
     * Remove the specified resource from storage.
     */
    public function destroy(ApiResponse $apiResponse)
    {
        $apiResponse->delete();
        toast('response eliminado con éxito.','success');
        return redirect("apiResponse");
    }
}
