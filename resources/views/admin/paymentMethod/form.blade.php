<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" value="{{ old('code', $paymentMethod->code ?? '') }}" class="form-control" placeholder="Ingrese Codigo">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Medio de pago</label>
            <input type="text" name="name" value="{{ old('name', $paymentMethod->name ?? '') }}" class="form-control" placeholder="Medio de Pago">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="status">Estado</label>
        <select name="status" id="status" class="form-control" required>
            <option {{ ($paymentMethod->status ?? '') == '' ? "selected" : "" }}></option>
            <option  selected="selected" value="active" {{ old('status', $paymentMethod->status ?? '') == 'active' ? "selected" : "" }}>Activo</option>
            <option value="inactive" {{ old('status', $paymentMethod->status ?? '') == 'inactive' ? "selected" : "" }}>Inactivo</option>
        </select>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('paymentMethod')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
