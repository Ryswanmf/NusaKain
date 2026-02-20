<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingSettingController extends Controller
{
    public function index()
    {
        $setting = LandingSetting::first();
        if (!$setting) {
            $setting = LandingSetting::create([
                'hero_badge' => 'Premium Fabric',
                'hero_title_primary' => 'Kualitas Kain Terbaik',
                'hero_title_italic' => 'Untuk Bisnis Anda.',
                'hero_description' => 'Nusakain membantu pengusaha fashion mendapatkan material premium dengan harga kompetitif langsung dari produsen.',
                'hero_button_primary_text' => 'Mulai Belanja',
                'hero_button_primary_url' => '#',
                'hero_button_secondary_text' => 'Lihat Katalog',
                'hero_button_secondary_url' => '#',
                'cta_title' => 'Siap Membangun Brand Fashion Impian Anda?',
                'cta_description' => 'Daftar sekarang dan dapatkan akses eksklusif ke katalog harga grosir serta konsultasi material kain gratis.',
                'cta_button_text' => 'Daftar Akun Gratis',
                'cta_button_url' => '/register',
                'contact_email' => 'halo@nusakain.com',
                'contact_phone' => '+6289515915699',
            ]);
        }
        return view('admin.landing.hero', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = LandingSetting::first();
        
        $validated = $request->validate([
            'hero_badge' => 'nullable|string|max:255',
            'hero_title_primary' => 'nullable|string|max:255',
            'hero_title_italic' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'hero_button_primary_text' => 'nullable|string|max:255',
            'hero_button_primary_url' => 'nullable|string|max:255',
            'hero_button_secondary_text' => 'nullable|string|max:255',
            'hero_button_secondary_url' => 'nullable|string|max:255',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cta_title' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string',
            'cta_button_text' => 'nullable|string|max:255',
            'cta_button_url' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'contact_address' => 'nullable|string',
            'contact_instagram' => 'nullable|string|max:255',
            'contact_facebook' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('hero_image')) {
            if ($setting->hero_image) {
                Storage::disk('public')->delete($setting->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('landing', 'public');
        }

        $setting->update($validated);

        return back()->with('success', 'Pengaturan Beranda berhasil diperbarui.');
    }
}
