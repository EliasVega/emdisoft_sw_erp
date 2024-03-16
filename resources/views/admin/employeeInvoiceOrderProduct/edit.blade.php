@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box-danger">
                <div class="box-header with-border">
                    <h5 class="box-title">Editar Oprario para esta Commision:{{ $employeeInvoiceProduct->id }}
                        <a href="{{ route('employeeInvoiceProduct.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                        @can('branch.index')
                            <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                        @endcan
                    </h5>
                </div>
                @if (count($errors)>0)
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
    {!!Form::model($invoice, ['method'=>'PATCH','route'=>['employeeInvoiceProduct.update', $employeeInvoiceProduct->id]])!!}
    {!!Form::token()!!}
    <div class="row m-1">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('admin/employeeInvoiceProduct.form_edit')
        </div>
    </div>
    {!!Form::close()!!}
@endsection
@section('scripts')
    @include('admin/employeeInvoiceProduct.script_edit')
@endsection
