@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h5 class="box-title">Facturar Comanda
                    @can('restaurantOrder.index')
                        <a href="{{ route('restaurantOrder.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                    @endcan
                    @can('branch.index')
                        <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                    @endcan
                </h5>
            </div>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!!Form::open(array('url'=>'productRestaurantOrder', 'method'=>'POST', 'autocomplete'=>'off'))!!}
            {!!Form::token()!!}
            <div class="row m-1">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('admin/productRestaurantOrder.form_restaurantOrder')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 colorpay">
                    @include('admin/productRestaurantOrder.form_pay')
                </div>

            </div>

            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection
@section('scripts')
    @include('admin/productRestaurantOrder.script')
    @include('admin/generalview.script_pay')
@endsection
