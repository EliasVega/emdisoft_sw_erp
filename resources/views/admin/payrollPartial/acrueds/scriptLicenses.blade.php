<script>
    /*
    $(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/

    let subtotalLicense = [];
    let daysLicenseArray = [];
    let typePayLicenseArray = [];
    let contLicense = 0;
    let totalLicense = 0;

    $("#startLicense").change(activeEndLicense);
    function activeEndLicense() {
        $("#endLicense").prop('readonly', false);
    }
    $("#endLicense").change(addLicenseDate);

    function addLicenseDate() {

        fortnight = $("#fortnight").val();

        startLicense = $("#startLicense").val();
        endLicense = $("#endLicense").val();
        startTimeLicense = moment(startLicense);
        endTimeLicense = moment(endLicense);

        startYearLicense = moment(startTimeLicense).year();
        startMonthLicense = moment(startTimeLicense).month();
        //startDayLicense = moment(startTimeLicense).day();

        endYearLicense = moment(endTimeLicense).year();
        endMonthLicense = moment(endTimeLicense).month();
        //endDayLicense = moment(endTimeLicense).day();

        //Recuperando los dias del mes
        daysMonth = $("#days").val();

        dayMonthStart = startTimeLicense.format('D');
        dayMonthEnd = endTimeLicense.format('D');
        daysLicense = parseInt(dayMonthEnd) - parseFloat(dayMonthStart);
        daysLicense++;

        if (daysLicense > 0) {
            if (startYearLicense == endYearLicense && startMonthLicense == endMonthLicense) {
                if (fortnight == 'first' && dayMonthStart >= 1 && dayMonthStart <= 15 && dayMonthEnd >= 1 && dayMonthEnd <= 15) {
                    $("#daysLicense").val(daysLicense);
                } else if (fortnight == 'second' && dayMonthStart >= 16 && dayMonthEnd >= 16){
                    if (startMonth == 1 && daysLicense >= 13) {
                        $("#daysLicense").val(15);
                        daysLicense = 15;
                    } else if(daysLicense >= 15){
                        $("#daysLicense").val(15);
                        daysLicense = 15;
                    } else {
                        $("#daysLicense").val(daysLicense);
                    }
                } else {
                    Swal.fire("las fechas no crresponden al mismo periodo");
                    cleanLicense();
                }

                smlv = $("#smlv").val();
                salaryEmployee = $("#salary").val();
                daySmlv = parseFloat(smlv)/30;
                daySalaryEmployee = parseFloat(salaryEmployee)/30;

                //discountSalary = (parseFloat(salaryEmployee)/30) * parseFloat(daysLicense);
                valueLicense = daySalaryEmployee * (daysLicense);

                $("#daysLicense").val(daysLicense);
                $("#valueDayLicense").val(daySalaryEmployee.toFixed(2));
                $("#valueLicense").val(valueLicense.toFixed(2));
            } else {
                Swal.fire("las fechas no crresponden al mismo periodo");
                cleanLicense();
            }
        } else {
            Swal.fire("Fecha de Inicio no puede ser mayor a fecha de fin");
            cleanLicense();
        }
    }

    $(document).ready(function() {

        $("#add_license").click(function() {
            addLicense();
        });
    });

    //adicionar productos a la compra
    function addLicense() {

        startLicense = $("#startLicense").val();
        endLicense = $("#endLicense").val();
        typePayLicense_id = $("#typePayLicense").val();
        typePayLicense = $("#typePayLicense option:selected").text();
        typeLicense_id = $("#typeLicense").val();
        typeLicense = $("#typeLicense option:selected").text();
        daysLicense = $("#daysLicense").val();
        valueDayLicense = $("#valueDayLicense").val();
        days = $("#days").val();
        if (Date.parse(startLicense) <= Date.parse(endLicense)) {
            if (typePayLicense != "" && typeLicense_id != "" && daysLicense > 0) {

                daysLicenseArray[contLicense] = daysLicense;
                typePayLicenseArray[contLicense] = typePayLicense;
                subtotalLicense[contLicense] = parseFloat(daysLicense) * parseFloat(valueDayLicense);
                totalLicense = totalLicense + parseFloat(subtotalLicense[contLicense]);

                days = parseInt(days) - parseInt(daysLicense);
                $("#days").val(days);

                var rowLicense = '<tr class="selected" id="rowLicense' + contLicense +
                    '"><td><button type="button" class="btn btn-danger btn-sm btndelete"onclick="deleterowLicense(' +
                    contLicense +
                    ');"><i class="fas fa-trash"></i></button></td><td><input type="hidden" name="type_pay_license[]"  value="' +
                    typePayLicense_id + '">' + typePayLicense + '</td><td><input type="hidden" name="type_license[]"  value="' +
                    typeLicense_id + '">' + typeLicense + '</td><td><input type="hidden" name="start_license[]" value="' + startLicense +
                    '">' + startLicense + '</td><td><input type="hidden" name="end_license[]" value="' + endLicense + '">' +
                    endLicense + '</td> <td><input type="hidden" name="license_days[]" value="' + daysLicense + '">' +
                    daysLicense + '</td><td><input type="hidden" name="value_day_license[]" value="' + valueDayLicense + '">' +
                    valueDayLicense + '</td> <td>$' + Math.round(subtotalLicense[contLicense]) + ' </td></tr>';

                contLicense++;
                addLicenseTotals();
                totalLicenses();
                $('#licenses').append(rowLicense);
                cleanLicense();


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

    function cleanLicense() {
        $("#startLicense").val("");
        $("#endLicense").val("");
        $("#daysLicense").val("");
        $("#valueDayLicense").val("");
        $("#valueLicense").val("");
    }

    function totalLicenses() {
        $("#total_licenses_html").html("$ " + Math.round(totalLicense));
        $("#total_licenses").val(Math.round(totalLicense));
    }

    function deleterowLicense(index) {
        deleteLicenseTotals(index);
        totalLicense = parseFloat(totalLicense) - parseFloat(subtotalLicense[index]);
        $("#total_licenses_html").html("$ " + Math.round(totalLicense));
        $("#total_licenses").val(Math.round(totalLicense));
        $("#rowLicense" + index).remove();
    }

    function addLicenseTotals() {

        salaryEmployee = $("#salary").val();
        daysLicense = $("#daysLicense").val();
        transportAssistance = $("#transport_assistance").val();
        typePayLicense = $("#typePayLicense").val();
        salary = $("#salary_acrued").val();
        transportAcrued = $("#transport_acrued").val();
        valueLicense = $("#valueLicense").val();
        fortnight = $("#fortnight").val();

        if (transportAssistance > 0) {
            transportAcruedDiscount = parseFloat(transportAssistance)/30 * daysLicense;
            transportAcrued -= parseFloat(transportAcruedDiscount);
        }

        if (typePayLicense == 'unpaid') {
            salaryAcrued = parseFloat(salary) - parseFloat(valueLicense);
            $("#salary_acrued").val(salaryAcrued.toFixed(2));
            totalAcrued = $("#total_acrued").val();
            totalAcrued -= parseFloat(valueLicense);
            if (fortnight == 'second') {
                totalAcrued -= parseFloat(transportAcruedDiscount);
                $("#transport_acrued").val(transportAcrued);
            }
            $("#total_acrued").val(Math.round(totalAcrued));
        } else {
            totalAcrued = $("#total_acrued").val();
            totalAcrued -= parseFloat(transportAcruedDiscount);
            $("#total_acrued").val(Math.round(totalAcrued));
            if (fortnight == 'second') {
                $("#transport_acrued").val(transportAcrued);
            }
        }
    }
    function deleteLicenseTotals(index) {
        salaryEmployee = $("#salary").val();
        daysLicense = daysLicenseArray[index];
        transportAssistance = $("#transport_assistance").val();
        typePayLicense = typePayLicenseArray[index];
        salary = $("#salary_acrued").val();
        transportAcrued = $("#transport_acrued").val();
        valueLicense = subtotalLicense[index];
        fortnight = $("#fortnight").val();

        if (transportAssistance > 0) {
            transportAcruedDiscount = parseFloat(transportAssistance)/30 * daysLicense;
            transportAcrued = parseFloat(transportAcruedDiscount) + parseFloat(transportAcruedDiscount);
        }

        if (typePayLicense == 'unpaid') {
            salaryAcrued = parseFloat(salary) + parseFloat(valueLicense);
            $("#salary_acrued").val(salaryAcrued.toFixed(2));

            totalAcrued = $("#total_acrued").val();
            totalAcrued = parseFloat(totalAcrued) + parseFloat(valueLicense);
            totalAcrued = parseFloat(totalAcrued) + parseFloat(transportAcruedDiscount);
            $("#total_acrued").val(Math.round(totalAcrued));
            if (fortnight == 'second') {
                $("#transport_acrued").val(transportAcrued);
            }
        } else {
            totalAcrued = $("#total_acrued").val();
            totalAcrued = parseFloat(totalAcrued) + parseFloat(transportAcruedDiscount);
            $("#total_acrued").val(Math.round(totalAcrued));
            if (fortnight == 'second') {
                $("#transport_acrued").val(transportAcrued);
            }
        }
    }
</script>
