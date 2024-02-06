<div class="box-body row">
    <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
        <label for="customer_id">Cliente</label>
        <div class="select">
            <select id="customer_id" name="customer_id" class="form-control selectpicker" data-live-search="true">
                <option {{ old('customer_id', $invoiceOrder->customer_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Cliente</option>
                @foreach($customers as $customer)
                    @if(old('customer_id', $invoiceOrder->customer_id ?? '') == $customer->id)
                        <option value="{{ $customer->id }}" selected>{{ $customer->name }}</option>
                    @else
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="generation_date">Fecha Generacion</label>
            <input type="date" name="generation_date" id="generation_date" class="form-control"
                value="{{ $invoiceOrder->generation_date }}" placeholder="Fecha Vencimiento">
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="due_date">Vencimiento</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $invoiceOrder->due_date }}"
                placeholder="Fecha Vencimiento">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="documentType">
        <div class="form-group">
            <label class="form-control-label" for="document_type_id">Tipo de documento</label>
            <input type="text" id="document_type_id" name="document_type_id" value="1" class="form-control"
                placeholder="Tipo de documento">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="uvt5">
        <div class="form-group">
            <label class="form-control-label" for="uvtmax">UVT Max</label>
            <input type="text" id="uvtmax" name="uvtmax" value="{{ $uvtmax }}" class="form-control"
                placeholder="tope de pos">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="posActive">
        <div class="form-group">
            <label class="form-control-label" for="pos_active">Post Activado</label>
            <input type="text" id="pos_active" name="pos_active" value="{{ $indicator->pos }}" class="form-control"
                placeholder="tope de pos">
        </div>
    </div>
</div>
<div class="box-body row">
    @if ($indicator->dian == 'on')
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="resolution">
            <div class="form-group">
                <label class="form-control-label required" for="resolution_id">Resolucion</label>
                <select name="resolution_id" class="form-control selectpicker" id="resolution_id"
                    data-live-search="true" required>
                    <option value="" selected>Resolucion</option>
                    @foreach ($resolutions as $resolution)
                        <option value="{{ $resolution->id }}">{{ $resolution->prefix }}
                            {{ $resolution->resolution }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    @if ($indicator->pos == 'on')

        @if ($indicator->dian == 'on')
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mt-3" id="addFe">
                <div class="form-check">
                    <input class="form-check-input fe_true" type="radio" name="fe" value="1"
                        id="fe_on">
                    <label class="form-check-label" for="fe">
                        Generar Factura Electronica
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input fe_true" type="radio" name="fe" value="2"
                        id="fe_off" checked>
                    <label class="form-check-label" for="fe">
                        Generar ticket POS
                    </label>
                </div>
            </div>
        @else
            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" id="posavtivity">
                <div class="form-group">
                    <label class="form-control-label" for="fe">pos Active</label>
                    <input type="number" id="fe" name="fe" value="2" class="form-control"
                        placeholder="fe">
                </div>
            </div>
        @endif
    @endif
    <div class="col-lg-8 col-md-6 col-sm-10 col-xs-12" id="noteDocument">
        <div class="form-group">
            <label class="form-control-label" for="note">Observaciones</label>
            <input type="text" id="note" name="note" value="{{ old('note') }}" class="form-control"
                placeholder="Observaciones">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="bags">Bolsas</label>
            <input type="number" id="bags" name="bags" value="0" class="form-control"
                placeholder="Bolsas">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="invoice_order_id">Orden de compra</label>
            <input type="number" id="invoice_order_id" name="invoice_order_id" value="{{ $invoiceOrder->id }}" class="form-control"
                placeholder="" readonly>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Eid</th>
                        <th>Id</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>precio ($)</th>
                        <th>imp (%)</th>
                        <th>SubTotal ($)</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="6" class="rightfoot">TOTAL:</th>
                        <td class="rightfoot thfoot"><strong id="total_html">$ 0.00</strong>
                            <input type="hidden" name="total" id="total">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="6" class="rightfoot">IMPUESTO:</th>
                        <td class="rightfoot thfoot"><strong id="total_tax_html">$ 0.00</strong>
                            <input type="hidden" name="total_tax" id="total_tax">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="6" class="rightfoot">TOTAL VENTA:</th>
                        <td class="rightfoot thfoot"><strong id="total_pay_html">$ 0.00</strong>
                            <input type="hidden" name="total_pay" id="total_pay">
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>
