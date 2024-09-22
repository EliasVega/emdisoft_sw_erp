<div class="box-body row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="name_product">Nombre del product</label>
                        <input type="text" name="name_product" id="name_product" class="form-control" placeholder="Nombre del producto" required>
                    </div>
                </div>
                <div class="col-lg-12 col-md-8 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="codepm">Codigo</label>
                        <input type="text" name="codepm" id="codepm" class="form-control" placeholder="Codigo" aria-describedby="helpId" required>
                    </div>
                </div>
                @if (indicator()->barcode == 'on')
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4 switchBarcode">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="switch_barcodepm" checked>
                                <label class="custom-control-label" for="switch_barcode">Codigo de barras</label>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="addPricePurchase">
                    <div class="form-group">
                        <label for="pricepm">P/Compra</label>
                        <input type="number" name="pricepm" id="pricepm" value="0"  class="form-control" placeholder="P/compra" step="any">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="sale_pricepm">P/Venta</label>
                        <input type="number" name="sale_pricepm" id="sale_pricepm" value="0" class="form-control" placeholder="P/Venta" step="any">
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="category_id">Categorias</label>
                    <div class="select">
                        <select id="category_id" name="category_id" class="form-control selectpicker" data-live-search="true" required>
                            <option {{ ($product->category_id ?? '') == '' ? "selected" : "" }} disabled>Categorias</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="measure_unit_id">Unidad de Medida</label>
                    <div class="select">
                        <select id="measure_unit_id" name="measure_unit_id" class="form-control selectpicker" data-live-search="true" required>
                            <option {{ ($product->measure_unit_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Medida</option>
                            @foreach($measureUnits as $measureUnit)
                                <option value="{{ $measureUnit->id }}">{{ $measureUnit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="type_productpm">Tipo de producto</label>
                    <div class="select">
                        <select id="type_productpm" name="type_productpm" class="form-control selectpicker" data-live-search="true" required>
                            <option {{ ($product->type_product ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Tipo</option>
                                <option value="product">PRODUCTO</option>
                                <option value="service">SERVICIO</option>
                                @if (indicator()->raw_material == 'on')
                                    <option value="consumer">CONSUMO /elaborados local</option>
                                @endif
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="stockpm">Stock</label>
                        <input type="number" name="stockpm" id="stockpm" value="0" class="form-control" placeholder="Stock">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="stock_minpm">Stock/min</label>
                        <input type="number" name="stock_minpm" id="stock_minpm" value="0" class="form-control" placeholder="Stock minimo">
                    </div>
                </div>
                @if (indicator()->work_labor == 'on' && indicator()->cmep == 'product')
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="commission">Comision</label>
                            <input type="number" name="commission" id="commission" value="{{ old('commission', $product->commission ?? '') }}" class="form-control" placeholder="comision" step="any">
                        </div>
                    </div>
                @else
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="commpm">
                        <div class="form-group">
                            <label for="commission">Comision</label>
                            <input type="number" name="commission" id="commission" value="0" class="form-control" placeholder="comision" step="any">
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

