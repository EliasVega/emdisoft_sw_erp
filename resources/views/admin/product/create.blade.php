@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h5 class="box-title">Agregar Producto
                    @can('product.index')
                        <a href="{{ route('product.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
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
            {!!Form::open(array('url'=>'product', 'method'=>'POST', 'autocomplete'=>'off', 'files' => 'true'))!!}
            {!!Form::token()!!}
                @if ($indicator->raw_material == 'off')
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            @include('admin/product.form')
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            @include('admin/product.form_image')
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            @include('admin/product.register')
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            @include('admin/product.form')
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            @include('admin/product.form_image')
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            @include('admin/product.form_material')
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            @include('admin/product.register')
                        </div>
                    </div>
                @endif


            {!!Form::close()!!}
        </div>
    </div>
</div>
<!--Inicio del modal cliente-->
@include('admin/product.editmodal')
<!--Fin del modal-->
@endsection
@section('scripts')
    @include('admin/product.script')
    @include('admin/product.script_material')
@endsection
