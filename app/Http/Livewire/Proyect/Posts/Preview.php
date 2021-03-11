<?php

namespace App\Http\Livewire\Proyect\Posts;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Preview extends Component
{
    public $listeners = ['postUpdated'];

    public User $user;
    public Post $post;

    public function mount(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.proyect.posts.preview');
    }

    public function postUpdated(Post $post)
    {
        $this->post = $post;
    }
}
