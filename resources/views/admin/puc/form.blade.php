<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addClasses">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="idClass">
            <label for="account_class_id">id</label>
            <input type="text" name="account_class_id" id="account_class_id" class="form-control" placeholder="Clase" readonly>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <label for="account_class_code" class="col-form-label">Clase</label>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <input type="text" name="account_class_code" id="account_class_code" class="form-control" placeholder="Clase" readonly>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="labelClass">
            <label for="account_class_name" class="col-form-label">Clase</label>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <input type="text" name="account_class_name" id="account_class_name" class="form-control" placeholder="Nombre Clase" readonly>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addGroups">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="idGroup">
            <label for="account_class_id">id</label>
            <input type="text" name="account_group_id" id="account_group_id" class="form-control" placeholder="Grupo id" readonly>
    </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <label for="account_group_code" class="col-form-label">Grupo</label>
            <button class="btn btn-link" type="button" id="addAccountNew" data-toggle="tooltip" data-placement="top" title="Agregar Cuenta"><i class="fas fa-plus"></i></button>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <input type="text" name="account_group_code" id="account_group_code" class="form-control" placeholder="Grupo" readonly>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="labelGroup">
            <label for="account_group_name" class="col-form-label">Clase</label>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <input type="text" name="account_group_name" id="account_group_name" class="form-control" placeholder="Nombre Grupo" readonly>
        </div>
    </div>
