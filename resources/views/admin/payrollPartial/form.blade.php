<div class="box-body row">
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addMonth">
        <div class="col">
            <label for="month">Nomina mes</label>
            <input type="month" name="month" id="month" class="form-control" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="addEmployee">
        <label for="employee_id">Colaborador</label>
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
            <input type="number" id="salary" name="salary" value="0" class="form-control" placeholder="salario" readonly required>
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
            <input type="number" id="total_acrued" name="total_acrued" value="0" class="form-control" placeholder="total devengado" step="any" readonly required>
        </div>
    </div>
</div>

<div class="box-body row" id="addInformation">
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addStartDate">
        <div class="form-group">
            <label class="form-control-label" for="start_date">F/Inicio</label>
            <input type="date" name="start_date" id="start_date" value=""  class="form-control"  placeholder="Fecha Inicio" required>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addEndDate">
        <div class="form-group">
            <label class="form-control-label" for="end_date">F/Fin</label>
            <input type="date" name="end_date" id="end_date" value=""  class="form-control"  placeholder="Fecha Fin" required>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addPaymentDate">
        <div class="form-group">
            <label class="form-control-label" for="payment_date">F/Pago</label>
            <input type="date" name="payment_date" id="payment_date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Fecha Pago">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addGenerationDate">
        <div class="form-group">
            <label class="form-control-label" for="generation_date">F/Generacion</label>
            <input type="date" name="generation_date" id="generation_date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Fecha Vencimiento">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addDays">
        <div class="form-group">
            <label class="form-control-label" for="days">N° dias</label>
            <input type="number" id="days" name="days" value="" class="form-control" placeholder="dias" readonly>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addSalaryAcrued">
        <div class="form-group">
            <label class="form-control-label" for="salary_acrued">Salario</label>
            <input type="number" id="salary_acrued" name="salary_acrued" value="" class="form-control" placeholder="salario" step="any" required>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addTransportAcrued">
        <div class="form-group">
            <label class="form-control-label" for="transport_acrued">Aux Trasporte</label>
            <input type="number" id="transport_acrued" name="transport_acrued" value="0" class="form-control" placeholder="Aux Transp" required>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addBaseSalary">
        <div class="form-group">
            <label class="form-control-label" for="base_salary">Salario Base</label>
            <input type="number" id="base_salary" name="base_salary" value="0" class="form-control" placeholder="Salario Base" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addSmlv">
        <div class="form-group">
            <label class="form-control-label" for="smlv">SMLV</label>
            <input type="number" id="smlv" name="smlv" value="" class="form-control" placeholder="Aux Transp" required>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="note">Observaciones</label>
            <input type="text" id="note" name="note" value="" class="form-control" placeholder="Observaciones">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md mt-3" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('payrollPartial')}}" class="btn btn-blueGrad mt-3"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
<div class="box-body row" id="addProvisions">
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="vacation_provisions">P/vacaiones</label>
            <input type="number" id="vacation_provisions" name="vacation_provisions" value="0" class="form-control" placeholder="provision" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="bonus_provisions">P/Primas</label>
            <input type="number" id="bonus_provisions" name="bonus_provisions" value="0" class="form-control" placeholder="provision" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="layoff_provisions">P/cesantias</label>
            <input type="number" id="layoff_provisions" name="layoff_provisions" value="0" class="form-control" placeholder="provision" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="layoff_interest_pro">I/cesantias</label>
            <input type="number" id="layoff_interest_pro" name="layoff_interest_pro" value="0" class="form-control" placeholder="provision" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="vp_days">dias vacaiones</label>
            <input type="number" id="vp_days" name="vp_days" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="bp_days">dias Prima</label>
            <input type="number" id="bp_days" name="bp_days" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="lp_days">dias cesantias</label>
            <input type="number" id="lp_days" name="lp_days" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
</div>

