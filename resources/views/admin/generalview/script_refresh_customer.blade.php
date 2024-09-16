<script>
    $(document).ready(function(){
        $("#refreshCustomer").click(function(){
            $.ajax({
                url: "{{ route('refreshCustomer') }}",
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

        });
    });
</script>
