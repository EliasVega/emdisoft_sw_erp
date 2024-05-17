@extends('layouts.admin')
@section('title')
    Control contable |
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Listado de cuentas activas
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-12 col-md-6">
                                    <a href="{{ route('puc.create') }}" class="btn btn-success d-block d-md-inline-block mb-3 mb-md-0" >
                                        Registrar PUC
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed w-100" id="pucs">
                                    <thead class="bg-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Código de cuenta</th>
                                        <th>Nombre de cuenta</th>
                                        <th>Activador</th>
                                        <th>Tipo</th>
                                        <th>Banco</th>
                                        <th>Cuenta bancaria</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.Main content -->
    @push('scripts')
        <script>
            $(document).ready(function () {
                var table = $('#pucs').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('puc.index') }}',
                    order: [[ 0, "desc" ]],
                    columns: [
                        { data: 'id' },
                        { data: 'account_code' },
                        { data: 'account_name' },
                        { data: 'trigger' },
                        { data: 'type' },
                        { data: 'bank' },
                        { data: 'bank_account' },
                        { data: 'actions' },
                    ],
                    dom: 'lBfrtip',
                    buttons: [
                        {
                            extend: 'copy',
                            exportOptions: {
                                columns: [ 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [ 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: [ 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [ 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                    ],
                });
                setInterval(function () {
                    table.ajax.reload();
                }, 300000);
            });
        </script>
    @endpush
@endsection
