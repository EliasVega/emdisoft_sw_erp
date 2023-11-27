<div class="box-body row">

    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <label for="identification_type_id">Tipo Identificacion</label>
        <div class="select">
            <select id="identification_type_id" name="identification_type_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($employee->identification_type_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar...</option>
                @foreach($identificationTypes as $identificationType)
                    @if($identificationType->id == ($employee->identification_type_id ?? ''))
                        <option value="{{ $identificationType->id }}" selected>{{ $identificationType->name }}</option>
                    @else
                        <option value="{{ $identificationType->id }}">{{ $identificationType->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="identification">Identificacion</label>
            <input type="text" name="identification" id="identification" value="{{ old('identification', $employee->identification ?? '') }}" class="form-control" placeholder="Identificacion">
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre del Empleado</label>
            <input type="text" name="name" value="{{ old('name', $employee->name ?? '') }}" class="form-control" placeholder="Nombre">
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <label for="branch_id">Sucursal</label>
        <div class="select">
            <select id="branch_id" name="branch_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($employee->branch_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar...</option>
                @foreach($branchs as $branch)
                    @if($branch->id == ($employee->branch_id ?? ''))
                        <option value="{{ $branch->id }}" selected>{{ $branch->name }}</option>
                    @else
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <label for="department_id">Departamento</label>
        <div class="select">
            <select id="department_id" name="department_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($employee->department_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar...</option>
                @foreach($departments as $department)
                    @if($department->id == ($employee->municipality->department_id ?? ''))
                        <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                    @else
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <label for="municipality_id">Municipio</label>
        <div class="select">
            <select id="municipality_id" name="municipality_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($employee->municipality_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar...</option>
                @if(($municipalities ?? '') != null)
                    @foreach($municipalities as $municipality)
                        @if($municipality->id == ($employee->municipality_id ?? ''))
                            <option value="{{ $municipality->id }}" selected>{{ $municipality->name }}</option>
                        @else
                            <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" value="{{ old('code', $employee->code ?? '') }}" class="form-control" placeholder="Codigo">
        </div>
    </div>



    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="address">Direccion</label>
            <input type="text" name="address" value="{{ old('address', $employee->address ?? '') }}" class="form-control" placeholder="Direccion">
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="phone">Telefono</label>
            <input type="text" name="phone" value="{{ old('phone', $employee->phone ?? '') }}" class="form-control" placeholder="Telefono">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}" class="form-control" placeholder="Correo electronico">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="status">Estado</label>
        <select name="status" id="status" class="form-control" required>
            <option {{ ($employee->status ?? '') == '' ? "selected" : "" }}></option>
            <option  selected="selected" value="active" {{ old('status', $employee->status ?? '') == 'active' ? "selected" : "" }}>Activo</option>
            <option value="inactive" {{ old('status', $employee->status ?? '') == 'inactive' ? "selected" : "" }}>Inactivo</option>
        </select>
    </div>
    <div class="clearfix"></div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <h5>Informacion Laboral</h5>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <label for="employee_type_id">Tipo de empleado</label>
        <div class="select">
            <select id="employee_type_id" name="employee_type_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($employee->employee_type_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar...</option>
                @foreach($employeeTypes as $employeeType)
                    @if($employeeType->id == ($employee->employee_type_id ?? ''))
                        <option value="{{ $employeeType->id }}" selected>{{ $employeeType->name }}</option>
                    @else
                        <option value="{{ $employeeType->id }}">{{ $employeeType->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <label for="employee_subtype_id">Sub Tipo Empleado</label>
        <div class="select">
            <select id="employee_subtype_id" name="employee_subtype_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($employee->employee_subtype_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar...</option>
                @foreach($employeeSubtypes as $employeeSubtype)
                    @if($employeeSubtype->id == ($employee->employee_subtype_id ?? ''))
                        <option value="{{ $employeeSubtype->id }}" selected>{{ $employeeSubtype->name }}</option>
                    @else
                        <option value="{{ $employeeSubtype->id }}">{{ $employeeSubtype->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <label for="contrat_type_id">Tipo de Contrato</label>
        <div class="select">
            <select id="contrat_type_id" name="contrat_type_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($employee->contrat_type_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar...</option>
                @foreach($contratTypes as $contratType)
                    @if($contratType->id == ($employee->contrat_type_id ?? ''))
                        <option value="{{ $contratType->id }}" selected>{{ $contratType->name }}</option>
                    @else
                        <option value="{{ $contratType->id }}">{{ $contratType->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <label for="payment_frecuency_id">Frecuencia de Pago</label>
        <div class="select">
            <select id="payment_frecuency_id" name="payment_frecuency_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($employee->payment_frecuency_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar...</option>
                @foreach($paymentFrecuencies as $paymentFrecuency)
                    @if($paymentFrecuency->id == ($employee->payment_frecuency_id ?? ''))
                        <option value="{{ $paymentFrecuency->id }}" selected>{{ $paymentFrecuency->name }}</option>
                    @else
                        <option value="{{ $paymentFrecuency->id }}">{{ $paymentFrecuency->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <label for="charge_id">Cargo</label>
        <div class="select">
            <select id="charge_id" name="charge_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($employee->charge_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar..</option>
                @foreach($charges as $charge)
                    @if($charge->id == ($employee->charge_id ?? ''))
                        <option value="{{ $charge->id }}" selected>{{ $charge->name }}</option>
                    @else
                        <option value="{{ $charge->id }}">{{ $charge->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="admission_date">Fecha de Admision</label>
            <input type="date" name="admission_date" value="{{ old('admission_date', $employee->admission_date ?? '') }}" class="form-control" placeholder="Admision">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="salary">Salario</label>
            <input type="number" name="salary" value="{{ old('salary', $employee->salary ?? '') }}" class="form-control" placeholder="Salario">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <h5>Metodo de pago</h5>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <label for="payment_id">Metodo de pago</label>
        <div class="select">
            <select id="payment_method_id" name="payment_method_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($employee->payment_method_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar...</option>
                @foreach($paymentMethods as $paymentMethod)
                    @if($paymentMethod->id == ($employee->payment_method_id ?? ''))
                        <option value="{{ $paymentMethod->id }}" selected>{{ $paymentMethod->name }}</option>
                    @else
                        <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <label for="bank_id">banco</label>
        <div class="select">
            <select id="bank_id" name="bank_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($employee->bank_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar...</option>
                @foreach($banks as $bank)
                    @if($bank->id == ($employee->bank_id ?? ''))
                        <option value="{{ $bank->id }}" selected>{{ $bank->name }}</option>
                    @else
                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="account_type">Tipo de cuenta</label>
            <input type="text" name="account_type" value="{{ old('account_type', $employee->account_type ?? '') }}" class="form-control" placeholder="Cuenta tipo">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="account_number">Numero de cuenta</label>
            <input type="text" name="account_number" value="{{ old('account_number', $employee->account_number ?? '') }}" class="form-control" placeholder="Cuenta numero">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad mt-2" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('employee')}}" class="btn btn-blueGrad mt-2"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
