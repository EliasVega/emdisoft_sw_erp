<div class="box-body row">
    <div class="col-md-12">
        <div class="box-header with-border">
            <h5 class="box-title"><b>SOFTWARE POS ELECTRONICO</b>
            </h5>
        </div>
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="identifier_equidoc">SW id D.EQ</label>
                        <input type="text" id="identifier_equidoc" name="identifier_equidoc" value="{{ $software->identifier_equidoc }}" class="form-control" placeholder="SW ID Doc. equivalente.">
                    </div>
                </div>
                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12" id="noteDocument">
                    <div class="form-group">
                        <label class="form-control-label" for="pin_equidoc">Pin D.EQ</label>
                        <input type="text" id="pin_equidoc" name="pin_equidoc" value="{{ $software->pin_equidoc }}" class="form-control"
                            placeholder="Software Pin EQDoc">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="equidoc_test_set">Set Prueba D.EQ</label>
                        <input type="text" id="equidoc_test_set" name="equidoc_test_set" value="{{ $software->equidoc_test_set }}" class="form-control" placeholder="Set EQUI. DOC.">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12" id="addType">
                    <div class="form-group">
                        <label class="form-control-label" for="type_software">Tipo</label>
                        <input type="text" id="type_software" name="type_software" value="pos" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i> Guardar</button>
                            <a href="{{url('configuration')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
