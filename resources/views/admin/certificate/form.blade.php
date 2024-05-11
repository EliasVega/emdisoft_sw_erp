<div class="box-body row">
    <div class="col-md-12">
        <div class="box-header with-border">
            <h5 class="box-title"><b>CERTIFICADO DE FIRMA DIGITAL</b>
            </h5>
        </div>
        <div class="card card-primary card-outline">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="file">Certificate</label>
                    <input id="file" name="file" data-initial-preview="{{ isset($certificate->file) ? Storage::url('files/certificates/'.$certificate->file) : '' }}" data-msg-placeholder="Seleccionar archivo" type="file">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="password">Contraseña</label>
                    <input type="text" id="password" name="password" value="{{ $certificate->password }}" class="form-control" placeholder="Password.">
                </div>
            </div>
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
