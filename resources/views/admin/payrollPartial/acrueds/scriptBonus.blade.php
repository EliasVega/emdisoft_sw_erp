<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/

    let subtotalBonus = [];
    let contBonus = 0;
    let totalBonus = 0;
    $("#addBonusAdjustment").hide();
    $("#addProBonusDays").hide();
    $("#addDBP").hide();
    $("#addSBP").hide();

    $(".bonusPeriod").change(addBonusDate);

    //Inicia con las fechas del periodo
    function addBonusDate(){
        $("#addBonusPeriod").hide();
        provisionBonus = $("#provision_bonus").val();
        bonusProvision = $("#bonus_provisions").val();
        daysBonus = $("#daysProBonus").val();
        startBonus = $("#start_bonus_period").val();
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
        //bonusDaysPeriod = parseFloat(dayMonth) + parseFloat(daysBonus);
        startDateBonus(bonusStartDate);
        endDateBonus(bonusEndDate);
        //bonus = parseFloat(provisionBonus) + parseFloat(bonusProvision);
        $("#bonusDays").val(daysBonus);
        $("#valueBonus").val(provisionBonus);
    }

    function startDateBonus(bonusStartDate) {
        month1 = bonusStartDate.getMonth()+1; //obteniendo mes
        day1 = bonusStartDate.getDate(); //obteniendo dia
        year1 = bonusStartDate.getFullYear(); //obteniendo año
        //let box1 = $("#bonus2").prop("checked");
        if(day1<10)
            day1='0'+day1; //agrega cero si el menor de 10
        if(month1<10)
            month1='0'+month1 //agrega cero si el menor de 10
        document.getElementById('startBonus').value=year1+"-"+month1+"-"+day1;
    }

    function endDateBonus(bonusEndDate) {
        month2 = bonusEndDate.getMonth()+1; //obteniendo mes
        day2 = bonusEndDate.getDate(); //obteniendo dia
        year2 = bonusEndDate.getFullYear(); //obteniendo año
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
            //$("#startBonus").prop('readonly', false);
            $("#startBonus").val("");
            $("#endBonus").val("");
            $("#bonusDays").val("");
            $("#valueBonus").val("");
            $("#addProvisionBonus").hide();
        }
    }

    //$('#startBonus').prop("readonly", true);

    $("#startBonus").change(timeBonus);

    $("#endBonus").change(timeBonus);

    function timeBonus(){

        endDate = $("#end_date").val();//tomando la fecha de fin de periodo
        endTime = moment(endDate);//convirtiendo a fecha moment
        endYear = moment(endTime).year();//tomando el año
        endMonth = moment(endTime).month();//tomando el numero de mes
        endMonthTime = endTime.format('M');//tomando le mes

        startBonus = $("#startBonus").val();//tomando la fecha de inicio de prima
        endBonus = $("#endBonus").val();//tomando la fecha de fin de prima
        startTimeBonus = moment(startBonus)//convirtiendo fecha en moment

        bonusDate = new Date(endBonus);//fecha js de la fecha fin de periodo
        //addicionar horas para hora colombia
        addHours = 5;
        //obtener horas del mes seleccionado
        hours = bonusDate.getHours();
        bonusDate.setHours(hours + addHours);//adicionando las horas

        bonusEndDate = new Date(bonusDate);//tomando la data real hora colombia
        endTimeBonus = moment(bonusEndDate);//convirtiendo a moment
        endYearBonus = moment(endTimeBonus).year();//tomando el año fin de prima
        endMonthBonus = moment(endTimeBonus).month();//tomando el mes de fin de prima
        endDayBonus = moment(endTimeBonus).day();//tomando el dia de fin de prima

        bonusDays = endTimeBonus.diff(startTimeBonus, 'days');//calculando la diferencia de dias
        dayMonth = endTimeBonus.format('D');//tomando el dia del mes
        endTimeMonth = endTimeBonus.format('M');//tomando le mes
        //colocando limites de fecha en dias
        if (dayMonth >= 30) {
            dayMonth = 30
        } else if (month == 2 && dayMonth >= 28){
            dayMonth = 30;
        }
        //bonusMonth = parseInt(endMonth) - parseInt(endMonthBonus);//calculando la diferencia en meses de fin de prima

        provisionBonus = $("#provision_bonus").val();//valor de las provisiones total
        bonusProvision = $("#bonus_provisions").val();//valor de las provisiones para este periodo
        daysBonus = $("#daysProBonus").val();//dias de provision mas los dias de este periodo
        dbp = $("#daysBonusProvision").val()//dias de prima causados
        salaryEmployee = $("#salary").val();//obteniendo el salario de los empleados

        if (endTimeMonth == endMonthTime) {
            if (bonusDays >= 0) {
                typeBonus = $("#type_bonus").val();
                if (endYearBonus == endYear && endTimeMonth == endMonthTime) {
                    //bonusDaysPeriod = parseInt(dayMonth) + parseInt(daysBonus);
                    valueBonusPeriod = salaryEmployee * bonusDays / 360;
                    //bonusAdjustment = parseFloat(valueBonusPeriod) - parseFloat(provisionBonus);

                    $("#bonusDays").val(bonusDays);
                    $("#valueBonus").val(valueBonusPeriod.toFixed(2));
                    /*
                    if (parseInt(bonusAdjustment) > 0) {
                        $("#bonus_adjustment").val(bonusAdjustment.toFixed(2));
                    } else {
                        $("#bonus_adjustment").val(0);
                    }*/
                } else {
                    daysLess = parseInt(bonusMonth) * 30;
                    bonusDaysPeriod = parseInt(dayMonth) + parseInt(dbp) - parseInt(daysLess);
                    valueBonusPeriod = (parseFloat(salaryEmployee) + parseFloat(transportAssistance)) * bonusDaysPeriod / 360;
                    bonusAdjustment = parseFloat(valueBonusPeriod) - parseFloat(provisionBonus);
                    $("#bonusDays").val(bonusDaysPeriod);
                    $("#valueBonus").val(valueBonusPeriod.toFixed(2));
                    $("#bonus_adjustment").val(bonusAdjustment.toFixed(2));
                }
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Fecha de Inicio no puede ser superior a la fecha fin",
                });
                $("#valueBonus").val("");
                $("#bonusDays").val("");
            }
        } else {
            Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "La fecha fin de prima no corresponde a este periodo",
                });
        }


    }

    $("#bonusDays").change(valueBonusDays);

    function valueBonusDays() {
        bonusDays = $("#bonusDays").val();
        salaryEmployee = $("#salary").val();//obteniendo el salario de los empleados
        valueBonusPeriod = salaryEmployee * bonusDays / 360;
        $("#valueBonus").val(valueBonusPeriod.toFixed(2));
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
        totalAcrued = $("#total_acrued").val();

        if (Date.parse(startBonus) <= Date.parse(endBonus)) {
            if (type_id != "" && type != "" && bonusDays > 0) {
                subtotalBonus[contBonus] = parseFloat(valueBonus);
                totalBonus = totalBonus + subtotalBonus[contBonus];

                totalAcrued = parseFloat(totalAcrued) + parseFloat(valueBonus);
                $("#total_acrued").val(totalAcrued.toFixed(2));

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
        $("#valueBonus").val("");
        $("#bonusDays").val("");
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

        totalAcrued = $("#total_acrued").val();
        totalAcrued -= subtotalBonus[index];
        $("#total_acrued").val(totalAcrued);

        totalBonus -= subtotalBonus[index];

        $("#total_bonus_html").html("$ " + totalBonus.toFixed(2));
        $("#total_bonus").val(totalBonus.toFixed(2));

        $("#rowBonus" + index).remove();
    }
</script>
