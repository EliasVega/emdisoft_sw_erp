<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="provider_id"> Proveedor <a href="{{ route('provider.create') }}" class="btn btn-lightBlueGrad btn-sm" target="_blank" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-plus"> Agregar Proveedor</i>
            </a></label>
            <select name="provider_id" class="form-control selectpicker" id="provider_id"
                data-live-search="true" required>
                <option value="" disabled selected>Seleccionar el Proveedor</option>
                @foreach($providers as $provider)
                <option value="{{ $provider->id }}">{{ $provider->number }} - {{ $provider->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="stock">Stock</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" class="form-control"
                placeholder="stock" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="tax_rate">IMP%</label>
            <input type="number" id="tax_rate" name="tax_rate" class="form-control" placeholder="% Impuesto" disabled
                pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="vprice">V/Actual</label>
            <input type="number" name="vprice" id="vprice"  class="form-control" readonly>
        </div>
    </div>
    @if ($indicator->barcode == 'on')
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mt-5 switchBarcode">
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="switch_barcode" checked>
                    <label class="custom-control-label" for="switch_barcode">C/barras</label>
                </div>
            </div>
        </div>
    @endif
</div>
<div class="box-body row">
    @if ($indicator->barcode == 'on')
        <div class="col-lg-2 col-md-4 col-sm-8 col-xs-12" id="codeBarcode">
            <div class="form-group">
                <label class="form-control-label" for="code">
                    Codigo <a href="{{ route('product.create') }}" class="btn btn-lightBlueGrad btn-xs"
                    target="_blank" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-plus"> Agregar Producto</i></a>
                </label>
                <input type="text" name="code" id="code" value="" class="form-control"
                    placeholder="" aria-describedby="helpId" class="gui-input" autofocus>

            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12" id="barcodeId">
            <div class="form-group">
                <label for="barcode_product_id">id Barcode</label>
                <input type="number" name="barcode_product_id" id="barcode_product_id" value=""
                    class="form-control" placeholder="">

            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12" id="productBarcode">
            <div class="form-group">
                <label for="product_barcode">Nombre</label>
                <input type="text" name="product_barcode" id="product_barcode" value=""
                    class="form-control" placeholder="">

            </div>
        </div>
    @endif
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="addProductId">
        <div class="form-group row">
            <label class="form-control-label" for="product_id">
                Producto <a href="{{ route('product.create') }}" class="btn btn-lightBlueGrad btn-xs"
                target="_blank" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-plus"> Agregar Producto</i></a>
            </label>
                <select name="product_id" class="form-control selectpicker" id="product_id" data-live-search="true">
                    <option value="0" disabled selected>Seleccionar</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}_{{ $product->stock }}_{{ $product->price }}_{{ $product->percentage }}_{{ $product->tt }}">{{ $product->code }} -- {{ $product->name }}</option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="quantityadd">Cantidad</label>
            <input type="number" id="quantityadd" name="quantityadd" value=""
                class="form-control" placeholder="Cantidad" pattern="[0-9]{0,15}" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="price">Precio</label>
            <input type="number" id="price" name="price" class="form-control"
                placeholder="Precio" pattern="[0-9]{0,15}" step="any">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="addTypeProduct">
        <div class="form-group">
            <label class="form-control-label" for="typeProduct">Typo Producto</label>
            <input type="text" id="typeProduct" name="typeProduct" class="form-control" value="{{ $typeProduct }}">
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
        <div class="form-group">
            <label class="form-control-label">Add</label><br>
            <button class="btn btn-lightBlueGrad" type="button" id="add" data-toggle="tooltip" data-placement="top" title="Add"><i class="fas fa-check"></i>&nbsp; </button>
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" >Canc</label><br>
            <a href="{{url('purchaseOrder')}}" class="btn btn-blueGrad" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i>&nbsp; </a>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Elim</th>
                        <th>edit</th>
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
                            <input type="hidden" name="total" id="total"></td>
                    </tr>
                    <tr>
                        <th colspan="7" class="rightfoot">IMPUESTOS:</th>
                        <td class="rightfoot thfoot"><strong id="total_tax_html">$ 0.00</strong>
                            <input type="hidden" name="total_tax" id="total_tax">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="7" class="rightfoot">TOTAL PAGAR:</th>
                        <td class="rightfoot thfoot"><strong id="total_pay_html">$ 0.00</strong>
                            <input type="hidden" name="total_pay" id="total_pay"></td>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    @include('admin/generalview.form_register')
</div>
