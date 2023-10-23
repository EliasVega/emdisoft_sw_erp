@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="id">COMANDA #</label>
                <h6>{{ $restaurantOrder->id }}</h6>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">SUCURSAL</label>
                <h6>{{ $restaurantOrder->user->branch->name }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="Fecha">FECHA EMISION</label>
                <h6>{{ date('d-m-Y', strtotime($restaurantOrder->created_at)) }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="company">RESPONSABLE</label>
                <h6>{{ $restaurantOrder->user->name }}</h6>
            </div>
        </div>
        @if ($restaurantOrder->restaurant_table_id == 1)
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="company">NOMBRE</label>
                    <h6>{{ $restaurantOrder->homeOrder->name }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="company">DIRECCION</label>
                    <h6>{{ $restaurantOrder->homeOrder->address }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="company">TELEFONO</label>
                    <h6>{{ $restaurantOrder->homeOrder->phone }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="company">DOMICILIARIO</label>
                    <h6>{{ $restaurantOrder->homeOrder->domicialiary }}</h6>
                </div>
            </div>
        @endif
    </div><br>
    <div class="box-body row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <h4>Detalle de la Comanda
                        <a href="{{ route('restaurantOrder.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                        <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                    </h4>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Estado</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio ($)</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tfoot>

                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($restaurantOrder->total, 2) }}</p></th>
                            </tr>

                            <tr>
                                <th colspan="4"><p align="right">TOTAL INC:</p></th>
                                <th><p align="right">${{ number_format($restaurantOrder->total_tax, 2) }}</p></th>
                            </tr>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL PAGAR:</p></th>
                                <th><p align="right">${{ number_format($restaurantOrder->total_pay, 2) }}</p></th>
                            </tr>

                        </tfoot>
                        <tbody>
                            @foreach($productRestaurantOrders as $productRestaurantOrder)
                                <tr>
                                    <td>{{ $productRestaurantOrder->status }}</td>
                                    <td>{{ $productRestaurantOrder->product->name }}</td>
                                    <td>{{ $productRestaurantOrder->quantity }}</td>
                                    <td class="tdder">${{ number_format($productRestaurantOrder->price,2) }}</td>
                                    <td class="tdder">{{ number_format($productRestaurantOrder->subtotal,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
