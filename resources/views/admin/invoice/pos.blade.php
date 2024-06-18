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
    <title>Documento Equivalente pos</title>

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

            <p id="companyData">Nit: {{ $company->nit }} - {{ $company->dv }} <br> - {{ $invoice->branch->address }} -
                {{ $invoice->branch->municipality->name }} - {{ $invoice->branch->department->name }} <br>- Email:
                {{ $invoice->branch->email }}
                @if ($indicator->dian == 'on')
                    {{ $company->regime->name }} - {{ $company->nameO }}
                @endif
                <br>
            </p>
        </div>
        <!--DATOS FACTURA -->
        <div id="document">
            <p> {{ company()->pos_invoice }}: <strong id="numfact">{{ $invoice->document }}</strong> <br>
                FECHA DE EMISION: <strong
                    id="datfact">{{ date('d-m-Y', strtotime($invoice->generation_date)) }}</strong>
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
                    <span id="rowData">{{ $invoice->third->identification }}</span><br>
                    <span id="rowData">{{ $invoice->third->name }}</span><br>
                    <span id="rowData">{{ $invoice->third->email }}</span><br>
                </div>
            </div>
        </div>
        @if ($debitNote != null)
            <div class="center">
                <div id="thirdTitle">
                    <span id="title">Venta modificada con la Nota debito {{ $debitNote->document }}</span>
                </div>
            </div>
        @endif
        @if ($creditNote != null)
            <div class="center">
                <div id="thirdTitle">
                    <span id="title">Venta modificada con la Nota credito {{ $creditNote->document }}</span>
                </div>
            </div>
        @endif
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
                @foreach ($invoiceProducts as $invoiceProduct)
                    <tr>
                        <td>{{ $invoiceProduct->product->name }}</td>
                        <td id="tdcenter">{{ number_format($invoiceProduct->quantity) }}</td>
                        <td class="tdRight">${{ number_format($invoiceProduct->price) }}</td>
                        <td class="tdRight">${{ number_format($invoiceProduct->quantity * $invoiceProduct->price) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <!--DATOS FTOTALES -->
                <tr>
                    <th colspan="3" class="footRight">TOTAL:</th>
                    <td colspan="3" class="footRight"><strong>${{ number_format($invoice->total, 2) }}</strong></td>
                </tr>
                <tr>
                    <th colspan="3" class="footRight">IMPUESTOS:</th>
                    <td colspan="3" class="footRight"><strong>${{ number_format($invoice->total_tax, 2) }}</strong>
                    </td>
                </tr>
                <tr>
                    <th colspan="3" class="footRight">TOTAL PAGAR:</th>
                    <td colspan="3" class="footRight"><strong>${{ number_format($invoice->total_pay, 2) }}</strong></td>
                </tr>
                @if ($retentionsum > 0)
                    @foreach ($retentions as $retention)
                        <tr>
                            <th colspan="3" class="footRight">{{ $retention->name }}:</th>
                            <td colspan="3" class="footRight"><strong>>-${{ number_format($retention->tax_value, 2) }}</strong></td>
                        </tr>
                    @endforeach
                @endif
                @if ($invoice->pay > 0)
                    <tr>
                        <th colspan="3" class="footRight">ABONOS:</th>
                        <td colspan="3" class="footRight"><strong> -${{ number_format($invoice->pay, 2) }}</strong></td>
                    </tr>
                @endif
                @if ($debitNote > 0)
                    <tr>
                        <th colspan="3" class="footRight">NOTA DEBITO:</th>
                        <td colspan="3" class="footRight"><strong>${{ number_format($debitNote, 2) }}</strong></td>
                    </tr>
                @endif
                @if ($retentionnd > 0)
                    <tr>
                        <th colspan="3" class="footRight">RET ND:</th>
                        <td colspan="3" class="footRight"><strong>-${{ number_format($retentionnd, 2) }}</strong></td>
                    </tr>
                @endif
                @if ($creditNote > 0)
                    <tr>
                        <th colspan="3" class="footRight">NOTA CREDITO:</th>
                        <td colspan="3" class="footRight"><strong> -${{ number_format($creditNote, 2) }}</strong></td>
                    </tr>
                @endif
                @if ($retentionnc > 0)
                    <tr>
                        <th colspan="3" class="footRight">RET NC:</th>
                        <td colspan="3" class="footRight"><strong> ${{ number_format($retentionnc, 2) }}</strong></td>
                    </tr>
                @endif
                @if ($invoice->total_pay != $invoice->balance)
                    <tr>
                        <th colspan="3" class="footRight">SALDO A PAGAR:</th>
                        <td colspan="3" class="footRight"><strong>$
                            {{ number_format($invoice->total_pay - $invoice->pay - $creditNote - $retentionsum + $debitNote + $retentionnc - $retentionnd, 2) }}</strong></td>
                    </tr>
                @endif
                @if ($invoice->payment_form_id == 1)
                    @if ($paymentReturns != null)
                        <tr>
                            <th colspan="3" class="footRight">EFECTIVO</th>
                            <td colspan="3" class="footRight"><strong>$
                                    {{ number_format($paymentReturns->payment, 2) }}</strong></td>
                        </tr>
                        <tr>
                            <th colspan="3" class="footRight">CAMBIO</th>
                            <td colspan="3" class="footRight"><strong>$
                                    {{ number_format($paymentReturns->return, 2) }}</strong></td>
                        </tr>
                    @endif
                @endif
            </tfoot>
        </table>
        <div class="center">
            <div id="third">
                <!--DATOS CLIENTE -->
                <div>
                    <span id="rowHeader"><strong>Elaborado por:</strong></span><br>
                    <span id="rowData"><strong>{{ $invoice->user->name }}</strong></span><br>
                </div>
            </div>
        </div>
    </div>
    @if ($restaurantOrder != null)
        @if ($restaurantOrder->restaurant_table_id == 1 && $homeOrder->type == 'home')
            <div id="document">
                <p> PARA ENVIO A DOMICILIO A:</p>
            </div>

            <div id="document">
                <p> NOMBRE: <strong class="numfact">{{ $restaurantOrder->homeOrder->name }}</strong></p>
            </div>
            <div id="document">
                <p> DIRECCION: <strong class="numfact">{{ $restaurantOrder->homeOrder->address }}</strong></p>
            </div>
            <div id="document">
                <p> TELEFONO: <strong class="numfact">{{ $restaurantOrder->homeOrder->phone }}</strong></p>
            </div>
            <div id="document">
                <p> DOMICILIO: <strong
                        class="numfact">${{ number_format($restaurantOrder->homeOrder->domicile_value, 2) }}</strong>
                </p>
            </div>
        @endif
    @endif
</body>

</html>
