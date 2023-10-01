@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection

@section('content')
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Informacion Proveedor
                @can('provider.index')
                    <a href="{{ route('provider.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                @endcan
                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong>ID</strong>: <p><h4>{{ $provider->id }}</h4></p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong>Nombre</strong>: <p><h4>{{ $provider->name }}</h4></p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show mostrar">C.C. / Nit</strong>: <p class="vista">{{ $provider->identification  }} - {{ $provider->dv }}</p>
        </div>

        @if ($provider->municipality == null)
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Departamento</strong>: <p class="vista">Indefinido</p>
        </div>
        @else
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Departamento</strong>: <p class="vista">{{ $provider->municipality->department->name }}</p>
            </div>
        @endif
        @if ($provider->municipality == null)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Municipio</strong>: <p class="vista">Indefinido</p>
            </div>
        @else
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Municipio</strong>: <p class="vista">{{ $provider->municipality->name }}</p>
            </div>
        @endif
        @if ($provider->postalCode == null)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Codigo Postal</strong>: <p class="vista">Indefinido</p>
            </div>
        @else
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Codigo Postal</strong>: <p class="vista">{{ $provider->postalCode->postal_code }}</p>
            </div>
        @endif

        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Direccion</strong>: <p class="vista">{{ $provider->address }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show mostrar">Telefono</strong>: <p class="vista">
                {{ $provider->phone }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Email</strong>: <p class="vista">{{ $provider->email }}</p>
        </div>
        @if ($provider->liability == null)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Responsabilidad</strong>: <p class="vista">Indefinido</p>
            </div>
        @else
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Responsabilidad</strong>: <p class="vista">{{ $provider->liability->name; }}</p>
            </div>
        @endif
        @if ($provider->organization == null)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Tipo Persona</strong>: <p class="vista">Indefinido</p>
            </div>
        @else
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Tipo Persona</strong>: <p class="vista">{{ $provider->organization->name; }}</p>
            </div>
        @endif
        @if ($provider->regime == null)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Regimen</strong>: <p class="vista">Indefinido</p>
            </div>
        @else
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Regimen</strong>: <p class="vista">{{ $provider->regime->name; }}</p>
            </div>
        @endif
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Creado</strong>: <p class="vista">{{ $provider->created_at; }}</p>
        </div>
    </div>
@endsection
