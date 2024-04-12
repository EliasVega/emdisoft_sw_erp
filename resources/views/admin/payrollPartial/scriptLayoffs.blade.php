<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/

    $("#addProvisionLayoffs").hide();
    $("#addProvisionInterest").hide();
    $("#addProLayoffDays").hide();
    $("#addDLP").hide();
    $("#addLayoffsAdjustment").hide();

    //Iniciando fechas segun fecha inicio de nomina
    function addLayoffsDate(){
        layoffInterest = $("#pro_lay_int").val();
        provisionLayoffs = $("#provision_layoffs").val();
        provisionTotal = parseFloat(layoffInterest) + parseFloat(provisionLayoffs);
        $("#provision_total").val(provisionTotal.toFixed(2));
        daysLayoffs = $("#daysProLayoffs").val();
        startLayoffs = $("#startLayoffs").val();
        endLayoffs = $("#end_date").val();
        layoffsDateStart = new Date(startLayoffs);
        layoffsDateEnd = new Date(endLayoffs);
        //addicionar horas para hora colombia
        addHours = 5;
        //obtener horas del mes seleccionado
        hoursStart = layoffsDateStart.getHours();
        hoursEnd = layoffsDateEnd.getHours();
        layoffsDateStart.setHours(hoursStart + addHours);
        layoffsDateEnd.setHours(hoursEnd + addHours);

        layoffsStartDate = new Date(layoffsDateStart);
        layoffsEndDate = new Date(layoffsDateEnd);
        dateEndLayoffs = moment(layoffsEndDate);
        dayMonth = dateEndLayoffs.format('D');
        month = dateEndLayoffs.format('M');
        if (dayMonth >= 30) {
            dayMonth = 30
        } else if (month == 2 && dayMonth >= 28){
            dayMonth = 30;
        }

        layoffsInterestTotal = parseFloat(provisionLayoffs) + parseFloat(layoffInterest);
        layAdjTotal = parseFloat(layoffsInterestTotal) - parseFloat(provisionTotal);

        startDateLayoffs(layoffsStartDate);
        endDateLayoffs(layoffsEndDate);
        $("#layoff_days").val(daysLayoffs);
        $("#value_layoffs").val(provisionLayoffs);
        $("#layoffs_adjustment").val(layoffAdjustment);
        //$("#total_layoffs").val(layoffsInterestTotal);
    }

    //Colocando las fechas de inicio y fin de cesantias
    function startDateLayoffs(layoffsStartDate) {
        month1 = layoffsStartDate.getMonth()+1; //obteniendo mes
        day1 = layoffsStartDate.getDate(); //obteniendo dia
        year1 = layoffsStartDate.getFullYear(); //obteniendo año
        if(day1<10)
            day1='0'+day1; //agrega cero si el menor de 10
        if(month1<10)
            month1='0'+month1 //agrega cero si el menor de 10
        document.getElementById('startLayoffs').value=year1+"-"+month1+"-"+day1;
    }
    //Colocando las fechas de inicio y fin de cesantias
    function endDateLayoffs(layoffsEndDate) {
        month2 = layoffsEndDate.getMonth()+1; //obteniendo mes
        day2 = layoffsEndDate.getDate(); //obteniendo dia
        year2 = layoffsEndDate.getFullYear(); //obteniendo año
        if(day2<10)
            day2='0'+day2; //agrega cero si el menor de 10
        if(month2<10)
            month2='0'+month2 //agrega cero si el menor de 10
        document.getElementById('endLayoffs').value=year2+"-"+month2+"-"+day2;
    }

    $('#startLayoffs').prop("readonly", true);

    //fecha final manual
    $("#endLayoffs").change(timeLayoffs);

    //hallando la cantidad de dias
    function timeLayoffs(){

        endDate = $("#end_date").val();
        endTime = moment(endDate);
        endYear = moment(endTime).year();
        endMonth = moment(endTime).month();

        startLayoffs = $("#startLayoffs").val();
        endLayoffs = $("#endLayoffs").val();
        startTimeLayoffs = moment(startLayoffs);
        endTimeLayoffs = moment(endLayoffs);

        endYearLayoffs = moment(endTimeLayoffs).year();
        endMonthLayoffs = moment(endTimeLayoffs).month();
        //endDayLayoffs = moment(endTimeLayoffs).day();
        layoffsDays = endTimeLayoffs.diff(startTimeLayoffs, 'days');
        dayMonth = endTimeLayoffs.format('D');

        layoffsMonth = parseInt(endMonth) - parseInt(endMonthLayoffs);
        provisionLayoffs = $("#provision_layoffs").val();
        layoffsProvision = $("#layoffs_provisions").val();
        daysLayoffs = $("#daysProLayoffs").val();
        dlp = $("#daysLayoffProvision").val()//dias de cesantias causados

        layoffsDate = new Date(endLayoffs);
        //addicionar horas para hora colombia
        addHours = 5;
        //obtener horas del mes seleccionado
        hours = layoffsDate.getHours();
        layoffsDate.setHours(hours + addHours);

        layoffsEndDate = new Date(layoffsDate);
        dateEndLayoffs = moment(layoffsEndDate);
        dayMonth = dateEndLayoffs.format('D');
        month = dateEndLayoffs.format('M');
        if (dayMonth >= 30) {
            dayMonth = 30;
        } else if (month == 2 && dayMonth >= 28){
            dayMonth = 30;
        }

        salaryEmployee = $("#salary").val();
        transportAssistance = $("#transport_assistance").val();

        if (layoffsDays >= 0) {
            if (endYearLayoffs == endYear && endMonthLayoffs == endMonth) {
                layoffsDaysPeriod = parseInt(dayMonth) + parseInt(daysLayoffs);

                valueLayoffsPeriod = (parseFloat(salaryEmployee) + parseFloat(transportAssistance)) * layoffsDaysPeriod / 360;
                intLayoffTotal = (valueLayoffsPeriod * layoffsDaysPeriod * 0.12) / 360;
                layoffsAdjustment = parseFloat(valueLayoffsPeriod) - parseFloat(provisionLayoffs);

                $("#layoff_days").val(layoffsDaysPeriod);
                $("#value_layoffs").val(valueLayoffsPeriod.toFixed(2));
                $("#layoff_interest").val(intLayoffTotal.toFixed(2));
                if (layoffsAdjustment > 0) {
                    $("#layoffs_adjustment").val(layoffsAdjustment.toFixed(2));
                } else {
                    $("#layoffs_adjustment").val(0);
                }
            } else {

                daysLess = parseInt(layoffsMonth) * 30;
                layoffsDaysPeriod = parseInt(dayMonth) + parseInt(dlp) - parseInt(daysLess);

                valueLayoffsPeriod = (parseFloat(salaryEmployee) + parseFloat(transportAssistance)) * layoffsDaysPeriod / 360;
                intLayoffTotal = (valueLayoffsPeriod * layoffsDaysPeriod * 0.12) / 360;
                layoffsAdjustment = parseFloat(valueLayoffsPeriod) - parseFloat(provisionLayoffs);
                $("#layoff_days").val(layoffsDaysPeriod);
                $("#value_layoffs").val(valueLayoffsPeriod.toFixed(2));
                $("#layoff_interest").val(intLayoffTotal.toFixed(2));
                $("#layoffs_adjustment").val(layoffsAdjustment,toFixed(2));
            }
        } else {
            Swal.fire("Fecha de Inicio no puede ser mayor a fecha de fin");
            $("#endLayoffs").val("");
            $("#valueLayoffs").val("");
            $("#layoffsDays").val("");
        }
    }

    $(document).ready(function() {

        $("#add_layoffs").click(function() {
            addLayoffs();
        });
    });

