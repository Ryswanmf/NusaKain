<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('order')->paginate(10);
        return view('admin.tentang_kami.index', compact('members'));
    }

    public function create()
    {
        return view('admin.tentang_kami.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_visible' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('team', 'public');
        }

        $validated['is_visible'] = $request->has('is_visible');
        $validated['order'] = $validated['order'] ?? 0;

        TeamMember::create($validated);

        return redirect()->route('admin.tentang-kami.index')->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function edit(TeamMember $tentang_kami)
    {
        return view('admin.tentang_kami.edit', ['member' => $tentang_kami]);
    }

    public function update(Request $request, TeamMember $tentang_kami)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_visible' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($tentang_kami->image) {
                Storage::disk('public')->delete($tentang_kami->image);
            }
            $validated['image'] = $request->file('image')->store('team', 'public');
        }

        $validated['is_visible'] = $request->has('is_visible');

        $tentang_kami->update($validated);

        return redirect()->route('admin.tentang-kami.index')->with('success', 'Informasi anggota tim berhasil diperbarui.');
    }

    public function destroy(TeamMember $tentang_kami)
    {
        if ($tentang_kami->image) {
            Storage::disk('public')->delete($tentang_kami->image);
        }
        $tentang_kami->delete();

        return redirect()->route('admin.tentang-kami.index')->with('success', 'Anggota tim berhasil dihapus.');
    }
}
