@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box-danger">
                <div class="box-header with-border">
                    <h5 class="box-title">Editar Materia Prima:  {{ $rawMaterial->name }}</h5>
                    @can('rawMaterial.index')
                        <a href="{{ route('rawMaterial.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                    @endcan
                    @can('branch.index')
                        <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                    @endcan
                </div>
                @if (count($errors)>0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {!!Form::model($rawMaterial, ['method'=>'PATCH', 'files' => 'true', 'route'=>['rawMaterial.update', $rawMaterial->id]])!!}
    {!!Form::token()!!}
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('admin/rawMaterial.form')
        </div>
    {!!Form::close()!!}
@endsection
@section('scripts')
    @include('admin/rawMaterial.script')
@endsection
