@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="box-header with-border">
            <h4 class="box-title">Detalle de anticipos
                @can('advance.index')
                    <a href="{{ route('advance.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                @endcan
                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan

            </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="customer">TERCERO</label>
                <p>{{ $advance->advanceable->name }}</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="branch">Sucursal</label>
                <p>{{ $advance->branch->name }}</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="user">Recibido</label>
                <p>{{ $advance->user->name }}</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="origin">Origen</label>
                <p>{{ $advance->origin }}</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="destination">Destino</label>
                <p>{{ $advance->destination }}</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="pay">ABONO</label>
                <p>{{ number_format($advance->pay, 2) }}</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="balance">Saldo a fecha</label>
                <p>{{ number_format($advance->balance, 2) }}</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="created_at">Fecha</label>
                <p>{{ $advance->created_at }}</p>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="note">Nota</label>
                <p>{{ $advance->note }}</p>
            </div>
        </div>
    </div>
    @if ($payPaymentMethods != null)
        <div class="box-body row">
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
                                <th><p align="right">${{ number_format($advance->pay, 2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>

                                @foreach($payPaymentMethods as $payPaymentMethod)
                                    <tr>
                                        <td>{{ $payPaymentMethod->paymentMethod->name }}</td>
                                        <td>{{ $payPaymentMethod->bank->name }}</td>
                                        <td>{{ $payPaymentMethod->card->name }}</td>
                                        <td>{{ $payPaymentMethod->transaction }}</td>
                                        <td class="rightfoot">$ {{ number_format($payPaymentMethod->pay, 2) }}</td>
                                    </tr>
                                @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</main>
@endsection
