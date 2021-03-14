<?php

namespace App\Http\Controllers\Proyect;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DropzoneController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validation = Validator::make( $request->all(), [
            'file' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ], [], [
            'file' => 'imagen',
        ]);
        if ($validation->fails()) {
            $errors = $validation->getMessageBag()->all();
            return response()->json(
                ['ok' => false, 'errors' => $errors]
            );
        }
        if ( $request->file('file') ) {
            $image = $request->file('file');
            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->extension();
            $imageName = Str::slug($name.'-'.time());
            $path = $image->storeAs("photo_articles", "{$imageName}.{$extension}", 'public');
            $count = $post->images->count();
            $new_image = $post->images()->create([
                'name' => $name,
                'url' => "/storage/{$path}",
                'position' => $count+1,
            ]);
        }
        return response()->json([
            'ok' => true, 
            'url' => $new_image->url,
            'name' => $new_image->name,
            'contador' => $new_image->position,
            'id' => $new_image->id,
        ]);
    }

    public function destroy(Request $request)
    {
        $validation = Validator::make( $request->all(), [
            'id' => 'required|exists:images,id'
        ], [], [
            'id' => 'imagen',
        ]);
        if ($validation->fails()) {
            $errors = $validation->getMessageBag()->all();
            return response()->json(
                ['ok' => false, 'errors' => $errors]
            );
        }
        $image = Image::find($request->id);
        $image->delete();
        return response()->json(
            ['ok' => true]
        );
    }

    public function update(Request $request, Image $image)
    {
        dd($request->id, $request->name, $image->id);
        $validation = Validator::make( $request->all(), [
            'id' => 'required|integer|exists:images,id|size:'.$image->id,
            'name' => 'required|string|max:128'
        ], [], [
            'id' => 'imagen',
            'name' => 'nombre',
        ]);
        if ($validation->fails()) {
            $errors = $validation->getMessageBag()->all();
            return response()->json(
                ['ok' => false, 'errors' => $errors]
            );
        }
        //$image = Image::find($request->id);
        $image = Image::whereId($request->id)->first();
        //dd($image);
        $image->update(['name' => $request->name]);
        return response()->json(
            ['ok' => true, 'image' => $image]
        );
    }
}
