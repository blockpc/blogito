<div class="flex flex-row">
    <button wire:click="clean" type="button" class="btn-xs btn-danger-border">
        <i class="fas fa-times"></i>
    </button>
    <div class="w-full mr-1 relative rounded-md shadow-sm">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <span class="text-gray-500 sm:text-sm"><i class="fas fa-search fa-sm"></i></span>
        </div>
        <input wire:model="search" type="text" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Search">
        <div class="absolute inset-y-0 right-0 flex items-center">
            <select wire:model="paginate" id="paginate" name="paginate" class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                <option>{{ $paginate }}</option>
                <option>{{ $paginate * 5 }}</option>
                <option>{{ $paginate * 10 }}</option>
            </select>
        </div>
    </div>
    @if (isset($deleted))
    <button wire:click="eliminated" type="button" class="btn-xs btn-danger-border flex fles-row items-center">
        @if($deleted) <i class="fas fa-eye mr-2"></i> @endif <span>{{__('Eliminated')}}</span>
    </button>
    @endif
</div>