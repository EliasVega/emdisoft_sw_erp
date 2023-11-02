<div class="box-body row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="number" name="code" value="{{ old('code', $overtimeType->code ?? '') }}" class="form-control" placeholder="Codigo">
        </div>
    </div>

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <label for="hour_type">Tipo de Hora</label>
            <input type="text" name="hour_type" value="{{ old('hour_type', $overtimeType->hour_type ?? '') }}" class="form-control" placeholder="Tipo de Hora">
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <label for="apply_hour">Tipo de Hora</label>
            <input type="text" name="apply_hour" value="{{ old('apply_hour', $overtimeType->apply_hour ?? '') }}" class="form-control" placeholder="Horario que aplica">
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <label for="percentage">Tipo de Hora</label>
            <input type="text" name="percentage" value="{{ old('percentage', $overtimeType->percentage ?? '') }}" class="form-control" placeholder="Tipo de Hora">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('overtimeType')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
