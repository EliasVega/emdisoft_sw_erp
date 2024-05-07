<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Http\Requests\StoreConfigurationRequest;
use App\Http\Requests\UpdateConfigurationRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ConfigurationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:company.index|company.show|company.edit', ['only'=>['index']]);
        $this->middleware('permission:company.show', ['only'=>['show']]);
        $this->middleware('permission:company.edit', ['only'=>['edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $configurations = Configuration::get();

            return DataTables::of($configurations)
            ->addIndexColumn()
            ->addColumn('company', function (Configuration $configuration) {
            return $configuration->company->name;
            })
            ->addColumn('software_identifier', function (Configuration $configuration) {
                return $configuration->company->software->identifier;
                })
            ->addColumn('edit', 'admin/configuration/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.configuration.index');
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
    public function store(StoreConfigurationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Configuration $configuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Configuration $configuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConfigurationRequest $request, Configuration $configuration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Configuration $configuration)
    {
        //
    }
}
