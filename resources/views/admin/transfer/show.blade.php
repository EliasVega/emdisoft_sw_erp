@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="box-header with-border">
            <h5 class="box-title">Detalle traslado
                @can('transfer.index')
                    <a href="{{ route('transfer.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                @endcan
                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">SEDE ORIGEN</label>
                <h4>{{ $transfer->originBranch->name }}</h4>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">SEDE DESTINO</label>
                <h4>{{ $transfer->branch->name }}</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">FECHA</label>
                <h4>{{ $transfer->created_at }}</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">RESPONSABLE</label>
                <h4>{{ $transfer->user->name }}</h4>
            </div>
        </div>
    </div><br>
    <div class="box-body row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>ID</th>
                                <th>Trasl. ID</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                            @foreach($productBranches as $productBranch)
                                <tr>
                                    <td>{{ $productBranch->id }}</td>
                                    <td>{{ $productBranch->transfer->id }}</td>
                                    <td>{{ $productBranch->product->name }}</td>
                                    <td>{{ $productBranch->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
