@extends('layouts.frontend')

@section('title', __('Home'))

@section('content')
<div class="flex flex-col justify-between items-center text-gray-500 h-screen-nav">
    <div class="w-full md:w-9/12 lg:w-8/12 px-6 lg:px-32">
        <img class="w-48 mx-auto py-6" src="{{ asset('img/logo150x75.png') }}" alt="BlockPC" />
    </div>
    <section class="w-full md:w-9/12 lg:w-8/12 px-6 sm:px-12">
        <span class="font-bold uppercase tracking-widest">Fullstack</span>
        <h1 class="text-3xl lg:text-5xl font-bold text-gray-800">
            Desarrollo Web<br/>BlockPC
        </h1>
        <p class="font-bold mb-1">Un buen sistema se valida en sus de<b class="text-blue-800">tall</b>es...</p>
    </section>
    <footer class="w-full md:w-9/12 lg:w-8/12 p-6 sm:p-12 text-xs flex flex-col items-end">
        <a href="#">Juan Carlos Marchent (Full Stack Developer)</a>
        <a href="#">Temuco, Chile</a>
        <a href="#">+56 9 6188 1674</a>
    </footer>
</div>
@endsection