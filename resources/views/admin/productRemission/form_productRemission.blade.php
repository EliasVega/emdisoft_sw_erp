<div class="box-body row">
    <div class="col-md-5" id="formPayCard">
        <div class="card card-primary card-outline">
            @include('admin/generalview.form_pay')
        </div>
    </div>
    <div class="col-md-5" id="formCard">
        <div class="card card-primary card-outline">
            <div class="row">
                @if (indicator()->dian == 'on')
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addRemissionId">
                    <div class="form-group">
                        <label class="form-control-label" for="remission_id">Remission id</label>
                        <input type="text" id="remission_id" name="remission_id" value="{{ $remission->id }}" class="form-control"
                            placeholder="Observaciones">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="noteDocument">
                    <div class="form-group">
                        <label class="form-control-label" for="note">Observaciones</label>
                        <input type="text" id="note" name="note" value="{{ old('note') }}" class="form-control"
                            placeholder="Observaciones">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-blueGrad btn-sm mb-2 ml-3" type="button" id="addPay" data-toggle="tooltip"
                            data-placement="top" title="Pagos"><i class="fas fa-check"></i>Agrepar Pago</button>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-blueGrad btn-sm mb-2 ml-3" type="button" id="addRetentions" data-toggle="tooltip"
                            data-placement="top" title="Retenciones"><i class="fas fa-check"></i>Agrepar Retenciones</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="customer_id">Cliente</label>
                <div class="select">
                    <select id="customer_id" name="customer_id" class="form-control selectpicker" data-live-search="true">
                        <option {{ old('customer_id', $remission->customer_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Cliente</option>
                        @foreach($customers as $customer)
                            @if(old('customer_id', $remission->customer_id ?? '') == $customer->id)
                                <option value="{{ $customer->id }}" selected>{{ $customer->name }}</option>
                            @else
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="generation_date">Generacion</label>
                    <input type="date" name="generation_date" id="generation_date" class="form-control"
                        value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Vencimiento">
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="due_date">Vencimiento</label>
                    <input type="date" name="due_date" id="due_date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                        placeholder="Fecha Vencimiento">
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th>Edit</th>
                            @if (indicator()->work_labor == 'on')
                                <th>Oper.</th>
                            @endif
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
                            <th colspan="{{ $cols }}" class="rightfoot">TOTAL:</th>
                            <td class="rightfoot thfoot"><strong id="total_html">$ 0.00</strong>
                                <input type="hidden" name="total" id="total">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="{{ $cols }}" class="rightfoot">IMPUESTO:</th>
                            <td class="rightfoot thfoot"><strong id="total_tax_html">$ 0.00</strong>
                                <input type="hidden" name="total_tax" id="total_tax">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="{{ $cols }}" class="rightfoot">TOTAL VENTA:</th>
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
<div class="box-body row" id="doNotLook">
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
            <input type="text" id="pos_active" name="pos_active" value="{{ indicator()->dian }}" class="form-control"
                placeholder="tope de pos">
        </div>
    </div>
    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="totalPartial">Total</label>
            <input type="number" name="totalPartial" id="totalPartial" class="form-control" readonly>
        </div>
    </div>
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
            <input type="text" id="typeDocument" name="typeDocument" value="{{ $type }}" class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="addTypeProduct">
        <div class="form-group">
            <label class="form-control-label" for="typeProduct">Typo Producto</label>
            <input type="text" id="typeProduct" name="typeProduct" class="form-control" value="product">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="addTypeOperation">
        <div class="form-group">
            <label class="form-control-label" for="typeOperation">Typo Operacion</label>
            <input type="text" id="typeOperation" name="typeOperation" class="form-control" value="{{ $typeOperation }}">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="indWL">
        <div class="form-group">
            <label class="form-control-label" for="indicatorwl">WL</label>
            <input type="text" id="indicatorwl" name="indicatorwl" value="{{ indicator()->work_labor }}" class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addRemissionPayments">
        <div class="form-group">
            <label class="form-control-label" for="remission_payments">Abonos</label>
            <input type="text" id="remission_payments" name="remission_payments" value="{{ $remission->pay }}" class="form-control"
                placeholder="Observaciones">
        </div>
    </div>
</div>

