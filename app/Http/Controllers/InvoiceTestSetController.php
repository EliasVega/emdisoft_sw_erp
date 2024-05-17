<?php

namespace App\Http\Controllers;

use App\Models\InvoiceTestSet;
use App\Http\Requests\StoreInvoiceTestSetRequest;
use App\Http\Requests\UpdateInvoiceTestSetRequest;
use App\Models\Company;
use App\Models\Configuration;
use App\Models\Environment;
use App\Models\Indicator;
use App\Models\Resolution;
use App\Models\Software;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InvoiceTestSetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $invoiceTestSets = InvoiceTestSet::get();

            return DataTables::of($invoiceTestSets)
            ->addIndexColumn()
                ->editColumn('created_at', function(InvoiceTestSet $invoiceTestSet) {
                    return $invoiceTestSet->created_at->format('Y-m-d');
                })

            ->addColumn('statusQuery', 'admin/invoiceTestSet/actions')
            ->rawcolumns(['statusQuery'])
            ->make(true);
        }
        return view('admin.invoiceTestSet.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = Company::where('id', current_user()->company_id)->first();
        $configuration = Configuration::where('company_id', $company->id)->first();
        $software = Software::where('company_id', $company->id)->first();
        return view('admin.invoiceTestSet.create', compact('company', 'configuration', 'software'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceTestSetRequest $request)
    {
        //dd($request->all());
        $company = Company::findOrFail(current_user()->company_id);
        $environment = Environment::findOrFail(11);
        $configuration = Configuration::where('company_id', $company->id)->first();
        $software = Software::where('company_id', $company->id)->first();
        $url = $environment->protocol . $configuration->ip . $environment->url . '/' . $software->test_set;
        $indicator = Indicator::findOrFail(1);
        //$resolut = $request->resolution_id;

        //$typeDocument = 'invoice';
        $resolutions = Resolution::findOrFail(7);
        $service = '';
        $errorMessages = '';
        $store = false;

        for ($i=0; $i < 10; $i++) {
            if ($indicator->dian == 'on') {
                /*
                if ($typeDocument == 'invoice') {
                    $data = invoiceTestSetData($request);
                } else {
                    $data = equiDocPosData($request);
                }*/

                    # code...

                $data = invoiceTestSetData();
                //dd($data);
                    $requestResponse = sendInvoiceTestSet($company, $url, $data);
                    $store = $requestResponse['store'];
                    $service = $requestResponse['response'];
                    $errorMessages = $requestResponse['errorMessages'];

            } else {
                toast('No es posible sin envio a la dian activado.','danger');
                return redirect('configuration');
            }
            //dd($service);
            //Crea un registro de Ventas
            if ($store == true) {

                $zip = $service['ResponseDian']['Envelope']['Body']['SendTestSetAsyncResponse']['SendTestSetAsyncResult']['ZipKey'];
                $invoiceTestSet = new InvoiceTestSet();
                $invoiceTestSet->document_type = 'FE';
                $invoiceTestSet->message = $service['message'];
                $invoiceTestSet->zipKey = $zip;
                $invoiceTestSet->cufe = $service['cufe'];
                $invoiceTestSet->company_id = $company->id;
                $invoiceTestSet->save();

                $resolutions->consecutive += 1;
                $resolutions->update();
            } else {
                toast($errorMessages,'danger');
                return redirect('invoiceTestSet');
            }
        }
        toast('Set de pruebas realizado con exito.','success');
        return redirect('invoiceTestSet');

    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceTestSet $invoiceTestSet)
    {
        return view('admin.invoiceTestSet.chow', compact('invoiceTestSet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceTestSet $invoiceTestSet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceTestSetRequest $request, InvoiceTestSet $invoiceTestSet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceTestSet $invoiceTestSet)
    {
        //
    }

    public function statusQuery($id)
    {
        $company = Company::findOrFail(current_user()->company_id);
        $invoiceTestSet = InvoiceTestSet::findOrFail($id);
        $environment = Environment::findOrFail(20);
        $configuration = Configuration::where('company_id', $company->id)->first();
        $url = $environment->protocol . $configuration->ip . $environment->url . $invoiceTestSet->zipKey;
        $apiToken = $company->api_token;
        $service = '';
        $errorMessages = '';
        $store = '';

        if (indicator()->dian == 'on') {
            $requestResponse = sendStatusQuery($apiToken, $url);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
            $message ='';
            if ($store == 'no aceptado') {
                $message = $service['ResponseDian']['Envelope']['Body']['GetStatusZipResponse']['GetStatusZipResult']['DianResponse']['StatusMessage'];
            } else if ($store == 'aceptado'){
                $message = $service['ResponseDian']['Envelope']['Body']['GetStatusZipResponse']['GetStatusZipResult']['DianResponse']['StatusDescription'];
            } else {
                toast($errorMessages,'danger');
                return redirect('configuration');
            }

            toast($message,'success');
            return redirect('configuration');
        }


        toast('Servicio no diponible sin los envios a la dian.','success');
            return redirect('configuration');

    }
}
