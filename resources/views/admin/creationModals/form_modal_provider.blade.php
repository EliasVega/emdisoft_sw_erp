<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <label class="form-control-label">
                <strong>Recuerde para envios a la dian de documento soporte es necesario llenar todos los campos</strong>
            </label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="identification_type_id" class="required">Tipo Identificacion</label>
        <div class="select">
            <select id="identification_type_id" name="identification_type_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($provider->identification_type_id ?? '') == '' ? "selected" : "" }} disabled>Tipo Identificacion</option>
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
    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
        <div class="form-group">
            <label for="identification" class="required">Identificacion</label>
            <input type="text" name="identification" id="identification" value="{{ old('identification', $provider->identification ?? '') }}" class="form-control" placeholder="Identifiacion " required>
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="dv" class="required">D.V.</label>
            <input type="text" name="dv" id="dv" value="{{ old('dv', $provider->dv ?? '') }}" class="form-control" placeholder="dv" required>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name" class="required">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $provider->name ?? '') }}" class="form-control" placeholder="Nombre del proveedor" required>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="email" class="required">Email</label>
            <input type="email" name="email" value="{{ old('email', $provider->email ?? '') }}" class="form-control" placeholder="Email" required>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="liability_id">Responsabilidad fiscal</label>
        <div class="select">
            <select id="liability_id" name="liability_id" class="form-control selectpicker" data-live-search="true">
                <option {{ ($provider->liability_id ?? '') == '' ? "selected" : "" }} disabled>Responsabilidad fiscal</option>
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
            <select id="organization_id" name="organization_id" class="form-control selectpicker" data-live-search="true">
                <option {{ ($provider->organization_id ?? '') == '' ? "selected" : "" }} disabled>Tipo Organizacion</option>
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
            <select id="regime_id" name="regime_id" class="form-control selectpicker" data-live-search="true">
                <option {{ ($provider->regime_id ?? '') == '' ? "selected" : "" }} disabled>Tipo Identificacion</option>
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
        <label for="department_id">Departamento</label>
        <div class="select">
            <select id="department_id" name="department_id" class="form-control selectpicker" data-live-search="true">
                <option {{ ($provider->department_id ?? '') == '' ? "selected" : "" }} disabled>Departamento</option>
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
            <select id="municipality_id" name="municipality_id" class="form-control selectpicker" data-live-search="true">
                <option {{ ($provider->municipality_id ?? '') == '' ? "selected" : "" }} disabled>Municipio</option>
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
        <label for="postal_code_id">Codigo Postal</label>
        <div class="select">
            <select id="postal_code_id" name="postal_code_id" class="form-control selectpicker" data-live-search="true">
                <option {{ ($provider->postal_code_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar</option>
                @if(($municipalities ?? '') != null)
                    @foreach($postalCodes as $postalCode)
                        @if($postalCode->id == ($provider->postal_code_id ?? ''))
                            <option value="{{ $postalCode->id }}" selected>{{ $postalCode->postal_code }}</option>
                        @else
                            <option value="{{ $postalCode->id }}">{{ $postalCode->postal_code }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
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
            <label for="phone">Telefono</label>
            <input type="text" name="phone" value="{{ old('phone', $provider->phone ?? '') }}" class="form-control" placeholder="Telefono">
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="merchant_registration">Registro Meracantil</label>
            <input type="text" name="merchant_registration" value="{{ old('merchant_registration', $provider->merchan_registration ?? '000000-00') }}" class="form-control" placeholder="Registro Mercantil">
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="contact">Nombre de contacto</label>
            <input type="text" name="contact" value="{{ old('contact', $provider->contact ?? '') }}" class="form-control" placeholder="contacto">
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="phone_contact">Telefono Contacto</label>
            <input type="text" name="phone_contact" value="{{ old('phone_contact', $provider->phone_contact ?? '') }}" class="form-control" placeholder="Telefono del contacto">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('provider')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="addType">
        <div class="form-group">
            <label for="type">Tipo provider</label>
            <input type="text" name="type" id="type" value="modal" class="form-control" placeholder="Tipo cliente">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="addStatus">
        <div class="form-group">
            <label for="status">Estado</label>
            <input type="text" name="status" id="status" value="active" class="form-control" placeholder="Estado">
        </div>
    </div>
</div>
