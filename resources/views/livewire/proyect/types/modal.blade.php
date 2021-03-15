<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="flex justify-between w-full px-4 py-4">
                <h1 class="text-lg font-semibold">{{__('New Block')}}</h1>
                <button type="button" class="btn-xs btn-danger-border mr-1" wire:click="cancel">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form wire:submit.prevent="submit">
                <div class="bg-white px-4 pb-4">
                    <div class="">
                        <div class="block px-4 pb-2">
                            <label for="name" class="label">{{__('Block Name')}}</label>
                            <input wire:model.lazy="type.name" type="text" name="name" id="name" class="input-form @error('type.name') is-invalid @enderror" placeholder="{{__('Block Name')}}">
                            @error('type.name') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="block px-4 pb-2">
                            <label for="description" class="label">{{__('Description')}}</label>
                            <textarea wire:model.lazy="type.description" name="description" id="description" class="input-form @error('type.description') is-invalid @enderror" placeholder="{{__('Description')}}"></textarea>
                            @error('type.description') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="block px-4 pb-2">
                            <label for="start" class="label">{{__('Start')}}</label>
                            <input wire:model.lazy="type.start" type="text" name="start" id="start" class="input-form @error('type.start') is-invalid @enderror" placeholder="{{__('Start')}}">
                            @error('type.start') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="block px-4 pb-2">
                            <label for="end" class="label">{{__('End')}}</label>
                            <input wire:model.lazy="type.end" type="text" name="end" id="end" class="input-form @error('type.end') is-invalid @enderror" placeholder="{{__('End')}}">
                            @error('type.end') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button type="submit" class="btn-sm btn-{{$color}} mr-1" wire:loading.class="disabled" wire:target="submit">{{__($texto)}}</button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="cancel" type="button" class="btn-sm btn-warning mr-1">{{__('Cancel')}}</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>