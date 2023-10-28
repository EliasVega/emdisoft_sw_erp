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
        @if ($indicator->logo == 'on')
            <div class="center">
                <div id="logo">
                    <img src="{{ asset($company->logo) }}" alt="{{ $company->name }}">
                </div>
            </div>
        @endif
        <div class="clearfix"></div>
        <div class="center">
        <!--DATOS company -->
            <div class="company">
                <p><strong id="companyName">{{  $company->name  }}</strong></p>

                <p id="companyData">Nit: {{ $company->nit }} - {{ $company->dv }} - {{ $company->regime->name }} - {{ $company->nameO }}  {{ $expense->branch->address }} - {{ $company->municipality->name }} {{ $company->department->name }} <br> Email: {{ $expense->branch->email }}
                    </p>
            </div>
            <!--DATOS FACTURA -->
            <div id="document">
                <p> POST: <strong id="numfact">N°.{{ $expense->id }}</strong> <br>
                    FECHA DE EMISION: <strong id="datfact">{{ date('d-m-Y', strtotime($expense->created_at)) }}</strong>
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
                        <span id="rowData">{{ $expense->third->identification }}</span><br>
                        <span id="rowData">{{ $expense->third->name }}</span><br>
                        <span id="rowData">{{ $expense->third->address }}</span><br>
                        <span id="rowData">{{ $expense->third->municipality->name }}</span><br>
                        <span id="rowData">{{ $expense->third->phone }}</span><br>
                        <span id="rowData">{{ $expense->third->email }}</span><br>
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
                        <th style="width:70px"> SubTotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenseProducts as $expenseProduct)
                    <tr>
                        <td>{{ $expenseProduct->product->name }}</td>
                        <td id="tdcenter">{{ number_format($expenseProduct->quantity) }}</td>
                        <td class="tdRight">${{ number_format($expenseProduct->price)}}</td>
                        <td class="tdRight">${{number_format($expenseProduct->quantity * $expenseProduct->price)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <!--DATOS FTOTALES -->
                    <tr>
                        <th colspan="3" class="footRight">TOTAL:</th>
                        <td class="footRight"><strong>${{number_format($expense->total)}}</strong></td>
                    </tr>
                    @if ($expense->pay > 0)
                        <tr>
                            <th  colspan="3" class="footRight">ABONOS:</th>
                            <td  class="footRight"><strong>${{number_format($expense->pay)}}</strong></td>
                        </tr>
                    @endif
                    <tr>
                        <th  colspan="3" class="footRight">SALDO A PAGAR:</th>
                        <td class="footRight"><strong id="total">${{number_format($expense->total -  $expense->pay)}}</strong></td>
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



