
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
            $('#payment_frecuency_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    let contDate = 0;
    let totalAcrued = 0;
    let salaryEmployee = 0;
    let transportAssistance = 0;

    let ppvac = [];
    $("#addSmlv").hide();
    $("#formButtons").hide();
    $("#formOvertime").hide();
    $("#formVacations").hide();
    $("#formBonus").hide();
    $("#formLayoffs").hide();
    $("#formNovelties").hide();
    $("#addFortnight").hide();
    $("#addEmployee").hide();
    $("#addMonth").hide();
    $("#addInformation").hide();
    $("#addProvisions").hide();


    $('#start_date').prop("readonly", true)
    $('#end_date').prop("readonly", true)

    //selecciona el periodo de quincena
    $(".period").change(addFortnight);

    function addFortnight(){
        //$("#addEmployee").show();
        $("#addMonth").show();
        $("#addPeriod").hide();
        let boxFirst = $("#checkbox1").prop("checked");
        if (boxFirst == true) {
            $("#fortnight").val('first');
        }
        let boxSecond = $("#checkbox2").prop("checked");
        if (boxSecond == true) {
            $("#fortnight").val('second');
        }
    }

    //seleccionar de acuerdo al empleado
    $("#month").change(enableEmployee);

    function enableEmployee() {
        $("#addEmployee").show();
        getDate();
    }

    //$("#month").change(getDate);
    //obtener fechas a partir del mes
    function getDate(){
        monthDate = new Date($("#month").val());
        //addicionar horas para hora colombia
        addHours = 5;
        //obtener horas del mes seleccionado
        hours = monthDate.getHours();
        monthDate.setHours(hours + addHours);
        firstDay = new Date(monthDate.getFullYear(), monthDate.getMonth(), 1);
        lastDay = new Date(monthDate.getFullYear(), monthDate.getMonth() + 1, 0);

        startDateWork(firstDay);//fecha inicio automatica
        endDateWork(lastDay);//fecha de fin automatica
        //timeValue();

        $('#end_date').prop("readonly", false);
    }

    function startDateWork(firstDay) {
        month1 = firstDay.getMonth()+1; //obteniendo mes
        day1 = firstDay.getDate(); //obteniendo dia
        year1 = firstDay.getFullYear(); //obteniendo año
        box1 = $("#checkbox2").prop("checked");
        if (box1 == true) {
            day1 = 16
        }
        if(day1<10)
            day1='0'+day1; //agrega cero si el menor de 10
        if(month1<10)
            month1='0'+month1 //agrega cero si el menor de 10
        document.getElementById('start_date').value=year1+"-"+month1+"-"+day1;

    }

    function endDateWork(lastDay) {
        month2 = lastDay.getMonth()+1; //obteniendo mes
        day2 = lastDay.getDate(); //obteniendo dia
        year2 = lastDay.getFullYear(); //obteniendo año
        box2 = $("#checkbox1").prop("checked");
        if (box2 == true) {
            day2 = 15
        }
        if(day2<10)
            day2='0'+day2; //agrega cero si el menor de 10
        if(month2<10)
            month2='0'+month2 //agrega cero si el menor de 10
        document.getElementById('end_date').value=year2+"-"+month2+"-"+day2;
    }

    //seleccionar de acuerdo al empleado
    $("#employee_id").change(employeeValue);

    function employeeValue(){
        dataEmployee = document.getElementById('employee_id').value.split('_');
        $("#salary").val(dataEmployee[1]);
        empId = dataEmployee[0];
        fortnight = $("#fortnight").val();
        daysMonth = 15;
        $('#start_date').prop("readonly", false);
        $("#addInformation").show();
        $("#formButtons").show();
        $("#days").val(15);

        salaryMonth(daysMonth);//obtiene valores del empleado bases de sueldo
        timeValue();//salario devengado por los dias trabajados
    }

    function salaryMonth(daysMonth){
        indicator = {!! json_encode($indicators) !!};
        indicator.forEach((value, i) => {
            salary = value['smlv'];
            transportAssistance = value['transport_assistance'];
            weekly_hours = value['weekly_hours'];

            $("#smlv").val(salary);
            $("#weekly_hours").val(weekly_hours);
            twoSalary = parseFloat(salary) * 2;
            salaryEmployee = $("#salary").val();
            salaryAcrued = (salaryEmployee/30)*daysMonth;
            transportAssistance = parseFloat(transportAssistance);
            $("#transport_assistance").val(transportAssistance);

            fortnight = $("#fortnight").val();
            if (fortnight == 'first') {
                if (salaryEmployee > twoSalary) {
                    $("#transport_assistance").val(0);
                    $("#transport_acrued").val(0);
                    $("#salary_acrued").val(salaryAcrued.toFixed(2));
                    totalAcrued = 0;
                    totalAcrued = salaryAcrued;
                    $("#total_acrued").val(totalAcrued.toFixed(2));
                } else {
                    $("#transport_acrued").val(0);
                    $("#salary_acrued").val(salaryAcrued.toFixed(2));
                    totalAcrued = 0;
                    totalAcrued += salaryAcrued;
                    $("#total_acrued").val(totalAcrued.toFixed(2));
                }
            } else {
                if (salaryEmployee > twoSalary) {
                    $("#transport_assistance").val(0);
                    $("#transport_acrued").val(0);
                    $("#salary_acrued").val(salaryAcrued.toFixed(2));
                    totalAcrued = 0;
                    totalAcrued = salaryAcrued;
                    $("#total_acrued").val(totalAcrued.toFixed(2));
                } else {
                    $("#transport_acrued").val(transportAssistance);
                    $("#salary_acrued").val(salaryAcrued.toFixed(2));
                    totalAcrued = 0;
                    totalAcrued += salaryAcrued;
                    totalAcrued += transportAssistance;
                    $("#total_acrued").val(totalAcrued.toFixed(2));
                }
            }
        });
    }


    function timeValue(){
        startDate = $("#start_date").val();
        endDate = $("#end_date").val();
        startTime = moment(startDate);
        endTime = moment(endDate);

        startYear = moment(startTime).year();
        startMonth = moment(startTime).month();
        startDay = moment(startTime).day();

        endYear = moment(endTime).year();
        endMonth = moment(endTime).month();
        endDay = moment(endTime).day();

        //Recuperando los dias del mes
        daysMonth = endTime.diff(startTime, 'days');
        dayMonthStart = startTime.format('D');
        dayMonthEnd = endTime.format('D');

        dataEmployee = document.getElementById('employee_id').value.split('_');
        empId = dataEmployee[0];
        yearMonth = $("#month").val();

        fortnight = $("#fortnight").val();
        if (daysMonth >= 0) {
            if (startYear == endYear && startMonth == endMonth) {
                daysMonth++;
                if (fortnight == 'first' && dayMonthStart >= 1 && dayMonthStart <= 15 && dayMonthEnd >= 1 && dayMonthEnd <= 15) {
                    $("#days").val(daysMonth);
                } else if (fortnight == 'second' && dayMonthStart > 15 && dayMonthEnd > 15){
                    if (startMonth == 1 && daysMonth >= 12) {
                    $("#days").val(15);
                        daysMonth = 15;
                    } else if(daysMonth >= 15){
                        $("#days").val(15);
                        daysMonth = 15;
                    } else {
                        $("#days").val(daysMonth);
                    }
                } else {
                    Swal.fire("las fechas no crresponden al mismo periodo");
                    window.location.reload()
                }
                smlv = $("#smlv").val();
                twoSalary = parseFloat(smlv) * 2;
                salaryEmployee = $("#salary").val();
                transportAcrued = $("#transport_assistance").val();
                salaryAcrued = (parseFloat(salaryEmployee)/30) * parseFloat(daysMonth);
                if (transportAcrued > 0) {
                    transportAcrued = (parseFloat(transportAcrued)/30) * parseFloat(daysMonth);
                }

                provisionMonth(daysMonth);//provisiones por dias del mes

                if (fortnight == 'first') {
                    $("#transport_acrued").val(0);
                    $("#salary_acrued").val(salaryAcrued.toFixed(2));
                    totalAcrued = 0;
                    totalAcrued = salaryAcrued;
                    $("#total_acrued").val(totalAcrued.toFixed(2));
                } else {
                    totalAcrued = 0;
                    totalAcrued += salaryAcrued;
                    if (salaryEmployee > twoSalary) {
                        $("#transport_acrued").val(0);
                    } else {

                        firstPayrollPartial(empId, yearMonth, daysMonth);//trae datos de dias para descontar aux transporte
                    }
                    $("#salary_acrued").val(salaryAcrued.toFixed(2));
                    $("#total_acrued").val(totalAcrued.toFixed(2));
                }
            } else {
                Swal.fire("las fechas no crresponden al mismo periodo");
                window.location.reload()
            }
        } else {
            Swal.fire("Fecha de Inicio no puede ser mayor a fecha de fin");
            window.location.reload()
        }

    }
    //provisiones del mes por los dias trabajados mas la quincena anterior
    function provisionMonth(daysMonth) {
        yearMonth = $("#month").val();
        fortnight = $("#fortnight").val();
        if (fortnight == 'second') {
            dataEmployee = document.getElementById('employee_id').value.split('_');
            empId = dataEmployee[0];
            provisionPartialEmployee(empId, daysMonth);
        } else {
            dataEmployee = document.getElementById('employee_id').value.split('_');
            empId = dataEmployee[0];
            provisionEmployee(empId, daysMonth);
        }
    }

    function provisionEmployee(empId, daysMonth){
        $.ajax({
            url: "{{ route('getProvisionEmployee') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                employee_id: empId,
            }
        }).done(function(data){ // imprimimos la respuesta
            salaryEmployee = $("#salary").val();
            transportAssistance = $("#transport_assistance").val();
            ppv = salaryEmployee * daysMonth / 720;
            ppbl = (parseFloat(salaryEmployee) + parseFloat(transportAssistance)) * daysMonth / 360;

            //proVacations = data.proVacations;
            //proBonus = data.proBonus;
            //proLayoffs = data.proLayoffs;
            startPeriodVacations = data.start_period_vacations;
            startPeriodBonus = data.start_period_bonus;
            startPeriodLayoffs = data.start_period_layoffs;

            bonusTotal = parseFloat(data.bonus) + parseFloat(ppbl);
            totalDaysBonus = parseFloat(data.bonus_days) + parseFloat(daysMonth);
            daysBonus = parseInt(data.bonus_days) + parseInt(daysMonth);

            layoffsTotal = parseFloat(data.layoffs) + parseFloat(ppbl);
            totalDaysLayoffs = parseFloat(data.layoff_days) + parseFloat(daysMonth);
            intLayoffTotal = (layoffsTotal * totalDaysLayoffs * 0.12) / 360;
            daysLayoffs = parseInt(data.layoff_days) + parseInt(daysMonth);

            vacationsTotal = parseFloat(data.vacations) + parseFloat(ppv);
            totalDaysVacations = parseFloat(data.vacation_days) + parseFloat(daysMonth);
            daysVacations = parseInt(data.vacation_days) + parseInt(daysMonth);
            alert(data.vacation_days);
            $("#provision_bonus").val(bonusTotal.toFixed(2));
            $("#bonus_provisions").val(ppbl.toFixed(2));
            $("#daysProBonus").val(daysBonus);
            $("#daysBonusProvision").val(data.bonus_days);
            $("#startBonus").val(startPeriodBonus);

            $("#provision_layoffs").val(layoffsTotal.toFixed(2));
            $("#layoff_provisions").val(ppbl.toFixed(2));
            $("#pro_lay_int").val(intLayoffTotal.toFixed(2));
            $("#layoff_interest_pro").val(intLayoffTotal.toFixed(2));
            $("#layoff_interest").val(intLayoffTotal.toFixed(2));
            $("#daysProLayoffs").val(daysLayoffs);
            $("#daysLayoffProvision").val(data.layoff_days);
            $("#startLayoffs").val(startPeriodLayoffs);

            $("#provision_vacations").val(vacationsTotal.toFixed(2));
            $("#vacation_provisions").val(ppv.toFixed(2));
            $("#daysProVacations").val(daysVacations);
            $("#daysVacationProvision").val(data.vacation_days);
            //$("#startVacations").val(startPeriodVacations);
            $("#start_vacation_period").val(startPeriodVacations);
            $("#days_vacation_period").val(data.vacation_days);

            $("#vp_days").val(daysMonth);
            $("#bp_days").val(daysMonth);
            $("#lp_days").val(daysMonth);

        }).fail(function() {
            $("#provision_vacations").val(0);
            $("#provision_bonus").val(0);
            $("#provision_layoffs").val(0);
            $("#pro_lay_int").val(0);

            salaryEmployee = $("#salary").val();
            transportAssistance = $("#transport_assistance").val();
            ppv = salaryEmployee * daysMonth / 720;
            ppbl = (parseFloat(salaryEmployee) + parseFloat(transportAssistance)) * daysMonth / 360;
            intLayoffTotal = (ppbl * daysMonth * 0.12) / 360;


            $("#provision_bonus").val(0);
            $("#bonus_provisions").val(ppbl.toFixed(2));
            $("#daysProBonus").val(daysMonth);

            $("#provision_layoffs").val(0);
            $("#layoff_provisions").val(ppbl.toFixed(2));
            $("#layoff_interest_pro").val(intLayoffTotal.toFixed(2));
            $("#daysProLayoffs").val(daysMonth);

            $("#provision_vacations").val(0);
            $("#vacation_provisions").val(ppv.toFixed(2));
            $("#daysProVacations").val(daysMonth);

            $("#vp_days").val(daysMonth);
            $("#bp_days").val(daysMonth);
            $("#lp_days").val(daysMonth);
        }).always(function() {
            //alert("Siempre se ejecuta")
        });
    }

    function provisionPartialEmployee(empId, daysMonth){
        $.ajax({
            url: "{{ route('getProvPartEmp') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                employee: empId,
            }
        }).done(function(data){ // imprimimos la respuesta
            salaryEmployee = $("#salary").val();
            transportAssistance = $("#transport_assistance").val();

            ppv = salaryEmployee * daysMonth / 720;
            ppbl = (parseFloat(salaryEmployee) + parseFloat(transportAssistance)) * daysMonth / 360;
            startPeriodVacations = data.start_period_vacations;
            startPeriodBonus = data.start_period_bonus;
            startPeriodLayoffs = data.start_period_layoffs;

            startTime = moment(startPeriodLayoffs);
            totalppv = parseFloat(data.vacations) + parseFloat(ppv);
            totalppb = parseFloat(data.bonus) + parseFloat(ppbl);
            totalppl = parseFloat(data.layoffs) + parseFloat(ppbl);

            totalBonusPro = parseFloat(data.proBonus) + parseFloat(data.bonus) + parseFloat(ppbl);
            totalDaysBonus = parseFloat(data.proBonus_days) + parseFloat(data.bonus_days) + parseFloat(daysMonth);
            daysProBonus = parseInt(data.proBonus_days);

            totalLayoffsPro = parseFloat(data.proLayoffs) + parseFloat(totalppl);
            totalDaysLayoff = parseFloat(data.proLayoff_days) + parseFloat(data.layoff_days) + parseFloat(daysMonth);
            intLayoffTotal = (totalLayoffsPro * totalDaysLayoff * 0.12) / 360;
            daysProLayoffs = parseInt(data.proLayoff_days);

            totalVacationsPro = parseFloat(data.proVacations) + parseFloat(data.vacations) + parseFloat(ppv);
            totalDaysVacations = parseFloat(data.proVacation_days) + parseFloat(data.vacation_days) + parseFloat(daysMonth);
            daysProVacations = parseInt(data.proVacation_days);

            vpDays = parseInt(data.vacation_days) + parseInt(daysMonth);
            bpDays = parseInt(data.bonus_days) + parseInt(daysMonth);
            lpDays = parseInt(data.layoff_days) + parseInt(daysMonth);

            $("#provision_bonus").val(totalBonusPro.toFixed(2));
            $("#bonus_provisions").val(totalppb.toFixed(2));
            $("#daysProBonus").val(totalDaysBonus);
            $("#startBonus").val(startPeriodBonus);
            $("#daysBonusProvision").val(daysProBonus);

            $("#provision_layoffs").val(totalLayoffsPro.toFixed(2));
            $("#layoff_provisions").val(totalppl.toFixed(2));
            $("#pro_lay_int").val(data.proLayoff_interest);
            $("#layoff_interest_pro").val(intLayoffTotal.toFixed(2));
            $("#layoff_interest").val(intLayoffTotal.toFixed(2));
            $("#daysProLayoffs").val(totalDaysLayoff);
            $("#startLayoffs").val(startPeriodLayoffs);
            $("#daysLayoffProvision").val(daysProLayoffs);


            $("#provision_vacations").val(totalVacationsPro.toFixed(2));
            $("#vacation_provisions").val(totalppv.toFixed(2));
            $("#daysProVacations").val(totalDaysVacations);
            $("#daysVacationsProvision").val(daysProVacations);
            $("#start_vacation_period").val(startPeriodVacations);
            $("#days_vacation_period").val(daysProVacations);

            $("#vp_days").val(vpDays);
            $("#bp_days").val(bpDays);
            $("#lp_days").val(lpDays);

        }).fail(function() {
            salaryEmployee = $("#salary").val();
            ppv = salaryEmployee * daysMonth / 720;
            ppbl = salaryEmployee * daysMonth / 360;

            totalProLayoff = parseFloat(ppbl);
            intLayoffTotal = (ppbl * daysMonth * 0.12) / 360;

            //$("#provision_bonus").val(ppbl.toFixed(2));

            $("#vacation_provisions").val(ppv.toFixed(2));
            $("#bonus_provisions").val(ppbl.toFixed(2));
            $("#layoff_provisions").val(ppbl.toFixed(2));
            $("#layoff_interest_pro").val(intLayoffTotal.toFixed(2));
            $("#vp_days").val(daysMonth);
            $("#bp_days").val(daysMonth);
            $("#lp_days").val(daysMonth);
        }).always(function() {
            //alert("Siempre se ejecuta")
        });
    }

    function firstPayrollPartial(empId, yearMonth, daysMonth){
        $.ajax({
            url: "{{ route('getPayrollPartial') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                employee_id: empId,
                yearMonth: yearMonth,
            }
        }).done(function(data){ // imprimimos la respuesta
            transportAcrued = $("#transport_assistance").val();
            daysVacationOld = data.vacation_days;
            daysInabilityOld = data.inability_days;
            daysLicenseOld = data.license_days;

            daysMonth = (parseInt(daysMonth) + parseFloat(data.days)) - (parseInt(data.vacation_days) + parseInt(data.inability_days) + parseInt(data.license_days));
            if (transportAcrued > 0) {
                transportAcrued = (transportAcrued/30) * daysMonth;
                $("#transport_acrued").val(transportAcrued);
            }

        }).fail(function() {
            //alert("algo fallo")
        }).always(function() {
            //alert("Siempre se ejecuta")
        });
    }


    $("#start_date").change(dateProp);
    //desabilitando fecha final
    function dateProp(){
        $('#end_date').prop("readonly", false);
        timeValue();
    }

    $("#end_date").change(timeValue);

    /*
    //seleccionar de acuerdo al empleado
    $("#days").change(salaryManual);

    function salaryManual() {
        fortnight = $("#fortnight"). val();
        daysManual = $("#days").val();
        acruedManual = (salaryEmployee/30)*daysManual;
        if (fortnight == 'first') {

        }
        ta_acruedManual = (transportAssistance/30)*daysManual;
        $("#salary_acrued").val(acruedManual);
        totalAcruedManual = 0;
        totalAcruedManual += acruedManual;
        totalAcruedManual += ta_acruedManual;
        $("#total_acrued").val(totalAcruedManual.toFixed(2));
    }*/

    $(document).on("click", "#addExtras", function () {
        $("#formOvertime").show();
        $("#formVacations").hide();
        $("#formBonus").hide();
        $("#formLayoffs").hide();
        $("#formNovelties").hide();
    });
    $(document).on("click", "#addVacations", function () {
        $("#formVacations").show();
        $("#formOvertime").hide();
        $("#formBonus").hide();
        $("#formLayoffs").hide();
        $("#formNovelties").hide();
        addVacationPeriod();
    });
    $(document).on("click", "#addBonus", function () {
        $("#formVacations").hide();
        $("#formOvertime").hide();
        $("#formBonus").show();
        $("#formLayoffs").hide();
        $("#formNovelties").hide();
    });
    $(document).on("click", "#addLayoffs", function () {
        $("#formVacations").hide();
        $("#formOvertime").hide();
        $("#formBonus").hide();
        $("#formLayoffs").show();
        $("#formNovelties").hide();
        addLayoffsDate();
    });
    $(document).on("click", "#addNovelties", function () {
        $("#formVacations").hide();
        $("#formOvertime").hide();
        $("#formBonus").hide();
        $("#formLayoffs").hide();
        $("#formNovelties").show();
        //addNoveltiesDate();
    });
    $(document).on("click", "#canc_he", function () {
        $("#formOvertime").hide();
    });
    $(document).on("click", "#canc_vacations", function () {
        $("#formVacations").hide();

    });
    $(document).on("click", "#canc_bonus", function () {
        $("#formBonus").hide();
    });
    $(document).on("click", "#canc_layoffs", function () {
        $("#formLayoffs").hide();
    });
    $(document).on("click", "#canc_novelties", function () {
        $("#formNovelties").hide();
    });

    $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

</script>
