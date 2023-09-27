@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle del abono
                @can('pay.index')
                    <a href="{{ route('pay.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                @endcan
                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="name">TERCERO</label>
                <p>@if ($pay->type == 'purchase')
                    <p>{{ $pay->payable->third->name }}</p>
                @elseif ($pay->type == 'expense')
                    <p>{{ $pay->payable->third->name }}</p>
                @elseif ($pay->type == 'invoice')
                    <p>{{ $pay->payable->third->name }}</p>
                @elseif ($pay->type == 'advance')
                    @if ($pay->payable->type == 'customer')
                        <p>{{ $pay->payable->advanceable->customer->name }}</p>
                    @elseif ($pay->payable->type == 'provider')
                        <p>{{ $pay->payable->advanceable->third->name }}</p>
                    @elseif ($pay->payable->type == 'employee')
                        <p>{{ $pay->payable->advanceable->third->name }}</p>

                    @endif
                @endif
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="order">Document #</label>
                <p><strong>{{ $pay->payable->document }}</strong></p>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="abono">ABONO</label>
                <p>{{ number_format($pay->pay, 2) }}</p>
            </div>
        </div>
    </div>
    <div class="box-body row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <strong class="tpdf">Detalle de Abonos</strong>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="bg-info">
                            <th>Medio de Pago</th>
                            <th>Banco</th>
                            <th>Tarjeta</th>
                            <th>Transaccion</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th  colspan="4"><p align="right">TOTAL:</p></th>
                            <th><p align="right">${{ number_format($pay->pay, 2) }}</p></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($payPaymentMethods as $payPaymentMethod)
                            <tr>
                                <td>{{ $payPaymentMethod->paymentMethod->name }}</td>
                                <td>{{ $payPaymentMethod->bank->name }}</td>
                                <td>{{ $payPaymentMethod->card->name }}</td>
                                <td>{{ $payPaymentMethod->transaction }}</td>
                                <td class="tdder">$ {{ number_format($payPaymentMethod->pay, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
