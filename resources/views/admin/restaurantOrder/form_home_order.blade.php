<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-6">
        <div class="box-danger">
            <label class="form-control-label">
                <h3>Agrergar Datos para Domicilio</h3>
            </label>
        </div>
    </div>
    <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="customer_home_id">Usuarios Domicilios</label>
            <select name="customer_home_id" class="form-control selectpicker" id="customer_home_id"
                data-live-search="true">
                <option value="" disabled selected>Seleccionar</option>
                @foreach ($customerHomes as $customerHome)
                    <option value="{{ $customerHome->id }}_{{ $customerHome->name }}_{{ $customerHome->address }}_{{ $customerHome->phone }}">{{ $customerHome->phone }} - {{ $customerHome->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="addName">
        <div class="form-group">
            <label class="form-control-label" for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name', $restaurantOrder->homeOrder->name ?? '') }}"
                class="form-control" placeholder="Direccion">
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="addAddress">
        <div class="form-group">
            <label class="form-control-label" for="address">Direccion</label>
            <input type="text" id="address" name="address" value="{{ old('address', $restaurantOrder->homeOrder->address ?? '') }}"
                class="form-control" placeholder="Direccion">
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="addPhone">
        <div class="form-group">
            <label class="form-control-label" for="phone">Telefono</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $restaurantOrder->homeOrder->phone ?? '') }}"
                class="form-control" placeholder="Telefono">
        </div>
    </div>
</div>
