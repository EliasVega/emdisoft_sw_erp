<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ 'css/post.css' }}">
        <title>Precompra </title>

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

                <p id="companyData">Nit: {{ $company->nit }} - {{ $company->dv }} - {{ $company->regime->name }} - {{ $company->nameO }}  {{ $purchaseOrder->branch->address }} - {{ $company->municipality->name }} {{ $company->department->name }} <br> Email: {{ $purchaseOrder->branch->email }}
                    </p>
            </div>
            <!--DATOS FACTURA -->
            <div id="document">
                <p> ORDEN DE COMPRA: <strong id="numfact">N°.{{ $purchaseOrder->id }}</strong> <br>
                    FECHA DE EMISION: <strong id="datfact">{{ date('d-m-Y', strtotime($purchaseOrder->created_at)) }}</strong>
                </p>
            </div>
        </div>
    </header>
    <div class="clearfix"></div>
    <body>
        <div class="content">
            <!--DATOS CLIENTE -->
            <p id="title">DATOS DEL PROVEEDOR</p>
            <div class="center">
                <div id="third">
                    <!--DATOS CLIENTE -->
                    <div id="thirdHeader">
                        <span id="rowHeader">CC o NIT: </span><br>
                        <span id="rowHeader">NOMBRE:   </span><br>
                        <span id="rowHeader">DIRECCION:</span><br>
                        <span id="rowHeader">CIUDAD:   </span><br>
                        <span id="rowHeader">TELEFONO: </span><br>
                        <span id="rowHeader">EMAIL:    </span><br>
                    </div>
                    <div id="thirdData">
                        <span id="rowData">{{ $purchaseOrder->third->identification }}</span><br>
                        <span id="rowData">{{ $purchaseOrder->third->name }}</span><br>
                        <span id="rowData">{{ $purchaseOrder->third->address }}</span><br>
                        <span id="rowData">{{ $purchaseOrder->third->municipality->name }}</span><br>
                        <span id="rowData">{{ $purchaseOrder->third->phone }}</span><br>
                        <span id="rowData">{{ $purchaseOrder->third->email }}</span><br>
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
                    @foreach ($purchaseOrderProducts as $purchaseOrderProduct)
                    <tr>
                        <td>{{ $purchaseOrderProduct->product->name }}</td>
                        <td id="tdcenter">{{ number_format($purchaseOrderProduct->quantity) }}</td>
                        <td class="tdRight">${{ number_format($purchaseOrderProduct->price)}}</td>
                        <td class="tdRight">${{number_format($purchaseOrderProduct->quantity * $purchaseOrderProduct->price)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <!--DATOS FTOTALES -->
                    <tr>
                        <th colspan="3" class="footRight">TOTAL:</th>
                        <td colspan="3" class="footRight"><strong>${{number_format($purchaseOrder->total,2)}}</strong></td>
                    </tr>

                    <tr>
                        <th colspan="3" class="footRight">IMPUESTOS:</th>
                        <td colspan="3" class="footRight"><strong>${{number_format($purchaseOrder->total_tax,2)}}</strong> </td>
                    </tr>
                    <tr>
                        <th colspan="3" class="footRight">TOTAL PAGAR:</th>
                        <td colspan="3" class="footRight"><strong>${{number_format($purchaseOrder->total_pay,2)}}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <br>
        <br>
        <footer>
            Impreso por EmdisoftPro S.A.S. derechos reservados
        </footer>
    </body>

</html>



