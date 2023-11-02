<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--inicio head-->
@include('layouts/head')
<!--fin head-->
    <body class="hold-transition sidebar-mini sidebar-collapse">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!--inicio Navbar -->
            @include('layouts/navbar')
            <!-- fin navbar -->

            <!--inicio aside -->
            @include('layouts/aside')
            <!-- fin aside -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- inicio header -->
                <!-- fin header -->

                <!-- Main content -->
                <section class="content">
                    @include('layouts/content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- inicio footer -->
            @include('layouts/footer')
            <!-- fin footer -->


        </div>
        <!-- ./wrapper -->

        <!-- inicio footer -->
        @include('layouts/scripts')
        <!-- fin footer -->
        <!-- Scripts -->
        @stack('scripts')
        @yield('scripts')
        @include('sweetalert::alert')
    </body>
</html>
