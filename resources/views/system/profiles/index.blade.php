@extends('layouts.app')

@section('title', __('User Profile'))

@section('content')
{{-- @livewire('system.profile', ['user' => current_user()], key(current_user()->id)) --}}
<div x-data="{ tab: window.location.hash ? window.location.hash : '#user-information' }" class="">
    <div class="flex flex-row justify-between pb-4">
        <a class="text-sm sm:text-base p-2 mx-2 rounded-md bg-gray-200 hover:bg-blue-200 w-full text-center" 
            href="#" x-on:click.prevent="tab='#user-information'" :class="{ 'bg-blue-200': tab=='#user-information' }">{{__('User Information')}}</a>
        <a class="text-sm sm:text-base p-2 mx-2 border-b-2 bg-gray-200 hover:bg-blue-200 w-full text-center" 
            href="#" x-on:click.prevent="tab='#change-password'" :class="{ 'bg-blue-200': tab=='#change-password' }">{{__('Change Password')}}</a>
        <a class="text-sm sm:text-base p-2 mx-2 border-b-2 bg-gray-200 hover:bg-blue-200 w-full text-center" 
            href="#" x-on:click.prevent="tab='#change-image'" :class="{ 'bg-blue-200': tab=='#change-image' }">{{__('Change Image')}}</a>
    </div>
    <div class="p-6">
        {{-- User Information --}}
        <div class="md:grid md:grid-cols-3 md:gap-6" x-show="tab == '#user-information'" x-cloak>
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-base sm:text-lg font-medium leading-6 text-gray-900">{{__('User Information')}}</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{__('Change the user information')}}.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{ route('profiles.edit.information') }}" method="POST">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="name" class="label">Alias</label>
                                    <input  type="text" name="name" id="name" class="input-form @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
                                    @error('name') <span class="text-error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="email" class="label">{{__('E-Mail Address')}}</label>
                                    <input  type="email" name="email" id="email" class="input-form @error('email') is-invalid @enderror" value="{{ old('name', $user->email) }}">
                                    @error('email') <span class="text-error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="firstname" class="label">First name</label>
                                    <input  type="text" name="firstname" id="firstname" class="input-form @error('firstname') is-invalid @enderror" value="{{ old('firstname', $user->profile->firstname) }}">
                                    @error('firstname') <span class="text-error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="lastname" class="label">Last name</label>
                                    <input  type="text" name="lastname" id="lastname" class="input-form @error('lastname') is-invalid @enderror" value="{{ old('lastname', $user->profile->lastname) }}">
                                    @error('lastname') <span class="text-error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="phone" class="label">Phone</label>
                                    <input  type="text" name="phone" id="phone" class="input-form @error('phone') is-invalid @enderror" value="{{ old('phone', $user->profile->phone) }}">
                                    @error('phone') <span class="text-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="btn-update">
                                    {{__('Edit Information')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- Change Password --}}
        <div class="md:grid md:grid-cols-3 md:gap-6" x-show="tab == '#change-password'" x-cloak>
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-base sm:text-lg font-medium leading-6 text-gray-900">{{__('Change Password')}}</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{__('Change User Password')}}.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{ route('profiles.change.password') }}" method="POST">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password" class="label">{{__('Password')}}</label>
                                    <input type="password" name="password" id="password" class="input-form @error('password') is-invalid @enderror">
                                    @error('password') <span class="text-error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password_confirmation" class="label">{{__('Confirm Password')}}</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="input-form @error('password') is-invalid @enderror">
                                    @error('password_confirmation') <span class="text-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="btn-update">
                                    {{__('Change Password')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- Change Image --}}
        <div class="md:grid md:grid-cols-3 md:gap-6" x-show="tab == '#change-image'" x-cloak>
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-base sm:text-lg font-medium leading-6 text-gray-900">{{__('Change Image')}}</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{__('Change the user image')}}.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{ route('profiles.change.image') }}#change-image" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-span-6">
                        <label for="logo" class="block text-sm font-medium text-gray-700"><span class="float-right" id="logo-label"></span></label>
                        <div class="flex flex-col items-center sm:flex-row sm:justify-end mt-1">
                            <div class="h-24 w-24 relative inline-block mr-2">
                                <img class="image_profile h-24 w-24 rounded-full" src="{{ image_profile($user) }}" alt="{{ $user->name }}">
                            </div>
                            <label class="w-64 h-24 flex flex-col items-center px-2 py-3 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue-500 hover:text-white mr-2">
                                <i class="fas fa-cloud-upload-alt fa-2x"></i>
                                <span class="mt-2 text-base leading-normal" id="label-span">{{__('Select a image')}}</span>
                                <input type='file' name="logo" id="logo" class="hidden" onchange="preview_image(event)" />
                            </label>
                        </div>
                    </div>
                    <div class="px-4 py-6 bg-gray-50 text-right sm:px-6">
                        @error('logo') <span class="text-error">{{ $message }}</span> @enderror
                        <button type="submit" class="btn-update">
                            {{__('Change Image')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function preview_image(event) {
        let label = document.getElementById('label-span');
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementsByClassName('image_profile');
            for (let item of output) {
                item.src = reader.result;
            }
            label.textContent = file.name;
        }
        if( file ) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endpush