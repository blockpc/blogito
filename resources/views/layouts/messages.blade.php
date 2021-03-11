@if ( session()->has('success') )
<div class="text-green-800 px-6 py-4 border-0 rounded relative mb-4 bg-green-200" id="alert-success">
    <div class="max-w-7xl mx-auto">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fas fa-bell"></i>
        </span>
        <span class="inline-block align-middle mr-8">
            <b class="capitalize">{{__('Success')}}!</b> {!! session('success') !!}
        </span>
        <button class="absolute bg-transparent text-lg font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert('alert-success')">
            <i class="fas fa-times text-green-800"></i>
        </button>
    </div>
</div>
@endif
@if ( session()->has('error') )
<div class="text-red-800 px-6 py-4 border-0 rounded relative mb-4 bg-red-200" id="alert-error">
    <div class="max-w-7xl mx-auto">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fas fa-bell"></i>
        </span>
        <span class="inline-block align-middle mr-8">
            <b class="capitalize">{{__('Error')}}!</b> {!! session('error') !!}
        </span>
        <button class="absolute bg-transparent text-lg font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert('alert-error')">
            <i class="fas fa-times text-red-800"></i>
        </button>
    </div>
</div>
@endif
@if ( session()->has('message') )
<div class="text-blue-800 px-6 py-4 border-0 rounded relative mb-4 bg-blue-200" id="alert-message">
    <div class="max-w-7xl mx-auto">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fas fa-bell"></i>
        </span>
        <span class="inline-block align-middle mr-8">
            <b class="capitalize">{{__('Message')}}!</b> {!! session('message') !!}
        </span>
        <button class="absolute bg-transparent text-lg font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert('alert-message')">
            <i class="fas fa-times text-blue-800"></i>
        </button>
    </div>
</div>
@endif
@if ( session()->has('success') )
<div class="text-green-800 px-6 py-4 border-0 rounded relative mb-4 bg-green-200" id="alert-success">
    <div class="max-w-7xl mx-auto">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fas fa-bell"></i>
        </span>
        <span class="inline-block align-middle mr-8">
            <b class="capitalize">{{__('Message')}}!</b> {!! session('success') !!}
        </span>
        <button class="absolute bg-transparent text-lg font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert('alert-message')">
            <i class="fas fa-times text-green-800"></i>
        </button>
    </div>
</div>
@endif
@if ( session()->has('warning') )
<div class="text-yellow-800 px-6 py-4 border-0 rounded relative mb-4 bg-yellow-200" id="alert-warning">
    <div class="max-w-7xl mx-auto">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fas fa-bell"></i>
        </span>
        <span class="inline-block align-middle mr-8">
            <b class="capitalize">{{__('Warning')}}!</b> {!! session('warning') !!}
        </span>
        <button class="absolute bg-transparent text-lg font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert('alert-warning')">
            <i class="fas fa-times text-yellow-800"></i>
        </button>
    </div>
</div>
@endif