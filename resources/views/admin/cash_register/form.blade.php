<div class="box-body row">
    @if ($points == 0)
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label for="sale_point_id">Punto de Venta</label>
            <div class="select">
                <select id="sale_point_id" name="sale_point_id" class="form-control selectpicker" data-live-search="true" required>
                    <option {{ (cashRegisterComprobation()->sale_point_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Punto de venta</option>
                    @foreach($salePoints as $salePoint)
                        @if($salePoint->id == (cashRegisterComprobation()->sale_point_id ?? ''))
                            <option value="{{ $salePoint->id }}" selected>{{ $salePoint->branch->name }} -- {{ $salePoint->cash_type }}</option>
                        @else
                            <option value="{{ $salePoint->id }}">{{ $salePoint->branch->name }} :  {{ $salePoint->cash_type }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    @else
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addPoints">
        <div class="form-group">
            <label class="form-control-label" for="sale_point_id">Punto de venta</label>
            <input type="hidden" id="sale_point_id" name="sale_point_id" value="{{ $points }}" class="form-control"
                placeholder="Punto de venta">
        </div>
    </div>
    @endif

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="start_date">Fecha Apertura</label>
            <input type="date" name="start_date" id="start_date" class="form-control"
                value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Apertura de caja">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="valorcito">
        <div class="form-group">
            <label class="form-control-label" for="cash_initial">Efectivo Inicial</label>
            <input type="number" id="cash_initial" name="cash_initial" value="0" class="form-control"
                placeholder="Efectivo" >
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="user_open_id">Admin Apertura</label>
            <select name="user_open_id" class="form-control selectpicker" id="user_open_id"
                data-live-search="true">
                <option value="" disabled selected>Seleccionar....</option>
                @foreach($users as $usa)
                <option value="{{ $usa->id }}">{{ $usa->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="valorcito">
        <div class="form-group">
            <label class="form-control-label" for="verification_code_open">Codigo de verificacion</label>
            <input type="password" id="verification_code_open" name="verification_code_open" value="" class="form-control"
                placeholder="Codigo Verificacion">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('cashRegister')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
