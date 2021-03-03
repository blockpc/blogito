<div class="" x-cloak x-data="{ open: false }">
    <button type="button" class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" @click="open = true">
        <i class="fas fa-paragraph"></i> {{__('Paragraph')}}
    </button>
    <div class="z-40 overflow-auto fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center" x-show="open">
        <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl">
            <div class="mt-3 sm:mt-0">
                <h3 class="text-sm sm:text-base font-medium leading-6 text-center">
                    {{__('Ingresa un nuevo parrafo')}}
                </h3>
                <textarea class="textarea" name="content" id="content" cols="30" rows="10"></textarea>
                <div class="mt-4 text-center">
                    <button class="btn-sm btn-danger" type="button" @click="open = false">
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