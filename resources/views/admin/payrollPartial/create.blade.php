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
                        <a href="{{ route('payrollPartial.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
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
            {!!Form::open(array('url'=>'payrollPartial', 'method'=>'POST', 'autocomplete'=>'off', 'files' => 'true')) !!}
            {!!Form::token()!!}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('admin/payrollPartial.form')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formButtons">
                    @include('admin/payrollPartial.formButtons')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formOvertime">
                    @include('admin/payrollPartial.formOvertime')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formVacations">
                    @include('admin/payrollPartial.formVacations')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formBonus">
                    @include('admin/payrollPartial.formBonus')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formLayoffs">
                    @include('admin/payrollPartial.formLayoffs')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formInabilities">
                    @include('admin/payrollPartial.formInabilities')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formLicenses">
                    @include('admin/payrollPartial.formLicenses')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formNovelties">
                    @include('admin/payrollPartial.formNovelties')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formCommissions">
                    @include('admin/payrollPartial.formCommissions')
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@include('admin/payrollPartial.overtimeModal')
@endsection
@section('scripts')
    @include('admin/payrollPartial.script')
    @include('admin/payrollPartial.scriptOvertime')
    @include('admin/payrollPartial.scriptVacations')
    @include('admin/payrollPartial.scriptBonus')
    @include('admin/payrollPartial.scriptLayoffs')
    @include('admin/payrollPartial.scriptInabilities')
    @include('admin/payrollPartial.scriptLicenses')
    @include('admin/payrollPartial.scriptNovelties')
    @include('admin/payrollPartial.scriptCommissions')
@endsection

