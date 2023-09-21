@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @can('customer.index')
            <a href="{{ route('customer.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
        @endcan
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong>ID</strong>: <p><h4>{{ $customer->id }}</h4></p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong>Nombre</strong>: <p><h4>{{ $customer->name }}</h4></p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show mostrar">C.C. / Nit</strong>: <p class="vista">{{ $customer->identification  }} - {{ $customer->dv }}</p>
        </div>
        @if ($customer->municipality == null)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Departamento</strong>: <p class="vista">Indefinido</p>
            </div>
        @else
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Departamento</strong>: <p class="vista">{{ $customer->municipality->department->name }}</p>
            </div>
        @endif
        @if ($customer->municipality == null)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Municipio</strong>: <p class="vista">Indefinido</p>
            </div>
        @else
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Municipio</strong>: <p class="vista">{{ $customer->municipality->name }}</p>
            </div>
        @endif


        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Direccion</strong>: <p class="vista">{{ $customer->address }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show mostrar">Telefono</strong>: <p class="vista">
                {{ $customer->phone }}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Email</strong>: <p class="vista">{{ $customer->email }}</p>
        </div>
        @if ($customer->liability == null)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Responsabilidad</strong>: <p class="vista">Indefinido</p>
            </div>
        @else
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Responsabilidad</strong>: <p class="vista">{{ $customer->liability->name; }}</p>
            </div>
        @endif
        @if ($customer->organization == null)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Tipo Persona</strong>: <p class="vista">Indefinido</p>
            </div>
        @else
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Tipo Persona</strong>: <p class="vista">{{ $customer->organization->name; }}</p>
            </div>
        @endif
        @if ($customer->regime == null)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Regimen</strong>: <p class="vista">Indefinido</p>
            </div>
        @else
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <strong class="titulo-show">Regimen</strong>: <p class="vista">{{ $customer->regime->name; }}</p>
            </div>
        @endif
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <strong class="titulo-show">Creado</strong>: <p class="vista">{{ $customer->created_at; }}</p>
        </div>
    </div>
@endsection
