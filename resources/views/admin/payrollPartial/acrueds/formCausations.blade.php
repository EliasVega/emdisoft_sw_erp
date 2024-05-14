<div class="box-body row">
    <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
        <div class="card card-primary card-outline">
            <div class="row m-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="nameCausation">Causacion</label>
                    <div class="select">
                        <select name="nameCausation" id="nameCausation" class="form-control selectpicker" data-live-search="true" required>
                            <option value="" disabled>Seleccionar</option>
                            <option value="layoffs">Cesantias</option>
                            <option value="vacations">Vacaciones</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="start_causation_period">Periodo desde</label>
                        <input type="date" name="start_causation_period" id="start_causation_period" value=""  class="form-control"  placeholder="Periodo desde" readonly>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="end_causation_period">Periodo hasta</label>
                        <input type="date" name="end_causation_period" id="end_causation_period" value=""  class="form-control"  placeholder="Periodo hasta">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="causationValue">V/causacion</label>
                        <input type="number" id="causationValue" name="causationValue" value="" class="form-control" placeholder="Vacaciones">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="causation_interest">Int de cesantias</label>
                        <input type="number" id="causation_interest" name="causation_interest" value="0" class="form-control" placeholder="interes" step="any">
                    </div>
                </div>
                <div class="col-lg-6 col-md-2 col-sm-2 col-xs-12 mt-4">
                    <div class="form-group">
                        <button class="btn btn-lightBlueGrad" type="button" id="add_causations" data-toggle="tooltip"
                            data-placement="top" title="Agregar"><i class="fas fa-check"></i></button>


                        <button class="btn btn-blueGrad" type="button" id="canc_causations" data-toggle="tooltip"
                            data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
        <div class="card card-primary card-outline">
            <div class="row m-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table id="causations" class="table table-striped table-bordered table-condensed table-hover">
                            <thead class="bg-info">
                                <tr>
                                    <th>Eliminar</th>
                                    <th>Causacion</th>
                                    <th>F/Inicio</th>
                                    <th>F/Fin</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="4">
                                        <p align="right">TOTAL:</p>
                                    </th>
                                    <th class="thfoot">
                                        <p align="right"><span id="total_causations_html">$ 0.00</span>
                                            <input type="hidden" name="total_causations" value="0" id="total_causations"> </p>
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
