<script>

    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/

    let valueCommissionArray = [];
    let typeCommissionArray = [];
    let contCommission = 0;
    let totalCommission = 0;

    function addWorkLabor() {
        if ($("#workLabor").val() == "on") {
            dataEmployee = document.getElementById('employee_id').value.split('_');
            empId = dataEmployee[0];
            getCommissions(empId);
        }
    }

    $(document).ready(function() {

        $("#add_commission").click(function() {
            addCommission();
        });
    });

    //adicionar productos a la compra
    function addCommission() {

        typeCommission_id = $("#typeCommission").val();
        typeCommission = $("#typeCommission option:selected").text();
        valueCommission = $("#valueCommission").val();
        if (typeCommission_id != "" && valueCommission > 0) {

            typeCommissionArray[contCommission] = typeCommission_id;
            valueCommissionArray[contCommission] = valueCommission;
            totalCommission = totalCommission + parseFloat(valueCommission);

            if (typeCommission_id == 'salary') {
                salaryBase = $("#base_salary").val();
                salaryBase = parseFloat(salaryBase) + parseFloat(valueCommission);
                $("#base_salary").val(salaryBase);
            }

            var rowCommission = '<tr class="selected" id="rowCommission' + contCommission +
                '"><td><button type="button" class="btn btn-danger btn-sm btndelete"onclick="deleterowCommission(' +
                contCommission +
                ');"><i class="fas fa-trash"></i></button></td><td><input type="hidden" name="type_commission[]"  value="' +
                typeCommission_id + '">' + typeCommission + '</td><td><input type="hidden" name="value_commission[]"  value="' +
                valueCommission + '">' + valueCommission + '</td></tr>';

            contCommission++;

            //addCommissionTotals();
            totalCommissions(valueCommission);
            $('#commissions').append(rowCommission);
            cleanCommission();


        } else {
            //alert("Rellene todos los campos del detalle para esta compra");
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Datos faltantes o incorrectos para asignar hora extra',
            });
        }
    }

    function cleanCommission() {
        $("#valueCommission").val(0);
    }

    function totalCommissions(totalCommission) {
        $("#total_commissions_html").html("$ " + Math.round(totalCommission));
        $("#total_commissions").val(Math.round(totalCommission));

        totalAcrued = $("#total_acrued").val();
        totalAcrued = parseFloat(totalAcrued) + parseFloat(valueCommission);
        $("#total_acrued").val(totalAcrued);

    }

    function deleterowCommission(index) {
        totalCommission = parseFloat(totalCommission) - parseFloat(valueCommissionArray[index]);
        $("#total_commissions_html").html("$ " + Math.round(totalCommission));
        $("#total_commissions").val(Math.round(totalCommission));

        totalAcrued = $("#total_acrued").val();
        totalAcrued = parseFloat(totalAcrued) - parseFloat(valueCommissionArray[index]);
        $("#total_acrued").val(totalAcrued);

        if (typeCommissionArray[index] == 'salary') {
            salaryBase = $("#base_salary").val();
            salaryBase = parseFloat(salaryBase) - parseFloat(valueCommissionArray[index]);
            $("#base_salary").val(salaryBase);
        }

        $("#rowCommission" + index).remove();
    }

    function getCommissions(empId){
        $.ajax({
            url: "{{ route('getCommissions') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                employee_id: empId,
            }
        }).done(function(data){ // imprimimos la respuesta
            $("#valueCommission").val(data);
        }).fail(function() {
            //alert("algo fallo")
        }).always(function() {
            //alert("Siempre se ejecuta")
        });
    }
</script>
