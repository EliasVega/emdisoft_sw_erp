<div class="box-body row">
    <div class="col-md-5" id="formPayCard">
        <div class="card card-primary card-outline">
            @include('admin/generalview.form_pay')
        </div>
    </div>
    <div class="col-md-5" id="formCard">
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="provider_id">Proveedor</label>
                        <select name="provider_id" class="form-control selectpicker" id="provider_id"
                            data-live-search="true" required>
                            <option value="" disabled selected>Seleccionar el Proveedor</option>
                            @foreach ($providers as $provider)
                                <option value="{{ $provider->id }}">{{ $provider->number }} - {{ $provider->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="generation_date">Generacion</label>
                        <input type="date" name="generation_date" id="generation_date" class="form-control"
                            value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Vencimiento">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addProductId">
                    <div class="form-group">
                        <label class="form-control-label" for="product_id">Producto </label>
                        <select name="product_id" class="form-control selectpicker" id="product_id"
                            data-live-search="true">
                            <option value="0" disabled selected>Seleccionar</option>
                            @foreach ($products as $product)
                                <option
                                    value="{{ $product->id }}_{{ $product->stock }}_{{ $product->price }}_{{ $product->percentage }}_{{ $product->tt }}_{{ $product->sale_price }}">
                                    {{ $product->code }} -- {{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="quantityadd">Cantidad</label>
                        <input type="number" id="quantityadd" name="quantityadd" class="form-control"
                            placeholder="Cant." pattern="[0-9]{0,15}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="price">Precio</label>
                        <input type="number" id="price" name="price" class="form-control"
                            placeholder="Precio">
                    </div>
                </div>

                @include('admin/generalview.button_add')

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="addPayButton">
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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="noteDocument">
                <div class="form-group">
                    <label class="form-control-label" for="note">Observaciones</label>
                    <input type="text" id="note" name="note" value="{{ old('note') }}"
                        class="form-control" placeholder="Observaciones">
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th>Eliminar</th>
                            <th>Editar</th>
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
                            <td class="rightfoot"><strong id="total_html">$ 0.00</strong>
                                <input type="hidden" name="total" id="total"></td>
                        </tr>
                        <!--
                        <tr>
                            <th colspan="7" class="rightfoot">IMPUESTOS:</th>
                            <td class="rightfoot"><strong id="total_tax_html">$ 0.00</strong>
                                <input type="hidden" name="total_tax" id="total_tax">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="7" class="rightfoot">TOTAL GASTO:</th>
                            <td class="rightfoot"><strong id="total_pay_html">$ 0.00</strong>
                                <input type="hidden" name="total_pay" id="total_pay"></td>
                        </tr>-->
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="box-body row" id="invoicenegative">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="taxType">
        <div class="form-group">
            <label class="form-control-label" for="tax_type">Iva</label>
            <input type="number" id="tax_type" name="tax_type" class="form-control" value="0" disabled
                pattern="[0-9]{0,15}">
        </div>
    </div>
</div>

