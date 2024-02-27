<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/
    let subtotalVacations = [];
    let contVacations = 0;
    let totalVacations = 0;
    $('#endVacations').prop("readonly", true);

    $("#startVacations").change(activeEndVacations);

    function activeEndVacations(){
        $('#endVacations').prop("readonly", false)
    }

    $("#endVacations").change(timeVacations);

    function timeVacations(){
        let startVacations = $("#startVacations").val();
        let endVacations = $("#endVacations").val();
        let startTimeVacations = moment(startVacations);
        let endTimeVacations = moment(endVacations);

        let startYearVacations = moment(startTimeVacations).year();
        let startMonthVacations = moment(startTimeVacations).month();
        let startDayVacations = moment(startTimeVacations).day();
        let endYearVacations = moment(endTimeVacations).year();
        let endMonthVacations = moment(endTimeVacations).month();
        let endDayVacations = moment(endTimeVacations).day();
        let vacationDays = endTimeVacations.diff(startTimeVacations, 'days');
        if (vacationDays >= 0) {
            if (startYearVacations == endYearVacations && startMonthVacations == endMonthVacations) {
                $("#vacationDays").val(vacationDays + 1);
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

        startVacations = $("#startVacations").val();
        endVacations = $("#endVacations").val();
        type_id = $("#typeVacations").val();
        type = $("#typeVacations option:selected").text();
        quantity = $("#vacationDays").val();
        salaryEmployee = $("#salary").val();
        value_day = salaryEmployee/30;
        alert(totalVacations);
        if (Date.parse(startVacations) <= Date.parse(endVacations)) {
            if (type_id != "" && type != "" && quantity > 0 && value_day > 0) {
                subtotalVacations[contVacations] = parseFloat(quantity) * parseFloat(value_day);
                alert(subtotalVacations);
                totalVacations = totalVacations + subtotalVacations[contVacations];
                var rowVacations = '<tr class="selected" id="rowVacations'+contVacations+'"><td><button type="button" class="btn btn-danger btn-sm btndelete"onclick="deleterowVacations('+contVacations+');"><i class="fas fa-trash"></i></button></td><td><input type="hidden" name="vacation_type[]"  value="'+type_id+'">'+type+'</td><td><input type="hidden" name="start_vacations[]" value="'+startVacations+'">'+startVacations+'</td><td><input type="hidden" name="end_vacations[]" value="'+endVacations+'">'+endVacations+'</td> <td><input type="hidden" name="vacation_days[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="value_day[]"  value="'+value_day+'">'+value_day.toFixed(2)+'</td> <td>$'+subtotalVacations[contVacations].toFixed(2)+'</td></tr>';
                contVacations++;
                totalVac();
                $('#vacations').append(rowVacations);
                cleanVacations();


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

    function cleanVacations() {
        $("#startVacations").val("");
        $("#endVacations").val("");
        $("#vacationDays").val("");
    }

    function totalVac() {

        $("#total_vacations_html").html("$ " + totalVacations.toFixed(2));
        $("#total_vacations").val(totalVacations.toFixed(2));
    }

    function deleterowVacations(index) {

        totalVacations -= subtotalVacations[index];

        $("#total_vacations_html").html("$ " + totalVacations.toFixed(2));
        $("#total_vacations").val(totalVacations.toFixed(2));

        $("#rowVacations" + index).remove();
    }
</script>
