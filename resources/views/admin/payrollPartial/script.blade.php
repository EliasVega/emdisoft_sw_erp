
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
    $("#addSmlv").hide();
    $("#formButtons").hide();
    $("#formOvertime").hide();
    $("#formVacations").hide();
    $("#addFortnight").hide();
    $("#addEmployee").hide();
    $("#addMonth").hide();

    $('#start_date').prop("readonly", true)
    $('#end_date').prop("readonly", true)



    $("#month").change(getDate);
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

        startDateWork(firstDay);
        endDateWork(lastDay);
        timeValue();

        $('#end_date').prop("readonly", false);
    }

    function startDateWork(firstDay) {
        let date1 = new Date(firstDay); //Fecha actual
        let month1 = date1.getMonth()+1; //obteniendo mes
        let day1 = date1.getDate(); //obteniendo dia
        let year1 = date1.getFullYear(); //obteniendo año
        let box1 = $("#checkbox2").prop("checked");
        if (box1 == true) {
            day1 = 16
            $("#fortnight").val('second');
        }
        if(day1<10)
            day1='0'+day1; //agrega cero si el menor de 10
        if(month1<10)
            month1='0'+month1 //agrega cero si el menor de 10
        document.getElementById('start_date').value=year1+"-"+month1+"-"+day1;

    }

    function endDateWork(lastDay) {
        let date2 = new Date(lastDay); //Fecha actual
        let month2 = date2.getMonth()+1; //obteniendo mes
        let day2 = date2.getDate(); //obteniendo dia
        let year2 = date2.getFullYear(); //obteniendo año
        let box2 = $("#checkbox1").prop("checked");
        if (box2 == true) {
            day2 = 15
            $("#fortnight").val('first');
        }
        if(day2<10)
            day2='0'+day2; //agrega cero si el menor de 10
        if(month2<10)
            month2='0'+month2 //agrega cero si el menor de 10
        document.getElementById('end_date').value=year2+"-"+month2+"-"+day2;

    }

    $(".period").change(fortnight);

    function fortnight(){
        $("#addEmployee").show();
        $("#addMonth").show();
        $("#addPeriod").hide();
    }

    $("#start_date").change(dateProp);
    //desabilitando fecha final
    function dateProp(){
        $('#end_date').prop("readonly", false)
    }

    $("#end_date").change(timeValue);

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
                ta_acrued = (parseFloat(transportAssistance)/30)*(parseFloat(days));
                if (salaryEmployee > twoSalary) {
                    $("#transport_acrued").val(0);
                    $("#salary_acrued").val(salaryAcrued);
                    totalAcrued = 0;
                    totalAcrued += salaryAcrued;
                    $("#total_acrued").val(totalAcrued);
                } else {
                    $("#transport_acrued").val(ta_acrued);
                    $("#salary_acrued").val(salaryAcrued);
                    totalAcrued = 0;
                    totalAcrued += ta_acrued;
                    totalAcrued += salaryAcrued;
                    $("#total_acrued").val(totalAcrued);
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

    //seleccionar de acuerdo al empleado
    $("#employee_id").change(employeeValue);

    function employeeValue(){
        dataEmployee = document.getElementById('employee_id').value.split('_');
        $("#salary").val(dataEmployee[1]);
        let empId = dataEmployee[0];
        daysMonth = 15;
        $('#start_date').prop("readonly", false);
        //$('#employee_id').prop("disabled", true);
        $("#formButtons").show();
        $("#days").val(15);
        salaryMonth(daysMonth);
        provisionEmployee(empId);
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
            ta_acrued = (transportAssistance/30)*daysMonth;
            if (salaryEmployee > twoSalary) {
                $("#transport_assistance").val(0);
                $("#transport_acrued").val(0);
                $("#salary_acrued").val(salaryAcrued.toFixed(2));
                totalAcrued = 0;
                totalAcrued = salaryAcrued;
                totalAcrued += salaryAcrued;
                $("#total_acrued").val(totalAcrued.toFixed(2));
            } else {
                $("#transport_assistance").val(transportAssistance);
                $("#transport_acrued").val(ta_acrued.toFixed(2));
                $("#salary_acrued").val(salaryAcrued.toFixed(2));
                totalAcrued = 0;
                totalAcrued += salaryAcrued;
                totalAcrued += ta_acrued;
                $("#total_acrued").val(totalAcrued.toFixed(2));
            }

        });
    }

    //seleccionar de acuerdo al empleado
    $("#days").change(salaryManual);

    function salaryManual() {
        fortnight = $(#"fortnight"). val();
        daysManual = $("#days").val();
        acruedManual = (salaryEmployee/30)*daysManual;
        if (fortnight == ) {

        }
        ta_acruedManual = (transportAssistance/30)*daysManual;
        $("#salary_acrued").val(acruedManual);
        totalAcruedManual = 0;
        totalAcruedManual += acruedManual;
        totalAcruedManual += ta_acruedManual;
        $("#total_acrued").val(totalAcruedManual.toFixed(2));
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
        }).fail(function() {
            //alert("Algo salió mal");
        }).always(function() {
            //alert("Siempre se ejecuta")
        });
    }

    $(document).on("click", "#addExtras", function () {
        $("#formOvertime").show();
        $("#formVacations").hide();

    });
    $(document).on("click", "#addVacations", function () {
        $("#formVacations").show();
        $("#formOvertime").hide();

    });
    $(document).on("click", "#canc_he", function () {
        $("#formOvertime").hide();

    });
    $(document).on("click", "#canc_vacations", function () {
        $("#formVacations").hide();

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
