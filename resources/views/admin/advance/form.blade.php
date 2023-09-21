<div class="box-body row">

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 mb-3" >
        <label for="third">Anticipo a:</label>
        <select name="third" id="third" class="form-select" aria-label="Default select example">
            <option selected="selected">Seleccionar tipo de ususario</option>
            <option value="1">Clientes</option>
            <option value="2">Proveedores</option>
            <option value="3">Empleados</option>
        </select>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 mb-3" id="client">
        <label for="customer_id">Cliente</label>
        <div class="select">
            <select id="customer_id" name="customer_id" class="form-control selectpicker" data-live-search="true">
                <option {{ ($advance->customer_id ?? '') == '' ? "selected" : "" }} disabled>Cliente</option>
                @foreach($customers as $customer)
                    @if($customer->id == ($advance->customer_id ?? ''))
                        <option value="{{ $customer->id }}" selected>{{ $customer->identification }} -- {{ $customer->name }}</option>
                    @else
                        <option value="{{ $customer->id }}">{{ $customer->identification }} - {{ $customer->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 mb-3" id="supplier">
        <label for="provider_id">Proveedor</label>
        <div class="select">
            <select id="provider_id" name="provider_id" class="form-control selectpicker" data-live-search="true">
                <option {{ ($advance->provider_id ?? '') == '' ? "selected" : "" }} disabled>Proveedor</option>
                @foreach($providers as $provider)
                    @if($provider->id == ($advance->provider_id ?? ''))
                        <option value="{{ $provider->id }}" selected>{{ $provider->identification }} -- {{ $provider->name }}</option>
                    @else
                        <option value="{{ $provider->id }}">{{ $provider->identification }} - {{ $provider->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 mb-3" id="worker">
        <label for="employee_id">Empleado</label>
        <div class="select">
            <select id="employee_id" name="employee_id" class="form-control selectpicker" data-live-search="true">
                <option {{ ($advance->employee_id ?? '') == '' ? "selected" : "" }} disabled>Empleado</option>
                @foreach($employees as $employee)
                    @if($employee->id == ($advance->employee_id ?? ''))
                        <option value="{{ $employee->id }}" selected>{{ $employee->identification }} -- {{ $employee->name }}</option>
                    @else
                        <option value="{{ $employee->id }}">{{ $employee->identification }} - {{ $employee->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>


