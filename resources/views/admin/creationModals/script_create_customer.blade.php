<script>
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#department_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#municipality_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#liability_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#organization_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#regime_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#identification_type_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    $("#department_id").change(function(event) {
        $.get("create/" + event.target.value + "", function(response) {
            $("#municipality_id").empty();
            $("#municipality_id").append(
                "<option value = '#' disabled selected>Seleccionar ...</option>");
            for (i = 0; i < response.length; i++) {
                $("#municipality_id").append("<option value = '" + response[i].id + "'>" + response[i]
                    .name + "</option>");
            }
            //$("#municipality_id").selectpicker('refresh');
        });
    });

    $("#addType").hide();
    $("#addStatus").hide();

    $("#identification_type_id").change(handleIdentificationTypeChange);

    function handleIdentificationTypeChange() {
        let identificationTypeId = $("#identification_type_id").val();
        if (identificationTypeId === '3' || identificationTypeId === '6') {
            $("#dv").prop('readonly', false);
            handleIdentificationChange();
        } else {
            $("#dv").prop('readonly', false);
        }
    }

    $("#identification").keyup(handleIdentificationChange);

    function handleIdentificationChange() {
        let identification = $("#identification").val();
        let identificationTypeId = $("#identification_type_id").val();
        let verificationDigit = $("#dv");

        let isIdentificationValid = identification >>> 0 === parseFloat(identification) ? true : false;

        // Si es un número se calcula el Dígito de Verificación
        if (isIdentificationValid && (identificationTypeId == '3' || identificationTypeId == '6')) {
            verificationDigit.val(calculateVerficationDigit(identification));
        } else {
            verificationDigit.val("0");
        }
    }

    function calculateVerficationDigit(identification) {
        var vpri, x, y, z;

        identification = identification.replace(/\s/g, ""); // Espacios
        identification = identification.replace(/,/g, ""); // Comas
        identification = identification.replace(/\./g, ""); // Puntos
        identification = identification.replace(/-/g, ""); // Guiones

        // Procedimiento
        vpri = new Array(16);
        z = identification.length;
        
        vpri[1] = 3;
        vpri[2] = 7;
        vpri[3] = 13;
        vpri[4] = 17;
        vpri[5] = 19;
        vpri[6] = 23;
        vpri[7] = 29;
        vpri[8] = 37;
        vpri[9] = 41;
        vpri[10] = 43;
        vpri[11] = 47;
        vpri[12] = 53;
        vpri[13] = 59;
        vpri[14] = 67;
        vpri[15] = 71;

        x = 0;
        y = 0;
        for (var i = 0; i < z; i++) {
            y = (identification.substr(i, 1));

            x += (y * vpri[z - i]);
        }

        y = x % 11;

        return (y > 1) ? 11 - y : y;
    }

    document.getElementById('customerForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let type = $("#type").val();
        let name = $("#name").val();
        let identification = $("#identification").val();
        let dv = $("#dv").val();
        let address = $("#address").val();
        let phone = $("#phone").val();
        let email = $("#email").val();
        let merchant_registration = $("#merchant_registration").val();
        let credit_limit = 0;
        let used = 0;
        let available = 0;
        let status = 'active';
        let department_id = $("#department_id").val();
        let municipality_id = $("#municipality_id").val();
        let identification_type_id = $("#identification_type_id").val();
        let liability_id = $("#liability_id").val();
        let organization_id = $("#organization_id").val();
        let regime_id = $("#regime_id").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('customer.store')}}",
            type: "POST",
            data:{
                type:type,
                name:name,
                identification:identification,
                dv:dv,
                address:address,
                phone:phone,
                email:email,
                merchant_registration:merchant_registration,
                credit_limit:credit_limit,
                used:used,
                available:available,
                status:status,
                department_id:department_id,
                municipality_id:municipality_id,
                identification_type_id:identification_type_id,
                liability_id:liability_id,
                organization_id:organization_id,
                regime_id:regime_id,
                _token:_token
            },
            success:function(response)
            {
                if(response){
                    $('#customerModal').modal('hide');
                    $.ajax({
                        url: "{{ route('refreshCustomers') }}",
                        method: 'GET',
                        success: function(data) {
                            $('#customer_id').empty();
                            $.each(data, function(index, option) {
                                $('#customer_id').append(new Option(option.identification + ' - ' + option.name, option.id));
                            });
                            // Refrescar si utilizas un plugin
                            //$('#customer_id').selectpicker('refresh');
                        }
                    });
                }else{
                    alert("error en la creacion del cliente");
                }
            }
        });
    });
</script>
