<div class="box-body row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="category_id">Categorias</label>
        <div class="select">
            <select id="category_id" name="category_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($rawMaterial->category_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar categoria</option>
                @foreach($categories as $category)
                    @if($category->id == ($rawMaterial->category_id ?? ''))
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="measure_unit_id">Unidad de Medida</label>
        <div class="select">
            <select id="measure_unit_id" name="measure_unit_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($rawMaterial->measure_unit_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Medida</option>
                @foreach($measureUnits as $measureUnit)
                    @if($measureUnit->id == ($rawMaterial->measure_unit_id ?? ''))
                        <option value="{{ $measureUnit->id }}" selected>{{ $measureUnit->name }}</option>
                    @else
                        <option value="{{ $measureUnit->id }}">{{ $measureUnit->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre Materia Prima</label>
            <input type="text" name="name" value="{{ old('name', $rawMaterial->name ?? '') }}" class="form-control" placeholder="Nombre">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" value="{{ old('code', $rawMaterial->code ?? '') }}" class="form-control" placeholder="Codigo">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="price">P/Compra</label>
            <input type="text" name="price" value="{{ old('price', $rawMaterial->price ?? '') }}" class="form-control" placeholder="Precio de Compra">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
        <label for="type_rawMaterial">Typo</label>
        <div class="select">
            <select id="type_product" name="type_product" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($rawMaterial->type_product ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Tipo</option>
                    <option value="product">PRODUCTO</option>
                    <option value="service">SERVICIO</option>
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md mt-3" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('rawMaterial')}}" class="btn btn-blueGrad mt-3"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
