@push('scripts')
    <script>
        $(document).ready(function () {
            // Definición del campo asociado al certificado digital
            $('#file').fileinput({
                language: 'es',
                allowedFileExtensions: ['p12', 'pfx'],
                showUpload: false,
                showClose: false,
                initialPreviewAsData: true,
                initialPreviewFileType: 'icon',
                layoutTemplates: {
                    actionDelete: '',
                    actionDrag: ''
                },
                theme: "fas",
            });
        });
    </script>
@endpush
