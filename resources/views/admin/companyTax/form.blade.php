<div class="box-body row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $companyTax->name ?? '') }}" class="form-control" placeholder="Tributo">
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="description">Descripcion</label>
            <input type="text" name="description" value="{{ old('description', $companyTax->description ?? '') }}" class="form-control" placeholder="Descripcion">
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <label for="tax_type_id">Impuesto</label>
        <div class="select">
            <select id="tax_type_id" name="tax_type_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ old('tax_type_id', $companyTax->tax_type_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Impuesto</option>
                @foreach($taxTypes as $taxType)
                    @if(old('tax_type_id_id', $companyTax->tax_type_id ?? '') == $taxType->id)
                        <option value="{{ $taxType->id }}" selected>{{ $taxType->name }}</option>
                    @else
                        <option value="{{ $taxType->id }}">{{ $taxType->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <label for="percentage_id">Porcentage</label>
        <div class="select">
            <select id="percentage_id" name="percentage_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ old('percentage_id', $companyTax->percentage_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar porcentage</option>
                @foreach($percentages as $percentage)
                    @if(old('companyTax_id', $companyTax->percentage_id ?? '') == $percentage->id)
                        <option value="{{ $percentage->id }}" selected>{{ $percentage->name }}</option>
                    @else
                        <option value="{{ $percentage->id }}">{{ $percentage->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('companyTax')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
