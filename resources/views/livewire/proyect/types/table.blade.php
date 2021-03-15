<div>
    <div class="inline-block w-full py 2">
        <button wire:click="toggle_modal" type="button" class="btn-sm btn-primary-border float-right"><i class="fas fa-plus mr-1"></i> {{__('New Block')}}</button>
    </div>
    @if ($types->count())
    <div class="inline-block-py-2">
        @include('partials.custom-search')
    </div>
    @endif
    <div class="table-responsive py-2">
        <table class="table table-sm table-hover table-striped">
            <thead>
                <tr class="">
                    <th class="th">{{__('Name')}}</th>
                    <th class="th">{{__('Description')}}</th>
                    <th class="th text-center">{{__('Start')}}</th>
                    <th class="th text-center">{{__('End')}}</th>
                    <th class="th text-center">{{__('Count')}}</th>
                    <th class="th"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($types as $item)
                    <tr class="">
                        <td class="td">{{$item->name}}</td>
                        <td class="td">{{$item->description}}</td>
                        <td class="td text-center">{{$item->start}}</td>
                        <td class="td text-center">{{$item->end}}</td>
                        <td class="td text-center">{{$item->block_count}}</td>
                        <td class="td text-right">
                            <div class="flex flex-row justify-end" role="group">
                                    <button wire:click="select({{$item->id}})" type="button" class="btn-xs btn-success-border mr-1"><i class="fas fa-edit"></i></button>
                                @if (!$item->block_count)
                                    @include('partials.custom-delete', [
                                        'id' => $item->id,
                                        'message' => __('Are you sure you want to delete this block?')
                                    ])
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td class="td text-center" colspan="4">Sin categorías registradas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="block py-2">
        {{ $types->links('partials.custom-pagination') }}
    </div>
    @if ($modal)
        @include('livewire.proyect.types.modal')
    @endif
</div>
