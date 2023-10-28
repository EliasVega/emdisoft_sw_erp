@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h5 class="box-title">Cerrar Caja N°. : {{ $cashRegister->id }}</h5>
                @can('cashRegister.index')
                        <a href="{{ route('cashRegister.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
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
            {!!Form::model($cashRegister, ['method'=>'PATCH','route'=>['cashRegister.update', $cashRegister->id]])!!}
            {!!Form::token()!!}
                <div class="box-body row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="user_close_id">Autorizando Cierre sale_box</label>
                            <select name="user_close_id" class="form-control selectpicker" id="user_close_id"
                                data-live-search="true">
                                <option value="" disabled selected>Seleccionar....</option>
                                @foreach($users as $usa)
                                <option value="{{ $usa->id }}">{{ $usa->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group" id="valorcito">
                            <label class="form-control-label" for="verification_code_close">Codigo de verificacion</label>
                            <input type="password" id="verification_code_close" name="verification_code_close" value="" class="form-control"
                                placeholder="Codigo Verificacion">
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fas fa-lock"></i>&nbsp; Cerrar Caja</button>
                            <a href="{{ url('cashRegister') }}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i> Cancelar</a>
                        </div>
                    </div>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection
