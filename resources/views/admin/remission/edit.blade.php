@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box-danger">
                <div class="box-header with-border">
                    <h5 class="box-title">Editar Remision:{{ $remission->id }}
                        <a href="{{ route('remission.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                        @can('branch.index')
                            <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                        @endcan
                    </h5>
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
    {!!Form::model($remission, ['method'=>'PATCH','route'=>['remission.update', $remission->id]])!!}
    {!!Form::token()!!}
    <div class="row m-1">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('admin/remission.form_remission')
            @include('admin/remission.form_edit')
            @include('admin/remission.form_register')
        </div>
    </div>
    {!!Form::close()!!}
    <!--Inicio del modal cliente-->
    @include('admin/remission.editmodal')
    @include('admin/remission.modal_pay_pos')
<!--Fin del modal-->
@endsection
@section('scripts')

    @if ($type == 'remissionPos')
        @include('admin/remission.script_paypos')
        @include('admin/remission.script_pos')
    @else
        @include('admin/generalview.script_pay')
        @include('admin/remission.script')
        @include('admin/remission.script_edit')
    @endif
@endsection
