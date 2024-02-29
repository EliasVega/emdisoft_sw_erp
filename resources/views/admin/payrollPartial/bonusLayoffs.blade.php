<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label>Primas</label>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="startBonus">F/Inicio</label>
            <input type="date" name="startBonus" id="startBonus" value=""  class="form-control"  placeholder="Fecha Inicio">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="endBonus">F/Fin</label>
            <input type="date" name="endBonus" id="endBonus" value=""  class="form-control"  placeholder="Fecha Fin" readonly>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addBonusDays">
        <div class="form-group">
            <label class="form-control-label" for="bonusDays">N° dias</label>
            <input type="number" id="bonusDays" name="bonusDays" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addTotalBonus">
        <div class="form-group">
            <label class="form-control-label" for="total_bonus">Salarial</label>
            <input type="number" id="total_bonus" name="total_bonus" value="0" class="form-control" placeholder="total devengado" required>
        </div>
    </div>
</div>
<div class="box-body row">
    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
        <label for="typeVacations">Tipo</label>
        <div class="select">
            <select id="typeVacations" name="typeVacations" class="form-control selectpicker" data-live-search="true" required>
                <option value="{{ old('type', $vacations->type ?? '') }}" disabled>Seleccionar Tipo</option>
                    <option value="emjoyed">DISFRUTADAS</option>
                    <option value="compensated">COMPENSADAS</option>
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
            <input type="date" name="endVacations" id="endVacations" value=""  class="form-control"  placeholder="Fecha Fin" readonly>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addVacationDays">
        <div class="form-group">
            <label class="form-control-label" for="vacationDays">N° dias</label>
            <input type="number" id="vacationDays" name="vacationDays" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 mt-4">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="button" id="add_vacations"><i class="fa fa-save"></i> Agregar</button>
            <button class="btn btn-darkBlueGrad" type="button" id="canc_vacations"><i class="fa fa-save"></i> Cancelar</button>
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



