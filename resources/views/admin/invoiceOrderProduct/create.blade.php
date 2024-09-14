@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h5 class="box-title">Facturando
                    <a href="{{ route('invoiceOrder.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
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
            {!!Form::open(array('url'=>'invoiceOrderProduct', 'method'=>'POST', 'autocomplete'=>'off', 'id' => 'registerForm'))!!}
            {!!Form::token()!!}
                @include('admin/invoiceOrderProduct.form_invoiceOrderProduct')
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection
@section('scripts')
    @include('admin/invoiceOrderProduct.script')
    @include('admin/generalview.script_pay')
    @include('admin/generalview.script_retention')
@endsection
