<div>
    @can('permission control')
    <div class="inline-block w-full py 2">
        <button wire:click="toggle_modal" type="button" class="btn-sm btn-primary-border float-right"><i class="fas fa-plus mr-1"></i> {{__('New Permission')}}</button>
    </div>
    @endcan
    <div class="inline-block w-full py-2">
        @include('partials.custom-search')
    </div>
    <div class="table-responsive py-2">
        <table class="table table-sm table-hover table-striped">
            <thead>
                <tr class="">
                    <th class="th">{{__('Name')}}</th>
                    <th class="th">{{__('Description')}}</th>
                    <th class="th text-center">{{__('Roles')}}</th>
                    @can('permission control')
                    <th class="th text-right">{{__('Actions')}}</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $item)
                    <tr class="">
                        <td class="td">{{$item->display_name}}</td>
                        <td class="td">{!! nl2br(e($item->description)) !!}</td>
                        <td class="td text-center">{{$item->roles_count}}</td>
                        @can('permission control')
                        <td class="td text-right">
                            <div class="flex flex-row justify-end" role="group">
                                <button wire:click="select({{$item}})" type="button" class="btn-xs btn-success-border mr-1"><i class="fas fa-edit"></i></button>
                                @if (!$item->roles_count)
                                    @include('partials.custom-delete', [
                                        'id' => $item->id,
                                        'message' => __('Are you sure you want to delete this permission?')
                                    ])
                                @endif
                            </div>
                        </td>
                        @endcan
                    </tr>
                @empty
                    <tr><td colspan="4">Sin roles registrados</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="block py-2">
        {{ $permissions->links('partials.custom-pagination') }}
    </div>
    @if ($modal)
        @include('livewire.system.permissions.modals.create')
    @endif
</div>
