@push('scripts')
    <script>
        $("#editCompany").hide();
        $("#editLogo").hide();
        $(document).ready(function () {
            $('#logo').fileinput({
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

        $("#rolUser").hide();

        $(document).ready(function(){
        userRol = $("#userRole").val();
        if (userRol == 'admin') {
            $('#nit').prop("readonly", true);
            $('#dv').prop("readonly", true);
            $('#api_token').prop("readonly", true);

        } else {
            $('#nit').prop("readonly", false);
            $('#dv').prop("readonly", false);
            $('#api_token').prop("readonly", false);

        }
    });
    </script>
@endpush
