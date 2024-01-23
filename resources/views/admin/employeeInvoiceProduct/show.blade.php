@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @can('employee.show')
                <a href="{{ route('employee.index') }}" class="btn btn-lightBlueGrad btn-sm"><i class="fa fa-plus mr-2"></i>Regresar</a>
            @endcan
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong>Nombre</strong>: <p><h5>{{ $employee->name }}</h5></p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show mostrar">Tipo Identificacion</strong>: <p class="vista">{{ $employee->identificationType->name  }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show mostrar">Identificacion Numero</strong>: <p class="vista">{{ $employee->identification  }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Departamento</strong>: <p class="vista">{{ $employee->municipality->department->name }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Municipio</strong>: <p class="vista">{{ $employee->municipality->name }}</p>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Direccion</strong>: <p class="vista">{{ $employee->address }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show mostrar">Telefono</strong>: <p class="vista">
                {{ $employee->phone }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Email</strong>: <p class="vista">{{ $employee->email }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Codigo interno</strong>: <p class="vista">{{ $employee->code }}</p>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box-danger">
                <label class="form-control-label">
                    <strong>Informacion Laboral</strong>
                </label>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Fecha Admision</strong>: <p class="vista">{{ $employee->admission_date }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Cargo</strong>: <p class="vista">{{ $employee->charge->name }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Salario</strong>: <p class="vista">{{ number_format($employee->salary,2) }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Tipo de Empleado</strong>: <p class="vista">{{ $employee->employeeType->name }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Subtipo de Empleado</strong>: <p class="vista">{{ $employee->employeeSubtype->name }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Tipo de contrato</strong>: <p class="vista">{{ $employee->contratType->name }}</p>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box-danger">
                <label class="form-control-label">
                    <strong>Informacion Pagos</strong>
                </label>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Banco</strong>: <p class="vista">{{ $employee->bank->name }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Tipo de Cuenta</strong>: <p class="vista">{{ $employee->account_type }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Numero de cuenta</strong>: <p class="vista">{{ $employee->account_number }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Frecuencia de pago</strong>: <p class="vista">{{ $employee->paymentFrecuency->name }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Medio de pago</strong>: <p class="vista">{{ $employee->paymentMethod->name }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Estado actual</strong>: <p class="vista">{{ $employee->status }}</p>
        </div>
    </div>
@endsection
