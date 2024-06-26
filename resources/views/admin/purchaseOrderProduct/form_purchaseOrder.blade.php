<div class="box-body row">

    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="prepurch">
        <div class="form-group">
            <label for="purchaseOrder">O/P </label>
            <input type="number" name="purchaseOrder" id="purchaseOrder" value="{{ $purchaseOrder->id }}" class="form-control">
        </div>
    </div>
    @if ($countBranchs > 1)
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="branch_id">Sucursal Destino</label>
                    <select name="branch_id" class="form-control selectpicker" id="branch_id" data-live-search="true" required>
                        <option value="0" disabled selected>Seleccionar Sucursal</option>
                        @foreach($branchs as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
            </div>
        </div>
    @else
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="branch_id">Sucursal</label>
                <input type="text" id="branch_id" name="branch_id" value="1" class="form-control" placeholder="Sucursal">
            </div>
        </div>
    @endif
    <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
        <label for="customer_id">Cliente</label>
        <div class="select">
            <select id="provider_id" name="provider_id" class="form-control selectpicker" data-live-search="true">
                <option {{ old('provider_id', $purchaseOrder->provider_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Cliente</option>
                @foreach($providers as $provider)
                    @if(old('provider_id', $purchaseOrder->provider_id ?? '') == $provider->id)
                        <option value="{{ $provider->id }}" selected>{{ $provider->name }}</option>
                    @else
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    @if ($indicator->dian == 'on')
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="document_type_id">Tipo de Documento</label>
                    <select name="document_type_id" class="form-control selectpicker" id="document_type_id" data-live-search="true" required>
                        <option value="0" disabled selected>Seleccionar Tipo de documento</option>
                        @foreach($documentTypes as $documentType)
                            <option value="{{ $documentType->id }}">{{ $documentType->name }}</option>
                        @endforeach
                    </select>
            </div>
        </div>
    @else
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="documentBis">
            <div class="form-group">
                <label class="form-control-label" for="document_type_id">Typo Documento</label>
                <input type="text" id="document_type_id" name="document_type_id" value="25"
                class="form-control" placeholder="Tipo Documento" readonly>
            </div>
        </div>
    @endif
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="invoiceCode">
        <div class="form-group">
            <label class="form-control-label" for="invoice_code">N°Factura</label>
            <input type="text" id="invoice_code" name="invoice_code" value="{{ 'N/A' }}" class="form-control" placeholder="Numero de la factura" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="generation_date">Fecha Generacion</label>
            <input type="date" name="generation_date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Fecha Vencimiento">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="due_date">Vencimiento</label>
            <input type="date" name="due_date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Fecha Vencimiento">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="resolution">
        <div class="form-group">
            <label class="form-control-label" for="resolution_id">Resolucion</label>
                <select name="resolution_id" class="form-control selectpicker" id="resolution_id" data-live-search="true">
                    <option value="0" disabled selected>Resolucion</option>
                    @foreach($resolutions as $resolution)
                        <option value="{{ $resolution->id }}">{{ $resolution->prefix }} {{ $resolution->resolution }}</option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="generat">
        <div class="form-group">
            <label class="form-control-label" for="generation_type_id">Tipo de generacion</label>
                <select name="generation_type_id" class="form-control selectpicker" id="generation_type_id" data-live-search="true" required>
                    <option value="1" disabled selected>Tipo de generacion</option>
                    @foreach($generationTypes as $generationType)
                        <option value="{{ $generationType->id }}">{{ $generationType->description }}</option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="startd">
        <div class="form-group">
            <label class="form-control-label" for="start_date">Fecha de inicio</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo date("Y-m-d");?>">
        </div>
    </div>
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" id="noteDocument">
        <div class="form-group">
            <label class="form-control-label" for="note">Observaciones</label>
            <input type="text" id="note" name="note" value="{{ old('note') }}" class="form-control" placeholder="Observaciones">
        </div>
    </div>
    <div class="clearfix"></div>
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
                        <th colspan="5" class="rightfoot">IMPUESTOS:</th>
                        <td class="rightfoot thfoot"><strong id="total_tax_html">$ 0.00</strong>
                            <input type="hidden" name="total_tax" id="total_tax">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="5" class="rightfoot">TOTAL PAGAR:</th>
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
