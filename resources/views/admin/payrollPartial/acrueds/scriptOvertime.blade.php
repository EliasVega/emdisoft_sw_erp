<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete colegio');
        });*/
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#overtime_type_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    let subtotal = [];
    let cont = 0;
    let totalOvertime = 0;
    let salary = 0;
    let percentage = 0;
    let value_hour = 0;
    let overtime_type_id = '';
    let overtimeType = '';
    //form purchase
    //$("#addSalary").hide();
    //$("#addPercentage").hide();
    $("#addWeeklyHours").hide();
    $("#addPercentage").hide();
    $("#save").hide();

    //seleccionar de acuerdo al tipo de hora
    $("#overtime_type_id").change(overtimeTypeValue);

    function overtimeTypeValue() {

        dataOvertimeType = document.getElementById('overtime_type_id').value.split('_');
        $("#percentage").val(dataOvertimeType[1]);

        overtime = dataOvertimeType[0];
        salary = $("#salary").val();
        percentage = $("#percentage").val();

        if (overtime == 1 || overtime == 2 || overtime == 4 || overtime == 6) {
            percentage = ((parseFloat(percentage) + 100) / 100);
        } else {
            percentage = ((parseFloat(percentage)) / 100);
        }
        weekly_hours = $("#weekly_hours").val();
        month_hours = (weekly_hours / 6) * 30;
        normal_time_value = salary / month_hours;
        value_hour = normal_time_value * percentage;
    }


    $(document).ready(function() {
        $("#quantity_overt").keyup(function() {
            $("#quantity_overt").val();
            hoursValue();
        });
    });

    function hoursValue() {
        partialQuantity = parseFloat($("#quantity_overt").val())
        valuehours = partialQuantity * value_hour;
        $("#totalValueOvertime").val(valuehours.toFixed(2));
    }

    $(document).ready(function() {
        $("#add").click(function() {
            add();
        });
    });

    //adicionar productos a la compra
    function add() {
        let startDate = $("#start_date").val();
        let endDate = $("#end_date").val();
        dataOvertimeType = document.getElementById('overtime_type_id').value.split('_');
        overtime_type_id = dataOvertimeType[0];
        overtimeType = $("#overtime_type_id option:selected").text();
        quantityOvert = $("#quantity_overt").val();

        if (Date.parse(startDate) <= Date.parse(endDate)) {
            if (overtime_type_id != "" && percentage > 0 && quantityOvert > 0 && value_hour > 0) {
                subtotal[cont] = parseFloat(quantityOvert) * parseFloat(value_hour);
                totalOvertime = totalOvertime + subtotal[cont];

                var row = '<tr class="selected" id="row' + cont +
                    '"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow(' + cont +
                    ');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow(' +
                    cont +
                    ');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="overtime_type_id[]"  value="' +
                    overtime_type_id + '">' + overtime_type_id +
                    '</td><td><input type="hidden" name="overtimeType[]"  value="' + overtimeType + '">' +
                    overtimeType + '</td> <td><input type="hidden" name="quantity_overtime[]" value="' + quantityOvert + '">' +
                    quantityOvert + '</td> <td><input type="hidden" name="value_hour[]"  value="' + value_hour + '">' +
                    value_hour.toFixed(2) + '</td> <td>$' + subtotal[cont].toFixed(2) + ' </td></tr>';
                cont++;
                totals();
                assess();
                $('#overtimes').append(row);
                $('#overtime_type_id option:selected').remove();
                clean();


            } else {
                //alert("Rellene todos los campos del detalle para esta compra");
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Datos faltantes o incorrectos para asignar hora extra',
                });
            }
        } else {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'fecha final debe ser mayor a fecha inicial',
            });
        }

    }

    function clean() {
        //$('#employee_id').val(null).trigger('change');
        $('#overtime_type_id').val(null).trigger('change');
        $("#quantity_overt").val("");
        $("#totalValueOvertime").val("");
    }

    function totals() {
        contPartial = cont - 1;
        $("#total_overtime_html").html("$ " + totalOvertime.toFixed(2));
        $("#total_overtime").val(totalOvertime.toFixed(2));

        tAcrued = $("#total_acrued").val();
        totalAcrued += parseFloat(subtotal[contPartial]);
        $("#total_acrued").val(totalAcrued.toFixed(2));

        salaryBase = $("#base_salary").val();
        salaryBase = parseFloat(salaryBase) + parseFloat(subtotal[contPartial]);
        $("#base_salary").val(salaryBase.toFixed(2));
    }

    function assess() {
        if (totalOvertime > 0) {
            $("#save").show();
        } else {
            $("#save").hide();
        }
    }

    jQuery(document).on("click", "#editrow", function () {
        editrow();
    });

    function editrow(index) {

        $("#contMod").hide();
        $("#subtotalMod").hide();
        //$("#idMod").hide();

        // Obtener la row
        var row = $("#row" + index);
        // Solo si la row existe
        if (row) {

            // Buscar datos en la row y asignar a campos del formulario:
            // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
            $("#contModal").val(index);
            $("#overtime_type_idModal").val(row.find("td:eq(2)").text());
            $("#overtimeTypeModal").val(row.find("td:eq(3)").text());
            $("#quantity_overtModal").val(row.find("td:eq(4)").text());
            $("#valueHourModal").val(row.find("td:eq(5)").text());
            $("#subtotalModal").val(row.find("td:eq(6)").text());

            // Mostrar modal
            $('#overtimeModal').modal('show');
        }
    }

    jQuery(document).on("click", "#updateOvertime", function() {
        updaterow();
    });

    function updaterow() {

        // Buscar datos en la row y asignar a campos del formulario:
        // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
        contedit = $("#contModal").val();
        overtime_type_id = $("#overtime_type_idModal").val();
        overtimeType = $("#overtimeTypeModal").val();
        quantityOvert = $("#quantityOvertModal").val();
        value_hour = $("#valueHourModal").val();
        if (overtime_type_id != "" && quantityOvert > 0 && value_hour > 0) {
            subtotal[cont] = parseFloat(quantityOvert) * parseFloat(value_hour);
            totalOvertime = totalOvertime + subtotal[cont];
            var row = '<tr class="selected" id="row' + cont +
                '"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow(' + cont +
                ');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow(' +
                cont +
                ');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="overtime_type_id[]"  value="' +
                overtime_type_id + '">' + overtime_type_id +
                '</td><td><input type="hidden" name="overtimeType[]"  value="' + overtimeType + '">' + overtimeType +
                '</td> <td><input type="hidden" name="quantity_overtime[]" value="' + quantityOvert + '">' + quantityOvert +
                '</td> <td><input type="hidden" name="value_hour[]"  value="' + value_hour + '">' + value_hour + '</td> <td>$' + subtotal[cont].toFixed(2) + ' </td></tr>';
            cont++;
            deleterow(contedit);
            totals();
            assess();
            $('#overtimes').append(row);
            $('#overtimeModal').modal('hide');
            //$('#product_id option:selected').remove();

        } else {
            //alert("Rellene todos los campos del detalle para esta compra");
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Datos faltantes o incorrectos para asignar hora extra',
            });
        }
    }

    function deleterow(index) {

        totalOvertime = totalOvertime - subtotal[index];

        $("#total_overtime_html").html("$ " + totalOvertime.toFixed(2));
        $("#total_overtime").val(totalOvertime.toFixed(2));

        tp = $("#total_acrued").val();
        tpnew = parseFloat(tp) - parseFloat(subtotal[index]);
        $("#total_acrued").val(tpnew.toFixed(2));

        salaryBase = $("#base_salary").val();
        salaryBase -= parseFloat(subtotal[index]);
        $("#base_salary").val(salaryBase.toFixed(2));

        $("#row" + index).remove();
        assess();
    }
</script>
