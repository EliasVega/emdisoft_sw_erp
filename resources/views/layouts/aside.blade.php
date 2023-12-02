<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('product') }}" class="brand-link elevation-4">
        <span class="logo-mini"><strong class="titulo-show">E</strong></span>
        <span class="brand-text font-weight-light"><strong>mdisoft</strong> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @can('superAdmin')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fas fa-fw fa-cogs"></i>
                            <p>
                                SETTINGS
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="fas fa-fw fa-cog"></i>
                                <p>
                                    CONFIGURACIONES
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('indicator') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Indicadores</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('environment') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Urls envios</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('resolution') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Resoluciones</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="fas fa-fw fa-globe-americas"></i>
                                <p>
                                    LOCALIDADES
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('department') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Departamentos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('municipality') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Municipios</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('postalCode') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Codigos postales</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="fas fa-fw fa-university"></i>
                                <p>
                                    ENTIDADES
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('bank') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Bancos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('card') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Tarjetas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="fas fa-fw fa-landmark"></i>
                                <p>
                                    DIAN
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('liability') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Responsabilidades</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('organization') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Organizacion</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('regime') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Regimen</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('discrepancy') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Discrepancias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('taxType') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Impuestos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="fas fa-sitemap"></i>
                                <p>
                                    TIPOS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('identificationType') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Tipos de Identificacion</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('documentType') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Tipos de Documentos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('generationType') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Tipos de Generacion</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('measureUnit') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Unidades de Medida</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('paymentForm') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Formas de Pago</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('paymentMethod') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Metodos de Pago</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-sitemap"></i>
                                <p>
                                    TIPO NOMINA
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('paymentFrecuency') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Frecuencia de Pago</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('contratType') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Tipos de contrato</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('employeeType') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Tipo de empleado</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('employeeSubtype') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Subtipo Empleado</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('overtimeType') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Tipos Hora extra</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-file-import"></i>
                                <p>
                                    RESPONCE
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('supportDocumentResponse') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>DS response</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('nsdResponse') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>NDS response</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('invoiceResponse') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>FV response</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('ncinvoiceResponse') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>NC response</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('ndinvoiceResponse') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>ND response</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </li>
                @endcan
                <li class="nav-item has-treeview">
                    <a href="dashboardGraphic" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            DASHBOARD
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                @if (current_user()->Roles[0]->name == 'superAdmin' || current_user()->Roles[0]->name == 'admin')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-fw fa-building"></i>
                            <p>
                                ADMINISTRACION
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-building"></i>
                                <p>
                                    SITIOS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('company') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Empresa</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('branch') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Sucursales</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="fas fa-fw fa-users"></i>
                                <p>
                                    USUARIOS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('user') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Usuarios</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('roles') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Roles</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('permission') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Permisos</p>
                                        </a>
                                    </li>
                                    @if (current_user()->Roles[0]->name == 'superAdmin' || current_user()->Roles[0]->name == 'admin')
                                        <li class="nav-item">
                                            <a href="{{ url('verificationCode') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Autorizaciones</p>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-fw fa-users"></i>
                                <p>
                                    TERCEROS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('provider') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Proveedores</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('customer') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Clientes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('employee') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Empleados</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-fw fa-cog"></i>
                                <p>
                                    CONFIGURACION
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('voucherType') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Tipos de Comprobante</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('percentage') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Porcentages</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('companyTax') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Impuestos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('restaurantTable') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Mesas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-chart-line"></i>
                                <p>
                                    REPORTES
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('tax') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Impuestos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                    <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-invoice"></i>
                        <p>
                            FACTURACION
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                               Movimientos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('cashRegister') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Caja</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('cashInflow') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Ingresos a Caja</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('cashOutflow') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Salidas de Caja</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('advance') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Anticipos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('pay') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Pagos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if (current_user()->Roles[0]->name != 'sales')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Compras
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('purchase') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Compras</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('ncpurchase') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>NC compras</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('ndpurchase') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>ND compra</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('purchaseOrder') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Orden compra</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('expense') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Gastos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (current_user()->Roles[0]->name != 'purchases')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Ventas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    @if (current_user()->company->indicator->restaurant == 'off')
                                        <li class="nav-item">
                                            <a href="{{ url('invoice') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Ventas</p>
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="{{ url('invoice') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Ventas</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('restaurantOrder') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Comanda</p>
                                            </a>
                                        </li>
                                    @endif

                                    <li class="nav-item">
                                        <a href="{{ url('ncinvoice') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>NC Venta</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('ndinvoice') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>ND Venta</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
                @if (current_user()->Roles[0]->name == 'superAdmin' || current_user()->Roles[0]->name == 'admin' || current_user()->Roles[0]->name == 'operatings')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-dolly"></i>
                            <p>
                                INVENTARIOS
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Inventario
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{ url('category') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Categorias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('product') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Productos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('rawMaterial') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Materias Primas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('kardex') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Kardex</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('transfer') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Traslados</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (current_user()->company->indicator->payroll == 'on')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                NOMINA
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Nomina
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('overtime') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Horas extras</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Empleados
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('employee') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Empleados</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Miscelanea
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('contratType') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Tipos de Contrato</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('employeeType') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Tipos de Empleado</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('employeeSubtype') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Sub Tipos de Empleado</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('charge') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Cargos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('paymentFrecuency') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Frecuencia de Pagos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
