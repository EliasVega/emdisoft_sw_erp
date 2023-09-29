<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" value="{{ old('code', $discrepancy->code ?? '') }}" class="form-control" placeholder="Codigo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="type">Tipo</label>
            <input type="text" name="type" value="{{ old('type', $discrepancy->type ?? '') }}" class="form-control" placeholder="Tipo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="description">Descripcion</label>
            <input type="text" name="description" value="{{ old('description', $discrepancy->description ?? '') }}" class="form-control" placeholder="Descripcion ">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="status">Estado</label>
        <select name="status" id="status" class="form-control" required>
            <option {{ ($discrepancy->status ?? '') == '' ? "selected" : "" }}></option>
            <option  selected="selected" value="active" {{ old('status', $discrepancy->status ?? '') == 'active' ? "selected" : "" }}>Activo</option>
            <option value="inactive" {{ old('status', $discrepancy->status ?? '') == 'inactive' ? "selected" : "" }}>Inactivo</option>
        </select>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('discrepancy')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
