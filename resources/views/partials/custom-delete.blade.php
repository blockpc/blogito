<div class="" x-cloak x-data="{ open: false }">
    <button wire:click="delete({{$id}})" type="button" class="btn-xs btn-danger mr-1" @click="open = true">
        <i class="fas fa-trash"></i>
    </button>
    <div class="z-40 overflow-auto fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center" x-show="open">
        <div class="h-auto p-4 mx-2 text-left bg-red-300 rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0">
            <div class="mt-3 sm:mt-0">
                <h3 class="text-lg font-medium leading-6 text-red-900 text-center">
                    {{__($message)}}
                </h3>
                <div class="mt-4 text-center">
                    <button wire:click="confirm_delete" class="btn-sm btn-danger" type="button" @click="open = false">
                        <i class="fas fa-check fa-lg mr-2"></i> <span>{{__('Yes')}}</span>
                    </button>
                    <button @click="open = false" class="btn-sm btn-warning" type="button">
                        <i class="fas fa-times fa-lg mr-2"></i> <span>{{__('No')}}</span>
                    </button>
                </div>
            </div>
            <div class="mt-5 sm:mt-6 text-right">
                <button @click="open = false" class="btn-xs btn-danger-border">
                {{__('Close')}}
                </button>
            </div>
        </div>
    </div>
</div>