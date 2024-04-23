<div class="box-body row">
    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
        <label for="origin">Tipo</label>
        <div class="select">
            <select id="origin" name="origin" class="form-control selectpicker" data-live-search="true" required>
                <option value="labor" disabled></option>
                <option value="labor">Origen Laboral</option>
                    <option value="common">Origen Comun</option>
            </select>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12"> <!-- Fecha de Inicio liquidacion prima -->
        <div class="form-group">
            <label class="form-control-label" for="startInability">F/Inicio</label>
            <input type="date" name="startInability" id="startInability" value=""  class="form-control"  placeholder="Fecha Inicio">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12"> <!-- Fecha de Fin liquidacion prima -->
        <div class="form-group">
            <label class="form-control-label" for="endInability">F/Fin</label>
            <input type="date" name="endInability" id="endInability" value=""  class="form-control"  placeholder="Fecha Fin" readonly>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addDaysInability"> <!-- Total de dias de liquidacion -->
        <div class="form-group">
            <label class="form-control-label" for="daysInability">N° dias</label>
            <input type="number" id="daysInability" name="daysInability" value="0" class="form-control" placeholder="dias">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12"> <!-- Valor total de la prima -->
        <div class="form-group">
            <label class="form-control-label" for="valueDayInability">V/dia</label>
            <input type="number" id="valueDayInability" name="valueDayInability" value="0" class="form-control" placeholder="valor" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12"> <!-- Valor total de la prima -->
        <div class="form-group">
            <label class="form-control-label" for="valueInability">V/Incapacidad</label>
            <input type="number" id="valueInability" name="valueInability" value="0" class="form-control" placeholder="valor" step="any">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mt-4">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="button" id="add_inability" data-toggle="tooltip"
                data-placement="top" title="Agregar"><i class="fas fa-check"></i></button>


            <button class="btn btn-blueGrad" type="button" id="canc_inability" data-toggle="tooltip"
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



