<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="dane_code">codigo del Departamento</label>
            <input type="text" name="dane_code" value="{{ old('dane_code', $department->dane_code ?? '') }}" class="form-control" placeholder="Codigo departamento">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Departamento</label>
            <input type="text" name="name" value="{{ old('name', $department->name ?? '') }}" class="form-control" placeholder="Nombre Departamento">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="iso_code">codigo ISO</label>
            <input type="text" name="iso_code" value="{{ old('iso_code', $department->iso_code ?? '') }}" class="form-control" placeholder="Codigo ISO">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('department')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
