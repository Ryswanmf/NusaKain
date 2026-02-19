<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        if ($pages->isEmpty()) {
            Page::create(['title' => 'Syarat & Ketentuan', 'slug' => 'syarat-ketentuan', 'content' => 'Isi Syarat & Ketentuan...']);
            Page::create(['title' => 'Kebijakan Privasi', 'slug' => 'kebijakan-privasi', 'content' => 'Isi Kebijakan Privasi...']);
            $pages = Page::all();
        }
        return view('admin.landing.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        return view('admin.landing.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $page->update($validated);

        return redirect()->route('admin.landing.pages.index')->with('success', 'Konten halaman berhasil diperbarui.');
    }
}
