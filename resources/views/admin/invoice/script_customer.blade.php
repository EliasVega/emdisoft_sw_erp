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

    $("#identification_type_id").change(handleIdentificationTypeChange);

    function handleIdentificationTypeChange() {
        let identificationTypeId = $("#identification_type_id").val();
        if (identificationTypeId === '3' || identificationTypeId === '6') {
            $("#dv").prop('readonly', true);
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
        /*
        $.ajax({
            url: "{{ route('getCommissions') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                : empId,
            }
        }).done(function(data){ // imprimimos la respuesta
            $("#valueCommission").val(data);
        }).fail(function() {
            //alert("algo fallo")
        }).always(function() {
            //alert("Siempre se ejecuta")
        });*/

        let form = e.target;
        alert(form);
        let formData = new FormData(form);

        fetch("{{ route('storeCustomer') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                data: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data)
                if (data.success) {
                    // Cerrar el modal
                    let modal = bootstrap.Modal.getInstance(document.getElementById('customerModal'));
                    modal.hide();

                    // Resetear el formulario
                    form.reset();

                    // Aquí puedes añadir código para actualizar la lista de artículos en la página si es necesario
                    alert(data.message);
                } else {
                    alert('Hubo un problema al crear el cliente.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('no hay data.');
            });
    });
</script>
