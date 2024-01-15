@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection

@section('content')
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Informacion Produto
                @can('product.index')
                    <a href="{{ route('product.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                @endcan
                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <strong>ID</strong>: <p><h4>{{ $product->id }}</h4></p>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
            <strong>Nombre</strong>: <p><h4>{{ $product->name }}</h4></p>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <strong>ID</strong>: <p><h4>{{ $product->code }}</h4></p>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
            <strong>Categoria</strong>: <p><h4>{{ $product->category->name }}</h4></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <strong>P/compra</strong>: <p><h4>{{ $product->price }}</h4></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <strong>P/venta</strong>: <p><h4>{{ $product->sale_price }}</h4></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <strong>Stock</strong>: <p><h4>{{ $product->stock }}</h4></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <strong>stock Minimo</strong>: <p><h4>{{ $product->stock_min }}</h4></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <strong>Tipo</strong>: <p><h4>{{ $product->type_product }}</h4></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <strong>U/medida</strong>: <p><h4>{{ $product->measureUnit->name }}</h4></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <strong>Utilidad</strong>: <p><h4>{{ $product->category->utility_rate }}</h4></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <strong>Impuesto</strong>: <p><h4>{{ $product->category->companyTax->name }}</h4></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <strong>Estado</strong>: <p><h4>{{ $product->status }}</h4></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <strong>Creado</strong>: <p><h4>{{ $product->created_at }}</h4></p>
        </div>
    </div>
@endsection
