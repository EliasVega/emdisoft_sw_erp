@extends('adminlte::page')

@section('title', 'Emdisoft_erp')

@section('content_header')
@include('layouts/header')
@stop

@section('content')
    @include('layouts/content')
@stop

@section('css')
    @include('layouts/head')
@stop

@section('js')
    @include('layouts/scripts')
    <!-- fin footer -->
    <!-- Scripts -->
    @stack('scripts')
    @yield('scripts')
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@stop
