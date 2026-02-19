<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $validated['published_at'] ?? now();

        Post::create($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil diterbitkan.');
    }

    public function edit(Post $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, Post $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . $blog->id;
        $validated['is_published'] = $request->has('is_published');

        $blog->update($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Post $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
