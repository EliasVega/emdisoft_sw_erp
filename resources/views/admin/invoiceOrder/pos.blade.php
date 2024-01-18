<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ 'css/post.css' }}">
        <title>Documento Equivalente de compra</title>

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
                <p><strong id="companyName">{{  $company->name  }}</strong></p>

                <p id="companyData">Nit: {{ $company->nit }} - {{ $company->dv }} - {{ $invoiceOrder->branch->address }} - <br> Email: {{ $invoiceOrder->branch->email }}
                    </p>
            </div>
            <!--DATOS FACTURA -->
            <div id="document">
                <p> POST: <strong id="numfact">N°.{{ $invoiceOrder->id }}</strong> <br>
                    FECHA DE EMISION: <strong id="datfact">{{ date('d-m-Y', strtotime($invoiceOrder->created_at)) }}</strong>
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
                        <span id="rowHeader">NOMBRE:   </span><br>
                        <span id="rowHeader">EMAIL:    </span><br>
                    </div>
                    <div id="thirdData">
                        <span id="rowData">{{ $invoiceOrder->third->identification }}</span><br>
                        <span id="rowData">{{ $invoiceOrder->third->name }}</span><br>
                        <span id="rowData">{{ $invoiceOrder->third->email }}</span><br>
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
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoiceOrderProducts as $invoiceOrderProduct)
                <tr>
                    <td>{{ $invoiceOrderProduct->product->name }}</td>
                    <td id="tdcenter">{{ number_format($invoiceOrderProduct->quantity) }}</td>
                    <td class="tdRight">${{ number_format($invoiceOrderProduct->price)}}</td>
                    <td class="tdRight">${{number_format($invoiceOrderProduct->quantity * $invoiceOrderProduct->price)}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <!--DATOS FTOTALES -->
                <tr>
                    <th colspan="3" class="footRight">TOTAL:</th>
                    <td colspan="3" class="footRight"><strong>${{number_format($invoiceOrder->total,2)}}</strong></td>
                </tr>
                <tr>
                    <th colspan="3" class="footRight">IMPUESTOS:</th>
                    <td colspan="3" class="footRight"><strong>${{number_format($invoiceOrder->total_tax,2)}}</strong> </td>
                </tr>
                <tr>
                    <th colspan="3" class="footRight">TOTAL PAGAR:</th>
                    <td colspan="3" class="footRight"><strong>${{number_format($invoiceOrder->total_pay,2)}}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <br>
    <br>
    <footer>
        Impreso por Emdisoft S.A.S. derechos reservados
    </footer>
    </body>

</html>



