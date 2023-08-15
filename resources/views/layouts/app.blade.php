<!doctype html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Content-Language" content="en" />
        <meta name="msapplication-TileColor" content="#2d89ef">
        <meta name="theme-color" content="#4188c9">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">

        <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sistema de Gestión Capacitaciones ADS Consultores - @yield('titulo') </title>

        <!-- JS Require -->
        {{-- <script src="/components/js/require.min.js"></script>

        <script>
            requirejs.config({
                baseUrl: '/'
            });
        </script> --}}

        @include('layouts.styles')

        @yield('styles')

    </head>
    <body class="">
        <div class="page">
            <div class="flex-fill bg-cyan-lightest">
                <div class="header bg-cyan-light">
                    <div class="container">

                        <!-- Nav header -->
                        @include('layouts.navHeader')

                    </div>
                </div>

                <!-- Nav menu -->
                @include('layouts.navMenu')

                <div class="my-3 my-md-5">
                    <div class="container">

                        @yield('contenido')

                    </div>
                </div>
            </div>

            <!-- footer -->
            @include('layouts.footer')

        </div>

        @include('layouts.scripts')

        @yield('scripts')

    </body>
</html>
