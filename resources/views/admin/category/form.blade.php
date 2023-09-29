<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" class="form-control" placeholder="Nombre">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="description">Descripcion</label>
            <input type="text" name="description" value="{{ old('description', $category->description ?? '') }}" class="form-control" placeholder="Descripcion">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="company_tax_id">Impuesto</label>
        <div class="select">
            <select id="company_tax_id" name="company_tax_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ old('company_tax_id', $category->company_tax_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar porcentage</option>
                @foreach($companyTaxes as $companyTax)
                    @if(old('company_tax_id', $category->company_tax_id ?? '') == $companyTax->id)
                        <option value="{{ $companyTax->id }}" selected>{{ $companyTax->name }} - {{ $companyTax->percentage->percentage }}</option>
                    @else
                        <option value="{{ $companyTax->id }}">{{ $companyTax->name }} - {{ $companyTax->percentage->percentage }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="utility_rate">Utilidad</label>
            <input type="number" name="utility_rate" value="{{ old('utility_rate', $category->utility_rate ?? '') }}" class="form-control" placeholder="Porcentage de Utilidad">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('category')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
