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
            $('#type_productpm').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    $("#addRmaterial").hide();
    $("#addTypePro").hide();
    $("#addStatusPro").hide();
    $("#commpm").hide();

    $("#type_productpm").change(rmshow);

    function rmshow() {
        typeProduct = $("#type_productpm").val();
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
            $("#name_product").val(data.name);
            $("#pricepm").val(data.price);
            $("#sale_pricepm").val(data.sale_price);
            $("#stockpm").val(data.stock);
            $("#stock_minpm").val(data.stock_min);
        }).fail(function() {
            cleanprod();
        }).always(function() {
            //alert("Siempre se ejecuta")
        });

    }
    $(document).on('keyup', '#codepm', function() {
        let barcodepurchase = $(("#switch_barcodepm")).prop("checked");
        if (barcodepurchase == true) {
            cleanprod();
            var codes = $(this).val();
            if (codes != "") {
                obtener_registro(codes);
            } else {
                console.log('no hay codigo');
            }
        }
    })
    function cleanprod(){
        $("#name_product").val('');
        $("#pricepm").val('0.00');
        $("#sale_pricepm").val('0.00');
        $("#stockpm").val('0.00');
        $("#stock_minpm").val('0.00');
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

    document.getElementById('productForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let type = $("#typepm").val();
        let code = $("#codepm").val();
        let name = $("#name_product").val();
        let price = $("#pricepm").val();
        let sale_price = $("#sale_pricepm").val();
        let commission = 0;
        let stock = $("#stockpm").val();
        let stock_min = $("#stock_minpm").val();
        let type_product = $("#type_productpm").val();
        let status = $("#statuspm").val();
        let imageName = null;
        let image = null;
        let category_id = $("#category_id").val();
        let measure_unit_id = $("#measure_unit_id").val();
        let _token = $("input[name=_token]").val();
        
        $.ajax({
            url: "{{route('productStore')}}",
            type: "POST",
            accept: "application/json",
            data:{
                type:type,
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
                    $('#prodModal').modal('hide');
                    $.ajax({
                        url: "{{ route('refreshProducts') }}",
                        method: 'GET',
                        success: function(data) {
                            $('#product_id').empty();
                            $.each(data, function(index, option) {
                                $('#product_id').append(new Option(option.code + ' - ' + option.name, option.id + '_' + option.stock + '_' + option.sale_price + '_' + option.percentage + '_' + option.tt + '_' + option.utility_rate));
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
