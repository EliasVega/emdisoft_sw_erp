<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="account_class_id">Clase</label>
        <div class="select">
            <select id="account_class_id" name="account_class_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($accountGroup->account_class_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Clase</option>
                @foreach($accountClasses as $accountClass)
                    @if($accountClass->id == ($accountGroup->account_class_id ?? ''))
                        <option value="{{ $accountClass->id }}" selected>{{ $accountClass->name }}</option>
                    @else
                        <option value="{{ $accountClass->id }}">{{ $accountClass->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $accountGroup->code ?? '') }}" placeholder="code">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre Grupo</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $accountGroup->name ?? '') }}" placeholder="accountGroup">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
        <a href="{{url('accountGroup')}}" class="btn btn-blueGrad btn-md"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
    </div>
</div>
