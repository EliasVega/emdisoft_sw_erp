<div class="card card-outline card-info collapsed-card">
    <div class="card-header">
        <h3 class="card-title">
            Registrar cuenta
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                {!! Form::open(['method' => 'POST', 'route' => 'account.store', 'autocomplete' => 'off']) !!}
                {!! Form::token() !!}
                    @include('admin.account.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="card card-outline card-info collapsed-card">
    <div class="card-header">
        <h3 class="card-title">
            Registrar sub cuentas
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                {!! Form::open(['method' => 'POST', 'route' => 'subaccount.store', 'autocomplete' => 'off']) !!}
                {!! Form::token() !!}
                    @include('admin.subaccount.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="card card-outline card-info collapsed-card">
    <div class="card-header">
        <h3 class="card-title">
            Registrar cuenta auxiliar
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                {!! Form::open(['method' => 'POST', 'route' => 'auxiliaryAccount.store', 'autocomplete' => 'off']) !!}
                {!! Form::token() !!}
                    @include('admin.auxiliaryAccount.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
