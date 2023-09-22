<div class="box-body row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3" >
        <label for="type_tax">Tipo de Impuesto:</label>
        <select name="type_tax" id="type_tax" class="form-select" aria-label="Default select example">
            <option {{ old('type_tax', $taxType->type_tax ?? '') == '' ? "selected" : "" }} disabled>Seleccionar tipo</option>
            <option value="1">Impuesto a linea</option>
            <option value="2">Retencion</option>
            <option value="3">Impuesto al total</option>
        </select>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
            <button class="btn btn-celeste btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('taxType')}}" class="btn btn-gris"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
