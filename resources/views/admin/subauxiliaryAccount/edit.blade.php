@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h5 class="box-title">Editar Cuenta Auxiliar: {{ $subauxiliaryAccount->name }}</h5>
                    <a href="{{ route('subauxiliaryAccount.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
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
            {!!Form::model($subauxiliaryAccount, ['method'=>'PATCH','route'=>['subauxiliaryAccount.update', $subauxiliaryAccount->id]])!!}
            {!!Form::token()!!}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('admin/subauxiliaryAccount.form')
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection
