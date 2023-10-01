<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="user_id">Usuario</label>
        <div class="select">
            <select id="user_id" name="user_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($verificationCode->user_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Usuario</option>
                @foreach($users as $user)
                    @if($user->id == ($verificationCode->user_id ?? ''))
                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                    @else
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo Admin</label>
            <input type="password" name="code" value="{{ old('code', $verificationCode->code ?? '') }}" class="form-control" placeholder="Codigo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('verificationCode')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
