<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ 'css/post.css' }}">
        <title>Anticipos</title>

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
        <div class="center">
        <!--DATOS company -->
            <div class="company">
                <p><strong id="companyName">{{  $company->name  }}</strong></p>

                <p id="companyData">Nit: {{ $company->nit }} - {{ $company->dv }} <br> - {{ $advance->branch->address }} - {{ $advance->branch->municipality->name }} -{{ $advance->branch->department->name }} - Email: {{ $advance->branch->email }}
                <br></p>
            </div>
            <!--DATOS FACTURA -->
            <div id="document">
                <p>COMPROBANTE DE ANTICIPO <br> <strong id="numbervoucher">N°. {{ $advance->id }}</strong></p>
            </div>
        </div>
    </header>
    <div class="clearfix"></div>
    <body>
        <div class="content">
            <!--DATOS CLIENTE -->
            <p id="title">TERCERO</p>
            <div class="center">
                <div id="third">
                    <!--DATOS CLIENTE -->
                    <div id="thirdHeader">
                        <span id="rowHeader">Nombre: </span><br>
                        <span id="rowHeader">CC - NIT:   </span><br>
                        <span id="rowHeader">Email:    </span><br>
                    </div>
                    <div id="thirdData">
                        <span id="rowData">{{  $advance->advanceable->name  }}</span><br>
                        <span id="rowData">{{  $advance->advanceable->identification  }}</span><br>
                        <span id="rowData">{{  $advance->advanceable->email  }}</span><br>
                    </div>
                </div>
            </div>
            <p id="title">CONCEPTO</p>
            <div class="center">
                <div id="third">
                    <!--DATOS CLIENTE -->
                    <div id="thirdHeader">
                        <span id="rowHeader">Ciudad:</span><br>
                        <span id="rowHeader">Valor:</span><br>
                        @if ($advance->type == 'customer')
                            <p>Anticipo de Cliente</p>
                        @elseif($advance->type == 'provider')
                            <p>Anticipo de Proveedor</p>
                        @else
                            <p>Anticipo a Empleado</p>
                        @endif
                    </div>
                    <div id="thirdData">
                        <span id="rowData">{{  $advance->branch->municipality->name  }}</span><br>
                        <span id="rowData">{{  $advance->pay  }}</span><br>
                        <span id="rowData">#-{{  $advance->advanceable->name  }}</span><br>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <table class="table">
                <!--DETALLE DE VENTA -->
                <thead>
                    <tr>
                        <th>Transaccion</th>
                        <th>Medio de pago</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payPaymentMethods as $payPaymentMethod)
                    <tr>
                        <td>{{ $payPaymentMethod->transaction }}</td>
                        <td>{{ $payPaymentMethod->paymentMethod->name }}</td>
                        <td class="tdRight">$ {{ number_format($payPaymentMethod->pay, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <!--DATOS FTOTALES -->
                    <tr>
                        <th colspan="2" class="footRight">TOTAL</th>
                        <td class="footRight"><strong>${{number_format($advance->pay)}}</strong></td>
                    </tr>
                </tfoot>
            </table>
            <div id="document">
                <p> Elaborado por: <strong class="numfact">{{ $advance->user->name }}</strong></p>
            </div>
        </div>
    </body>

</html>



