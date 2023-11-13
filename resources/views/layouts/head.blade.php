<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('titulo', 'EmdisoftErp')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/card.css','resources/css/button.css','resources/css/main.css','resources/css/rdb.css'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" type="text/css"/>
    <!-- Sweetalert2  -->
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
     <!-- Bootstrap -->
     <link rel="stylesheet" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}" />
     {{--  <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.standalone.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-fileinput/css/fileinput.min.css') }}">

    <!-- Select2  -->
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.0/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.0/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.2.0/css/scroller.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.4.0/css/rowGroup.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/keytable/2.10.0/css/keyTable.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.7.0/css/colReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Google Font Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Taiwind -->
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" >

    <!-- Styles -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    <!-- Scripts -->
    <!-- Chart -->
    <link rel="stylesheet" href="{{ asset('vendor/chart.js/css/Chart.min.css') }}" />
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('vendor/jqvmap/jqvmap.min.css') }}" />
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.css') }}" />

    @livewireStyles
  </head>
