@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h5 class="box-title">Agregar Remision
                    <a href="{{ route('remission.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>

                    @can('branch.index')
                        <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
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
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!!Form::open(array('url'=>'remission', 'method'=>'POST', 'autocomplete'=>'off', 'id' => 'registerForm'))!!}
            {!!Form::token()!!}
            <div class="row m-1">
                @if ($type == 'pos')
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @include('admin/remission.form_pos')
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="payposorigin">
                        @include('admin/remission.form_paypos')
                    </div>
                @else
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @include('admin/remission.form_remission')
                    </div>
                @endif
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
<!--Inicio del modal cliente-->
@include('admin/remission.editmodal')
@include('admin/remission.modal_pay_pos')
<!--Fin del modal-->
@endsection
@section('scripts')

    @if ($type == 'pos')
        @include('admin/remission.script_paypos')
        @include('admin/remission.script_pos')
    @else
        @include('admin/generalview.script_pay')
        @include('admin/remission.script')
    @endif
@endsection
