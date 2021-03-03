<div>
    <div class="inline-block w-full py 2">
        <button wire:click="toggle_modal" type="button" class="btn-sm btn-primary-border float-right"><i class="fas fa-plus mr-1"></i> {{__('New Role')}}</button>
    </div>
    <div class="inline-block-py-2">
        @include('partials.custom-search')
    </div>
    <div class="table-responsive py-2">
        <table class="table table-sm table-hover table-striped">
            <thead>
                <tr class="">
                    <th class="th">{{__('Name')}}</th>
                    <th class="th">{{__('Description')}}</th>
                    <th class="th text-center">{{__('Type')}}</th>
                    <th class="th text-center">{{__('Users')}}</th>
                    <th class="th text-right">{{__('Actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $item)
                    <tr class="">
                        <td class="td">{{$item->display_name}}</td>
                        <td class="td">{!! nl2br(e($item->description)) !!}</td>
                        <td class="td text-center">{{$item->guard_name}}</td>
                        <td class="td text-center">{{$item->users_count}}</td>
                        <td class="td text-right">
                            <div class="flex flex-row justify-end" role="group">
                                @can('role update')
                                    <button wire:click="select({{$item}})" type="button" class="btn-xs btn-success-border mr-1"><i class="fas fa-edit"></i></button>
                                @endcan
                                @if (!$item->users_count)
                                    @can('role delete')
                                        @include('partials.custom-delete', [
                                            'id' => $item->id,
                                            'message' => __('Are you sure you want to delete this role?')
                                        ])
                                    @endcan
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td class="td text-center" colspan="5">Sin roles registrados</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="block py-2">
        {{ $roles->links('partials.custom-pagination') }}
    </div>
    @if ($modal)
        @include('livewire.system.roles.modals.create')
    @endif
</div>
