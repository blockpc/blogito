<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

        <title>@yield('title', 'Sistema') | {{ config('app.name', 'BlockPC') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
    <body class="font-sans antialiased flex flex-col h-screen justify-between">
        <div class="bg-gray-100">
            <div class="flex justify-center py-2 bg-gray-800 sm:hidden">
                <a class="flex flex-row" href="{{ route('dashboard') }}">
                    <img class="block h-8 w-auto" src="{{ asset('img/mini-logo.png') }}" alt="Workflow">
                    <span class="text-gray-400 text-xl pl-3 font-bold">{{ config('app.name', 'Laravel') }}</span>
                </a>
            </div>
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="h-auto sm:h-16 max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:justify-between items-center">
                    <div class="flex flex-row">
                        <img class="image_profile h-12 w-12 rounded-full mr-2" src="{{ image_profile(current_user()) }}" alt="{{ current_user()->name ?? 'BlockPC' }}">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4 sm:mb-0 text-center sm:text-left">
                            @yield('title', 'Sistema') <br>
                            <small class="text-gray-400">{{ current_user()->profile->fullname ?? current_user()->name }}</small>
                        </h2>
                    </div>
                    <div class="flex justify-center float-right" role="group">
                    @yield('actions')
                    </div>
                </div>
            </header>
            @include('layouts.messages')

            <!-- Page Content -->
            <main class="py-6">
                <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 bg-white border-b border-gray-200">
                            <div class="flex flex-col">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <footer class="h-32 flex justify-center items-center">
            <a class="px-6" href="/"><img class="h-16 w-16 rounded" id="footer-logo" src="{{ asset('img/mini-logo.png') }}"></a>
            <ul class="master-footer-list">
                <li><span>© 2021 – BlockPC {{__('All rights reserved.')}}</span></li>
                <li><a href="#">Política de Privacidad</a></li>
            </ul>
        </footer>
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
        @livewireScripts
        @jquery
        @toastr_js
        @toastr_render
    </body>
</html>
