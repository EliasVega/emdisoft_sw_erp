@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle de la Remision
                    <a href="{{ route('remission.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>

                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="id">REMISION #</label>
                <h6>{{ $remission->id }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">SUCURSAL</label>
                <h6>{{ $remission->branch->name }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="payment_form">FORMA DE PAGO</label>
                <h6>{{ $remission->paymentForm->name }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="balance">SALDO A PAGAR</label>
                <h6>{{ number_format($remission->balance, 2) }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">CLIENTE</label>
                <h6>{{ $remission->third->name }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="document">DOCUMENTO No.</label>
                <h6>{{ $remission->document }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="Fecha">FECHA EMISION</label>
                <h6>{{ date('d-m-Y', strtotime($remission->generation_date)) }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="due_date">VENCE</label>
                <h6>{{ $remission->due_date }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">RESPONSABLE</label>
                <h6>{{ $remission->user->name }}</h6>
            </div>
        </div>
        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">OBSERVACIONES</label>
                <h6>{{ $remission->note }}</h6>
            </div>
        </div>
    </div>
    <div class="box-body row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="bg-info">
                            @if ($indicator->work_labor == 'on')
                                <th>Operario</th>
                            @else
                                <th>ID</th>
                            @endif
                            <th>Producto</th>
                            <th>Precio ($)</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="rightfoot">TOTAL:</th>
                            <td class="rightfoot thfoot"><strong>${{number_format($remission->total,2)}}</strong></td>
                         </tr>
                         @if ($taxLinesum > 0)
                            @foreach ($taxLines as $taxLine)
                                <tr>
                                    <th colspan="4" class="rightfoot">{{ $taxLine->name }}:</th>
                                    <td class="rightfoot thfoot"><strong>${{number_format($taxLine->tax_value,2)}}</strong> </td>
                                </tr>
                            @endforeach
                         @endif
                         <tr>
                             <th  colspan="4" class="rightfoot">TOTAL PAGAR:</th>
                             <td class="rightfoot thfoot"><strong id="total">${{number_format($remission->total_pay,2)}}</strong></td>
                         </tr>
                         @if ($retentionsum > 0)
                            @foreach ($retentions as $retention)
                                <tr>
                                    <th colspan="4" class="rightfoot">{{ $retention->name }}:</th>
                                    <td class="rightfoot thfoot"><strong>-${{number_format($retention->tax_value,2)}}</strong> </td>
                                </tr>
                            @endforeach
                        @endif
                        @if ($remission->pay > 0)
                            <tr>
                                <th  colspan="4" class="rightfoot">ABONOS</th>
                                <td  class="rightfoot thfoot"><strong>-${{number_format($remission->pay,2)}}</strong></td>
                            </tr>
                        @endif
                        <tr>
                            <th  colspan="4" class="rightfoot">SALDO A PAGAR:</th>
                            <td class="rightfoot thfoot"><strong id="total">$ {{number_format($remission->total_pay -  $remission->pay,2)}}</strong></td>
                        </tr>

                    </tfoot>
                    <tbody>
                        @foreach($productRemissions as $productRemission)
                            <tr>
                                <td>{{ $productRemission->id }}</td>
                                <td>{{ $productRemission->product->name }}</td>
                                <td class="rightfoot">${{ number_format($productRemission->price,2) }}</td>
                                <td class="rightfoot">{{ number_format($productRemission->quantity,2) }}</td>
                                <td class="rightfoot">${{ number_format($productRemission->subtotal,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
