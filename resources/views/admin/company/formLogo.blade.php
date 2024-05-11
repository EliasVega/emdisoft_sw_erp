<div class="box-body row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" id="logo" name="logo" data-initial-preview="{{ old('logo', $company->logo ?? '') }}" accept="image/*" data-msg-placeholder="Seleccionar archivo"/>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"id="editLogo">
        <div class="form-group">
            <label for="editLogo">EditLogo</label>
            <input type="text" name="editLogo" value="true" class="form-control" placeholder="Editando logo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i> Guardar</button>
            <a href="{{url('configuration')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
