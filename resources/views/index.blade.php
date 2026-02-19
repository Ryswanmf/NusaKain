@extends('layouts.app')

@section('title', 'Nusakain - Kualitas Kain Terbaik Untuk Bisnis Anda')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
    <div class="bg-white rounded-[3rem] p-8 md:p-16 border border-gray-100 shadow-sm flex flex-col md:flex-row items-center gap-12">
        
        <div class="flex-1 order-2 md:order-1">
            <span class="inline-block px-4 py-1.5 bg-teal-50 text-teal-600 text-sm font-bold rounded-full mb-6">
                Premium Fabric
            </span>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight leading-[1.1]">
                Kualitas Kain Terbaik <br>
                <span class="text-teal-600 italic">Untuk Bisnis Anda.</span>
            </h1>
            <p class="mt-6 text-lg text-slate-500 max-w-xl leading-relaxed">
                Nusakain membantu pengusaha fashion mendapatkan material premium dengan harga kompetitif langsung dari produsen.
            </p>
            
            <div class="mt-10 flex flex-wrap gap-4">
                <a href="#" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-teal-600 transition-all shadow-lg shadow-slate-200">
                    Mulai Belanja
                </a>
                <a href="#" class="px-8 py-4 bg-white text-slate-700 border border-gray-200 rounded-2xl font-bold hover:bg-gray-50 transition-all">
                    Lihat Katalog
                </a>
            </div>
        </div>

        <div class="flex-1 order-1 md:order-2 w-full">
            <div class="relative group">
                <div class="absolute -inset-4 bg-teal-100/50 rounded-[2.5rem] blur-2xl group-hover:bg-teal-200/50 transition-colors"></div>
                
                <img src="{{ asset('images/hero-landingpage.png') }}" 
                     alt="Koleksi Kain Nusakain" 
                     class="relative w-full h-[400px] md:h-[500px] object-contain transition-transform duration-500 group-hover:scale-[1.05]">
                
                <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur px-5 py-3 rounded-2xl shadow-xl border border-white/20">
                    <p class="text-sm font-bold text-slate-900">100+ Jenis Kain</p>
                    <p class="text-xs text-slate-500 font-medium">Ready Stock Hari Ini</p>
                </div>
            </div>
        </div>

    </div>
</main>

