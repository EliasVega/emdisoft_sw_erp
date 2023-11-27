<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="smlv">Salario Minimo legal vigente</label>
            <input type="text" name="smlv" value="{{ old('smlv', $indicator->smlv ?? '') }}" class="form-control" placeholder="smlv">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="transport_assistance">Auxilio de trasporte</label>
            <input type="text" name="transport_assistance" value="{{ old('transport_assistance', $indicator->transport_assistance ?? '') }}" class="form-control" placeholder="transport_assistance">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="weekly_hours">Horas semanales</label>
            <input type="text" name="weekly_hours" value="{{ old('weekly_hours', $indicator->weekly_hours ?? '') }}" class="form-control" placeholder="horas semanales">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="uvt">UVT</label>
            <input type="text" name="uvt" value="{{ old('uvt', $indicator->uvt ?? '') }}" class="form-control" placeholder="UVT">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="plastic_bag_tax">Impuesto a las bolsas</label>
            <input type="text" name="plastic_bag_tax" value="{{ old('plastic_bag_tax', $indicator->plastic_bag_tax ?? '') }}" class="form-control" placeholder="impuesto a las bolsas">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('indicator')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
