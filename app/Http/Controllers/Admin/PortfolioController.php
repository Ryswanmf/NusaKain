<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);
        return view('admin.portofolio.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portofolio.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'project_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        $validated['is_published'] = $request->has('is_published');

        Portfolio::create($validated);

        return redirect()->route('admin.portofolio.index')->with('success', 'Portofolio berhasil ditambahkan.');
    }

    public function edit(Portfolio $portofolio)
    {
        return view('admin.portofolio.edit', compact('portofolio'));
    }

    public function update(Request $request, Portfolio $portofolio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'project_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($portofolio->image) {
                Storage::disk('public')->delete($portofolio->image);
            }
            $validated['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . $portofolio->id;
        $validated['is_published'] = $request->has('is_published');

        $portofolio->update($validated);

        return redirect()->route('admin.portofolio.index')->with('success', 'Portofolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portofolio)
    {
        if ($portofolio->image) {
            Storage::disk('public')->delete($portofolio->image);
        }
        $portofolio->delete();

        return redirect()->route('admin.portofolio.index')->with('success', 'Portofolio berhasil dihapus.');
    }
}
