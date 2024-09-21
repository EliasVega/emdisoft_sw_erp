<div class="box-body row">
    <div class="col-md-12" id="formRequired">
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <label for="identification_type_id" class="required">Tipo Identificacion</label>
                    <div class="select">
                        <select id="identification_type_id" name="identification_type_id" class="form-control selectpicker" data-live-search="true" required>
                            <option value="3" selected>Seleccionar Tipo Identificacion</option>
                            @foreach($identificationTypes as $identificationType)
                                <option value="{{ $identificationType->id }}">{{ $identificationType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                    <div class="form-group">
                        <label for="identification" class="required">Identificacion</label>
                        <input type="text" name="identification" id="identification" value="{{ old('identification', $customer->identification ?? '') }}" class="form-control" placeholder="Identificacion" required>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for="dv">DV</label>
                        <input type="text" name="dv" id="dv" value="{{ old('dv', $customer->dv ?? '') }}" class="form-control" placeholder="DV">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="name_customer" class="required">Nombre</label>
                        <input type="text" name="name_customer" id="name_customer" class="form-control" autocomplete="on" placeholder="Ingrese el nombre del Cliente" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="email" class="required">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $customer->email ?? '') }}" class="form-control required" autocomplete="on" placeholder="Correo electronico" required>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="buttonAddOptions">
                    <div class="form-group">
                        <button class="btn btn-lightBlueGrad mt-2" type="button" id="addOptions" data-toggle="tooltip"
                            data-placement="top" title="Add"><i class="fas fa-check">Agregar Campos</i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="formOptional">
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <label for="liability_id">Responsabilidad fiscal</label>
                    <div class="select">
                        <select id="liability_id" name="liability_id" class="form-control selectpicker" data-live-search="true">
                            <option value="117" selected>Seleccionar Responsabilidad</option>
                            @foreach($liabilities as $liability)
                                <option value="{{ $liability->id }}">{{ $liability->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <label for="organization_id">Tipo Organizacion</label>
                    <div class="select">
                        <select id="organization_id" name="organization_id" class="form-control selectpicker" data-live-search="true">
                            <option value="2" selected>Seleccionar Tipo Persona</option>
                            @foreach($organizations as $organization)
                                <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <label for="regime_id">Regimen</label>
                    <div class="select">
                        <select id="regime_id" name="regime_id" class="form-control selectpicker" data-live-search="true">
                            <option value="2" selected>Seleccionar Tipo Identificacion</option>
                            @foreach($regimes as $regime)
                                <option value="{{ $regime->id }}">{{ $regime->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <label for="department_id">Departamento</label>
                    <div class="select">
                        <select id="department_id" name="department_id" class="form-control selectpicker" data-live-search="true">
                            <option value="21" selected>Seleccionar departamento</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <label for="municipality_id">Municipio</label>
                    <div class="select">
                        <select id="municipality_id" name="municipality_id" class="form-control selectpicker" data-live-search="true">
                            <option value="846" selected>Seleccionar municipio</option>
                            @if(($municipalities ?? '') != null)
                                @foreach($municipalities as $municipality)
                                    <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="address">Direccion</label>
                        <input type="text" name="address" id="address" value="{{ old('address', $customer->address ?? 'Bucaramanga') }}" class="form-control" autocomplete="on" placeholder="Direccion">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="phone">Telefono</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $customer->phone ?? '3165555555') }}" class="form-control" autocomplete="on" placeholder="Telefono">
                    </div>
                </div>
            
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="merchant_registration">Registro Meracantil</label>
                        <input type="text" name="merchant_registration" id="merchant_registration" value="{{ old('merchant_registration', $provider->merchan_registration ?? '000000-00') }}" class="form-control" placeholder="Registro Mercantil" required>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="credit_limit">Cupo Asignado</label>
                        <input type="number" name="credit_limit" id="credit_limit" value="{{ old('credit_limit', $customer->credit_limit ?? '0') }}" class="form-control" autocomplete="off" placeholder="Cupo asignado">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin/generalview.form_register')
</div>

