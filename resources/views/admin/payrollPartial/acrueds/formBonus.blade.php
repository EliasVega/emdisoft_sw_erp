<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addBonusPeriod">
        <div class="inputBtn">
            <div class="checkbox">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkbox">
                    <input type="checkbox" name="bonusPeriod" class="bonusPeriod" value="0" id="bonus1">
                    <label for="bonus1">Periodo 1</label>

                    <input type="checkbox" name="bonusPeriod" class="bonusPeriod" value="1" id="bonus2">
                    <label for="bonus2">Periodo 2</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
        <label for="type_bonus">Tipo</label>
        <div class="select">
            <select id="type_bonus" name="type_bonus" class="form-control selectpicker" data-live-search="true" required>
                <option disabled>Seleccionar Tipo</option>
                    <option value="salary">SALARIAL</option>
                    <option value="non-salary">NO SALARIAL</option>
            </select>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addSBP"> <!-- Fecha de Inicio liquidacion prima -->
        <div class="form-group">
            <label class="form-control-label" for="start_bonus_period">F/Periodo Bonus</label>
            <input type="date" name="start_bonus_period" id="start_bonus_period"  class="form-control"  placeholder="Fecha Inicio">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12"> <!-- Fecha de Inicio liquidacion prima -->
        <div class="form-group">
            <label class="form-control-label" for="startBonus">F/Inicio</label>
            <input type="date" name="startBonus" id="startBonus" value=""  class="form-control"  placeholder="Fecha Inicio">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12"> <!-- Fecha de Fin liquidacion prima -->
        <div class="form-group">
            <label class="form-control-label" for="endBonus">F/Fin</label>
            <input type="date" name="endBonus" id="endBonus" value=""  class="form-control"  placeholder="Fecha Fin">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addBonusDays"> <!-- Total de dias de liquidacion -->
        <div class="form-group">
            <label class="form-control-label" for="bonusDays">N° dias</label>
            <input type="number" id="bonusDays" name="bonusDays" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12"> <!-- Valor total de la prima -->
        <div class="form-group">
            <label class="form-control-label" for="valueBonus">V/prima</label>
            <input type="number" id="valueBonus" name="valueBonus" value="0" class="form-control" placeholder="valor" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addProvisionBonus"> <!-- Valor de las proviciones acumuladas -->
        <div class="form-group">
            <label class="form-control-label" for="provision_bonus">Provision</label>
            <input type="number" id="provision_bonus" name="provision_bonus" value="0" class="form-control" placeholder="provision" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addBonusAdjustment"> <!-- Ajuste de proviciones en caso de que sea mas -->
        <div class="form-group">
            <label class="form-control-label" for="bonus_adjustment">Ajuste Prima Salarial</label>
            <input type="number" id="bonus_adjustment" name="bonus_adjustment" value="0" class="form-control" placeholder="ajuste vacacional" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addProBonusDays"> <!-- Total de dias que van en provisiones acumulados -->
        <div class="form-group">
            <label class="form-control-label" for="daysProBonus">dias provision</label>
            <input type="number" id="daysProBonus" name="daysProBonus" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addDBP"> <!-- Total de dias que van en provisiones acumulados -->
        <div class="form-group">
            <label class="form-control-label" for="daysBonusProvision">dias prima causadas</label>
            <input type="number" id="daysBonusProvision" name="daysBonusProvision" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mt-4">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="button" id="add_bonus" data-toggle="tooltip"
                data-placement="top" title="Agregar"><i class="fas fa-check"></i></button>


            <button class="btn btn-blueGrad" type="button" id="canc_bonus" data-toggle="tooltip"
                data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i></button>
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



