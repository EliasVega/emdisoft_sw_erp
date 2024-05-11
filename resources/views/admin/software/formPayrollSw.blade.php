<div class="box-body row">
    <div class="col-md-12">
        <div class="box-header with-border">
            <h5 class="box-title"><b>SOFTWARE NOMINA ELECTRONICA</b>
            </h5>
        </div>
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="identifier_payroll">Software id Nomina</label>
                        <input type="text" id="identifier_payroll" name="identifier_payroll" value="{{ $software->identifier_payroll }}" class="form-control" placeholder="SW ID Nomina.">
                    </div>
                </div>
                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12" id="noteDocument">
                    <div class="form-group">
                        <label class="form-control-label" for="pin_payroll">Software Pin Nomina</label>
                        <input type="text" id="pin_payroll" name="pin_payroll" value="{{ $software->pin_payroll }}" class="form-control"
                            placeholder="Software Pin Nomina">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="payroll_test_set">Set Prueba nomina</label>
                        <input type="text" id="payroll_test_set" name="payroll_test_set" value="{{ $software->payroll_test_set }}" class="form-control" placeholder="Set Nomina.">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12" id="addType">
                    <div class="form-group">
                        <label class="form-control-label" for="type_software">Tipo</label>
                        <input type="text" id="type_software" name="type_software" value="payroll" class="form-control">
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
