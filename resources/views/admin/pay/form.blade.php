<div class="box-body row">
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="document_id">{{ $tipeDocument }}</label>
            <input type="number" name="document_id" id="document_id" value="{{ $document->id }}" class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="third_id">Tercero</label>
            <input type="text" name="third_id" value="{{ $document->third->name }}" class="form-control" id="provider_id" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label">Pendiente</label>
            <input type="number" id="pendient" value="{{ $document->balance }}" class="form-control" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="types">
        <div class="form-group">
            <label for="voucher">Type</label>
            <input type="number" name="voucher" id="voucher" value="{{ $document->voucher_type_id }}" class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label">Fecha</label>
            <input type="text" value="{{ $document->created_at }}" class="form-control" disabled pattern="[0-9]{0,15}">
        </div>
    </div>

</div>
