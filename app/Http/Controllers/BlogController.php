<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->simplePaginate(5);
        $latest = Post::latest()->take(5)->get();
        return view('blog.index', compact('posts', 'latest'));
    }

    public function show(Post $post)
    {
        return view('blog.show', compact('post'));
    }
}
