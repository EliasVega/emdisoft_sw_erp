<div class="box-body row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" id="code" name="code" value="{{ old('code', $identificationType->code ?? '') }}" class="form-control" placeholder="Coddigo">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="initial">Sigla</label>
            <input type="text" id="initial" name="initial" value="{{ old('initial', $identificationType->initial ?? '') }}" class="form-control" placeholder="Sigla" required>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Tipo de Documento</label>
            <input type="text" id="name" name="name" value="{{ old('name', $identificationType->name ?? '') }}" class="form-control" placeholder="Coddigo">
        </div>
    </div>



    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('identificationType')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
