<?php
$medidaTicket = 180;

?>
<!DOCTYPE>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ 'css/post.css' }}">
    <title>Pago de comisiones</title>

</head>

<header id="header">
    <!-- LOGGO -->
    <div class="center">
        @if ($indicator->logo == 'on')
            <div class="center">
                <div id="logo">
                    <img src="{{ asset($company->logo) }}" alt="{{ $company->name }}">
                </div>
            </div>
        @endif
    </div>

    <div class="clearfix"></div>
    <div class="center">
        <!--DATOS company -->
        <div class="company">
            <p><strong id="companyName">{{ $company->name }}</strong></p>

            <p id="companyData">Nit: {{ $company->nit }} - {{ $company->dv }} <br> - {{ $workLabor->user->branch->address }} -
                {{ $workLabor->user->branch->municipality->name }} - {{ $workLabor->user->branch->department->name }} <br>- Email:
                {{ $workLabor->user->branch->email }}
                <br>
            </p>
        </div>
        <!--DATOS FACTURA -->
        <div id="document">
            <p> {{ $company->pos_invoice }}: <strong id="numfact">N°.{{ $workLabor->id }}</strong> <br>
                FECHA DE EMISION: <strong
                    id="datfact">{{ date('d-m-Y', strtotime($workLabor->generation_date)) }}</strong>
            </p>
        </div>
    </div>
    <div class="content">
        <!--DATOS CLIENTE -->
        <p id="title">DATOS DEL OPERADOR</p>
        <div class="center">
            <div id="third">
                <!--DATOS CLIENTE -->
                <div id="thirdHeader">
                    <span id="rowHeader">CC o NIT: </span><br>
                    <span id="rowHeader">NOMBRE: </span><br>
                    <span id="rowHeader">EMAIL: </span><br>
                </div>
                <div id="thirdData">
                    <span id="rowData">{{ $workLabor->employee->identification }}</span><br>
                    <span id="rowData">{{ $workLabor->employee->name }}</span><br>
                    <span id="rowData">{{ $workLabor->employee->email }}</span><br>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="clearfix"></div>
<body>
    <div class="content">
        <div class="center">
            <div id="ttable">
                <table class="table">
                    <!--DETALLE DE VENTA -->
                    <thead>
                    <tr class="bg-info">
                        <th>Operacion</th>
                        <th>Comision</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($employeeInvoiceProducts as $employeeInvoiceProduct)
                        <tr>
                            <td>{{ $employeeInvoiceProduct->invoiceProduct->product->name }}</td>
                            <td class="tdRight">{{ number_format($employeeInvoiceProduct->value_commission,2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="1" class="rightfoot">TOTAL:</th>
                            <td class="footRight"><strong>${{ number_format($workLabor->total_pay, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div id="document">
                <p> Elaborado por: <strong class="numfact">{{ $workLabor->user->name }}</strong></p>
            </div>

        </div>
    </div>

</body>

</html>
