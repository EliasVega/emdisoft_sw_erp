
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="ndinvoice_id">Factura de compra #</label>
            <input type="text" name="ndinvoice_id" class="form-control" value="{{ old('ndinvoice_id', $ndinvoiceResponse->ndinvoice_id ?? '') }}" placeholder="Documento">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="document">Documento</label>
            <input type="text" name="document" class="form-control" value="{{ old('document', $ndinvoiceResponse->document ?? '') }}" placeholder="Documento">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="cude">Cuds</label>
            <input type="text" name="cude" class="form-control" value="{{ old('cude', $ndinvoiceResponse->cuds ?? '') }}" placeholder="Cude">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="message">Mensaje</label>
            <input type="text" name="message" class="form-control" value="{{ old('message', $ndinvoiceResponse->message ?? '') }}" placeholder="Mensaje">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="valid">Validacion</label>
            <input type="text" name="valid" class="form-control" value="{{ old('valid', $ndinvoiceResponse->valid ?? '') }}" placeholder="Validacion">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $ndinvoiceResponse->code ?? '') }}" placeholder="Codigo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="description">Descripcion</label>
            <input type="text" name="description" class="form-control" value="{{ old('description', $ndinvoiceResponse->description ?? '') }}" placeholder="Descripcion">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="status_message">Estado Mensaje</label>
            <input type="text" name="status_message" class="form-control" value="{{ old('status_message', $ndinvoiceResponse->status_message ?? '') }}" placeholder="Mensaje estado">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
        <a href="{{url('ndinvoiceResponse')}}" class="btn btn-blueGrad btn-md"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
    </div>
</div>
