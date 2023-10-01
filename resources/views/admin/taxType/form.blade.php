<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="type_tax">Tipo de impuesto</label>
        <div class="select">
            <select id="type_tax" name="type_tax" class="form-control selectpicker" data-live-search="true" required>
                <option {{ old('type_tax', $taxType->type_tax ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Responsabilidad</option>
                <option value="tax_item">Impuesto en Linea</option>
                <option value="retention">Retencion</option>
                <option value="tax_blobal">Impuesto al total</option>
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="number" name="code" value="{{ old('code', $taxType->code ?? '') }}" class="form-control" placeholder="Ingrese codigo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Tributo</label>
            <input type="text" name="name" value="{{ old('name', $taxType->name ?? '') }}" class="form-control" placeholder="Tributo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="description">Descripcion tipo de impuesto</label>
            <input type="text" name="description" value="{{ old('description', $taxType->description ?? '') }}" class="form-control" placeholder="Descripcion">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('taxType')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
