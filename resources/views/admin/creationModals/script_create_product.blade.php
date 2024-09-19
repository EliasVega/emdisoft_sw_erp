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

    document.getElementById('customerForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let type = $("#type").val();
        let code = $("#code").val();
        let name = $("#name_product").val();
        let price = $("#price").val();
        let sale_price = $("#sale_price").val();
        let commission = $("#commission").val();
        let stock = $("#stock").val();
        let stock_min = $("#stock_min").val();
        let type_product = $("#type_product").val();
        let status = $("#status").val();
        let imageName = $("#imageName").val();
        let image = $("#image").val();
        let category_id = $("#category_id").val();
        let measure_unit_id = $("#measure_unit_id").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('product.store')}}",
            type: "POST",
            data:{
                code:code,
                name:name,
                price:price,
                sale_price:sale_price,
                commission:commission,
                stock:stock,
                stock_min:stock_min,
                type_product:type_product,
                status:status,
                imageName:imageName,
                image:image,
                category_id:category_id,
                measure_unit_id:measure_unit_id,
                _token:_token
            },
            success:function(response)
            {
                if(response){
                    $('#productModal').modal('hide');
                    $.ajax({
                        url: "{{ route('refreshProducts') }}",
                        method: 'GET',
                        success: function(data) {
                            $('#product_id').empty();
                            $.each(data, function(index, option) {
                                $('#product_id').append(new Option(option.identification + ' - ' + option.name, option.id));
                            });
                            // Refrescar si utilizas un plugin
                            //$('#customer_id').selectpicker('refresh');
                        }
                    });
                }else{
                    alert("error en la creacion del Producto");
                }
            }
        });
    });
</script>
