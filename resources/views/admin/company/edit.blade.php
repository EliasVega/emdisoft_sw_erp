@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box-danger">
                <div class="box-header with-border">
                    <h5 class="box-title">Editar Company:{{ $company->name }}</h5>
                    @can('company.index')
                        <a href="{{ route('company.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
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
    {!!Form::model($company, ['method'=>'PATCH', 'files' => 'true', 'route'=>['company.update', $company->id]])!!}
    {!!Form::token()!!}
    <div class="row m-1">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('admin/company.form')
        </div>
    </div>
    {!!Form::close()!!}
@endsection
@section('scripts')
    @include('admin/company.script')
@endsection


