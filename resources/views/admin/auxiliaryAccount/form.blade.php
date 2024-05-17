<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="subaccount_id">Grupo</label>
        <div class="select">
            <select id="subaccount_id" name="subaccount_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($auxiliaryAccount->subaccount_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Subcuenta</option>
                @foreach($subaccounts as $subaccount)
                    @if($subaccount->id == ($auxiliaryAccount->subaccount_id ?? ''))
                        <option value="{{ $subaccount->id }}" selected>{{ $subaccount->name }}</option>
                    @else
                        <option value="{{ $subaccount->id }}">{{ $subaccount->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $auxiliaryAccount->code ?? '') }}" placeholder="code">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Grupo</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $auxiliaryAccount->name ?? '') }}" placeholder="auxiliaryAccount">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
        <a href="{{url('auxiliaryAccount')}}" class="btn btn-blueGrad btn-md"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
    </div>
</div>
