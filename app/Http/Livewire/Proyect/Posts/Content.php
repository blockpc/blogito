<?php

namespace App\Http\Livewire\Proyect\Posts;

use App\Models\Block;
use App\Models\Post;
use App\Models\Type;
use App\Models\User;
use Livewire\Component;

class Content extends Component
{
    public $listeners = ['postUpdated'];

    public User $user;
    public Post $post;
    public ?Block $block;

    public function mount(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
        $this->block = new Block;
    }

    public function getTypesProperty()
    {
        return Type::all();
    }

    public function getBlocksProperty()
    {
        return $this->post->blocks;
    }

    public function render()
    {
        return view('livewire.proyect.posts.content', [
            'types' => $this->types,
            'blocks' => $this->blocks,
        ]);
    }

    public function cancel()
    {
        $this->resetValidation();
        $this->block = new Block;
    }

    public function submit()
    {
        $this->block->id ? $this->update() : $this->store();
    }

    public function store()
    {
        $data = $this->validate();
        $this->block->post_id = $this->post->id;
        $this->block->save();
        $this->emit('postUpdated', $this->post->url);
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha creado un bloque", 'title' => 'Bloque Creado']
        );
    }

    public function update()
    {
        $data = $this->validate();
        $this->block->save();
        $this->block = new Block;
        $this->emit('postUpdated', $this->post->url);
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha actualizado un bloque", 'title' => 'Bloque Actualizado']
        );
    }

    public function select(int $id)
    {
        $this->block = Block::find($id);
    }

    public function delete(int $id)
    {
        $this->block = Block::find($id);
    }

    public function confirm_delete()
    {
        $this->block->delete();
        $this->block = new Block;
        $this->emit('postUpdated', $this->post->url);
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'info', 'message' => "Se ha eliminado un bloque", 'title' => 'Bloque Eliminado']
        );
    }

    public function postUpdated(Post $post)
    {
        $this->post = $post;
    }

    public function rules()
    {
        $rules = [
            'block.type_id' => 'required|integer|exists:types,id',
            'block.content' => 'required|string',
        ];
        return $rules;
    }

    protected $validationAttributes = [
        'block.type_id' => 'tipo block',
        'block.content' => 'contenido',
    ];
}
