<div class="box-body row" id="addLPM">
    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
        <label for="layoff_payment_mode">Modo pago</label>
        <div class="select">
            <select id="layoff_payment_mode" name="layoff_payment_mode" class="form-control selectpicker" data-live-search="true">
                <option value="" disabled selected>Seleccionar.</option>
                    <option value="paid">Pagar</option>
                    <option value="caused">Causar</option>
            </select>
        </div>
    </div>
</div>
<div class="box-body row" id="addLayoffGeneral">
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="startLayoffs">F/Inicio</label>
            <input type="date" name="startLayoffs" id="startLayoffs" value=""  class="form-control"  placeholder="Fecha Inicio">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="endLayoffs">F/Fin</label>
            <input type="date" name="endLayoffs" id="endLayoffs" value=""  class="form-control"  placeholder="Fecha Fin">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addLayoffsDays">
        <div class="form-group">
            <label class="form-control-label" for="layoff_days">N° dias</label>
            <input type="number" id="layoff_days" name="layoff_days" value="0" class="form-control" placeholder="dias" readonly>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="value_layoffs">V/Cesantias</label>
            <input type="number" id="value_layoffs" name="value_layoffs" value="0" class="form-control" placeholder="valor" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="layoff_interest">Int de cesantias</label>
            <input type="number" id="layoff_interest" name="layoff_interest" value="0" class="form-control" placeholder="interes" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addProvisionLayoffs">
        <div class="form-group">
            <label class="form-control-label" for="provision_layoffs">Pro/cesantias</label>
            <input type="number" id="provision_layoffs" name="provision_layoffs" value="0" class="form-control" placeholder="provision" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addProvisionInterest">
        <div class="form-group">
            <label class="form-control-label" for="pro_lay_int">Pro/int/cesantias</label>
            <input type="number" id="pro_lay_int" name="pro_lay_int" value="0" class="form-control" placeholder="provision" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addProLayoffDays"> <!-- Total de dias que van en provisiones acumulados -->
        <div class="form-group">
            <label class="form-control-label" for="daysProLayoffs">dias provision</label>
            <input type="number" id="daysProLayoffs" name="daysProLayoffs" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addProvisionTotal">
        <div class="form-group">
            <label class="form-control-label" for="provision_total">Total Provision</label>
            <input type="number" id="provision_total" name="provision_total" value="" class="form-control" placeholder="provision" step="any">
        </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="total_layoffs">Total Cesantias</label>
            <input type="number" id="total_layoffs" name="total_layoffs" value="0" class="form-control" placeholder="cesantias + intereses" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addLayoffsAdjustment">
        <div class="form-group">
            <label class="form-control-label" for="layoffs_adjustment">Ajuste Cesantias</label>
            <input type="number" id="layoffs_adjustment" name="layoffs_adjustment" value="0" class="form-control" placeholder="ajuste vacacional" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addDLP"> <!-- Total de dias que van en provisiones acumulados -->
        <div class="form-group">
            <label class="form-control-label" for="daysLayoffProvision">dias cesantias causadas</label>
            <input type="number" id="daysLayoffProvision" name="daysLayoffProvision" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mt-4">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="button" id="add_layoffs" data-toggle="tooltip"
                data-placement="top" title="Agregar"><i class="fas fa-check"></i></button>


            <button class="btn btn-blueGrad" type="button" id="canc_layoffs" data-toggle="tooltip"
                data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i></button>
        </div>
    </div>
</div>



