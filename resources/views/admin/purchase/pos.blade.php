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

                <p id="companyData">Nit: {{ $company->nit }} - {{ $company->dv }} - {{ $company->regime->name }} - {{ $company->nameO }}  {{ $purchase->branch->address }} - {{ $company->municipality->name }} {{ $company->department->name }} <br> Email: {{ $purchase->branch->email }}
                    </p>
            </div>
            <!--DATOS FACTURA -->
            <div id="document">
                <p> POST: <strong id="numfact">N°.{{ $purchase->id }}</strong> <br>
                    FECHA DE EMISION: <strong id="datfact">{{ date('d-m-Y', strtotime($purchase->created_at)) }}</strong>
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
                        <span id="rowData">{{ $purchase->third->identification }}</span><br>
                        <span id="rowData">{{ $purchase->third->name }}</span><br>
                        <span id="rowData">{{ $purchase->third->address }}</span><br>
                        <span id="rowData">{{ $purchase->third->municipality->name }}</span><br>
                        <span id="rowData">{{ $purchase->third->phone }}</span><br>
                        <span id="rowData">{{ $purchase->third->email }}</span><br>
                    </div>
                </div>
            </div>
            @if ($debitNote != null)
            <div class="center">
                <div id="thirdTitle">
                    <span id="title">Compra modificada con la Nota debito {{ $debitNote->document }}</span>
                </div>
            </div>
        @endif
        @if ($creditNote != null)
            <div class="center">
                <div id="thirdTitle">
                    <span id="title">Compra modificada con la Nota credito {{ $creditNote->document }}</span>
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
                        <th>SubTotal</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($purchase->type_product == 'product')
                        @foreach ($productPurchases as $productPurchase)
                            <tr>
                                <td>{{ $productPurchase->product->name }}</td>
                                <td id="tdcenter">{{ number_format($productPurchase->quantity) }}</td>
                                <td class="tdRight">${{ number_format($productPurchase->price)}}</td>
                                <td class="tdRight">${{number_format($productPurchase->quantity * $productPurchase->price)}}</td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($productPurchases as $productPurchase)
                            <tr>
                                <td>{{ $productPurchase->rawMaterial->name }}</td>
                                <td id="tdcenter">{{ number_format($productPurchase->quantity) }}</td>
                                <td class="tdRight">${{ number_format($productPurchase->price)}}</td>
                                <td class="tdRight">${{number_format($productPurchase->quantity * $productPurchase->price)}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <!--DATOS FTOTALES -->
                    <tr>
                        <th colspan="3" class="footRight">TOTAL</th>
                        <td class="footRight"><strong>${{number_format($purchase->total)}}</strong></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="footRight">IMPUESTOS</th>
                        <td class="footRight"><strong>${{number_format($purchase->total_tax)}}</strong> </td>
                    </tr>
                    <tr>
                        <th colspan="3" class="footRight">TOTAL PAGAR</th>
                        <td class="footRight"><strong>${{number_format($purchase->total_pay)}}</strong></td>
                    </tr>
                    @if ($retentionsum > 0)
                        @foreach ($retentions as $retention)
                            <tr>
                                <th colspan="3" class="footRight">{{ $retention->name }}-</th>
                                <td class="footRight"><strong>${{number_format($retention->tax_value)}}</strong> </td>
                            </tr>
                        @endforeach
                    @endif
                    @if ($purchase->pay > 0)
                        <tr>
                            <th  colspan="3" class="footRight">ABONOS -</th>
                            <td class="footRight"><strong>${{number_format($purchase->pay)}}</strong></td>
                        </tr>
                    @endif
                    @if ($debitNote > 0)
                        <tr>
                            <th  colspan="3" class="footRight">NOTA DEBITO -</th>
                            <td class="footRight"><strong id="total">${{number_format($debitNote)}}</strong></td>
                        </tr>
                    @endif
                    @if ($retentionnd > 0)
                         <tr>
                             <th  colspan="3" class="footRight">RET ND -</th>
                             <td class="footRight"><strong id="total">${{number_format($retentionnd,2)}}</strong></td>
                         </tr>
                     @endif
                    @if ($creditNote > 0)
                        <tr>
                            <th  colspan="3" class="footRight">NOTA CREDITO</th>
                            <td class="footRight"><strong id="total">${{number_format($creditNote)}}</strong></td>
                        </tr>
                    @endif
                    @if ($retentionnc > 0)
                         <tr>
                             <th  colspan="3" class="footRight">RET NC -</th>
                             <td class="footRight"><strong id="total">${{number_format($retentionnc)}}</strong></td>
                         </tr>
                     @endif
                    <tr>
                        <th colspan="3" class="footRight">SALDO A PAGAR</th>
                        <td class="footRight"><strong>$ {{number_format($purchase->total_pay -  $purchase->pay - $debitNote - $retentionsum + $creditNote + $retentionnd - $retentionnc,2)}}</strong></td>
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



