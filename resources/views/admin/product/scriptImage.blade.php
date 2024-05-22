<script>
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
