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
                <h4 class="box-title">Agregar Nomina
                    @can('payroll.index')
                        <a href="{{ route('payrollPartial.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                    @endcan
                    <button class="btn btn-darkBlueGrad m-2 p-1" type="button" id="addAcrueds" data-toggle="tooltip" data-placement="top" title="Devengados"><i class="fas fa-check">Devengados</i></button>
                    <button class="btn btn-darkBlueGrad m-2 p-1" type="button" id="addDeductions" data-toggle="tooltip" data-placement="top" title="Deducciones"><i class="fas fa-check">Deducciones</i></button>
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
                    @include('admin/payrollPartial/acrueds.formOvertime')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formVacations">
                    @include('admin/payrollPartial/acrueds.formVacations')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formBonus">
                    @include('admin/payrollPartial/acrueds.formBonus')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formLayoffs">
                    @include('admin/payrollPartial/acrueds.formLayoffs')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formInabilities">
                    @include('admin/payrollPartial/acrueds.formInabilities')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formLicenses">
                    @include('admin/payrollPartial/acrueds.formLicenses')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formNovelties">
                    @include('admin/payrollPartial/acrueds.formNovelties')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formCausations">
                    @include('admin/payrollPartial/acrueds.formCausations')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formCommissions">
                    @include('admin/payrollPartial/acrueds.formCommissions')
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@include('admin/payrollPartial.overtimeModal')
@endsection
@section('scripts')
    @include('admin/payrollPartial.script')
    @include('admin/payrollPartial/acrueds.scriptOvertime')
    @include('admin/payrollPartial/acrueds.scriptVacations')
    @include('admin/payrollPartial/acrueds.scriptBonus')
    @include('admin/payrollPartial/acrueds.scriptLayoffs')
    @include('admin/payrollPartial/acrueds.scriptInabilities')
    @include('admin/payrollPartial/acrueds.scriptLicenses')
    @include('admin/payrollPartial/acrueds.scriptNovelties')
    @include('admin/payrollPartial/acrueds.scriptCommissions')
@endsection

