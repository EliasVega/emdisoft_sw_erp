<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/
    let subtotalBonus = [];
    let contBonus = 0;
    let totalBonus = 0;

    $(".bonusPeriod").change(addBonusDate);

    function addBonusDate(){
        $("#addBonusPeriod").hide();
        bonusProvision = $("#provision_bonus").val();
        let bonusDate = new Date();
            //addicionar horas para hora colombia
            let addHours = 5;
            //obtener horas del mes seleccionado
            let hours = bonusDate.getHours();
            bonusDate.setHours(hours + addHours);
        let period1 = $("#bonus1").prop("checked");
        if (period1 == true) {
            let bonusStartDate = new Date(bonusDate.getFullYear(), 0, 1);
            let bonusEndDate = new Date(bonusDate.getFullYear(), 5 + 1, 0);
            startDateBonus(bonusStartDate);
            endDateBonus(bonusEndDate);
            salary = $("#salary").val();
            bonus = salary/2;

            $("#bonusDays").val(180);
            $("#valueBonus").val(bonus);
        }
        let period2 = $("#bonus2").prop("checked");
        if (period2 == true) {
            let bonusStartDate = new Date(bonusDate.getFullYear(), 6, 1);
            let bonusEndDate = new Date(bonusDate.getFullYear(), 11 + 1, 0);
            startDateBonus(bonusStartDate);
            endDateBonus(bonusEndDate);
            salary = $("#salary").val();
            bonus = salary/2;
            $("#bonusDays").val(180);
            $("#valueBonus").val(bonus);
        }
    }

    function startDateBonus(startBonusDay) {
        let month1 = startBonusDay.getMonth()+1; //obteniendo mes
        let day1 = startBonusDay.getDate(); //obteniendo dia
        let year1 = startBonusDay.getFullYear(); //obteniendo año
        let box1 = $("#bonus2").prop("checked");
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
        let box2 = $("#bonus1").prop("checked");
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
            addBonusDate();
        } else {
            $("#startBonus").val("");
            $("#endBonus").val("");
            $("#bonusDays").val("");
            $("#valueBonus").val("");
        }

    }

    //$('#endBonus').prop("readonly", true);

    $("#startBonus").change(timeBonus);

    $("#endBonus").change(timeBonus);

    function timeBonus(){
        startBonus = $("#startBonus").val();
        endBonus = $("#endBonus").val();
        startTimeBonus = moment(startBonus);
        endTimeBonus = moment(endBonus);

        let startYearBonus = moment(startTimeBonus).year();
        let startMonthBonus = moment(startTimeBonus).month();
        let startDayBonus = moment(startTimeBonus).day();
        let endYearBonus = moment(endTimeBonus).year();
        let endMonthBonus = moment(endTimeBonus).month();
        let endDayBonus = moment(endTimeBonus).day();
        let bonusDays = endTimeBonus.diff(startTimeBonus, 'days');
        let dayMonth = endTimeBonus.format('D');

        if (bonusDays >= 0) {
            typeBonus = $("#type_bonus").val();
            if (typeBonus == "salary") {
                fortnight = $("#fortnight").val();
                if (fortnight == 'first') {
                    dataEmployee = document.getElementById('employee_id').value.split('_');
                    empId = dataEmployee[0];
                    getBonusValue(empId, dayMonth);
                    /*
                    salary = $("#salary").val();
                    provisionBonus = $("#provision_bonus").val();
                    bonusProvision = $("#bonus_provisions").val();
                    daysBonusPro = $("#daysProBonus").val();

                    //bonusMonth = salary * dayMonth / 360;
                    bonus = parseFloat(provisionBonus) + parseFloat(bonusProvision);
                    bonusDays = parseInt(dayMonth) + parseInt(daysBonusPro);
                    $("#bonusDays").val(bonusDays);
                    $("#valueBonus").val(bonus.toFixed(2));*/
                } else {
                    dataEmployee = document.getElementById('employee_id').value.split('_');
                    empId = dataEmployee[0];
                    getBonusValue(empId, dayMonth);
                    /*
                    salary = $("#salary").val();
                    provisionBonus = $("#provision_bonus").val();
                    bonusProvision = $("#bonus_provision").val();
                    daysBonusPro = $("#daysProBonus").val();
                    //bonusMonth = salary * dayMonth / 360;
                    bonus = parseFloat(provisionBonus) + parseFloat(bonusProvision);
                    bonusDays = parseInt(dayMonth) + parseInt(daysBonusPro);
                    $("#bonusDays").val(bonusDays);
                    $("#valueBonus").val(bonus.toFixed(2));*/
                }
            } else {
                $("#bonusDays").val(bonusDays);
                $("#valueBonus").val("");
            }

        } else {
            Swal.fire("Fecha de Inicio no puede ser mayor a fecha de fin");
            window.location.reload()
        }

    }

    function getBonusValue(empId, dayMonth){
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

            provisionBonus = parseFloat(data.proBonus);
            bonusProvision = $("#bonus_provisions").val();
            daysBonusPro = $("#daysProBonus").val();

            //bonusMonth = salary * dayMonth / 360;
            bonus = parseFloat(provisionBonus) + parseFloat(bonusProvision);
            bonusDays = parseInt(dayMonth) + parseInt(daysBonusPro);
            $("#bonusDays").val(bonusDays);
            $("#valueBonus").val(bonus.toFixed(2));
        }).fail(function() {
            //
        }).always(function() {
            //alert("Siempre se ejecuta")
        });
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
            $("#bonus_adjustment").val(bonusAdjustment.toFixed(2));
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
