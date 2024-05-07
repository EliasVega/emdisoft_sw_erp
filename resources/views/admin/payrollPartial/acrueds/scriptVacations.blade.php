<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/
    let subtotalVacations = [];
    let contVacations = 0;
    let totalVacations = 0;
    let vacationDays = 0;

    /*
    $('#end_vacation_period').prop("readonly", true);

    $("#start_vacation_period").change(activeEndPeriod);

    function activeEndPeriod(){
        $('#end_vacation_period').prop("readonly", false)
    }*/

    function selectPayVacations() {
        $("#addVPM").show();
        $("#addCausedVacations").hide();
        $("#addLayoffVacations").hide();
    }
    $("#vacation_payment_mode").change(activeSelectPay);

    function activeSelectPay() {
        selectVPM = $("#vacation_payment_mode").val();
        if (selectVPM == 'paid') {
            $("#addVPM").hide();
            $("#addProv").show();
            $("#addCausedVacations").show();
            $("#addLayoffVacations").show();
            addVacationPeriod();
        } else {
            $("#addVPM").hide();
            $("#addProv").show();
            $("#addCausedVacations").show();
            $("#addLayoffVacations").hide();
            addVacationPeriod();

        }
    }

    function addVacationPeriod() {
        selectVPM = $("#vacation_payment_mode").val();
        monthDate = new Date($("#month").val());
        //addicionar horas para hora colombia
        addHours = 5;
        //obtener horas del mes seleccionado
        hours = monthDate.getHours();
        monthDate.setHours(hours + addHours);
        if (selectVPM == 'paid') {
            lastDay = new Date(monthDate.getFullYear(), monthDate.getMonth() + 0, 0);
            $("#addDPV1").show();
            $("#addDPV2").hide();
            dayscaused = $("#days_vacation_period").val();
            generatedDays = 15 * dayscaused / 360;
            $("#vacation_days_generated").val(generatedDays);
            salary = $("#salary").val();
            causedVacations = (salary / 30) * generatedDays;
            $("#caused_vacations").val(causedVacations.toFixed(2));
        } else {
            lastDay = new Date(monthDate.getFullYear(), monthDate.getMonth() + 1, 0);
            $("#addDPV2").show();
            $("#addDPV1").hide();
            dayscaused = $("#daysVacationsProvision").val();
            $("#dvpcaused").val(dayscaused);
            generatedDays = 15 * dayscaused / 360;
            $("#vacation_days_generated").val(generatedDays);
            salary = $("#salary").val();
            causedVacations = (salary / 30) * generatedDays;
            $("#caused_vacations").val(causedVacations.toFixed(2));
        }
        //lastDay = new Date(monthDate.getFullYear(), monthDate.getMonth() + 0, 0);
        periodEndVac = moment(lastDay);
        periodEndVac = periodEndVac.format('YYYY-MM-DD');
        $("#end_vacation_period").val(periodEndVac);

        salaryAcrued = $("#salary_acrued").val();
        startDate = $("#start_date").val();
        endDate = $("#end_date").val();
        days = $("#days").val();

        $("#startVacations").val(startDate);
        $("#endVacations").val(endDate);
        $("#vacationDays").val(days);
        $("#vacation_acrued").val(salaryAcrued);
    }
    $(document).ready(function() {

        $("#add_vacations").click(function() {
            addVacations();
        });
    });

    //adicionar Vacaciones
    function addVacations() {
        startVacations = $("#startVacations").val();
        endVacations = $("#endVacations").val();
        type_id = $("#vacation_type").val();
        type = $("#vacation_type option:selected").text();
        quantity = $("#vacationDays").val();
        salaryEmployee = $("#salary").val();
        value_day = salaryEmployee/30;
        vacationPaymentMode = $("#vacation_payment_mode").val();
        transportAssistance = $("#transport_assistance").val();
        transportAcrued = $("#transport_acrued").val();
        totalAcrued = $("#total_acrued").val();
        salaryBase = $("#base_salary").val();
        salaryAcrued = $("#salary_acrued").val();
        days = $("#days").val();
        fortnight = $("#fortnight").val();
        daysCaused = $("#vp_days").val();

        if (Date.parse(startVacations) <= Date.parse(endVacations)) {

            if (type_id != "" && type != "" && quantity > 0 && value_day > 0) {
                subtotalVacations[contVacations] = parseFloat(quantity) * parseFloat(value_day);
                totalVacations = totalVacations + subtotalVacations[contVacations];

                if (type_id == 'compensated' && vacationPaymentMode == 'paid') {
                    totalAcrued += parseFloat(subtotalVacations[contVacations]);
                    $("#total_acrued").val(totalAcrued.toFixed(2));

                    salaryBase += parseFloat(subtotalVacations[contVacations]);
                    $("#base_salary").val(salaryBase.toFixed(2));
                } else {
                    if (fortnight == 'first') {
                        $("#transport_acrued").val(0);
                    } else {
                        if (transportAssistance > 0) {
                            totalDaysPeriod = parseFloat(quantity) + parseFloat(daysCaused);
                            alert(totalDaysPeriod);
                            transportDiscount = (parseFloat(transportAssistance)/30) * parseFloat(totalDaysPeriod);
                            transportAcrued = parseFloat(transportAcrued) - parseFloat(transportDiscount);
                            $("#transport_acrued").val(transportAcrued);
                    }
                    }

                    days = parseInt(days) - parseInt(quantity);
                    $("#days").val(days);

                    salaryAcrued = parseFloat(salaryAcrued) - parseFloat(subtotalVacations[contVacations]);
                    $("#salary_acrued").val(salaryAcrued);
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
        $('#endVacations').prop("readonly", true);
    }

    function totalVacation() {
        provisionVacation = $("#provision_vacations").val();
        vacationAdjustment = parseFloat(totalVacations) - parseFloat(provisionVacation);
        if (vacationAdjustment >= "0.00") {
            $("#vacation_adjustment").val(vacationAdjustment.toFixed(2));
        } else {
            $("#vacation_adjustment").val("0.00");
        }

        $("#total_vacations_html").html("$ " + totalVacations.toFixed(2));
        $("#total_vacations").val(totalVacations.toFixed(2));
    }

    function deleterowVacations(index) {

        totalVacations -= subtotalVacations[index];

        $("#total_vacations_html").html("$ " + totalVacations.toFixed(2));
        $("#total_vacations").val(totalVacations.toFixed(2));

        provisionVacation = $("#provision_vacations").val();
        vacationAdjustment = parseFloat(totalVacations) - parseFloat(provisionVacation);
        if (vacationAdjustment >= "0.00") {
            $("#vacation_adjustment").val(vacationAdjustment.toFixed(2));
        } else {
            $("#vacation_adjustment").val("0.00");
        }
        deleteTotalAcrued(index);
        $("#rowVacations" + index).remove();
    }

    function deleteTotalAcrued(index) {
        ta = $("#transport_assistance").val();
        subtotalThis = subtotalVacations[index];
        // Obtener la row
        var row = $("#rowVacations" + index);
        // Solo si la row existe
        if (row) {
            type = row.find("td:eq(1)").text();
            qvac = row.find("td:eq(4)").text();
            if (type == "Compensadas") {
                totalAcrued = $("#total_acrued").val();
                totalAcrued -= parseFloat(subtotalThis);
                $("#total_acrued").val(totalAcrued.toFixed(2));

                salaryBase = $("#base_salary").val();
                salaryBase -= parseFloat(subtotalThis);
                $("#base_salary").val(salaryBase.toFixed(2));
            } else {
                if (ta > 0) {
                        transportDiscount = (parseFloat(ta)/30) * parseFloat(qvac);
                        transportAcrued = parseFloat(transportAcrued) + parseFloat(transportDiscount);
                        $("#transport_acrued").val(transportAcrued);
                    }
            }
        }
    }

    $("#end_vacation_period").change(totalDaysPeriod);

    function totalDaysPeriod(){
        startPeriod = $("#start_vacation_period").val();
        endPeriod = $("#end_vacation_period").val();
        startPeriodTime = moment(startPeriod);
        endPeriodTime = moment(endPeriod);
        dayMonthEnd = endPeriodTime.format('D');
        vacationDaysPeriod = endPeriodTime.diff(startPeriodTime, 'days');
        vacationDaysPeriod++;

        if (vacationDaysPeriod >= 0) {
            $("#addDPV1").hide();
            $("#addDPV2").show();
            $("#dvpcaused").val(vacationDaysPeriod);
            generatedDays = 15 * vacationDaysPeriod / 360;
            $("#vacation_days_generated").val(generatedDays.toFixed(2));
            salary = $("#salary").val();
            causedVacations = (salary / 30) * generatedDays;
            $("#caused_vacations").val(causedVacations.toFixed(2));
        } else {
            Swal.fire("Fecha de Inicio no puede ser mayor a fecha de fin");
            cleanVacations();
        }

    }

    //$('#endVacations').prop("readonly", true);

    $("#startVacations").change(addVacationStart);

    $("#endVacations").change(timeVacations);

    function addVacationStart() {
        endVac = $("#endVacations").val();
        if (endVac != "") {
            timeVacations();
        } else {
            $('#endVacations').prop("readonly", false);
        }
    }

    function timeVacations(){
        startDate = $("#start_date").val();
        endDate = $("#end_date").val();

        startVacations = $("#startVacations").val();
        endVacations = $("#endVacations").val();
        startTimeVacations = moment(startVacations);
        endTimeVacations = moment(endVacations);
        vacationDays = endTimeVacations.diff(startTimeVacations, 'days');

        salaryEmployee = $("#salary").val();
        valueDay = salaryEmployee/30;

        if (vacationDays > 0) {
            if (startDate <= startVacations && startVacations <= endDate
                && endVacations >= startDate && endDate >= endVacations ) {
                    vacationDays++;
                    $("#vacationDays").val(vacationDays);
                    vacationAcrued = parseFloat(vacationDays) * parseFloat(valueDay);
                    $("#vacation_acrued").val(vacationAcrued.toFixed(2));
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'las fechas no crresponden al mismo periodo de nomina',
                    showConfirmButton: false,
                    timer: 3000 // es ms (mili-segundos)

                });
                cleanVacations();
            }
        } else {
            Swal.fire("Fecha de Inicio no puede ser mayor a fecha de fin");
            cleanVacations();
        }

    }

</script>
