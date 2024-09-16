<script>
    $(document).ready(function(){
        $("#refreshProvider").click(function(){
            $.ajax({
                url: "{{ route('refreshProvider') }}",
                method: 'GET',
                success: function(data) {
                    $('#provider_id').empty();
                    $.each(data, function(index, option) {
                        $('#provider_id').append(new Option(option.identification + ' - ' + option.name, option.id));
                    });
                    // Refrescar si utilizas un plugin
                    //$('#customer_id').selectpicker('refresh');
                }
            });

        });
    });
</script>
