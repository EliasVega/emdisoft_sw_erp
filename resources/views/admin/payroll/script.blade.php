
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

    $("#addSmlv").hide();
    $("#formButtons").hide();
    $("#formOvertime").hide();

    let contDate = 0;

    $('#start_date').prop("readonly", true)
    $('#end_date').prop("readonly", true)
    $("#start_date").change(dateProp);
    $("#end_date").change(timeValue);

    function dateProp(){
        $('#end_date').prop("readonly", false)
    }

    function timeValue(){
        let startDate = $("#start_date").val();
        let endDate = $("#end_date").val();
        let startTime = moment(startDate);
        let endTime = moment(endDate);
        let days = endTime.diff(startTime, 'days');
        var startYear = moment(startTime).year();
        var startMonth = moment(startTime).month();
        var startDay = moment(startTime).day();
        var endYear = moment(endTime).year();
        var endMonth = moment(endTime).month();
        var endDay = moment(endTime).day();

        if (days >= 0) {
            if (startYear == endYear && startMonth == endMonth) {
                $("#days").val(days + 1);
                daysMonth = days + 1;

                smlv = $("#smlv").val();
                twoSalary = parseFloat(smlv) * 2;
                salaryEmployee = $("#salary").val();
                transportAssistance = $("#transport_assistance").val();
                salaryAcrued = (salaryEmployee/30)*daysMonth;
                ta_acrued = (transportAssistance/30)*daysMonth;
                if (salaryEmployee > twoSalary) {
                    $("#transport_acrued").val(0);
                    $("#salary_acrued").val(salaryAcrued);
                } else {
                    $("#transport_acrued").val(ta_acrued);
                    $("#salary_acrued").val(salaryAcrued);
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
        daysMonth = 30;
        $('#start_date').prop("readonly", false);
        $('#employee_id').prop("disabled", true);
        $("#formButtons").show();
        transportAssistance(daysMonth)
    }

    function transportAssistance(daysMonth){
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
                $("#salary_acrued").val(salaryAcrued);
            } else {
                $("#transport_assistance").val(transportAssistance);
                $("#transport_acrued").val(ta_acrued);
                $("#salary_acrued").val(salaryAcrued);
            }

        });
    }

    $(document).on("click", "#addExtras", function () {
        $("#formOvertime").show();

    });

</script>
