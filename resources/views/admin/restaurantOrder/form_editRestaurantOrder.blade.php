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
    <div class="col-md-6">
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
            </div>
        </div>
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
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="raw_material_id">Materia Prima</label>
                        <select name="raw_material_id" class="form-control selectpicker" data-live-search="true" id="raw_material_id">
                            <option value="{{ old('raw_material_id') }}" disabled selected>Seleccionar.</option>
                            @foreach($rawMaterials as $rawMaterial)
                                <option value="{{ $rawMaterial->id }}_{{ $rawMaterial->price }}">{{ $rawMaterial->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="editMaterialId">
                    <div class="form-group">
                        <label for="material_id">Materia Prima</label>
                        <select name="material_id" class="form-control selectpicker" data-live-search="true" id="material_id">
                            <option value="{{ old('material_id') }}" disabled selected>Seleccionar.</option>
                            @foreach($rawMaterials as $rawMaterial)
                                <option value="{{ $rawMaterial->id }}">{{ $rawMaterial->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="idProductRaw">
                    <div class="form-group">
                        <label for="idProduct">idProdut</label>
                        <input type="text" name="idProduct" value="" id="idProduct" class="form-control"  placeholder="idProduct">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="quantityrm">Cantidad</label>
                        <input type="text" name="quantityrm" value="" id="quantityrm" class="form-control" placeholder="Cantidad">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="consumer_price">Precio</label>
                        <input type="text" name="consumer_price" value="0" id="consumer_price" class="form-control" placeholder="Precio">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="addReferency">
                    <div class="form-group">
                        <label for="referency">Referencia</label>
                        <input type="text" name="referency" id="referency" class="form-control"  placeholder="Referencia">
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label">Adicionar</label><br>
                        <button class="btn btn-lightBlueGrad" type="button" id="addrm" data-toggle="tooltip" data-placement="top" title="Adicionar"><i class="fas fa-check"></i> </button>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" >Canc</label><br>
                        <a href="{{url('product')}}" class="btn btn-blueGrad" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i></a>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table id="materials" class="table table-striped table-bordered table-condensed table-hover">
                            <thead class="bg-info">
                                <tr>
                                    <th>Eliminar</th>
                                    <th>Editar</th>
                                    <th>Ref</th>
                                    <th>idP</th>
                                    <th>Id</th>
                                    <th>Materia Prina</th>
                                    <th>Cantidad</th>
                                    <th>Valor</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="8">
                                        <p align="right">TOTAL:</p>
                                    </th>
                                    <th>
                                        <p align="right"><span id="totalrm_html">$ 0.00</span>
                                            <input type="hidden" name="totalrm" id="totalrm"> </p>
                                    </th>
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
</div>
