@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Emdisoft_pro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">Caja #</label>
                <p>{{ $cashRegister->id }}</p>
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
                    <label class="form-control-label" for="abono">Egreso X Compras</label>
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
                    <label class="form-control-label" for="abono">Egreso X Gastos</label>
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
        @if ($cashRegister->ndpurchase > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Articulos Devueltos nota Debito</strong>
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
