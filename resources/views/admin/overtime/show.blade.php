@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle de horas extras
                @can('overtime.index')
                    <a href="{{ route('overtime.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
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
                <label class="form-control-label" for="id">HORAS EXTRAS DE</label>
                <h6>{{ $overtime->year_month }}</h6>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">COLABORADOR</label>
                <h6>{{ $overtime->employee->name }}</h6>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">SUCURSAL</label>
                <h6>{{ $overtime->employee->branch->name }}</h6>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">TOTAL HORAS</label>
                <h6>{{ $overtimeMonthHours }}</h6>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="balance">TOTAl</label>
                <h6>{{ number_format($overtime->total, 2) }}</h6>
            </div>
        </div>

    </div><br>
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle Mensual de totales horas extras
            </h5>
        </div>
    </div>
    <div class="box-body row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th>Id</th>
                            <th>Año-mes</th>
                            <th>Tipo de Hora</th>
                            <th>%</th>
                            <th>Horas</th>
                            <th>V/hora</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tfoot>

                        <tr>
                            <th  colspan="6"><p align="right">TOTAL:</p></th>
                            <th class="thfoot"><p align="right">${{ number_format($overtime->total, 2) }}</p></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($overtimeMonths as $overtimeMonth)
                            <tr>
                                <td>{{ $overtimeMonth->id }}</td>
                                <td>{{ $overtimeMonth->year_month }}</td>
                                <td>{{ $overtimeMonth->overtimeType->hour_type }}</td>
                                <td>{{ $overtimeMonth->overtimeType->percentage }}</td>
                                <td>{{ $overtimeMonth->quantity }}</td>
                                <td class="rightfoot">{{ number_format($overtimeMonth->value_hour,2)  }}</td>
                                <td class="rightfoot">${{ number_format($overtimeMonth->subtotal,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle por dia de horas extras
            </h5>
        </div>
    </div>
    <div class="box-body row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th>Id</th>
                            <th>Tipo de Hora</th>
                            <th>Inicia</th>
                            <th>Termina</th>
                            <th>Horas</th>
                            <th>V/hora</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tfoot>

                        <tr>
                            <th  colspan="6"><p align="right">TOTAL:</p></th>
                            <th class="thfoot"><p align="right">${{ number_format($overtime->total, 2) }}</p></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($overtimeDays as $overtimeDay)
                            <tr>
                                <td>{{ $overtimeDay->id }}</td>
                                <td>{{ $overtimeDay->year_month }}</td>
                                <td>{{ $overtimeDay->overtimeMonth->overtimeType->hour_type }}</td>
                                <td>{{ $overtimeDay->percentage }}</td>
                                <td>{{ $overtimeDay->quantity }}</td>
                                <td class="rightfoot">{{ number_format($overtimeDay->value_hour,2)  }}</td>
                                <td class="rightfoot">${{ number_format($overtimeDay->subtotal,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
