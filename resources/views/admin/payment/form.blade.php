<div class="box-body row">
    <div class="col-lg-2 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="third_id">id</label>
            <input type="number" name="third_id" value="{{ $third->id }}" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="identification">id</label>
            <input type="text" name="identification" value="{{ $third->identification }}" class="form-control" id="identification" disabled>
        </div>
    </div>
    <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="third">Tercero</label>
            <input type="text" name="third" value="{{ $third->name }}" class="form-control" id="third" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12" id="typeThird">
        <div class="form-group">
            <label class="form-control-label" for="type_third">tipo</label>
            <input type="text" name="type_third" value="{{ $typeThird }}" class="form-control" id="type_third">
        </div>
    </div>
    <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12" id="typeDocument">
        <div class="form-group">
            <label class="form-control-label" for="type_document">tipo</label>
            <input type="text" name="type_document" value="{{ $typeDocument }}" class="form-control" id="type_document">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label">Saldo pendiente</label>
            <input type="number" id="pendient" value="{{ $sumDocuments }}" class="form-control" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
</div>
