<div class="box-body row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="liability_id">Responsabilidad fiscal</label>
        <div class="select">
            <select id="liability_id" name="liability_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($provider->liability_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Responsabilidad</option>
                @foreach($liabilities as $liability)
                    @if($liability->id == ($provider->liability_id ?? ''))
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
                <option {{ ($provider->organization_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Tipo Organizacion</option>
                @foreach($organizations as $organization)
                    @if($organization->id == ($provider->organization_id ?? ''))
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
                <option {{ ($provider->regime_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Tipo Identificacion</option>
                @foreach($regimes as $regime)
                    @if($regime->id == ($provider->regime_id ?? ''))
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
                <option {{ ($provider->identification_type_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Tipo Identificacion</option>
                @foreach($identificationTypes as $identificationType)
                    @if($identificationType->id == ($provider->identification_type_id ?? ''))
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
            <label for="identification">Numero Identificacion</label>
            <input type="text" name="identification" id="identification" value="{{ old('identification', $provider->identification ?? '') }}" class="form-control" placeholder="Identifiacion ">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="dv">D.V.</label>
            <input type="text" name="dv" id="dv" value="{{ old('dv', $provider->dv ?? '') }}" class="form-control" placeholder="dv">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre del Proveedor</label>
            <input type="text" name="name" value="{{ old('name', $provider->name ?? '') }}" class="form-control" placeholder="Nombre del proveedor">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="address">Direccion</label>
            <input type="text" name="address" value="{{ old('address', $provider->address ?? '') }}" class="form-control" placeholder="Direccion">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email', $provider->email ?? '') }}" class="form-control" placeholder="Email">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="phone">Telefono</label>
            <input type="text" name="phone" value="{{ old('phone', $provider->phone ?? '') }}" class="form-control" placeholder="Telefono">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="department_id">Departamento</label>
        <div class="select">
            <select id="department_id" name="department_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($provider->department_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar departamento</option>
                @foreach($departments as $department)
                    @if($department->id == ($provider->municipality->department_id ?? ''))
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
                <option {{ ($provider->municipality_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar municipio</option>
                @if(($municipalities ?? '') != null)
                    @foreach($municipalities as $municipality)
                        @if($municipality->id == ($provider->municipality_id ?? ''))
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
            <label for="postal_code">Codigo Postal</label>
            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $provider->postal_code ?? '') }}" class="form-control" placeholder="Codigo Postal">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="merchant_registration">Registro Meracantil</label>
            <input type="text" name="merchant_registration" value="{{ old('merchant_registration', $provider->merchan_registration ?? '000000-00') }}" class="form-control" placeholder="Registro Mercantil">
        </div>
    </div>
    <div class="col-lg- col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="contact">Nombre de contacto</label>
            <input type="text" name="contact" value="{{ old('contact', $provider->contact ?? '') }}" class="form-control" placeholder="contacto">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="phone_contact">Telefono Contacto</label>
            <input type="text" name="phone_contact" value="{{ old('phone_contact', $provider->phone_contact ?? '') }}" class="form-control" placeholder="Telefono del contacto">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="submit"><i class="fa fa-save"></i> Guardar</button>
            <a href="{{url('expense/create')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
