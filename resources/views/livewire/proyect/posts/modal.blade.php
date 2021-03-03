<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="flex justify-between w-full px-4 py-4">
                <h1 class="text-lg font-semibold">{{__('New Article')}}</h1>
                <button type="button" class="btn-xs btn-danger-border mr-1" wire:click="cancel">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form wire:submit.prevent="submit">
                <div class="bg-white px-4 pb-4">
                    <div class="">
                        <div class="block px-4 pb-2">
                            <label for="title" class="label">{{__('Article Title')}}</label>
                            <input wire:model="title" type="text" name="title" id="title" class="input-form @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="{{__('Article Title')}}">
                            @error('title') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="block px-4 pb-2">
                            <label for="resume" class="label">{{__('Description')}}</label>
                            <textarea wire:model="resume" name="resume" id="resume" class="textarea @error('resume') is-invalid @enderror" value="{{ old('resume') }}" placeholder="{{__('Description')}}" rows="3"></textarea>
                            @error('resume') <span class="text-error">{{ $message }}</span> @enderror
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