<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/

    $("#addBonusAdjustment").hide();
    $("#addProBonusDays").hide();
    let subtotalBonus = [];
    let contBonus = 0;
    let totalBonus = 0;

    $(".bonusPeriod").change(addBonusDate);

    function addBonusDate(){
        $("#addBonusPeriod").hide();
        provisionBonus = $("#provision_bonus").val();
        bonusProvision = $("#bonus_provisions").val();
        daysBonus = $("#daysProBonus").val();
        startBonus = $("#startBonus").val();
        endBonus = $("#end_date").val();

        bonusDateStart = new Date(startBonus);
        bonusDateEnd = new Date(endBonus);
        //addicionar horas para hora colombia
        addHours = 5;
        //obtener horas del mes seleccionado
        hoursStart = bonusDateStart.getHours();
        hoursEnd = bonusDateEnd.getHours();
        bonusDateStart.setHours(hoursStart + addHours);
        bonusDateEnd.setHours(hoursEnd + addHours);

        bonusStartDate = new Date(bonusDateStart);
        bonusEndDate = new Date(bonusDateEnd);
        dateEndBonus = moment(bonusEndDate);
        dayMonth = dateEndBonus.format('D');
        month = dateEndBonus.format('M');
        if (dayMonth >= 30) {
            dayMonth = 30
        } else if (month == 2 && dayMonth >= 28){
            dayMonth = 30;
        }
        bonusDaysPeriod = parseFloat(dayMonth) + parseFloat(daysBonus);
        startDateBonus(bonusStartDate);
        endDateBonus(bonusEndDate);
        //bonus = parseFloat(provisionBonus) + parseFloat(bonusProvision);
        $("#bonusDays").val(bonusDaysPeriod);
        $("#valueBonus").val(provisionBonus);
    }

    function startDateBonus(bonusStartDate) {
        let month1 = bonusStartDate.getMonth()+1; //obteniendo mes
        let day1 = bonusStartDate.getDate(); //obteniendo dia
        let year1 = bonusStartDate.getFullYear(); //obteniendo año
        //let box1 = $("#bonus2").prop("checked");
        if(day1<10)
            day1='0'+day1; //agrega cero si el menor de 10
        if(month1<10)
            month1='0'+month1 //agrega cero si el menor de 10
        document.getElementById('startBonus').value=year1+"-"+month1+"-"+day1;
    }

    function endDateBonus(bonusEndDate) {
        let month2 = bonusEndDate.getMonth()+1; //obteniendo mes
        let day2 = bonusEndDate.getDate(); //obteniendo dia
        let year2 = bonusEndDate.getFullYear(); //obteniendo año
        //let box2 = $("#bonus1").prop("checked");
        if(day2<10)
            day2='0'+day2; //agrega cero si el menor de 10
        if(month2<10)
            month2='0'+month2 //agrega cero si el menor de 10
        document.getElementById('endBonus').value=year2+"-"+month2+"-"+day2;
    }

    $("#type_bonus").change(changeTypeBonus);

    function changeTypeBonus(){
        typeBonus = $("#type_bonus").val();
        if (typeBonus == "salary") {
            $("#addProvisionBonus").show();
            addBonusDate();
        } else {
            $("#startBonus").prop('readonly', false);
            $("#startBonus").val("");
            $("#endBonus").val("");
            $("#bonusDays").val("");
            $("#valueBonus").val("");
            $("#addProvisionBonus").hide();
        }
    }

    $('#startBonus').prop("readonly", true);

    //$("#startBonus").change(timeBonus);

    $("#endBonus").change(timeBonus);

    function timeBonus(){
        endDate = $("#end_date").val();
        endTime = moment(endDate);
        endYear = moment(endTime).year();
        endMonth = moment(endTime).month();

        startBonus = $("#startBonus").val();
        endBonus = $("#endBonus").val();
        startTimeBonus = moment(startBonus);
        endTimeBonus = moment(endBonus);

        endYearBonus = moment(endTimeBonus).year();
        endMonthBonus = moment(endTimeBonus).month();
        endDayBonus = moment(endTimeBonus).day();
        bonusDays = endTimeBonus.diff(startTimeBonus, 'days');
        dayMonth = endTimeBonus.format('D');

        if (bonusDays >= 0) {
            typeBonus = $("#type_bonus").val();
            if (typeBonus == "salary") {
                if (endYearBonus == endYear && endMonthBonus == endMonth) {
                    provisionBonus = $("#provision_bonus").val();
                    bonusProvision = $("#bonus_provisions").val();
                    daysBonus = $("#daysProBonus").val();

                    bonusDate = new Date(endBonus);
                    //addicionar horas para hora colombia
                    addHours = 5;
                    //obtener horas del mes seleccionado
                    hours = bonusDate.getHours();
                    bonusDate.setHours(hours + addHours);

                    bonusEndDate = new Date(bonusDate);
                    dateEndBonus = moment(bonusEndDate);
                    dayMonth = dateEndBonus.format('D');
                    month = dateEndBonus.format('M');
                    if (dayMonth >= 30) {
                        dayMonth = 30
                    } else if (month == 2 && dayMonth >= 28){
                        dayMonth = 30;
                    }
                    bonusDaysPeriod = parseFloat(dayMonth) + parseFloat(daysBonus);
                    salaryEmployee = $("#salary").val();
                    valueBonusPeriod = salaryEmployee * bonusDaysPeriod / 360;
                    bonusAdjustment = parseFloat(valueBonusPeriod) - parseFloat(provisionBonus);
                    $("#bonusDays").val(bonusDaysPeriod);
                    $("#valueBonus").val(valueBonusPeriod.toFixed(2));
                    if (parseInt(bonusAdjustment) > 0) {
                        $("#bonus_adjustment").val(bonusAdjustment);
                    } else {
                        $("#bonus_adjustment").val(0);
                    }
                } else {

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Fecha no corresponde a esta nomina",
                    });
                    $("#endBonus").val("");
                    $("#valueBonus").val("");
                    $("#bonusDays").val("");
                }
            } else {
                $("#bonusDays").val(bonusDays);
                $("#valueBonus").val("");
            }

        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Fecha de Inicio no puede ser superior a la fecha fin",
            });
            $("#endBonus").val("");
            $("#valueBonus").val("");
            $("#bonusDays").val("");
        }

    }

    $(document).ready(function() {

        $("#add_bonus").click(function() {
            addBonus();
        });
    });

    //adicionar productos a la compra
    function addBonus() {

        startBonus = $("#startBonus").val();
        endBonus = $("#endBonus").val();
        type_id = $("#type_bonus").val();
        type = $("#type_bonus option:selected").text();
        bonusDays = $("#bonusDays").val();
        valueBonus = $("#valueBonus").val();

        tp = $("#total_acrued").val();
        tpnew = parseFloat(tp) + parseFloat(valueBonus);
        $("#total_acrued").val(tpnew.toFixed(2));

        if (Date.parse(startBonus) <= Date.parse(endBonus)) {
            if (type_id != "" && type != "" && bonusDays > 0) {
                subtotalBonus[contBonus] = parseFloat(valueBonus);
                totalBonus = totalBonus + subtotalBonus[contBonus];
                var rowBonus = '<tr class="selected" id="rowBonus'+contBonus+'"><td><button type="button" class="btn btn-danger btn-sm btndelete"onclick="deleterowBonus('+contBonus+');"><i class="fas fa-trash"></i></button></td><td><input type="hidden" name="bonus_type[]"  value="'+type_id+'">'+type+'</td><td><input type="hidden" name="start_bonus[]" value="'+startBonus+'">'+startBonus+'</td><td><input type="hidden" name="end_bonus[]" value="'+endBonus+'">'+endBonus+'</td> <td><input type="hidden" name="bonus_days[]" value="'+bonusDays+'">'+bonusDays+'</td><td><input type="hidden" name="value_bonus[]" value="'+valueBonus+'">'+valueBonus+'</td></tr>';

                contBonus++;
                totalsBonus();
                $('#bonus').append(rowBonus);
                cleanBonus();


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

    function cleanBonus() {
        $("#startBonus").val("");
        $("#endBonus").val("");
        $("#vacationDays").val("");
    }

    function totalsBonus() {
        typeBonusId = $("#type_bonus").val();
        if (typeBonusId == 'salary') {
            provisionBonus = $("#provision_bonus").val();
            bonusAdjustment = parseFloat(totalBonus) - parseFloat(provisionBonus);
            //$("#bonus_adjustment").val(bonusAdjustment.toFixed(2));
        }


        $("#total_bonus_html").html("$ " + totalBonus.toFixed(2));
        $("#total_bonus").val(totalBonus.toFixed(2));
    }

    function deleterowBonus(index) {

        totalBonus -= subtotalBonus[index];

        $("#total_bonus_html").html("$ " + totalBonus.toFixed(2));
        $("#total_bonus").val(totalBonus.toFixed(2));

        $("#rowBonus" + index).remove();
    }
</script>
