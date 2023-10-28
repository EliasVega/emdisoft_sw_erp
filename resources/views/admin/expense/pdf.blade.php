<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ 'css/pdfs.css' }}">
        <title>Factura de Compra</title>

    </head>
    <header id="header">

        <div class="center">
            <!-- LOGGO -->
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
                <p> <h4>GASTO <br> <strong id="documentNumber">N°.{{ $expense->id }}</strong>  </h4>

                </p>
                <p> <h4>FECHA DE EMISION <br> <strong id="documentData">{{ date('d-m-Y', strtotime($expense->created_at)) }}</strong>  </h4>
                </p>
            </div>
        </div>
    </header>
    <body>
        <!--DATOS CLIENTE -->
        <div class="content">
            <div class="center">
                <div id="thirdTitle">
                    <span id="title"><strong>DATOS DEL PROVEEDOR</strong></span>
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
                        <span id="rowData">{{ $expense->third->identification }}</span><br>
                        <span id="rowData">{{ $expense->third->name }}</span><br>
                        <span id="rowData">{{ $expense->third->regime->name }}</span><br>
                        <span id="rowData">{{ $expense->third->municipality->name }}</span><br>
                        <span id="rowData">{{ $expense->third->phone }}</span><br>
                        <span id="rowData">{{ $expense->third->email }}</span><br>
                        <span id="rowData">{{ $expense->third->address }}</span><br>
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
                        <span id="rowData">{{ $expense->paymentForm->name }}</span><br>
                        <span id="rowData">{{ $expense->paymentMethod->name }}</span><br>
                        <span id="rowData">{{ $expense->due_date }}</span><br>
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
                            @foreach ($expenseProducts as $expenseProduct)
                            <tr>
                                <td>{{ $expenseProduct->product->name }}</td>
                                <td id="ccent">{{ number_format($expenseProduct->quantity) }}</td>
                                <td class="tdder">${{ number_format($expenseProduct->price)}}</td>
                                <td class="tdder">${{number_format($expenseProduct->quantity * $expenseProduct->price)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <!--DATOS FTOTALES -->
                            <tr>
                               <th colspan="3" class="footder">TOTAL:</th>
                               <td class="footder"><strong>${{number_format($expense->total,2)}}</strong></td>
                            </tr>
                            @if ($expense->pay > 0)
                                <tr>
                                    <th  colspan="3" class="footder">ABONOS</th>
                                    <td  class="footder"><strong>${{number_format($expense->pay,2)}}</strong></td>
                                </tr>
                            @endif
                            <tr>
                                <th  colspan="3" class="footder">SALDO A PAGAR:</th>
                                <td class="footder"><strong id="total">$ {{number_format($expense->total -  $expense->pay,2)}}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
        <br>
        <br>
        <footer>
            Impreso por Emdisoft S.A.S. derechos reservados
        </footer>
    </body>
</html>



