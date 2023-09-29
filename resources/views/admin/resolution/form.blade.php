<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="document_type_id">Tipo de Documento</label>
        <div class="select">
            <select id="document_type_id" name="document_type_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($resolution->document_type_id ?? '') == '' ? "selected" : "" }} disabled>Tipo de Documento</option>
                @foreach($documentTypes as $documentType)
                    @if($documentType->id == ($resolution->document_type_id ?? ''))
                        <option value="{{ $documentType->id }}" selected>{{ $documentType->name }}</option>
                    @else
                        <option value="{{ $documentType->id }}">{{ $documentType->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="prefix">Prefijo</label>
            <input type="text" name="prefix" value="{{ old('prefix', $resolution->prefix ?? '') }}" class="form-control" placeholder="Prefijo">
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="resolution">Resolucion</label>
            <input type="text" name="resolution" value="{{ old('resolution', $resolution->resolution ?? '') }}" class="form-control" placeholder="Resolucion">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="resolution_date">Fecha Res.</label>
            <input type="date" name="resolution_date" value="{{ old('resolution_date', $resolution->resolution_date ?? '') }}" class="form-control" placeholder="Fecha Res.">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="start_number">Inicia</label>
            <input type="number" id="start_number" name="start_number" value="{{ old('start_number', $resolution->start_number ?? '') }}" class="form-control" placeholder="Numero Inicial" pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="end_number">Termina</label>
            <input type="number" id="end_number" name="end_number" value="{{ old('end_number', $resolution->end_number ?? '') }}" class="form-control" placeholder="Numero Final" pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="consecutive">Generadas</label>
            <input type="number" id="consecutive" name="consecutive" value="{{ old('consecutive', $resolution->consecutive ?? '') }}" class="form-control" placeholder="Generadas" pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="start_date">Fecha Desde</label>
            <input type="date" name="start_date" value="{{ old('start_date', $resolution->start_date ?? '') }}" class="form-control" placeholder="Fecha Desde.">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="end_date">Fecha Hasta.</label>
            <input type="date" name="end_date" value="{{ old('end_date', $resolution->end_date ?? '') }}" class="form-control" placeholder="Fecha Hasta">
        </div>
    </div>


    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="technical_key">Clave tecnica</label>
            <input type="text" name="technical_key" value="{{ old('technical_key', $resolution->technical_key ?? '') }}" class="form-control" placeholder="Clave Tecnica">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="status">Estado</label>
        <select name="status" id="status" class="form-control" required>
            <option {{ ($resolution->status ?? '') == '' ? "selected" : "" }}></option>
            <option  selected="selected" value="active" {{ old('status', $resolution->status ?? '') == 'active' ? "selected" : "" }}>Activo</option>
            <option value="inactive" {{ old('status', $resolution->status ?? '') == 'inactive' ? "selected" : "" }}>Inactivo</option>
        </select>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('resolution')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
