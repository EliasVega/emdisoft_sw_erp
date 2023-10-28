<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/pdfs.css') }}">
        <title>Factura de Venta</title>

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
                <p><strong id="companyName">{{  $company->name  }}</strong></p>

                <p id="companyData">Nit: {{ $company->nit }} -- {{ $company->dv }} --  {{ $company->liability->name }} -- <br> R. fiscal. {{ $company->regime->name }}  <br> {{ $company->organization->name }}  {{ $company->address }} <br> {{ $company->municipality->name }} -- {{ $company->department->name }} <br> Email: {{ $company->email }}
                    </p>
            </div>
            <!--DATOS FACTURA -->
            <div id="document">
                <p> <h4>VENTA <br> <strong id="documentNumber">N°.{{ $invoice->id }}</strong>  </h4>
                </p>
                <p> <h4>FECHA DE EMISION <br> <strong id="documentData">{{ date('d-m-Y', strtotime($invoice->generation_date)) }}</strong>  </h4>
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
                        <span id="rowHeader">EMAIL:    </span><br>
                        <span id="rowHeader">REGIMEN:  </span><br>
                        <span id="rowHeader">CIUDAD:   </span><br>
                        <span id="rowHeader">TELEFONO: </span><br>

                        <span id="rowHeader">DIRECCION:</span><br>
                    </div>
                    <div id="thirdData">
                        <span id="rowData">{{ $invoice->third->identification }}</span><br>
                        <span id="rowData">{{ $invoice->third->name }}</span><br>
                        <span id="rowData">{{ $invoice->third->email }}</span><br>
                        <span id="rowData">{{ $invoice->third->regime->name }}</span><br>
                        <span id="rowData">{{ $invoice->third->municipality->name }}</span><br>
                        <span id="rowData">{{ $invoice->third->phone }}</span><br>
                        <span id="rowData">{{ $invoice->third->address }}</span><br>
                    </div>
                </div>
                <div id="formPay">
                    <!--FORMA DE PAGO-->
                    <div id="formPayHeader">
                        <span id="rowHeader">F. pago: </span><br>
                        <span id="rowHeader">M. pago:   </span><br>
                        <span id="rowHeader">Vence:</span><br>
                    </div>
                    <div id="formPayData">
                        <span id="rowData">{{ $invoice->paymentForm->name }}</span><br>
                        <span id="rowData">{{ $invoice->paymentMethod->name }}</span><br>
                        <span id="rowData">{{ $invoice->due_date }}</span><br>
                    </div>
                </div>
            </div>
        </div>
        @if ($debitNotes != null)
            <div class="center">
                <div id="thirdTitle">
                    <span id="title">Esta VENTA fue modificada con la Nota debito {{ $debitNotes->document }}</span>
                </div>
            </div>
        @endif
        @if ($creditNotes != null)
            <div class="center">
                <div id="thirdTitle">
                    <span id="title">Esta VENTA fue modificada con la Nota credito {{ $creditNotes->document }}</span>
                </div>
            </div>
        @endif
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
                            @foreach ($invoiceProducts as $invoiceProduct)
                            <tr>
                                <td>{{ $invoiceProduct->product->name }}</td>
                                <td id="ccent">{{ number_format($invoiceProduct->quantity) }}</td>
                                <td class="tdder">${{ number_format($invoiceProduct->price)}}</td>
                                <td class="tdder">${{number_format($invoiceProduct->quantity * $invoiceProduct->price)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <!--DATOS FTOTALES -->
                            <tr>
                               <th colspan="3" class="footder">TOTAL:</th>
                               <td class="footder"><strong>${{number_format($invoice->total,2)}}</strong></td>
                            </tr>

                            <tr>
                                <th colspan="3" class="footder">TOTAL IVA:</th>
                                <td class="footder"><strong>${{number_format($invoice->total_tax,2)}}</strong> </td>
                            </tr>

                            <tr>
                                <th  colspan="3" class="footder">TOTAL PAGAR:</th>
                                <td class="footder"><strong id="total">${{number_format($invoice->total_pay,2)}}</strong></td>
                            </tr>
                            @if ($retentionsum > 0)
                                @foreach ($retentions as $retention)
                                    <tr>
                                        <th colspan="3" class="footder">{{ $retention->name }}:</th>
                                        <td class="footder"><strong>-${{number_format($retention->tax_value,2)}}</strong> </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if ($invoice->pay > 0)
                                <tr>
                                    <th  colspan="3" class="footder">ABONOS</th>
                                    <td  class="footder"><strong>-${{number_format($invoice->pay,2)}}</strong></td>
                                </tr>
                            @endif
                            @if ($debitNote > 0)
                                <tr>
                                    <th  colspan="3" class="footder">NOTA DEBITO:</th>
                                    <td class="footder"><strong id="total">${{number_format($debitNote,2)}}</strong></td>
                                </tr>
                            @endif
                            @if ($retentionnd > 0)
                                <tr>
                                    <th  colspan="3" class="footder">RET ND:</th>
                                    <td class="footder"><strong id="total">-${{number_format($retentionnd,2)}}</strong></td>
                                </tr>
                            @endif
                            @if ($creditNote > 0)
                                <tr>
                                    <th  colspan="3" class="footder">NOTA CREDITO:</th>
                                    <td class="footder"><strong id="total">-${{number_format($creditNote,2)}}</strong></td>
                                </tr>
                            @endif
                            @if ($retentionnc > 0)
                                <tr>
                                    <th  colspan="3" class="footder">RET NC:</th>
                                    <td class="footder"><strong id="total">${{number_format($retentionnc,2)}}</strong></td>
                                </tr>
                            @endif
                            <tr>
                                <th  colspan="3" class="footder">SALDO A PAGAR:</th>
                                <td class="footder"><strong id="total">$ {{number_format($invoice->total_pay -  $invoice->pay - $creditNote - $retentionsum + $debitNote + $retentionnc - $retentionnd,2)}}</strong></td>
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



