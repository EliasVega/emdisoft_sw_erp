<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete colegio');
        });*/

    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#employee_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    })
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#overtime_type_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    let subtotal = [];
    let  cont = 0;
    let total = 0;
    let  startTime = '';
    let  endTime = '';
    //form purchase
    $("#addSalary").hide();
    $("#addPercentage").hide();
    $("#addWeeklyHours").hide();
    $("#save").hide();

    function ValidarFechas() {
        var fechainicial = document.getElementById("start_time").value;
        var fechafinal = document.getElementById("end_time").value;

        if (Date.parse(fechafinal) < Date.parse(fechainicial)) {
            alert("La fecha final debe ser mayor a la fecha inicial");
        } else {
            alert("La fecha esta correcta");
        }
    }

    //seleccionar de acuerdo al empleado
    $("#employee_id").change(employeeValue);

    function employeeValue() {

        dataEmployee = document.getElementById('employee_id').value.split('_');
        $("#salary").val(dataEmployee[1]);

    }

    //seleccionar de acuerdo al tipo de hora
    $("#overtime_type_id").change(overtimeTypeValue);

    function overtimeTypeValue() {

        dataOvertimeType = document.getElementById('overtime_type_id').value.split('_');
        $("#percentage").val(dataOvertimeType[1]);

    }
    $(document).ready(function() {

        $("#add").click(function() {
            add();
        });
    });

    //adicionar productos a la compra
    function add() {

        //let startTime = document.getElementById("start_time").value;
        //let endTime = document.getElementById("end_time").value;
        let startTime = $("#start_time").val();
        let endTime = $("#end_time").val();
        let startHour = startTime.substring(11);
        let endHour =  endTime.substring(11);
        let milliseconds = 0;
        let seconds = 0;
        let minutes = 0;
        let hours = 0;

        dataOvertimeType = document.getElementById('overtime_type_id').value.split('_');
        overtime_type_id = dataOvertimeType[0];
        overtimeType = $("#overtime_type_id option:selected").text();
        percentage = $("#percentage").val();
        salary = $("#salary").val();
        weekly_hours = $("#weekly_hours").val();
        month_hours = (weekly_hours/6)*30;
        normal_time_value = salary/month_hours;
        add_percentage = ((parseFloat(percentage)+100)/100);
        value_hour = normal_time_value * add_percentage;

        //console.log("Hoy es el día " + diaSemana + " de la semana.");

        //si tipo de hora es igual a 1 4 5
        if (overtime_type_id == 1 || overtime_type_id == 4 || overtime_type_id == 5) {
            //si esta entre este rango de horas
            if (startHour > '06:00' && startHour < '21:00' && endHour > '06:00' && endHour < '21:00') {
                //metodo para obtener diferencia en milisegundos de las dos fechas
                start = new Date($("#start_time").val());
                end = new Date($("#end_time").val());
                //obteniendo variables tiempo
                milliseconds = end - start;
                seconds = milliseconds/1000;
                minutes = seconds/60;
                hours = minutes/60;
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'tienes error en las horas para este typo de hora diurna',
                });
            }
        } else {
            let startHourVerification = 0;
            let endHourVerification = 0;
            if (startHour > '06:00' && startHour < '21:00') {
                startHourVerification = 1;
            }
            if (endHour > '06:00' && endHour < '21:00') {
                startHourVerification = 1;
            }
            //si esta entre este rango de horas
            if (startHourVerification == 0 && endHourVerification == 0) {
                //metodo para obtener diferencia en milisegundos de las dos fechas
                start = new Date($("#start_time").val());
                end = new Date($("#end_time").val());
                //obteniendo variables tiempo
                milliseconds = end - start;
                seconds = milliseconds/1000;
                minutes = seconds/60;
                hours = minutes/60;
            } else {
                //alert("Rellene todos los campos del detalle para esta compra");
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'tienes error en las horas para este typo de hora nocturna',
                });
            }
        }

        if (Date.parse(startTime) <= Date.parse(endTime)) {

            if (overtime_type_id != "" && percentage > 0 && hours > 0) {
                subtotal[cont] = parseFloat(hours) * parseFloat(value_hour);
                total = total + subtotal[cont];

                var row = '<tr class="selected" id="row' + cont + '"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow(' + cont + ');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow(' + cont +');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="overtime_type_id[]"  value="'+overtime_type_id + '">' + overtimeType + '</td><td><input type="hidden" name="start_time[]" value="' + startTime + '">' + startTime + '</td> <td><input type="hidden" name="end_time[]" value="' + endTime + '">' + endTime + '</td> <td><input type="hidden" name="percentage[]"  value="' + percentage + '">' + percentage + '</td> <td><input type="hidden" name="hours[]" value="' + hours.toFixed(2) + '">' + hours + '</td> <td><input type="hidden" name="value_hour[]"  value="' + value_hour + '">' + value_hour.toFixed(2) + '</td> <td>$' + subtotal[cont].toFixed(2) + ' </td></tr>';
                cont++;
                totals();
                assess();
                $('#overtimes').append(row);
                //$('#product_id option:selected').remove();
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
        $("#start_time").val("");
        $("#end_time").val("");
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
</script>
