<script>
    /*
    $(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/

    let subtotalInability = [];
    let daysInabilityArray = [];
    let originArray = [];
    let contInability = 0;
    let totalInability = 0;

    $("#startInability").change(activeEndInability);
    function activeEndInability() {
        $("#endInability").prop('readonly', false);
    }
    $("#endInability").change(addInabilityDate);

    function addInabilityDate() {

        fortnight = $("#fortnight").val();
        startInability = $("#startInability").val();
        endInability = $("#endInability").val();
        startTimeInability = moment(startInability);
        endTimeInability = moment(endInability);

        startYearInability = moment(startTimeInability).year();
        startMonthInability = moment(startTimeInability).month();
        //startDayInability = moment(startTimeInability).day();

        endYearInability = moment(endTimeInability).year();
        endMonthInability = moment(endTimeInability).month();
        //endDayInability = moment(endTimeInability).day();

        //Recuperando los dias del mes
        //daysMonth = $("#days").val();
        origin = $("#origin").val();

        dayMonthStart = startTimeInability.format('D');
        dayMonthEnd = endTimeInability.format('D');
        daysInability = parseInt(dayMonthEnd) - parseFloat(dayMonthStart);
        daysInability++;

        if (daysInability > 0) {
            if (startYearInability == endYearInability && startMonthInability == endMonthInability) {
                if (fortnight == 'first' && dayMonthStart >= 1 && dayMonthStart <= 15 && dayMonthEnd >= 1 && dayMonthEnd <= 15) {
                    $("#daysInability").val(daysInability);
                } else if (fortnight == 'second' && dayMonthStart >= 16 && dayMonthEnd >= 16){
                    if (startMonth == 1 && daysInability >= 13) {
                        $("#daysInability").val(15);
                        daysInability = 15;
                    } else if(daysInability >= 15){
                        $("#daysInability").val(15);
                        daysInability = 15;
                    } else {
                        $("#daysInability").val(daysInability);
                    }
                } else {
                    Swal.fire("las fechas no crresponden al mismo periodo");
                    cleanInability();
                }

                smlv = $("#smlv").val();
                salaryEmployee = $("#salary").val();
                daySmlv = parseFloat(smlv)/30;
                daySalaryEmployee = parseFloat(salaryEmployee)/30;
                commonDay = (parseFloat(daySalaryEmployee)/3) * 2;

                daySalary = commonDay;
                if (daySmlv > commonDay) {
                    daySalary = daySmlv;
                }
                //discountSalary = (parseFloat(salaryEmployee)/30) * parseFloat(daysInability);
                valueInability = daySalary * (daysInability);
                if (origin == 'common') {

                    $("#daysInability").val(daysInability);
                    $("#valueDayInability").val(daySalary.toFixed(2));
                    $("#valueInability").val(valueInability.toFixed(2));
                } else {

                    $("#daysInability").val(daysInability);
                    $("#valueDayInability").val(daySalaryEmployee.toFixed(2));
                    $("#valueInability").val(valueInability.toFixed(2));
                }
            } else {
                Swal.fire("las fechas no crresponden al mismo periodo");
                cleanInability();
            }
        } else {
            Swal.fire("Fecha de Inicio no puede ser mayor a fecha de fin");
            cleanInability();
        }
    }

    $(document).ready(function() {

        $("#add_inability").click(function() {
            addInability();
        });
    });

    //adicionar productos a la compra
    function addInability() {

        startInability = $("#startInability").val();
        endInability = $("#endInability").val();
        origin_id = $("#origin").val();
        origin = $("#origin option:selected").text();
        daysInability = $("#daysInability").val();
        valueDayInability = $("#valueDayInability").val();
        days = $("#days").val();
        if (Date.parse(startInability) <= Date.parse(endInability)) {
            if (origin_id != "" && origin != "" && daysInability > 0) {

                daysInabilityArray[contInability] = daysInability;
                originArray[contInability] = origin_id;
                subtotalInability[contInability] = parseFloat(daysInability) * parseFloat(valueDayInability);
                totalInability = totalInability + subtotalInability[contInability];

                days = parseInt(days) - parseInt(daysInability);
                $("#days").val(days);

                var rowInability = '<tr class="selected" id="rowInability' + contInability +
                    '"><td><button type="button" class="btn btn-danger btn-sm btndelete"onclick="deleterowInability(' +
                    contInability +
                    ');"><i class="fas fa-trash"></i></button></td><td><input type="hidden" name="origin_id[]"  value="' +
                    origin_id + '">' + origin + '</td><td><input type="hidden" name="start_inability[]" value="' + startInability +
                    '">' + startInability + '</td><td><input type="hidden" name="end_inability[]" value="' + endInability + '">' +
                    endInability + '</td> <td><input type="hidden" name="inability_days[]" value="' + daysInability + '">' +
                    daysInability + '</td><td><input type="hidden" name="value_day_inability[]" value="' + valueDayInability + '">' +
                    valueDayInability + '</td> <td>$' + Math.round(subtotalInability[contInability]) + ' </td></tr>';

                contInability++;
                addInabilityTotals();
                totalInabilities();
                $('#inabilities').append(rowInability);
                cleanInability();


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

    function cleanInability() {
        $("#startInability").val("");
        $("#endInability").val("");
        $("#daysInability").val("");
        $("#valueDayInability").val("");
        $("#valueInability").val("");
    }

    function totalInabilities() {
        $("#total_inabilities_html").html("$ " + Math.round(totalInability));
        $("#total_inabilities").val(Math.round(totalInability));
    }

    function deleterowInability(index) {
        deleteInabilityTotals(index);
        totalInability = parseFloat(totalInability) - parseFloat(subtotalInability[index]);
        $("#total_inabilities_html").html("$ " + Math.round(totalInability));
        $("#total_inabilities").val(Math.round(totalInability));
        $("#rowInability" + index).remove();
    }

    function addInabilityTotals() {

        salaryEmployee = $("#salary").val();
        daysInability = $("#daysInability").val();
        transportAssistance = $("#transport_assistance").val();
        origin = $("#origin").val();
        salary = $("#salary_acrued").val();
        transportAcrued = $("#transport_acrued").val();
        valueInability = $("#valueInability").val();
        fortnight = $("#fortnight").val();
        baseSalary = $("#base_salary").val();

        discountSalary = (parseFloat(salaryEmployee)/30) * parseFloat(daysInability);
        if (transportAssistance > 0) {
            transportAcruedDiscount = parseFloat(transportAssistance)/30 * daysInability;
            transportAcrued -= parseFloat(transportAcruedDiscount);
        }

        if (origin == 'common') {
            salaryAcrued = parseFloat(salary) - parseFloat(discountSalary);
            $("#salary_acrued").val(salaryAcrued.toFixed(2));

            baseSalary = (parseFloat(baseSalary) - parseFloat(discountSalary)) + parseFloat(valueInability);
            $("#base_salary").val(baseSalary.toFixed(2));

            totalAcrued = $("#total_acrued").val();
            totalAcrued -= parseFloat(discountSalary);
            totalAcrued += parseFloat(valueInability);
            $("#total_acrued").val(totalAcrued.toFixed(2));
            if (fortnight == 'second') {
                $("#transport_acrued").val(transportAcrued);
            }
        } else {
            if (fortnight == 'second') {
                $("#transport_acrued").val(transportAcrued);
            }
        }
    }
    function deleteInabilityTotals(index) {
        salaryEmployee = $("#salary").val();
        daysInability = daysInabilityArray[index];
        transportAssistance = $("#transport_assistance").val();
        origin = originArray[index];
        salary = $("#salary_acrued").val();
        transportAcrued = $("#transport_acrued").val();
        valueInability = subtotalInability[index];
        fortnight = $("#fortnight").val();
        baseSalary = $("#base_salary").val();

        discountSalary = (parseFloat(salaryEmployee)/30) * parseFloat(daysInability);
        if (transportAssistance > 0) {
            transportAcruedDiscount = parseFloat(transportAssistance)/30 * daysInability;
            transportAcrued = parseFloat(transportAcruedDiscount) + parseFloat(transportAcruedDiscount);
        }

        if (origin == 'common') {
            salaryAcrued = parseFloat(salary) + parseFloat(discountSalary);
            $("#salary_acrued").val(salaryAcrued.toFixed(2));

            baseSalary += parseFloat(discountSalary);
            $("#base_salary").val(baseSalary.toFixed(2));

            totalAcrued = $("#total_acrued").val();
            totalAcrued = parseFloat(totalAcrued) + parseFloat(discountSalary);
            totalAcrued -= parseFloat(valueInability);
            $("#total_acrued").val(Math.round(totalAcrued));
            if (fortnight == 'second') {
                $("#transport_acrued").val(transportAcrued);
            }
        } else {
            if (fortnight == 'second') {
                $("#transport_acrued").val(transportAcrued);
            }
        }
    }
</script>
