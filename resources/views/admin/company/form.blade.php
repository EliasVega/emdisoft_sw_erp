<div class="box-body row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <label for="identification_type_id">Tipo de identificacion</label>
        <div class="select">
            <select id="identification_type_id" name="identification_type_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($company->identification_type_id ?? '') == '' ? "selected" : "" }} disabled>Tipo de Identificacion</option>
                @foreach($identificationTypes as $identificationType)
                    @if($identificationType->id == ($company->identification_type_id ?? ''))
                        <option value="{{ $identificationType->id }}" selected>{{ $identificationType->name }}</option>
                    @else
                        <option value="{{ $identificationType->id }}">{{ $identificationType->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="nit">Nit</label>
            <input type="text" name="nit" value="{{ old('nit', $company->nit ?? '') }}" class="form-control" placeholder="Nit" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="dv">DV</label>
            <input type="text" name="dv" value="{{ old('dv', $company->dv ?? '') }}" class="form-control" placeholder="DV" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="name">Compañia</label>
            <input type="text" name="name" value="{{ old('name', $company->name ?? '') }}" class="form-control" placeholder="Nombre" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="address">Direccion</label>
            <input type="text" name="address" value="{{ old('address', $company->address ?? '') }}" class="form-control" placeholder="Direccion" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="phone">Telefono</label>
            <input type="text" name="phone" value="{{ old('phone', $company->phone ?? '') }}" class="form-control" placeholder="Telefono" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="api_token">Api Token</label>
            <input type="text" name="api_token" value="{{ old('api_token', $company->api_token ?? '') }}" class="form-control" placeholder="Api_token" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <label for="department_id">Departamento</label>
        <div class="select">
            <select id="department_id" name="department_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($company->municipality->department_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar departamento</option>
                @foreach($departments as $department)
                    @if($department->id == ($company->municipality->department_id ?? ''))
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
                <option {{ ($company->municipality_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar municipio</option>
                @if(($municipalities ?? '') != null)
                    @foreach($municipalities as $municipality)
                        @if($municipality->id == ($company->municipality_id ?? ''))
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
        <label for="liability_id">Responsabilidad Fiscal</label>
        <div class="select">
            <select id="liability_id" name="liability_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($company->liability_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar R. Fiscal</option>
                @foreach($liabilities as $liability)
                    @if($liability->id == ($company->liability_id ?? ''))
                        <option value="{{ $liability->id }}" selected>{{ $liability->name }}</option>
                    @else
                        <option value="{{ $liability->id }}">{{ $liability->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <label for="organization_id">Organizacion</label>
        <div class="select">
            <select id="organization_id" name="organization_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($company->organization_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Organizacion</option>
                @foreach($organizations as $organization)
                    @if($organization->id == ($company->organization_id ?? ''))
                        <option value="{{ $organization->id }}" selected>{{ $organization->name }}</option>
                    @else
                        <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <label for="regime_id">Regimen</label>
        <div class="select">
            <select id="regime_id" name="regime_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($company->regime_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Regimen</option>
                @foreach($regimes as $regime)
                    @if($regime->id == ($company->regime_id ?? ''))
                        <option value="{{ $regime->id }}" selected>{{ $regime->name }}</option>
                    @else
                        <option value="{{ $regime->id }}">{{ $regime->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email', $company->email ?? '') }}" class="form-control" placeholder="Ingrese el correo electronico">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="emailfe">Email de Fact Electronica</label>
            <input type="email" name="emailfe" value="{{ old('emailfe', $company->emailfe ?? '') }}" class="form-control" placeholder="Ingrese el email FE">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" id="logo" name="logo" data-initial-preview="{{ old('logo', $company->logo ?? '') }}" accept="image/*" data-msg-placeholder="Seleccionar archivo"/>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i> Guardar</button>
            <a href="{{url('company')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
