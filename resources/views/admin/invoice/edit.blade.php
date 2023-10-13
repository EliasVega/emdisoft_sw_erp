@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box-danger">
                <div class="box-header with-border">
                    <h5 class="box-title">Editar Factura de Venta:{{ $Invoice->id }}
                        @can('Invoice.index')
                            <a href="{{ route('Invoice.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
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
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {!!Form::model($Invoice, ['method'=>'PATCH','route'=>['Invoice.update', $Invoice->id]])!!}
    {!!Form::token()!!}
    <div class="row m-1">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
            @include('admin/Invoice.form_edit')
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            @include('admin/Invoice.form_pay_edit')
        </div>
    </div>
    {!!Form::close()!!}
    @include('admin/Invoice.editmodal')
@endsection
@section('scripts')
    @include('admin/Invoice.script_edit')
    @include('admin/Invoice.script_pay_edit')
@endsection
