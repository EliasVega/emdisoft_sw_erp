@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle de la Orden de compra
                @can('purchase.index')
                    <a href="{{ route('purchaseOrder.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                @endcan
                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="id">PRE COMPRA #</label>
                <h6>{{ $purchaseOrder->id }}</h6>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">PROVEEDOR</label>
                <h6>{{ $purchaseOrder->third->name }}</h6>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">SUCURSAL</label>
                <h6>{{ $purchaseOrder->branch->name }}</h6>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="Fecha">FECHA EMISION</label>
                <h6>{{ date('d-m-Y', strtotime($purchaseOrder->created_at)) }}</h6>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="balance">SALDO A PAGAR</label>
                <h6>{{ number_format($purchaseOrder->balance, 2) }}</h6>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">RESPONSABLE</label>
                <h6>{{ $purchaseOrder->user->name }}</h6>
            </div>
        </div>
    </div><br>
    <div class="box-body row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio ($)</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tfoot>

                        <tr>
                            <th  colspan="3"><p align="right">TOTAL:</p></th>
                            <th class="thfoot"><p align="right">${{ number_format($purchaseOrder->total, 2) }}</p></th>
                        </tr>

                        <tr>
                            <th colspan="3"><p align="right">IMPUESTOS:</p></th>
                            <th class="thfoot"><p align="right">${{ number_format($purchaseOrder->total_tax, 2) }}</p></th>
                        </tr>
                        <tr>
                            <th  colspan="3"><p align="right">TOTAL PAGAR:</p></th>
                            <th class="thfoot"><p align="right">${{ number_format($purchaseOrder->total_pay, 2) }}</p></th>
                        </tr>

                    </tfoot>
                    <tbody>
                        @foreach($purchaseOrderProducts as $purchaseOrderProduct)
                            <tr>
                                <td>{{ $purchaseOrderProduct->product->name }}</td>
                                <td class="rightfoot">{{ number_format($purchaseOrderProduct->quantity,2)  }}</td>
                                <td class="rightfoot">${{ number_format($purchaseOrderProduct->price,2) }}</td>
                                <td class="rightfoot">${{ number_format($purchaseOrderProduct->subtotal,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
