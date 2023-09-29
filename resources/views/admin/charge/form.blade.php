<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Cargo</label>
            <input type="text" name="name" value="{{ old('name', $charge->name ?? '') }}" class="form-control" placeholder="Cargo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="description">Descripcion</label>
            <input type="text" name="description" value="{{ old('description', $charge->description ?? '') }}" class="form-control" placeholder="Descripcion">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
        <label for="status">Estado</label>
        <select name="status" id="status" class="form-control" required>
            <option {{ ($charge->status ?? '') == '' ? "selected" : "" }}></option>
            <option  selected="selected" value="active" {{ old('status', $charge->status ?? '') == 'active' ? "selected" : "" }}>Activo</option>
            <option value="inactive" {{ old('status', $charge->status ?? '') == 'inactive' ? "selected" : "" }}>Inactivo</option>
        </select>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('charge')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
