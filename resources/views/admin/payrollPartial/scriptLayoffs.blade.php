<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/

    $("#addProvisionLayoffs").hide();
    $("#addProvisionInterest").hide();

    //Iniciando fechas segun fecha inicio de nomina
    function addLayoffsDate(dateLayoff){
        layoffInterest = $("#pro_lay_int").val();
        layoffProvision = $("#provision_layoffs").val();
        provisionTotal = parseFloat(layoffInterest) + parseFloat(layoffProvision);
        $("#provision_total").val(provisionTotal.toFixed(2));
        let layoffsDate = new Date(dateLayoff);
        //addicionar horas para hora colombia
        let addHours = 5;
        //obtener horas del mes seleccionado
        let hours = layoffsDate.getHours();
        layoffsDate.setHours(hours + addHours);

        let layoffsStartDate = new Date(layoffsDate.getFullYear(), 0, 1);
        let layoffsEndDate = new Date(layoffsDate.getFullYear(), 11 + 1, 0);
        startDateLayoffs(layoffsStartDate);
        endDateLayoffs(layoffsEndDate);
        salary = $("#salary").val();
        layoffInterest = salary * 12 / 100;
        $("#layoff_days").val(360);
        $("#value_layoffs").val(salary);
        $("#layoff_interest").val(layoffInterest.toFixed(2));
    }

    //Colocando las fechas de inicio y fin de cesantias
    function startDateLayoffs(startLayoffsDay) {
        let month1 = startLayoffsDay.getMonth()+1; //obteniendo mes
        let day1 = startLayoffsDay.getDate(); //obteniendo dia
        let year1 = startLayoffsDay.getFullYear(); //obteniendo año
        if(day1<10)
            day1='0'+day1; //agrega cero si el menor de 10
        if(month1<10)
            month1='0'+month1 //agrega cero si el menor de 10
        document.getElementById('startLayoffs').value=year1+"-"+month1+"-"+day1;
    }
    //Colocando las fechas de inicio y fin de cesantias
    function endDateLayoffs(layoffsEndDate) {
        let month2 = layoffsEndDate.getMonth()+1; //obteniendo mes
        let day2 = layoffsEndDate.getDate(); //obteniendo dia
        let year2 = layoffsEndDate.getFullYear(); //obteniendo año
        if(day2<10)
            day2='0'+day2; //agrega cero si el menor de 10
        if(month2<10)
            month2='0'+month2 //agrega cero si el menor de 10
        document.getElementById('endLayoffs').value=year2+"-"+month2+"-"+day2;
    }



    //fecha inicial manual
    $("#startLayoffs").change(timeLayoffs);
    //fecha final manual
    $("#endLayoffs").change(timeLayoffs);

    //hallando la cantidad de dias
    function timeLayoffs(){
        startLayoffs = $("#startLayoffs").val();
        endLayoffs = $("#endLayoffs").val();
        startTimeLayoffs = moment(startLayoffs);
        endTimeLayoffs = moment(endLayoffs);

        let startYearLayoffs = moment(startTimeLayoffs).year();
        let startMonthLayoffs = moment(startTimeLayoffs).month();
        let startDayLayoffs = moment(startTimeLayoffs).day();

        let endYearLayoffs = moment(endTimeLayoffs).year();
        let endMonthLayoffs = moment(endTimeLayoffs).month();
        let endDayLayoffs = moment(endTimeLayoffs).day();

        let layoffsDays = endTimeLayoffs.diff(startTimeLayoffs, 'days');
        if (layoffsDays >= 0) {
            salary = $("#salary").val();
            layoffs = salary * layoffsDays / 360;
            layoffInterest = layoffs * 12 / 100;
            $("#layoff_days").val(layoffsDays);
            $("#value_layoffs").val(layoffs.toFixed(2));
            $("#layoff_interest").val(layoffInterest.toFixed(2));
            if (layoffsDays > 360 && layoffsDays <= 366) {
                layoffsDays = 360;
            }
        } else {
            Swal.fire("Fecha de Inicio no puede ser mayor a fecha de fin");
            window.location.reload()
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
        tpnew = parseFloat(tp) + parseFloat(totalLayoff)
        $("#total_acrued").val(tpnew.toFixed(2));

        layoffAdjustment = parseFloat(totalLayoff) - parseFloat(provisionTotal);
        $("#layoffs_adjustment").val(layoffAdjustment);
    } else {
        layoffAdjustment = parseFloat(totalLayoff) - parseFloat(provisionTotal);
        $("#layoffs_adjustment").val(layoffAdjustment);
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
