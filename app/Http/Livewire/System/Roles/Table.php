<?php

namespace App\Http\Livewire\System\Roles;

use App\Models\User;
use App\Traits\AuthorizesRoleOrPermission;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Table extends Component
{
    use WithPagination, AuthorizesRoleOrPermission;
    public User $user;

    public $search = "", $paginate = 5, $modal = 0;
    public Role $role;
    public $color = "primary", $texto = "New Role";

    public function mount(User $user)
    {
        $this->authorizeRoleOrPermission('role list');
        $this->user = $user;
        $this->role = new Role;
    }

    public function getRolesProperty()
    {
        $roles = Role::withCount('users');
        if ( $this->user->hasRole('sudo') ) {
            return $roles->whereLike('display_name', $this->search)->latest()->paginate($this->paginate);
        }
        return $roles->whereNotIn('name', ['sudo'])->whereLike('display_name', $this->search)->latest()->paginate($this->paginate);
    }

    public function render()
    {
        return view('livewire.system.roles.table', [
            'roles' => $this->roles,
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
        $this->role = new Role;
        $this->modal = 0;
    }

    public function delete(int $id)
    {
        $this->authorizeRoleOrPermission('role delete');
        $this->role = Role::find($id);
    }

    public function confirm_delete()
    {
        $this->role->delete();
        $this->role = new Role;
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha eliminado un rol", 'title' => 'Rol Eliminado']
        );
    }

    public function select(Role $role)
    {
        $this->role = $role;
        $this->color = "success";
        $this->texto = "Edit Role";
        $this->modal = 1;
    }

    public function submit()
    {
        ($this->texto == "Edit Role" && $this->color == "success") ? $this->update() : $this->store();
    }

    public function update()
    {
        $this->authorizeRoleOrPermission('role update');
        $this->validate();
        $this->role->save();
        $this->cancel();
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success', 'message' => "Se ha actualizado un rol", 'title' => 'Rol Actualizado']
        );
    }

    public function store()
    {
        $this->authorizeRoleOrPermission('role create');
        $this->role->name = Str::slug($this->role->display_name);
        $this->validate();
        $this->role->save();
        $this->cancel();
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha creado un rol", 'title' => 'Rol Creado']
        );
    }

    public function rules()
    {
        $rules = [
            'role.name' => 'unique:roles,name,NULL,id,guard_name,'.$this->role->guard_name,
            'role.display_name' => 'required|max:128',
            'role.description' => 'required|max:255',
            'role.guard_name' => 'nullable',
        ];
        if ($this->texto == "Edit Role" && $this->color == "success") {
            $rules['role.name'] = 'unique:roles,name,'.$this->role->id.',id,guard_name,'.$this->role->guard_name;
        } 
        return $rules;
    }

    protected $messages = [
        'role.name.unique' => 'El nombre del rol ya esta en uso.',
    ];

    protected $validationAttributes = [
        'role.display_name' => 'nombre',
        'role.description' => 'descripción',
        'role.guard_name' => 'tipo',
    ];
}
