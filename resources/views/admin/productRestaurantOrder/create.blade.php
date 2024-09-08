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
                        <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                    
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
                @if ($type == 'pos')
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @include('admin/productRestaurantOrder.form_posRestOrder')
                    </div>
                @else
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @include('admin/productRestaurantOrder.form_restaurantOrder')
                    </div>
                @endif
            </div>

            {!!Form::close()!!}
        </div>
    </div>
</div>
<!--Inicio del modal cliente-->
@include('admin/productRestaurantOrder.modal_pay_pos')
<!--Fin del modal-->
@endsection
@section('scripts')
    @if ($type == 'pos')
        @include('admin/generalview.script_paypos')
        @include('admin/productRestaurantOrder.script_pos')
    @else
        @include('admin/generalview.script_pay')
        @include('admin/productRestaurantOrder.script')
    @endif
@endsection
