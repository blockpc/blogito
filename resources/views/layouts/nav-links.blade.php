<a href="{{ route('dashboard') }}" class="{{ route_active('dashboard') }} navbar-link focus:outline-none">Dashboard</a>

<div class="relative" x-data="{open:false}" x-on:click.away="open=false">
    <div x-on:click="open = !open" class="{{ route_active('proyect.post') }} navbar-link focus:outline-none w-full sm:w-auto text-left cursor-pointer">
        <span>Blog</span>
        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </div>
    <div x-cloak x-show="open" class="origin-top-right absolute right-0 mt-2 rounded-md shadow-lg py-1 bg-gray-800 ring-1 ring-black ring-opacity-5 border-t-2 border-gray-600 w-full sm:w-48" role="menu" aria-orientation="vertical" aria-labelledby="blog-menu" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
        <a href="{{ route('proyect.post.index') }}" class="block px-4 py-2 text-sm text-gray-100 hover:bg-gray-600" role="menuitem">{{__('Articles')}}</a>
        <a href="{{ route('proyect.category.index') }}" class="block px-4 py-2 text-sm text-gray-100 hover:bg-gray-600" role="menuitem">{{__('Categories')}}</a>
        <a href="{{ route('proyect.tag.index') }}" class="block px-4 py-2 text-sm text-gray-100 hover:bg-gray-600" role="menuitem">{{__('Tags')}}</a>
        <a href="{{ route('proyect.type.index') }}" class="block px-4 py-2 text-sm text-gray-100 hover:bg-gray-600" role="menuitem">{{__('Blocks')}}</a>
    </div>
</div>
