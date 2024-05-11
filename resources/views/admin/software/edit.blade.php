@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!!Form::model($software, ['method'=>'PATCH','route'=>['software.update', $software->id, 'autocomplete' => 'off', 'files' => true]])!!}
            {!!Form::token()!!}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @if ($typeSoftware == 'invoice')
                        @include('admin/software.formInvoiceSw')
                    @elseif ($typeSoftware == 'payroll')
                        @include('admin/software.formPayrollSw')
                    @else
                        @include('admin/software.formEquiDocSw')
                    @endif

                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection
@section('scripts')
    @include('admin/software.script')
@endsection
