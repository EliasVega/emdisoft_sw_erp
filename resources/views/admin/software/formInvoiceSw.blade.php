<div class="box-body row">
    <div class="col-md-12">
        <div class="box-header with-border">
            <h5 class="box-title"><b>SOFTWARE FACTURACION ELECTRONICA</b>
            </h5>
        </div>
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="identifier">Software id</label>
                        <input type="text" id="identifier" name="identifier" value="{{ $software->identifier }}" class="form-control" placeholder="SW ID.">
                    </div>
                </div>
                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12" id="noteDocument">
                    <div class="form-group">
                        <label class="form-control-label" for="pin">Software Pin</label>
                        <input type="text" id="pin" name="pin" value="{{ $software->pin }}" class="form-control"
                            placeholder="Software Pin">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="test_set">Set de Pruebas</label>
                        <input type="text" id="test_set" name="test_set" value="{{ $software->test_set }}" class="form-control" placeholder="Set.">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12" id="addType">
                    <div class="form-group">
                        <label class="form-control-label" for="type_software">Tipo</label>
                        <input type="text" id="type_software" name="type_software" value="invoice" class="form-control">
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
