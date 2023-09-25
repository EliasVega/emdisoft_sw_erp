@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h5 class="box-title">Agregar Gasto
                    @can('expense.index')
                        <a href="{{ route('expense.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
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
            {!!Form::open(array('url'=>'expense', 'method'=>'POST', 'autocomplete'=>'off'))!!}
            {!!Form::token()!!}
            <div class="row m-1">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('admin/expense.form_expense')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('admin/expense.form_pay')
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
<!--Inicio del modal cliente-->
@include('admin/expense.provider')
@include('admin/expense.editmodal')
<!--Fin del modal-->
@endsection
@section('scripts')
    @include('admin/expense.script')
    @include('admin/expense.script_pay')
    @include('admin/expense.script_provider')
@endsection
