@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle de la Nota credito
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
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">RESPONSABLE</label>
                <h4>{{ $ncinvoice->user->name }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">SUCURSAL</label>
                <h4>{{ $ncinvoice->branch->name }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">CLIENTE</label>
                <h4>{{ $ncinvoice->third->name }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">RESOLUCION</label>
                <h4>{{ $ncinvoice->resolution->prefix . '-' . $ncinvoice->resolution->resolution }}</h4>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">MOTIVO NC</label>
                <h4>{{ $ncinvoice->discrepancy->description }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nc#">NOTA CREDITO N°.</label>
                <h4>{{ $ncinvoice->id }}</h4>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="invoice">APLICA COMPRA No.</label>
                <h4>{{ $ncinvoice->document }}</h4>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="Fecha">FECHA EMISION</label>
                <h4>{{ $ncinvoice->created_at }}</h4>
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
                                <th><p align="right">${{ number_format($ncinvoice->total, 2) }}</p></th>
                            </tr>

                            <tr>
                                <th colspan="3"><p align="right">IMPUESTOS:</p></th>
                                <th><p align="right">${{ number_format($ncinvoice->total_tax, 2) }}</p></th>
                            </tr>
                            <tr>
                                <th  colspan="3"><p align="right">TOTAL PAGAR:</p></th>
                                <th><p align="right">${{ number_format($ncinvoice->total_pay, 2) }}</p></th>
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
                                <td class="rightfoot"><strong id="total">${{number_format($ncinvoice->total_pay - $retentionsum,2)}} </strong></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($ncinvoiceProducts as $ncinvoiceProduct)
                                <tr>
                                    <td>{{ $ncinvoiceProduct->product->name }}</td>
                                    <td>{{ $ncinvoiceProduct->quantity }}</td>
                                    <td class="rightfoot">${{ $ncinvoiceProduct->price }}</td>
                                    <td class="rightfoot">${{ number_format($ncinvoiceProduct->quantity*$ncinvoiceProduct->price,2) }}</td>
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
