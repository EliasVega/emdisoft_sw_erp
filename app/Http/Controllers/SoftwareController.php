<?php

namespace App\Http\Controllers;

use App\Models\Software;
use App\Http\Requests\StoreSoftwareRequest;
use App\Http\Requests\UpdateSoftwareRequest;
use App\Models\Company;
use App\Models\Configuration;
use App\Models\Environment;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreSoftwareRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Software $software)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Software $software)
    {
        $typeSoftware = 'invoice';
        return view('admin.software.edit', compact('software', 'typeSoftware'));
    }

    public function editPayrollSw($id)
    {
        $typeSoftware = 'payroll';
        $software = Software::findOrFail($id);
        return view('admin.software.edit', compact('software', 'typeSoftware'));
    }

    public function editPosSw($id)
    {
        $typeSoftware = 'pos';
        $software = Software::findOrFail($id);
        return view('admin.software.edit', compact('software', 'typeSoftware'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSoftwareRequest $request, Software $software)
    {
        //dd($request->all());
        $company = Company::findOrFail(current_user()->company_id);
        $typeSoftware = $request->type_software;
        if ($typeSoftware == 'invoice') {
            $environment = Environment::findOrFail(4);
        } else if ($typeSoftware == 'payroll') {
            $environment = Environment::findOrFail(5);
        } else {
            $environment = Environment::findOrFail(22);
        }
        $configuration = Configuration::where('company_id', $company->id)->first();
        $url = $environment->protocol . $configuration->ip . $environment->url;

        $store = false;
        if (indicator()->dian == 'on') {
            $data = softwareData($request, $typeSoftware);
            $requestResponse = sendDocuments($company, $url, $data);

            $store = $requestResponse['store'];

            if ($store == true) {
                $software->company_id = $company->id;
                if ($typeSoftware == 'invoice') {
                    $software->identifier = $request->identifier;
                    $software->pin = $request->pin;
                    $software->test_set = $request->test_set;
                } else if ($typeSoftware == 'payroll') {
                    $software->identifier_payroll = $request->identifier_payroll;
                    $software->pin_payroll = $request->pin_payroll;
                    $software->payroll_test_set = $request->payroll_test_set;
                } else if($typeSoftware == 'pos') {
                    $software->identifier_equidoc = $request->identifier_equidoc;
                    $software->pin_equidoc = $request->pin_equidoc;
                    $software->equidoc_test_set = $request->equidoc_test_set;
                }
                $software->update();
                return redirect('configuration')->with(
                    'success_message',
                    'Datos del Software id establecido con éxito.'
                );
            }
            return redirect('configuration')->with(
                'error_message',
                'El Datos del Software id no pudo ser establecido con éxito.'
            );
        } else {
            $software->company_id = $company->id;
            if ($typeSoftware == 'invoice') {
                $software->identifier = $request->identifier;
                $software->pin = $request->pin;
                $software->test_set = $request->test_set;
            } else if ($typeSoftware == 'payroll') {
                $software->identifier_payroll = $request->identifier_payroll;
                $software->pin_payroll = $request->pin_payroll;
                $software->payroll_test_set = $request->payroll_test_set;
            } else if($typeSoftware == 'pos') {
                $software->identifier_equidoc = $request->identifier_equidoc;
                $software->pin_equidoc = $request->pin_equidoc;
                $software->equidoc_test_set = $request->equidoc_test_set;
            }
            $software->update();
        }
        return redirect('configuration')->with(
            'error_message',
            'La configuración de los datos del software no esta disponible con el envío a la DIAN desactivado.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Software $software)
    {
        //
    }
}
