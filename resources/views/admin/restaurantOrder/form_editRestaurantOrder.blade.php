<div class="box-body row">
    <div class="col-md-4" id="formCard">
        <div class="card card-primary card-outline">
            <div class="row">
                @if ($service > 1)
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
                @endif

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addProduct">
                    <div class="form-group">
                        <label class="form-control-label" for="product_id">Menu</label>
                        <select name="product_id" class="form-control selectpicker" id="product_id"
                            data-live-search="true">
                            <option value="" disabled selected>Seleccionar el Menu</option>
                            @foreach ($products as $product)
                                <option
                                    value="{{ $product->id }}_{{ $product->sale_price }}_{{ $product->category->companyTax->percentage->percentage }}">
                                    {{ $product->code }}_{{ $product->name }}</option>
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
                <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-lightBlueGrad" type="button" id="add" data-toggle="tooltip"
                            data-placement="top" title="Add"><i class="fas fa-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addObservation">
                    <div class="form-group">
                        <label class="form-control-label" for="note">Observaciones</label>
                        <input type="text" id="note" name="note" class="form-control"
                            placeholder="Observaciones">
                    </div>
                </div>
                @include('admin/generalview.form_register')
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Eliminar</th>
                                <th>Editar</th>
                                <th>ed</th>
                                <th>Ref</th>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Cant.</th>
                                <th>precio</th>
                                <th>IVA/INC</th>
                                <th>%</th>
                                <th>SubTotal</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="10" class="rightfoot">TOTAL:</th>
                                <td class="rightfoot"><strong id="total_html">$ 0.00</strong>
                                    <input type="hidden" name="total" id="total">
                                </td>
                            </tr>
                            <tr>
                                <th colspan="10" class="rightfoot">IMPUESTO:</th>
                                <td class="rightfoot"><strong id="total_tax_html">$ 0.00</strong>
                                    <input type="hidden" name="total_tax" id="total_tax">
                                </td>
                            </tr>
                            <tr>
                                <th colspan="10" class="rightfoot">TOTAL PAGAR:</th>
                                <td class="rightfoot"><strong id="total_pay_html">$ 0.00</strong>
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
</div>
<div class="box-body row" id="noLook">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editSugestedPrice">
        <div class="form-group">
            <label class="form-control-label" for="suggested_price">P/sugerido</label>
            <input type="number" id="suggested_price" name="suggested_price" class="form-control"
                placeholder="Precio sugerido" disabled>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="addInc">
        <div class="form-group">
            <label class="form-control-label" for="tax_rate">INC</label>
            <input type="number" id="tax_rate" name="tax_rate" class="form-control" placeholder="Impuesto"
                disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="taxType">
        <div class="form-group">
            <label class="form-control-label" for="tax_type">Tipo Impuesto</label>
            <input type="number" id="tax_type" name="tax_type" class="form-control" value="0" disabled
                pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="addPriceWithTax">
        <div class="form-group">
            <label class="form-control-label" for="pwx">Precio con impuesto</label>
            <input type="text" id="pwx" name="pwx" class="form-control"
                value="{{ indicator()->price_with_tax }}">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="serviceOld">
        <div class="form-group">
            <label class="form-control-label" for="service">Servicio</label>
            <input type="number" id="service" name="service" value="{{ $service }}" class="form-control"
                placeholder="Servicio" pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editSugestedPrice">
        <div class="form-group">
            <label class="form-control-label" for="suggested_price">P/sugerido</label>
            <input type="number" id="suggested_price" name="suggested_price" class="form-control"
                placeholder="Precio sugerido" disabled>
        </div>
    </div>
</div>
