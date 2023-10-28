<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ 'css/pdfs.css' }}">
        <title>Nota debito</title>

    </head>
    <header id="header">
        <!-- LOGGO -->
        <div class="center">
            <@if ($indicator->logo == 'on')
                <div id="logo">
                    <img src="{{ asset($company->logo) }}" alt="{{ $company->name }}" width="150px" height="50px" class="app-logo">
                </div>
            @endif
        <!--DATOS company -->
            <div class="company">
                <p><strong id="companyName">{{  $company->name  }}</strong></p>

                <p id="companyData">Nit: {{ $company->nit }} -- {{ $company->dv }} --  {{ $company->liability->name }} -- <br> R. fiscal. {{ $company->regime->name }}  <br> {{ $company->organization->name }}  {{ $company->address }} <br> {{ $company->municipality->name }} -- {{ $company->department->name }} <br> Email: {{ $company->email }}
                    </p>
            </div>
            <!--DATOS FACTURA -->
            <div id="document">
                <p> <h4>NOTA DEBITO  <br> <strong id="documentNumber">N°.{{ $ndinvoice->id }}</strong>  </h4>

                </p>
                <p> <h4>FECHA DE EMISION <br> <strong id="documentData">{{ date('d-m-Y', strtotime($ndinvoice->created_at)) }}</strong>  </h4>
                </p>
            </div>
        </div>
    </header>
    <body>
        <!--DATOS CLIENTE -->
        <div class="content">
            <div class="center">
                <div id="thirdTitle">
                    <span id="title"><strong>DATOS DEL CLIENTE</strong></span>
                </div>
            </div>
            <div class="center">
                <!--CODIGO QR -->
                <div id="qr">
                    <img src="" alt="qr">
                </div>
                <div id="third">
                    <!--DATOS CLIENTE -->
                    <div id="thirdHeader">
                        <span id="rowHeader">CC o NIT: </span><br>
                        <span id="rowHeader">NOMBRE:   </span><br>
                        <span id="rowHeader">REGIMEN:  </span><br>
                        <span id="rowHeader">CIUDAD:   </span><br>
                        <span id="rowHeader">TELEFONO: </span><br>
                        <span id="rowHeader">EMAIL:    </span><br>
                        <span id="rowHeader">DIRECCION:</span><br>
                    </div>
                    <div id="thirdData">
                        <span id="rowData">{{ $ndinvoice->third->identification }}</span><br>
                        <span id="rowData">{{ $ndinvoice->third->name }}</span><br>
                        <span id="rowData">{{ $ndinvoice->third->regime->name }}</span><br>
                        <span id="rowData">{{ $ndinvoice->third->municipality->name }}</span><br>
                        <span id="rowData">{{ $ndinvoice->third->phone }}</span><br>
                        <span id="rowData">{{ $ndinvoice->third->email }}</span><br>
                        <span id="rowData">{{ $ndinvoice->third->address }}</span><br>
                    </div>
                </div>
            </div>

        </div>
        <div class="contentDetail">
            <div class="center">
                <div id="ttable">
                    <table class="table">
                        <!--DETALLE DE VENTA -->
                        <thead>
                            <tr>
                                <th id="description">Descripcion del producto</th>
                                <th id="quantity">Cant.</th>
                                <th>Valor</th>
                                <th>SubTotal ($)</th>
                            </tr>
                        </thead>
                        <tbody class="detail">
                            @foreach ($ndinvoiceProducts as $ndinvoiceProduct)
                            <tr>
                                <td>{{ $ndinvoiceProduct->product->name }}</td>
                                <td id="ccent">{{ number_format($ndinvoiceProduct->quantity) }}</td>
                                <td class="tdder">${{ number_format($ndinvoiceProduct->price)}}</td>
                                <td class="tdder">${{number_format($ndinvoiceProduct->quantity * $ndinvoiceProduct->price)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <!--DATOS FTOTALES -->
                            <tr>
                               <th colspan="3" class="footder">TOTAL:</th>
                               <td class="footder"><strong>${{number_format($ndinvoice->total,2)}}</strong></td>
                            </tr>

                            <tr>
                                <th colspan="3" class="footder">IMPUESTOS:</th>
                                <td class="footder"><strong>${{number_format($ndinvoice->total_tax,2)}}</strong> </td>
                            </tr>

                            <tr>
                                <th  colspan="3" class="footder">TOTAL PAGAR:</th>
                                <td class="footder"><strong id="total">${{number_format($ndinvoice->total_pay,2)}}</strong></td>
                            </tr>
                            @if ($retentionsum > 0)
                                @foreach ($retentions as $retention)
                                    <tr>
                                        <th colspan="3" class="footder">{{ $retention->name }}:</th>
                                        <td class="footder"><strong>$ -{{number_format($retention->tax_value,2)}}</strong> </td>
                                    </tr>
                                @endforeach
                            @endif
                            <tr>
                                <th  colspan="3" class="footder">SALDO PAGAR:</th>
                                <td class="footder"><strong id="total">${{number_format($ndinvoice->total_pay - $retentionsum,2)}} </strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
        <br>
        <br>
        <footer>
            Impreso por EmdisoftPro S.A.S. derechos reservados
        </footer>
    </body>
</html>



