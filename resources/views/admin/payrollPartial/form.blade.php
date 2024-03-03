<div class="box-body row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" id="addPeriod">
        <div class="inputBtn">
            <div class="checkbox">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkbox">
                    <input type="checkbox" name="period" class="period" value="0" id="checkbox1">
                    <label for="checkbox1">1 al 15</label>

                    <input type="checkbox" name="period" class="period" value="1" id="checkbox2">
                    <label for="checkbox2">16 al 30</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addFortnight">
        <div class="form-group">
            <label class="form-control-label" for="fortnight">Quincena</label>
            <input type="text" id="fortnight" name="fortnight" class="form-control" placeholder="Quincena">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addSalary">
        <div class="form-group">
            <label class="form-control-label" for="salary">Salario</label>
            <input type="number" id="salary" name="salary" value="" class="form-control" placeholder="salario" readonly required>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addtraspotAssistance">
        <div class="form-group">
            <label class="form-control-label" for="transport_assistance">A.Transporte</label>
            <input type="number" id="transport_assistance" name="transport_assistance" value="0" class="form-control" placeholder="Aux Transp" readonly required>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addTotalAcrued">
        <div class="form-group">
            <label class="form-control-label" for="total_acrued">T/Devengado</label>
            <input type="number" id="total_acrued" name="total_acrued" value="0" class="form-control" placeholder="total devengado" readonly required>
        </div>
    </div>
</div>
<div class="box-body row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" id="addEmployee">
        <label for="empployee_id">Colaborador</label>
        <div class="select">
            <select id="employee_id" name="employee_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($payrollPartial->employee_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Colaborador</option>
                @foreach($employees as $employee)
                    @if($employee->id == ($payrollPartial->employee_id ?? ''))
                        <option value="{{ $employee->id }}" selected>{{ $employee->name }}</option>
                    @else
                        <option value="{{ $employee->id }}_{{ $employee->salary }}">{{ $employee->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addMonth">
        <div class="col">
            <label for="month">Nomina mes</label>
            <input type="month" name="month" id="month" class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="start_date">F/Inicio</label>
            <input type="date" name="start_date" id="start_date" value=""  class="form-control"  placeholder="Fecha Inicio">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="end_date">F/Fin</label>
            <input type="date" name="end_date" id="end_date" value=""  class="form-control"  placeholder="Fecha Fin">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="payment_date">F/Pago</label>
            <input type="date" name="payment_date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Fecha Pago">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="generation_date">F/Generacion</label>
            <input type="date" name="generation_date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Fecha Vencimiento">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addDays">
        <div class="form-group">
            <label class="form-control-label" for="days">N° dias</label>
            <input type="number" id="days" name="days" value="" class="form-control" placeholder="dias" required>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addSalaryAcrued">
        <div class="form-group">
            <label class="form-control-label" for="salary_acrued">Dev. Mes</label>
            <input type="number" id="salary_acrued" name="salary_acrued" value="" class="form-control" placeholder="salario" required>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addtransportAcrued">
        <div class="form-group">
            <label class="form-control-label" for="transport_acrued">Aux Trasporte</label>
            <input type="number" id="transport_acrued" name="transport_acrued" value="0" class="form-control" placeholder="Aux Transp" required>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addSmlv">
        <div class="form-group">
            <label class="form-control-label" for="smlv">SMLV</label>
            <input type="number" id="smlv" name="smlv" value="" class="form-control" placeholder="Aux Transp" required>
        </div>
    </div>
</div>

