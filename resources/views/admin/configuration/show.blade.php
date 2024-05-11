@extends('layouts.admin')
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
    <div class="box-body row">
        <div class="col-lg-6">
            <div class="card card-primary card-outline round20">
                <div class="row m-3">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr class="table-primary">
                                <th class="text-center" colspan="2">Nomina Electronica</th>
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
        <div class="col-lg-6">
            <div class="card card-primary card-outline round20">
                <div class="row m-3">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr class="table-primary">
                                <th class="text-center" colspan="2">Nomina Electronica</th>
                            </tr>
                            <tr>
                                <th>Id software</th>
                                <td>{{ $software->identifier_payroll }}</td>
                            </tr>
                            <tr>
                                <th>pin</th>
                                <td>{{ $software->pin_payroll }}</td>
                            </tr>
                            <tr>
                                <th>Set de Pruebas</th>
                                <td>{{ $software->payroll_test_set }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-primary card-outline round20">
                <div class="row m-3">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr class="table-primary">
                                <th class="text-center" colspan="2">Documento Equivalente Electronico</th>
                            </tr>
                            <tr>
                                <th>Id software</th>
                                <td>{{ $software->identifier_equidoc }}</td>
                            </tr>
                            <tr>
                                <th>pin</th>
                                <td>{{ $software->pin_equidoc }}</td>
                            </tr>
                            <tr>
                                <th>Set de Pruebas</th>
                                <td>{{ $software->equidoc_test_set }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-primary card-outline round20">
                <div class="row m-3">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr class="table-primary">
                                <th class="text-center" colspan="2">Certificado de firma digital</th>
                            </tr>
                            <tr>
                                <th class="w-50">Certificado</th>
                                <td class="text-break">
                                    @if(($certificate->file ?? '') != null)
                                        <a href="{{ asset(Storage::url('files/certificates/'.$certificate->file)) }}" target="_blank">
                                            Descargar certificado <i class="fas fa-download"></i>
                                        </a>
                                    @else
                                        No registrado
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Estado del certificado</th>
                                @if(($certificate->expiration_date ?? '') != null)
                                    @if(\Carbon\Carbon::parse($certificate->expiration_date) >= Carbon\Carbon::today())
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
                                @if(($certificate->expiration_date ?? '') != null)
                                    <td class="text-break">
                                        {{ $certificate->expiration_date->format('Y-m-d') }}
                                        @if(\Carbon\Carbon::parse($certificate->expiration_date) >= Carbon\Carbon::today())
                                            <b class="text-success">({{ Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($certificate->expiration_date)) }} días hasta su vencimiento)</b>
                                        @else
                                            <b class="text-danger">({{ \Carbon\Carbon::parse($certificate->expiration_date)->diffInDays(Carbon\Carbon::today()) }} días desde su vencimiento)</b>
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
@endsection
