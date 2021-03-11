<?php

namespace App\Http\Livewire\Proyect\Types;

use App\Models\Type;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    public $search = "", $paginate = 5, $modal = false;
    public $color = "primary", $texto = "New Block";

    public User $user;
    public ?Type $type;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->type = new Type;
    }

    public function getTypesProperty()
    {
        return Type::withCount('block')->whereLike('name', $this->search)->paginate($this->paginate);
    }

    public function render()
    {
        return view('livewire.proyect.types.table', [
            'types' => $this->types,
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
        $this->type = new Type;
        $this->modal = 0;
    }

    public function select(int $id)
    {
        $this->type = Type::find($id);
        $this->color = "success";
        $this->texto = "Edit Block";
        $this->modal = 1;
    }

    public function submit()
    {
        $this->validate();
        $this->type->save();
        $this->cancel();
        if ($this->texto == "Edit Block" && $this->color == "success") {
            $this->dispatchBrowserEvent('alert', 
                ['type' => 'success', 'message' => "Se ha actualizado un bloque", 'title' => 'Bloque Actualizado']
            );
        } else {
            $this->dispatchBrowserEvent('alert', 
                ['type' => 'success', 'message' => "Se ha creado un bloque", 'title' => 'Bloque Creado']
            );
        }
    }

    public function delete(int $id)
    {
        //$this->authorizeRoleOrPermission('role delete');
        $this->type = Type::find($id);
    }

    public function confirm_delete()
    {
        $this->type->delete();
        $this->type = new Type;
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha eliminado un bloque", 'title' => 'Bloque Eliminado']
        );
    }

    public function rules()
    {
        $rules = [
            'type.name' => 'required|string|unique:types,name',
            'type.start' => 'required|string',
            'type.end' => 'required|string',
        ];
        if ($this->texto == "Edit Block" && $this->color == "success") {
            $rules['type.name'] = "unique:types,name,{$this->type->id}";
        }
        return $rules;
    }

    protected $validationAttributes = [
        'types.name' => 'nombre del bloque',
        'types.start' => 'inicio',
        'types.end' => 'fin',
    ];
}
