<div>
    <div class="inline-block w-full py 2">
        <button wire:click="toggle_modal" type="button" class="btn-sm btn-primary-border float-right"><i class="fas fa-plus mr-1"></i> {{__('New User')}}</button>
    </div>
    <div class="py-2">
        @include('partials.custom-search', ['deleted' => $users_deleted])
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-striped">
            <thead>
                <tr class="">
                    <th class="th">Usuario</th>
                    <th class="th">Correo Verificado</th>
                    <th class="th">Roles</th>
                    <th class="th">Estado</th>
                    <th class="th text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="">
                @forelse ($users as $item)
                    <tr class="">
                        <td class="td"><x-mini-user :user="$item" /></td>
                        <td class="td">
                            @if ($item->email_verified_at)
                            <span class="badge-sm badge-success"><i class="fas fa-check    "></i></span>
                            @else
                            <span class="badge-sm badge-danger"><i class="fas fa-times    "></i></span>
                            @endif
                        </td>
                        <td class="td">{{$item->roles->pluck('display_name')->implode(', ')}}</td>
                        <td class="td">
                            @if ($item->blocked_at)
                            <span class="badge-sm badge-danger">Blockeado</span>
                            @else
                            <span class="badge-sm badge-success">Activo</span>
                            @endif
                        </td>
                        <td class="td">
                            <div class="flex flex-row justify-end" role="group">
                                @if ($item->trashed())
                                    @can('user restore')
                                        @include('livewire.system.users.modals.restore', [
                                            'id' => $item->id,
                                            'message' => __('Are you sure you want to restore this user?')
                                        ])
                                    @endcan
                                @else
                                    @can('user update')
                                        <a href="{{ route('users.edit', $item) }}" class="btn-xs btn-success-border mr-1"><i class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('user delete')
                                        @include('livewire.system.users.modals.delete', [
                                            'id' => $item->id,
                                            'message' => __('Are you sure you want to delete this user?')
                                        ])
                                    @endcan
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center" colspan="5"><span>Sin registros</span></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pb-2">
        {{$users->links('partials.custom-pagination')}}
    </div>
    @if ($modal)
    @include('livewire.system.users.modals.create')
    @endif
</div>
