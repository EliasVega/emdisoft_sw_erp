<div class="box-body row">
    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
        <label for="vacation_payment_mode">Modo pago</label>
        <div class="select">
            <select id="vacation_payment_mode" name="vacation_payment_mode" class="form-control selectpicker" data-live-search="true" required>
                <option value="{{ old('payment_mode', $vacations->payment_mode ?? '') }}" disabled>pagar o causar</option>
                    <option value="paid">Pagadas</option>
                    <option value="caused">Causadas</option>
            </select>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="start_vacation_period">Periodo desde</label>
            <input type="date" name="start_vacation_period" id="start_vacation_period" value=""  class="form-control"  placeholder="Periodo desde" readonly>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="end_vacation_period">Periodo hasta</label>
            <input type="date" name="end_vacation_period" id="end_vacation_period" value=""  class="form-control"  placeholder="Periodo hasta">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="days_vacation_period">N° dias</label>
            <input type="number" id="days_vacation_period" name="days_vacation_period" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addProvisionVacations">
        <div class="form-group">
            <label class="form-control-label" for="provision_vacations">Provision</label>
            <input type="number" id="provision_vacations" name="provision_vacations" value="0" class="form-control" placeholder="provision" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addVacationAdjustment">
        <div class="form-group">
            <label class="form-control-label" for="vacation_adjustment">Ajuste vacacional</label>
            <input type="number" id="vacation_adjustment" name="vacation_adjustment" value="0" class="form-control" placeholder="ajuste vacacional" step="any">
        </div>
    </div>
</div>
<div class="box-body row">
    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
        <label for="vacation_type">Tipo</label>
        <div class="select">
            <select id="vacation_type" name="vacation_type" class="form-control selectpicker" data-live-search="true" required>
                <option value="{{ old('vacation_type', $vacations->type ?? '') }}" disabled>Seleccionar Tipo</option>
                    <option value="enjoyed">Disfrutadas</option>
                    <option value="compensated">Compensadas</option>
            </select>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="startVacations">F/Inicio</label>
            <input type="date" name="startVacations" id="startVacations" value=""  class="form-control"  placeholder="Fecha Inicio">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="endVacations">F/Fin</label>
            <input type="date" name="endVacations" id="endVacations" value=""  class="form-control"  placeholder="Fecha Fin">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addVacationDays">
        <div class="form-group">
            <label class="form-control-label" for="vacationDays">N° dias</label>
            <input type="number" id="vacationDays" name="vacationDays" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addvacationAcrued">
        <div class="form-group">
            <label class="form-control-label" for="vacation_acrued">Vacaciones</label>
            <input type="number" id="vacation_acrued" name="vacation_acrued" value="" class="form-control" placeholder="Vacaciones">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mt-4">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="button" id="add_vacations" data-toggle="tooltip"
                data-placement="top" title="Agregar"><i class="fas fa-check"></i></button>


            <button class="btn btn-blueGrad" type="button" id="canc_vacations" data-toggle="tooltip"
                data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i></button>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="vacations" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Eliminar</th>
                        <th>Tipo</th>
                        <th>F/Inicio</th>
                        <th>F/Fin</th>
                        <th>Dias</th>
                        <th>V/dia</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="6">
                            <p align="right">TOTAL:</p>
                        </th>
                        <th class="thfoot">
                            <p align="right"><span id="total_vacations_html">$ 0.00</span>
                                <input type="hidden" name="total_vacations" value="0" id="total_vacations"> </p>
                        </th>
                    </tr>
                </tfoot>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

