<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.default.css') }}" id="theme-stylesheet">
    @include('common.links')
    @stack('css')
</head>
<body>
    @include('users.layouts.navbar')
    @yield('content')
    @include('users.layouts.footer')
</body>
@include('common.scripts')
@stack('scripts')
</html>
