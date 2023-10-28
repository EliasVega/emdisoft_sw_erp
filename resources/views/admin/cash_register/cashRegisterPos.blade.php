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
            @if ($cashRegister->expense > 0)
                <div class="content_postbox">
                    <p>REPORTE DE GASTOS SERVICIOS</p>
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
                            @foreach ($expenseProducts as $expenseProduct)
                            <tr>
                                <td>{{ $expenseProduct->id }}</td>
                                <td>{{ $expenseProduct->name }}</td>
                                <td>{{ $expenseProduct->stock }}</td>
                                <td align="right">${{ number_format($expenseProduct->price) }}</td>
                                <td align="right">${{ number_format($expenseProduct->sale_price) }}</td>
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
                            @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->document }}</td>
                                <td>{{ $invoice->third->name }}</td>
                                <td align="right">$ {{ number_format($invoice->total_pay) }}</td>
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
                            @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->document }}</td>
                                <td>{{ $expense->third->name }}</td>
                                <td align="right">$ {{ number_format($expense->total_pay, 2) }}</td>
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
            @if ($cashRegister->purchase_order > 0)
                <div class="content_postbox">
                    <p>REPORTE DE ORDENES DE COMPRA</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.orden</th>
                                <th>Cliente</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchaseOrders as $purchaseOrder)
                            <tr>
                                <td>{{ $purchaseOrder->id }}</td>
                                <td>{{ $purchaseOrder->customer->name }}</td>
                                <td align="right">$ {{ number_format($purchaseOrder->total_pay, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($cashRegister->purchase_order)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->restaurant_order > 0)
                <div class="content_postbox">
                    <p>REPORTE DE COMANDAS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>N°.comanda</th>
                                <th>Cliente</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restaurantOrders as $restaurantOrder)
                            <tr>
                                <td>{{ $restaurantOrder->id }}</td>
                                <td>{{ $restaurantOrder->customer->name }}</td>
                                <td align="right">$ {{ number_format($restaurantOrder->total_pay, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($cashRegister->restaurant_order)}}</p></td>
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
                            @foreach ($ncinvoices as $ncinvoice)
                            <tr>
                                <td>{{ $ncinvoice->id }}</td>
                                <td>{{ $ncinvoice->invoice->third->name }}</td>
                                <td align="right">${{number_format($ncinvoice->total_pay)}}</td>
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
                            @foreach ($ndinvoices as $ndinvoice)
                            <tr>
                                <td>{{ $ndinvoice->id }}</td>
                                <td>{{ $ndinvoice->invoice->third->name }}</td>
                                <td align="right">${{number_format($ndinvoice->total_pay)}}</td>
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
                                <th>Proveedor</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ncinvoices as $ncinvoice)
                            <tr>
                                <td>{{ $ncinvoice->id }}</td>
                                <td>{{ $ncinvoice->invoice->third->name }}</td>
                                <td align="right">${{number_format($ncinvoice->total_pay)}}</td>
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
                                <th>Proveedor</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ndinvoices as $ndpurchase)
                            <tr>
                                <td>{{ $ndpurchase->id }}</td>
                                <td>{{ $ndpurchase->invoice->third->name }}</td>
                                <td align="right">${{number_format($ndpurchase->total_pay)}}</td>
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
            @if ($cashRegister->in_invoice > 0)
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
                            @foreach ($invoicePays as $invoicePay)
                            <tr>
                                <td>{{ $invoicePay->payable->document }}</td>
                                <td>{{ $invoicePay->payable->third->name }}</td>
                                <td align="right">${{number_format($invoicePay->pay)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($invoiceSumPays)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->out_purchase > 0)
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
                            @foreach ($purchasePays as $purchasePay)
                            <tr>
                                <td>{{ $purchasePay->payable->id }}</td>
                                <td>{{ $purchasePay->payable->third->name }}</td>
                                <td align="right">${{number_format($purchasePay->pay)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($purchaseSumPays)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->out_expense > 0)
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
                            @foreach ($expensePays as $expensePay)
                            <tr>
                                <td>{{ $expensePay->payable->id }}</td>
                                <td>{{ $expensePay->payable->third->name }}</td>
                                <td align="right">${{number_format($expensePay->pay)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{number_format($expenseSumPays)}}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->in_cash > 0)
                <div class="content_postbox">
                    <p>REPORTE DE ENTRADAS EFECTIVO</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha y hora</th>
                                <th>Autoriza</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashInflows as $cashInflow)
                            <tr>
                                <td>{{ $cashInflow->created_at }}</td>
                                <td>{{ $cashInflow->admin->name }}</td>
                                <td align="right">${{number_format($cashInflow->cash)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{ number_format($sumCashInflows,2) }}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->out_cash > 0)
                <div class="content_postbox">
                    <p>REPORTE DE SALIDAS EFECTIVO</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha y hora</th>
                                <th>Autoriza</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashOutflows as $cashOutflow)
                            <tr>
                                <td>{{ $cashOutflow->created_at }}</td>
                                <td>{{ $cashOutflow->admin->name }}</td>
                                <td align="right">${{number_format($cashOutflow->cash)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{ number_format($sumCashOutflows,2) }}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($sumAdvanceProviders > 0)
                <div class="content_postbox">
                    <p>ANTICIPOS DE PROVEEDORES</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha y hora</th>
                                <th>Proveedor</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($advanceProviders as $advanceProvider)
                            <tr>
                                <td>{{ $advanceProvider->created_at }}</td>
                                <td>{{ $advanceProvider->advanceable->name }}</td>
                                <td align="right">${{number_format($advanceProvider->pay)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{ number_format($sumAdvanceProviders,2) }}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($sumAdvanceCustomers > 0)
                <div class="content_postbox">
                    <p>ANTICIPOS A CLIENTES</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha y hora</th>
                                <th>cLIENTE</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($advanceCustomers as $advanceCustomer)
                            <tr>
                                <td>{{ $advanceCustomer->created_at }}</td>
                                <td>{{ $advanceCustomer->advanceable->name }}</td>
                                <td align="right">${{number_format($advanceCustomer->pay)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{ number_format($sumAdvanceCustomers,2) }}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($sumAdvanceEmployees > 0)
                <div class="content_postbox">
                    <p>ANTICIPOS A EMPLEADOS</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha y hora</th>
                                <th>Empleado</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($advanceEmployees as $advanceEmployee)
                            <tr>
                                <td>{{ $advanceEmployee->created_at }}</td>
                                <td>{{ $advanceEmployee->advanceable->name }}</td>
                                <td align="right">${{number_format($advanceEmployee->pay)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{ number_format($sumAdvanceEmployees,2) }}</p></td>
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
                                <td align="right"><h2>${{number_format($cashRegister->expense,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->invoice > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL VENTAS:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->invoice,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->purchase_order > 0)
                            <tr>
                                <th colspan="4"><p align="left" >TOTAL ORDEN COMPRAS:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->purchase_order,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->restaurant_order > 0)
                            <tr>
                                <th colspan="4"><p align="left" >TOTAL COMANDAS:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->restaurant_order,2)}}</h2></td>
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



