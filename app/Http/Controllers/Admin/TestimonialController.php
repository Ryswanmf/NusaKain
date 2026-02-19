<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.landing.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.landing.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'content' => 'required|string',
            'avatar_text' => 'nullable|string|max:5',
            'avatar_color' => 'nullable|string|max:50',
        ]);

        Testimonial::create($validated);

        return redirect()->route('admin.landing.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.landing.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'content' => 'required|string',
            'avatar_text' => 'nullable|string|max:5',
            'avatar_color' => 'nullable|string|max:50',
        ]);

        $testimonial->update($validated);

        return redirect()->route('admin.landing.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.landing.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
