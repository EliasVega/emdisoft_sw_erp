<div class="box-body row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <label for="department_id">Departamento</label>
        <div class="select">
            <select id="department_id" name="department_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($branch->municipality->department_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar departamento</option>
                @foreach($departments as $department)
                    @if($department->id == ($branch->municipality->department_id ?? ''))
                        <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                    @else
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <label for="municipality_id">Municipio</label>
        <div class="select">
            <select id="municipality_id" name="municipality_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($branch->municipality_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar municipio</option>
                @if(($municipalities ?? '') != null)
                    @foreach($municipalities as $municipality)
                        @if($municipality->id == ($branch->municipality_id ?? ''))
                            <option value="{{ $municipality->id }}" selected>{{ $municipality->name }}</option>
                        @else
                            <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $branch->name ?? '') }}" class="form-control" placeholder="nombre" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="address">Direccion Sucursal</label>
            <input type="text" name="address" value="{{ old('address', $branch->address ?? '') }}" class="form-control" placeholder="Direccion" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email', $branch->email ?? '') }}" class="form-control" placeholder="Ingrese el correo electronico">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="manager">Gerente o Administrador</label>
            <input type="text" name="manager" value="{{ old('manager', $branch->manager ?? '') }}" class="form-control" placeholder="name del Gerente o Administrador" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="phone">Telefono Sucursal</label>
            <input type="text" name="phone" value="{{ old('phone', $branch->phone ?? '') }}" class="form-control" placeholder="Telefono" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="mobile">Celular Sucursal</label>
            <input type="text" name="mobile" value="{{ old('mobile', $branch->mobile ?? '') }}" class="form-control" placeholder="Celular" required>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('branch')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
