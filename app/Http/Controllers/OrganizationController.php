<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrganizationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:organization.index|organization.create|organization.show|organization.edit|organization.destroy', ['only'=>['index']]);
        $this->middleware('permission:organization.create', ['only'=>['create','store']]);
        $this->middleware('permission:organization.show', ['only'=>['show']]);
        $this->middleware('permission:organization.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:organization.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $organizations = Organization::get();

            return DataTables::of($organizations)
            ->addColumn('edit', 'admin/organization/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.organization.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.organization.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrganizationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizationRequest $request)
    {
        $organization = new Organization();
        $organization->code = $request->code;
        $organization->name = $request->name;
        $organization->save();
        return redirect("organization");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        return view('admin.organization.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        return view('admin.organization.edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrganizationRequest  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        $organization->code = $request->code;
        $organization->name = $request->name;
        $organization->update();
        return redirect('organization');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();
        toast('Tipo de organizacion eliminado con éxito.','success');
        return redirect('organization');
    }
}
