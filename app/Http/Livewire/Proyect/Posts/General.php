<?php

namespace App\Http\Livewire\Proyect\Posts;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class General extends Component
{
    use WithFileUploads;
    public $searchCategory = "", $searchTag = "";

    public User $user;
    public Post $post;
    public $selected_tags;
    public $image;

    public function mount(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
        $this->selected_tags = $this->post->tags->pluck('id');
    }

    public function getCategoriesProperty()
    {
        return Category::whereLike('name', $this->searchCategory)->paginate(5);
    }

    public function getTagsProperty()
    {
        return Tag::whereLike('name', $this->searchTag)->paginate(5);
    }

    public function render()
    {
        return view('livewire.proyect.posts.general',[
            'categories' => $this->categories,
            'tags' => $this->tags,
        ]);
    }

    public function submit()
    {
        $data = $this->validate();
        $this->post->save();
        $this->post->tags()->sync($data['selected_tags']);
        if ( $this->image ) {
            if ( $this->post->imege ) {
                File::delete(public_path($this->post->imege));
            }
            $extension = $this->image->extension();
            $path = $this->image->storeAs("photo_articles", "{$this->post->url}.{$extension}", 'public');
            $this->post->image = "/storage/{$path}";
            $this->post->save();
        }
        $this->emit('postUpdated', $this->post->url);
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha actualizado un articulo", 'title' => 'Articulo Actualizado']
        );
    }

    public function rules()
    {
        $rules = [
            'post.title' => 'required|max:128|unique:posts,title,'.$this->post->id,
            'post.resume' => 'nullable|string|max:255',
            'post.category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:255|mimes:jpeg,jpg,png|max:2048',
            'selected_tags' => 'nullable|array',
            'selected_tags.*' => 'exists:tags,id',
        ];
        return $rules;
    }

    protected $validationAttributes = [
        'post.title' => 'titulo',
        'post.resume' => 'descripción',
        'selected_tags' => 'etiquetas',
    ];
}
