<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/
    let subtotalBonus = [];
    let contBonus = 0;
    let totalBonus = 0;
    $('#endBonuss').prop("readonly", true);

    $("#startBonus").change(activeEndBonus);

    function activeEndBonus(){
        $('#endBonus').prop("readonly", false)
    }

    $("#endBonus").change(timeBonus);

    function timeBonus(){
        startDate = $("#start_date").val();
        endDate = $("#end_date").val();
        startTime = moment(startDate);
        endTime = moment(endDate);

        startYear = moment(startTime).year();
        startMonth = moment(startTime).month();
        endYear = moment(endTime).year();
        endMonth = moment(endTime).month();

        let startBonus = $("#startBonus").val();
        let endBonus = $("#endBonus").val();
        let startTimeBonus = moment(startBonus);
        let endTimeBonus = moment(endBonus);

        let startYearBonus = moment(startTimeBonus).year();
        let startMonthBonus = moment(startTimeBonus).month();
        let startDayBonus = moment(startTimeBonus).day();
        let endYearBonus = moment(endTimeBonus).year();
        let endMonthBonus = moment(endTimeBonus).month();
        let endDayBonus = moment(endTimeBonus).day();
        let vacationDays = endTimeBonus.diff(startTimeBonus, 'days');
        if (vacationDays >= 0) {
            if (startYearBonus == endYearBonus && startMonthBonus == endMonthBonus
            && startYear == startYearBonus && startMonth == startMonthBonus) {
                $("#vacationDays").val(vacationDays + 1);
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'las fechas no crresponden al mismo periodo de nomina',
                    showConfirmButton: false,
                    timer: 2000 // es ms (mili-segundos)

                });
                cleanBonus();
                //window.location.reload()
            }
        } else {
            Swal.fire("Fecha de Inicio no puede ser mayor a fecha de fin");
            window.location.reload()
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
        type_id = $("#typeBonus").val();
        type = $("#typeBonus option:selected").text();
        quantity = $("#vacationDays").val();
        salaryEmployee = $("#salary").val();
        value_day = salaryEmployee/30;
        if (Date.parse(startBonus) <= Date.parse(endBonus)) {
            if (type_id != "" && type != "" && quantity > 0 && value_day > 0) {
                subtotalBonus[contBonus] = parseFloat(quantity) * parseFloat(value_day);
                totalBonus = totalBonus + subtotalBonus[contBonus];
                var rowBonus = '<tr class="selected" id="rowBonus'+contBonus+'"><td><button type="button" class="btn btn-danger btn-sm btndelete"onclick="deleterowBonus('+contBonus+');"><i class="fas fa-trash"></i></button></td><td><input type="hidden" name="vacation_type[]"  value="'+type_id+'">'+type+'</td><td><input type="hidden" name="start_bonus[]" value="'+startBonus+'">'+startBonus+'</td><td><input type="hidden" name="end_bonus[]" value="'+endBonus+'">'+endBonus+'</td> <td><input type="hidden" name="vacation_days[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="value_day[]"  value="'+value_day+'">'+value_day.toFixed(2)+'</td> <td>$'+subtotalBonus[contBonus].toFixed(2)+'</td></tr>';
                contBonus++;
                totalVac();
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

    function totalVac() {

        $("#total_bonus_html").html("$ " + totalBonus.toFixed(2));
        $("#total_bonus").val(totalBonus.toFixed(2));

        tp = $("#total_acrued").val();
        tpnew = parseFloat(tp) + parseFloat(totalBonus);
        $("#total_acrued").val(tpnew.toFixed(2));
    }

    function deleterowBonus(index) {

        totalBonus -= subtotalBonus[index];

        $("#total_bonus_html").html("$ " + totalBonus.toFixed(2));
        $("#total_bonus").val(totalBonus.toFixed(2));

        $("#rowBonus" + index).remove();
    }
</script>
