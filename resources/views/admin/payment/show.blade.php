@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle del abono
                @can('payment.index')
                    <a href="{{ route('payment.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
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
                    <p>{{ $payment->paymentable->name }}</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="order">Identificacion</label>
                <p><strong>{{ $payment->paymentable->Identification }}</strong></p>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="abono">ABONO</label>
                <p>{{ number_format($payment->pay, 2) }}</p>
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
                            <th><p align="right">${{ number_format($payment->pay, 2) }}</p></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($paymentPaymentMethods as $paymentPaymentMethod)
                            <tr>
                                <td>{{ $paymentPaymentMethod->paymentMethod->name }}</td>
                                <td>{{ $paymentPaymentMethod->bank->name }}</td>
                                <td>{{ $paymentPaymentMethod->card->name }}</td>
                                <td>{{ $paymentPaymentMethod->transaction }}</td>
                                <td class="tdder">$ {{ number_format($paymentPaymentMethod->pay, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
