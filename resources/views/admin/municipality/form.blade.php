<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="department_id">Departamento</label>
        <div class="select">
            <select id="department_id" name="department_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($municipality->department_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar departamento</option>
                @foreach($departments as $department)
                    @if($department->id == ($municipality->department_id ?? ''))
                        <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                    @else
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $municipality->code ?? '') }}" placeholder="code">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Municipio</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $municipality->name ?? '') }}" placeholder="municipality">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
        <a href="{{url('municipality')}}" class="btn btn-blueGrad btn-md"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
    </div>
</div>
