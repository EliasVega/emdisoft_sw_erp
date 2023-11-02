<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Emdisoft ERP',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Emdisoft</b>ERP',
    'logo_img' => 'vendor/adminlte/dist/img/Emdisoft.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Emdisoft ERP',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/Emdisoft.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/Emdisoft.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-info navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => true,
    'sidebar_collapse_auto_size' => true,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text'    => 'SETTINGS',
            'icon'    => 'fas fa-fw fa-cogs',
            'can'  => 'superAdmin',
            'submenu' => [
                [
                    'text' => 'Configuracion',
                    'icon'    => 'fas fa-fw fa-cog',
                    'submenu' => [
                        [
                            'text' => 'Indicadores',
                            'url' => 'indicator',
                            'can'  => 'indicator.index',
                        ],
                        [
                            'text' => 'Url envio',
                            'url' => 'environment',
                            'can'  => 'environment.index',
                        ],
                    ]

                ],
                [
                    'text' => 'Localidades',
                    'icon'    => 'fas fa-fw fa-globe-americas',
                    'submenu' => [
                        [
                            'text' => 'Departamentos',
                            'url' => 'department',
                            'can'  => 'department.index',
                        ],
                        [
                            'text' => 'Municipios',
                            'url' => 'municipality',
                            'can'  => 'municipality.index',
                        ],
                        [
                            'text' => 'Codigos Postales',
                            'url' => 'postalCode',
                            'can'  => 'postalCode.index',
                        ],
                    ],
                ],
                [
                    'text' => 'Entidades',
                    'icon'    => 'fas fa-fw fa-university',
                    'submenu' => [
                        [
                            'text' => 'Bancos',
                            'url' => 'bank',
                            'can'  => 'bank.index',
                        ],
                        [
                            'text' => 'Tarjetas',
                            'url' => 'card',
                            'can'  => 'card.index',
                        ],
                    ],
                ],
                [
                    'text' => 'Dian',
                    'icon'    => 'fas fa-fw fa-landmark',
                    'submenu' => [
                        [
                            'text' => 'Responsabilidades',
                            'url' => 'liability',
                            'can'  => 'liability.index',
                        ],
                        [
                            'text' => 'Tipo Persona',
                            'url' => 'organization',
                            'can'  => 'organization.index',
                        ],
                        [
                            'text' => 'Regimen',
                            'url' => 'regime',
                            'can'  => 'regime.index',
                        ],
                        [
                            'text' => 'Forma de Envio',
                            'url' => 'environment',
                            'can'  => 'environment.index',
                        ],
                        [
                            'text' => 'Discrepancias',
                            'url' => 'discrepancy',
                            'can'  => 'discrepancy.index',
                        ],
                        [
                            'text' => 'Impuestos',
                            'url' => 'taxType',
                            'can'  => 'taxType.index',
                        ],
                        [
                            'text' => 'Resoluciones',
                            'url' => 'resolution',
                            'can'  => 'resolution.index',
                        ],
                    ],
                ],
                [
                    'text' => 'Tipos',
                    'icon'    => 'fas fa-fw fa-landmark',
                    'submenu' => [
                        [
                            'text' => 'Identificacion',
                            'url' => 'identificationType',
                            'can'  => 'identificationType.index',
                        ],
                        [
                            'text' => 'Documentos',
                            'url' => 'documentType',
                            'can'  => 'documentType.index',
                        ],
                        [
                            'text' => 'Generacion',
                            'url' => 'generationType',
                            'can'  => 'generationType.index',
                        ],
                        [
                            'text' => 'Unidades de Medida',
                            'url' => 'measureUnit',
                            'can'  => 'measureUnit.index',
                        ],
                        [
                            'text' => 'Formas de Pago',
                            'url' => 'paymentForm',
                            'can'  => 'paymentForm.index',
                        ],
                        [
                            'text' => 'Metodos de pago',
                            'url' => 'paymentMethod',
                            'can'  => 'paymentMethod.index',
                        ],
                        [
                            'text' => 'Frecuencia de pago',
                            'url' => 'paymentFrecuency',
                            'can'  => 'paymentFrecuency.index',
                        ],
                        [
                            'text' => 'Tipos de Contrato',
                            'url' => 'contratType',
                            'can'  => 'contratType.index',
                        ],
                        [
                            'text' => 'Tipos Empleados',
                            'url' => 'employeeType',
                            'can'  => 'employeeType.index',
                        ],
                        [
                            'text' => 'Subtipos Empleados',
                            'url' => 'employeeSubtype',
                            'can'  => 'employeeSubtype.index',
                        ],
                        [
                            'text' => 'Tipo de hora',
                            'url' => 'employeeSubtype',
                            'can'  => 'employeeSubtype.index',
                        ],
                    ],
                ],
                [
                    'text' => 'Tipos Nomina',
                    'icon'    => 'fas fa-fw fa-landmark',
                    'submenu' => [
                        [
                            'text' => 'Frecuencia de pago',
                            'url' => 'paymentFrecuency',
                            'can'  => 'paymentFrecuency.index',
                        ],
                        [
                            'text' => 'Tipos de Contrato',
                            'url' => 'contratType',
                            'can'  => 'contratType.index',
                        ],
                        [
                            'text' => 'Tipos Empleados',
                            'url' => 'employeeType',
                            'can'  => 'employeeType.index',
                        ],
                        [
                            'text' => 'Subtipos Empleados',
                            'url' => 'employeeSubtype',
                            'can'  => 'employeeSubtype.index',
                        ],
                        [
                            'text' => 'Tipo de hora',
                            'url' => 'overtimeType',
                            'can'  => 'overtimeType.index',
                        ],
                    ],
                ],
                [
                    'text' => 'Response',
                    'icon'    => 'fas fa-fw fa-university',
                    'submenu' => [
                        [
                            'text' => 'DS response',
                            'url' => 'supportDocumentResponse',
                            'can'  => 'supportDocumentResponse.index',
                        ],
                        [
                            'text' => 'NDS response',
                            'url' => 'nsdResponse',
                            'can'  => 'nsdResponse.index',
                        ],
                        [
                            'text' => 'FV response',
                            'url' => 'invoiceResponse',
                            'can'  => 'invoiceResponse.index',
                        ],
                        [
                            'text' => 'NC response',
                            'url' => 'ncinvoiceResponse',
                            'can'  => 'ncinvoiceResponse.index',
                        ],
                        [
                            'text' => 'ND response',
                            'url' => 'ndinvoiceResponse',
                            'can'  => 'ndinvoiceResponse.index',
                        ],
                    ],
                ],
            ],

        ],
        [
            'text'    => 'ADMINISTRACION',
            'icon'    => 'fas fa-fw fa-building',
            'submenu' => [
                [
                    'text' => 'Empresa',
                    'icon'    => 'fas fa-fw fa-industry',
                    'submenu' => [
                        [
                            'text' => 'Empresa',
                            'url' => 'company',
                            'can'  => 'company.index',
                        ],
                        [
                            'text' => 'Sucursales',
                            'url' => 'branch',
                            'can'  => 'branch.index',
                        ],
                    ],
                ],
                [
                    'text' => 'Usuarios',
                    'icon'    => 'fas fa-fw fa-users',
                    'submenu' => [
                        [
                            'text' => 'Usuarios',
                            'url' => 'user',
                            'can'  => 'user.index',
                        ],
                        [
                            'text' => 'Roles',
                            'url' => 'roles',
                            'can'  => 'rol.index',
                        ],
                        [
                            'text' => 'Permisos',
                            'url' => 'permission',
                            'can'  => 'permission.index',
                        ],
                        [
                            'text' => 'Autorizaciones',
                            'url' => 'verificationCode',
                            'can'  => 'verificationCode.index',
                        ],
                    ],
                ],
                [
                    'text' => 'Terceros',
                    'icon'    => 'fas fa-fw fa-users-cog',
                    'submenu' => [
                        [
                            'text' => 'Proveedores',
                            'url' => 'provider',
                            'can'  => 'provider.index',
                        ],
                        [
                            'text' => 'Clientes',
                            'url' => 'customer',
                            'can'  => 'customer.index',
                        ],
                    ],
                ],
                [
                    'text' => 'Cofiguraciones',
                    'icon'    => 'fas fa-fw fa-cogs',
                    'submenu' => [
                        [
                            'text' => 'Tipos de Comprobantes',
                            'url' => 'voucherType',
                            'can'  => 'voucherType.index',
                        ],
                        [
                            'text' => 'Porcentages',
                            'url' => 'percentage',
                            'can'  => 'percentage.index',
                        ],
                        [
                            'text' => 'Impuestos',
                            'url' => 'companyTax',
                            'can'  => 'companyTax.index',
                        ],
                    ],
                ],
            ],

        ],
        [
            'text'    => 'OPERACIONES',
            'icon'    => 'fas fa-fw fa-cash-register',
            'submenu' => [
                [
                    'text' => 'Movimientos Capital',
                    'icon'    => 'fas fa-fw fa-hand-holding-usd',
                    'submenu' => [
                        [
                            'text' => 'Caja',
                            'url' => 'cashRegister',
                            'can'  => 'cashRegister.index',
                        ],
                        [
                            'text' => 'Ingresos a Caja',
                            'url' => 'cashInflow',
                            'can'  => 'cashInflow.index',
                        ],
                        [
                            'text' => 'Salidas de Caja',
                            'url' => 'cashOutflow',
                            'can'  => 'cashOutflow.index',
                        ],
                        [
                            'text' => 'Pagos',
                            'url' => 'pay',
                            'can'  => 'pay.index',
                        ],
                        [
                            'text' => 'Anticipos',
                            'url' => 'advance',
                            'can'  => 'advance.index',
                        ],
                    ],
                ],
                [
                    'text' => 'Compras',
                    'icon'    => 'fas fa-fw fa-shopping-cart',
                    'submenu' => [
                        [
                            'text' => 'Compras',
                            'url' => 'purchase',
                            'can'  => 'purchase.index',
                        ],
                        [
                            'text' => 'Notas Credito',
                            'url' => 'ncpurchase',
                            'can'  => 'ncpurchase.index',
                        ],
                        [
                            'text' => 'Notas Debito',
                            'url' => 'ndpurchase',
                            'can'  => 'ndpurchase.index',
                        ],
                        [
                            'text' => 'Orden compras',
                            'url' => 'purchaseOrder',
                            'can'  => 'purchaseOrder.index',
                        ],
                        [
                            'text' => 'Gastos',
                            'url' => 'expense',
                            'can'  => 'expense.index',
                        ],
                    ],
                ],
                [
                    'text' => 'Ventas',
                    'icon'    => 'fas fa-fw fa-file-invoice-dollar',
                    'submenu' => [
                        [
                            'text' => 'Ventas',
                            'url' => 'invoice',
                            'can'  => 'invoice.index',
                        ],
                        [
                            'text' => 'Notas Credito',
                            'url' => 'ncinvoice',
                            'can'  => 'ncinvoice.index',
                        ],
                        [
                            'text' => 'Notas Debito',
                            'url' => 'ndinvoice',
                            'can'  => 'ndinvoice.index',
                        ],
                    ],
                ],
                [
                    'text' => 'Restaurantts',
                    'icon'    => 'fas fa-fw fa-file-invoice-dollar',
                    'submenu' => [
                        [
                            'text' => 'Mesas',
                            'url' => 'restaurantTable',
                            'can'  => 'restaurantTable.index',
                        ],
                        [
                            'text' => 'Comanda',
                            'url' => 'restaurantOrder',
                            'can'  => 'restaurantOrder.index',
                        ],
                        [
                            'text' => 'Materias Primas',
                            'url' => 'rawMaterial',
                            'can'  => 'rawMaterial.index',
                        ],

                    ],
                ],
            ],

        ],
        [
            'text'    => 'INVENTARIOS',
            'icon'    => 'fas fa-fw fa-warehouse',
            'submenu' => [
                [
                    'text' => 'Categorias',
                    'url' => 'category',
                    'can'  => 'category.index',
                ],
                [
                    'text' => 'Productos',
                    'url' => 'product',
                    'can'  => 'product.index',
                ],
                [
                    'text' => 'Materias Primas',
                    'url' => 'rawMaterial',
                    'can'  => 'rawMaterial.index',
                ],
                [
                    'text' => 'Kardex',
                    'url' => 'kardex',
                    'can'  => 'kardex.index',
                ],
                [
                    'text' => 'Traslados',
                    'url' => 'transfer',
                    'can'  => 'transfer.index',
                ],
            ],
        ],
        [
            'text'    => 'REPORTES',
            'icon'    => 'fas fa-fw fa-receipt',
            'submenu' => [
                [
                    'text' => 'Impuestos',
                    'url' => 'tax',
                    'can'  => 'tax.index',
                ],

            ],
        ],
        [
            'text'    => 'NOMINA',
            'icon'    => 'fas fa-fw fa-people-carry',
            'submenu' => [
                [
                    'text' => 'Empleados',
                    'icon'    => 'fas fa-fw fa-people-arrows',
                    'submenu' => [
                        [
                            'text' => 'Empleados',
                            'url' => 'employee',
                            'can'  => 'employee.index',
                        ],
                        [
                            'text' => 'Cargos',
                            'url' => 'charge',
                            'can'  => 'charge.index',
                        ],
                        [
                            'text' => 'Horas Extras',
                            'url' => 'overtime',
                            'can'  => 'overtime.index',
                        ],
                    ],
                ],
            ],

        ],
        ['header' => 'labels'],
        [
            'text'       => 'important',
            'icon_color' => 'red',
            'url'        => '#',
        ],
        [
            'text'       => 'warning',
            'icon_color' => 'yellow',
            'url'        => '#',
        ],
        [
            'text'       => 'information',
            'icon_color' => 'cyan',
            'url'        => '#',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'vendor/select2/js/select2.full.min.js',
                    //'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2/sweetalert2.all.min.js',
                    //'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
