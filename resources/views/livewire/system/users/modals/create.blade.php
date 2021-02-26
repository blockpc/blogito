<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form wire:submit.prevent="submit">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="block px-4 pb-2">
                            <label for="name" class="label">{{__('Name')}}</label>
                            <input wire:model.lazy="name" type="text" name="name" id="name" class="input-form @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{__('Name')}}">
                            @error('name') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="block px-4 pb-2">
                            <label for="email" class="label">{{__('Email Address')}}</label>
                            <input wire:model.lazy="email" type="email" name="email" id="email" class="input-form @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{__('Email Address')}}">
                            @error('email') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="block px-4 pb-2">
                            <label for="firstname" class="label">{{__('Firstname')}}</label>
                            <input wire:model.lazy="firstname" type="text" name="firstname" id="firstname" class="input-form @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" placeholder="{{__('Firstname')}}">
                            @error('firstname') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="block px-4 pb-2">
                            <label for="lastname" class="label">{{__('Lastname')}}</label>
                            <input wire:model.lazy="lastname" type="text" name="lastname" id="lastname" class="input-form @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" placeholder="{{__('Lastname')}}">
                            @error('lastname') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="block px-4 pb-2">
                            <label for="phone" class="label">{{__('Phone')}}</label>
                            <input wire:model.lazy="phone" type="text" name="phone" id="phone" class="input-form @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="{{__('Phone')}}">
                            @error('phone') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button type="submit" class="btn-sm btn-primary mr-1">{{__('New User')}}</button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="cancel" type="button" class="btn-sm btn-warning mr-1">{{__('Cancel')}}</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>