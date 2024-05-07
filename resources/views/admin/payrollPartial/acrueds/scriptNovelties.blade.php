<script>

    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/

    let valueNovelties = [];
    let typeNoveltyArray = [];
    let contNovelty = 0;
    let totalNovelty = 0;

    $("#addTypeCompensation").hide();

    $("#novelty").change(compensationType);
    function compensationType() {
        novelty = $("#novelty").val();
        if (novelty == "compensations") {
            $("#addTypeCompensation").show();
        } else {
            $("#addTypeCompensation").hide();
        }
    }

    $(document).ready(function() {

        $("#add_novelty").click(function() {
            addNovelty();
        });
    });

    //adicionar productos a la compra
    function addNovelty() {

        typeNovelty_id = $("#typeNovelty").val();
        typeNovelty = $("#typeNovelty option:selected").text();
        novelty_id = $("#novelty").val();
        nameNovelty = $("#novelty option:selected").text();
        valueNovelty = $("#valueNovelty").val();
        if (novelty == "compensations") {
            typeCompensation_id = $("#typeCompensation").val();
            typeCompensation = $("#typeCompensation option:selected").text();
        } else {
            typeCompensation_id = "not-apply";
            typeCompensation = "No aplica";
        }

        if (typeNovelty_id != "" && novelty != "" && valueNovelty > 0) {

            typeNoveltyArray[contNovelty] = typeNovelty_id;
            valueNovelties[contNovelty] = valueNovelty;
            totalNovelty = totalNovelty + parseFloat(valueNovelty);

            if (typeNovelty == 'salary') {

            }

            if (typeNovelty == 'salary') {
                salaryBase = $("#base_salary").val();
                salaryBase += parseFloat(valueCommission);
                $("#base_salary").val(salaryBase);
            }

            var rowNovelty = '<tr class="selected" id="rowNovelty' + contNovelty +
                '"><td><button type="button" class="btn btn-danger btn-sm btndelete"onclick="deleterowNovelty(' +
                contNovelty +
                ');"><i class="fas fa-trash"></i></button></td><td><input type="hidden" name="type_novelty[]"  value="' +
                typeNovelty_id + '">' + typeNovelty + '</td><td><input type="hidden" name="novelty[]"  value="' +
                novelty_id + '">' + nameNovelty + '</td><td><input type="hidden" name="type_compensation[]"  value="' +
                typeCompensation_id + '">' + typeCompensation + '</td><td><input type="hidden" name="value_novelty[]"  value="' +
                valueNovelty + '">' + valueNovelty + '</td></tr>';

            contNovelty++;

            //addNoveltyTotals();
            totalNovelties(valueNovelty);
            $('#novelties').append(rowNovelty);
            cleanNovelty();


        } else {
            //alert("Rellene todos los campos del detalle para esta compra");
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Datos faltantes o incorrectos para asignar hora extra',
            });
        }
    }

    function cleanNovelty() {
        $("#valueNovelty").val(0);
    }

    function totalNovelties(totalNovelty) {
        $("#total_novelties_html").html("$ " + Math.round(totalNovelty));
        $("#total_novelties").val(Math.round(totalNovelty));

        totalAcrued = $("#total_acrued").val();
        totalAcrued = parseFloat(totalAcrued) + parseFloat(valueNovelty);
        $("#total_acrued").val(totalAcrued);

    }

    function deleterowNovelty(index) {
        totalNovelty = parseFloat(totalNovelty) - parseFloat(valueNovelties[index]);
        $("#total_novelties_html").html("$ " + Math.round(totalNovelty));
        $("#total_novelties").val(Math.round(totalNovelty));

        totalAcrued = $("#total_acrued").val();
        totalAcrued = parseFloat(totalAcrued) - parseFloat(valueNovelties[index]);
        $("#total_acrued").val(totalAcrued);

        if (typeNoveltyArray[index] == 'salary') {
            salaryBase = $("#base_salary").val();
            salaryBase -= parseFloat(valueNovelties[index]);
            $("#base_salary").val(salaryBase);
        }

        $("#rowNovelty" + index).remove();
    }
</script>
