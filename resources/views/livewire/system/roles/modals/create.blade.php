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
                            <label for="display_name" class="label">{{__('Role Name')}}</label>
                            <input wire:model.lazy="role.display_name" type="text" name="display_name" id="display_name" class="input-form @error('role.display_name') is-invalid @enderror" value="{{ old('role.display_name') }}" placeholder="{{__('Role Name')}}">
                            @error('role.display_name') <span class="text-error">{{ $message }}</span> @enderror
                            @error('role.name') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="block px-4 pb-2">
                            <label for="description" class="label">{{__('Description')}}</label>
                            <textarea wire:model.lazy="role.description" name="description" id="description" class="textarea @error('role.description') is-invalid @enderror" placeholder="{{__('Description')}}" rows="3">{{ old('role.description') }}</textarea>
                            @error('role.description') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                        @can('super admin')
                        <div class="block px-4 pb-2">
                            <label for="guard_name" class="label">{{__('Type')}}</label>
                            <select wire:model="role.guard_name" class="select-form" name="guard_name" id="guard_name">
                                <option>Seleccione...</option>
                                @foreach (config('auth.guards') as $key => $item)
                                    <option value="{{$key}}">{{$key}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button type="submit" class="btn-sm btn-{{$color}} mr-1">{{__($texto)}}</button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="cancel" type="button" class="btn-sm btn-warning mr-1">{{__('Cancel')}}</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>