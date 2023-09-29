<div class="box-body">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="role">Nombre del Rol</label>
            {!! Form::text('name', null, array('class' => 'from-control')) !!}
        </div>
    </div>
    <label for="permissions">Permisos</label>
        <br>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
            @foreach($permissions as $permission)
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <label>
                {!! Form::checkbox('permission[]', $permission->id, false, array('class' => 'name mr-3')) !!}
                {{ $permission->description }}</label>
            </div>
            @endforeach
        </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('roles')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
