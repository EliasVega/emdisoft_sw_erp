@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h5 class="box-title">pago comisiones:

                        <a href="{{ route('workLabor.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Comisiones</a>

                        <a href="{{ route('employee.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Operarios</a>

                    @can('branch.index')
                        <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                    @endcan
                </h5>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!!Form::model($employee, ['method'=>'PUT','route'=>['updateCommission', $employee->id]])!!}
            {!!Form::token()!!}
            <div class="row m-1">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    @include('admin/employee.form_commission')
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    @include('admin/employee.form_pay')
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection
@section('scripts')
    @include('admin/employee.script_commission')
    @include('admin/employee.script_pay')
@endsection
