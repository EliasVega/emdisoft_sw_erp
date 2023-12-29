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

    $(document).ready(function() {
        $('#image').fileinput({
            language: 'es',
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
            maxFileSize: 1000,
            showUpload: false,
            showClose: false,
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            layoutTemplates: {
                actionDelete: '',
                actionDrag: ''
            },
            theme: "fa5",
        });
    });
    /*
    $(document).ready(function() {

        let barcodestart = $(("#switch_barcode")).prop("checked"); // == true ? 1 : 0;
        if (barcodestart == true) {
            $("#addProductId").hide();
            $("#codeBarcode").show();
            $("#productBarcode").show();
        } else if (barcodestart == false) {
            $("#codeBarcode").hide();
            $("#productBarcode").hide();
            $("#addProductId").show();
        }
    });*/
    //seleccionar de acuerdo al producto
    /*
    $("#product_id").change(productValue);

    $("#switch_barcode").change(function() {

        let barcode = $(this).prop("checked"); // == true ? 1 : 0;
        if (barcode == true) {
            $("#codeBarcode").show();
            $("#addProductId").hide();
            $("#productBarcode").show();
        } else {
            $("#codeBarcode").hide();
            $("#productBarcode").hide();
            $("#addProductId").show();
        }
    })*/


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
            productexits();
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
        var codes = $(this).val();
        if (codes != "") {
            obtener_registro(codes);
        } else {
            console.log('no hay codigo');
        }
    })

    function clean(){
        $("#name").val("");
        $("#code").val("");
    }
</script>
