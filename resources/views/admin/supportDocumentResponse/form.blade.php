<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="purchase_id">Municipio</label>
        <div class="select">
            <select id="purchase_id" name="purchase_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($supportDocumentResponse->purchase->id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Departamento</option>
                @foreach($purchases as $purchase)
                    @if($purchase->id == ($supportDocumentResponse->purchase->id ?? ''))
                        <option value="{{ $purchase->id }}" selected>{{ $purchase->document }}</option>
                    @else
                        <option value="{{ $purchase->id }}">{{ $purchase->document }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="document">Documento</label>
            <input type="text" name="document" class="form-control" value="{{ old('document', $supportDocumentResponse->document ?? '') }}" placeholder="Documento">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="cuds">Cuds</label>
            <input type="text" name="cuds" class="form-control" value="{{ old('cuds', $supportDocumentResponse->cuds ?? '') }}" placeholder="Cuds">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="message">Mensaje</label>
            <input type="text" name="message" class="form-control" value="{{ old('message', $supportDocumentResponse->message ?? '') }}" placeholder="Mensaje">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="valid">Validacion</label>
            <input type="text" name="valid" class="form-control" value="{{ old('valid', $supportDocumentResponse->valid ?? '') }}" placeholder="Validacion">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $supportDocumentResponse->code ?? '') }}" placeholder="Codigo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="description">Descripcion</label>
            <input type="text" name="description" class="form-control" value="{{ old('description', $supportDocumentResponse->description ?? '') }}" placeholder="Descripcion">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="status_message">Estado Mensaje</label>
            <input type="text" name="status_message" class="form-control" value="{{ old('status_message', $supportDocumentResponse->status_message ?? '') }}" placeholder="Mensaje estado">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
        <a href="{{url('postalCode')}}" class="btn btn-blueGrad btn-md"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
    </div>
</div>
