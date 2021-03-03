<?php

namespace App\Http\Livewire\Proyect\Tags;

use App\Models\Tag;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    public $search = "", $paginate = 5, $modal = false;
    public $color = "primary", $texto = "New Tag";

    public User $user;
    public Tag $tag;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->tag = new Tag();
    }

    public function getTagsProperty()
    {
        $tags = Tag::withCount('posts');
        if ( $this->user->hasRole('sudo') ) {
            return $tags->whereLike('name', $this->search)->latest()->paginate($this->paginate);
        }
        return $tags->whereLike('name', $this->search)->latest()->paginate($this->paginate);
    }

    public function render()
    {
        return view('livewire.proyect.tags.table', [
            'tags' => $this->tags
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
        $this->tag = new Tag;
        $this->modal = 0;
    }

    public function submit()
    {
        ($this->texto == "Edit Tag" && $this->color == "success") ? $this->update() : $this->store();
    }

    public function select(int $id)
    {
        $this->tag = Tag::find($id);
        $this->color = "success";
        $this->texto = "Edit Tag";
        $this->modal = 1;
    }

    public function update()
    {
        $this->validate();
        $this->tag->save();
        $this->cancel();
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success', 'message' => "Se ha actualizado una categoría", 'title' => 'Categoría Actualizada']
        );
    }

    public function store()
    {
        $this->validate();
        $this->tag->save();
        $this->cancel();
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha creado una categoría", 'title' => 'Categoría Creada']
        );
    }

    public function delete(int $id)
    {
        //$this->authorizeRoleOrPermission('role delete');
        $this->tag = Tag::find($id);
    }

    public function confirm_delete()
    {
        $this->tag->delete();
        $this->tag = new Tag;
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha eliminado una categoría", 'title' => 'Categoría Eliminada']
        );
    }

    public function rules()
    {
        $rules = [
            'tag.name' => 'required|unique:tags,name',
            'tag.description' => 'nullable|max:255'
        ];
        if ($this->texto == "Edit Tag" && $this->color == "success") {
            $rules['tag.name'] = "unique:tags,name,{$this->tag->id}";
        }
        return $rules;
    }

    protected $messages = [
        'tag.name.unique' => 'El nombre de la categoria ya esta en uso.',
    ];

    protected $validationAttributes = [
        'tag.name' => 'nombre de la categoría',
        'tag.description' => 'descripción',
    ];
}
