<div class="box-body row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" id="addPeriod">
        <div class="inputBtn">
            <div class="checkbox">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkbox">
                    <input type="checkbox" name="bonusperiod" class="bonusperiod" value="0" id="bonus1">
                    <label for="bonus1">Periodo 1</label>

                    <input type="checkbox" name="bonusperiod" class="bonusperiod" value="1" id="bonus2">
                    <label for="bonus2">Periodo 2</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
        <label for="typeBonus">Tipo</label>
        <div class="select">
            <select id="typeBonus" name="typeBonus" class="form-control selectpicker" data-live-search="true" required>
                <option value="{{ old('type', $bonus->type ?? '') }}" disabled>Seleccionar Tipo</option>
                    <option value="salary">SALARIAL</option>
                    <option value="non-salary">NO SALARIAL</option>
            </select>
        </div>
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
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 mt-4">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="button" id="add_bonus"><i class="fa fa-save"></i> Agregar</button>
            <button class="btn btn-darkBlueGrad" type="button" id="canc_bonus"><i class="fa fa-save"></i> Cancelar</button>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="bonus" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Eliminar</th>
                        <th>Tipo</th>
                        <th>F/Inicio</th>
                        <th>F/Fin</th>
                        <th>Dias</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="5">
                            <p align="right">TOTAL:</p>
                        </th>
                        <th class="thfoot">
                            <p align="right"><span id="total_bonus_html">$ 0.00</span>
                                <input type="hidden" name="total_bonus" value="0" id="total_bonus"> </p>
                        </th>
                    </tr>
                </tfoot>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>



