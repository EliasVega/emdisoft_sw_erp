@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection

@section('content')
@if (session('info'))
    <div class="alert alert-success"></div>
    <strong>{{ session('info') }}</strong>
@endif
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h4 class="box-title">Agregar Sucursal
                    @can('payroll.index')
                        <a href="{{ route('payroll.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                    @endcan
                </h4>
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
            {!!Form::open(array('url'=>'payroll', 'method'=>'POST', 'autocomplete'=>'off', 'files' => 'true')) !!}
            {!!Form::token()!!}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('admin/payroll.form')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formButtons">
                    @include('admin/payroll.formButtons')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formOvertime">
                    @include('admin/payroll.formOvertime')
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@include('admin/payroll.overtimeModal')
@endsection
@section('scripts')
    @include('admin/payroll.script')
    @include('admin/payroll.scriptOvertime')
@endsection

