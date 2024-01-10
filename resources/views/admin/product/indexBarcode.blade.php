@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h5>Productos
            @can('product.create')
                <a href="product/create" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i>Agregar Producto</a>
            @endcan
        </h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <tr class="trdatacolor">
                        <th>Id</th>
                        <th>Codigo</th>
                        <th>Producto</th>
                        <th>Barcode</th>
                        <th>Editar</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{!! DNS1D::getBarcodeHTML("$product->code", 'EAN13',2,50) !!}
                                {{ $product->code }}
                            </td>
                            <td>
                                @can('product.edit')
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning" data-toggle="tooltip"
                                        data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
                                @endcan
                            </td>
                            <td>
                                @can('product.productStatus')
                                    @if ($product->status == 'active')
                                        <a href="{{ route('productStatus', $product->id) }}" class="btn btn-success btn-sm"
                                            data-toggle="tooltip" data-placement="top" title="Desactivar"><i class="fas fa-user"></i></a>
                                    @else
                                        <a href="{{ route('productStatus', $product->id) }}" class="btn btn-danger btn-sm"
                                            data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-user"></i></a>
                                    @endif
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

