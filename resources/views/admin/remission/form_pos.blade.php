<div class="box-body row">
    <div class="col-md-5" id="formCard">
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="customer_id"> Cliente </label>
                        <select name="customer_id" class="form-control selectpicker" id="customer_id"
                            data-live-search="true" required>
                            <option value="" disabled selected>Seleccionar</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->identification }} -
                                    {{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if (indicator()->barcode == 'on')
                    <div class="col-lg-12 col-md-12 col-sm-14 col-xs-12" id="codeBarcode">
                        <div class="form-group">
                            <label for="code">Codigo</label>
                            <input type="text" name="code" id="code" value="" class="form-control"
                                placeholder="" aria-describedby="helpId" class="gui-input" autofocus>

                        </div>
                    </div>
                @endif

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="product_id">Producto </label>
                        <select name="product_id" class="form-control selectpicker" id="product_id"
                            data-live-search="true">
                            <option value="0" disabled selected>Seleccionar</option>
                            @foreach ($products as $product)
                                <option
                                    value="{{ $product->id }}_{{ $product->stock }}_{{ $product->sale_price }}_{{ $product->percentage }}_{{ $product->tt }}_{{ $product->utility_rate }}">
                                    {{ $product->code }} -- {{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="quantityadd">Cantidad</label>
                        <input type="number" id="quantityadd" name="quantityadd" value="1" class="form-control"
                            placeholder="Cant." pattern="[0-9]{0,15}">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="price">Precio</label>
                        <input type="number" id="price" name="price" class="form-control" placeholder="Precio">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label">Add</label><br>
                        <button class="btn btn-lightBlueGrad" type="button" id="add" data-toggle="tooltip"
                            data-placement="top" title="Add"><i class="fas fa-check"></i></button>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="payposadd">
                    <div class="form-group">
                        <button class="btn btn-blueGrad btn-sm mb-2 ml-3" type="button" data-toggle="modal"
                            data-target="#payPos">
                            <i class="fa fa-plus"></i>Agregar Pago</button>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="vpayadd">
                    <div class="form-group">
                        <label class="form-control-label requerido" for="vpay">Pago</label>
                        <input type="number" id="vpay" value="0" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="rbadd">
                    <div class="form-group">
                        <label class="form-control-label" for="rbal">Cambio</label>
                        <input type="number" id="rbal" value="0" class="form-control">
                    </div>
                </div>
                <div class="modal-footer" id="save">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-lightBlueGrad" type="submit"><i class="fa fa-save"></i>&nbsp;
                                Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="noteDocument">
                <div class="form-group">
                    <label class="form-control-label" for="note">Observaciones</label>
                    <input type="text" id="note" name="note" value="{{ old('note') }}"
                        class="form-control" placeholder="Observaciones">
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
                    <input type="date" name="due_date" id="due_date" class="form-control"
                        value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Vencimiento">
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th>Elim</th>
                            <th>Edit</th>
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
                            <th colspan="7" class="rightfoot">TOTAL:</th>
                            <td class="rightfoot thfoot"><strong id="total_html">$ 0.00</strong>
                                <input type="hidden" name="total" id="total">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="7" class="rightfoot">IMPUESTO:</th>
                            <td class="rightfoot thfoot"><strong id="total_tax_html">$ 0.00</strong>
                                <input type="hidden" name="total_tax" id="total_tax">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="7" class="rightfoot">TOTAL VENTA:</th>
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
<div class="box-body row" id="posnegative">
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
            <input type="text" id="pos_active" name="pos_active" value="{{ indicator()->dian }}"
                class="form-control" placeholder="tope de pos">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="stock">Stock</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" class="form-control"
                placeholder="stock" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="tax_rate">Imp %</label>
            <input type="number" id="tax_rate" name="tax_rate" class="form-control" placeholder="%" disabled
                pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="vprice">V/Actual</label>
            <input type="number" name="vprice" id="vprice" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="utility">% Utilidad</label>
            <input type="number" name="utility" id="utility" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="totalPartial">Total</label>
            <input type="number" name="totalPartial" id="totalPartial" class="form-control" readonly>
        </div>
    </div>
    @if (indicator()->barcode == 'on')
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12" id="barcodeId">
            <div class="form-group">
                <label for="barcode_product_id">id Barcode</label>
                <input type="number" name="barcode_product_id" id="barcode_product_id" value=""
                    class="form-control" placeholder="">

            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="productBarcode">
            <div class="form-group">
                <label for="product_barcode">Producto</label>
                <input type="text" name="product_barcode" id="product_barcode" value=""
                    class="form-control" placeholder="">

            </div>
        </div>
    @endif
</div>

<div class="box-body row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="taxType">
        <div class="form-group">
            <label class="form-control-label" for="tax_type">Tipo Impuesto</label>
            <input type="number" id="tax_type" name="tax_type" class="form-control" value="0" disabled
                pattern="[0-9]{0,15}">
        </div>
    </div>

    @if (indicator()->work_labor == 'on')
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="addEmployeeId">
            <div class="form-group row">
                <label class="form-control-label" for="employee_id">Operario</label>
                <select name="employee_id" class="form-control selectpicker" id="employee_id"
                    data-live-search="true">
                    <option value="0" disabled selected>Seleccionar</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->identification }} -- {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @else
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="addEid">
            <div class="form-group row">
                <label class="form-control-label" for="employee_id">Operario</label>
                <select name="employee_id" class="form-control selectpicker" id="employee_id"
                    data-live-search="true">
                    <option value="0" disabled selected>Seleccionar</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->identification }} -- {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="addTypeDocument">
        <div class="form-group">
            <label class="form-control-label" for="typeDocument">tipo documento</label>
            <input type="text" id="typeDocument" name="typeDocument" value="{{ $type }}" class="form-control">
        </div>
    </div>
</div>
