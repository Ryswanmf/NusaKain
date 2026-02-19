@extends('layouts.guest')

@section('title', 'Nusakain - Kualitas Kain Terbaik Untuk Bisnis Anda')

@section('content')
<style>
    @keyframes float {
        0% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(2deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
</style>

<main class="max-w-7xl mx-auto px-4 sm:px-6 py-8 md:py-12">
    <div class="bg-white rounded-[2.5rem] md:rounded-[3rem] p-6 md:p-16 border border-gray-100 shadow-sm flex flex-col md:flex-row items-center gap-8 md:gap-12 overflow-hidden">
        
        <div class="flex-1 order-2 md:order-1 animate__animated animate__fadeInLeft text-center md:text-left">
            <span class="inline-block px-4 py-1.5 bg-teal-50 text-teal-600 text-xs md:text-sm font-bold rounded-full mb-4 md:mb-6 animate__animated animate__fadeInDown animate__delay-1s">
                {{ $setting->hero_badge ?? 'Premium Fabric' }}
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight leading-[1.1]">
                {{ $setting->hero_title_primary ?? 'Kualitas Kain Terbaik' }} <br class="hidden sm:block">
                <span class="text-teal-600 italic">{{ $setting->hero_title_italic ?? 'Untuk Bisnis Anda.' }}</span>
            </h1>
            <p class="mt-4 md:mt-6 text-base md:text-lg text-slate-500 max-w-xl mx-auto md:mx-0 leading-relaxed animate__animated animate__fadeInUp animate__delay-1s">
                {{ $setting->hero_description ?? 'Nusakain membantu pengusaha fashion mendapatkan material premium dengan harga kompetitif langsung dari produsen.' }}
            </p>
            
            <div class="mt-8 md:mt-10 flex flex-col sm:flex-row justify-center md:justify-start gap-4 animate__animated animate__fadeInUp animate__delay-1s">
                <a href="{{ $setting->hero_button_primary_url ?? '#' }}" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-teal-600 transition-all shadow-lg shadow-slate-200">
                    {{ $setting->hero_button_primary_text ?? 'Mulai Belanja' }}
                </a>
                <a href="{{ $setting->hero_button_secondary_url ?? '#' }}" class="px-8 py-4 bg-white text-slate-700 border border-gray-200 rounded-2xl font-bold hover:bg-gray-50 transition-all">
                    {{ $setting->hero_button_secondary_text ?? 'Lihat Katalog' }}
                </a>
            </div>
        </div>

        <div class="flex-1 order-1 md:order-2 w-full animate__animated animate__fadeInRight">
            <div class="relative group max-w-sm mx-auto md:max-w-none">
                <div class="absolute -inset-4 bg-teal-100/50 rounded-[2.5rem] blur-2xl group-hover:bg-teal-200/50 transition-colors"></div>
                
                <div class="animate-float">
                    @if($setting && $setting->hero_image)
                        <img src="{{ asset('storage/' . $setting->hero_image) }}" 
                             alt="Koleksi Kain Nusakain" 
                             class="relative w-full h-[300px] sm:h-[400px] md:h-[500px] object-contain transition-transform duration-500 group-hover:scale-[1.05]">
                    @else
                        <img src="{{ asset('images/hero-landingpage.png') }}" 
                             alt="Koleksi Kain Nusakain" 
                             class="relative w-full h-[300px] sm:h-[400px] md:h-[500px] object-contain transition-transform duration-500 group-hover:scale-[1.05]">
                    @endif
                </div>
                
                <div class="absolute bottom-4 left-4 md:bottom-6 md:left-6 bg-white/90 backdrop-blur px-4 py-2 md:px-5 md:py-3 rounded-xl md:rounded-2xl shadow-xl border border-white/20 animate__animated animate__bounceIn animate__delay-2s">
                    <p class="text-xs md:text-sm font-bold text-slate-900">100+ Jenis Kain</p>
                    <p class="text-[10px] md:text-xs text-slate-500 font-medium">Ready Stock Hari Ini</p>
                </div>
            </div>
        </div>

    </div>
</main>

@if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 mb-8">
        <div class="p-5 bg-teal-50 border border-teal-100 text-teal-700 rounded-[2rem] flex items-center shadow-sm animate__animated animate__backInDown">
            <div class="bg-teal-500 p-1.5 rounded-full mr-4 text-white flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span class="font-bold text-sm">{{ session('success') }}</span>
        </div>
    </div>
@endif

<section class="max-w-7xl mx-auto px-4 sm:px-6 py-16 md:py-24">
    <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-10 md:mb-12 gap-6 text-center md:text-left">
        <div>
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight leading-tight">Eksplorasi Koleksi <br class="hidden md:block"><span class="text-teal-600">Kain Terpopuler</span></h2>
            <p class="mt-4 text-slate-500 max-w-md mx-auto md:mx-0">Pilih material terbaik yang dirancang khusus untuk meningkatkan nilai estetika brand fashion Anda.</p>
        </div>
        <a href="{{ route('produk.index') }}" class="group flex items-center space-x-2 text-teal-600 font-bold hover:text-teal-700 transition-colors">
            <span>Lihat Semua Kategori</span>
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
        @forelse($featuredProducts as $product)
            <div class="group relative bg-white rounded-[2.5rem] p-4 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="aspect-square rounded-[2rem] overflow-hidden bg-gray-100 mb-6">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-50">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                </div>
                <div class="px-4 pb-4">
                    <span class="text-[10px] font-black text-teal-600 uppercase tracking-widest">{{ $product->category ?? 'Kain' }}</span>
                    <h3 class="text-lg font-black text-slate-900 mt-1 line-clamp-1">{{ $product->name }}</h3>
                    <p class="text-sm text-slate-500 mt-2 italic leading-relaxed line-clamp-2">{{ Str::limit($product->description, 60) }}</p>
                    <div class="mt-6 flex items-center justify-between">
                        <span class="text-sm font-black text-slate-900">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                        <div class="flex items-center space-x-2">
                            @auth
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="w-10 h-10 bg-teal-600 text-white rounded-full flex items-center justify-center hover:bg-teal-700 transition-colors shadow-lg shadow-teal-100 active:scale-90">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    </button>
                                </form>
                            @endauth
                            <a href="{{ route('produk.show', $product->slug) }}" class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center">
                <p class="text-slate-400 font-bold italic">Belum ada produk unggulan.</p>
            </div>
        @endforelse
    </div>
</section>

<section class="bg-slate-900 py-16 md:py-24 my-12 md:my-20 rounded-[2.5rem] md:rounded-[3.5rem] overflow-hidden mx-4 md:mx-6">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-white text-3xl md:text-4xl font-black tracking-tight">Apa Kata <span class="text-teal-400">Partner Kami?</span></h2>
            <p class="text-slate-400 mt-4">Lebih dari 500+ UMKM Fashion tumbuh bersama Nusakain.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            @forelse($testimonials as $t)
                <div class="bg-slate-800/50 p-8 rounded-[2rem] border border-slate-700 hover:bg-slate-800 transition-colors">
                    <div class="flex text-yellow-400 mb-4">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-slate-300 italic mb-6">"{{ $t->content }}"</p>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-full bg-{{ $t->avatar_color }}-500 flex items-center justify-center font-bold text-white uppercase">{{ $t->avatar_text ?? substr($t->name, 0, 2) }}</div>
                        <div>
                            <p class="text-white font-bold">{{ $t->name }}</p>
                            <p class="text-slate-500 text-sm">{{ $t->position }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Fallback or empty -->
            @endforelse
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 md:px-6 mb-12 md:mb-20">
    <div class="relative bg-gradient-to-br from-teal-600 to-cyan-700 rounded-[2.5rem] md:rounded-[3rem] p-8 md:p-20 overflow-hidden shadow-2xl shadow-teal-200">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-teal-400/20 rounded-full blur-3xl"></div>

        <div class="relative z-10 flex flex-col items-center text-center">
            <h2 class="text-2xl sm:text-3xl md:text-5xl font-black text-white leading-tight">{{ $setting->cta_title ?? 'Siap Membangun Brand Fashion Impian Anda?' }}</h2>
            <p class="mt-4 md:mt-6 text-teal-100 text-base md:text-lg max-w-2xl">{{ $setting->cta_description ?? 'Daftar sekarang dan dapatkan akses eksklusif ke katalog harga grosir serta konsultasi material kain gratis.' }}</p>
            <div class="mt-8 md:mt-10 flex flex-col sm:flex-row justify-center gap-4 w-full sm:w-auto">
                <a href="{{ $setting->cta_button_url ?? route('register') }}" class="px-10 py-4 bg-white text-teal-600 rounded-2xl font-black hover:bg-gray-100 transition-all shadow-xl active:scale-95">
                    {{ $setting->cta_button_text ?? 'Daftar Akun Gratis' }}
                </a>
                <a href="https://wa.me/6289515915699" class="px-10 py-4 bg-teal-500 text-white rounded-2xl font-bold border border-teal-400 hover:bg-teal-400 transition-all">
                    Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-6 py-8 md:py-10 opacity-60 grayscale hover:grayscale-0 transition-all duration-700">
    <p class="text-center text-sm font-semibold text-slate-400 uppercase tracking-widest mb-8">Dipercaya oleh berbagai brand fashion</p>
    <div class="flex flex-wrap justify-center items-center gap-6 md:gap-16">
        @foreach($partners as $partner)
            <span class="text-xl md:text-2xl font-bold text-slate-400 italic uppercase">{{ $partner->name }}</span>
        @endforeach
        @if($partners->isEmpty())
            <span class="text-xl md:text-2xl font-bold text-slate-400 italic uppercase">EIGER</span>
            <span class="text-xl md:text-2xl font-bold text-slate-400 italic uppercase">ERIGO</span>
            <span class="text-xl md:text-2xl font-bold text-slate-400 italic uppercase">THXNSMN</span>
            <span class="text-xl md:text-2xl font-bold text-slate-400 italic uppercase">BLOODS</span>
            <span class="text-xl md:text-2xl font-bold text-slate-400 italic uppercase">ROUGHNECK</span>
        @endif
    </div>
</div>
@endsection
