@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Emdisoft_pro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label class="form-control-label"> CIERRE DE CAJA N°. <strong>{{ $cashRegister->id }}</strong> </label>
            @can('cashRegister.index')
                <a href="{{ route('cashRegister.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
            @endcan
            @can('branch.index')
                <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
            @endcan

        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">Responsable</label>
                <p>{{ $cashRegister->user->name }}</p>
            </div>
        </div>
        @if ($cashRegister->cash_initial > 0)
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="cash_open">Efectivo Inicial</label>
                    <p>${{ number_format($cashRegister->cash_initial,2) }}</p>
                </div>
            </div>
        @endif

        @if ($cashRegister->status == 'close')
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="open">Abierta</label>
                    <p>{{ $cashRegister->created_at }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="close">Cerrada</label>
                    <p>{{ $cashRegister->updated_at }}</p>
                </div>
            </div>
        @else
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="open">Abierta</label>
                    <p>{{ $cashRegister->created_at }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->purchase > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="abono">Total Compras</label>
                    <p>${{ number_format($cashRegister->purchase,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->out_purchase > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="abono">Egresos Compras</label>
                    <p>${{ number_format($cashRegister->out_purchase,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->out_purchase_cash > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="in_purchase_cash">Compras En Efectivo</label>
                    <p>${{ number_format($cashRegister->out_purchase_cash,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->expense > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="abono">Total Gastos</label>
                    <p>${{ number_format($cashRegister->expense,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->out_expense > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="abono">Egresos Gastos</label>
                    <p>${{ number_format($cashRegister->out_expense,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->out_expense_cash > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="in_purchase_cash">Gastos En Efectivo</label>
                    <p>${{ number_format($cashRegister->out_expense_cash,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->ndpurchase > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="in_purchase_cash">ND Compras</label>
                    <p>${{ number_format($cashRegister->ndpurchase,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->out_advance_cash > 0)
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="abono">ANT. PROVEEDORES EFECTIVO</label>
                    <p>${{ number_format($cashRegister->out_advance_cash,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->out_advance > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="abono">ANTICIPO PROVEEDORES</label>
                    <p>${{ number_format($cashRegister->out_advance,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->in_advance_cash > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="abono">ANT. CLIENTES EFECTIVO</label>
                    <p>${{ number_format($cashRegister->in_advance_cash,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->in_advance > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="abono">ANTICIPOS CLIENTES</label>
                    <p>${{ number_format($cashRegister->in_advance,2) }}</p>
                </div>
            </div>
        @endif

        @if ($cashRegister->cash_in_total > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="cash_in_total">INGRESOS EFECTIVO</label>
                    <p>${{ number_format($cashRegister->cash_in_total,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->cash_out_total > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="cash_out">SALIDA EFECTIVO</label>
                    <p>${{ number_format($cashRegister->cash_out_total,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->cash_in_total - $cashRegister->cash_out_total != 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="balance">EFECTIVO EN CAJA</label>
                    <p>${{ number_format($cashRegister->cash_in_total - $cashRegister->cash_out_total,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->in_total > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="pay">TOTAL INGRESOS</label>
                    <p>${{ number_format($cashRegister->in_total,2) }}</p>
                </div>
            </div>
        @endif
    </div>
    <div class="box-body row">
        @if ($cashRegister->purchase > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Articulos Comprados</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div>
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>id</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Imp</th>
                                <th>subtotal</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="3"><p align="right">TOTALES:</p></th>
                                <th><p align="right">${{ number_format($purchaseTotalTaxs,2) }}</p></th>
                                <th><p align="right">${{ number_format($purchaseTotals,2) }}</p></th>
                                <th><p align="right">${{ number_format($purchaseTotalTaxs + $purchaseTotals,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($productPurchases as $produtPurchase)
                                <tr>
                                    <td>{{ $produtPurchase->id }}</td>
                                    <td>{{ $produtPurchase->name }}</td>
                                    <td class="rightfoot">{{ $produtPurchase->quantity }}</td>
                                    <td class="rightfoot">$ {{ number_format($produtPurchase->tax_subtotal,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($produtPurchase->subtotal,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($produtPurchase->subtotal + $produtPurchase->tax_subtotal,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->expense > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Gastos adquiridos</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div>
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>id</th>
                                <th>Gasto</th>
                                <th>Cantidad</th>
                                <th>Imp</th>
                                <th>subtotal</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="3"><p align="right">TOTALES:</p></th>
                                <th><p align="right">${{ number_format($expenseTotalTaxs,2) }}</p></th>
                                <th><p align="right">${{ number_format($expenseTotals,2) }}</p></th>
                                <th><p align="right">${{ number_format($expenseTotalTaxs + $expenseTotals,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($expenseProducts as $expenseProduct)
                                <tr>
                                    <td>{{ $expenseProduct->id }}</td>
                                    <td>{{ $expenseProduct->name }}</td>
                                    <td class="rightfoot">{{ $expenseProduct->quantity }}</td>
                                    <td class="rightfoot">$ {{ number_format($expenseProduct->tax_subtotal,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($expenseProduct->subtotal,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($expenseProduct->subtotal + $expenseProduct->tax_subtotal,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->invoice > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Articulos Vendidos</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div>
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>id</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Imp</th>
                                <th>subtotal</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="3"><p align="right">TOTALES:</p></th>
                                <th><p align="right">${{ number_format($invoiceTotalTaxs,2) }}</p></th>
                                <th><p align="right">${{ number_format($invoiceTotals,2) }}</p></th>
                                <th><p align="right">${{ number_format($invoiceTotalTaxs + $invoiceTotals,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($invoiceProducts as $invoiceProduct)
                                <tr>
                                    <td>{{ $invoiceProduct->id }}</td>
                                    <td>{{ $invoiceProduct->name }}</td>
                                    <td class="rightfoot">{{ $invoiceProduct->quantity }}</td>
                                    <td class="rightfoot">$ {{ number_format($invoiceProduct->tax_subtotal,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($invoiceProduct->subtotal,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($invoiceProduct->subtotal + $invoiceProduct->tax_subtotal,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->ndpurchase > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Articulos Rechazados ND compra</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>id</th>
                                <th>Producto</th>
                                <th>cantidad</th>
                                <th>Imp</th>
                                <th>subtotal</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="3"><p align="right">TOTALES:</p></th>
                                <th><p align="right">${{ number_format($ndpurchaseTotalTaxs,2) }}</p></th>
                                <th><p align="right">${{ number_format($ndpurchaseTotals,2) }}</p></th>
                                <th><p align="right">${{ number_format($ndpurchaseTotalTaxs + $ndpurchaseTotals,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($ndpurchaseProducts as $ndpurchaseProduct)
                                <tr>
                                    <td>{{ $ndpurchaseProduct->id }}</td>
                                    <td>{{ $ndpurchaseProduct->name }}</td>
                                    <td class="rightfoot">{{ $ndpurchaseProduct->quantity }}</td>
                                    <td class="rightfoot">$ {{ number_format($ndpurchaseProduct->tax_subtotal,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($ndpurchaseProduct->subtotal,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($ndpurchaseProduct->subtotal + $ndpurchaseProduct->tax_subtotal,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->ncinvoice > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Articulos Rechazados NC venta</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>id</th>
                                <th>Producto</th>
                                <th>cantidad</th>
                                <th>Imp</th>
                                <th>subtotal</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="3"><p align="right">TOTALES:</p></th>
                                <th><p align="right">${{ number_format($ncinvoiceTotalTaxs,2) }}</p></th>
                                <th><p align="right">${{ number_format($ncinvoiceTotals,2) }}</p></th>
                                <th><p align="right">${{ number_format($ncinvoiceTotalTaxs + $ncinvoiceTotals,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($ncinvoiceProducts as $ndpurchaseProduct)
                                <tr>
                                    <td>{{ $ncinvoiceProduct->id }}</td>
                                    <td>{{ $ncinvoiceProduct->name }}</td>
                                    <td class="rightfoot">{{ $ncinvoiceProduct->quantity }}</td>
                                    <td class="rightfoot">$ {{ number_format($ncinvoiceProduct->tax_subtotal,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($ncinvoiceProduct->subtotal,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($ncinvoiceProduct->subtotal + $ncinvoiceProduct->tax_subtotal,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->purchase > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle de Compras</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°.F</th>
                                <th>Proveedor</th>
                                <th>Estado</th>
                                <th>Abonos</th>
                                <th>Saldo</th>
                                <th>Compras</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($purchaseSumPays,2) }}</p></th>
                                <th><p align="right">${{ number_format($purchaseBalances,2) }}</p></th>
                                <th><p align="right">${{ number_format($purchaseTotalPays,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->created_at }}</td>
                                    <td>{{ $purchase->document }}</td>
                                    <td>{{ $purchase->third->name }}</td>
                                    <td >{{ $purchase->status }}</td>
                                    <td class="rightfoot">$ {{ number_format($purchase->pay,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($purchase->balance,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($purchase->total_pay,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->invoice > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle de Ventas</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°.F</th>
                                <th>Cliente</th>
                                <th>Estado</th>
                                <th>Abonos</th>
                                <th>Saldo</th>
                                <th>Compras</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($invoiceSumPays,2) }}</p></th>
                                <th><p align="right">${{ number_format($invoiceBalances,2) }}</p></th>
                                <th><p align="right">${{ number_format($invoiceTotalPays,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->created_at }}</td>
                                    <td>{{ $invoice->document }}</td>
                                    <td>{{ $invoice->third->name }}</td>
                                    <td >{{ $invoice->status }}</td>
                                    <td class="rightfoot">$ {{ number_format($invoice->pay,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($invoice->balance,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($invoice->total_pay,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->expense > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle de Gastos</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°.G</th>
                                <th>Proveedor</th>
                                <th>Estado</th>
                                <th>Abonos</th>
                                <th>Saldo</th>
                                <th>Compras</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($expenseSumPays,2) }}</p></th>
                                <th><p align="right">${{ number_format($expenseBalances,2) }}</p></th>
                                <th><p align="right">${{ number_format($expenseTotalPays,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($expenses as $expense)
                                <tr>
                                    <td>{{ $expense->created_at }}</td>
                                    <td>{{ $expense->document }}</td>
                                    <td>{{ $expense->third->name }}</td>
                                    <td >{{ $expense->status }}</td>
                                    <td class="rightfoot">$ {{ number_format($expense->pay,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($expense->balance,2) }}</td>
                                    <td class="rightfoot">$ {{ number_format($expense->total_pay,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->ndpurchase > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle Notas Debito Compras</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°. ND</th>
                                <th>N°. Compra</th>
                                <th>Proveedor</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($sumNdpurchases,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($ndpurchases as $ndpurchase)
                                <tr>
                                    <td>{{ $ndpurchase->created_at }}</td>
                                    <td>{{ $ndpurchase->id }}</td>
                                    <td>{{ $ndpurchase->document }}</td>
                                    <td>{{ $ndpurchase->third->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($ndpurchase->total_pay,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->ncpurchase > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle Notas Credito Compras</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°.NC</th>
                                <th>N° Compra</th>
                                <th>Proveedor</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($sumNcpurchases,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($ncpurchases as $ncpurchase)
                                <tr>
                                    <td>{{ $ncpurchase->created_at }}</td>
                                    <td>{{ $ncpurchase->id }}</td>
                                    <td>{{ $ncpurchase->document }}</td>
                                    <td>{{ $ncpurchase->third->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($ncpurchase->total_pay,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->ncinvoice > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle Notas Credito Ventas</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°. ND</th>
                                <th>N°. Compra</th>
                                <th>Cliente</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($sumNcinvoices,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($ncinvoices as $ncinvoice)
                                <tr>
                                    <td>{{ $ncinvoice->created_at }}</td>
                                    <td>{{ $ncinvoice->id }}</td>
                                    <td>{{ $ncinvoice->document }}</td>
                                    <td>{{ $ncinvoice->third->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($ncinvoice->total_pay,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->ndinvoice > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle Notas Credito Compras</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°.NC</th>
                                <th>N° Compra</th>
                                <th>Proveedor</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($sumNdinvoices,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($ndinvoices as $ndinvoice)
                                <tr>
                                    <td>{{ $ndinvoice->created_at }}</td>
                                    <td>{{ $ndinvoice->id }}</td>
                                    <td>{{ $ndinvoice->document }}</td>
                                    <td>{{ $ndinvoice->third->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($ndinvoice->total_pay,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->out_purchase > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle Pagos por Compras</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>ID</th>
                                <th>N° Factura</th>
                                <th>Proveedor</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($purchaseSumPays,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($purchasePays as $purchasePay)
                                <tr>
                                    <td>{{ $purchasePay->created_at }}</td>
                                    <td>{{ $purchasePay->id }}</td>
                                    <td>{{ $purchasePay->payable->document }}</td>
                                    <td>{{ $purchasePay->payable->third->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($purchasePay->pay,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->out_expense > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle Pagos por Gastos</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>ID</th>
                                <th>N°. Doc</th>
                                <th>Proveedor</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($expenseSumPays,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($expensePays as $expensePay)
                                <tr>
                                    <td>{{ $expensePay->created_at }}</td>
                                    <td>{{ $expensePay->id }}</td>
                                    <td>{{ $expensePay->payable->document }}</td>
                                    <td>{{ $expensePay->payable->third->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($expensePay->pay,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->in_invoice > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle Recaudo por Ventas</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>ID</th>
                                <th>N° Factura</th>
                                <th>Cliente</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($invoiceSumPays,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($invoicePays as $invoicePay)
                                <tr>
                                    <td>{{ $invoicePay->created_at }}</td>
                                    <td>{{ $invoicePay->id }}</td>
                                    <td>{{ $invoicePay->payable->document }}</td>
                                    <td>{{ $invoicePay->payable->third->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($invoicePay->pay,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($sumAdvanceProviders > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle Anticipos a proveedores</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>ID</th>
                                <th>Proveedor</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="3"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($sumAdvanceProviders,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($advanceProviders as $advanceProvider)
                                <tr>
                                    <td>{{ $advanceProvider->created_at }}</td>
                                    <td>{{ $advanceProvider->id }}</td>
                                    <td>{{ $advanceProvider->advanceable->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($advanceProvider->pay,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($sumAdvanceCustomers > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle Anticipos de Clientes</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="3"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($sumAdvanceCustomers,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($advanceCustomers as $advanceCustomer)
                                <tr>
                                    <td>{{ $advanceCustomer->created_at }}</td>
                                    <td>{{ $advanceCustomer->id }}</td>
                                    <td>{{ $advanceCustomer->customer->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($advanceCustomer->pay,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->in_cash > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle Entradas de efectivo</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>ID</th>
                                <th>Recibe Administrador</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="3"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($sumCashInflows,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($cashInflows as $cashInflow)
                                <tr>
                                    <td>{{ $cashInflow->created_at }}</td>
                                    <td>{{ $cashInflow->id }}</td>
                                    <td>{{ $cashInflow->admin->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($cashInflow->cash,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->out_cash > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Detalle Entregas de efectivo</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>ID</th>
                                <th>Recibe Administrador</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="3"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($sumCashOutflows,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($cashOutflows as $cashOutflow)
                                <tr>
                                    <td>{{ $cashOutflow->created_at }}</td>
                                    <td>{{ $cashOutflow->id }}</td>
                                    <td>{{ $cashOutflow->admin->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($cashOutflow->cash,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
