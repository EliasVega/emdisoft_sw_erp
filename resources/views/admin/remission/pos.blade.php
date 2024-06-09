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
    <title>Remision</title>

</head>

<header id="header">
    <!-- LOGGO -->
    <div class="center">
        @if (indicator()->logo == 'on')
            <div class="center">
                <div id="logo">
                    <img src="{{ asset(company()->logo) }}" alt="{{ company()->name }}">
                </div>
            </div>
        @endif
    </div>

    <div class="clearfix"></div>
    <div class="center">
        <!--DATOS company -->
        <div class="company">
            <p><strong id="companyName">{{ company()->name }}</strong></p>

            <p id="companyData">Nit: {{ company()->nit }} - {{ company()->dv }} <br> - {{ $remission->branch->address }} -
                {{ $remission->branch->municipality->name }} - {{ $remission->branch->department->name }} <br>- Email:
                {{ $remission->branch->email }}
                @if (indicator()->dian == 'on')
                    {{ company()->regime->name }} - {{ company()->nameO }}
                @endif
                <br>
            </p>
        </div>
        <!--DATOS FACTURA -->
        <div id="document">
            <p> REMISION: <strong id="numfact">N°.{{ $remission->id }}</strong> <br>
                FECHA DE EMISION: <strong
                    id="datfact">{{ date('d-m-Y', strtotime($remission->generation_date)) }}</strong>
            </p>
        </div>
    </div>
</header>
<div class="clearfix"></div>

<body>
    <div class="content">
        <!--DATOS CLIENTE -->
        <p id="title">DATOS DEL CLIENTE</p>
        <div class="center">
            <div id="third">
                <!--DATOS CLIENTE -->
                <div id="thirdHeader">
                    <span id="rowHeader">CC o NIT: </span><br>
                    <span id="rowHeader">NOMBRE: </span><br>
                    <span id="rowHeader">EMAIL: </span><br>
                </div>
                <div id="thirdData">
                    <span id="rowData">{{ $remission->third->identification }}</span><br>
                    <span id="rowData">{{ $remission->third->name }}</span><br>
                    <span id="rowData">{{ $remission->third->email }}</span><br>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <table class="table">
            <!--DETALLE DE VENTA -->
            <thead>
                <tr>
                    <th>Descripcion</th>
                    <th>Cant.</th>
                    <th>Valor</th>
                    <th style="width:80px">SubTotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productRemissions as $productRemission)
                    <tr>
                        <td>{{ $productRemission->product->name }}</td>
                        <td id="tdcenter">{{ number_format($productRemission->quantity) }}</td>
                        <td class="tdRight">${{ number_format($productRemission->price) }}</td>
                        <td class="tdRight">${{ number_format($productRemission->quantity * $productRemission->price) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <!--DATOS FTOTALES -->
                <tr>
                    <th colspan="3" class="footRight">TOTAL:</th>
                    <td colspan="3" class="footRight"><strong>${{ number_format($remission->total, 2) }}</strong></td>
                </tr>
                <tr>
                    <th colspan="3" class="footRight">IMPUESTOS:</th>
                    <td colspan="3" class="footRight"><strong>${{ number_format($remission->total_tax, 2) }}</strong>
                    </td>
                </tr>
                <tr>
                    <th colspan="3" class="footRight">TOTAL PAGAR:</th>
                    <td colspan="3" class="footRight"><strong>${{ number_format($remission->total_pay, 2) }}</strong></td>
                </tr>
                @if ($remission->pay > 0)
                    <tr>
                        <th colspan="3" class="footRight">ABONOS:</th>
                        <td colspan="3" class="footRight"><strong> -${{ number_format($remission->pay, 2) }}</strong></td>
                    </tr>
                @endif
                @if ($remission->total_pay != $remission->balance)
                    <tr>
                        <th colspan="3" class="footRight">SALDO A PAGAR:</th>
                        <td colspan="3" class="footRight"><strong>$
                            {{ number_format($remission->total_pay - $remission->pay, 2) }}</strong></td>
                    </tr>
                @endif
            </tfoot>
        </table>
        <div class="center">
            <div id="third">
                <!--DATOS CLIENTE -->
                <div>
                    <span id="rowHeader"><strong>Elaborado por:</strong></span><br>
                    <span id="rowData"><strong>{{ $remission->user->name }}</strong></span><br>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
