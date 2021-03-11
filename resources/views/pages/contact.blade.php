@extends('layouts.frontend')

@section('title', __('Home'))

@section('content')
<div class="flex flex-col justify-between items-center text-gray-500 h-screen-nav">
    <div class="w-full md:w-9/12 lg:w-8/12 px-6 lg:px-32">
        <img class="w-48 mx-auto py-6" src="{{ asset('img/logo150x75.png') }}" alt="BlockPC" />
    </div>
    <section class="w-full md:w-9/12 lg:w-8/12 px-6 sm:px-12">
        @if ( session()->has('success') )
            <div class="text-green-800 px-6 py-4 border-0 rounded relative mb-4 bg-green-200" id="alert-success">
                <div class="max-w-7xl mx-auto">
                    <span class="text-xl inline-block mr-5 align-middle">
                        <i class="fas fa-bell"></i>
                    </span>
                    <span class="inline-block align-middle mr-8">
                        <b class="capitalize">{{__('Message')}}!</b> {!! session('success') !!}
                    </span>
                    <button class="absolute bg-transparent text-lg font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert('alert-success')">
                        <i class="fas fa-times text-green-800"></i>
                    </button>
                </div>
            </div>
        @endif
        <form class="w-full" method="POST" action="{{ route('contact.send') }}">
            @csrf
            <div class="flex flex-wrap mb-3">
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
                        {{__('First Name')}} <span class="text-red-700">*</span>
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-2 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('firstname') is-invalid @enderror" name="firstname" id="firstname" type="text" placeholder="{{__('your first name')}}" value="{{ old('firstname') }}">
                    @error('firstname') <span class="text-error">{{ $message }}</span> @enderror
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="lastname">
                        {{__('Last Name')}}
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-2 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('lastname') is-invalid @enderror" name="lastname" id="lastname" type="text" placeholder="{{__('your last name')}}" value="{{ old('lastname') }}">
                    @error('lastname') <span class="text-error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-3">
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                        {{__('E-mail')}} <span class="text-red-700">*</span>
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-2 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('email') is-invalid @enderror" name="email" id="email" type="email" placeholder="{{__('your email')}}" value="{{ old('email') }}">
                    @error('email') <span class="text-error">{{ $message }}</span> @enderror
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                        {{__('Phone')}}
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-2 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('phone') is-invalid @enderror" name="phone" id="phone" type="text" placeholder="{{__('your phone number')}}" value="{{ old('phone') }}">
                    @error('phone') <span class="text-error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-3">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="message">
                        {{__('Message')}} <span class="text-red-700">*</span>
                    </label>
                    <textarea class="no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-2 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-16 resize-none @error('message') is-invalid @enderror" name="message" id="message" placeholder="{{__('your message')}}">{{ old('message') }}</textarea>
                    @error('message') <span class="text-error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="md:flex md:items-center mb-3">
                <div class="md:w-1/3 px-3">
                    <button class="w-full shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                        {{__('Send')}}
                    </button>
                </div>
                <div class="md:w-2/3"></div>
            </div>
        </form>
    </section>
    <footer class="w-full md:w-9/12 lg:w-8/12 px-6 py-4 sm:px-12 sm:py-8 text-xs flex flex-col items-end">
        <a href="#">Juan Carlos Marchent (Full Stack Developer)</a>
        <a href="#">Temuco, Chile</a>
        <a href="#">+56 9 6188 1674</a>
    </footer>
</div>
@endsection