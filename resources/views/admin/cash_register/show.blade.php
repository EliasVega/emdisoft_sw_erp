@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 offset-lg-4">
            <a href="{{ route('cashRegister.index') }}" class="btn btn-lightBlueGrad"><i class="fa fa-plus mr-2"></i>Regresar</a>
            <a href="{{ route('branch.index') }}" class="btn btn-blueGrad"><i class="fa fa-plus mr-2"></i>Inicio</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="nombre"># caja</label>
                <p>{{ $cashRegister->id }}</p>
            </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="cash_open">Efectivo apertura</label>
                <p>{{ number_format($cashRegister->cash_initial,2) }}</p>
            </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="open">fecha de apertura</label>
                <p>{{ $cashRegister->created_at }}</p>
            </div>
        </div>

        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="close"> fecha de Cierre</label>
                @if ($cashRegister->status == 'close')
                    <p>{{ $cashRegister->updated_at }}</p>
                @endif

            </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="abono">total entradas</label>
                <p>{{ number_format($cashRegister->in_total,2) }}</p>
            </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="abono">Total salidas</label>
                <p>{{ number_format($cashRegister->out_total,2) }}</p>
            </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="abono">Entrada de efectivo</label>
                <p>{{ number_format($cashRegister->cash_in_total,2) }}</p>
            </div>
        </div>

        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="pay">Salida de efectivo</label>
                <p>{{ number_format($cashRegister->cash_out_total,2) }}</p>
            </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="balance">Saldo en caja</label>
                <p>{{ number_format(($cashRegister->cash_in_total - $cashRegister->cash_out_total),2) }}</p>
            </div>
        </div>
    </div>
    <div class="row">
        @if ($cashRegister->invoice > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <strong class="tpdf">Detalle Ventas</strong>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°.F</th>
                                <th>Cliente</th>
                                <th>Abonos</th>
                                <th>Saldo</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="5"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($cashRegister->invoice,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->created_at }}</td>
                                    <td>{{ $invoice->document }}</td>
                                    <td>{{ $invoice->third->name }}</td>
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
        @if ($cashRegister->purchase > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <strong class="tpdf">Detalle Compras</strong>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°.Compra</th>
                                <th>Proveedor</th>
                                <th>Abonos</th>
                                <th>Saldo</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="5"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($cashRegister->purchase,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->created_at }}</td>
                                    <td>{{ $purchase->document }}</td>
                                    <td>{{ $purchase->third->name }}</td>
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
        @if ($cashRegister->expense > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <strong class="tpdf">Detalle Gastos</strong>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°.G</th>
                                <th>Proveedor</th>
                                <th>Abonos</th>
                                <th>Saldo</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="5"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($cashRegister->expense,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($expenses as $expense)
                                <tr>
                                    <td>{{ $expense->created_at }}</td>
                                    <td>{{ $expense->document }}</td>
                                    <td>{{ $expense->third->name }}</td>
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
        @if ($cashRegister->ndinvoice > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <strong class="tpdf">Detalle Notas Debito Ventas</strong>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°. ND</th>
                                <th>Aplicado A.</th>
                                <th>Cliente</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($ndinvoiceTotal,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($ndinvoices as $ndinvoice)
                                <tr>
                                    <td>{{ $ndinvoice->created_at }}</td>
                                    <td>{{ $ndinvoice->id }}</td>
                                    <td>{{ $ndinvoice->document }}</td>
                                    <td>{{ $ndinvoice->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($ndinvoice->total_pay,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->ncinvoice > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <strong class="tpdf">Detalle Notas Credito Venta</strong>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°.NC</th>
                                <th>Aplicado A.</th>
                                <th>Cliente</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($ncinvoiceTotal,2) }}</p></th>
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
        @if ($cashRegister->ndpurchase > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <strong class="tpdf">Detalle Notas Debito Compras</strong>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°. ND</th>
                                <th>Aplicado A.</th>
                                <th>Proveedor</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($ndpurchaseTotal,2) }}</p></th>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <strong class="tpdf">Detalle Notas Credito Compras</strong>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°.NC</th>
                                <th>Aplicado A.</th>
                                <th>Proveedor</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($ndpurchaseTotal,2) }}</p></th>
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

        @if ($cashRegister->purchaseOrder > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <strong class="tpdf">Detalle Ordenes de compra</strong>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>Orden #</th>
                                <th>Proveedor</th>
                                <th>stado</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="5"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($cashRegister->purchase_order,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->document }}</td>
                                    <td>{{ $order->third->name }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td class="rightfoot">$ {{ number_format($order->total_pay,2) }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->restaurantOrder > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <strong class="tpdf">Detalle Pedidos</strong>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>N°.Pedido</th>
                                <th>Cliente</th>
                                <th>stado</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="5"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($cashRegister->restaurant_order,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->document }}</td>
                                    <td>{{ $order->third->name }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td class="rightfoot">$ {{ number_format($order->total_pay,2) }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->out_cash > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <strong class="tpdf">Detalle Entregas de efectivo</strong>
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
                                <th><p align="right">${{ number_format($sumCashOutflow,2) }}</p></th>
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
        @if ($cashRegister->in_cash > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <strong class="tpdf">Detalle Recarga de efectivo</strong>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>ID</th>
                                <th>Recibe</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="3"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($sumCashInflow,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($cashInflows as $cashInflow)
                                <tr>
                                    <td>{{ $cashInflow->created_at }}</td>
                                    <td>{{ $cashInflow->id }}</td>
                                    <td>{{ $cashInflow->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($cashInflow->cash,2) }}</td>
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
