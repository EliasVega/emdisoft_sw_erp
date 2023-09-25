@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle de la Nota debito
                @can('purchase.index')
                    <a href="{{ route('purchase.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
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
                <label class="form-control-label" for="company">RESPONSABLE</label>
                <h4>{{ $ndpurchase->user->name }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">SUCURSAL</label>
                <h4>{{ $ndpurchase->branch->name }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">PROVEEDOR</label>
                <h4>{{ $ndpurchase->third->name }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">RESOLUCION</label>
                <h4>{{ $ndpurchase->resolution->prefix . '-' . $ndpurchase->resolution->resolution }}</h4>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">MOTIVO ND</label>
                <h4>{{ $ndpurchase->discrepancy->description }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nc#">NOTA DEBITO N°.</label>
                <h4>{{ $ndpurchase->id }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="invoice">APLICA COMPRA No.</label>
                <h4>{{ $ndpurchase->document }}</h4>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="Fecha">FECHA EMISION</label>
                <h4>{{ $ndpurchase->created_at }}</h4>
            </div>
        </div>

    </div><br>
    <div class="box-body row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio ($)</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="3"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($ndpurchase->total, 2) }}</p></th>
                            </tr>

                            <tr>
                                <th colspan="3"><p align="right">IMPUESTOS:</p></th>
                                <th><p align="right">${{ number_format($ndpurchase->total_tax, 2) }}</p></th>
                            </tr>
                            <tr>
                                <th  colspan="3"><p align="right">TOTAL PAGAR:</p></th>
                                <th><p align="right">${{ number_format($ndpurchase->total_pay, 2) }}</p></th>
                            </tr>
                            @if ($retentionsum > 0)
                                @foreach ($retentions as $retention)
                                    <tr>
                                        <th colspan="3" class="rightfoot">{{ $retention->name }}:</th>
                                        <td class="rightfoot"><strong>$ -{{number_format($retention->tax_value,2)}}</strong> </td>
                                    </tr>
                                @endforeach
                            @endif
                            <tr>
                                <th  colspan="3" class="rightfoot">SALDO PAGAR:</th>
                                <td class="rightfoot"><strong id="total">${{number_format($ndpurchase->total_pay - $retentionsum,2)}} </strong></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($ndpurchaseProducts as $ndpurchaseProduct)
                                <tr>
                                    <td>{{ $ndpurchaseProduct->product->name }}</td>
                                    <td>{{ $ndpurchaseProduct->quantity }}</td>
                                    <td class="rightfoot">${{ $ndpurchaseProduct->price }}</td>
                                    <td class="rightfoot">${{ number_format($ndpurchaseProduct->quantity*$ndpurchaseProduct->price,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
