<?php

namespace App\Http\Livewire\System\Permissions;

use App\Models\User;
use App\Traits\AuthorizesRoleOrPermission;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Table extends Component
{
    use WithPagination, AuthorizesRoleOrPermission;
    public User $user;

    public $search = "", $paginate = 5, $modal = 0;
    public Permission $permission;
    public $color = "primary", $texto = "New Permission";

    private $solo_super_admins = ['super admin', 'organization create', 'organization delete', 'role delete', 'permission control'];

    public function mount(User $user)
    {
        $this->authorizeRoleOrPermission('permission list');
        $this->user = $user;
        $this->permission = new Permission;
    }

    public function getPermissionsProperty()
    {
        $permissions = Permission::withCount('roles');
        if ( $this->user->hasRole('sudo') ) {
            return $permissions->whereLike('display_name', $this->search)->latest()->paginate($this->paginate);
        }
        return $permissions->whereNotIn('name', $this->solo_super_admins)
            ->whereLike('display_name', $this->search)
            ->latest()->paginate($this->paginate);
    }

    public function render()
    {
        return view('livewire.system.permissions.table', [
            'permissions' => $this->permissions,
        ]);
    }

    public function clean()
    {
        $this->reset('search', 'paginate');
    }

    public function toggle_modal()
    {
        $this->modal = !$this->modal;
    }

    public function cancel()
    {
        $this->reset('color', 'texto');
        $this->resetValidation();
        $this->permission = new Permission;
        $this->modal = 0;
    }

    public function delete(int $id)
    {
        $this->authorizeRoleOrPermission('permission control');
        $this->permission = Permission::find($id);
    }

    public function confirm_delete()
    {
        $this->permission->delete();
        $this->permission = new Permission;
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha eliminado un rol", 'title' => 'Rol Eliminado']
        );
    }

    public function select(Permission $permission)
    {
        $this->permission = $permission;
        $this->color = "success";
        $this->texto = "Edit Permission";
        $this->modal = 1;
    }

    public function submit()
    {
        ($this->texto == "Edit Permission" && $this->color == "success") ? $this->update() : $this->store();
    }

    public function update()
    {
        $this->authorizeRoleOrPermission('permission control');
        $this->validate();
        $this->permission->save();
        $this->cancel();
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success', 'message' => "Se ha actualizado un rol", 'title' => 'Rol Actualizado']
        );
    }

    public function store()
    {
        $this->authorizeRoleOrPermission('permission control');
        $this->permission->name = Str::slug($this->permission->display_name);
        $this->validate();
        $this->permission->save();
        $this->cancel();
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha creado un rol", 'title' => 'Rol Creado']
        );
    }

    public function rules()
    {
        $rules = [
            'permission.name' => 'unique:permissions,name,NULL,id,guard_name,'.$this->permission->guard_name,
            'permission.display_name' => 'required|max:128',
            'permission.description' => 'required|max:255',
            'permission.guard_name' => 'nullable',
        ];
        if ($this->texto == "Edit Permission" && $this->color == "success") {
            $rules['permission.name'] = 'unique:permissions,name,'.$this->permission->id.',id,guard_name,'.$this->permission->guard_name;
        }
        return $rules;
    }

    protected $messages = [
        'permission.name.unique' => 'El nombre del permiso ya esta en uso.',
    ];

    protected $validationAttributes = [
        'permission.display_name' => 'nombre',
        'permission.description' => 'descripción',
        'permission.guard_name' => 'type',
    ];
}
