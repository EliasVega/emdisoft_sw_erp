<div class="box-body row">
    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="customer_id"> Cliente <a href="{{ route('customer.create') }}" class="btn btn-lightBlueGrad btn-sm" target="_blank" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-plus"> Agregar Cliente</i>
            </a></label>
            <select name="customer_id" class="form-control selectpicker" id="customer_id"
                data-live-search="true" required>
                <option value="" disabled selected>Seleccionar el Cliente</option>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->identification }} - {{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12" id="noteDocument">
        <div class="form-group">
            <label class="form-control-label" for="note">Observaciones</label>
            <input type="text" id="note" name="note" value="{{ old('note') }}" class="form-control" placeholder="Observaciones">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 mt-3" id="addOrder">
        <div class="form-group">
            <label for="restaurant_order_id">Comanda </label>
            <input type="number" name="restaurant_order_id" id="restaurant_order_id" value="{{ $restaurantOrder->id }}" class="form-control" readonly>
        </div>
    </div>
    @if ($homeOrder->type == 'home')
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
    @if ($homeOrder->type == 'rappi')
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
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12" id="addGeneration_date">
        <div class="form-group">
            <label class="form-control-label" for="generation_date">Fecha Generacion</label>
            <input type="date" name="generation_date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Fecha Vencimiento">
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12" id="addDue_date">
        <div class="form-group">
            <label class="form-control-label" for="due_date">Vencimiento</label>
            <input type="date" name="due_date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Fecha Vencimiento">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="documentType">
        <div class="form-group">
            <label class="form-control-label" for="document_type_id">Tipo de documento</label>
            <input type="text" id="document_type_id" name="document_type_id" value="1" class="form-control" placeholder="Tipo de documento">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="uvt5">
        <div class="form-group">
            <label class="form-control-label" for="uvtmax">UVT Max</label>
            <input type="text" id="uvtmax" name="uvtmax" value="{{ $uvtmax }}" class="form-control" placeholder="tope de pos">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="posActive">
        <div class="form-group">
            <label class="form-control-label" for="pos_active">Post Activado</label>
            <input type="text" id="pos_active" name="pos_active" value="{{ $indicator->pos }}" class="form-control" placeholder="tope de pos">
        </div>
    </div>
</div>
<div class="box-body row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="taxType">
        <div class="form-group">
            <label class="form-control-label" for="tax_type">Tipo Impuesto</label>
            <input type="number" id="tax_type" name="tax_type" class="form-control" value="0" disabled
                pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="resolution">
        <div class="form-group">
            <label class="form-control-label required" for="resolution_id">Resolucion</label>
                <select name="resolution_id" class="form-control selectpicker" id="resolution_id" data-live-search="true" required>
                    <option value="" selected>Resolucion</option>
                    @foreach($resolutions as $resolution)
                        <option value="{{ $resolution->id }}">{{ $resolution->prefix }} {{ $resolution->resolution }}</option>
                    @endforeach
                </select>
        </div>
    </div>
    @if ($indicator->pos == 'on')
        @if ($indicator->dian == 'on')
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mt-3" id="addFe" >
                <div class="form-check">
                    <input class="form-check-input fe_true" type="radio" name="fe" value="1" id="fe_on">
                    <label class="form-check-label" for="fe">
                        Generar Factura Electronica
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input fe_true" type="radio" name="fe" value="2" id="fe_off" checked>
                    <label class="form-check-label" for="fe">
                        Generar ticket POST
                    </label>
                </div>
            </div>
        @else
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="addPosBis">
                <div class="form-group">
                    <label class="form-control-label" for="fe">Pos</label>
                    <input type="text" id="fe" name="fe" value="2" class="form-control" placeholder="Pos">
                </div>
            </div>
        @endif

    @endif

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" id="addBags">
        <div class="form-group">
            <label class="form-control-label" for="bags">Bolsas</label>
            <input type="number" id="bags" name="bags" value="0" class="form-control"
                placeholder="Bolsas">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
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
                        <th colspan="5" class="rightfoot">TOTAL:</th>
                        <td class="rightfoot thfoot"><strong id="total_html">$ 0.00</strong>
                            <input type="hidden" name="total" id="total"></td>
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
                            <input type="hidden" name="total_pay" id="total_pay"></td>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>
