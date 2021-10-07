<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AsthmaCare</title>

        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="login">
            <div class="container">
                
                <div class="logo">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('img/logo.jpg') }}" class="logo" alt="AsthmaCare">
                    </a>
                </div>
                
                <main class="py-4">
                    @yield('content')
                </main>

            </div>
        </div>
    </body>
</html>