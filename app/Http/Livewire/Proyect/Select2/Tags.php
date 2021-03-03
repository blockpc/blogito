<?php

namespace App\Http\Livewire\Proyect\Select2;

use App\Models\Tag;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Tags extends Component
{
    use WithPagination;
    public $search = "", $paginate = 5;

    public User $user;
    public $selected_tags;

    public function mount(User $user, $selected_tags)
    {
        $this->user = $user;
        $this->selected_tags = collect($selected_tags->pluck('id'));
    }

    public function getTagsProperty()
    {
        return Tag::whereLike('name', $this->search)->paginate($this->paginate);
    }

    public function render()
    {
        return view('livewire.proyect.select2.tags', [
            'tags' => $this->tags
        ]);
    }
}
