<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group" id="valorcito">
            <label class="form-control-label" for="cash_initial">Efectivo Inicial</label>
            <input type="number" id="cash_initial" name="cash_initial" value="" class="form-control"
                placeholder="Efectivo" >
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="user_open_id">Admin Apertura</label>
            <select name="user_open_id" class="form-control selectpicker" id="user_open_id"
                data-live-search="true">
                <option value="" disabled selected>Seleccionar....</option>
                @foreach($users as $usa)
                <option value="{{ $usa->id }}">{{ $usa->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group" id="valorcito">
            <label class="form-control-label" for="verification_code_open">Codigo de verificacion</label>
            <input type="password" id="verification_code_open" name="verification_code_open" value="" class="form-control"
                placeholder="Codigo Verificacion">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('cashRegister')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
