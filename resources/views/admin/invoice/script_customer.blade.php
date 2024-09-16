<script>
    document.getElementById('customerForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let form = e.target;
        let formData = new FormData(form);

        fetch("{{ route('storeCustomer') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cerrar el modal
                    let modal = bootstrap.Modal.getInstance(document.getElementById('customerModal'));
                    modal.hide();

                    // Resetear el formulario
                    form.reset();

                    // Aquí puedes añadir código para actualizar la lista de artículos en la página si es necesario
                    alert(data.message);
                    $.ajax({
                        url: "{{ route('refreshCustomers') }}",
                        method: 'GET',
                        success: function(data) {
                            $('#customer_id').empty();
                            $.each(data, function(index, option) {
                                $('#customer_id').append(new Option(option
                                    .identification + ' - ' + option.name,
                                    option.id));
                            });
                            // Refrescar si utilizas un plugin
                            //$('#customer_id').selectpicker('refresh');
                        }
                    });
                } else {
                    alert('no encontre nada.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Nohay data.');
            });
    });
</script>
