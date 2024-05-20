@extends('layouts.admin')
@section('title')
    PUC |
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            PUC
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row pb-2">
                            <div class="col-12">
                                <input type="input" class="form-control" id="search" placeholder="Buscar">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div id="puc"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            Opciones de cuenta
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                {!! Form::open(['method' => 'POST', 'route' => 'puc.store', 'id' => 'multi_action_form', 'autocomplete' => 'off']) !!}
                                {!! Form::token() !!}
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    @include('admin/puc.form')
                                    @include('admin/puc.formButtons')
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.puc.delete_account')
    @include('admin.puc.enable_account')
    @include('admin.puc.disable_account')
@endsection
@section('scripts')
    @include('admin/puc.script')
@endsection
