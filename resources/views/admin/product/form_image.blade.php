<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="image">Imagen</label>
            <input type="file" id="image" name="image" data-initial-preview="{{ old('image', $product->image ?? '') }}" accept="image/*" data-msg-placeholder="Seleccionar archivo"/>
        </div>
    </div>
    @if ($indicator->raw_material == 'off')
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <button class="btn btn-lightBlueGrad btn-md mt-3" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
                <a href="{{url('product')}}" class="btn btn-blueGrad mt-3"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
            </div>
        </div>
    @endif
</div>
