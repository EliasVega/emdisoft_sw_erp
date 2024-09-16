<script>
    $(document).ready(function(){
        $("#refreshProduct").click(function(){
            $.ajax({
                url: "{{ route('refreshProduct') }}",
                method: 'GET',
                success: function(data) {
                    $('#product_id').empty();
                    $.each(data, function(index, option) {
                        $('#product_id').append(new Option(option.code + ' - ' + option.name, option.id));
                    });
                    // Refrescar si utilizas un plugin
                    //$('#customer_id').selectpicker('refresh');
                }
            });

        });
    });
</script>
