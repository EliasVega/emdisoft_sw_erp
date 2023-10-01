<div class="card-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Código</label>
            <input type="text" id="code" name="code" value="{{ old('code', $voucherType->code ?? '') }}" class="form-control" placeholder="Código" required>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name', $voucherType->name ?? '') }}" class="form-control" placeholder="Nombre" required>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="consecutive">Consecutivo</label>
            <input type="number" id="consecutive" name="consecutive" value="{{ old('consecutive', $voucherType->consecutive ?? '') }}" placeholder="Consecutivo" class="form-control" require>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="status">Estado</label>
            <select name="status" id="status" class="form-control" required>
                <option {{ ($voucherType->status ?? '') == '' ? "selected" : "" }}></option>
                <option  selected="selected" value="active" {{ old('status', $voucherType->status ?? '') == 'active' ? "selected" : "" }}>Activo</option>
                <option value="inactive" {{ old('status', $voucherType->status ?? '') == 'inactive' ? "selected" : "" }}>Inactivo</option>
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('voucherType')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
