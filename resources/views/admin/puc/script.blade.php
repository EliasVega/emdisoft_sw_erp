@push('scripts')
        <script>
            $("#idClass").hide();
            $("#idGroup").hide();
            $("#idAccount").hide();
            $("#idSubaccount").hide();
            $("#idAuxiliary").hide();
            $("#idSubauxiliary").hide();

            $("#labelClass").hide();
            $("#labelGroup").hide();
            $("#labelAccount").hide();
            $("#labelSubccount").hide();
            $("#labelAuxiliary").hide();
            $("#labelSubauxiliary").hide();

            $("#addClasses").hide();
            $("#addGroups").hide();
            $("#addAccounts").hide();
            $("#addSubaccounts").hide();
            $("#addAuxiliaries").hide();
            $("#addSubauxiliaries").hide();

            $(document).ready(function(){
                var treeData = [
                    @foreach($accountClasses as $accountClass)
                    {
                        text: "{{ $accountClass->code.' - '.$accountClass->name }}",
                        //selectable: false,
                        state: {
                            expanded: false,
                        },
                        text: "{{ $accountClass->code.' - '.$accountClass->name }}",
                                tags: [
                                    'clase',
                                    '{{ $accountClass->id }}',
                                    '{{ $accountClass->code }}',
                                    '{{ $accountClass->name }}',
                                ],
                        nodes: [
                            @foreach($accountClass->accountGroups as $accountGroup)
                            {
                                text: "{{ $accountGroup->code.' - '.$accountGroup->name }}",
                                tags: [
                                    'grupo',
                                    '{{ $accountGroup->id }}',
                                    '{{ $accountGroup->code }}',
                                    '{{ $accountGroup->name }}'
                                ],
                                nodes: [
                                    @foreach($accountGroup->accounts as $account)
                                    {
                                        text: "{{ $account->code.' - '.$account->name }}",
                                        tags: [
                                            'cuenta',
                                            '{{ $account->id }}',
                                            '{{ $account->code }}',
                                            '{{ $account->name }}'
                                        ],
                                        nodes: [
                                            @foreach($account->subaccounts as $subaccount)
                                            {
                                                text: "{{ $subaccount->code.' - '.$subaccount->name }} {{ $subaccount->state == 'active' ? '(ACTIVADO)' : '' }}",
                                                tags: [
                                                    'subcuenta',
                                                    '{{ $subaccount->id }}',
                                                    '{{ $subaccount->code }}',
                                                    '{{ $subaccount->name }}',
                                                    '{{ $subaccount->status }}'
                                                ],
                                                nodes: [
                                                    @foreach($subaccount->auxiliaryAccounts as $auxiliaryAccount)
                                                    {
                                                        text: "{{ $auxiliaryAccount->code.' - '.$auxiliaryAccount->name }} {{ $auxiliaryAccount->state == 'active' ? '(ACTIVADO)' : '' }}",
                                                        tags: [
                                                            'auxiliar',
                                                            '{{ $auxiliaryAccount->id }}',
                                                            '{{ $auxiliaryAccount->code }}',
                                                            '{{ $auxiliaryAccount->name }}',
                                                            '{{ $auxiliaryAccount->status }}'
                                                        ],
                                                        nodes: [
                                                            @foreach($auxiliaryAccount->subauxiliaryAccounts as $subauxiliaryAccount)
                                                            {
                                                                text: "{{ $subauxiliaryAccount->code.' - '.$subauxiliaryAccount->name }} {{ $subauxiliaryAccount->state == 'active' ? '(ACTIVADO)' : '' }}",
                                                                tags: [
                                                                    'subauxiliar',
                                                                    '{{ $subauxiliaryAccount->id }}',
                                                                    '{{ $subauxiliaryAccount->code }}',
                                                                    '{{ $subauxiliaryAccount->name }}',
                                                                    '{{ $subauxiliaryAccount->status }}'
                                                                ],
                                                            }
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
                    //$('#account').val(data.tags[0]);
                    //$('#account_type').val(data.tags[1]);
                    //$('#account_selected').val(data.text);
                    if (data.tags[0] == 'clase') {
                        $("#addClasses").show();

                        $("#account_class_id").val(data.tags[1]);
                        $("#account_class_code").val(data.tags[2]);
                        $("#account_class_name").val(data.tags[3]);
                    } else if (data.tags[0] == 'grupo') {
                        $("#addGroups").show();
                        $("#account_group_id").val(data.tags[1]);
                        $("#account_group_code").val(data.tags[2]);
                        $("#account_group_name").val(data.tags[3]);
                    } else if (data.tags[0] == 'cuenta') {
                        $("#addAccounts").show();
                        $("#account_id").val(data.tags[1]);
                        $("#account_code").val(data.tags[2]);
                        $("#account_name").val(data.tags[3]);
                    } else if (data.tags[0] == 'subcuenta') {
                        $("#addSubaccounts").show();
                        $("#subaccount_id").val(data.tags[1]);
                        $("#subaccount_code").val(data.tags[2]);
                        $("#subaccount_name").val(data.tags[3]);
                    } else if (data.tags[0] == 'auxiliar') {
                        $("#addAuxiliaries").show();
                        $("#auxiliar_account_id").val(data.tags[1]);
                        $("#auxiliar_account_code").val(data.tags[2]);
                        $("#auxiliar_account_name").val(data.tags[3]);
                    } else if (data.tags[0] == 'subauxiliar') {
                        $("#addSubauxiliaries").show();
                        $("#subauxiliary_account_id").val(data.tags[1]);
                        $("#subauxiliary_account_code").val(data.tags[2]);
                        $("#subauxiliary_account_name").val(data.tags[3]);
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
