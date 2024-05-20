@push('scripts')
    <script>
        jQuery(document).ready(function($){
            $(document).ready(function() {
                $('#trigger_method_id').select2({
                    theme: "classic",
                    width: "100%",
                });
            });
        });
        jQuery(document).ready(function($){
            $(document).ready(function() {
                $('#movement_type_id').select2({
                    theme: "classic",
                    width: "100%",
                });
            });
        });
        jQuery(document).ready(function($){
            $(document).ready(function() {
                $('#operation_type_id').select2({
                    theme: "classic",
                    width: "100%",
                });
            });
        });


        $("#idClass").hide();
        $("#idGroup").hide();
        $("#idAccount").hide();
        $("#idSubaccount").hide();
        $("#idAuxiliary").hide();
        $("#idSubauxiliary").hide();

        $("#labelClass").hide();
        $("#labelGroup").hide();
        $("#labelAccount").hide();
        $("#labelSubaccount").hide();
        $("#labelAuxiliary").hide();
        $("#labelSubauxiliary").hide();

        $("#accountLabel").hide();
        $("#subaccountLabel").hide();
        $("#auxiliaryLabel").hide();
        $("#subauxiliaryLabel").hide();

        $("#addClasses").hide();
        $("#addGroups").hide();
        $("#addAccounts").hide();
        $("#addSubaccounts").hide();
        $("#addAuxiliaries").hide();
        $("#addSubauxiliaries").hide();
        $("#addTypeAccoun").hide();

        $("#formClasses").hide();
        $("#formGroups").hide();
        $("#formAccounts").hide();
        $("#formSubaccounts").hide();
        $("#formAuxiliaries").hide();
        $("#formSubauxiliaries").hide();
        $("#formAccountNew").hide();

        $(document).ready(function() {
            //llenado de del treeview
            var treeData = [
                @foreach ($accountClasses as $accountClass)
                    {
                        text: "{{ $accountClass->code . ' - ' . $accountClass->name }}",
                        //selectable: false,
                        state: {
                            expanded: false,
                        },
                        text: "{{ $accountClass->code . ' - ' . $accountClass->name }}",
                        tags: [
                            'clase',
                            '{{ $accountClass->id }}',
                            '{{ $accountClass->code }}',
                            '{{ $accountClass->name }}',
                        ],
                        nodes: [
                            @foreach ($accountClass->accountGroups as $accountGroup)
                                {
                                    text: "{{ $accountGroup->code . ' - ' . $accountGroup->name }}",
                                    tags: [
                                        'grupo',
                                        '{{ $accountGroup->id }}',
                                        '{{ $accountGroup->code }}',
                                        '{{ $accountGroup->name }}'
                                    ],
                                    nodes: [
                                        @foreach ($accountGroup->accounts as $account)
                                            {
                                                text: "{{ $account->code . ' - ' . $account->name }}",
                                                tags: [
                                                    'cuenta',
                                                    '{{ $account->id }}',
                                                    '{{ $account->code }}',
                                                    '{{ $account->name }}'
                                                ],
                                                nodes: [
                                                    @foreach ($account->subaccounts as $subaccount)
                                                        {
                                                            text: "{{ $subaccount->code . ' - ' . $subaccount->name }} {{ $subaccount->state == 'active' ? '(ACTIVADO)' : '' }}",
                                                            tags: [
                                                                'subcuenta',
                                                                '{{ $subaccount->id }}',
                                                                '{{ $subaccount->code }}',
                                                                '{{ $subaccount->name }}',
                                                                '{{ $subaccount->status }}'
                                                            ],
                                                            nodes: [
                                                                @foreach ($subaccount->auxiliaryAccounts as $auxiliaryAccount)
                                                                    {
                                                                        text: "{{ $auxiliaryAccount->code . ' - ' . $auxiliaryAccount->name }} {{ $auxiliaryAccount->state == 'active' ? '(ACTIVADO)' : '' }}",
                                                                        tags: [
                                                                            'auxiliar',
                                                                            '{{ $auxiliaryAccount->id }}',
                                                                            '{{ $auxiliaryAccount->code }}',
                                                                            '{{ $auxiliaryAccount->name }}',
                                                                            '{{ $auxiliaryAccount->status }}'
                                                                        ],
                                                                        nodes: [
                                                                            @foreach ($auxiliaryAccount->subauxiliaryAccounts as $subauxiliaryAccount)
                                                                                {
                                                                                    text: "{{ $subauxiliaryAccount->code . ' - ' . $subauxiliaryAccount->name }} {{ $subauxiliaryAccount->state == 'active' ? '(ACTIVADO)' : '' }}",
                                                                                    tags: [
                                                                                        'subauxiliar',
                                                                                        '{{ $subauxiliaryAccount->id }}',
                                                                                        '{{ $subauxiliaryAccount->code }}',
                                                                                        '{{ $subauxiliaryAccount->name }}',
                                                                                        '{{ $subauxiliaryAccount->status }}'
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
                        ]
                    },
                @endforeach
            ];
            //tree view expand
            $('#puc').treeview({
                data: treeData,
                collapseIcon: 'fas fa-minus',
                expandIcon: 'fas fa-plus',
                highlightSelected: true
            });
            //buscador en el tree view
            $('#search').on('keyup', function() {
                var searchString = $(this).val();
                var options = {
                    ignoreCase: true,
                    exactMatch: false,
                    revealResults: true,
                };
                $('#puc').treeview('collapseAll', {
                    silent: true
                });
                $('#puc').treeview('search', [searchString, options]);
            });
            //llenado de los nodos sgun la seleccion
            $('#puc').on('nodeSelected', function(event, data) {
                accountType = data.tags[0];
                if (accountType == 'clase') {

                    $("#addClasses").show();
                    $("#addGroups").hide();
                    $("#addAccounts").hide();
                    $("#addSubaccounts").hide();
                    $("#addAuxiliaries").hide();
                    $("#addSubauxiliaries").hide();

                    $("#account_class_id").val(data.tags[1]);
                    $("#account_class_code").val(data.tags[2]);
                    $("#account_class_name").val(data.tags[3]);
                    $("#type_account").val('class');

                    cleanAccoun(accountType);
                } else if (accountType == 'grupo') {
                    codeAccount = parseInt(data.tags[2]/10);
                    codeClass = $("#account_class_code").val();
                    if (codeAccount == codeClass) {
                        $("#account_group_id").val(data.tags[1]);
                        $("#account_group_code").val(data.tags[2]);
                        $("#account_group_name").val(data.tags[3]);
                        $("#type_account").val('group');

                        $("#addGroups").show();
                        $("#addAccounts").hide();
                        $("#addSubaccounts").hide();
                        $("#addAuxiliaries").hide();
                        $("#addSubauxiliaries").hide();
                        cleanAccoun(accountType);
                    }
                } else if (accountType == 'cuenta') {
                    codeAccount = parseInt(data.tags[2]/100);
                    codeGroup = $("#account_group_code").val();
                    if (codeAccount == codeGroup) {
                        //window.location.reload()
                        $("#account_id").val(data.tags[1]);
                        $("#account_code").val(data.tags[2]);
                        $("#account_name").val(data.tags[3]);
                        $("#type_account").val('account');

                        $("#addAccounts").show();
                        $("#addSubaccounts").hide();
                        $("#addAuxiliaries").hide();
                        $("#addSubauxiliaries").hide();

                        $("#addAccountNew").hide();

                        cleanAccoun(accountType);
                    }
                } else if (accountType == 'subcuenta') {
                    codeAccount = parseInt(data.tags[2]/100);
                    codeAcco = $("#account_code").val();
                    if (codeAccount == codeAcco) {
                        $("#subaccount_id").val(data.tags[1]);
                        $("#subaccount_code").val(data.tags[2]);
                        $("#subaccount_name").val(data.tags[3]);
                        $("#type_account").val('subaccount');

                        $("#addSubaccounts").show();
                        $("#addAuxiliaries").hide();
                        $("#addSubauxiliaries").hide();

                        $("#addSubaccountNew").hide();

                        cleanAccoun(accountType);
                    }
                } else if (accountType == 'auxiliar') {
                    codeAccount = parseInt(data.tags[2]/100);
                    codeSubaccount = $("#subaccount_code").val();
                    if (codeAccount == codeSubaccount) {
                        $("#auxiliary_account_id").val(data.tags[1]);
                        $("#auxiliary_account_code").val(data.tags[2]);
                        $("#auxiliary_account_name").val(data.tags[3]);
                        $("#type_account").val('auxiliary');

                        $("#addAuxiliaries").show();
                        $("#addSubauxiliaries").hide();

                        $("#addAuxiliaryNew").hide();

                        cleanAccoun(accountType);
                    }

                } else if (accountType == 'subauxiliar') {
                    codeAccount = parseInt(data.tags[2]/100);
                    codeAuxiliary = $("#auxiliary_account_code").val();
                    if (codeAccount == codeAuxiliary) {
                        $("#subauxiliary_account_id").val(data.tags[1]);
                        $("#subauxiliary_account_code").val(data.tags[2]);
                        $("#subauxiliary_account_name").val(data.tags[3]);
                        $("#type_account").val('subauxiliary');

                        $("#addSubauxiliaries").show();

                        $("#addSubauxiliaryNew").hide();
                    }

                }
            });
            //limpiando nodos segun seleccion
            function cleanAccoun(accountType) {
                if (accountType == 'clase') {
                    groupClean();
                    accountClean();
                    subaccountClean();
                    auxiliaryClean();
                    subauxiliaryClean();
                } else if (accountType == 'grupo') {
                    accountClean();
                    subaccountClean();
                    auxiliaryClean();
                    subauxiliaryClean();
                } else if (accountType == 'cuenta') {
                    subaccountClean();
                    auxiliaryClean();
                    subauxiliaryClean();
                } else if (accountType == 'subcuenta') {
                    auxiliaryClean();
                    subauxiliaryClean();
                } else if (accountType == 'auxiliar') {
                    subauxiliaryClean();
                }
            }

            function groupClean() {
                $("#account_group_id").val('');
                $("#account_group_code").val('');
                $("#account_group_name").val('');
            }

            function accountClean() {
                $("#account_id").val('');
                $("#account_code").val('');
                $("#account_name").val('');

                $("#type_account").val('');
                $("#code_account").val('');
                $("#name_account").val('');
                $("#formAccounts").hide();
            }

            function subaccountClean() {
                $("#subaccount_id").val('');
                $("#subaccount_code").val('');
                $("#subaccount_name").val('');

                $("#type_account").val('');
                $("#code_subaccount").val('');
                $("#name_subaccount").val('');
                $("#formSubaccounts").hide();
            }

            function auxiliaryClean() {
                $("#auxiliary_account_id").val('');
                $("#auxiliary_account_code").val('');
                $("#auxiliary_account_name").val('');

                $("#type_account").val('');
                $("#code_auxiliary_account").val('');
                $("#name_auxiliary_account").val('');
                $("#formAuxiliaries").hide();
            }

            function subauxiliaryClean() {
                $("#subauxiliary_account_id").val('');
                $("#subauxiliary_account_code").val('');
                $("#subauxiliary_account_name").val('');

                $("#type_account").val('');
                $("#code_subauxiliary_account").val('');
                $("#name_subauxiliary_account").val('');
                $("#formSubauxiliaries").hide();
            }

            $("#addAccountNew").click(function() {
                $("#formAccounts").show();
                $("#addAccountNew").hide();
            });
            $("#addSubaccountNew").click(function() {
                $("#formSubaccounts").show();
                $("#addSubaccountNew").hide();
            });
            $("#addAuxiliaryNew").click(function() {
                $("#formAuxiliaries").show();
                $("#addAuxiliaryNew").hide();
            });
            $("#addSubauxiliaryNew").click(function() {
                $("#formSubauxiliaries").show();
                $("#addSubauxiliariesNew").hide();
            });
            $("#subauxiliaryNew").click(function() {
                $("#subauxiliary_account_id").val('');
                $("#subauxiliary_account_code").val('');
                $("#subauxiliary_account_name").val('');

                $("#addSubauxiliaries").hide();
                $("#formSubauxiliaries").show();
                $("#subauxiliariesNew").hide();
            });





            /*
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
                        '<input class="form-control" type="hidden" name="triggers_row[]" id="triggers_row[]" value="' +
                        triggersCount + '">' +
                        '<input class="form-control" type="hidden" id="trigger_' + triggersCount +
                        '" name="triggers[]" value="' + triggerId + '">' +
                        '<td><input class="form-control w-sm-auto" type="text" id="triggers_name[]" name="triggers_name[]" value="' +
                        triggerName + '" readonly></td>' +
                        '<td><button type="button" class="btn btn-danger" id="delete_trigger_row" data-row="' +
                        triggersCount + '">X</button></td></tr>';
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
            }*/
        });
    </script>
@endpush
