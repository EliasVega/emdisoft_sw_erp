<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="account_group_id">Grupo</label>
        <div class="select">
            <select id="account_group_id" name="account_group_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($account->account_group_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Grupo</option>
                @foreach($accountGroups as $accountGroup)
                    @if($accountGroup->id == ($account->account_group_id ?? ''))
                        <option value="{{ $accountGroup->id }}" selected>{{ $accountGroup->name }}</option>
                    @else
                        <option value="{{ $accountGroup->id }}">{{ $accountGroup->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $account->code ?? '') }}" placeholder="code">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre Cuenta</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $account->name ?? '') }}" placeholder="account">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
        <a href="{{url('account')}}" class="btn btn-blueGrad btn-md"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
    </div>
</div>
