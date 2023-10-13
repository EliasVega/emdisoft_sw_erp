@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle de la Nota debito
                @can('invoice.index')
                    <a href="{{ route('invoice.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                @endcan
                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">RESPONSABLE</label>
                <h4>{{ $ndinvoice->user->name }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">SUCURSAL</label>
                <h4>{{ $ndinvoice->branch->name }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">CLIENTE</label>
                <h4>{{ $ndinvoice->third->name }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nc#">NOTA DEBITO N°.</label>
                <h4>{{ $ndinvoice->id }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="invoice">APLICA FACTURA No.</label>
                <h4>{{ $ndinvoice->document }}</h4>
            </div>
        </div>

        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="Fecha">FECHA EMISION</label>
                <h4>{{ $ndinvoice->created_at }}</h4>
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
                                <th><p align="right">${{ number_format($ndinvoice->total, 2) }}</p></th>
                            </tr>

                            <tr>
                                <th colspan="3"><p align="right">IMPUESTOS:</p></th>
                                <th><p align="right">${{ number_format($ndinvoice->total_tax, 2) }}</p></th>
                            </tr>
                            <tr>
                                <th  colspan="3"><p align="right">TOTAL PAGAR:</p></th>
                                <th><p align="right">${{ number_format($ndinvoice->total_pay, 2) }}</p></th>
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
                                <td class="rightfoot"><strong id="total">${{number_format($ndinvoice->total_pay - $retentionsum,2)}} </strong></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($ndinvoiceProducts as $ndinvoiceProduct)
                                <tr>
                                    <td>{{ $ndinvoiceProduct->product->name }}</td>
                                    <td>{{ $ndinvoiceProduct->quantity }}</td>
                                    <td class="rightfoot">${{ $ndinvoiceProduct->price }}</td>
                                    <td class="rightfoot">${{ number_format($ndinvoiceProduct->quantity*$ndinvoiceProduct->price,2) }}</td>
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
