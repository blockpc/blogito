<?php

namespace App\Http\Livewire\Proyect\Posts;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    public $search = "", $paginate = 5;
    public $color = "primary", $texto = "New Article", $modal, $preview;

    public $title, $resume, $published;

    public $sortField = "title", $sortDirection = 'asc';

    public User $user;
    public Post $post;

    protected $listeners = ['toggle_preview'];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->modal = 0;
        $this->post = new Post;
        $this->published = 0;
        $this->preview = 0;
        $this->title = "";
        $this->resume = "";
    }

    public function getPostsProperty()
    {
        $posts = $this->published ? Post::Published() : Post::NotPublished();
        return $posts->withCount(['blocks', 'images', 'tags'])
            ->whereLike('title', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->paginate);
    }

    public function sortBy($field)
    {
        if ( $this->sortField === $field ) {
            $this->sortDirection = ( $this->sortDirection === 'asc') ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.proyect.posts.table', [
            'posts' => $this->posts
        ]);
    }

    public function cancel()
    {
        $this->reset('color', 'texto', 'title', 'resume');
        $this->resetValidation();
        $this->modal = 0;
        $this->preview = 0;
    }

    public function toggle_modal()
    {
        $this->modal = !$this->modal;
    }

    public function toggle_preview(Post $post)
    {
        if ( $this->preview ) {
            $this->preview = 0;
        } else {
            $this->post = $post;
            $this->preview = 1;
        }
    }

    public function submit()
    {
        $this->validate([
                'title' => 'required|min:3|unique:App\Models\Post,title',
                'resume' => 'nullable|string|max:255',
            ], [], [
                'title' => 'titulo',
                'resume' => 'descripción',
        ]);
        $post = new Post();
        $post->title = $this->title;
        $post->resume = $this->resume;
        $post->owner_id = current_user()->id;
        $post->save();
        session()->flash('success', "Se ha creado un articulo");
        return redirect()->route('proyect.post.edit', $post);
    }

    public function delete(int $id)
    {
        //$this->authorizeRoleOrPermission('role delete');
        $this->post_id = $id;
    }

    public function confirm_delete()
    {
        $post = Post::find($this->post_id);
        $post->delete();
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha eliminado un articulo", 'title' => 'Articulo Eliminado']
        );
    }
}
