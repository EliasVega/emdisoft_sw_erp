@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box-danger">
                <div class="box-header with-border">
                    <h5 class="box-title">Editar Comanda: #{{ $restaurantOrder->id }}
                        <a href="{{ route('restaurantOrder.index') }}" class="btn btn-bluR btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                        @can('branch.index')
                            <a href="{{ route('branch.index') }}" class="btn btn-redeco btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
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
    {!!Form::model($restaurantOrder, ['method'=>'PATCH','route'=>['restaurantOrder.update', $restaurantOrder->id]])!!}
    {!!Form::token()!!}
        <div class="row m-1">
            @if ($service == 1)
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('admin/restaurantOrder.form_edit')
                </div>
            @else
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    @include('admin/restaurantOrder.form_table')
                </div>

                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    @include('admin/restaurantOrder.form_edit')
                </div>
            @endif
        </div>
    {!!Form::close()!!}
    @include('admin/restaurantOrder.editmodal')
@endsection
@section('scripts')
    @include('admin/restaurantOrder.script_edit')
@endsection
