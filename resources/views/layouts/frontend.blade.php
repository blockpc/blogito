<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

        <title>@yield('title', 'Sistema') | {{ config('app.name', 'BlockPC') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/agate.css') }}">
        <script src="https://kit.fontawesome.com/bce0453467.js" crossorigin="anonymous"></script>
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
        @stack('styles')
        @livewireStyles
        @toastr_css

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased flex flex-col h-screen justify-between"
        style="background-image: url('{{ asset('img/fondo.png') }}');
            display: -ms-flexbox;
            display: flex;
            text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .3);
            overflow: auto;
        ">
        <div class="">
            @include('layouts.frontend-nav')
            <div class="flex flex-col">
                @yield('content')
            </div>
        </div>
        @livewireScripts
        @jquery
        @toastr_js
        @toastr_render
        @stack('scripts')
        <script>
            window.addEventListener('alert', event => { 
                toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                }
            });
            function closeAlert(id){
                let element = document.getElementById(id);
                element.remove();
            }
        </script>
    </body>
</html>