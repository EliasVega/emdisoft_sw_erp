<div class="box-body row">
    <div class="col-md-5" id="formPayCard">
        <div class="card card-primary card-outline">
            @include('admin/generalview.form_pay')
        </div>
    </div>
    <div class="col-md-5" id="formCard">
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="editAddCustomer">
                    <label for="customer_id">Cliente</label>
                    <div class="select">
                        <select id="customer_id" name="customer_id" class="form-control selectpicker" data-live-search="true">
                            <option {{ old('customer_id', $restaurantOrder->customer_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Cliente</option>
                            @foreach($customers as $customer)
                                @if(old('customer_id', $restaurantOrder->customer_id ?? '') == $customer->id)
                                    <option value="{{ $customer->id }}" selected>{{ $customer->name }}</option>
                                @else
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="generation_date">Generacion</label>
                        <input type="date" name="generation_date" id="generation_date" class="form-control"
                            value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Vencimiento" readonly>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="due_date">Vencimiento</label>
                        <input type="date" name="due_date" id="due_date" class="form-control"
                            value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Vencimiento">
                    </div>
                </div>
                @if ($indicator->dian == 'on')
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="resolution">
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="noteDocument">
                    <div class="form-group">
                        <label class="form-control-label" for="note">Observaciones</label>
                        <input type="text" id="note" name="note" value="{{ old('note') }}"
                            class="form-control" placeholder="Observaciones">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 mt-3" id="addOrder">
                    <div class="form-group">
                        <label for="restaurant_order_id">Comanda </label>
                        <input type="number" name="restaurant_order_id" id="restaurant_order_id"
                            value="{{ $restaurantOrder->id }}" class="form-control" readonly>
                    </div>
                </div>
                @if ($homeOrder != null && $homeOrder->type == 'home')
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mt-3" id="addDomiciliary">
                        <div class="form-group">
                            <label class="form-control-label" for="domiciliary">Domiciliario</label>
                            <input type="text" id="domiciliary" name="domiciliary" value=""
                                class="form-control" placeholder="Domiciliario">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mt-3" id="addHomeOrder">
                        <div class="form-group">
                            <label class="form-control-label" for="domiciliary">V/Domicilio</label>
                            <input type="text" id="domicile_value" name="domicile_value" value=""
                                class="form-control" placeholder="Valor Domicilio">
                        </div>
                    </div>
                @endif
                @if ($homeOrder != null && $homeOrder->type == 'rappi')
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mt-3" id="addDomiciliary">
                        <div class="form-group">
                            <label class="form-control-label" for="domiciliary">Domiciliario</label>
                            <input type="text" id="domiciliary" name="domiciliary" value="rappi"
                                class="form-control" placeholder="Domiciliario" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mt-3" id="addHomeOrder">
                        <div class="form-group">
                            <label class="form-control-label" for="domiciliary">V/Domicilio</label>
                            <input type="number" id="domicile_value" name="domicile_value" value="0"
                                class="form-control" placeholder="Valor Domicilio" readonly>
                        </div>
                    </div>
                @endif
                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 mt-3" id="addInvoiced" >
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="invoiced" value="1" id="invoiced_on" checked>
                        <label class="form-check-label" for="invoiced">
                            Facturar Electronica de venta
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="invoiced" value="2" id="invoiced_off">
                        <label class="form-check-label" for="invoiced">
                            Comanda Pendiente por Facturar
                        </label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-blueGrad btn-sm mb-2 ml-3" type="button" id="addPay"
                            data-toggle="tooltip" data-placement="top" title="Pagos"><i
                                class="fas fa-check"></i>Agrepar Pago</button>
                    </div>
                </div>
                @include('admin/generalview.form_register')
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>precio</th>
                            <th>Impto</th>
                            <th>%</th>
                            <th>SubTotal</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="rightfoot">TOTAL:</th>
                            <td class="rightfoot thfoot"><strong id="total_html">$ 0.00</strong>
                                <input type="hidden" name="total" id="total">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="5" class="rightfoot">IMPUESTO:</th>
                            <td class="rightfoot thfoot"><strong id="total_tax_html">$ 0.00</strong>
                                <input type="hidden" name="total_tax" id="total_tax">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="5" class="rightfoot">TOTAL VENTA:</th>
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
</div>
<div class="box-body row" id="invoicenegative">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="documentType">
        <div class="form-group">
            <label class="form-control-label" for="document_type_id">Tipo de documento</label>
            <input type="text" id="document_type_id" name="document_type_id" value="1" class="form-control"
                placeholder="Tipo de documento">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="posActive">
        <div class="form-group">
            <label class="form-control-label" for="pos_active">Post Activado</label>
            <input type="text" id="pos_active" name="pos_active" value="{{ $indicator->dian }}"
                class="form-control" placeholder="tope de pos">
        </div>
    </div>
</div>

<div class="box-body row" id="doNotLook">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="taxType">
        <div class="form-group">
            <label class="form-control-label" for="tax_type">Tipo Impuesto</label>
            <input type="number" id="tax_type" name="tax_type" class="form-control" value="0" disabled
                pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="addTypeDocument">
        <div class="form-group">
            <label class="form-control-label" for="typeDocument">tipo documento</label>
            <input type="text" id="typeDocument" name="typeDocument" value="{{ $type }}"
                class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="addTypeProduct">
        <div class="form-group">
            <label class="form-control-label" for="typeProduct">Typo Producto</label>
            <input type="text" id="typeProduct" name="typeProduct" class="form-control" value="product">
        </div>
    </div>
</div>
