<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::Published()->with('tags')->latest()->simplePaginate(5);
        $latest = Post::Published()->with('tags')->latest()->take(5)->get();
        $categories = Category::withCount('posts')->get();
        $tags = Tag::withCount('posts')->get();
        return view('blog.index', compact('posts', 'latest', 'categories', 'tags'));
    }

    public function show(Post $post)
    {
        $tags = Tag::whereHas('posts', function ($query) use($post) {
            $query->wherePostId($post->id);
        })->get();
        return view('blog.show', compact('post', 'tags'));
    }

    public function category(Category $category)
    {
        $posts = Post::Published()->whereCategoryId($category->id)->simplePaginate(5);
        $categories = Category::withCount('posts')->get();
        $tags = Tag::withCount('posts')->get();
        return view('blog.category', compact('category', 'posts', 'categories', 'tags'));
    }

    public function tag(Tag $tag)
    {
        $posts = Post::Published()->whereHas('tags', function($query) use ($tag) {
            $query->whereTagId($tag->id);
        })->simplePaginate(5);
        $categories = Category::withCount('posts')->get();
        $tags = Tag::withCount('posts')->get();
        return view('blog.tag', compact('tag', 'posts', 'categories', 'tags'));
    }
}
