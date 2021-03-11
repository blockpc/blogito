<?php

namespace App\Http\Controllers\Proyect;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        return view('proyect.posts.table');
    }

    public function store_fast(Request $request)
    {
        $validation = Validator::make( $request->all(), [
            'title' => 'required|min:3|unique:App\Models\Post,title',
            'resume' => 'nullable|string|max:255',
        ], [], [
            'title' => 'titulo',
            'resume' => 'descripción',
        ]);
        if ($validation->fails()) {
            $errors = $validation->getMessageBag()->all();
            return response()->json(
                ['ok' => false, 'errors' => $errors]
            );
        }
        $post = new Post();
        $post->title = $request->input('title');
        $post->resume = $request->input('resume');
        $post->owner_id = current_user()->id;
        $post->save();
        return response()->json(
            ['ok' => true, 'url' => route('proyect.post.edit', $post)]
        );
    }

    public function edit(Post $post)
    {
        return view('proyect.posts.edit', compact('post'));
    }

    // public function update(Request $request, Post $post)
    // {
    //     $data = $this->validate($request, [
    //         'title' => 'required|max:128|unique:posts,title,'.$post->id,
    //         'resume' => 'nullable|string|max:255',
    //         'category_id' => 'nullable|exists:categories,id',
    //         'image' => 'image|max:255|mimes:jpeg,jpg,png|max:2048',
    //         'tags' => 'nullable|array',
    //         'tags.*' => 'exists:tags,id',
    //     ]);
    //     $post->title = $request->title;
    //     $post->resume = $request->resume;
    //     $post->category_id = $request->category_id;
    //     $post->save();
    //     $post->tags()->sync($request->input('tags'));
    //     if ( $request->file('image') ) {
    //         $extension = $request->file('image')->extension();
    //         $path = $request->file('image')->storeAs("photo_articles", "{$post->url}.{$extension}", 'public');
    //         $post->image = "/storage/{$path}";
    //         $post->save();
    //     }
    //     toastr("El articulo fue actualizado", 'success', 'Articulo Actualizado');
    //     return redirect()->route('proyect.post.edit', $post)
    //         ->with("success", "El articulo fue actualizado");
    // }
}
