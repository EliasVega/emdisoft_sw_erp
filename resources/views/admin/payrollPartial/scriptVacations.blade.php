<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/
    let subtotalVacations = [];
    let contVacations = 0;
    let totalVacations = 0;
    let type_id = '';
    let vacationDays = 0;

    $('#end_vaction_period').prop("readonly", true);

    $("#start_vaction_period").change(activeEndPeriod);

    function activeEndPeriod(){
        $('#end_vaction_period').prop("readonly", false)
    }

    $("#end_vaction_period").change(totalDaysPeriod);

    function totalDaysPeriod(){
        startPeriod = $("#start_vaction_period").val();
        endPeriod = $("#end_vaction_period").val();
        startPeriodTime = moment(startPeriod);
        endPeriodTime = moment(endPeriod);

        vacationDaysPeriod = endPeriodTime.diff(startPeriodTime, 'days');
        vacationDaysPeriod++;
        if (vacationDaysPeriod >= 0) {
            if (startPeriod < endPeriod) {
                if (vacationDaysPeriod > 360) {
                    $("#days_vaction_period").val(360);
                } else {
                    $("#days_vaction_period").val(vacationDaysPeriod);
                }

            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'fecha Inicial no puede ser superior a fecha fin',
                    showConfirmButton: false,
                    timer: 5000 // es ms (mili-segundos)

                });
                cleanVacations();
                //window.location.reload()
            }
        } else {
            Swal.fire("Fecha de Inicio no puede ser mayor a fecha de fin");
            window.location.reload()
        }

    }



    $('#endVacations').prop("readonly", true);

    $("#startVacations").change(activeEndVacations);

    function activeEndVacations(){
        $('#endVacations').prop("readonly", false)
    }

    $("#endVacations").change(timeVacations);

    function timeVacations(){
        startDate = $("#start_date").val();
        endDate = $("#end_date").val();
        startTime = moment(startDate);
        endTime = moment(endDate);

        startYear = moment(startTime).year();
        startMonth = moment(startTime).month();
        endYear = moment(endTime).year();
        endMonth = moment(endTime).month();

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
        vacationDays = endTimeVacations.diff(startTimeVacations, 'days');
        if (vacationDays >= 0) {
            if (startYearVacations == endYearVacations && startMonthVacations == endMonthVacations
            && startYear == startYearVacations && startMonth == startMonthVacations) {
                $("#vacationDays").val(vacationDays + 1);
                vacationDayThis = $("#vacationDays").val();
                salaryEmployeeThis = $("#salary").val();
                valueDayThis = salaryEmployeeThis/30;
                vacationAcruedThis = parseFloat(vacationDayThis) * parseFloat(valueDayThis);
                $("#vacation_acrued").val(vacationAcruedThis);
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'las fechas no crresponden al mismo periodo de nomina',
                    showConfirmButton: false,
                    timer: 2000 // es ms (mili-segundos)

                });
                cleanVacations();
                //window.location.reload()
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
        type_id = $("#vacation_type").val();
        type = $("#vacation_type option:selected").text();
        quantity = $("#vacationDays").val();
        salaryEmployee = $("#salary").val();
        value_day = salaryEmployee/30;
        vacationPaymentMode = $("#vacation_payment_mode").val();
        if (Date.parse(startVacations) <= Date.parse(endVacations)) {
            if (type_id != "" && type != "" && quantity > 0 && value_day > 0) {
                subtotalVacations[contVacations] = parseFloat(quantity) * parseFloat(value_day);
                totalVacations = totalVacations + subtotalVacations[contVacations];

                if (type_id == 'compensated' && vacationPaymentMode == 'paid') {
                    tp = $("#total_acrued").val();
                    tpnew = parseFloat(tp) + parseFloat(subtotalVacations[contVacations]);
                    $("#total_acrued").val(tpnew.toFixed(2));
                }

                var rowVacations = '<tr class="selected" id="rowVacations'+contVacations+'"><td><button type="button" class="btn btn-danger btn-sm btndelete"onclick="deleterowVacations('+contVacations+');"><i class="fas fa-trash"></i></button></td><td><input type="hidden" name="vacation_type[]"  value="'+type_id+'">'+type+'</td><td><input type="hidden" name="start_vacations[]" value="'+startVacations+'">'+startVacations+'</td><td><input type="hidden" name="end_vacations[]" value="'+endVacations+'">'+endVacations+'</td> <td><input type="hidden" name="vacation_days[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="value_day[]"  value="'+value_day+'">'+value_day.toFixed(2)+'</td> <td>$'+subtotalVacations[contVacations].toFixed(2)+'</td></tr>';
                contVacations++;
                totalVacation();
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
        $("#vacation_acrued").val("");
    }

    function totalVacation() {
        provisionVacation = $("#provision_vacations").val();
        vacationAdjustment = parseFloat(totalVacations) - parseFloat(provisionVacation);
        $("#vacation_adjustment").val(vacationAdjustment);

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
