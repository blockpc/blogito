<?php

namespace App\Http\Livewire\System\Users;

use App\Events\ReSendEmailWithLoginCredentialsUser;
use App\Models\Profile;
use App\Models\User;
use App\Traits\AuthorizesRoleOrPermission;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class Edit extends Component
{
    use AuthorizesRoleOrPermission;

    public User $user;
    public Profile $profile;
    public $password, $password_confirmation;
    public $user_roles, $user_permissions;
    public $new_roles, $new_permissions;

    private $solo_super_admins = [
        'super admin', 
        'role delete', 
        'permission control'
    ];

    public function mount(User $user)
    {
        $this->authorizeRoleOrPermission('user edit');
        $this->user = $user;
        $this->profile = $user->profile;
        $this->user_roles = $user->roles->pluck('name', 'id');
        $this->user_permissions = $user->permissions->pluck('name', 'id');
        $this->new_roles = $this->user_roles->toArray();
        $this->new_permissions = $this->user_permissions->toArray();
    }

    public function getRolesProperty()
    {
        if ( $this->user->hasRole('sudo')) {
            return Role::all()->pluck('name', 'id');
        }
        return Role::where('name', '<>', 'sudo')->orderBy('id')->pluck('name', 'id');
    }

    public function getPermissionsProperty()
    {
        if ( current_user()->hasRole('sudo') ) {
            $permissions = Permission::all();
        } else {
            $permissions = Permission::whereNotIn('name', $this->solo_super_admins)->get();
        }
        $retorno = [];
        foreach($permissions->groupBy('key') as $group => $collection) {
            $retorno[$group] = [];
            foreach($collection as $permiso) {
                $retorno[$group][$permiso->id] = $permiso->name;
            }
        }
        return $retorno;
    }

    public function render()
    {
        return view('livewire.system.users.edit', [
            'roles' => $this->roles,
            'permissions' => $this->permissions,
        ]);
    }

    public function edit_information()
    {
        $this->validate();
        $this->user->save();
        $this->profile->save();
        session()->flash('success', "Se actualizo la información del usuario <b>{$this->user->profile->fullname}</b>");
        return redirect()->route('users.index');
    }

    public function change_password()
    {
        $this->validate([
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.confirmed' => 'Las claves no coinciden'
        ]);
        $this->user->password = $this->password;
        $this->user->save();
        $this->reset('password', 'password_confirmation');
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success', 'message' => "Se actualizo la contraseña del usuario", 'title' => 'Actualiza Contraseña']
        );
        return redirect()->route('jobs.index');
    }

    public function send_password()
    {
        $password = Str::random(10);
        $this->user->password = $password;
        $this->user->save();
        ReSendEmailWithLoginCredentialsUser::dispatch($this->user, $password);
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha creado una nueva Tarea.<br>Enviar correo al usuario con la nueva clave", 'title' => 'Nueva Tarea']
        );
    }

    public function roles_permissoions()
    {
        $this->authorizeRoleOrPermission('user edit');
        $this->user->syncRoles(array_filter($this->new_roles));
        $this->user->syncPermissions(array_filter($this->new_permissions));
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success', 'message' => "Se han actualizados los roles y permisos del usuario", 'title' => 'Actualiza Roles y Permisos']
        );
    }

    protected function rules()
    {
        return [
            'user.name' => ['required', 'alpha_num', 'max:32', Rule::unique('users', 'name')->ignore($this->user->id)],
            'user.email' => ['required', Rule::unique('users', 'email')->ignore($this->user->id)],
            'profile.firstname' => 'required|max:128',
            'profile.lastname' => 'required|max:128',
            'profile.phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:8'],
        ];
    }

    protected $validationAttributes = [
        'user.name' => 'nombre',
        'user.email' => 'correo electrónico',
        'profile.firstname' => 'nombres',
        'profile.lastname' => 'apellidos',
        'profile.phone' => 'teléfono',
    ];

    public function role_display_name(int $id)
    {
        return Role::find($id)->display_name;
    }

    public function role_description(int $id)
    {
        return Role::find($id)->description;
    }

    public function permission_display_name(int $id)
    {
        return Permission::find($id)->display_name;
    }

    public function permission_description(int $id)
    {
        return Permission::find($id)->description;
    }
}
