<div class="box-body row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="number">ip</label>
            <input type="text" name="number" value="{{ $configuration->ip }}" class="form-control" placeholder="Nit" required>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="number">Nit</label>
            <input type="text" name="number" value="{{ $company->nit }}" class="form-control" placeholder="Nit" required>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name" class="form-control-label">Company</label>
                <input type="text" name="name" value="{{ $company->name }}" class="form-control" placeholder="name" required>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="token">Token</label>
            <input type="text" name="token" value="{{ $company->api_token }}" class="form-control" placeholder="Token" required>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="set">Set</label>
            <input type="text" name="set" value="{{ $software->test_set }}" class="form-control" placeholder="Set" required>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="software_id">Id Software</label>
            <input type="text" name="software_id" value="{{ $software->identifier }}" class="form-control" placeholder="Id Software" required>
        </div>
    </div>



    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-primary btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('configuration')}}" class="btn btn-danger"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
