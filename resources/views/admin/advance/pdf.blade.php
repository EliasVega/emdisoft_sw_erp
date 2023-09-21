<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/vouchers.css') }}">
        <title>ANTICIPO</title>

    </head>
    <header id="header">
        <!-- LOGGO -->
        <div class="center">
            <div id="logo">
                <img src="{{ public_path('images/logos/'.$company->logo) }}" alt="{{ $company->name }}" class="app-logo">
            </div>
        <!--DATOS company -->
            <div class="company">
                <p><strong id="name">{{  $company->name  }}</strong></p>

                <p id="data">Nit: {{ $company->nit }} -- {{ $company->dv }} <br> {{ $company->municipality->name }} -- {{ $company->department->name }} <br> Email: {{ $company->email }}
                    </p>
            </div>
            <!--DATOS FACTURA -->
            <div id="voucher">
                <p>COMPROBANTE <br> DE ANTICIPOS <br> <strong id="numbervoucher">N°. {{ $advance->id }}</strong></p>

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
                <p>{{ date('d-m-Y', strtotime($advance->created_at)) }}</p>
            </div>
            <div class="description3">
                <p>$ {{ number_format($advance->pay, 2) }}</p>
            </div>

            <div class="clearfix"></div>
            <div class="title">
                <p>DIRECCION:</p>
            </div>
            <div class="description4">
                <p>{{  $advance->advanceable->address  }}</p>
            </div>
            <div class="title">
                <p>TELEFONO:</p>
            </div>
            <div class="description2">
                <p>{{  $advance->advanceable->phone  }}</p>
            </div>
            <div class="clearfix"></div>
            <div class="title">
                <p>TERCERO:</p>
            </div>
            <div class="description5">
                <p>{{  $advance->advanceable->name  }}</p>
            </div>
            <div class="clearfix"></div>
            <div class="title">
                <p>CONCEPTO DE::</p>
            </div>

            <div class="description5">
                @if ($advance->type == 'customer')
                <p>Anticipo de Cliente</p>
                @elseif($advance->type == 'provider')
                <p>Anticipo de Proveedor</p>
                @else
                <p>Anticipo a Empleado</p>
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
                            <tr>
                                <th  colspan="2"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($advance->pay, 2) }}</p></th>
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
                <p>{{ $user->name }} <br>
                C:C: {{ $user->number }}</p>
            </div>
            <div class="signature">
                <p>Firma responsable <br>
                C:C: </p>
            </div>
        </footer>
    </body>
</html>



