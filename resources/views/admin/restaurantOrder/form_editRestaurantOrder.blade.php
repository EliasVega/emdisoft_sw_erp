<div class="box-body row">
    @if ($service == 1)
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="editName">
            <div class="form-group">
                <label class="form-control-label" for="name">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name', $restaurantOrder->homeOrder->name ?? '') }}"
                    class="form-control" placeholder="Direccion">
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="editAddress">
            <div class="form-group">
                <label class="form-control-label" for="address">Direccion</label>
                <input type="text" id="address" name="address" value="{{ old('address', $restaurantOrder->homeOrder->address ?? '') }}"
                    class="form-control" placeholder="Direccion">
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="editPhone">
            <div class="form-group">
                <label class="form-control-label" for="phone">Telefono</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $restaurantOrder->homeOrder->phone ?? '') }}"
                    class="form-control" placeholder="Telefono">
            </div>
        </div>
    @endif
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editSugestedPrice">
        <div class="form-group">
            <label class="form-control-label" for="suggested_price">P/sugerido</label>
            <input type="number" id="suggested_price" name="suggested_price" class="form-control"
                placeholder="Precio sugerido" disabled>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editTax_rate">
        <div class="form-group">
            <label class="form-control-label" for="tax_rate">Imp %</label>
            <input type="number" id="tax_rate" name="tax_rate" class="form-control" placeholder="Impuesto" disabled
                pattern="[0-9]{0,15}">
        </div>
    </div>
</div>
<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addProduct">
        <div class="form-group row">
            <label class="form-control-label" for="product_id">Menu</label>
            <select name="product_id" class="form-control selectpicker" id="product_id"
                data-live-search="true">
                <option value="" disabled selected>Seleccionar el Menu</option>
                @foreach($products as $product)
                <option
                    value="{{ $product->id }}_{{ $product->sale_price }}_{{ $product->category->companyTax->percentage->percentage }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-4 col-xs-12" id="editQuantity">
        <div class="form-group">
            <label class="form-control-label" for="quantity">Cantidad</label>
            <input type="number" id="quantity" name="quantity" value=""
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
