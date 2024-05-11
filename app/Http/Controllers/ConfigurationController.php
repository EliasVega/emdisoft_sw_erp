<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Http\Requests\StoreConfigurationRequest;
use App\Http\Requests\UpdateConfigurationRequest;
use App\Models\Certificate;
use App\Models\Company;
use App\Models\Environment;
use App\Models\Indicator;
use App\Models\Software;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
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
        /*
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
        }*/
        $company = Company::where('id', current_user()->company_id)->first();
        $configuration = Configuration::where('company_id', $company->id)->first();
        $certificate = Certificate::where('company_id', $company->id)->first();
        $software = Software::where('company_id', $company->id)->first();
        return view('admin.configuration.index', compact('configuration', 'company', 'certificate', 'software'));
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
        $company = Company::findOrFail(current_user()->company_id);
        $software = Software::where('company_id', $company->id)->first();
        $certificate = Certificate::where('company_id', $company->id)->first();

        return view('admin.configuration.show', compact('configuration', 'software', 'company', 'certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Configuration $configuration)
    {
        $software = Software::findOrFail(1);
        $certificate = Certificate::findOrFail(1);
        return view('admin.configuration.edit', compact('configuration', 'software', 'certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConfigurationRequest $request, Configuration $configuration)
    {
        $configuration->company_id = current_user()->company_id;
        $configuration->ip = $request->ip;
        $configuration->creator_name = $request->creator_name;
        $configuration->company_name = $request->company_name;
        $configuration->software_name = $request->software_name;
        $configuration->update();

        Alert::success('Configuracion','Editada con exito.');
        return redirect('configuration');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Configuration $configuration)
    {
        //
    }
}
