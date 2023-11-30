<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $restaurantTable->name ?? '') }}" class="form-control" placeholder="Nombre">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="branch_id">Sucursal</label>
        <div class="select">
            <select id="branch_id" name="branch_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($restaurantTable->branch_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Sucursal</option>
                @foreach($branchs as $branch)
                    @if($branch->id == ($restaurantTable->branch_id ?? ''))
                        <option value="{{ $branch->id }}" selected>{{ $branch->name }}</option>
                    @else
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('restaurantTable')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
