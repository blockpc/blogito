@extends('layouts.frontend')

@section('title', __('Articles'))

@section('content')
<div class="flex flex-col justify-around h-screen-mobile sm:h-screen-nav">
    <div class="w-full md:w-9/12 lg:w-8/12 mx-auto px-6 sm:px-12">
        <div class="py-3 sm:py-6 space-y-2 md:space-y-5">
            <h1 class="text-xl font-extrabold text-gray-900 sm:text-2xl md:text-4xl">Articulos Etiqueta #{{Str::title($tag->name)}}</h1>
            <p class="text-base sm:text-lg text-gray-500">All the latest Tailwind CSS news, straight from the team.</p>
        </div>
    </div>
    @if ($categories->count())
        @include('blog._categories')
    @endif
    @if ($tags->count())
        @include('blog._tags')
    @endif
    <div class="px-1">
        @include('partials.slider', ['latest' => $posts])
    </div>
</div>
<div class="w-full md:w-9/12 lg:w-8/12 mx-auto px-6 sm:px-12 pb-6">
    <ul class="divide-y divide-gray-200">
        @foreach ($posts as $item)
        <li class="py-6">
            <article class="space-y-2 sm:grid sm:grid-cols-4 sm:space-y-0 sm:items-baseline">
                <dl>
                    <dt class="sr-only">{{__('Published on')}}</dt>
                    <dd class="text-base leading-6 font-medium text-gray-500">
                        <time datetime="2021-03-08T19:00:00.0Z">{{$item->created_at->format('j F, Y')}}</time>
                    </dd>
                </dl>
                <div class="space-y-5 sm:col-span-3">
                    <div class="space-y-6">
                        <h2 class="text-2xl leading-8 font-bold tracking-tight">
                            <a class="text-gray-900" href="{{ route('blog.show', $item) }}">{{Str::title($item->title)}}</a>
                        </h2>
                        <div class="prose max-w-none text-gray-500">
                            <p>{{$item->resume}}</p>
                        </div>
                    </div>
                    <div class="text-base leading-6 font-medium">
                        <a class="text-teal-500 hover:text-teal-600" aria-label="{{$item->title}}" href="{{ route('blog.show', $item) }}">{{__('Read more')}} →</a>
                        <a class="float-right badge-xs badge-success" href="{{ route('blog.categories', $item->category) }}" title="{{Str::title($item->category->description)}}">{{$item->category->name}}</a>
                        @if ($item->tags->count())
                            @include('blog._tags_post')
                        @endif
                    </div>
                </div>
            </article>
        </li>
        @endforeach
    </ul>
    {{ $posts->links() }}
</div>
<footer class="flex justify-center items-center w-full py-6 ">
    <a class="px-6" href="/"><img class="h-12 w-12 rounded" id="footer-logo" src="{{ asset('img/logo100x75.png') }}"></a>
    <ul class="text-gray-500 text-xs">
        <li><span class="font-bold uppercase">© 2021 – BlockPC</span></li>
        @guest <li><a class="font-bold uppercase" href="{{ route('login') }}" class="">Log In</a></li> @endguest
    </ul>
</footer>
@endsection