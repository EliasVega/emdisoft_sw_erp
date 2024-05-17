@extends('layouts.admin')
@section('title')
    Editar PUC |
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                Editar PUC
                            </h3>
                        </div>
                        {!! Form::open(['method' => 'PATCH', 'route' => ['pucs.update', $puc->id], 'autocomplete' => 'off']) !!}
                        {!! Form::token() !!}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="trigger">Tipo de relación</label>
                                    <select name="trigger" id="trigger" class="form-control selectpicker" data-live-search="true" data-container="body" disabled>
                                        <option disabled>Seleccionar tipo de relacion</option>
                                        <option value="payment_method" {{ old('trigger', $puc->trigger ?? '') == 'payment_method' ? "selected" : "" }}>Método de pago</option>
                                        <option value="category" {{ old('trigger', $puc->trigger ?? '') == 'category' ? "selected" : "" }}>Categoría</option>
                                        <option value="percentage" {{ old('trigger', $puc->trigger ?? '') == 'percentage' ? "selected" : "" }}>Porcentaje de impuesto</option>
                                        <option value="expense" {{ old('trigger', $puc->trigger ?? '') == 'expense' ? "selected" : "" }}>Cuentas por pagar</option>
                                        <option value="income" {{ old('trigger', $puc->trigger ?? '') == 'income' ? "selected" : "" }}>Cuentas por cobrar</option>
                                        <option value="discount" {{ old('trigger', $puc->trigger ?? '') == 'discount' ? "selected" : "" }}>Descuentos</option>
                                        <option value="advance" {{ old('trigger', $puc->trigger ?? '') == 'advance' ? "selected" : "" }}>Anticipo</option>
                                        <option value="other" {{ old('trigger', $puc->trigger ?? '') == 'other' ? "selected" : "" }}>Otros</option>
                                    </select>
                                </div>
                                @if($puc->trigger == 'payment_method')
                                    <div class="form-group">
                                        <label for="bank_id">Bancos</label>
                                        <div class="select">
                                            <select id="bank_id" name="bank_id" class="form-control selectpicker" data-live-search="true" data-container="body" {{ $puc->bank_id != '' ? '' : 'disabled' }} required>
                                                @if($puc->bank_id == '')
                                                    <option selected disabled>No aplica</option>
                                                @else
                                                    @foreach($banks as $bank)
                                                        @if(old('bank_id', $puc->bank_id ?? '') == $bank->id)
                                                            <option value="{{ $bank->id }}" selected>{{ $bank->name }}</option>
                                                        @else
                                                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_account">Cuenta bancaria</label>
                                        <input type="text" id="bank_account" name="bank_account" class="form-control" placeholder="Cuenta bancaria" value="{{ $puc->bank_account != '' ? $puc->bank_account : 'No aplica' }}" {{ $puc->bank_account != '' ? '' : 'disabled' }} required>
                                    </div>
                                @endif
                                @if($puc->trigger == 'category')
                                    <div class="form-group">
                                        <label for="movement">Tipo de movimiento</label>
                                        <div class="select">
                                            <select id="movement" name="movement" class="form-control selectpicker" data-live-search="true" data-container="body" required>
                                                <option selected disabled>Seleccionar tipo de movimiento</option>
                                                <option value="inventory" {{ old('movement', $puc->movement ?? '') == 'inventory' ? "selected" : "" }}>Inventarios</option>
                                                <option value="cost" {{ old('movement', $puc->movement ?? '') == 'cost' ? "selected" : "" }}>Costos de venta</option>
                                                <option value="refund" {{ old('movement', $puc->movement ?? '') == 'refund' ? "selected" : "" }}>Devoluciones</option>
                                                <option value="entry" {{ old('movement', $puc->movement ?? '') == 'entry' ? "selected" : "" }}>Ingresos</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                @if($puc->trigger == 'percentage' || $puc->trigger == 'advance')
                                    <div class="form-group">
                                        <label for="type">Tipo de cuenta</label>
                                        <div class="select">
                                            <select id="type" name="type" class="form-control selectpicker" data-live-search="true" data-container="body" required>
                                                <option selected disabled>Seleccionar tipo de activación</option>
                                                <option value="purchases" {{ old('type', $puc->type ?? '') == 'purchases' ? "selected" : "" }}>Compras</option>
                                                <option value="sales" {{ old('type', $puc->type ?? '') == 'sales' ? "selected" : "" }}>Ventas</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                @if($puc->trigger != 'expense' && $puc->trigger != 'income' && $puc->trigger != 'discount' && $puc->trigger != 'advance' && $puc->trigger != 'other')
                                    <div class="form-group">
                                        <label>Activador</label>
                                        <div class="form-row">
                                            @if($puc->trigger == 'payment_method')
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
                                            @elseif($puc->trigger == 'category')
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
                                            @elseif($puc->trigger == 'percentage')
                                                <div class="col-12 col-md-9" id="percentages">
                                                    <div class="select">
                                                        <select id="percentage_id" name="percentage_id" class="form-control selectpicker" data-live-search="true" data-container="body" required>
                                                            <option value="seleccionar" selected disabled>Seleccionar impuesto</option>
                                                            @foreach($percentages as $percentage)
                                                                <option value="{{ $percentage->id }}">{{ $percentage->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
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
                                                        @foreach($puc->triggers as $trigger)
                                                            <tr class="selected" id="trigger_row_{{ $trigger->id }}">
                                                                <input class="form-control" type="hidden" id="triggers_row[]" name="triggers_row[]" value="{{ $trigger->id }}">
                                                                <input class="form-control" type="hidden" id="trigger_{{ $trigger->id }}" name="triggers[]" value="{{ $trigger->triggerable->id }}">
                                                                <td>
                                                                    <input class="form-control w-sm-auto" type="text" name="triggers_name[]" id="triggers_name[]" value="{{ $trigger->triggerable->name }}" readonly>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-danger" id="delete_trigger_row" data-row="{{ $trigger->id }}">X</button>
                                                                </td>
                                                            </tr>
                                                            @if($loop->last)
                                                                <input class="form-control" type="hidden" id="accountings_count" name="triggers_count" value="{{ $trigger->id }}">
                                                            @endif
                                                        @endforeach
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
                                @endif
                                <div class="form-group">
                                    <button class="btn btn-primary" id="save" type="submit">Guardar</button>
                                    <a class="btn btn-danger" type="reset" href="{{ route('pucs.index') }}">Cancelar</a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#triggers_informative_row").hide();

                // Registro de un activador
                $("#add_trigger").click(addTrigger);

                // Variables globales asociadas a la tabla de activadores
                let triggersCount = parseInt($("#accountings_count").val()) + 1;

                // Función encargada de añadir una fila en la tabla de activadores
                function addTrigger() {
                    let trigger = $("#trigger").val();
                    let triggerId = '';
                    let triggerName = '';
                    if (trigger == 'payment_method') {
                        triggerId = $("#payment_method_id").val();
                        triggerName = $("#payment_method_id option:selected").text();
                    } else if (trigger == 'category') {
                        triggerId = $("#category_id").val();
                        triggerName = $("#category_id option:selected").text();
                    } else if (trigger == 'percentage') {
                        triggerId = $("#percentage_id").val();
                        triggerName = $("#percentage_id option:selected").text();
                    }

                    if (triggerId != "") {
                        let row = '<tr class="selected" id="trigger_row_' + triggersCount + '">' +
                            '<input class="form-control" type="hidden" name="triggers_row[]" id="triggers_row[]" value="' + triggersCount + '">' +
                            '<input class="form-control" type="hidden" id="trigger_' + triggersCount +'" name="triggers[]" value="' + triggerId + '">' +
                            '<td><input class="form-control w-sm-auto" type="text" id="triggers_name[]" name="triggers_name[]" value="' + triggerName + '" readonly></td>' +
                            '<td><button type="button" class="btn btn-danger" id="delete_trigger_row" data-row="'+ triggersCount +'">X</button></td></tr>';
                        $("#triggers_table").append(row);
                        triggersCount++;

                        cleanTriggerInputs();
                        evaluateTriggerTable();
                    } else {
                        alert("Error al añadir el activador, por favor revise los datos.")
                    }
                }

                // Función encargada de limpiar los campos referentes a los descuentos
                function cleanTriggerInputs() {
                    let trigger = $("#trigger").val();

                    if (trigger == 'payment_method') {
                        $("#payment_method_id").val("seleccionar");
                        $("#payment_method_id").selectpicker('refresh');
                    } else if (trigger == 'category') {
                        $("#category_id").val("seleccionar");
                        $("#category_id").selectpicker('refresh');
                    } else if (trigger == 'percentage') {
                        $("#percentage_id").val("seleccionar");
                        $("#percentage_id").selectpicker('refresh');
                    }
                }

                // Función encargada de evaluar la información presente en la tabla de activadores
                function evaluateTriggerTable() {
                    if ($('input[name="triggers_row[]"]').length > 0) {
                        $("#triggers_informative_row").hide();
                    } else {
                        $("#triggers_informative_row").show();
                    }
                }

                // Eliminación de un activador
                $(document).on('click', '#delete_trigger_row', function() {
                    let row = $(this).data('row');
                    deleteTriggerRow(row);
                });

                // Función encargada de eliminar una fila en la tabla de activadores
                function deleteTriggerRow(index) {
                    $("#trigger_row_" + index).remove();
                    evaluateTriggerTable();
                }
            });
        </script>
    @endpush
@endsection
