<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-enable">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Activar cuenta contable</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="trigger">Tipo de activación</label>
                    <select name="trigger" id="trigger" class="form-control selectpicker" data-live-search="true" data-container="body">
                        <option disabled>Seleccionar tipo de activación</option>
                        <option value="payment_method" selected>Método de pago</option>
                        <option value="category">Categoría</option>
                        <option value="percentage">Porcentaje de impuesto</option>
                        <option value="expense">Cuentas por pagar</option>
                        <option value="income">Cuentas por cobrar</option>
                        <option value="discount">Descuentos</option>
                        <option value="advance">Anticipos</option>
                        <option value="other">Otros</option>
                    </select>
                </div>
                <div class="form-group" id="movement_container">
                    <label for="movement">Tipo de movimiento</label>
                    <div class="select">
                        <select id="movement" name="movement" class="form-control selectpicker" data-live-search="true" data-container="body" required>
                            <option selected disabled>Seleccionar tipo de movimiento</option>
                            <option value="inventory" {{ old('movement') == 'inventory' ? "selected" : "" }}>Inventarios</option>
                            <option value="cost" {{ old('movement') == 'cost' ? "selected" : "" }}>Costos de venta</option>
                            <option value="refund" {{ old('movement') == 'refund' ? "selected" : "" }}>Devoluciones</option>
                            <option value="entry" {{ old('movement') == 'entry' ? "selected" : "" }}>Ingresos</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="type_container">
                    <label for="type">Tipo de cuenta</label>
                    <div class="select">
                        <select id="type" name="type" class="form-control selectpicker" data-live-search="true" data-container="body" required>
                            <option selected disabled>Seleccionar tipo de activación</option>
                            <option value="purchases" {{ old('type') == 'purchases' ? "selected" : "" }}>Compras</option>
                            <option value="sales" {{ old('type') == 'sales' ? "selected" : "" }}>Ventas</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="banks">
                    <label for="bank_id">Bancos</label>
                    <div class="select">
                        <select id="bank_id" name="bank_id" class="form-control selectpicker" data-live-search="true" data-container="body" required>
                            <option selected disabled>Seleccionar banco</option>
                            @foreach($banks as $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group" id="banks_account">
                    <label for="bank_account">Cuenta bancaria</label>
                    <input type="text" id="bank_account" name="bank_account" class="form-control" placeholder="Cuenta bancaria" required>
                </div>
                <div class="form-group" id="triggers">
                    <label for="type">Activador</label>
                    <div class="form-row">
                        <div class="col-12 col-md-9" id="payment_methods">
                            <div class="select">
                                <select id="payment_method_id" name="payment_method_id" class="form-control selectpicker" data-live-search="true" data-container="body" required>
                                    <option value="seleccionar" selected disabled>Seleccionar método de pago</option>
                                    @foreach($paymentMethods as $paymentMethod)
                                        <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-9" id="categories">
                            <div class="select">
                                <select id="category_id" name="category_id" class="form-control selectpicker" data-live-search="true" data-container="body" required>
                                    <option value="seleccionar" selected disabled>Seleccionar categoría</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-9" id="addCompanyTax">
                            <div class="select">
                                <select id="company_tax_id" name="company_tax_id" class="form-control selectpicker" data-live-search="true" data-container="body" required>
                                    <option value="seleccionar" selected disabled>Seleccionar impuesto</option>
                                    @foreach($companyTaxes as $companyTax)
                                        <option value="{{ $companyTax->id }}">{{ $companyTax->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <a class="btn btn-primary btn-block" id="add_trigger">Añadir</a>
                        </div>
                        <div class="col-12 pt-4">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="triggers_table">
                                    <thead class="table-primary">
                                    <th>Nombre</th>
                                    <th>Opciones</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center" id="triggers_informative_row" colspan="2">
                                            No se han incluido activadores a la cuenta
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" type="button" id="submit_enable">Confirmar</button>
            </div>
        </div>
    </div>
</div>
