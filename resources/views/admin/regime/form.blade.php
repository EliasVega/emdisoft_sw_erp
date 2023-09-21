<div class="box-body row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="number" name="code" value="{{ old('code', $regime->code ?? '') }}" class="form-control" placeholder="Ingrese code">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="name">Tipo de Regimen</label>
            <input type="text" name="name" value="{{ old('name', $regime->name ?? '') }}" class="form-control" placeholder="Regimen">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-celeste btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('regime')}}" class="btn btn-gris"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
