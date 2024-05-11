<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="branch_id">Sucursal</label>
        <div class="select">
            <select id="branch_id" name="branch_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($salePoints->branch_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar...</option>
                @foreach($branchs as $branch)
                    @if($branch->id == ($salePoint->branch_id ?? ''))
                        <option value="{{ $branch->id }}" selected>{{ $branch->name }}</option>
                    @else
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="plate_number">Numero de placa</label>
            <input type="text" name="plate_number" value="{{ old('plate_number', $salePoint->plate_number ?? '') }}" class="form-control" placeholder="Placa">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="location">Ubicacion</label>
            <input type="text" name="location" value="{{ old('location', $salePoint->location ?? '') }}" class="form-control" placeholder="Ubicacion">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="cash_type">Typo de caja</label>
            <input type="text" name="cash_type" value="{{ old('cash_type', $salePoint->cash_type ?? '') }}" class="form-control" placeholder="Nombre o typo">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('salePoint')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
