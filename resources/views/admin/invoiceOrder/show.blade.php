@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle de la Venta
                @can('invoiceOrder.index')
                    <a href="{{ route('invoiceOrder.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
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
                <label class="form-control-label" for="id">ORDEN DE VENTA #</label>
                <h6>{{ $invoiceOrder->id }}</h6>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">SUCURSAL</label>
                <h6>{{ $invoiceOrder->branch->name }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">CLIENTE</label>
                <h6>{{ $invoiceOrder->third->name }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="Fecha">GENERADA</label>
                <h6>{{ date('d-m-Y', strtotime($invoiceOrder->generation_date)) }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">RESPONSABLE</label>
                <h6>{{ $invoiceOrder->user->name }}</h6>
            </div>
        </div>
        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">OBSERVACIONES</label>
                <h6>{{ $invoiceOrder->note }}</h6>
            </div>
        </div>
    </div><br>
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
                            <td class="rightfoot thfoot"><strong>${{number_format($invoiceOrder->total,2)}}</strong></td>
                         </tr>
                         <tr>
                            <th  colspan="4" class="rightfoot">IMPUESTOS:</th>
                            <td class="rightfoot thfoot"><strong id="total">${{number_format($invoiceOrder->total_tax,2)}}</strong></td>
                        </tr>
                         <tr>
                             <th  colspan="4" class="rightfoot">TOTAL PAGAR:</th>
                             <td class="rightfoot thfoot"><strong id="total">${{number_format($invoiceOrder->total_pay,2)}}</strong></td>
                         </tr>

                    </tfoot>
                    <tbody>
                        @foreach($invoiceOrderProducts as $invoiceOrderProduct)
                            <tr>
                                @if ($indicator->work_labor == 'on')
                                    @if ($invoiceOrderProduct->employeeInvoiceOrderProduct == null)
                                        <td><p>No aplica</p></td>
                                    @else
                                        <td>{{ $invoiceOrderProduct->employeeInvoiceOrderProduct->employee->name }}</td>
                                    @endif
                                @else
                                <td>{{ $invoiceOrderProduct->id }}</td>
                                @endif
                                <td>{{ $invoiceOrderProduct->product->name }}</td>
                                <td class="rightfoot">${{ number_format($invoiceOrderProduct->price,2) }}</td>
                                <td class="rightfoot">{{ number_format($invoiceOrderProduct->quantity,2) }}</td>
                                <td class="rightfoot">${{ number_format($invoiceOrderProduct->subtotal,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
