<?php

namespace App\Http\Livewire\Proyect\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    public $search = "", $paginate = 5, $modal = false;
    public $color = "primary", $texto = "New Category";

    public User $user;
    public Category $category;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->category = new Category;
    }

    public function getCategoriesProperty()
    {
        $categories = Category::withCount('posts');
        if ( $this->user->hasRole('sudo') ) {
            return $categories->whereLike('name', $this->search)->latest()->paginate($this->paginate);
        }
        return $categories->whereLike('name', $this->search)->latest()->paginate($this->paginate);
    }

    public function render()
    {
        return view('livewire.proyect.categories.table', [
            'categories' => $this->categories
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
        $this->category = new Category;
        $this->modal = 0;
    }

    public function submit()
    {
        ($this->texto == "Edit Category" && $this->color == "success") ? $this->update() : $this->store();
    }

    public function select(int $id)
    {
        $this->category = Category::find($id);
        $this->color = "success";
        $this->texto = "Edit Category";
        $this->modal = 1;
    }

    public function update()
    {
        $this->validate();
        $this->category->save();
        $this->cancel();
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success', 'message' => "Se ha actualizado una categoría", 'title' => 'Categoría Actualizada']
        );
    }

    public function store()
    {
        $this->validate();
        $this->category->save();
        $this->cancel();
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha creado una categoría", 'title' => 'Categoría Creada']
        );
    }

    public function delete(int $id)
    {
        //$this->authorizeRoleOrPermission('role delete');
        $this->category = Category::find($id);
    }

    public function confirm_delete()
    {
        $this->category->delete();
        $this->category = new Category;
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha eliminado una categoría", 'title' => 'Categoría Eliminada']
        );
    }

    public function rules()
    {
        $rules = [
            'category.name' => 'required|unique:categories,name',
            'category.description' => 'nullable|max:255'
        ];
        if ($this->texto == "Edit Category" && $this->color == "success") {
            $rules['category.name'] = "unique:categories,name,{$this->category->id}";
        }
        return $rules;
    }

    protected $messages = [
        'category.name.unique' => 'El nombre de la categoria ya esta en uso.',
    ];

    protected $validationAttributes = [
        'category.name' => 'nombre de la categoría',
        'category.description' => 'descripción',
    ];
}
