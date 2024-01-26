<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/voucher.css') }}">
        <title>Pago Comisiones</title>

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
                <p>{{  $workLabor->user->branch->municipality->name  }}</p>
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
                <p>{{  $workLabor->employee->address  }}</p>
            </div>
            <div class="title">
                <p>Telefono:</p>
            </div>
            <div class="description2">
                <p>{{  $workLabor->employee->phone  }}</p>
            </div>
            <div class="clearfix"></div>
            <div class="title">
                <p>Recibo de:</p>
            </div>
            <div class="description5">
                <p>{{  $workLabor->employee->name  }}</p>
            </div>
            <div class="clearfix"></div>
            <div class="title">
                <p>Concepto de::</p>
            </div>
            <div class="description4">
                <p>Pago Comisiones # {{ $workLabor->id }} </p>
            </div>
            <div class="title">
                <p>Comprobante</p>
            </div>
            <div class="description2">
                <p>{{ $pay->id }}</p>
            </div>
        </div>
        <div class="content">
            <div class="center">
                <div id="ttable">
                    <table class="table">
                        <!--DETALLE DE VENTA -->
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
                        <tfoot>
                            <tr>
                                <th colspan="5" class="rightfoot">TOTAL:</th>
                                <td class="rightfoot thfoot"><strong>${{number_format($workLabor->total_pay,2)}}</strong></td>
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
                <p>{{ $workLabor->user->name }} <br>
                C:C: {{ $workLabor->user->identification }}</p>
            </div>
            <div class="signature">
                <p>Firma responsable <br>
                C:C: </p>
            </div>
        </footer>
    </body>
</html>



