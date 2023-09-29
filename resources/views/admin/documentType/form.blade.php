<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" value="{{ old('code', $documentType->code ?? '') }}" class="form-control" placeholder="Codigo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">nombre Documento</label>
            <input type="text" name="name" value="{{ old('name', $documentType->name ?? '') }}" class="form-control" placeholder="Documento nombre">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="prefix">Prefijo</label>
            <input type="text" name="prefix" value="{{ old('prefix', $documentType->prefix ?? '') }}" class="form-control" placeholder="Prefijo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="cufe_algorithm">Cufe Algoritmo</label>
            <input type="text" name="cufe_algorithm" value="{{ old('cufe_algorithm', $documentType->cufe_algorithm ?? '') }}" class="form-control" placeholder="Cufe Algoritmo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('documentType')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
