<div class="box-body row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="liability_id">Responsabilidad fiscal</label>
        <div class="select">
            <select id="liability_id" name="liability_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($customer->liability_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Responsabilidad</option>
                @foreach($liabilities as $liability)
                    @if($liability->id == ($customer->liability_id ?? ''))
                        <option value="{{ $liability->id }}" selected>{{ $liability->name }}</option>
                    @else
                        <option value="{{ $liability->id }}">{{ $liability->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="organization_id">Tipo Organizacion</label>
        <div class="select">
            <select id="organization_id" name="organization_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($customer->organization_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Tipo Organizacion</option>
                @foreach($organizations as $organization)
                    @if($organization->id == ($customer->organization_id ?? ''))
                        <option value="{{ $organization->id }}" selected>{{ $organization->name }}</option>
                    @else
                        <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="regime_id">Regimen</label>
        <div class="select">
            <select id="regime_id" name="regime_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($customer->regime_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Tipo Identificacion</option>
                @foreach($regimes as $regime)
                    @if($regime->id == ($customer->regime_id ?? ''))
                        <option value="{{ $regime->id }}" selected>{{ $regime->name }}</option>
                    @else
                        <option value="{{ $regime->id }}">{{ $regime->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="identification_type_id">Tipo Identificacion</label>
        <div class="select">
            <select id="identification_type_id" name="identification_type_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($customer->identification_type_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Tipo Identificacion</option>
                @foreach($identificationTypes as $identificationType)
                    @if($identificationType->id == ($customer->identification_type_id ?? ''))
                        <option value="{{ $identificationType->id }}" selected>{{ $identificationType->name }}</option>
                    @else
                        <option value="{{ $identificationType->id }}">{{ $identificationType->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="identification">Identificacion</label>
            <input type="text" name="identification" id="identification" value="{{ old('identification', $customer->identification ?? '') }}" class="form-control" placeholder="Identificacion">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="dv">DV</label>
            <input type="text" name="dv" id="dv" value="{{ old('dv', $customer->dv ?? '') }}" class="form-control" placeholder="DV">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre del Cliente</label>
            <input type="text" name="name" value="{{ old('name', $customer->name ?? '') }}" class="form-control" placeholder="Ingrese el nombre del Cliente">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="address">Direccion</label>
            <input type="text" name="address" value="{{ old('address', $customer->address ?? '') }}" class="form-control" placeholder="Direccion">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="department_id">Departamento</label>
        <div class="select">
            <select id="department_id" name="department_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($customer->department_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar departamento</option>
                @foreach($departments as $department)
                    @if($department->id == ($customer->municipality->department_id ?? ''))
                        <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                    @else
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="municipality_id">Municipio</label>
        <div class="select">
            <select id="municipality_id" name="municipality_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($customer->municipality_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar municipio</option>
                @if(($municipalities ?? '') != null)
                    @foreach($municipalities as $municipality)
                        @if($municipality->id == ($customer->municipality_id ?? ''))
                            <option value="{{ $municipality->id }}" selected>{{ $municipality->name }}</option>
                        @else
                            <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email', $customer->email ?? '') }}" class="form-control" placeholder="Correo electronico">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="phone">Telefono</label>
            <input type="text" name="phone" value="{{ old('phone', $customer->phone ?? '') }}" class="form-control" placeholder="Telefono">
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="credit_limit">Cupo Asignado</label>
            <input type="number" name="credit_limit" value="{{ old('credit_limit', $customer->credit_limit ?? '') }}" class="form-control" placeholder="Cupo asignado">
        </div>
    </div>



    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-celeste mt-2" type="submit"><i class="fa fa-save"></i> Guardar</button>
            <a href="{{url('customer')}}" class="btn btn-gris mt-2"><i class="fa fa-window-close"></i> Cancelar</a>
        </div>
    </div>
</div>
