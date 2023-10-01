<?php

namespace App\Http\Controllers;

use App\Models\PostalCode;
use App\Http\Requests\StorePostalCodeRequest;
use App\Http\Requests\UpdatePostalCodeRequest;
use App\Models\Department;
use App\Models\Municipality;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:postalCode.index|postalCode.create|postalCode.show|postalCode.edit|postalCode.destroy', ['only'=>['index']]);
        $this->middleware('permission:postalCode.create', ['only'=>['create','store']]);
        $this->middleware('permission:postalCode.show', ['only'=>['show']]);
        $this->middleware('permission:postalCode.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:postalCode.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $postalCodes = PostalCode::get();
            return DataTables()::of($postalCodes)
            ->addIndexColumn()
            ->addColumn('department', function (PostalCode $postalCode) {
                return $postalCode->municipality->department->name;
            })
            ->addColumn('municipality', function (PostalCode $postalCode) {
                return $postalCode->municipality->name;
            })
            ->addColumn('edit', 'admin/postalCode/actions')
            ->rawColumns(['edit'])
            ->toJson();
        }
        return view('admin.postalCode.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        return view("admin.postalCode.create", compact('departments', 'municipalities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostalCodeRequest $request)
    {
        $postalCode = new PostalCode();
        $postalCode->municipality_id = $request->municipality_id;
        $postalCode->postal_code = $request->postal_code;
        $postalCode->save();

        return redirect('postalCode');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostalCode $postalCode)
    {
        return view("admin.postalCode.show", compact('postalCode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostalCode $postalCode)
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        return view("admin.postalCode.edit", compact('departments', 'municipalities', 'postalCode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostalCodeRequest $request, PostalCode $postalCode)
    {
        $postalCode->municipality_id = $request->municipality_id;
        $postalCode->postal_code = $request->postal_code;
        $postalCode->update();

        return redirect('postalCode');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostalCode $postalCode)
    {
        $postalCode->delete();
        toast('Codigo postal eliminado con éxito.','success');
        return redirect('postalCode');
    }
}
