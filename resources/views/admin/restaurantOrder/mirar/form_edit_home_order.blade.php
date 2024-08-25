<div class="box-body row">
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="editName">
        <div class="form-group">
            <label class="form-control-label" for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name', $restaurantOrder->homeOrder->name ?? '') }}"
                class="form-control" placeholder="Direccion">
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="editAddress">
        <div class="form-group">
            <label class="form-control-label" for="address">Direccion</label>
            <input type="text" id="address" name="address" value="{{ old('address', $restaurantOrder->homeOrder->address ?? '') }}"
                class="form-control" placeholder="Direccion">
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="editPhone">
        <div class="form-group">
            <label class="form-control-label" for="phone">Telefono</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $restaurantOrder->homeOrder->phone ?? '') }}"
                class="form-control" placeholder="Telefono">
        </div>
    </div>
</div>
