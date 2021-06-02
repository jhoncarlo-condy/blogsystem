<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/adminlayouts.css') }}">
    @include('common.links')
    @stack('css')
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
@php
$auth = Auth::user();
@endphp
    <div class="wrapper">
        <!-- Navbar -->

        @include('layouts.navbar')
        @include('layouts.sidebar')
        <div class="content-wrapper">
          @yield('content-header')
          <!-- Main content -->
          @yield('content-wrapper')
          <!-- /.content -->
        </div>
        @include('layouts.footer')
    </div>
@include('common.scripts')
@stack('scripts')
</body>
</html>
