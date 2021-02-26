<?php

namespace App\Http\Livewire\System\Users;

use App\Events\SendEmailWithLoginCredentialsUser;
use App\Models\User;
use App\Traits\AuthorizesRoleOrPermission;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Table extends Component
{
    use WithPagination, AuthorizesRoleOrPermission;

    public $search = "", $paginate = "5";
    public $users_deleted;
    public $modal = 0;

    public User $user;
    public $user_id, $name, $email, $firstname, $lastname, $phone;

    public function mount(User $user)
    {
        $this->authorizeRoleOrPermission('user list');
        $this->user = $user;
        $this->user_id = 0;
        $this->users_deleted = 0;
    }

    public function getUsersProperty()
    {
        $users = User::query();
        if ( $this->users_deleted ) {
            $users->onlyTrashed();
        } else {
            $users->allowed();
        }
        return $users->whereLike(['email', 'profile.firstname', 'profile.lastname'], $this->search)
        ->latest()->paginate($this->paginate);
    }

    public function clean()
    {
        $this->reset('search', 'paginate');
    }

    public function render()
    {
        return view('livewire.system.users.table', [
            'users' => $this->users
        ]);
    }

    public function cancel()
    {
        $this->reset('user_id', 'modal');
    }

    public function eliminated()
    {
        $this->users_deleted = !$this->users_deleted;
    }

    public function toggle_modal()
    {
        $this->modal = !$this->modal;
        $this->resetValidation();
        $this->reset('name', 
        'email',
        'firstname',
        'lastname',
        'phone'
        );
    }

    public function delete(int $id)
    {
        $this->authorizeRoleOrPermission('user delete');
        $user = User::find($id);
        $this->user_id = $user->id;
    }

    public function confirm_delete()
    {
        if ($this->user_id == $this->user->id) {
            $this->dispatchBrowserEvent('alert', 
                ['type' => 'error', 'message' => "No se puede eliminar tu usuario", 'title' => 'Error']
            );
            return;
        }
        $user = User::find($this->user_id);
        $user->delete();
        $this->user_id = 0;
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success', 'message' => "Se ha eliminado un usuario", 'title' => 'Usuario Eliminado']
        );
    }

    public function restore(int $id)
    {
        $this->authorizeRoleOrPermission('user restore');
        $this->user_id = $id;
    }

    public function confirm_restore()
    {
        $user = User::onlyTrashed()->where('id',$this->user_id)->first();
        $user->restore();
        $this->user_id = 0;
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success', 'message' => "Se ha restaurado un usuario", 'title' => 'Usuario Restaurar']
        );
    }

    public function submit()
    {
        $this->authorizeRoleOrPermission('user create');
        $data = $this->validate();
        $data['password'] = Str::random(10);
        $user = User::create($data);
        $user->profile()->create($data);
        $user->assignRole('user');
        $user->givePermissionTo('user view');
        SendEmailWithLoginCredentialsUser::dispatch($user, $data['password']);
        toastr('Se ha creado una nueva Tarea.<br>Enviar correo con credenciales', 'info', 'Nueva Tarea');
        request()->session()->flash(
            'success',
            'Un usuario fue creado. Completa su asignación.'
        );
        return redirect()->route('users.edit', $user);
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'alpha_num', 'max:32', Rule::unique('users', 'name')],
            'email' => ['required', Rule::unique('users', 'email')],
            'firstname' => 'required|max:128',
            'lastname' => 'required|max:128',
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:8'],
        ];
    }

    protected $validationAttributes = [
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'firstname' => 'nombres',
        'lastname' => 'apellidos',
        'phone' => 'teléfono',
    ];
}
