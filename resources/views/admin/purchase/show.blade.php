@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle de la compra
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
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="id">COMPRA #</label>
                <h6>{{ $purchase->id }}</h6>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">SUCURSAL</label>
                <h6>{{ $purchase->branch->name }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="payment_form">FORMA DE PAGO</label>
                <h6>{{ $purchase->paymentForm->name }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="balance">SALDO A PAGAR</label>
                <h6>{{ number_format($purchase->balance, 2) }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">PROVEEDOR</label>
                <h6>{{ $purchase->third->name }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="document">DOCUMENTO No.</label>
                <h6>{{ $purchase->document }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="Fecha">FECHA EMISION</label>
                <h6>{{ date('d-m-Y', strtotime($purchase->created_at)) }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="due_date">VENCE</label>
                <h6>{{ $purchase->due_date }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">RESPONSABLE</label>
                <h6>{{ $purchase->user->name }}</h6>
            </div>
        </div>
    </div><br>
    <div class="box-body row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="bg-info">
                            <th>Producto</th>
                            <th>Precio ($)</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="rightfoot">TOTAL:</th>
                            <td class="rightfoot thfoot"><strong>${{number_format($purchase->total,2)}}</strong></td>
                         </tr>

                         <tr>
                             <th colspan="3" class="rightfoot">TOTAL IVA:</th>
                             <td class="rightfoot thfoot"><strong>${{number_format($purchase->total_tax,2)}}</strong> </td>
                         </tr>

                         <tr>
                             <th  colspan="3" class="rightfoot">TOTAL PAGAR:</th>
                             <td class="rightfoot thfoot"><strong id="total">${{number_format($purchase->total_pay,2)}}</strong></td>
                         </tr>
                         @if ($retentionsum > 0)
                            @foreach ($retentions as $retention)
                                <tr>
                                    <th colspan="3" class="rightfoot">{{ $retention->name }}:</th>
                                    <td class="rightfoot thfoot"><strong>$ -{{number_format($retention->tax_value,2)}}</strong> </td>
                                </tr>
                            @endforeach
                        @endif
                        @if ($purchase->pay > 0)
                            <tr>
                                <th  colspan="3" class="rightfoot">ABONOS</th>
                                <td  class="rightfoot thfoot"><strong>$ -{{number_format($purchase->pay,2)}}</strong></td>
                            </tr>
                        @endif
                        @if ($debitNote > 0)
                            <tr>
                                <th  colspan="3" class="rightfoot">NOTA DEBITO:</th>
                                <td class="rightfoot thfoot"><strong id="total">$ -{{number_format($debitNote,2)}}</strong></td>
                            </tr>
                        @endif
                        @if ($retentionnd > 0)
                            <tr>
                                <th  colspan="3" class="rightfoot">RET ND:</th>
                                <td class="rightfoot thfoot"><strong id="total">$ {{number_format($retentionnd,2)}}</strong></td>
                            </tr>
                        @endif
                        @if ($creditNote > 0)
                            <tr>
                                <th  colspan="3" class="rightfoot">NOTA CREDITO:</th>
                                <td class="rightfoot thfoot"><strong id="total">$ {{number_format($creditNote,2)}}</strong></td>
                            </tr>
                        @endif
                        @if ($retentionnc > 0)
                            <tr>
                                <th  colspan="3" class="rightfoot">RET NC:</th>
                                <td class="rightfoot thfoot"><strong id="total">$ -{{number_format($retentionnc,2)}}</strong></td>
                            </tr>
                        @endif
                        <tr>
                            <th  colspan="3" class="rightfoot">SALDO A PAGAR:</th>
                            <td class="rightfoot thfoot"><strong id="total">$ {{number_format($purchase->total_pay -  $purchase->pay - $debitNote - $retentionsum + $creditNote + $retentionnd - $retentionnc,2)}}</strong></td>
                        </tr>

                    </tfoot>
                    <tbody>
                        @foreach($productPurchases as $productPurchase)
                            <tr>
                                <td>{{ $productPurchase->product->name }}</td>
                                <td class="rightfoot">${{ $productPurchase->price }}</td>
                                <td class="rightfoot">{{ $productPurchase->quantity }}</td>
                                <td class="rightfoot">${{ $productPurchase->subtotal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
