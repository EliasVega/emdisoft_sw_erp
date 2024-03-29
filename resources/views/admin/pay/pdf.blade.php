<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/voucher.css') }}">
        <title>ANTICIPO</title>

    </head>
    <header id="header">
        <!-- LOGGO -->
        <div class="center">
            @if ($indicator->logo == 'on')
                <div id="logo">
                    <img src="{{ asset($company->logo) }}" alt="{{ $company->name }}" width="150px" height="50px" class="app-logo">
                </div>
            @endif
        <!--DATOS company -->
            <div class="company">
                <p><strong id="name">{{  $company->name  }}</strong></p>

                <p id="data">Nit: {{ $company->nit }} -- {{ $company->dv }} <br> {{ $company->municipality->name }} -- {{ $company->department->name }} <br> Email: {{ $company->email }}
                    </p>
            </div>
            <!--DATOS FACTURA -->
            <div id="voucher">
                <p>COMPROBANTE <br> DE PAGO <br> <strong id="numbervoucher">N°. {{ $pay->id }}</strong></p>

            </div>
        </div>
    </header>
    <body>
        <div class="information">
            <div class="title">
                <p>Ciudad:</p>
            </div>
            <div class="description">
                <p>{{  $company->municipality->name  }}</p>
            </div>
            <div class="title">
                <p>Fecha</p>
            </div>
            <div class="description2">
                <p>{{ date('d-m-Y', strtotime($pay->created_at)) }}</p>
            </div>
            <div class="description3">
                <p>$ {{ number_format($pay->pay, 2) }}</p>
            </div>

            <div class="clearfix"></div>
            <div class="title">
                <p>Direccion:</p>
            </div>
            <div class="description4">
                <p>{{  $pay->payable->third->address  }}</p>
            </div>
            <div class="title">
                <p>Telefono:</p>
            </div>
            <div class="description2">
                <p>{{  $pay->payable->third->phone  }}</p>
            </div>
            <div class="clearfix"></div>
            <div class="title">
                <p>Recibo de:</p>
            </div>
            <div class="description5">
                <p>{{  $pay->payable->third->name  }}</p>
            </div>
            <div class="clearfix"></div>
            <div class="title">
                <p>Concepto de::</p>
            </div>
            <div class="description4">
                @if ($pay->type == 'purchase')
                    <span>Abono a Compra # {{ $pay->payable->id }}</span><br>
                @elseif ($pay->type == 'invoice')
                    <span>Abono a Factura # {{ $pay->payable->id }}</span><br>
                @elseif ($pay->type == 'advance')
                    <span>Abono a Anticipo # {{ $pay->payable->id }}</span><br>
                @elseif ($pay->type == 'work_labor')
                    <span>Abono a Comision # {{ $pay->payable->id }}</span><br>
                @endif
            </div>

            <div class="title">
                <p>Comprobante</p>
            </div>
            <div class="description2">
                <p>{{ $pay->id }}</p>
            </div>
            <div class="clearfix"></div>
            <div class="title">
                <p>Saldo Pendiente:</p>
            </div>
            <div class="description4">
                @if ($pay->type == 'purchase')
                    <span>Despues de este abono $ {{ $pay->payable->balance }}</span><br>
                @elseif ($pay->type == 'invoice')
                    <span>Despues de este abono $ {{ $pay->payable->balance }}</span><br>
                @elseif ($pay->type == 'advance')
                    <span>Despues de este abono $ {{ $pay->payable->balance }}</span><br>
                @elseif ($pay->type == 'work_labor')
                    <span>Despues de este abono $ 0.00</span><br>
                @endif
            </div>
        </div>
        <div class="content">
            <div class="center">
                <div id="ttable">
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
                                <td class="tdder">$ {{ number_format($payPaymentMethod->pay, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <!--DATOS FTOTALES -->
                            <tr>
                                <th colspan="2" class="tdRight">TOTAL:</th>
                                <td class="tdRight"><strong>${{number_format($pay->pay,2)}}</strong></td>
                             </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>

        <!--DATOS CLIENTE -->
        <br>
        <br>
        <footer class="footer">
            <div class="signature">
                <p>{{ $users->name }} <br>
                C:C: {{ $users->identification }}</p>
            </div>
            <div class="signature">
                <p>Firma responsable <br>
                C:C: </p>
            </div>
        </footer>
    </body>
</html>



