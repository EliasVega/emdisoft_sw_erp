<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="category_id">Categorias</label>
        <div class="select">
            <select id="category_id" name="category_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($product->category_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar categoria</option>
                @foreach($categories as $category)
                    @if($category->id == ($product->category_id ?? ''))
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" id="code" value="{{ old('code', $product->code ?? '') }}" class="form-control" placeholder="Codigo" aria-describedby="helpId">
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre del product</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" class="form-control" placeholder="Nombre del producto">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? '') }}" class="form-control" placeholder="Stock">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="stock_min">S/Minimo</label>
            <input type="number" name="stock_min" id="stock_min" value="{{ old('stock_min', $product->stock ?? '') }}" class="form-control" placeholder="Stock minimo">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="price">P/Compra</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? '') }}"  class="form-control" placeholder="P/compra">
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="sale_price">P/Venta</label>
            <input type="number" name="sale_price" id="sale_price" value="{{ old('sale_price', $product->sale_price ?? '') }}" class="form-control" placeholder="P/Venta">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="measure_unit_id">Unidad de Medida</label>
        <div class="select">
            <select id="measure_unit_id" name="measure_unit_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($product->measure_unit_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Medida</option>
                @foreach($measureUnits as $measureUnit)
                    @if($measureUnit->id == ($product->measure_unit_id ?? ''))
                        <option value="{{ $measureUnit->id }}" selected>{{ $measureUnit->name }}</option>
                    @else
                        <option value="{{ $measureUnit->id }}">{{ $measureUnit->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="type_product">Typo de producto</label>
        <div class="select">
            <select id="type_product" name="type_product" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($product->type_product ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Tipo</option>
                    <option value="product">PRODUCTO</option>
                    <option value="service">SERVICIO</option>
                    @if ($indicator->raw_material == 'on')
                        <option value="consumer">CONSUMO</option>
                    @endif
            </select>
        </div>
    </div>
</div>
