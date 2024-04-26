<script>

    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/

    let subtotalCommission = [];
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
            subtotalCommission[contCommission] = valueCommission;
            totalCommission = totalCommission + parseFloat(subtotalCommission[contCommission]);

            var rowCommission = '<tr class="selected" id="rowCommission' + contCommission +
                '"><td><button type="button" class="btn btn-danger btn-sm btndelete"onclick="deleterowCommission(' +
                contCommission +
                ');"><i class="fas fa-trash"></i></button></td><td><input type="hidden" name="type_commission[]"  value="' +
                typeCommission_id + '">' + typeCommission + '</td><td>$' + Math.round(subtotalCommission[contCommission]) + ' </td></tr>';

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
        totalCommission = parseFloat(totalCommission) - parseFloat(subtotalCommission[index]);
        $("#total_commissions_html").html("$ " + Math.round(totalCommission));
        $("#total_commissions").val(Math.round(totalCommission));

        totalAcrued = $("#total_acrued").val();
        totalAcrued = parseFloat(totalAcrued) - parseFloat(subtotalCommission[index]);
        $("#total_acrued").val(totalAcrued);

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
