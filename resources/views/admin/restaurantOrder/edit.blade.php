@extends('layouts.admin')
@section('titulo')
    {{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box-danger">
                <div class="box-header with-border">
                    <h5 class="box-title">Editar Comanda: #{{ $restaurantOrder->id }}
                        <a href="{{ route('restaurantOrder.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i
                                class="fas fa-undo-alt mr-2"></i>Regresar</a>
                        @can('branch.index')
                            <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i
                                    class="fas fa-undo-alt mr-2"></i>Inicio</a>
                        @endcan
                        <a href="{{ route('product.create') }}" class="btn btn-lightBlueGrad btn-sm"
                        target="_blank" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-plus"> Agregar Producto</i>
                        </a>
                        <a href="{{ route('customer.create') }}" class="btn btn-lightBlueGrad btn-sm"
                            target="_blank" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-plus"> Agregar Cliente</i>
                        </a>
                    </h5>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {!! Form::model($restaurantOrder, [
        'method' => 'PATCH',
        'route' => ['restaurantOrder.update', $restaurantOrder->id],
    ]) !!}
    {!! Form::token() !!}
    <div class="row m-1">
        @if ($service == 1)
            @include('admin/restaurantOrder.form_home_order')
        @else
            @include('admin/restaurantOrder.form_table')
        @endif
        @if (indicator()->raw_material == 'on')
            @include('admin/restaurantOrder.form_editRestaurantOrder')
            @include('admin/restaurantOrder.form_rawMaterial')
        @else
            @include('admin/restaurantOrder.form_editRestaurantOrder')
        @endif

    </div>
    {!! Form::close() !!}
    @include('admin/restaurantOrder.modalRawMaterial')
    @include('admin/restaurantOrder.modalEditRestaurantOrder')
@endsection
@section('scripts')
    @include('admin/restaurantOrder.script_editRawMaterial')
    @include('admin/restaurantOrder.script_editRestaurantOrder')
@endsection
