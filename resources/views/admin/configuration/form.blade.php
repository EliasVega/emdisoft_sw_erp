
<div class="box-body row">
    <div class="col-md-4">
        <div class="box-header with-border">
            <h5 class="box-title"><b>EDITAR IP Y DATOS CREACION DEL SOFTWARE</b>
            </h5>
        </div>
        <div class="card card-primary card-outline">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="ip">I.P.</label>
                    <input type="text" id="ip" name="ip" value="{{ $configuration->ip }}" class="form-control" placeholder="IP.">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="creator_name">Creador SW</label>
                    <input type="text" id="creator_name" name="creator_name" value="{{ $configuration->creator_name }}" class="form-control" placeholder="Creador.">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="company_name">EMpresa</label>
                    <input type="text" id="company_name" name="company_name" value="{{ $configuration->company_name }}" class="form-control" placeholder="Compañia.">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="software_name">Nombre del SW</label>
                    <input type="text" id="software_name" name="software_name" value="{{ $configuration->software_name }}" class="form-control" placeholder="Nombre del SW.">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i> Guardar</button>
                    <a href="{{url('configuration')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>
