<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete colegio');
        });*/
    let subtotal = [];
    let cont = 0;
    let totalVacations = 0;
    $("#save").hide();

    $('#end_vacations').prop("readonly", true)

    $("#end_vacations").change(getDateVacations);

    function timeValue(){
        let startVacations = $("#start_vacations").val();
        let endVacations = $("#end_vacations").val();
        let startTimeVacations = moment(startVacations);
        let endTimeVacations = moment(endVacations);

        let startYearVacations = moment(startTimeVacations).year();
        let startMonthVacations = moment(startTimeVacations).month();
        let startDayVacations = moment(startTimeVacations).day();
        let endYearVacations = moment(endTimeVacations).year();
        let endMonthVacations = moment(endTimeVacations).month();
        let endDayVacations = moment(endTimeVacations).day();
        let vacationDays = endTimeVacations.diff(startTimeVacations, 'vacationDays');

        if (days >= 0) {
            if (startYear == endYear && startMonth == endMonth) {
                $("#vacationDays").val(days + 1);
                vacationDays = $("#vacationDays").val();
                salaryEmployee = $("#salary").val();
                totalVacations = (parseFloat(salaryEmployee)/30)*(parseFloat(vacationDays));
            } else {
                Swal.fire("las fechas no crresponden al mismo periodo");
                window.location.reload()
            }
        } else {
            Swal.fire("Fecha de Inicio no puede ser mayor a fecha de fin");
            window.location.reload()
        }

    }

    $(document).ready(function() {

        $("#add_vacations").click(function() {
            addVacations();
        });
    });

    //adicionar productos a la compra
    function addVacations() {

        let startVacations = $("#start_vacations").val();
        let endVacations = $("#end_vacations").val();
        type_id = $("#type_vacations").val();
        type = $("#type_vacations option:selected").text();
        quantity = $("#vacationDays").val();


        if (Date.parse(startDate) <= Date.parse(endDate)) {
            if (overtime_type_id != "" && percentage > 0 && quantity > 0 && value_hour > 0) {
                subtotal[cont] = parseFloat(quantity) * parseFloat(value_hour);
                total = total + subtotal[cont];
                var row = '<tr class="selected" id="row' + cont +
                    '"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow(' + cont +
                    ');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow(' +
                    cont +
                    ');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="overtime_type_id[]"  value="' +
                    overtime_type_id + '">' + overtime_type_id +
                    '</td><td><input type="hidden" name="overtimeType[]"  value="' + overtimeType + '">' +
                    overtimeType + '</td> <td><input type="hidden" name="quantity[]" value="' + quantity + '">' +
                    quantity + '</td> <td><input type="hidden" name="value_hour[]"  value="' + value_hour + '">' +
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
        $("#quantity").val("");
        $("#totalValue").val("");
    }

    function totals() {

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));
    }

    function assess() {
        if (total > 0) {
            $("#save").show();
        } else {
            $("#save").hide();
        }
    }

    function eliminar(index) {

        total = total - pay[index];

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#row" + index).remove();
        assess();
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
            $("#quantityModal").val(row.find("td:eq(4)").text());
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
        quantity = $("#quantityModal").val();
        value_hour = $("#valueHourModal").val();
        if (overtime_type_id != "" && quantity > 0 && value_hour > 0) {
            subtotal[cont] = parseFloat(quantity) * parseFloat(value_hour);
            total = total + subtotal[cont];
            var row = '<tr class="selected" id="row' + cont +
                '"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow(' + cont +
                ');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow(' +
                cont +
                ');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="overtime_type_id[]"  value="' +
                overtime_type_id + '">' + overtime_type_id +
                '</td><td><input type="hidden" name="overtimeType[]"  value="' + overtimeType + '">' + overtimeType +
                '</td> <td><input type="hidden" name="quantity[]" value="' + quantity + '">' + quantity +
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

        total = total - subtotal[index];

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#row" + index).remove();
        assess();
    }
</script>
