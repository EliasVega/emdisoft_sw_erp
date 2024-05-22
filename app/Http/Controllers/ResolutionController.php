<?php

namespace App\Http\Controllers;

use App\Models\Resolution;
use App\Http\Requests\StoreResolutionRequest;
use App\Http\Requests\UpdateResolutionRequest;
use App\Models\Company;
use App\Models\Configuration;
use App\Models\DocumentType;
use App\Models\Environment;
use App\Models\Software;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ResolutionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:resolution.index|resolution.create|resolution.show|resolution.edit|resolution.destroy', ['only'=>['index']]);
        $this->middleware('permission:resolution.create', ['only'=>['create','store']]);
        $this->middleware('permission:resolution.show', ['only'=>['show']]);
        $this->middleware('permission:resolution.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:resolution.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $resolutions = Resolution::where('status', 'active')->get();

            return DataTables::of($resolutions)
            ->addIndexColumn()
            ->addColumn('document', function (Resolution $resolution) {
                return $resolution->documentType->name;
            })
            ->addColumn('edit', 'admin/resolution/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.resolution.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::findOrFail(1);
        $documentTypes = DocumentType::get();
        return view('admin.resolution.create', compact('documentTypes', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResolutionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResolutionRequest $request)
    {
        $company = Company::findOrFail(current_user()->company_id);
        $store = false;

        if (indicator()->dian == 'on') {
            $data = resolutionData($request);
            $environment = Environment::findOrFail(7);
            $configuration = Configuration::where('company_id', $company->id)->first();
            $urlResolution = $environment->protocol . $configuration->ip . $environment->url;

            $requestResponse = sendResolution($company, $urlResolution, $data);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
        } else {
            $store = true;
        }

        if ($store == true) {
            $resolution = Resolution::create(array_merge($request->all(), ['company_id' => current_user()->company_id]));

            Alert::success('Resolucion','Creada Satisfactoriamente.');
            return redirect('resolution');
        }

        return redirect()->route('resolution.index')->with(
            'error_message',
            'La Resolucion no fue registrada. Error: ' . $errorMessages
        );
        /*
        $resolution = new Resolution();
        $resolution->company_id = 1;
        $resolution->document_type_id = $request->document_type_id;
        $resolution->consecutive = $request->consecutive;
        $resolution->prefix = $request->prefix;
        $resolution->resolution = $request->resolution;
        $resolution->resolution_date = $request->resolution_date;
        $resolution->technical_key = $request->technical_key;
        $resolution->start_number = $request->start_number;
        $resolution->end_number = $request->end_number;
        $resolution->start_date = $request->start_date;
        $resolution->end_date = $request->end_date;
        $resolution->status = 'active';
        $resolution->description = $request->description;
        $resolution->save();

        Alert::success('Resolucion','Creada Satisfactoriamente.');
        return redirect('resolution');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function show(Resolution $resolution)
    {
        return view('admin.resolution.show', compact('resolution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function edit(Resolution $resolution)
    {
        $companies = Company::findOrFail(1);
        $documentTypes = DocumentType::get();
        return view('admin.resolution.edit', compact('resolution', 'documentTypes', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResolutionRequest  $request
     * @param  \App\Models\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResolutionRequest $request, Resolution $resolution)
    {
        $store = false;

        if (indicator()->dian == 'on') {
            $data = resolutionData($request);

            $company = Company::findOrFail(current_user()->company_id);
            $environment = Environment::findOrFail(7);
            $configuration = Configuration::where('company_id', $company->id)->first();
            $urlResolution = $environment->protocol . $configuration->ip . $environment->url;

            $requestResponse = sendResolution($company, $urlResolution, $data);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
        } else {
            $store = true;
        }
        if ($store = true) {
            $resolution->company_id = current_user()->company_id;
            $resolution->document_type_id = $request->document_type_id;
            $resolution->consecutive = $request->consecutive;
            $resolution->prefix = $request->prefix;
            $resolution->resolution = $request->resolution;
            $resolution->resolution_date = $request->resolution_date;
            $resolution->technical_key = $request->technical_key;
            $resolution->start_number = $request->start_number;
            $resolution->end_number = $request->end_number;
            $resolution->start_date = $request->start_date;
            $resolution->end_date = $request->end_date;
            $resolution->status = 'active';
            $resolution->description = $request->description;
            $resolution->update();

            Alert::success('Resolucion', $resolution->prefix . ': ' . $resolution->resolution . ' editada con éxito..');
            return redirect('resolution');
        } else {
            return redirect()->route('numerations.index')->with(
                'error_message',
                'La Resolucion no fue editada con éxito. Error: ' . $errorMessages
            );
        }
        Alert::success('Resolucion','Editada con exito.');
        return redirect('resolution');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resolution $resolution)
    {
        if ($resolution->consecutive > 1) {
            toast('Resolucion ya tiene documentos.','success');
        } else {
            $resolution->delete();
            toast('Resolucion Eliminada con Exito.','success');
        }
        return redirect("resolution");
    }

    public function downloadResolution(Request $request)
    {
        $company = Company::findOrFail(current_user()->company_id);
        $configuration = Configuration::where('company_id', $company->id)->first();
        $resolutionolds = Resolution::get();

        if (indicator()->dian == 'on') {
            $company = Company::findOrFail(current_user()->company_id);
            $software = Software::where('company_id', $company->id)->first();
            $environment = Environment::findOrFail(9);
            $configuration = Configuration::where('company_id', $company->id)->first();
            $urlResolution = $environment->protocol . $configuration->ip . $environment->url;

            $requestResponse = resolutionDownload($company, $software, $urlResolution);
            $service = $requestResponse['response'];

            $resolutions = $service['ResponseDian']['Envelope']['Body']['GetNumberingRangeResponse']
                ['GetNumberingRangeResult']['ResponseList']['NumberRangeResponse'] ?? '';

            if ($resolutions != null) {
                $resolutionCount = count($resolutions);

                if ($resolutionCount > 0) {
                    for ($i = 0; $i < $resolutionCount; $i++) {
                        $state = 'active';

                        if (($resolutions[$i]['Prefix'] ?? '') != '') {
                            $prefix = $resolutions[$i]['Prefix'];
                            $resolution = $resolutions[$i]['ResolutionNumber'];
                            $resolutionDate = $resolutions[$i]['ResolutionDate'];
                            $technicalKey = $resolutions[$i]['TechnicalKey'];
                            $startNumber = $resolutions[$i]['FromNumber'];
                            $endNumber = $resolutions[$i]['ToNumber'];
                            $startDate = $resolutions[$i]['ValidDateFrom'];
                            $endDate = $resolutions[$i]['ValidDateTo'];
                        } else {
                            $prefix = $resolutions['Prefix'];
                            $resolution = $resolutions['ResolutionNumber'];
                            $resolutionDate = $resolutions['ResolutionDate'];
                            $technicalKey = $resolutions['TechnicalKey'];
                            $startNumber = $resolutions['FromNumber'];
                            $endNumber = $resolutions['ToNumber'];
                            $startDate = $resolutions['ValidDateFrom'];
                            $endDate = $resolutions['ValidDateTo'];
                            $resolutionCount = 1;
                        }

                        if (is_string($technicalKey)) {
                            $technicalKey = $technicalKey;
                            $documentTypeId = 1;
                        } else {
                            $technicalKey = null;
                            $documentTypeId = 11;
                        }

                        $date = Carbon::now();
                        $durationMeasure = $date->diffInDays(Carbon::parse($endDate));

                        if ($startNumber > $endNumber || $durationMeasure <= 0) {
                            $state = 'inactive';
                        }
                        $consecutive = 'null';
                        foreach ($resolutionolds as $key => $resolutionold) {
                            if ($resolutionold->resolution == $resolution) {
                                $consecutive = $resolutionold->consecutive;
                            }
                        }

                        $resolution = Resolution::updateOrcreate(
                            [
                                'resolution' => $resolution
                            ],
                            [
                                'prefix' => $prefix,
                                'resolution_date' => $resolutionDate,
                                'technical_key' => $technicalKey,
                                'start_number' => $startNumber,
                                'end_number' => $endNumber,
                                'consecutive' => $consecutive,
                                'start_date' => $startDate,
                                'end_date' => $endDate,
                                'state' => $state,
                                'company_id' => $company->id,
                                'document_type_id' => $documentTypeId,
                            ]
                        );
                    }
                    toast('Se descargaron con éxito ' . $resolutionCount . ' numeraciones.','danger');
                    return redirect('resolution');
                }
                toast('No se encontraron numeraciones para descargar.','danger');
                return redirect('resolution');
            }
            toast('La descarga de numeraciones ha fallado.','danger');
            return redirect('resolution');
        }

        toast('La descarga de numeraciones no esta disponible con el envío a la DIAN desactivado.','danger');
        return redirect('resolution');
    }
}
