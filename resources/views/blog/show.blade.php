@extends('layouts.frontend')

@section('title', __('Article-title', ['title' => $post->title]))

@section('content')
<div class="w-full py-6">
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
        <main class="w-full md:w-9/12 lg:w-8/12 mx-auto flex items-center p-6 lg:p-12 text-gray-700 relative">
            <div class="absolute right-0 top-2 badge-sm badge-success z-20">
                <a class="text-sm font-semibold p-1 mx-2" href="{{ route('blog.categories', $post->category) }}">{{$post->category->name}}</a>
            </div>
            <section class="w-full md:w-9/12 xl:w-10/12">
                <p class="text-xs font-bold mb-2 text-gray-700">{{$post->created_at->format('j F, Y')}}</p>
                <h1 class="text-3xl lg:text-4xl font-bold pb-2 text-gray-200">
                    {{$post->title}}
                </h1>
                <p class="text-base lg:text-lg font-bold mb-1 text-white">{{$post->resume}}</p>
                @if ($tags->count())
                    <div class="z-20">
                        @foreach ($tags as $item)
                            <a class="inline-block text-sm font-semibold p-1" href="{{ route('blog.tags', $item) }}">#{{Str::title($item->name)}}</a>
                        @endforeach
                    </div>
                @endif
            </section>
        </main>
    </div>
    <article class="flex items-center p-6 font-sans">
        <div class="w-full md:w-9/12 lg:w-8/12 mx-auto">
            @foreach ($post->blocks as $item)
            <div class="p-2">
                @if ($item->title)
                    <h3 class="text-lg sm:text-xl font-semibold mb-1">{{Str::title($item->title)}}</h3>
                @endif
                @if ( $item->type->id == 2)
                    {{-- codigo 2 --}}
                    <div>{!! html_entity_decode($item->type->start) !!}{{$item->content}}{!! html_entity_decode($item->type->end) !!}</div>
                @elseif ( $item->type->id == 4)
                    {{-- imagen 4 --}}
                    <div>{!! html_entity_decode($item->type->start) !!}<img class="object-contain h-48 w-full" src="{{$item->content}}" />{!! html_entity_decode($item->type->end) !!}</div>
                @else
                    {{-- parrafo 1 --}}
                    {{-- cita 2 --}}
                    <div>{!! html_entity_decode($item->type->start) !!}{!! nl2br($item->content) !!}{!! html_entity_decode($item->type->end) !!}</div>
                @endif
                @if ($item->legend)
                    <div class="flex justify-center mt-1">
                        <span class="text-xs sm:text-sm font-thin mb-1">{{Str::title($item->legend)}}</span>
                    </div>
                @endif
            </div>
            @endforeach
            @if ($post->images)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
                    @foreach ($post->images as $image)
                        <div class="col-span-1 p-1">
                            <img class="bg-cover" src="{{$image->url}}" alt="">
                        </div>
                    @endforeach

                </div>
            @endif
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

@push('styles')
<link rel="stylesheet" href="{{ asset('css/agate.css') }}">
@endpush

@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.6.0/highlight.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlightjs-line-numbers.js/2.8.0/highlightjs-line-numbers.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('pre code').forEach((block) => {
            hljs.highlightBlock(block);
            hljs.lineNumbersBlock(block);
        });
    });
    </script>
@endpush