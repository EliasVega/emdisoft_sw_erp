@extends('layouts.admin')
@section('title')
    PUC |
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                PUC
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row pb-2">
                                <div class="col-12">
                                    <input type="input" class="form-control" id="search" placeholder="Buscar">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div id="puc"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                Opciones de cuenta
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    {!! Form::open(['method' => 'POST', 'route' => 'puc.store', 'id' => 'multi_action_form', 'autocomplete' => 'off']) !!}
                                    {!! Form::token() !!}
                                        <div class="form-row mb-3">
                                            <input type="hidden" name="action" id="action" class="form-control">
                                            <input type="hidden" name="account_id" id="account_id" class="form-control">
                                            <div class="col-12 col-md-6">
                                                <label for="account_type">Tipo de cuenta</label>
                                                <input type="text" name="account_type" id="account_type" class="form-control" placeholder="Tipo de cuenta" readonly required>
                                            </div>
                                            <div class="col-12 col-md-6 mt-3 mt-md-0">
                                                <label for="account_selected">Cuenta</label>
                                                <input type="text" name="account_selected" id="account_selected" class="form-control" placeholder="Cuenta" readonly required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a class="btn btn-danger disabled" id="delete" href="" data-target="#modal-delete" data-toggle="modal">
                                                Eliminar
                                            </a>
                                            <a class="btn btn-success disabled" id="enable" href="" data-target="#modal-enable" data-toggle="modal">
                                                Activar
                                            </a>
                                            <a class="btn btn-secondary disabled" id="disable" href="" data-target="#modal-disable" data-toggle="modal">
                                                Desactivar
                                            </a>
                                        </div>
                                        @include('admin.puc.delete_account')
                                        @include('admin.puc.enable_account')
                                        @include('admin.puc.disable_account')
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-outline card-info collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Registrar cuenta
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    {!! Form::open(['method' => 'POST', 'route' => 'account.store', 'autocomplete' => 'off']) !!}
                                    {!! Form::token() !!}
                                        @include('admin.account.form')
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-outline card-info collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Registrar sub cuentas
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    {!! Form::open(['method' => 'POST', 'route' => 'subaccount.store', 'autocomplete' => 'off']) !!}
                                    {!! Form::token() !!}
                                        @include('admin.subaccount.form')
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-outline card-info collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Registrar cuenta auxiliar
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    {!! Form::open(['method' => 'POST', 'route' => 'auxiliaryAccount.store', 'autocomplete' => 'off']) !!}
                                    {!! Form::token() !!}
                                        @include('admin.auxiliaryAccount.form')
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            $(document).ready(function(){
                var treeData = [
                    @foreach($accountClasses as $accountClass)
                    {
                        text: "{{ $accountClass->code.' - '.$accountClass->name }}",
                        selectable: false,
                        state: {
                            expanded: false,
                        },
                        nodes: [
                            @foreach($accountClass->accountGroups as $accountGroup)
                            {
                                text: "{{ $accountGroup->code.' - '.$accountGroup->name }}",
                                selectable: false,
                                nodes: [
                                    @foreach($accountGroup->accounts as $account)
                                    {
                                        text: "{{ $account->code.' - '.$account->name }}",
                                        tags: [
                                            '{{ $account->id }}',
                                            'Cuenta',
                                            '{{ $account->state }}'
                                        ],
                                        nodes: [
                                            @foreach($account->subAccounts as $subAccount)
                                            {
                                                text: "{{ $subAccount->code.' - '.$subAccount->name }} {{ $subAccount->state == 'active' ? '(ACTIVADO)' : '' }}",
                                                tags: [
                                                    '{{ $subAccount->id }}',
                                                    'Subcuenta',
                                                    '{{ $subAccount->state }}'
                                                ],
                                                nodes: [
                                                    @foreach($subAccount->auxiliaryAccounts as $auxiliaryAccount)
                                                    {
                                                        text: "{{ $auxiliaryAccount->code.' - '.$auxiliaryAccount->name }} {{ $auxiliaryAccount->state == 'active' ? '(ACTIVADO)' : '' }}",
                                                        tags: [
                                                            '{{ $auxiliaryAccount->id }}',
                                                            'Cuenta auxiliar',
                                                            '{{ $auxiliaryAccount->state }}',
                                                            '{{ $subAccount->state }}'
                                                        ],
                                                    },
                                                    @endforeach
                                                ]
                                            },
                                            @endforeach
                                        ]
                                    },
                                    @endforeach
                                ]
                            },
                            @endforeach
                        ]
                    },
                    @endforeach
                ];
                $('#puc').treeview({
                    data: treeData,
                    collapseIcon:'fas fa-minus',
                    expandIcon:'fas fa-plus',
                    highlightSelected: true
                });

                $('#search').on('keyup', function () {
                    var searchString = $(this).val();
                    var options = {
                        ignoreCase: true,
                        exactMatch: false,
                        revealResults: true,
                    };
                    $('#puc').treeview('collapseAll', { silent: true });
                    $('#puc').treeview('search', [searchString, options]);
                });

                $('#puc').on('nodeSelected', function(event, data) {
                    $('#account_id').val(data.tags[0]);
                    $('#account_type').val(data.tags[1]);
                    $('#account_selected').val(data.text);
                    if (data.tags[1] == 'Cuenta') {
                        $('#delete').removeClass('disabled');
                        $('#enable').hide();
                        $('#disable').hide();
                    } else {
                        if (data.tags[1] == 'Subcuenta') {
                            if (data.tags[2] == 'active') {
                                $('#delete').removeClass('disabled');
                                $('#disable').removeClass('disabled');
                                $('#enable').hide();
                                $('#disable').show();
                            } else {
                                $('#delete').removeClass('disabled');
                                $('#enable').removeClass('disabled');
                                $('#enable').show();
                                $('#disable').hide();
                            }
                        } else {
                            if (data.tags[3] == 'active') {
                                $('#delete').removeClass('disabled');
                                $('#enable').hide();
                                $('#disable').hide();
                            } else {
                                if (data.tags[2] == 'active') {
                                    $('#delete').removeClass('disabled');
                                    $('#disable').removeClass('disabled');
                                    $('#enable').hide();
                                    $('#disable').show();
                                } else {
                                    $('#delete').removeClass('disabled');
                                    $('#enable').removeClass('disabled');
                                    $('#enable').show();
                                    $('#disable').hide();
                                }
                            }
                        }
                    }
                });

                $("#submit_delete").click(function() {
                    $('#action').val('delete');
                    $('#multi_action_form').submit();
                });

                $("#submit_enable").click(function() {
                    $('#action').val('enable');
                    $('#multi_action_form').submit();
                });

                $("#submit_disable").click(function() {
                    $('#action').val('disable');
                    $('#multi_action_form').submit();
                });

                $("#movement_container").hide();
                $("#type_container").hide();
                $("#categories").hide();
                $("#companyTaxes").hide();

                $("#trigger").change(function() {
                    if ($("#trigger").val() == 'payment_method') {
                        $("#type_container").hide();
                        $("#movement_container").hide();
                        $("#payment_methods").show();
                        $("#categories").hide();
                        $("#companyTaxes").hide();
                        $("#banks").show();
                        $("#banks_account").show();
                        cleanTriggerInputs();
                        $("#triggers").show();
                    } else if ($("#trigger").val() == 'category') {
                        $("#type_container").hide();
                        $("#movement_container").show();
                        $("#payment_methods").hide();
                        $("#categories").show();
                        $("#companyTaxes").hide();
                        $("#banks").hide();
                        $("#banks_account").hide();
                        cleanTriggerInputs();
                        $("#triggers").show();
                    } else if ($("#trigger").val() == 'companyTax') {
                        $("#type_container").show();
                        $("#movement_container").hide();
                        $("#payment_methods").hide();
                        $("#categories").hide();
                        $("#companyTaxes").show();
                        $("#banks").hide();
                        $("#banks_account").hide();
                        cleanTriggerInputs();
                        $("#triggers").show();
                    } else if ($("#trigger").val() == 'advance') {
                        $("#type_container").show();
                        $("#movement_container").hide();
                        $("#payment_methods").hide();
                        $("#categories").hide();
                        $("#companyTaxes").hide();
                        $("#banks").hide();
                        $("#banks_account").hide();
                        cleanTriggerInputs();
                        $("#triggers").hide();
                    } else {
                        $("#type_container").hide();
                        $("#movement_container").hide();
                        $("#payment_methods").hide();
                        $("#categories").hide();
                        $("#companyTaxes").hide();
                        $("#banks").hide();
                        $("#banks_account").hide();
                        cleanTriggerInputs();
                        $("#triggers").hide();
                    }
                });

                // Registro de un activador
                $("#add_trigger").click(addTrigger);

                // Variables globales asociadas a la tabla de activadores
                let triggersCount = 0;

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
                    } else if (trigger == 'companyTax') {
                        triggerId = $("#company_tax_id").val();
                        triggerName = $("#company_tax_id option:selected").text();
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
                    } else if (trigger == 'companyTax') {
                        $("#company_tax_id").val("seleccionar");
                        $("#company_tax_id").selectpicker('refresh');
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
