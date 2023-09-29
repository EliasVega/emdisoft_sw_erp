<div class="box-body row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label class="form-control-label" for="box">Efectivo Caja</label>
            <input type="number" id="box" name="box" value="{{ $cashRegister->cash_in_total - $cashRegister->cash_out_total }}" class="form-control"
                placeholder="Efectivo" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group" id="valorcito">
            <label class="form-control-label" for="cash">Efectivo</label>
            <input type="number" id="cash" name="cash" value="{{ old('cash', $cashInflow->cash ?? '') }}" class="form-control"
                placeholder="Efectivo" pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-12 col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="reason">Razon</label>
            <input type="text" id="reason" name="reason" value="{{ old('reason', $cashOutflow->reason ?? '') }}" class="form-control"
                placeholder="Motivo">
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <label for="admin_id">quien Recibe</label>
        <div class="select">
            <select id="admin_id" name="admin_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($casOutflow->admin_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar...</option>
                @foreach($users as $user)
                    @if($user->id == ($cashOutflow->admin_id ?? ''))
                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                    @else
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group">
            <label class="form-control-label" for="admin">Codigo de verificacion</label>
            <input type="password" id="admin" name="admin" value="" class="form-control"
                placeholder="Codigo Verificacion">
        </div>
    </div>

    <div class="col-12 col-md-12">
        <div class="form-group" id="save">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Aceptar</button>
            <a href="{{url('cashOutflow')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
