<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="account_id">Grupo</label>
        <div class="select">
            <select id="account_id" name="account_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($subaccount->account_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Cuenta</option>
                @foreach($accounts as $account)
                    @if($account->id == ($subaccount->account_id ?? ''))
                        <option value="{{ $account->id }}" selected>{{ $account->name }}</option>
                    @else
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $subaccount->code ?? '') }}" placeholder="code">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre Subcuenta</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $subaccount->name ?? '') }}" placeholder="subaccount">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
        <a href="{{url('subaccount')}}" class="btn btn-blueGrad btn-md"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
    </div>
</div>
