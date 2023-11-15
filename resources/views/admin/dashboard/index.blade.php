@extends('layouts.admin')
@section('titulo')
    {{ config('app.name', 'Emdisoft_erp') }}
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Compras Vs Ventas</h3>
                                <a href="javascript:void(0);">Ver Reporte</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i>${{ number_format($purchaseTotalMonth, 2) }}</span>
                                    <span class="text-muted">Compras</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i>${{ number_format($invoiceTotalMonth, 2) }}</span>
                                    <span class="text-muted">ventas</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <canvas id="visitors-chart" height="200"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> Ventas
                                </span>

                                <span>
                                    <i class="fas fa-square text-gray"></i> Compras
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Comparativo</h3>
                                <a href="javascript:void(0);">Ver Reporte</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">{{ number_format($invoiceTotal, 2) }}</span>
                                    <span>Ventas con el tiempo</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i>{{ number_format($invoiceYear, 2) }}</span>
                                    <span class="text-muted">Ventas este año</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <canvas id="sales-chart" height="200"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> Año Actual
                                </span>

                                <span>
                                    <i class="fas fa-square text-gray"></i> Año Anterior
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                Ventas por mes
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (count($invoicesByMonth) > 0)
                                <div id="invoices_by_month"></div>
                            @else
                                <div class="chart-content-message">
                                    <div class="row align-items-center justify-content-center text-center">
                                        <div class="col-12">
                                            <h5 class="chart-content-message-icon"><i class="fas fa-chart-area"></i></h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="chart-content-message-name">Bienvenido, {{ Auth::user()->name }}</h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="chart-content-message-text">
                                                Aún no registraste actividad para la muestra de este gráfico
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                Total de compras y ventas
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($purchaseTotal > 0 || $invoiceTotal > 0)
                                <div id="purchases_vs_invoices"></div>
                            @else
                                <div class="chart-content-message">
                                    <div class="row align-items-center justify-content-center text-center">
                                        <div class="col-12">
                                            <h5 class="chart-content-message-icon"><i class="fas fa-chart-column"></i></h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="chart-content-message-name">Bienvenido, {{ Auth::user()->name }}</h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="chart-content-message-text">
                                                Aún no registraste actividad para la muestra de este gráfico
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                Porcentaje de ventas a crédito y a contado
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (count($invoicesByPaymentForm) > 0)
                                <div id="invoices_by_payment_form"></div>
                            @else
                                <div class="chart-content-message">
                                    <div class="row align-items-center justify-content-center text-center">
                                        <div class="col-12">
                                            <h5 class="chart-content-message-icon"><i class="fas fa-chart-pie"></i></h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="chart-content-message-name">Bienvenido, {{ Auth::user()->name }}
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="chart-content-message-text">
                                                Aún no registraste actividad para la muestra de este gráfico
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                Muestra geográfica de ventas
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (count($invoicesByDepartment) > 0)
                                <div id="invoices_by_department"></div>
                            @else
                                <div class="chart-content-message">
                                    <div class="row align-items-center justify-content-center text-center">
                                        <div class="col-12">
                                            <h5 class="chart-content-message-icon"><i class="fas fa-globe-americas"></i>
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="chart-content-message-name">Bienvenido, {{ Auth::user()->name }}
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="chart-content-message-text">
                                                Aún no registraste actividad para la muestra de este gráfico
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
    @include('admin/dashboard.invoiceByMonth')
    @include('admin/dashboard.invoiceVsPurchase')
    @include('admin/dashboard.invoiceByPaymentForm')
    @include('admin/dashboard.invoiceByDepartment')
    @include('admin/dashboard.salesChart')
    @include('admin/dashboard.invoicePurchaseMonth')
@endsection
