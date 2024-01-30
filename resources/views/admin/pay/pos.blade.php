<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ 'css/post.css' }}">
        <title>Pagos</title>

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

                <p id="companyData">Nit: {{ $company->nit }} - {{ $company->dv }} <br> - {{ $pay->branch->address }} - {{ $pay->branch->municipality->name }} -{{ $pay->branch->department->name }} - Email: {{ $pay->branch->email }}
                <br></p>
            </div>
            <!--DATOS FACTURA -->
            <div id="document">
                <p>COMPROBANTE <br> DE PAGO <br> <strong id="numbervoucher">N°. {{ $pay->id }}</strong></p>
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
                        <span id="rowData">{{  $pay->payable->third->name  }}</span><br>
                        <span id="rowData">{{  $pay->payable->third->identification  }}</span><br>
                        <span id="rowData">{{  $pay->payable->third->email  }}</span><br>
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
                        @if ($pay->type == 'purchase')
                            <span id="rowHeader">Abono a Compra</span><br>
                        @elseif ($pay->type == 'invoice')
                            <span id="rowHeader">Abono a Factura</span><br>
                        @elseif ($pay->type == 'advance')
                            <span id="rowHeader">Abono a Anticipo</span><br>
                        @elseif ($pay->type == 'work_labor')
                            <span id="rowHeader">Abono a Comision</span><br>
                        @endif
                        <span id="rowHeader">Saldo Pendiente:</span><br>

                    </div>
                    <div id="thirdData">
                        <span id="rowData">{{  $pay->branch->municipality->name  }}</span><br>
                        <span id="rowData">{{  $pay->pay  }}</span><br>
                        <span id="rowData">#-{{  $pay->payable->id  }}</span><br>
                        @if ($pay->type == 'work_labor')
                            <span id="rowData"> $ 0.00</span><br>
                        @else
                            <span id="rowData"> ${{  $pay->payable->balance  }}</span><br>
                        @endif

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
                        <td class="footRight"><strong>${{number_format($pay->pay)}}</strong></td>
                    </tr>
                </tfoot>
            </table>
            <div id="document">
                <p> Elaborado por: <strong class="numfact">{{ $pay->user->name }}</strong></p>
            </div>
        </div>
    </body>

</html>



