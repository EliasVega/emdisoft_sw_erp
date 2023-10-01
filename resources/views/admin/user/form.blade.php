<div class="row box-body">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" placeholder="Nombre">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <label for="branch_id">Sucursal</label>
        <div class="select">
            <select id="branch_id" name="branch_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($user->branch_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar departamento</option>
                @foreach($branches as $branch)
                    @if($branch->id == ($user->branch_id ?? ''))
                        <option value="{{ $branch->id }}" selected>{{ $branch->name }}</option>
                    @else
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <label for="identification_type_id">Tipo Documento</label>
        <div class="select">
            <select id="identification_type_id" name="identification_type_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($user->identification_type_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar </option>
                @foreach($identificationTypes as $identificationType)
                    @if($identificationType->id == ($user->identification_type_id ?? ''))
                        <option value="{{ $identificationType->id }}" selected>{{ $identificationType->name }}</option>
                    @else
                        <option value="{{ $identificationType->id }}">{{ $identificationType->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="number">Numero de Identificacion</label>
            <input type="text" name="number" class="form-control" value="{{ old('number', $user->number ?? '') }}" placeholder="Numero del Documento">
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="address">Direccion Residencia</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address ?? '') }}" placeholder="Direccion de residencia">
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="phone">Telefono</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone ?? '') }}" placeholder="Numero de Telefono">
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="email">E-Mail</label>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   name="email" value="{{ old('email', $user->email ?? '') }}" placeholder="Email" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" type="password"
                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                   placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="password-confirm" class="col-md-12 col-form-label">Conf. Contraseña</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                   placeholder="Confirmar Password" required>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="position">Cargo</label>
            <input type="text" name="position" value="{{ old('position', $user->position ?? '') }}" class="form-control" placeholder="Cargo">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="roles">Roles</label>
            {!! Form::select('roles[]', $roles, [], array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="radio">
            <h6>Traslados</h6>

            <input type="radio" name="transfer" value="1" id="SI">
            <label for="transfer">Autorizado</label>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="transfer" value="0" id="NO" checked>
            <label for="transfer">No Autorizado</label>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="submit">Guardar</button>
            <a href="{{url('user')}}" class="btn btn-blueGrad">Cancelar</a>
        </div>
    </div>
</div>
