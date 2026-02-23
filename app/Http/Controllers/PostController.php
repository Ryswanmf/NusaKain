<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(6);
            
        return view('landing_page.blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        
        $relatedProducts = \App\Models\Product::where('is_active', true)
            ->where(function($query) use ($post) {
                $query->where('category', 'like', '%' . $post->category . '%')
                      ->orWhere('name', 'like', '%' . $post->category . '%');
            })
            ->latest()
            ->take(4)
            ->get();

        return view('landing_page.blog.show', compact('post', 'relatedProducts'));
    }
}
