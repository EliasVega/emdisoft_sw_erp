<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/post_box.css') }}">
        <title>Reporte de Caja</title>
    </head>
    <body>
        <header>
            <div class="center">
                <div id="logo">
                    <img src="{{ asset($company->logo) }}" alt="{{ $company->name }}">
                </div>
            </div>

            <div class="clearfix"></div>
        </header>
        <section>
            <div class="content_postbox">
                <div class="user_postbox">
                    <p>
                        Nombre: {{ $cashRegister->user->name }}:</p>
                </div>
            </div>
            @if ($cashRegister->purchase > 0)
                <div class="content_postbox">
                    <p>REPORTE DE ARTICULOS COMPRAS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Articulo</th>
                                <th>Cant</th>
                                <th>Impuesto</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($productPurchases as $produtPurchase)
                            <tr>
                                <td>{{ $produtPurchase->id }}</td>
                                <td>{{ $produtPurchase->name }}</td>
                                <td>{{ number_format($produtPurchase->quantity) }}</td>
                                <td align="right">${{ number_format($produtPurchase->tax_subtotal) }}</td>
                                <td align="right">${{ number_format($produtPurchase->subtotal + $produtPurchase->tax_subtotal) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($cashRegister->purchase)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->invoice > 0)
                <div class="content_postbox">
                    <p>REPORTE DE ARTICULOS VENTAS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Articulo</th>
                                <th>Cant</th>
                                <th>Precio</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoiceProducts as $invoiceProduct)
                            <tr>
                                <td>{{ $invoiceProduct->id }}</td>
                                <td>{{ $invoiceProduct->name }}</td>
                                <td>{{ $invoiceProduct->stock }}</td>
                                <td align="right">${{ number_format($invoiceProduct->price) }}</td>
                                <td align="right">${{ number_format($invoiceProduct->sale_price) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>

                            <tr>
                                <th colspan="4" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($cashRegister->invoice)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->purchase > 0)
                <div class="content_postbox">
                    <p>REPORTE DE COMPRAS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.Compra</th>
                                <th>Proveedor</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->document }}</td>
                                <td>{{ $purchase->third->name }}</td>
                                <td align="right">$ {{ number_format($purchase->total_pay) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($cashRegister->purchase)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->invoice > 0)
                <div class="content_postbox">
                    <p>REPORTE DE FACTURAS DE VENTA</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.Venta</th>
                                <th>Cliente</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $inv)
                            <tr>
                                <td>{{ $inv->document }}</td>
                                <td>{{ $inv->customer->name }}</td>
                                <td align="right">$ {{ number_format($inv->total_pay) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($cashRegister->invoice)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif

            @if ($cashRegister->expense > 0)
                <div class="content_postbox">
                    <p>REPORTE DE GASTOS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.Gasto</th>
                                <th>Proveedor</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $exp)
                            <tr>
                                <td>{{ $exp->document }}</td>
                                <td>{{ $exp->provider->name }}</td>
                                <td align="right">$ {{ number_format($exp->total_pay, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($cashRegister->expense)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->order > 0)
                <div class="content_postbox">
                    <p>REPORTE DE PEDIDOS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.pedido</th>
                                <th>Cliente</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $ord)
                            <tr>
                                <td>{{ $ord->id }}</td>
                                <td>{{ $ord->customer->name }}</td>
                                <td align="right">$ {{ number_format($ord->total_pay, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($cashRegister->order)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->ncinvoice > 0)
                <div class="content_postbox">
                    <p>REPORTE DE NOTAS CREDITO VENTAS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.NC</th>
                                <th>Cliente</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ncinvoices as $nc)
                            <tr>
                                <td>{{ $nc->id }}</td>
                                <td>{{ $nc->invoice->customer->name }}</td>
                                <td align="right">$ {{ $nc->total_pay }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($cashRegister->ncinvoice)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->ndinvoice > 0)
                <div class="content_postbox">
                    <p>REPORTE DE NOTAS DEBITO VENTAS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.ND</th>
                                <th>Cliente</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ndinvoices as $nd)
                            <tr>
                                <td>{{ $nd->id }}</td>
                                <td>{{ $nd->invoice->customer->name }}</td>
                                <td align="right">$ {{ $nd->total_pay }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($cashRegister->ndinvoice)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->ncpurchase > 0)
                <div class="content_postbox">
                    <p>REPORTE DE NOTAS CREDITO COMPRAS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.NC</th>
                                <th>Cliente</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ncinvoices as $nc)
                            <tr>
                                <td>{{ $nc->id }}</td>
                                <td>{{ $nc->invoice->customer->name }}</td>
                                <td align="right">$ {{ $nc->total_pay }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($cashRegister->ncpurchase)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->ndpurchase > 0)
                <div class="content_postbox">
                    <p>REPORTE DE NOTAS DEBITO COMPRAS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.ND</th>
                                <th>Cliente</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ndinvoices as $nd)
                            <tr>
                                <td>{{ $nd->id }}</td>
                                <td>{{ $nd->invoice->customer->name }}</td>
                                <td align="right">$ {{ $nd->total_pay }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($cashRegister->ndpurchase)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->sum_pay_orders > 0)
                <div class="content_postbox">
                    <p>REPORTE DE ABONOS A PEDIDOS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.order</th>
                                <th>Cliente</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pay_orders as $po)
                            <tr>
                                <td>{{ $po->order_id }}</td>
                                <td>{{ $po->order->customer->name }}</td>
                                <td align="right">$ {{ $po->pay }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($sum_pay->orders)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->sum_pay_invoices > 0)
                <div class="content_postbox">
                    <p>REPORTE DE ABONOS A FACTURAS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.Factura</th>
                                <th>Cliente</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pay_invoices as $pi)
                            <tr>
                                <td>{{ $pi->invoice->document }}</td>
                                <td>{{ $pi->invoice->customer->name }}</td>
                                <td align="right">$ {{ $pi->pay }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($sum_pay->invoices)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->sum_pay_purchases > 0)
                <div class="content_postbox">
                    <p>REPORTE DE PAGOS A COMPRAS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.Compra</th>
                                <th>Proveedor</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pay_purchases as $pay_purchase)
                            <tr>
                                <td>{{ $pay_purchase->purchase->id }}</td>
                                <td>{{ $pay_purchase->purchase->provider->name }}</td>
                                <td align="right">$ {{ $pay_purchase->pay }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($sum_pay->purchases)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->sum_pay_expenses > 0)
                <div class="content_postbox">
                    <p>REPORTE DE PAGOS Y GASTOS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.Gasto</th>
                                <th>Proveedor</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pay_expenses as $pe)
                            <tr>
                                <td>{{ $pe->expense->id }}</td>
                                <td>{{ $pe->expense->provider->name }}</td>
                                <td align="right">$ {{ $pe->pay }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($sum_pay->expenses)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->sum_cash_ins > 0)
                <div class="content_postbox">
                    <p>REPORTE DE ENTRADAS EFECTIVO</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Autoriza</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashIns as $cas)
                            <tr>
                                <td>{{ $cas->name }}</td>
                                <td>$ {{ $cas->payment }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($sum_cash_ins)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->sum_cash_outs > 0)
                <div class="content_postbox">
                    <p>REPORTE DE SALIDAS EFECTIVO</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Autoriza</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashOuts as $cas)
                            <tr>
                                <td>{{ $cas->name }}</td>
                                <td>$ {{ $cas->payment }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($sum_cash_outs)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            <div class="content_postbox">
                <p>REPORTE DE TOTALES</p>
                <table>
                    <tbody>
                        @if ($cashRegister->purchase > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL COMPRAS:</p></th>
                                <td align="right"><p  ><h2>${{number_format($cashRegister->purchase,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->expense > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL GASTOS:</p></th>
                                <td align="right"><h2>${{number_format($sum_pay_expenses,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->invoice > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL VENTAS:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->invoice,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->order > 0)
                            <tr>
                                <th colspan="4"><p align="left" >TOTAL PEDIDOS:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->order,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->ncinvoice > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL NOTA CREDITO VENTAS:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->ncinvoice,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->ndinvoice > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL NOTA DEBITO VENTAS:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->ndinvoice,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->ncpurchase > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL NOTA CREDITO COMPRAS:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->ncpurchase,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->ndpurchase > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL NOTA DEBITO COMPRAS:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->ndpurchase,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->out_purchase > 0)
                        <tr>
                            <th colspan="4" ><p align="left" >EGRESOS COMPRAS:</p></th>
                            <td align="right"><h2>${{number_format($cashRegister->out_purchase,2)}}</h2></td>
                        </tr>
                        @endif
                        @if ($cashRegister->out_expense > 0)
                        <tr>
                            <th colspan="4" ><p align="left" >EGRESOS GASTOS:</p></th>
                            <td align="right"><h2>${{number_format($cashRegister->out_expense,2)}}</h2></td>
                        </tr>
                        @endif
                        @if ($cashRegister->in_invoice > 0)
                        <tr>
                            <th colspan="4" ><p align="left" >INGRESOS VENTAS:</p></th>
                            <td align="right"><h2>${{number_format($cashRegister->in_invoice,2)}}</h2></td>
                        </tr>
                        @endif
                        @if ($cashRegister->in_order > 0)
                        <tr>
                            <th colspan="4" ><p align="left" >INGRESOS PEDIDOS:</p></th>
                            <td align="right"><h2>${{number_format($cashRegister->in_order,2)}}</h2></td>
                        </tr>
                        @endif
                        @if ($cashRegister->out_total > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL EGRESOS:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->out_total,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->in_total > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL INGRESOS:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->in_total,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->cash_initial > 0)
                        <tr>
                            <th colspan="4" ><p align="left" >EFECTIVO INICIAL:</p></th>
                            <td align="right"><h2>${{number_format($cashRegister->cash_initial,2)}}</h2></td>
                        </tr>
                        @endif
                        @if ($cashRegister->out_purchase_cash > 0)
                        <tr>
                            <th colspan="4" ><p align="left" >EFECTIVO COMPRAS:</p></th>
                            <td align="right"><h2>${{number_format($cashRegister->out_purchase_cash,2)}}</h2></td>
                        </tr>
                        @endif
                        @if ($cashRegister->out_expense_cash > 0)
                        <tr>
                            <th colspan="4" ><p align="left" >EFECTIVO GASTOS:</p></th>
                            <td align="right"><h2>${{number_format($cashRegister->out_expense_cash,2)}}</h2></td>
                        </tr>
                        @endif
                        @if ($cashRegister->in_invoice_cash > 0)
                        <tr>
                            <th colspan="4" ><p align="left" >EFECTIVO VENTAS:</p></th>
                            <td align="right"><h2>${{number_format($cashRegister->in_invoice_cash,2)}}</h2></td>
                        </tr>
                        @endif
                        @if ($cashRegister->in_order_cash > 0)
                        <tr>
                            <th colspan="4" ><p align="left" >EFECTIVO PEDIDOS:</p></th>
                            <td align="right"><h2>${{number_format($cashRegister->in_order_cash,2)}}</h2></td>
                        </tr>
                        @endif

                        @if ($cashRegister->cash_in_total > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL EFECTIVO:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->cash_in_total,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->cash_out_total > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >SALIDA EFECTIVO:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->cash_out_total,2)}}</h2></td>
                            </tr>
                        @endif
                        <tr>
                            <th colspan="4" ><p align="left" >SALDO EN CAJA:</p></th>
                            <td align="right"><h2>${{number_format($cashRegister->cash_in_total - $cashRegister->cash_out_total ,2)}}</h2></td>
                        </tr>
                    </tbody>
                    <tfoot>


                    </tfoot>
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
            Reporte cierre de Caja
        </footer>
    </body>
</html>



