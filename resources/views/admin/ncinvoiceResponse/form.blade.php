
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="ncinvoice_id">Factura de compra #</label>
            <input type="text" name="ncinvoice_id" class="form-control" value="{{ old('ncinvoice_id', $ncinvoiceResponse->ncinvoice_id ?? '') }}" placeholder="Documento">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="document">Documento</label>
            <input type="text" name="document" class="form-control" value="{{ old('document', $ncinvoiceResponse->document ?? '') }}" placeholder="Documento">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="cude">Cuds</label>
            <input type="text" name="cude" class="form-control" value="{{ old('cude', $ncinvoiceResponse->cuds ?? '') }}" placeholder="Cuds">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="message">Mensaje</label>
            <input type="text" name="message" class="form-control" value="{{ old('message', $ncinvoiceResponse->message ?? '') }}" placeholder="Mensaje">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="valid">Validacion</label>
            <input type="text" name="valid" class="form-control" value="{{ old('valid', $ncinvoiceResponse->valid ?? '') }}" placeholder="Validacion">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $ncinvoiceResponse->code ?? '') }}" placeholder="Codigo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="description">Descripcion</label>
            <input type="text" name="description" class="form-control" value="{{ old('description', $ncinvoiceResponse->description ?? '') }}" placeholder="Descripcion">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="status_message">Estado Mensaje</label>
            <input type="text" name="status_message" class="form-control" value="{{ old('status_message', $ncinvoiceResponse->status_message ?? '') }}" placeholder="Mensaje estado">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
        <a href="{{url('ncinvoiceResponse')}}" class="btn btn-blueGrad btn-md"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
    </div>
</div>
