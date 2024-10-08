<div class="box-body row">
    <div class="col-md-4" id="formCard">
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12" id="addCustomer">
                    <div class="form-group">
                        <label for="customer_id"> Cliente </label>
                        <select name="customer_id" class="form-control selectpicker" id="customer_id"
                            data-live-search="true">
                            <option value="" disabled selected>Seleccionar</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->identification }} -
                                    {{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addProduct">
                    <div class="form-group">
                        <label class="form-control-label" for="product_id">Menu</label>
                        <select name="product_id" class="form-control selectpicker" id="product_id"
                            data-live-search="true">
                            <option value="" disabled selected>Seleccionar el Menu</option>
                            @foreach($products as $product)
                            <option
                                value="{{ $product->id }}_{{ $product->sale_price }}_{{ $product->category->companyTax->percentage->percentage }}">{{ $product->code }}_{{ $product->name }}</option>
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
                        <label class="form-control-label">Add</label><br>
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
                                <th>Ref</th>
                                <th>id</th>
                                <th>Menu</th>
                                <th>Cantidad</th>
                                <th>precio</th>
                                <th>Impuesto</th>
                                <th>%</th>
                                <th>SubTotal</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="8" class="rightfoot">TOTAL:</th>
                                <td class="rightfoot"><strong id="total_html">$ 0.00</strong>
                                    <input type="hidden" name="total" id="total"></td>
                            </tr>
                            <tr>
                                <th colspan="8" class="rightfoot">IMPUESTO:</th>
                                <td class="rightfoot"><strong id="total_tax_html">$ 0.00</strong>
                                    <input type="hidden" name="total_tax" id="total_tax">
                                </td>
                            </tr>
                            <tr>
                                <th colspan="8" class="rightfoot">TOTAL PAGAR:</th>
                                <td class="rightfoot"><strong id="total_pay_html">$ 0.00</strong>
                                    <input type="hidden" name="total_pay" id="total_pay"></td>
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
<div class="box-body row" id="invoicenegative">
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
            <input type="number" id="tax_rate" name="tax_rate" class="form-control" placeholder="Impuesto" disabled
                pattern="[0-9]{0,15}">
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
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editSugestedPrice">
        <div class="form-group">
            <label class="form-control-label" for="suggested_price">P/sugerido</label>
            <input type="number" id="suggested_price" name="suggested_price" class="form-control"
                placeholder="Precio sugerido" disabled>
        </div>
    </div>
</div>

