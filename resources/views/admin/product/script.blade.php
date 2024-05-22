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
    $("#addRmaterial").hide();

    $("#type_product").change(rmshow);

    function rmshow() {
        typeProduct = $("#type_product").val();
        if (typeProduct == 'consumer') {
            $("#addRmaterial").show();
        } else {
            $("#addRmaterial").hide();
        }
    }

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
        }).fail(function() {
            clean();
        }).always(function() {
            //alert("Siempre se ejecuta")
        });

    }
    $(document).on('keyup', '#code', function() {
        let barcodepurchase = $(("#switch_barcode")).prop("checked");
        if (barcodepurchase == true) {
            clean();
            var codes = $(this).val();
            if (codes != "") {
                obtener_registro(codes);
            } else {
                console.log('no hay codigo');
            }
        }
    })

    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
        }
      }))
    });
    function clean(){
        $("#name").val('');
        $("#price").val('0.00');
        $("#sale_price").val('0.00');
        $("#stock").val('0.00');
        $("#stock_min").val('0.00');
    }
    $(document).ready(function () {
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
</script>
