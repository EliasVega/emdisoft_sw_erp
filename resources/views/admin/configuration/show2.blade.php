@extends('layouts.admin')
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Configuracion: {{ $company->name }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Facturacion Electronica</th>
                                        </tr>
                                        <tr>
                                            <th>Id software</th>
                                            <td>{{ $software->identifier }}</td>
                                        </tr>
                                        <tr>
                                            <th>pin</th>
                                            <td>{{ $software->pin }}</td>
                                        </tr>
                                        <tr>
                                            <th>Set de Pruebas</th>
                                            <td>{{ $software->test_set }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Configuración de la empresa
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr class="table-primary">
                                            <th class="text-center" colspan="2">Características</th>
                                        </tr>
                                        <tr>
                                            <th class="w-50">Impuesto incluido en total (facturas de venta)</th>
                                            <td>{{ $company->feature->tax_included == 'active' ? 'Activo' : 'Inactivo' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Hotel</th>
                                            <td>{{ $company->feature->hotel == 'active' ? 'Activo' : 'Inactivo' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contabilidad automática</th>
                                            <td>{{ $company->feature->automatic_accounting == 'active' ? 'Activo' : 'Inactivo' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Contabilidad manual</th>
                                            <td>{{ $company->feature->manual_accounting == 'active' ? 'Activo' : 'Inactivo' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Nomina</th>
                                            <td>{{ $company->feature->payroll == 'active' ? 'Activo' : 'Inactivo' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Punto de venta</th>
                                            <td>{{ $company->feature->sale_point == 'active' ? 'Activo' : 'Inactivo' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr class="table-primary">
                                            <th class="text-center" colspan="2">API DIAN</th>
                                        </tr>
                                        <tr>
                                            <th class="w-50">API token</th>
                                            <td class="text-break">{{ $company->api_token ?? 'No registrado' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-50">Identificador del software</th>
                                            <td class="text-break">
                                                {{ $company->configuration->identifier ?? 'No registrado' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pin del software</th>
                                            <td>{{ $company->configuration->pin ?? 'No registrado' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Set de pruebas del software</th>
                                            <td class="text-break">
                                                {{ $company->configuration->test_set ?? 'No registrado' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Identificador de nómina electrónica</th>
                                            <td>{{ $company->configuration->payroll_identifier ?? 'No registrado' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pin de nómina electrónica</th>
                                            <td class="text-break">
                                                {{ $company->configuration->payroll_pin ?? 'No registrado' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Set de pruebas de nómina electrónica</th>
                                            <td class="text-break">
                                                {{ $company->configuration->payroll_test_set ?? 'No registrado' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr class="table-primary">
                                            <th class="text-center" colspan="2">Certificado de firma digital</th>
                                        </tr>
                                        <tr>
                                            <th class="w-50">Archivo</th>
                                            <td class="text-break">
                                                @if (($company->certificate->file ?? '') != null)
                                                    <a href="{{ asset(Storage::url('files/certificates/' . $company->certificate->file)) }}"
                                                        target="_blank">
                                                        Descargar certificado <i class="fas fa-download"></i>
                                                    </a>
                                                @else
                                                    No registrado
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Estado del certificado</th>
                                            @if (($company->certificate->expiration_date ?? '') != null)
                                                @if (\Carbon\Carbon::parse($company->certificate->expiration_date) >= Carbon\Carbon::today())
                                                    <td class="table-success">Vigente</td>
                                                @else
                                                    <td class="table-danger">Expirado</td>
                                                @endif
                                            @else
                                                <td>No registrado</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th>Fecha de vencimiento del certificado</th>
                                            @if (($company->certificate->expiration_date ?? '') != null)
                                                <td class="text-break">
                                                    {{ $company->certificate->expiration_date->format('Y-m-d') }}
                                                    @if (\Carbon\Carbon::parse($company->certificate->expiration_date) >= Carbon\Carbon::today())
                                                        <b class="text-success">({{ Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($company->certificate->expiration_date)) }}
                                                            días hasta su vencimiento)</b>
                                                    @else
                                                        <b class="text-danger">({{ \Carbon\Carbon::parse($company->certificate->expiration_date)->diffInDays(Carbon\Carbon::today()) }}
                                                            días desde su vencimiento)</b>
                                                    @endif
                                                </td>
                                            @else
                                                <td>No registrado</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
