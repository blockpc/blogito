<nav class="bg-white text-gray-800" x-data="{open: false}" @click.away="open = false" @close.stop="open = false" x-cloak>
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">

            <!-- Mobile menu button-->
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button x-on:click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false">
                    <span class="sr-only">Menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="flex-1 flex items-center justify-end sm:items-stretch sm:justify-start bg-white">
                <div class="flex justify-end px-2 sm:hidden bg-white">
                    <a class="flex flex-row" href="{{ route('dashboard') }}">
                        <img class="block h-8 w-auto" src="{{ asset('img/logo50x50.png') }}" alt="BlockPC">
                        <span class="text-xl pl-3 font-bold">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>
                <!-- Content nav -->
                <div class="hidden sm:block sm:ml-4">
                    <div class="flex items-center">
                        <img class="block h-8 w-auto mx-4" src="{{ asset('img/logo50x50.png') }}" alt="BlockPC">
                        @include('layouts.frontend-nav-links')
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0" x-data="{ 'showNewPost': false }" @keydown.escape="showNewPost = false" x-cloak>
                @auth
                    <!-- Profile dropdown -->
                    <div class="ml-3 relative" x-cloak x-data="{open:false}" x-on:click.away="open=false">
                        <div x-on:click="open = !open">
                            <button class="bg-purple-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-purple-800 focus:ring-white" id="user-menu" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="image_profile h-8 w-8 rounded-full" src="{!! image_profile(current_user()) !!}" alt="current_user()->profile->fullname">
                            </button>
                        </div>
                        <div x-show="open" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-purple-800 ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-purple-100 hover:bg-purple-600" role="menuitem">{{__('Dashboard')}}</a>
                            <a href="{{ route('profiles.index') }}" class="block px-4 py-2 text-sm text-purple-100 hover:bg-purple-600" role="menuitem">{{__('Your Profile')}}</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
            
        </div>
    </div>
    <!--
    Mobile menu, toggle classes based on menu state.
    Menu open: "block", Menu closed: "hidden"
    -->
    <div class="sm:hidden z-10 absolute w-full" x-show="open">
        <div class="px-2 pt-2 pb-3 space-y-1 flex flex-col bg-white">
            @include('layouts.frontend-nav-links')
        </div>
    </div>
</nav>