<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->paginate(10);
        return view('admin.kontak.index', compact('messages'));
    }

    public function show(Contact $kontak)
    {
        // Mark as read when opened
        $kontak->update(['is_read' => true]);
        return view('admin.kontak.show', compact('kontak'));
    }

    public function destroy(Contact $kontak)
    {
        $kontak->delete();
        return redirect()->route('admin.kontak.index')->with('success', 'Pesan berhasil dihapus.');
    }
    
    public function toggleRead(Contact $kontak)
    {
        $kontak->update(['is_read' => !$kontak->is_read]);
        return back()->with('success', 'Status pesan berhasil diperbarui.');
    }
}
