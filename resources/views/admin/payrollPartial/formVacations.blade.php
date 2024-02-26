<div class="box-body row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <label for="type_vacations">Tipo</label>
        <div class="select">
            <select id="type_vacations" name="type_vacations" class="form-control selectpicker" data-live-search="true" required>
                <option value="{{ old('type', $vacations->type ?? '') }}" disabled>Seleccionar Tipo</option>
                    <option value="emjoyed">DISFRUTADAS</option>
                    <option value="compensated">COMPENSADAS</option>
            </select>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="start_vacations">F/Inicio</label>
            <input type="date" name="start_vacations" id="start_vacations" value=""  class="form-control"  placeholder="Fecha Inicio">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="end_vacations">F/Fin</label>
            <input type="date" name="end_vacations" id="end_vacations" value=""  class="form-control"  placeholder="Fecha Fin">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="addVacationDays">
        <div class="form-group">
            <label class="form-control-label" for="vacationDays">N° dias</label>
            <input type="number" id="vacationDays" name="vacationDays" value="" class="form-control" placeholder="dias">
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
                        <th>Editar</th>
                        <th>Tipo</th>
                        <th>F/Inicio</th>
                        <th>F/Fin</th>
                        <th>Dias</th>
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

