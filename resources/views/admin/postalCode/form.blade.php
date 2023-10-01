<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="department_id">Municipio</label>
        <div class="select">
            <select id="department_id" name="department_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($postalCode->municipality->department->id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Departamento</option>
                @foreach($departments as $department)
                    @if($department->id == ($postalCode->municipality->department->id ?? ''))
                        <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                    @else
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="municipality_id">Municipio</label>
        <div class="select">
            <select id="municipality_id" name="municipality_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($postalCode->municipality_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Municipio</option>
                @foreach($municipalities as $municipality)
                    @if($municipality->id == ($postalCode->municipality_id ?? ''))
                        <option value="{{ $municipality->id }}" selected>{{ $municipality->name }}</option>
                    @else
                        <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="postal_code">Codigo</label>
            <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $postalCode->postal_code ?? '') }}" placeholder="codigo">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
        <a href="{{url('postalCode')}}" class="btn btn-blueGrad btn-md"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
    </div>
</div>
