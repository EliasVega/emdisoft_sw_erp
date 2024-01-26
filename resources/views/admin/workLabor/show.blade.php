@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle de Pago

                    <a href="{{ route('workLabor.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>

                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="id">Id</label>
                <h6>{{ $workLabor->id }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="id">Operador</label>
                <h6>{{ $workLabor->employee->name }}</h6>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">SUCURSAL</label>
                <h6>{{ $workLabor->user->branch->name }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="balance">Valor</label>
                <h6>{{ number_format($workLabor->total_pay, 2) }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">Elaboro</label>
                <h6>{{ $workLabor->user->name }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="Fecha">FECHA Elaboracion</label>
                <h6>{{ date('d-m-Y', strtotime($workLabor->generation_date)) }}</h6>
            </div>
        </div>
    </div><br>
    <div class="box-body row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="bg-info">
                            <th>Operacion</th>
                            <th>Cantidad</th>
                            <th>Precio ($)</th>
                            <th>Subtotal</th>
                            <th>%</th>
                            <th>Comision</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="rightfoot">TOTAL:</th>
                            <td class="rightfoot thfoot"><strong>${{number_format($workLabor->total_pay,2)}}</strong></td>
                         </tr>

                    </tfoot>
                    <tbody>
                        @foreach($employeeInvoiceProducts as $employeeInvoiceProduct)
                            <tr>
                                <td>{{ $employeeInvoiceProduct->invoiceProduct->product->name }}</td>
                                <td class="rightfoot">{{ $employeeInvoiceProduct->quantity }}</td>
                                <td class="rightfoot">${{ number_format($employeeInvoiceProduct->price,2) }}</td>
                                <td class="rightfoot">${{ number_format($employeeInvoiceProduct->subtotal,2) }}</td>
                                <td class="rightfoot">{{ number_format($employeeInvoiceProduct->commission,2) }}</td>
                                <td class="rightfoot">{{ number_format($employeeInvoiceProduct->value_commission,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
