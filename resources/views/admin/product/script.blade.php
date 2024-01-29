<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete colegio');
    });*/
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#category_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#measure_unit_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#type_product').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });

    //$(obtener_registro());
    function obtener_registro(code) {
        $.ajax({
            url: "{{ route('getProduct') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                code: code,
            }
        }).done(function(data) { // imprimimos la respuesta
            $("#name").val(data.name);
            $("#price").val(data.price);
            $("#sale_price").val(data.sale_price);
            $("#stock").val(data.stock);
            $("#stock_min").val(data.stock_min);
            $("#category_id").val(data.category_id);
            $("#measure_unit_id").val(data.measure_unit_id);
            $("#type_product").val(data.type_product);
            //productexits();
        }).fail(function() {
            //alert("Algo salió mal");
        }).always(function() {
            //alert("Siempre se ejecuta")
        });

    }
    function productexits() {
        prod = $("#name").val();
        if (prod != '') {
            //alert("Rellene todos los campos del detalle para esta compra");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Este producto ya existe --' + prod,
            })
            clean();
        }
    }
    $(document).on('keyup', '#code', function() {
        let barcodepurchase = $(("#switch_barcode")).prop("checked");
        if (barcodepurchase == true) {
            var codes = $(this).val();
            if (codes != "") {
                obtener_registro(codes);
            } else {
                console.log('no hay codigo');
            }
        }
    })

    function clean(){
        $("#name").val("");
        $("#code").val("");
    }
</script>
