<?php

namespace App\Http\Livewire\Proyect\Posts;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Images extends Component
{
    use WithFileUploads;
    public $photos;
    public $max;

    public User $user;
    public Post $post;
    public ?Image $image;
    public $modal;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
        $this->image = new Image;
        $this->max = 6 - $this->post->images->count();
        $this->modal = 0;
    }

    public function getImagesProperty()
    {
        $this->max = 6 - $this->post->images->count();
        return $this->post->images;
    }

    public function render()
    {
        return view('livewire.proyect.posts.images', [
            'images' => $this->images
        ]);
    }

    public function save()
    {
        $this->validate([
            'photos' => 'sometimes|array|max:'.$this->max,
            'photos.*' => 'image|max:1024', // 1MB Max
        ], [
            'photos.max' => "El máximo de imagenes es {$this->max}"
        ]);

        foreach ($this->photos as $photo) {
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $photo->extension();
            $imageName = Str::slug($name.'-'.time());
            $path = $photo->storeAs("photo_articles", "{$imageName}.{$extension}", 'public');
            $count = $this->images->count();
            $new_image = $this->post->images()->create([
                'name' => $name,
                'url' => "/storage/{$path}",
                'position' => $count+1,
            ]);
        }
        $this->photos = [];
        $this->emit('refreshComponent');
    }

    public function quitar($id)
    {
        unset($this->photos[$id]);
    }

    public function cancel()
    {
        $this->modal = 0;
        $this->image = new Image;
    }

    public function select(int $id)
    {
        $this->image = Image::find($id);
        $this->modal = 1;
    }

    public function update()
    {
        if ( $this->modal ) {
            $this->validate();
            $this->image->save();
        }
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'info', 'message' => "Se ha actualizado el nombre de una imagen", 'title' => 'Imagen Actualizada']
        );
        $this->cancel();
        $this->emit('refreshComponent');
    }

    protected function rules()
    {
        $rules = [
            'image.name' => 'required|string|max:128'
        ];
        return $rules;
    }
}
