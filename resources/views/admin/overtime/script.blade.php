<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete colegio');
        });*/
    /*
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#employee_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#overtime_type_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });*/
    var cont = 0;
    total = 0;
    var startTime = '';
    var endTime = '';
    //form purchase
    $("#save").hide();

    function ValidarFechas() {
        var fechainicial = document.getElementById("start_time").value;
        var fechafinal = document.getElementById("end_time").value;

        if (Date.parse(fechafinal) < Date.parse(fechainicial)) {
            alert("La fecha final debe ser mayor a la fecha inicial");
        } else {
            alert("La fecha esta correcta");
        }
    }

    //seleccionar de acuerdo al producto
    $("#overtime_type_id").change(overtimeTypeValue);

    function overtimeTypeValue() {

        dataOvertimeType = document.getElementById('overtime_type_id').value.split('_');
        $("#percentage").val(dataOvertimeType[1]);

    }
    $(document).ready(function() {

        $("#add").click(function() {
            add();
        });
    });

    //adicionar productos a la compra
    function add() {

        var startTime = document.getElementById("start_time").value;
        var endTime = document.getElementById("end_time").value;

        dataOvertimeType = document.getElementById('overtime_type_id').value.split('_');
        overtime_type_id = dataOvertimeType[0];
        overtimeType = $("#overtime_type_id option:selected").text();

        //inicio = new Date($("#start_time").val());
        //fin = new Date($("#end_time").val());

        validate()

        quantity = $("#quantityadd").val();
        price = $("#price").val();


        if (Date.parse(startTime) < Date.parse(endTime)) {
            if (overtime_type_id != "") {
                subtotal[cont] = parseFloat(quantity) * parseFloat(price);
                total = total + subtotal[cont];

                var row = '<tr class="selected" id="row' + cont +
                    '"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow(' + cont +
                    ');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow(' +
                    cont +
                    ');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="overtime_type_id[]"  value="' +
                    overtime_type_id + '">' + overtime_type_id +
                    '</td><td><input type="hidden" name="overtime_tipe[]" value="' + overtimeType + '">' +
                    overtimeType + '</td>   <td><input type="hidden" name="quantity[]" value="' + quantity + '">' +
                    quantity + '</td> <td><input type="hidden" name="price[]"  value="' + price + '">' + price +
                    '</td> <td><input type="hidden" name="percentage[]"  value="' + percentage + '">' + percentage +
                    '</td><td>$' + subtotal[cont] + ' </td></tr>';
                cont++;
                totals();
                assess();
                $('#overtimes').append(row);
                //$('#product_id option:selected').remove();
                clean();


            } else {
                //alert("Rellene todos los campos del detalle para esta compra");
                Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'Rellene todos los campos del detalle para esta compra',
                })
            }
        } else {
            Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'fecha final debe ser mayor a fecha inicial',
            })
        }

    }

    function validate() {
        var startTime = document.getElementById("start_time").value;
        var endTime = document.getElementById("end_time").value;
        var startHour = startTime.substring(11);
        var endHour =  endTime.substring(11);

        if (overtime_type_id == 1 || overtime_type_id == 4 || overtime_type_id == 5) {
            if (startHour >= '21:00' && startHour <= '06:00' && endTime >= '21:00' && endTime <= '06:00') {
                start = new Date($("#start_time").val());
                end = new Date($("#end_time").val());
                alert(start);
                alert(12 % 5);
                diff1 = end - start;
                diff2 = diff1 / 100;
                diff = diff2 % 3600;
                alert(diff1);
                alert(12 % 5);
                return true;
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'tienes error en las horas para este item',
                })
            }
        } else {

        }
        if (startHour >= '15:00' && startHour <= '22:00') {
            console.log('Hora Correcta');
            return true;
        } else {
            console.log('Hora Incorrecta');
            return false;
        }
    }

    function clean() {
        $("#overtime_type_id").val("");
        $("#start_time").val("");
        $("#end_time").val("");
    }

    function totals() {

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));
    }

    function assess() {
        if (total > 0) {
            $("#save").show();
        } else {
            $("#save").hide();
        }
    }

    function eliminar(index) {

        total = total - pay[index];

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#row" + index).remove();
        assess();
    }
</script>
