@extends('layouts.frontend')

@section('title', __('Article-title', ['title' => $post->title]))

@section('content')
<div class="mx-auto max-w-7xl">
    <div class="rounded-lg shadow-lg bg-blue-400 w-full flex flex-row flex-wrap p-3 antialiased" 
        @if ($post->image)
        style="
            background-image: url('{{ url($post->image) }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-blend-mode: multiply;
        "
        @endif
    >
        <main class="h-full flex items-center p-6 lg:p-12 text-gray-700">
            <section class="w-full md:w-9/12 xl:w-10/12">
                <p class="text-xs font-bold mb-2 text-gray-700">{{$post->created_at->format('j F, Y')}}</p>
                <h1 class="text-2xl lg:text-4xl font-bold pb-2 text-gray-200">
                    {{$post->title}}
                </h1>
                <p class="text-xs lg:text-base font-bold mb-1 text-white">{{$post->resume}}</p>
            </section>
        </main>
    </div>
    <article class="h-full flex items-center p-6">
        <div class="w-full ck-content">
            @foreach ($post->blocks as $item)
            <div class="p-1">
                {!! html_entity_decode($item->type->start) !!}{!! html_entity_decode($item->content) !!}{!! html_entity_decode($item->type->end) !!}
            </div>
            @endforeach
        </div>
    </article>
</div>
<footer class="flex justify-center items-center w-full py-6 ">
    <a class="px-6" href="/"><img class="h-12 w-12 rounded" id="footer-logo" src="{{ asset('img/logo100x75.png') }}"></a>
    <ul class="text-gray-500 text-xs">
        <li><span class="font-bold uppercase">© 2021 – BlockPC</span></li>
        @guest <li><a class="font-bold uppercase" href="{{ route('login') }}" class="">Log In</a></li> @endguest
    </ul>
</footer>
@endsection