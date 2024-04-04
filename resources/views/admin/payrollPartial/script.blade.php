
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
    $("#addFortnight").hide();
    $("#addEmployee").hide();
    $("#addMonth").hide();
    $("#addInformation").hide();
    //$("#addProvisions").hide();


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
        let monthDate = new Date($("#month").val());
        //addicionar horas para hora colombia
        let addHours = 5;
        //obtener horas del mes seleccionado
        let hours = monthDate.getHours();
        monthDate.setHours(hours + addHours);
        let firstDay = new Date(monthDate.getFullYear(), monthDate.getMonth(), 1);
        let lastDay = new Date(monthDate.getFullYear(), monthDate.getMonth() + 1, 0);

        startDateWork(firstDay);//fecha inicio automatica
        endDateWork(lastDay);//fecha de fin automatica
        //timeValue();

        $('#end_date').prop("readonly", false);
    }

    function startDateWork(firstDay) {
        let month1 = firstDay.getMonth()+1; //obteniendo mes
        let day1 = firstDay.getDate(); //obteniendo dia
        let year1 = firstDay.getFullYear(); //obteniendo año
        let box1 = $("#checkbox2").prop("checked");
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
        let month2 = lastDay.getMonth()+1; //obteniendo mes
        let day2 = lastDay.getDate(); //obteniendo dia
        let year2 = lastDay.getFullYear(); //obteniendo año
        let box2 = $("#checkbox1").prop("checked");
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
        daysMonth = 15;
        $('#start_date').prop("readonly", false);
        $("#addInformation").show();
        $("#formButtons").show();
        $("#days").val(15);
        timeValue();//salario devengado por los dias trabajados
        provisionEmployee(empId);
        salaryMonth(daysMonth);
        /*
        fortnight = $("#fortnight").val();
        if (fortnight == 'second') {
            yearMonth = $("#month").val();
            provisionPartialEmployee(empId);
        }*/
    }

    function timeValue(){
        let startDate = $("#start_date").val();
        let endDate = $("#end_date").val();
        let startTime = moment(startDate);
        let endTime = moment(endDate);

        let startYear = moment(startTime).year();
        let startMonth = moment(startTime).month();
        let startDay = moment(startTime).day();
        let endYear = moment(endTime).year();
        let endMonth = moment(endTime).month();
        let endDay = moment(endTime).day();
        let days = endTime.diff(startTime, 'days');

        if (days >= 0) {
            if (startYear == endYear && startMonth == endMonth) {
                if (startMonth == 1 && days >= 13) {
                    $("#days").val(15);
                    days = 15;
                } else if(days >= 15){
                    $("#days").val(15);
                    days = 15;
                } else {
                    $("#days").val(days + 1);
                    days = $("#days").val();
                }
                smlv = $("#smlv").val();
                twoSalary = parseFloat(smlv) * 2;
                salaryEmployee = $("#salary").val();
                transportAssistance = $("#transport_assistance").val();
                salaryAcrued = (parseFloat(salaryEmployee)/30)*(parseFloat(days));
                //ta_acrued = (parseFloat(transportAssistance)/30)*(parseFloat(days));
                transportAssistance = parseFloat(transportAssistance);
                daysMonth = days;
                ppv = smlv * daysMonth / 720;
                ppbl = smlv * daysMonth / 360;

                provisionMonth(daysMonth);//provisiones por dias del mes

                fortnight = $("#fortnight").val();
                if (fortnight == 'first') {
                    if (salaryEmployee > twoSalary) {
                        $("#transport_assistance").val(0);
                        $("#transport_acrued").val(0);
                        $("#salary_acrued").val(salaryAcrued.toFixed(2));
                        totalAcrued = 0;
                        totalAcrued = salaryAcrued;
                        //totalAcrued += salaryAcrued;
                        $("#total_acrued").val(totalAcrued.toFixed(2));
                    } else {
                        $("#transport_assistance").val(0);
                        $("#transport_acrued").val(0);
                        $("#salary_acrued").val(salaryAcrued.toFixed(2));
                        totalAcrued = 0;
                        totalAcrued += salaryAcrued;
                        //totalAcrued += transportAssistance;
                        $("#total_acrued").val(totalAcrued.toFixed(2));
                    }
                } else {
                    if (salaryEmployee > twoSalary) {
                        $("#transport_assistance").val(0);
                        $("#transport_acrued").val(0);
                        $("#salary_acrued").val(salaryAcrued.toFixed(2));
                        totalAcrued = 0;
                        totalAcrued = salaryAcrued;
                        //totalAcrued += salaryAcrued;
                        $("#total_acrued").val(totalAcrued.toFixed(2));
                    } else {

                        $("#transport_assistance").val(transportAssistance);
                        $("#transport_acrued").val(transportAssistance);
                        $("#salary_acrued").val(salaryAcrued.toFixed(2));
                        totalAcrued = 0;
                        totalAcrued += salaryAcrued;
                        totalAcrued += transportAssistance;
                        $("#total_acrued").val(totalAcrued.toFixed(2));
                    }
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
        fortnight = $("#fortnight").val();
        if (fortnight == 'second') {
            dataEmployee = document.getElementById('employee_id').value.split('_');
            empId = dataEmployee[0];
            provisionPartialEmployee(empId, daysMonth);
        } else {
            salaryEmployee = $("#salary").val();
            ppv = salaryEmployee * daysMonth / 720;
            ppbl = salaryEmployee * daysMonth / 360;

            $("#vacation_provisions").val(ppv.toFixed(2));
            $("#bonus_provisions").val(ppbl.toFixed(2));
            $("#layoff_provisions").val(ppbl.toFixed(2));
            $("#vp_days").val(daysMonth);
            $("#bp_days").val(daysMonth);
            $("#lp_days").val(daysMonth);
        }
    }

    function provisionEmployee(empId){
        $.ajax({
            url: "{{ route('getProvisionEmployee') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                employee_id: empId,
            }
        }).done(function(data){ // imprimimos la respuesta
            $("#provision_vacations").val(data.vacations);
            $("#provision_bonus").val(data.bonus);
            $("#provision_layoffs").val(data.layoffs);
            $("#pro_lay_int").val(data.layoff_interest);
        }).fail(function() {
            $("#provision_vacations").val(0);
            $("#provision_bonus").val(0);
            $("#provision_layoffs").val(0);
            $("#pro_lay_int").val(0);
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
            ppv = salaryEmployee * daysMonth / 720;
            ppbl = salaryEmployee * daysMonth / 360;

            totalppv = parseFloat(data.vacations) + parseFloat(ppv);
            totalppb = parseFloat(data.bonus) + parseFloat(ppbl);
            totalppl = parseFloat(data.layoffs) + parseFloat(ppbl);
            totalBonusPro = parseFloat(data.proBonus) + parseFloat(data.bonus) + parseFloat(ppbl);
            totalDaysVacations = parseFloat(data.proVacation_days) + parseFloat(data.vacation_days) + parseFloat(daysMonth);
            totalDaysBonus = parseFloat(data.proBonus_days) + parseFloat(data.bonus_days) + parseFloat(daysMonth);
            totalDaysLayoff = parseFloat(data.proLayoff_days) + parseFloat(data.layoff_days) + parseFloat(daysMonth);
            totalProLayoff = parseFloat(data.proLayoffs) + parseFloat(totalppl);
            intLayoffTotal = (totalProLayoff * totalDaysLayoff * 0.12) / 360;
            daysProBonus = parseFloat(data.proBonus_days);

            vpDays = parseInt(data.vacation_days) + parseInt(daysMonth);
            bpDays = parseInt(data.bonus_days) + parseInt(daysMonth);
            lpDays = parseInt(data.layoff_days) + parseInt(daysMonth);

            $("#provision_bonus").val(totalBonusPro.toFixed(2));
            $("#daysProBonus").val(data.proBonus_days);

            $("#vacation_provisions").val(totalppv.toFixed(2));
            $("#bonus_provisions").val(totalppb.toFixed(2));
            $("#layoff_provisions").val(totalppl.toFixed(2));
            $("#layoff_interest_pro").val(intLayoffTotal.toFixed(2));
            $("#vp_days").val(vpDays);
            $("#bp_days").val(bpDays);
            $("#lp_days").val(lpDays);

        }).fail(function() {
            salaryEmployee = $("#salary").val();
            ppv = salaryEmployee * daysMonth / 720;
            ppbl = salaryEmployee * daysMonth / 360;

            totalppv = parseFloat(ppv);
            totalppb = parseFloat(ppbl);
            totalppl = parseFloat(ppbl);
            totalBonusPro = parseFloat(ppbl);
            totalDaysLayoff = parseFloat(daysMonth);
            totalProLayoff = parseFloat(totalppl);
            intLayoffTotal = (totalProLayoff * totalDaysLayoff * 0.12) / 360;

            vpDays = parseInt(daysMonth);
            bpDays = parseInt(daysMonth);
            lpDays = parseInt(daysMonth);

            $("#provision_bonus").val(totalBonusPro.toFixed(2));

            $("#vacation_provisions").val(totalppv.toFixed(2));
            $("#bonus_provisions").val(totalppb.toFixed(2));
            $("#layoff_provisions").val(totalppl.toFixed(2));
            $("#layoff_interest_pro").val(intLayoffTotal.toFixed(2));
            $("#vp_days").val(vpDays);
            $("#bp_days").val(bpDays);
            $("#lp_days").val(lpDays);
            //
        }).always(function() {
            //alert("Siempre se ejecuta")
        });
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

            //provisionMonth(daysMonth);

            fortnight = $("#fortnight").val();
            if (fortnight == 'first') {
                if (salaryEmployee > twoSalary) {
                    $("#transport_assistance").val(0);
                    $("#transport_acrued").val(0);
                    $("#salary_acrued").val(salaryAcrued.toFixed(2));
                    totalAcrued = 0;
                    totalAcrued = salaryAcrued;
                    //totalAcrued += salaryAcrued;
                    $("#total_acrued").val(totalAcrued.toFixed(2));
                } else {
                    $("#transport_assistance").val(0);
                    $("#transport_acrued").val(0);
                    $("#salary_acrued").val(salaryAcrued.toFixed(2));
                    totalAcrued = 0;
                    totalAcrued += salaryAcrued;
                    //totalAcrued += transportAssistance;
                    $("#total_acrued").val(totalAcrued.toFixed(2));
                }
            } else {
                if (salaryEmployee > twoSalary) {
                    $("#transport_assistance").val(0);
                    $("#transport_acrued").val(0);
                    $("#salary_acrued").val(salaryAcrued.toFixed(2));
                    totalAcrued = 0;
                    totalAcrued = salaryAcrued;
                    //totalAcrued += salaryAcrued;
                    $("#total_acrued").val(totalAcrued.toFixed(2));
                } else {

                    $("#transport_assistance").val(transportAssistance);
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

    $("#start_date").change(dateProp);
    //desabilitando fecha final
    function dateProp(){
        $('#end_date').prop("readonly", false)
    }

    $("#end_date").change(timeValue);

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
    }

    $(document).on("click", "#addExtras", function () {
        $("#formOvertime").show();
        $("#formVacations").hide();
        $("#formBonus").hide();
        $("#formLayoffs").hide();

    });
    $(document).on("click", "#addVacations", function () {
        $("#formVacations").show();
        $("#formOvertime").hide();
        $("#formBonus").hide();
        $("#formLayoffs").hide();

    });
    $(document).on("click", "#addBonus", function () {
        $("#formVacations").hide();
        $("#formOvertime").hide();
        $("#formBonus").show();
        $("#formLayoffs").hide();

    });
    $(document).on("click", "#addLayoffs", function () {
        $("#formVacations").hide();
        $("#formOvertime").hide();
        $("#formBonus").hide();
        $("#formLayoffs").show();
        dateLayoff = $("#start_date").val();
        addLayoffsDate(dateLayoff);

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