</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addAccounts">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="idAccount">
            <label for="account_id">id</label>
            <input type="text" name="account_id" id="account_id" class="form-control" placeholder="Cuenta id" readonly>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <label for="account_code" class="col-form-label">Cuenta</label>
            <button class="btn btn-link" type="button" id="addSubaccountNew" data-toggle="tooltip" data-placement="top" title="Agregar Sub cuenta"><i class="fas fa-plus"></i></button>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <input type="text" name="account_code" id="account_code" class="form-control" placeholder="Cuenta" readonly>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="labelAccount">
            <label for="account_name" class="col-form-label">Clase</label>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <input type="text" name="account_name" id="account_name" class="form-control" placeholder="Nombre Cuenta" readonly>
        </div>
    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formAccounts">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <label for="account_code" class="col-form-label">Cuenta</label>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <input type="number" name="account_code" id="code_account" class="form-control" maxlength="2" oninput="if(this.value.length> this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="code" />
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="accountLabel">
            <label for="name_account" class="col-form-label">Clase</label>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <input type="text" name="name_account" id="name_account" class="form-control" placeholder="Nombre Cuenta">
        </div>
    </div>
</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addSubaccounts">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="idSubaccount">
            <label for="subaccount_id">id</label>
            <input type="text" name="subaccount_id" id="subaccount_id" class="form-control" placeholder="Cuenta id" readonly>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <label for="subaccount_code" class="col-form-label">Sub Cuenta</label>
            <button class="btn btn-link" type="button" id="addAuxiliaryNew" data-toggle="tooltip" data-placement="top" title="Agregar Auxiliar"><i class="fas fa-plus"></i></button>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <input type="text" name="subaccount_code" id="subaccount_code" class="form-control" placeholder="Cuenta" readonly>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="labelSubaccount">
            <label for="subaccount_name" class="col-form-label">Nombre</label>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <input type="text" name="subaccount_name" id="subaccount_name" class="form-control" placeholder="Nombre Cuenta" readonly>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formSubaccounts">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <label for="code_subaccount" class="col-form-label">Sub Cuenta</label>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <input type="number" name="code_subaccount" id="code_subaccount" class="form-control" maxlength="2" oninput="if(this.value.length> this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="code" />
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="subaccountLabel">
            <label for="name_subaccount" class="col-form-label">Nombre</label>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <input type="text" name="name_subaccount" id="name_subaccount" class="form-control" placeholder="Nombre Cuenta">
        </div>
    </div>
</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addAuxiliaries">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="idAuxiliary">
            <label for="auxiliary_account_id">id</label>
            <input type="text" name="auxiliary_account_id" id="auxiliary_account_id" class="form-control" placeholder="id" readonly>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <label for="auxiliary_account_code" class="col-form-label">Auxiliar</label>
            <button class="btn btn-link" type="button" id="addSubauxiliaryNew" data-toggle="tooltip" data-placement="top" title="Agregar Sub Auxiliar"><i class="fas fa-plus"></i></button>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <input type="text" name="auxiliary_account_code" id="auxiliary_account_code" class="form-control" placeholder="Codigo" readonly>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="labelAuxiliary">
            <label for="auxiliary_account_name" class="col-form-label">Nombre</label>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <input type="text" name="auxiliary_account_name" id="auxiliary_account_name" class="form-control" placeholder="Nombre" readonly>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formAuxiliaries">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <label for="code_auxiliary_account" class="col-form-label">Auxiliar</label>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <input type="number" name="code_auxiliary_account" id="code_auxiliary_account" class="form-control" maxlength="2" oninput="if(this.value.length> this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="code"/>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="auxiliaryLabel">
            <label for="name_auxiliary_account" class="col-form-label">Nombre</label>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <input type="text" name="name_auxiliary_account" id="name_auxiliary_account" class="form-control" placeholder="Nombre">
        </div>
    </div>
</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addSubauxiliaries">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="idSubauxiliary">
            <label for="subauxiliary_account_id">id</label>
            <input type="text" name="subauxiliary_account_id" id="subauxiliary_account_id" class="form-control" placeholder="id" readonly>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <label for="subauxiliary_account_code" class="col-form-label">Sub Auxiliar</label>
            <button class="btn btn-link" type="button" id="subauxiliaryNew" data-toggle="tooltip" data-placement="top" title="Agregar Sub Auxiliar"><i class="fas fa-plus"></i></button>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <input type="text" name="subauxiliary_account_code" id="subauxiliary_account_code" class="form-control" placeholder="Codigo" readonly>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="labelSubauxiliary">
            <label for="subauxiliary_account_name" class="col-form-label">Nombre</label>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <input type="text" name="subauxiliary_account_name" id="subauxiliary_account_name" class="form-control" placeholder="Nombre" readonly>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="formSubauxiliaries">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <label for="code_subauxiliary_account" class="col-form-label">Sub Auxiliar</label>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <input type="number" name="code_subauxiliary_account" id="code_subauxiliary_account" class="form-control" maxlength="2" oninput="if(this.value.length> this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="code"/>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="subauxiliaryLabel">
            <label for="name_subauxiliary_account" class="col-form-label">Nombre</label>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <input type="text" name="name_subauxiliary_account" id="name_subauxiliary_account" class="form-control" placeholder="Nombre">
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="addTypeAccoun">
            <label for="type_account">tipo de cuenta</label>
            <input type="text" name="type_account" id="type_account" class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="trigger_method_id" class="required">Tipo Activacion</label>
        <div class="select">
            <select id="trigger_method_id" name="trigger_method_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($puc->trigger_method_id ?? '') == '' ? "selected" : "" }} disabled>Tipo Activacion</option>
                @foreach($triggerMethods as $triggerMethod)
                    @if($triggerMethod->id == ($puc->trigger_method_id ?? ''))
                        <option value="{{ $triggerMethod->id }}" selected>{{ $triggerMethod->name }}</option>
                    @else
                        <option value="{{ $triggerMethod->id }}">{{ $triggerMethod->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="movement_type_id" class="required">Tipo movimiento</label>
        <div class="select">
            <select id="movement_type_id" name="movement_type_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($puc->movement_type_id ?? '') == '' ? "selected" : "" }} disabled>Tipo Activacion</option>
                @foreach($movementTypes as $movementType)
                    @if($movementType->id == ($puc->movement_type_id ?? ''))
                        <option value="{{ $movementType->id }}" selected>{{ $movementType->name }}</option>
                    @else
                        <option value="{{ $movementType->id }}">{{ $movementType->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="operation_type_id" class="required">Tipo Operacion</label>
        <div class="select">
            <select id="operation_type_id" name="operation_type_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($puc->operation_type_id ?? '') == '' ? "selected" : "" }} disabled>Tipo Activacion</option>
                @foreach($operationTypes as $operationType)
                    @if($operationType->id == ($puc->operation_type_id ?? ''))
                        <option value="{{ $operationType->id }}" selected>{{ $operationType->name }}</option>
                    @else
                        <option value="{{ $operationType->id }}">{{ $operationType->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('puc')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
