<div class="box-body row">
    @if ($service == 1)
        <div class="col-md-12" id="formServiceDom">
            <div class="card card-primary card-outline">
                @include('admin/restaurantOrder.form_edit_home_order')
            </div>
        </div>
    @else
        <div class="col-md-12" id="formServiceDom">
            <div class="card card-primary card-outline">
                @include('admin/restaurantOrder.form_table')
            </div>
        </div>
    @endif
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="serviceOld">
                    <div class="form-group">
                        <label class="form-control-label" for="service">Servicio</label>
                        <input type="number" id="service" name="service" value="{{ $service }}" class="form-control" placeholder="Servicio" pattern="[0-9]{0,15}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editSugestedPrice">
                    <div class="form-group">
                        <label class="form-control-label" for="suggested_price">P/sugerido</label>
                        <input type="number" id="suggested_price" name="suggested_price" class="form-control"
                            placeholder="Precio sugerido" disabled>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editTax_rate">
                    <div class="form-group">
                        <label class="form-control-label" for="tax_rate">INC %</label>
                        <input type="number" id="tax_rate" name="tax_rate" class="form-control" placeholder="Impuesto" disabled
                            pattern="[0-9]{0,15}">
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
                                value="{{ $product->id }}_{{ $product->sale_price }}_{{ $product->category->companyTax->percentage->percentage }}">{{ $product->code }}_+_{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-4 col-xs-12" id="editQuantity">
                    <div class="form-group">
                        <label class="form-control-label" for="quantity">Cantidad</label>
                        <input type="number" id="quantity" value="1" name="quantity" value=""
                            class="form-control" placeholder="Cantidad" pattern="[0-9]{0,15}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-4 col-xs-12" id="editSalePrice">
                    <div class="form-group">
                        <label class="form-control-label" for="sale_price">Precio</label>
                        <input type="number" id="sale_price" name="sale_price" class="form-control"
                            placeholder="Precio de venta">
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12" id="editAdd">
                    <div class="form-group">
                        <label class="form-control-label">Add</label><br>
                        <button class="btn btn-lightBlueGrad" type="button" id="add" data-toggle="tooltip" data-placement="top" title="Add"><i class="fas fa-check"></i>&nbsp; </button>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12" id="editCanc">
                    <div class="form-group">
                        <label class="form-control-label" >Canc</label><br>
                        <a href="{{url('restaurantOrder')}}" class="btn btn-blueGrad" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i>&nbsp; </a>
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
                            <th>Cantidad</th>
                            <th>precio ($)</th>
                            <th>%Imp ($)</th>
                            <th>SubTotal ($)</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="9" class="rightfoot">TOTAL:</th>
                            <td class="rightfoot"><strong id="total_html">$ 0.00</strong>
                                <input type="hidden" name="total" id="total"></td>
                        </tr>
                        <tr>
                            <th colspan="9" class="rightfoot">IMPUESTO:</th>
                            <td class="rightfoot"><strong id="total_tax_html">$ 0.00</strong>
                                <input type="hidden" name="total_tax" id="total_tax">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="9" class="rightfoot">TOTAL PAGAR:</th>
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

