<div>
    <div x-data="{ tab: window.location.hash ? window.location.hash : '#user-information' }" class="">
        <div class="flex flex-col sm:flex-row justify-between items-center pb-4">
            <x-mini-user :user="$user" />
            <a class="text-sm sm:text-base p-2 mx-2 rounded-md bg-gray-200 hover:bg-blue-200 w-full text-center" 
                href="#" x-on:click.prevent="tab='#user-information'" :class="{ 'bg-blue-200': tab=='#user-information' }">{{__('User Information')}}</a>
            <a class="text-sm sm:text-base p-2 mx-2 border-b-2 bg-gray-200 hover:bg-blue-200 w-full text-center" 
                href="#" x-on:click.prevent="tab='#change-password'" :class="{ 'bg-blue-200': tab=='#change-password' }">{{__('Change Password')}}</a>
            <a class="text-sm sm:text-base p-2 mx-2 border-b-2 bg-gray-200 hover:bg-blue-200 w-full text-center" 
                href="#" x-on:click.prevent="tab='#permissions-roles'" :class="{ 'bg-blue-200': tab=='#permissions-roles' }">{{__('Roles and Permissions')}}</a>
        </div>
        <div class="p-0 sm:p-2 md:p-4">
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
                    <form wire:submit.prevent="edit_information">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="label">Alias</label>
                                        <input wire:model="user.name" type="text" name="name" id="name" class="input-form @error('user.name') is-invalid @enderror">
                                        @error('user.name') <span class="text-error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email" class="label">{{__('E-Mail Address')}}</label>
                                        <input wire:model="user.email" type="email" name="email" id="email" class="input-form @error('user.email') is-invalid @enderror">
                                        @error('user.email') <span class="text-error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="firstname" class="label">First name</label>
                                        <input wire:model="profile.firstname" type="text" name="firstname" id="firstname" class="input-form @error('profile.firstname') is-invalid @enderror">
                                        @error('profile.firstname') <span class="text-error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="lastname" class="label">Last name</label>
                                        <input wire:model="profile.lastname" type="text" name="lastname" id="lastname" class="input-form @error('profile.lastname') is-invalid @enderror">
                                        @error('profile.lastname') <span class="text-error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="phone" class="label">Phone</label>
                                        <input wire:model="profile.phone" type="text" name="phone" id="phone" class="input-form @error('profile.phone') is-invalid @enderror">
                                        @error('profile.phone') <span class="text-error">{{ $message }}</span> @enderror
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
                            {{__('Change the password for this user')}}.
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form wire:submit.prevent="change_password">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="password" class="label">{{__('Password')}}</label>
                                        <input wire:model="password" type="password" name="password" id="password" class="input-form @error('password') is-invalid @enderror">
                                        @error('password') <span class="text-error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="password_confirmation" class="label">{{__('Confirm Password')}}</label>
                                        <input wire:model="password_confirmation" type="password" name="password_confirmation" id="password_confirmation" class="input-form @error('password') is-invalid @enderror">
                                        @error('password_confirmation') <span class="text-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit" class="btn-update">
                                        {{__('Edit Password')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-base sm:text-lg font-medium leading-6 text-gray-900">{{__('Send a Password')}}</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{__('Send a email with new password to this user')}}.<br>
                            {{__('The new password will be generated random')}}
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form wire:submit.prevent="send_password">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 pb-5 bg-white sm:pr-6">
                                <div class="px-4 pb-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit" class="btn-submit">
                                        {{__('Send a New Password')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Roles and Permissions --}}
            <div class="md:grid md:grid-cols-3 md:gap-6" x-show="tab == '#permissions-roles'" x-cloak>
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-base sm:text-lg font-medium leading-6 text-gray-900">{{__('Roles and Permissions')}}</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{__('Change the roles and permissions for this user')}}.
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form wire:submit.prevent="roles_permissoions">
                        <div class="block px-4 pb-2">
                            <h3 class="text-sm sm:text-base font-medium leading-6 text-gray-900 mb-2">{{__('Roles')}}</h3>
                            <div class="grid sm:grid-cols-2">
                                @foreach ($roles as $id => $name)
                                    <div class="col-span-1 flex flex-col">
                                        <label class="flex flex-row items-end mt-3">
                                            <input wire:model.lazy="new_roles.{{$id}}" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="{{$name}}">
                                                <span class="ml-2 text-gray-700">{{$this->role_display_name($id)}}</span>
                                        </label>
                                        <span class="mt-1 text-sm">{{$this->role_description($id)}}</span>
                                    </div>
                                @endforeach
                            </div>
                            @error('new_roles') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="block px-4 pb-2">
                            <h3 class="text-sm sm:text-base font-medium leading-6 text-gray-900 mb-2">{{__('Permissions')}}</h3>
                            <div class="grid sm:grid-cols-2">
                                @foreach ($permissions as $id => $name)
                                    <div class="col-span-1 flex flex-col">
                                        <label class="flex flex-row items-end mt-3">
                                            <input wire:model.lazy="new_permissions.{{$id}}" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="{{$name}}">
                                                <span class="ml-2 text-gray-700">{{$this->permission_display_name($id)}}</span>
                                        </label>
                                        <span class="mt-1 text-sm">{{$this->permission_description($id)}}</span>
                                    </div>
                                @endforeach
                            </div>
                            @error('new_permissions') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="btn-update">
                                {{__('Edit Roles and Permissions')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
