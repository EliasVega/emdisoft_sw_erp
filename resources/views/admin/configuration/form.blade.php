<div class="box-body row">
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="identifier">Software id</label>
                        <input type="text" id="identifier" name="identifier" value="{{ $software->identifier }}" class="form-control" placeholder="SW ID.">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="noteDocument">
                    <div class="form-group">
                        <label class="form-control-label" for="pin">Software Pin</label>
                        <input type="text" id="pin" name="pin" value="{{ $software->pin }}" class="form-control"
                            placeholder="Software Pin">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="test_set">Set de Pruebas</label>
                        <input type="text" id="test_set" name="test_set" value="{{ $software->test_set }}" class="form-control" placeholder="Set.">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="identifier_payroll">Software id Nomina</label>
                        <input type="text" id="identifier_payroll" name="identifier_payroll" value="{{ $software->identifier_payroll }}" class="form-control" placeholder="SW ID Nomina.">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="noteDocument">
                    <div class="form-group">
                        <label class="form-control-label" for="pin_payroll">Software Pin Nomina</label>
                        <input type="text" id="pin_payroll" name="pin_payroll" value="{{ $software->pin_payroll }}" class="form-control"
                            placeholder="Software Pin Nomina">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="payroll_test_set">Set Prueba nomina</label>
                        <input type="text" id="payroll_test_set" name="payroll_test_set" value="{{ $software->payroll_test_set }}" class="form-control" placeholder="Set Nomina.">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="identifier_equidoc">SW id D.EQ</label>
                        <input type="text" id="identifier_equidoc" name="identifier_equidoc" value="{{ $software->identifier_equidoc }}" class="form-control" placeholder="SW ID Doc. equivalente.">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="noteDocument">
                    <div class="form-group">
                        <label class="form-control-label" for="pin_equidoc">Pin D.EQ</label>
                        <input type="text" id="pin_equidoc" name="pin_equidoc" value="{{ $software->pin_equidoc }}" class="form-control"
                            placeholder="Software Pin EQDoc">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" for="equidoc_test_set">Set Prueba D.EQ</label>
                        <input type="text" id="equidoc_test_set" name="equidoc_test_set" value="{{ $software->equidoc_test_set }}" class="form-control" placeholder="Set EQUI. DOC.">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="ip">I.P.</label>
                    <input type="text" id="ip" name="ip" value="{{ $configuration->ip }}" class="form-control" placeholder="IP.">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="creator_name">I.P.</label>
                    <input type="text" id="creator_name" name="creator_name" value="{{ $configuration->creator_name }}" class="form-control" placeholder="Creador.">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="company_name">I.P.</label>
                    <input type="text" id="company_name" name="company_name" value="{{ $configuration->company_name }}" class="form-control" placeholder="Compañia.">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="software_name">I.P.</label>
                    <input type="text" id="software_name" name="software_name" value="{{ $configuration->software_name }}" class="form-control" placeholder="Nombre del SW.">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-body row">
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="ip">I.P.</label>
                    <input type="text" id="ip" name="ip" value="{{ $configuration->ip }}" class="form-control" placeholder="IP.">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="creator_name">I.P.</label>
                    <input type="text" id="creator_name" name="creator_name" value="{{ $configuration->creator_name }}" class="form-control" placeholder="Creador.">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="company_name">I.P.</label>
                    <input type="text" id="company_name" name="company_name" value="{{ $configuration->company_name }}" class="form-control" placeholder="Compañia.">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="software_name">I.P.</label>
                    <input type="text" id="software_name" name="software_name" value="{{ $configuration->software_name }}" class="form-control" placeholder="Nombre del SW.">
                </div>
            </div>
        </div>
    </div>
</div>
