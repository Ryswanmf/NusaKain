<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingSetting;
use App\Models\Testimonial;
use App\Models\Partner;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Landing Settings
        if (!LandingSetting::exists()) {
            LandingSetting::create([
                'hero_badge' => 'Premium Fabric',
                'hero_title_primary' => 'Kualitas Kain Terbaik',
                'hero_title_italic' => 'Untuk Bisnis Anda.',
                'hero_description' => 'Nusakain membantu pengusaha fashion mendapatkan material premium dengan harga kompetitif langsung dari produsen.',
                'hero_button_primary_text' => 'Mulai Belanja',
                'hero_button_primary_url' => '/produk',
                'hero_button_secondary_text' => 'Lihat Katalog',
                'hero_button_secondary_url' => '/produk',
                'cta_title' => 'Siap Membangun Brand Fashion Impian Anda?',
                'cta_description' => 'Daftar sekarang dan dapatkan akses eksklusif ke katalog harga grosir serta konsultasi material kain gratis.',
                'cta_button_text' => 'Daftar Akun Gratis',
                'cta_button_url' => '/register',
                'contact_email' => 'halo@nusakain.com',
                'contact_phone' => '+6289515915699',
                'contact_address' => 'Jl. Tekstil Raya No. 88, Bandung, Jawa Barat',
                'contact_instagram' => 'https://instagram.com/nusakain',
                'contact_facebook' => 'https://facebook.com/nusakain',
            ]);
        }

        // Seed Testimonials
        if (!Testimonial::exists()) {
            Testimonial::create([
                'name' => 'Andini Sari',
                'position' => 'Owner Bloom Fashion',
                'content' => 'Kualitas kain di Nusakain sangat konsisten. Produksi baju brand saya jadi lebih lancar karena stok selalu aman.',
                'avatar_text' => 'AS',
                'avatar_color' => 'teal',
            ]);
            Testimonial::create([
                'name' => 'Budi Pratama',
                'position' => 'Founder UrbanWear',
                'content' => 'Harga kompetitif banget buat pengusaha pemula seperti saya. Pelayanan adminnya juga ramah dan sangat membantu.',
                'avatar_text' => 'BP',
                'avatar_color' => 'indigo',
            ]);
            Testimonial::create([
                'name' => 'Rina Diana',
                'position' => 'Production Manager HijabCo',
                'content' => 'Proses pengiriman cepat dan packing aman. Kain sampai dalam kondisi rapi tanpa cacat sedikitpun. Rekomendasi!',
                'avatar_text' => 'RD',
                'avatar_color' => 'emerald',
            ]);
        }

        // Seed Partners
        if (!Partner::exists()) {
            $partners = ['EIGER', 'ERIGO', 'THXNSMN', 'BLOODS', 'ROUGHNECK'];
            foreach ($partners as $index => $name) {
                Partner::create([
                    'name' => $name,
                    'order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}
