<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="subauxiliary_account_id">Grupo</label>
        <div class="select">
            <select id="subauxiliary_account_id" name="subauxiliary_account_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($subauxiliaryAccount->auxiliary_account_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Cta Auxiliar</option>
                @foreach($auxiliaryAccounts as $auxiliaryAccount)
                    @if($auxiliaryAccount->id == ($subauxiliaryAccount->auxiliary_account_id ?? ''))
                        <option value="{{ $auxiliaryAccount->id }}" selected>{{ $auxiliaryAccount->name }}</option>
                    @else
                        <option value="{{ $auxiliaryAccount->id }}">{{ $auxiliaryAccount->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $subauxiliaryAccount->code ?? '') }}" placeholder="code">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre Cuenta Sub Auxiliar</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $subauxiliaryAccount->name ?? '') }}" placeholder="subauxiliaryAccount">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
        <a href="{{url('subauxiliaryAccount')}}" class="btn btn-blueGrad btn-md"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
    </div>
</div>
