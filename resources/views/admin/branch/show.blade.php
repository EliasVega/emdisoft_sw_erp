@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a href="{{ route('branch.index') }}" class="btn btn-lightBlueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
    </div>
    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">ID</strong>: <p class="vista"><h4>{{ $branch->id }}</h4></p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">SUCURSAL</strong>: <p class="vista"><h4>{{ $branch->name }}</h4></p>
        </div>
    </div>
        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Departamento</strong>: <p class="vista">{{ $branch->department->name }}</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Municipio</strong>: <p class="vista">{{ $branch->municipality->name }}</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show mostrar">Empresa</strong>: <p class="vista">
                    {{ $branch->company->name }}</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show mostrar">Nit</strong>: <p class="vista">{{ $branch->company->nit }}</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Direccion</strong>: <p class="vista">{{ $branch->address }}</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show mostrar">Telefono</strong>: <p class="vista">
                    {{ $branch->phone }}</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Celular</strong>: <p class="vista">{{ $branch->mobile }}</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Email</strong>: <p class="vista">{{ $branch->email }}</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Gerente</strong>: <p class="vista">{{ $branch->manager }}</p>
            </div>

        </div>
    </div>
    @endsection
