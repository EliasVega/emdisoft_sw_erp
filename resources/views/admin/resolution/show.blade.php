@extends('layouts.admin')
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
    <div>
        <a href="{{ route('resolution.index') }}" class="btn btn-blueGrad btn-sm ml-3 mb-3">Regresar</a>
    </div>
    <div class="box-body row">
        <div class="col-lg-6">
            <div class="card card-primary card-outline round20">
                <div class="row m-3">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr class="table-primary">
                                <th class="text-center" colspan="2">Resolucion</th>
                            </tr>
                            <tr>
                                <th>Id</th>
                                <td>{{ $resolution->id }}</td>
                            </tr>
                            <tr>
                                <th>Prefijo</th>
                                <td>{{ $resolution->prefix }}</td>
                            </tr>
                            <tr>
                                <th>Resolucion Numero</th>
                                <td>{{ $resolution->resolution }}</td>
                            </tr>
                            <tr>
                                <th>Numeracion desde</th>
                                <td>{{ $resolution->start_number }}</td>
                            </tr>
                            <tr>
                                <th>Numeracion hasta</th>
                                <td>{{ $resolution->end_number }}</td>
                            </tr>
                            <tr>
                                <th>Consecutivo actual</th>
                                <td>{{ $resolution->consecutive }}</td>
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
                                <th class="text-center" colspan="2">Resolucion</th>
                            </tr>
                            <tr>
                                <th>Fecha Resolucion</th>
                                <td>{{ $resolution->resolution_date }}</td>
                            </tr>
                            <tr>
                                <th>Fecha Inicio</th>
                                <td>{{ $resolution->start_date }}</td>
                            </tr>
                            <tr>
                                <th>Fecha fin</th>
                                <td>{{ $resolution->end_date }}</td>
                            </tr>
                            <tr>
                                <th>Documento</th>
                                <td>{{ $resolution->documentType->name }}</td>
                            </tr>
                            <tr>
                                <th>Clave Tecnica</th>
                                <td>{{ $resolution->technical_key }}</td>
                            </tr>
                            <tr>
                                <th>Estado</th>
                                <td>{{ $resolution->status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
