<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ 'css/post.css' }}">
        <title>COMANDA</title>

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
                <p id="companyData">Nit: {{ $company->nit }} - {{ $company->dv }}  {{ $restaurantOrder->user->branch->address }} - {{ $company->municipality->name }} {{ $company->department->name }} <br> Email: {{ $restaurantOrder->user->branch->email }}
                </p>
            </div>
            <!--DATOS FACTURA -->
            <div id="document">
                <p> COMANDA: <strong id="numfact">N°.{{ $restaurantOrder->id }}</strong> <br>
                    FECHA DE EMISION: <strong id="datfact">{{ date('d-m-Y', strtotime($restaurantOrder->created_at)) }}</strong>
                </p>
            </div>
        </div>
    </header>
    <div class="clearfix"></div>
    <body>
        <div class="content">
            <table class="table">
                <!--DETALLE DE VENTA -->
                <thead>
                    <tr>
                        <th>Est</th>
                        <th>Ref</th>
                        <th>Descripcion</th>
                        <th>Cant.</th>
                        <th>Valor</th>
                        <th>SubTotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productRestaurantOrders as $productRestaurantOrder)
                        <tr>
                            <td>{{ $productRestaurantOrder->status }}</td>
                            <td>{{ $productRestaurantOrder->referency }}</td>
                            <td>{{ $productRestaurantOrder->product->name }}</td>
                            <td id="tdcenter">{{ number_format($productRestaurantOrder->quantity,2) }}</td>
                            <td class="tdRight">${{ number_format($productRestaurantOrder->price,2)}}</td>
                            <td class="tdRight">${{number_format($productRestaurantOrder->quantity * $productRestaurantOrder->price,2)}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <!--DATOS FTOTALES -->
                    <tr>
                        <th colspan="3" class="footRight">TOTAL:</th>
                        <td colspan="3" class="footRight"><strong>${{number_format($restaurantOrder->total,2)}}</strong></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="footRight">IMPUESTOS:</th>
                        <td colspan="3" class="footRight"><strong>${{number_format($restaurantOrder->total_tax,2)}}</strong> </td>
                    </tr>
                    <tr>
                        <th colspan="3" class="footRight">TOTAL PAGAR:</th>
                        <td colspan="3" class="footRight"><strong>${{number_format($restaurantOrder->total_pay,2)}}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @if ($commandRawmaterials != null)
            <div id="document">
                <p> OBSERVACIONES:</p>
            </div>
            <div class="content">
                <table class="table">
                    <!--DETALLE DE VENTA -->
                    <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Est</th>
                            <th>Producto</th>
                            <th>Cant.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commandRawmaterials as $commandRawmaterial)
                            <tr>
                                <td>{{ $commandRawmaterial->referency }}</td>
                                @if ($commandRawmaterial->status == 'add')
                                    <td>{{ 'adicionar' }}</td>
                                @elseif ($commandRawmaterial->status == 'decrease')
                                    <td>{{ 'disminuir' }}</td>
                                @elseif ($commandRawmaterial->status == 'cancel')
                                    <td>{{ 'quitar' }}</td>
                                @elseif ($commandRawmaterial->status == 'anulled')
                                    <td>{{ 'anulado' }}</td>
                                @endif

                                <td>{{ $commandRawmaterial->rawMaterial->name }}</td>
                                <td id="tdcenter">{{ number_format($commandRawmaterial->quantity) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        @endif
        @if ($restaurantOrder->restaurant_table_id == 1)

            <div id="document">
                <p> PARA ENVIO A DOMICILIO A:</p>
            </div>

            <div id="document">
                <p> NOMBRE: <strong class="numfact">{{ $restaurantOrder->homeOrder->name }}</strong></p>
            </div>
            <div id="document">
                <p> DIRECCION: <strong class="numfact">{{ $restaurantOrder->homeOrder->address }}</strong></p>
            </div>
            <div id="document">
                <p> TELEFONO: <strong class="numfact">{{ $restaurantOrder->homeOrder->phone }}</strong></p>
            </div>
        @endif
    <br>
    <br>
    <footer>
        Impreso por Emdisoft S.A.S. derechos reservados
    </footer>
    </body>

</html>



