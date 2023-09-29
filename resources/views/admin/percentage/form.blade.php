<div class="box-body row">

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre </label>
            <input type="text" name="name" value="{{ old('name', $percentage->name ?? '') }}" class="form-control" placeholder="Ingrese el nombre">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="tax_type_id">Impuesto</label>
        <div class="select">
            <select id="tax_type_id" name="tax_type_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ old('tax_type_id', $percentage->tax_type_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Impuesto</option>
                @foreach($taxTypes as $taxType)
                    @if(old('tax_type_id_id', $percentage->tax_type_id ?? '') == $taxType->id)
                        <option value="{{ $taxType->id }}" selected>{{ $taxType->name }}</option>
                    @else
                        <option value="{{ $taxType->id }}">{{ $taxType->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="concept">Descripcion </label>
            <input type="text" name="concept" value="{{ old('concept', $percentage->concept ?? '') }}" class="form-control" placeholder="Ingrese el concepto">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="percentage">Porcentaje</label>
            <input type="number" name="percentage" value="{{ old('percentage', $percentage->percentage ?? '') }}" class="form-control" placeholder="porcentaje" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="base">
        <div class="form-group">
            <label for="base">Base</label>
            <input type="number" name="base" value="0" class="form-control" placeholder="Ingrese la base de retencion">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="baseUVT">
        <div class="form-group">
            <label for="base_uvt">Base UVT</label>
            <input type="number" name="base_uvt" value="0" class="form-control" placeholder="Ingrese la base de retencion en UVT">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('percentage')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
