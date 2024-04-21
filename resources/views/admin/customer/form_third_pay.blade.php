<div class="box-body row">
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="third_id">{{ $third->id }}</label>
            <input type="number" name="third_id" id="third_id" value="{{ $third->id }}" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="third">Tercero</label>
            <input type="text" name="third" value="{{ $third->name }}" class="form-control" id="third" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="pendient">Pendiente</label>
            <input type="number" id="pendient" value="{{ $sumInvoices }}" class="form-control" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
</div>
