@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h5>Cargos
            @can('company.create')
                <a href="company/create" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i>Agregar Compañia</a>
            @endcan
        </h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <tr class="trdatacolor">
                        <th>Id</th>
                        <th>Departamento</th>
                        <th>Municipio</th>
                        <th>Empresa</th>
                        <th>NIT</th>
                        <th>dv</th>
                        <th>Logo</th>
                        <th>Ingresar</th>
                        <th>Editar</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td>{{ $company->department->name }}</td>
                            <td>{{ $company->municipality->name }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->nit }}</td>
                            <td>{{ $company->dv }}</td>
                            <td>
                                <img src="{{ asset($company->logo) }}" alt="{{ $company->name }}" style="height:60px; width:80px;" class="img-thumbnail">
                            </td>
                            <td>
                                @can('branch.index')
                                    <a href="{{ route('company.show', $company->id) }}" class="btn btn-primary" data-toggle="tooltip"
                                        data-placement="top" title="Ingresar"><i class="fas fa-indent"></i></a>
                                @endcan
                            </td>
                            <td>
                                @can('company.edit')
                                    <a href="{{ route('company.edit', $company->id) }}" class="btn btn-warning" data-toggle="tooltip"
                                        data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
                                @endcan
                            </td>

                            <td>
                                @can('company.companyStatus')
                                    @if ($company->status == 'active')
                                        <a href="{{ route('companyStatus', $company->id) }}" class="btn btn-success btn-sm"
                                            data-toggle="tooltip" data-placement="top" title="Desactivar"><i class="fas fa-user"></i></a>
                                    @else
                                        <a href="{{ route('companyStatus', $company->id) }}" class="btn btn-danger btn-sm"
                                            data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-user"></i></a>
                                    @endif
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-lemon order-card">
                                <div class="card-blok">
                                    <h5>Sucursales</h5>
                                    @php
                                        use App\Models\Branch;
                                        $cant_branchs = Branch::count();
                                    @endphp
                                    <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{ $cant_branchs }}</span></h2>
                                        <p class="m-b-0 text-right"><a href="branch" class="text-white">Ver mas</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-blue order-card">
                                <div class="card-blok">
                                    <h5>Usuarios</h5>
                                    @php
                                        use App\Models\user;
                                        $cant_users = User::count();
                                    @endphp
                                    <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{ $cant_users }}</span></h2>
                                        <p class="m-b-0 text-right"><a href="user" class="text-white">Ver mas</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-darkBlue order-card">
                                <div class="card-blok">
                                    <h5>Productos</h5>
                                    @php
                                        use App\Models\Product;
                                        $cant_products = Product::count();
                                    @endphp
                                    <h2 class="text-right"><i class="fa fa-users f-left"></i><span>${{ $cant_products }}</span></h2>
                                        <p class="m-b-0 text-right"><a href="product" class="text-white">Ver mas</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-gray order-card">
                                <div class="card-blok">
                                    <h5>Compras hoy</h5>
                                    @php
                                        use App\Models\Purchase;
                                        $purchases = Purchase::whereDay('created_at', '=', date('d'))->sum('total_pay');
                                    @endphp
                                    <h2 class="text-right"><i class="fa fa-users f-left"></i><span>${{ number_format($purchases,2) }}</span></h2>
                                        <p class="m-b-0 text-right"><a href="branch" class="text-white">Ver mas</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-green order-card">
                                <div class="card-blok">
                                    <h5>Gastos hoy</h5>
                                    @php
                                        use App\Models\Expense;
                                        $expenses = Expense::whereDay('created_at', '=', date('d'))->sum('total_pay');
                                    @endphp
                                    <h2 class="text-right"><i class="fa fa-users f-left"></i><span>${{ number_format($expenses,2) }}</span></h2>
                                        <p class="m-b-0 text-right"><a href="branch" class="text-white">Ver mas</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-orange order-card">
                                <div class="card-blok">
                                    <h5>Reportes</h5>
                                    <h2 class="text-right"><i class="fa fa-users f-left"></i><span>Reportes</span></h2>
                                        <p class="m-b-0 text-right"><a href="#" class="text-white">Ver mas</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

