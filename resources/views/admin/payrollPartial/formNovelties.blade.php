<div class="box-body row">
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="row m-3">
                <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                    <label for="typeNovelty">Tipo Pago</label>
                    <div class="select">
                        <select id="typeNovelty" name="typeNovelty" class="form-control selectpicker" data-live-search="true" required>
                            <option value="salary" disabled></option>
                            <option value="salary">Salarial</option>
                            <option value="non-salary">No Salarial</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                    <label for="novelty">Tipo de Novedad</label>
                    <div class="select">
                        <select id="novelty" name="novelty" class="form-control selectpicker" data-live-search="true" required>
                            <option value="" disabled>Seleccionar</option>
                            <option value="bonuses">Bonificaciones</option>
                            <option value="aids">Ayudas</option>
                            <option value="third_party_payment">pagos a terceros</option>
                            <option value="advances">Anticipos</option>
                            <option value="bonusesEPCTV">Bonos EPCTVs</option>
                            <option value="compensations">Compensaciones</option>
                            <option value="others">otros</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12" id="addTypeCompensation">
                    <label for="typeCompensation">Tipo compensacion</label>
                    <div class="select">
                        <select id="typeCompensation" name="typeCompensation" class="form-control selectpicker" data-live-search="true" required>
                            <option value="ordinary" disabled></option>
                            <option value="ordinary">Ordinaria</option>
                            <option value="extraordinary">Extraordinaria</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12"> <!-- Valor total de la prima -->
                    <div class="form-group">
                        <label class="form-control-label" for="valueNovelty">V/Novedad</label>
                        <input type="number" id="valueNovelty" name="valueNovelty" value="0" class="form-control" placeholder="valor" step="any">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" id="addNoteNovelty">
                    <div class="form-group">
                        <label class="form-control-label" for="noteNovelty">Observaciones</label>
                        <input type="text" id="noteNovelty" name="noteNovelty" value="{{ old('noteNovelty') }}" class="form-control"
                            placeholder="Observaciones">
                    </div>
                </div>
                <div class="col-lg-6 col-md-2 col-sm-2 col-xs-12 mt-4">
                    <div class="form-group">
                        <button class="btn btn-lightBlueGrad" type="button" id="add_novelty" data-toggle="tooltip"
                            data-placement="top" title="Agregar"><i class="fas fa-check"></i></button>


                        <button class="btn btn-blueGrad" type="button" id="canc_novelty" data-toggle="tooltip"
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
                        <table id="novelties" class="table table-striped table-bordered table-condensed table-hover">
                            <thead class="bg-info">
                                <tr>
                                    <th>Eliminar</th>
                                    <th>Tipo</th>
                                    <th>Novedad</th>
                                    <th>T/Comp</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="4">
                                        <p align="right">TOTAL:</p>
                                    </th>
                                    <th class="thfoot">
                                        <p align="right"><span id="total_novelties_html">$ 0.00</span>
                                            <input type="hidden" name="total_novelties" value="0" id="total_novelties"> </p>
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



