
@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<div class="box-body row">
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <div class="row m-3">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <b>Salario Minimo:</b>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <p>$ {{  number_format($indicators->smlv,2) }}</p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <b>Aux. transporte:</b>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <p>$ {{  number_format($indicators->transport_assistance,2) }}</p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <b>Horas Semanales:</b>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <p>{{  $indicators->weekly_hours }} Horas</p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <b>UVT</b>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <p>$ {{  number_format($indicators->uvt,2) }}</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <b>Imp. Bolsas</b>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <p>$ {{  number_format($indicators->plastic_bag_tax,2) }}</p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-3">
                    @can('indicator.edit')
                        <a href="{{ route('indicator.edit', $indicators->id) }}" class="btn btn-warning btn-md"
                        data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"> EDITAR</i></a>
                    @endcan
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <div class="row m-3">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @can('indicator.dianStatus')
                        @if ($indicators->dian == 'on')
                            <a href="{{ route('dianStatus', $indicators->id) }}" class="btn btn-success btn-md"
                            data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit"> DIAN</i></a>
                        @else
                            <a href="{{ route('dianStatus', $indicators->id) }}" class="btn btn-danger btn-md" data-toggle="tooltip"
                            data-placement="top" title="Inactiva"><i class="far fa-edit"></i> DIAN</a>
                        @endif
                    @endcan
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>ENVIOS ELECTRONICOS A LA DIAN</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @can('indicator.accountingStatus')
                        @if ($indicators->accounting == 'on')
                            <a href="{{ route('accountingStatus', $indicators->id) }}" class="btn btn-success btn-md"
                            data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit"> CONT</i></a>
                        @else
                            <a href="{{ route('accountingStatus', $indicators->id) }}" class="btn btn-danger btn-md" data-toggle="tooltip"
                            data-placement="top" title="Inactiva"><i class="far fa-edit"></i> CONT</a>
                        @endif
                    @endcan
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>ACTIVADOR DE CONTABILIDAD</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @can('indicator.payrollStatus')
                        @if ($indicators->payroll == 'on')
                            <a href="{{ route('payrollStatus', $indicators->id) }}" class="btn btn-success btn-md"
                            data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit"> NOMI</i></a>
                        @else
                            <a href="{{ route('payrollStatus', $indicators->id) }}" class="btn btn-danger btn-md" data-toggle="tooltip"
                            data-placement="top" title="Inactiva"><i class="far fa-edit"></i> NOMI</a>
                        @endif
                    @endcan
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>ACTIVADOR DE NOMINA</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @can('indicator.posStatus')
                        @if ($indicators->pos == 'on')
                            <a href="{{ route('posStatus', $indicators->id) }}" class="btn btn-success btn-md"
                            data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit"> POS</i></a>
                        @else
                            <a href="{{ route('posStatus', $indicators->id) }}" class="btn btn-danger btn-md" data-toggle="tooltip"
                            data-placement="top" title="Inactiva"><i class="far fa-edit"></i> POS</a>
                        @endif
                    @endcan
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>ACTIVADOR DE POS</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @can('indicator.logoStatus')
                        @if ($indicators->logo == 'on')
                            <a href="{{ route('logoStatus', $indicators->id) }}" class="btn btn-success btn-md"
                            data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit"> LOGO</i></a>
                        @else
                            <a href="{{ route('logoStatus', $indicators->id) }}" class="btn btn-danger btn-md" data-toggle="tooltip"
                            data-placement="top" title="Inactiva"><i class="far fa-edit"></i> LOGO</a>
                        @endif
                    @endcan
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>ENTIDADES CON LOGO</b>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <div class="row m-3">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @can('indicator.workLaborStatus')
                        @if ($indicators->work_labor == 'on')
                            <a href="{{ route('workLaborStatus', $indicators->id) }}" class="btn btn-success btn-md"
                            data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit">WLAB</i></a>
                        @else
                            <a href="{{ route('workLaborStatus', $indicators->id) }}" class="btn btn-danger btn-md" data-toggle="tooltip"
                            data-placement="top" title="Inactiva"><i class="far fa-edit"></i> WLAB</a>
                        @endif
                    @endcan
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>COMISIONES MANO DE OBRA</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @can('indicator.restaurantStatus')
                        @if ($indicators->restaurant == 'on')
                            <a href="{{ route('restaurantStatus', $indicators->id) }}" class="btn btn-success btn-md"
                            data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit">REST</i></a>
                        @else
                            <a href="{{ route('restaurantStatus', $indicators->id) }}" class="btn btn-danger btn-md" data-toggle="tooltip"
                            data-placement="top" title="Inactiva"><i class="far fa-edit"></i> REST</a>
                        @endif
                    @endcan
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>RESTAURANTES</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @can('indicator.inventoryStatus')
                        @if ($indicators->inventory == 'on')
                            <a href="{{ route('inventoryStatus', $indicators->id) }}" class="btn btn-success btn-md" data-toggle="tooltip"
                            data-placement="top" title="Activo"><i class="far fa-edit"></i> INVE</a>
                        @else
                            <a href="{{ route('inventoryStatus', $indicators->id) }}" class="btn btn-danger btn-md" data-toggle="tooltip"
                            data-placement="top" title="Inactivo"><i class="far fa-edit"> INVE</i></a>
                        @endif
                    @endcan
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>CONTROL DE INVENTARIOS</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @can('indicator.materialStatus')
                        @if ($indicators->raw_material == 'on')
                            <a href="{{ route('materialStatus', $indicators->id) }}" class="btn btn-success btn-md" data-toggle="tooltip"
                            data-placement="top" title="Activo"><i class="far fa-edit"></i> RMAT</a>
                        @else
                            <a href="{{ route('materialStatus', $indicators->id) }}" class="btn btn-danger btn-md" data-toggle="tooltip"
                            data-placement="top" title="Inactivo"><i class="far fa-edit"> RMAT</i></a>
                        @endif
                    @endcan
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>MANEJO DE MATERIAS PRIMAS</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @can('indicator.barcodeStatus')
                        @if ($indicators->barcode == 'on')
                            <a href="{{ route('barcodeStatus', $indicators->id) }}" class="btn btn-success btn-md" data-toggle="tooltip"
                            data-placement="top" title="Activo"><i class="far fa-edit"></i> CBAR</a>
                        @else
                            <a href="{{ route('barcodeStatus', $indicators->id) }}" class="btn btn-danger btn-md" data-toggle="tooltip"
                            data-placement="top" title="Inactivo"><i class="far fa-edit"> CBAR</i></a>
                        @endif
                    @endcan
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>USO DE LECTOR DE CODIGO DE BARRAS</b>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <div class="row m-3">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @can('indicator.productPrice')
                        @if ($indicators->product_price == 'automatic')
                            <a href="{{ route('productPrice', $indicators->id) }}" class="btn btn-success btn-md" data-toggle="tooltip"
                            data-placement="top" title="Activo"><i class="far fa-edit"></i> PPRO</a>
                        @else
                            <a href="{{ route('productPrice', $indicators->id) }}" class="btn btn-primary btn-md" data-toggle="tooltip"
                            data-placement="top" title="manual"><i class="far fa-edit"> PPRO</i></a>
                        @endif
                    @endcan
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>MANEJO AUTOMATICO PRECIO DE VENTA</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @if ($indicators->barcode == 'on')
                        <a href="{{ route('cvpinvoiceStatus', $indicators->id) }}" class="btn btn-success btn-md" data-toggle="tooltip"
                        data-placement="top" title="Activo"><i class="far fa-edit"></i> CVPI</a>
                    @else
                        <a href="{{ route('cvpinvoiceStatus', $indicators->id) }}" class="btn btn-danger btn-md" data-toggle="tooltip"
                        data-placement="top" title="Inactivo"><i class="far fa-edit"> CVPI</i></a>
                    @endif
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>CAMBIO VALOR DE PRECIO EN LA VENTA</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @if ($indicators->sqio == 'on')
                        <a href="{{ route('sqioStatus', $indicators->id) }}" class="btn btn-success btn-md" data-toggle="tooltip"
                        data-placement="top" title="Activa"><i class="far fa-edit">SQIO</i></a>
                    @else
                        <a href="{{ route('sqioStatus', $indicators->id) }}" class="btn btn-danger btn-md" data-toggle="tooltip"
                        data-placement="top" title="Inactiva"><i class="far fa-edit">SQIO</i></a>
                    @endif
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>NO SUMAR CANTIDADES EN LA ORDEN DE VENTA</b>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    @if ($indicators->cmep == 'employee')
                        <a href="{{ route('cmepStatus', $indicators->id) }}" class="btn btn-success btn-md" data-toggle="tooltip"
                        data-placement="top" title="Empleados"><i class="far fa-edit">CMEP</i></a>
                    @else
                        <a href="{{ route('cmepStatus', $indicators->id) }}" class="btn btn-primary btn-md" data-toggle="tooltip"
                        data-placement="top" title="Productos"><i class="far fa-edit">CMEP</i></a>
                    @endif
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <b>COMISIONES DESDE EMPLEADOS O PRODUCTOS</b>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





