<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#employee_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    //form invoice
    //$("#idPro").hide();

    //seleccionar de acuerdo al producto
    $("#employee_id").change(employeeValue);

    function employeeValue(){
        dataEmployee = document.getElementById('employee_id').value.split('_');
        $("#commission").val(dataEmployee[1]);
        changeCommission();
    }
    function changeCommission() {
        percentageCommission = $("#commission").val();
        subtotalOld = $("#subtotalOld").val();
        valueCommission = parseFloat(percentageCommission) * parseFloat(subtotalOld) / 100;
        $("#value_commission").val(valueCommission);
    }
</script>
