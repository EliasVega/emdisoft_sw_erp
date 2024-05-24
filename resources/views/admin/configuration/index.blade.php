
@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<div class="box-body row">
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <div class="row m-3">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <b>IP</b>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <p>{{ $configuration->ip }}</p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <b>Creador sw</b>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <p>{{ $configuration->creator_name }}</p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <b>Compañia</b>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <p>{{  $configuration->company_name }}</p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <b>Nombre Software</b>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <p>{{ $configuration->software_name }}</p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-3">
                    <a href="{{ route('configuration.edit', $configuration->id) }}" class="btn btn-warning btn-md"
                    data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"> EDITAR</i></a>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <div class="row m-3">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <a href="{{ route('company.edit', $company->id) }}" class="btn btn-blueGrad btn-md pr-5"
                        data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit">COMPAÑIA</i></a>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>CONFIGURACION DE LA COMPAÑIA</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <a href="{{ route('software.edit', $software->id) }}" class="btn btn-blueGrad btn-md pr-4"
                    data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit"> SW FACTURA</i></a>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>CONFIGURACION DEL SOFTWARE ID y SET DE PRUEBAS</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <a href="{{ route('editPayrollSw', $software->id) }}" class="btn btn-blueGrad btn-md pr-4"
                    data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit"> SW NOMINA</i></a>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>CONFIGURACION DEL SOFTWARE ID y SET DE PRUEBAS</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <a href="{{ route('editPosSw', $software->id) }}" class="btn btn-blueGrad btn-md"
                    data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit">SW TICKET POS</i></a>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>CONFIGURACION DEL SOFTWARE ID y SET DE PRUEBAS</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <a href="{{ route('certificate.edit', $certificate->id) }}" class="btn btn-blueGrad btn-md"
                    data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit">  CERTIFICADO</i></a>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>CONFIGURACION DEL CERTIFICADO FIRMA DIGITAL</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <a href="{{ route('editLogo', $company->id) }}" class="btn btn-blueGrad btn-md pr-4"
                    data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit"> SUBIR LOGO</i></a>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>EDITAR O SUBIR LOGO</b>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <div class="row m-3">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <a href="{{ route('invoiceTestSet.create') }}" class="btn btn-blueGrad btn-md pr-5"
                        data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit">TESTSET</i></a>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>SET DE PRUEBAS FACTURA ELECTRONICA</b>
                </div>
            </div>
            <div class="row m-3">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <a href="{{ route('createSetPos') }}" class="btn btn-blueGrad btn-md pr-5"
                        data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit">POS SET</i></a>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>SET DE PRUEBAS POS ELECTRONICO</b>
                </div>
            </div>
            <div class="row m-3">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <a href="{{ route('downloadResolution') }}" class="btn btn-blueGrad btn-md pr-5"
                        data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit">RESOLUCIONES</i></a>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>DESCARGAR RESOLUCIONES</b>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





