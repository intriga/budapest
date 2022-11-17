<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/css/fontawesome-free/css/all.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">

    <!-- Site wrapper -->
    @yield('content')
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('backend/js/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/js/adminlte.min.js') }}"></script>
    <!-- Page specific script -->
    @stack('other-scripts')
</body>
</html>
