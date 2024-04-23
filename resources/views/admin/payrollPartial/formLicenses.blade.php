<div class="box-body row">
    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
        <label for="type_pay">Tipo</label>
        <div class="select">
            <select id="type_pay" name="type_pay" class="form-control selectpicker" data-live-search="true" required>
                <option value="paid" disabled></option>
                <option value="paid">Remunerada</option>
                <option value="unpaid">No Remunerada</option>
            </select>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
        <label for="type_license">Tipo de licencia</label>
        <div class="select">
            <select id="type_license" name="type_license" class="form-control selectpicker" data-live-search="true" required>
                <option value="" disabled>Seleccionar</option>
                <option value="maternity">Maternidad</option>
                <option value="paternity">Paternidad</option>
                <option value="union">Sindical</option>
                <option value="mourning">Luto</option>
                <option value="others">Otros</option>
            </select>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12"> <!-- Fecha de Inicio liquidacion prima -->
        <div class="form-group">
            <label class="form-control-label" for="startLicense">F/Inicio</label>
            <input type="date" name="startLicense" id="startLicense" value=""  class="form-control"  placeholder="Fecha Inicio">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12"> <!-- Fecha de Fin liquidacion prima -->
        <div class="form-group">
            <label class="form-control-label" for="endLicense">F/Fin</label>
            <input type="date" name="endLicense" id="endLicense" value=""  class="form-control"  placeholder="Fecha Fin" readonly>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addDaysLicense"> <!-- Total de dias de liquidacion -->
        <div class="form-group">
            <label class="form-control-label" for="daysLicense">N° dias</label>
            <input type="number" id="daysLicense" name="daysLicense" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12"> <!-- Valor total de la prima -->
        <div class="form-group">
            <label class="form-control-label" for="valueDayLicense">V/dia</label>
            <input type="number" id="valueDayLicense" name="valueDayLicense" value="0" class="form-control" placeholder="valor" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12"> <!-- Valor total de la prima -->
        <div class="form-group">
            <label class="form-control-label" for="valueLicense">V/Licencia</label>
            <input type="number" id="valueLicense" name="valueLicense" value="0" class="form-control" placeholder="valor" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mt-4">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="button" id="add_license" data-toggle="tooltip"
                data-placement="top" title="Agregar"><i class="fas fa-check"></i></button>


            <button class="btn btn-blueGrad" type="button" id="canc_license" data-toggle="tooltip"
                data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i></button>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="inabilities" class="table table-striped table-bordered table-condensed table-hover">
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
                            <p align="right"><span id="total_inabilities_html">$ 0.00</span>
                                <input type="hidden" name="total_inabilities" value="0" id="total_inabilities"> </p>
                        </th>
                    </tr>
                </tfoot>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>