//adicionar productos a la compra
function addLayoffs() {
    valueLayoffs = $("#value_layoffs").val();
    layoffInterest = $("#layoff_interest").val();
    provisionTotal = $("#provision_total").val();
    totalLayoff = parseFloat(valueLayoffs) + parseFloat(layoffInterest);
    payLayoffs = $("#pay_layoffs").val();

    if (payLayoffs == 'pay') {
        $("#total_layoffs").val(totalLayoff);
        tp = $("#total_acrued").val();
        tpnew = parseFloat(tp) + parseFloat(totalLayoff);
        $("#total_acrued").val(tpnew.toFixed(2));

        layoffAdjustment = parseFloat(totalLayoff) - parseFloat(provisionTotal);
        $("#layoffs_adjustment").val(layoffAdjustment.toFixed(2));
    } else {
        layoffAdjustment = parseFloat(totalLayoff) - parseFloat(provisionTotal);
        $("#layoffs_adjustment").val(layoffAdjustment.toFixed(2));
    }
    $("#canc_layoffs").hide();
    $("#add_layoffs").hide();
    clearLayoff();
}

function clearLayoff() {
    $("#pay_layoffs").prop("readonly", true);
    $("#startLayoffs").prop("readonly", true);
    $("#endLayoffs").prop("readonly", true);
    $("#layoff_days").prop("readonly", true);
    $("#value_layoffs").prop("readonly", true);
    $("#layoff_interest").prop("readonly", true);
    $("#provision_total").prop("readonly", true);
    $("#layoffs_adjustment").prop("readonly", true);
    $("#total_layoffs").prop("readonly", true);
}
</script>
