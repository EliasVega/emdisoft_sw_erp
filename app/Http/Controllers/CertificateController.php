<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Models\Company;
use App\Models\Configuration;
use App\Models\Environment;

class CertificateController extends Controller
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
    public function store(StoreCertificateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        return view('admin.certificate.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCertificateRequest $request, Certificate $certificate)
    {
        //dd($request->all());
        if (indicator()->dian == 'on') {
            $store = false;
            $data = CertificateData($request);
            $configuration = Configuration::where('company_id', company()->id)->first();
            $certificateEnvironment = Environment::where('code', 'SCC')->first();
            $urlCertifiacte = $certificateEnvironment->protocol . $configuration->ip . $certificateEnvironment->url;
            $requestResponse = sendCertificate($urlCertifiacte, $data);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];

            if ($store == true) {
                $certificate = Certificate::where('company_id', company()->id)->first();

                if ($request->file('file')) {
                    if ($file = uploadNewFile('certificates', $request->file('file'), $certificate->file)) {
                        $certificate->file = $file;
                    }
                }

                $certificate->password = $request->get('password');
                $certificate->expiration_date = $service['certificado']['expiration_date'];
                $certificate->update();

                return redirect('configuration')->with(
                    'success_message',
                    'Certificado digital y configuraciones establecido con éxito.'
                );
            }

            return redirect('configuration')->with(
                'error_message',
                'El certificado digital y configuraciones no pudo ser establecido con éxito.'
            );
        }

        return redirect('configuration')->with(
            'error_message',
            'La configuración del certificado de firma digital no esta disponible con el envío a la DIAN desactivado.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        //
    }
}
