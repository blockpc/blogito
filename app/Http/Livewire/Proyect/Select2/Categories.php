<?php

namespace App\Http\Livewire\Proyect\Select2;

use App\Models\Category;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    public $search = "", $paginate = 5;

    public User $user;
    public $category;

    public function mount(User $user, $category = null)
    {
        $this->user = $user;
        $this->category = $category;
    }

    public function getCategoriesProperty()
    {
        return Category::whereLike('name', $this->search)->paginate($this->paginate);
    }

    public function render()
    {
        return view('livewire.proyect.select2.categories',[
            'categories' => $this->categories,
        ]);
    }
}
