<div class="box-body row">
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group row">
            <label class="form-control-label" for="employee_id">Colaborador</label>
                <select name="employee_id" class="form-control selectpicker" id="employee_id" data-live-search="true">
                    <option value="0" disabled selected>Seleccionar</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}_{{ $employee->salary }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
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
            <label class="form-control-label" for="transport_assistance">A.T.</label>
            <input type="number" id="transport_assistance" name="transport_assistance" value="0" class="form-control" placeholder="Aux Transp" readonly required>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="col">
            <label for="month">Nomina mes</label>
            <input type="month" name="month" id="month" class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="start_date">F/Inicio</label>
            <input type="date" name="start_date" id="start_date"  class="form-control"  placeholder="Fecha Inicio">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="end_date">F/Fin</label>
            <input type="date" name="end_date" id="end_date"  class="form-control"  placeholder="Fecha Fin">
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
            <label class="form-control-label" for="salary_acrued">Devengado Mes</label>
            <input type="number" id="salary_acrued" name="salary_acrued" value="" class="form-control" placeholder="salario" required>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addtransportAcrued">
        <div class="form-group">
            <label class="form-control-label" for="transport_acrued">Aux Trasporte</label>
            <input type="number" id="transport_acrued" name="transport_acrued" value="" class="form-control" placeholder="Aux Transp" required>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addSmlv">
        <div class="form-group">
            <label class="form-control-label" for="smlv">SMLV</label>
            <input type="number" id="smlv" name="smlv" value="" class="form-control" placeholder="Aux Transp" required>
        </div>
    </div>
</div>

