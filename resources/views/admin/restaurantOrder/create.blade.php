@extends('layouts.admin')
@section('titulo')
    {{ config('app.name', 'Emdisoft_erp') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box-danger">
                <div class="box-header with-border">
                    <h5 class="box-title">Agregar Comanda
                        <a href="{{ route('restaurantOrder.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i
                                class="fas fa-undo-alt mr-2"></i>Regresar</a>

                        <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i
                                class="fas fa-undo-alt mr-2"></i>Inicio</a>

                        <a href="{{ route('product.create') }}" class="btn btn-lightBlueGrad btn-sm" target="_blank"
                            data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-plus"> Agregar Producto</i></a>

                        <a href="{{ route('customer.create') }}" class="btn btn-lightBlueGrad btn-sm" target="_blank"
                            data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-plus"> Agregar Cliente</i></a>
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
                <form action="{{ route('restaurantOrder.store') }}" method="POST" class="formulario" id="registerForm">
                    {{ csrf_field() }}
                    <div class="row m-1">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            @include('admin/restaurantOrder.form_selectTable')
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="createTable">
                            @include('admin/restaurantOrder.form_table')
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="homeOrder">
                            @include('admin/restaurantOrder.form_home_order')
                        </div>

                        @if (indicator()->raw_material == 'on')
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                @include('admin/restaurantOrder.form_restaurantOrder')
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                @include('admin/restaurantOrder.form_rawMaterial')
                            </div>
                        @else
                            @include('admin/restaurantOrder.form_restaurantOrder')
                        @endif

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Inicio del modal cliente-->
    @include('admin/restaurantOrder.modalRawMaterial')
    <!--Fin del modal-->
@endsection
@section('scripts')
    @include('admin/restaurantOrder.script')
    @include('admin/restaurantOrder.script_rawMaterial')
@endsection