<section class="max-w-7xl mx-auto px-6 py-24">
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
        <div>
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">Eksplorasi Koleksi <br><span class="text-teal-600">Kain Terpopuler</span></h2>
            <p class="mt-4 text-slate-500 max-w-md">Pilih material terbaik yang dirancang khusus untuk meningkatkan nilai estetika brand fashion Anda.</p>
        </div>
        <a href="#" class="group flex items-center space-x-2 text-teal-600 font-bold hover:text-teal-700 transition-colors">
            <span>Lihat Semua Kategori</span>
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <div class="group relative bg-white rounded-[2.5rem] p-4 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
            <div class="aspect-square rounded-[2rem] overflow-hidden bg-gray-100 mb-6">
                <img src="https://images.unsplash.com/photo-1590736961649-7151523f0631?q=80&w=500&auto=format&fit=crop" alt="Katun Premium" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            </div>
            <div class="px-4 pb-4">
                <h3 class="text-xl font-bold text-slate-900">Katun Premium</h3>
                <p class="text-sm text-slate-500 mt-2 italic leading-relaxed">Tekstur lembut, adem, dan menyerap keringat sempurna.</p>
                <div class="mt-6 flex items-center justify-between">
                    <span class="text-xs font-bold px-3 py-1 bg-green-50 text-green-600 rounded-full">Tersedia</span>
                    <button class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="group relative bg-white rounded-[2.5rem] p-4 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
            <div class="aspect-square rounded-[2rem] overflow-hidden bg-gray-100 mb-6">
                <img src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?q=80&w=500&auto=format&fit=crop" alt="Linen Look" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            </div>
            <div class="px-4 pb-4">
                <h3 class="text-xl font-bold text-slate-900">Organic Linen</h3>
                <p class="text-sm text-slate-500 mt-2 italic leading-relaxed">Memberikan kesan mewah, eco-friendly, dan timeless.</p>
                <div class="mt-6 flex items-center justify-between">
                    <span class="text-xs font-bold px-3 py-1 bg-green-50 text-green-600 rounded-full">Tersedia</span>
                    <button class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="group relative bg-white rounded-[2.5rem] p-4 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
            <div class="aspect-square rounded-[2rem] overflow-hidden bg-gray-100 mb-6">
                <img src="https://images.unsplash.com/photo-1542272604-787c3835535d?q=80&w=500&auto=format&fit=crop" alt="Denim" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            </div>
            <div class="px-4 pb-4">
                <h3 class="text-xl font-bold text-slate-900">Raw Denim</h3>
                <p class="text-sm text-slate-500 mt-2 italic leading-relaxed">Karakter kuat untuk outerwear dan celana berkualitas.</p>
                <div class="mt-6 flex items-center justify-between">
                    <span class="text-xs font-bold px-3 py-1 bg-green-50 text-green-600 rounded-full">Tersedia</span>
                    <button class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="group relative bg-white rounded-[2.5rem] p-4 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
            <div class="aspect-square rounded-[2rem] overflow-hidden bg-gray-100 mb-6">
                <img src="https://images.unsplash.com/photo-1528459801416-a9e53bbf4e17?q=80&w=500&auto=format&fit=crop" alt="Rayon Viscose" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            </div>
            <div class="px-4 pb-4">
                <h3 class="text-xl font-bold text-slate-900">Rayon Viscose</h3>
                <p class="text-sm text-slate-500 mt-2 italic leading-relaxed">Jatuh (drape) sangat cantik, cocok untuk daster & kemeja.</p>
                <div class="mt-6 flex items-center justify-between">
                    <span class="text-xs font-bold px-3 py-1 bg-orange-50 text-orange-600 rounded-full">Stok Terbatas</span>
                    <button class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="bg-slate-900 py-24 my-20 rounded-[3.5rem] overflow-hidden mx-6">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-white text-3xl md:text-4xl font-black tracking-tight">Apa Kata <span class="text-teal-400">Partner Kami?</span></h2>
            <p class="text-slate-400 mt-4">Lebih dari 500+ UMKM Fashion tumbuh bersama Nusakain.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-slate-800/50 p-8 rounded-[2rem] border border-slate-700 hover:bg-slate-800 transition-colors">
                <div class="flex text-yellow-400 mb-4">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                <p class="text-slate-300 italic mb-6">"Kualitas kain di Nusakain sangat konsisten. Produksi baju brand saya jadi lebih lancar karena stok selalu aman."</p>
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-teal-500 flex items-center justify-center font-bold text-white">AS</div>
                    <div>
                        <p class="text-white font-bold">Andini Sari</p>
                        <p class="text-slate-500 text-sm">Owner Bloom Fashion</p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800/50 p-8 rounded-[2rem] border border-slate-700 hover:bg-slate-800 transition-colors">
                <div class="flex text-yellow-400 mb-4">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
                <p class="text-slate-300 italic mb-6">"Harga kompetitif banget buat pengusaha pemula seperti saya. Pelayanan adminnya juga ramah dan sangat membantu."</p>
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-indigo-500 flex items-center justify-center font-bold text-white">BP</div>
                    <div>
                        <p class="text-white font-bold">Budi Pratama</p>
                        <p class="text-slate-500 text-sm">Founder UrbanWear</p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800/50 p-8 rounded-[2rem] border border-slate-700 hover:bg-slate-800 transition-colors">
                <div class="flex text-yellow-400 mb-4">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
                <p class="text-slate-300 italic mb-6">"Proses pengiriman cepat dan packing aman. Kain sampai dalam kondisi rapi tanpa cacat sedikitpun. Rekomendasi!"</p>
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-emerald-500 flex items-center justify-center font-bold text-white">RD</div>
                    <div>
                        <p class="text-white font-bold">Rina Diana</p>
                        <p class="text-slate-500 text-sm">Production Manager HijabCo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 mb-20">
    <div class="relative bg-gradient-to-br from-teal-600 to-cyan-700 rounded-[3rem] p-10 md:p-20 overflow-hidden shadow-2xl shadow-teal-200">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-teal-400/20 rounded-full blur-3xl"></div>

        <div class="relative z-10 flex flex-col items-center text-center">
            <h2 class="text-3xl md:text-5xl font-black text-white leading-tight">Siap Membangun Brand <br>Fashion Impian Anda?</h2>
            <p class="mt-6 text-teal-100 text-lg max-w-2xl">Daftar sekarang dan dapatkan akses eksklusif ke katalog harga grosir serta konsultasi material kain gratis.</p>
            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="px-10 py-4 bg-white text-teal-600 rounded-2xl font-black hover:bg-gray-100 transition-all shadow-xl active:scale-95">
                    Daftar Akun Gratis
                </a>
                <a href="#" class="px-10 py-4 bg-teal-500 text-white rounded-2xl font-bold border border-teal-400 hover:bg-teal-400 transition-all">
                    Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-6 py-10 opacity-60 grayscale hover:grayscale-0 transition-all duration-700">
    <p class="text-center text-sm font-semibold text-slate-400 uppercase tracking-widest mb-8">Dipercaya oleh berbagai brand fashion</p>
    <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16">
        <span class="text-2xl font-bold text-slate-400 italic">EIGER</span>
        <span class="text-2xl font-bold text-slate-400 italic">ERIGO</span>
        <span class="text-2xl font-bold text-slate-400 italic">THXNSMN</span>
        <span class="text-2xl font-bold text-slate-400 italic">BLOODS</span>
        <span class="text-2xl font-bold text-slate-400 italic">ROUGHNECK</span>
    </div>
</div>
@endsection
