<div class="box-body row">
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="row m-3">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <label for="typeCommission">Tipo Pago</label>
                    <div class="select">
                        <select id="typeCommission" name="typeCommission" class="form-control selectpicker" data-live-search="true" required>
                            <option value="salary" disabled></option>
                            <option value="salary">Salarial</option>
                            <option value="non-salary">No Salarial</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <!-- Valor total de la prima -->
                    <div class="form-group">
                        <label class="form-control-label" for="valueCommission">V/Comision</label>
                        <input type="number" id="valueCommission" name="valueCommission" value="0" class="form-control" placeholder="valor" step="any">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addNoteCommision">
                    <div class="form-group">
                        <label class="form-control-label" for="noteCommission">Observaciones</label>
                        <input type="text" id="noteCommission" name="noteCommission" value="{{ old('noteCommission') }}" class="form-control"
                            placeholder="Observaciones">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addwc">
                    <div class="form-group">
                        <label class="form-control-label" for="workLabor">Mano de obra</label>
                        <input type="text" id="workLabor" name="workLabor" value="off" class="form-control"
                            placeholder="mano de obra">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
                    <div class="form-group">
                        <button class="btn btn-lightBlueGrad" type="button" id="add_commission" data-toggle="tooltip"
                            data-placement="top" title="Agregar"><i class="fas fa-check"></i></button>


                        <button class="btn btn-blueGrad" type="button" id="canc_commission" data-toggle="tooltip"
                            data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="row m-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table id="commissions" class="table table-striped table-bordered table-condensed table-hover">
                            <thead class="bg-info">
                                <tr>
                                    <th>Eliminar</th>
                                    <th>Tipo</th>
                                    <th>Valor Comision</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="2">
                                        <p align="right">TOTAL:</p>
                                    </th>
                                    <th class="thfoot">
                                        <p align="right"><span id="total_commissions_html">$ 0.00</span>
                                            <input type="hidden" name="total_commissions" value="0" id="total_commissions"> </p>
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



