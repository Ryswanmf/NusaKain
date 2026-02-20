<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Nusakain - Premium Textiles')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Solusi ekosistem tekstil premium untuk pengusaha fashion Indonesia. Kami menyediakan berbagai pilihan kain berkualitas tinggi.')">
    <meta name="keywords" content="@yield('meta_keywords', 'kain premium, tekstil indonesia, supplier kain, batik, linen, denim, katun')">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Nusakain - Premium Textiles')">
    <meta property="og:description" content="@yield('meta_description', 'Solusi ekosistem tekstil premium untuk pengusaha fashion Indonesia.')">
    <meta property="og:image" content="@yield('meta_image', asset('images/hero-landingpage.png'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Nusakain - Premium Textiles')">
    <meta property="twitter:description" content="@yield('meta_description', 'Solusi ekosistem tekstil premium untuk pengusaha fashion Indonesia.')">
    <meta property="twitter:image" content="@yield('meta_image', asset('images/hero-landingpage.png'))">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="pt-24 bg-gray-50/50 font-sans antialiased">

<nav class="bg-white/80 backdrop-blur-md fixed w-full top-0 z-50 border-b border-gray-100/80 shadow-sm">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 h-20">

        <div class="flex-1 flex items-center">
            <a href="/" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 bg-gradient-to-tr from-teal-600 to-cyan-600 rounded-xl flex items-center justify-center shadow-md shadow-teal-200 group-hover:scale-105 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-xl font-extrabold text-slate-900 tracking-tight">Nusakain<span class="text-teal-600">.</span></span>
            </a>
        </div>

        <div class="hidden lg:flex items-center bg-gray-100/50 px-2 py-1.5 rounded-full border border-gray-200/50">
            <a href="/" class="px-5 py-2 text-[13px] font-medium {{ Request::is('/') ? 'text-teal-600 bg-white shadow-sm' : 'text-slate-600 hover:text-teal-600' }} rounded-full transition-all">Beranda</a>
            <a href="{{ route('produk.index') }}" class="px-5 py-2 text-[13px] font-medium {{ Request::routeIs('produk.*') ? 'text-teal-600 bg-white shadow-sm' : 'text-slate-600 hover:text-teal-600' }} rounded-full transition-all">Produk</a>
            <a href="{{ route('portofolio.index') }}" class="px-5 py-2 text-[13px] font-medium {{ Request::routeIs('portofolio.*') ? 'text-teal-600 bg-white shadow-sm' : 'text-slate-600 hover:text-teal-600' }} rounded-full transition-all">Portofolio</a>
            <a href="{{ route('blog.index') }}" class="px-5 py-2 text-[13px] font-medium {{ Request::routeIs('blog.*') ? 'text-teal-600 bg-white shadow-sm' : 'text-slate-600 hover:text-teal-600' }} rounded-full transition-all">Blog</a>
            <a href="{{ route('kontak.index') }}" class="px-5 py-2 text-[13px] font-medium {{ Request::routeIs('kontak.*') ? 'text-teal-600 bg-white shadow-sm' : 'text-slate-600 hover:text-teal-600' }} rounded-full transition-all">Kontak</a>
            <a href="{{ route('tentang.index') }}" class="px-5 py-2 text-[13px] font-medium {{ Request::routeIs('tentang.*') ? 'text-teal-600 bg-white shadow-sm' : 'text-slate-600 hover:text-teal-600' }} rounded-full transition-all">Tentang Kami</a>
        </div>

        <div class="flex-1 flex items-center justify-end space-x-2 md:space-x-4">
            @auth
                <!-- Wishlist Icon -->
                <a href="{{ route('wishlist.index') }}" class="relative p-2 text-slate-400 hover:text-rose-500 transition-colors group">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    @php
                        $wishlistCount = \App\Models\Wishlist::where('user_id', Auth::id())->count();
                    @endphp
                    @if($wishlistCount > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-black leading-none text-white bg-rose-500 rounded-full transform translate-x-1/2 -translate-y-1/2 shadow-sm">{{ $wishlistCount }}</span>
                    @endif
                </a>
            @endauth

            <!-- Shopping Cart Icon -->
            <a href="{{ route('cart.index') }}" id="cart-icon" class="relative p-2 text-slate-400 hover:text-teal-600 transition-all duration-300 group">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                @auth
                    @php
                        $cartCount = \App\Models\CartItem::where('user_id', Auth::id())->sum('quantity');
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-black leading-none text-white bg-teal-500 rounded-full transform translate-x-1/2 -translate-y-1/2 shadow-sm group-hover:scale-110 transition-transform">{{ $cartCount }}</span>
                    @endif
                @endauth
            </a>

            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-2 px-4 py-2 bg-slate-50 text-slate-900 rounded-full font-bold text-sm hover:bg-slate-100 transition-all border border-slate-100">
                            <div class="w-6 h-6 rounded-full bg-teal-500 text-white flex items-center justify-center text-[10px] uppercase">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <span>Profil</span>
                            <svg class="w-4 h-4 text-slate-400 group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-50 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-[60]">
                            <a href="{{ url('/dashboard') }}" class="block px-5 py-2.5 text-sm font-bold text-slate-700 hover:text-teal-600 hover:bg-teal-50 transition-colors">Dashboard</a>
                            <a href="{{ route('customer.orders') }}" class="block px-5 py-2.5 text-sm font-bold text-slate-700 hover:text-teal-600 hover:bg-teal-50 transition-colors">Pesanan Saya</a>
                            <hr class="my-2 border-slate-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-5 py-2.5 text-sm font-bold text-rose-500 hover:bg-rose-50 transition-colors">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-[14px] font-bold text-slate-700 hover:text-teal-600 transition-colors">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-[14px] font-bold text-white bg-teal-600 rounded-full hover:bg-teal-700 transition-all shadow-lg shadow-teal-100 active:scale-95">
                           Daftar Gratis
                        </a>
                    @endif
                @endauth
            </div>

            <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg bg-gray-100 text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="hidden lg:hidden bg-white border-b border-gray-100 px-6 py-6 space-y-4">
        <a href="/" class="block text-base font-semibold {{ Request::is('/') ? 'text-teal-600' : 'text-slate-600' }}">Beranda</a>
        <a href="{{ route('produk.index') }}" class="block text-base font-medium {{ Request::routeIs('produk.*') ? 'text-teal-600' : 'text-slate-600' }}">Produk</a>
        <a href="{{ route('portofolio.index') }}" class="block text-base font-medium {{ Request::routeIs('portofolio.*') ? 'text-teal-600' : 'text-slate-600' }}">Portofolio</a>
        <a href="{{ route('blog.index') }}" class="block text-base font-medium {{ Request::routeIs('blog.*') ? 'text-teal-600' : 'text-slate-600' }}">Blog</a>
        <a href="{{ route('kontak.index') }}" class="block text-base font-medium {{ Request::routeIs('kontak.*') ? 'text-teal-600' : 'text-slate-600' }}">Kontak</a>
        <a href="{{ route('tentang.index') }}" class="block text-base font-medium {{ Request::routeIs('tentang.*') ? 'text-teal-600' : 'text-slate-600' }}">Tentang Kami</a>
        @auth
            <a href="{{ route('wishlist.index') }}" class="block text-base font-medium {{ Request::routeIs('wishlist.*') ? 'text-teal-600' : 'text-slate-600' }}">Koleksi Tersimpan</a>
            <a href="{{ route('customer.orders') }}" class="block text-base font-medium {{ Request::routeIs('customer.orders.*') ? 'text-teal-600' : 'text-slate-600' }}">Pesanan Saya</a>
            <a href="{{ route('cart.index') }}" class="block text-base font-medium {{ Request::routeIs('cart.*') ? 'text-teal-600' : 'text-slate-600' }}">Keranjang Belanja</a>
        @endauth
        <hr>
        <div class="flex flex-col space-y-3">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-center py-3 bg-teal-600 text-white rounded-xl font-bold">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-center font-bold text-slate-700">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-center py-3 bg-teal-600 text-white rounded-xl font-bold">Daftar Sekarang</a>
                @endif
            @endauth
        </div>
    </div>
</nav>

@yield('content')

<footer class="bg-white border-t border-slate-100 pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            <!-- Brand Column -->
            <div class="space-y-6">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-tr from-teal-600 to-cyan-600 rounded-xl flex items-center justify-center shadow-md shadow-teal-200 group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-black text-slate-900 tracking-tight">Nusakain<span class="text-teal-600">.</span></span>
                </a>
                <p class="text-slate-500 text-sm leading-relaxed font-medium">
                    Solusi ekosistem tekstil premium untuk pengusaha fashion Indonesia. Kami menghubungkan tradisi dengan teknologi modern.
                </p>
                <div class="flex items-center space-x-4">
                    <a href="#" class="w-10 h-10 bg-slate-50 text-slate-400 hover:bg-teal-50 hover:text-teal-600 rounded-xl flex items-center justify-center transition-all">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.015 3.253.008 4.741 1.488 4.749 4.742.003 1.266.015 1.646.015 4.85s-.012 3.584-.015 4.85c-.008 3.253-1.488 4.741-4.742 4.749-1.266.003-1.646.015-4.85.015s-3.584-.012-4.85-.015c-3.253-.008-4.741-1.488-4.749-4.742-.003-1.266-.015-1.646-.015-4.85s.012-3.584.015-4.85c.008-3.253 1.488-4.741 4.742-4.749 1.266-.003 1.646-.015 4.85-.015zm0-2.163c-3.259 0-3.66.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.66.072 4.947.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.66-.014 4.947-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.66-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-slate-50 text-slate-400 hover:bg-teal-50 hover:text-teal-600 rounded-xl flex items-center justify-center transition-all">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-slate-900 font-black text-sm uppercase tracking-widest mb-8">Navigasi Cepat</h4>
                <ul class="space-y-4">
                    <li><a href="/" class="text-slate-500 hover:text-teal-600 transition-colors text-sm font-bold">Beranda</a></li>
                    <li><a href="{{ route('produk.index') }}" class="text-slate-500 hover:text-teal-600 transition-colors text-sm font-bold">Katalog Produk</a></li>
                    <li><a href="{{ route('portofolio.index') }}" class="text-slate-500 hover:text-teal-600 transition-colors text-sm font-bold">Portofolio</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-slate-500 hover:text-teal-600 transition-colors text-sm font-bold">Artikel Blog</a></li>
                    <li><a href="{{ route('tentang.index') }}" class="text-slate-500 hover:text-teal-600 transition-colors text-sm font-bold">Tentang Kami</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="text-slate-900 font-black text-sm uppercase tracking-widest mb-8">Bantuan</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('kontak.index') }}" class="text-slate-500 hover:text-teal-600 transition-colors text-sm font-bold">Kontak Kami</a></li>
                    <li><a href="{{ route('pages.show', 'syarat-ketentuan') }}" class="text-slate-500 hover:text-teal-600 transition-colors text-sm font-bold">Syarat & Ketentuan</a></li>
                    <li><a href="{{ route('pages.show', 'kebijakan-privasi') }}" class="text-slate-500 hover:text-teal-600 transition-colors text-sm font-bold">Kebijakan Privasi</a></li>
                    <li><a href="{{ route('faqs.index') }}" class="text-slate-500 hover:text-teal-600 transition-colors text-sm font-bold">FAQ</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-slate-900 font-black text-sm uppercase tracking-widest mb-8">Hubungi Kami</h4>
                <ul class="space-y-5">
                    <li class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-teal-50 text-teal-600 rounded-xl flex-shrink-0 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-black text-slate-400 uppercase tracking-tighter">WhatsApp</span>
                            @php
                                $waNumber = $setting->whatsapp ?? '628123456789';
                                $waUrl = str_contains($waNumber, 'http') ? $waNumber : "https://wa.me/{$waNumber}";
                            @endphp
                            <a href="{{ $waUrl }}" class="text-sm font-bold text-slate-700 hover:text-teal-600 transition-colors">+{{ $waNumber }}</a>
                        </div>
                    </li>
                    <li class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex-shrink-0 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-black text-slate-400 uppercase tracking-tighter">Email</span>
                            <a href="mailto:halo@nusakain.com" class="text-sm font-bold text-slate-700 hover:text-teal-600 transition-colors">halo@nusakain.com</a>
                        </div>
                    </li>
                </ul>
                <div class="flex items-center space-x-4 mt-8">
                    @if($setting->instagram)
                    <a href="{{ $setting->instagram }}" class="w-10 h-10 bg-pink-50 text-pink-600 rounded-xl flex items-center justify-center hover:bg-pink-100 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    @endif
                    @if($setting->facebook)
                    <a href="{{ $setting->facebook }}" class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center hover:bg-indigo-100 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="pt-12 border-t border-slate-50 flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">
                © 2026 Nusakain Indonesia. Seluruh hak cipta dilindungi.
            </p>
            <div class="flex items-center space-x-8">
                <span class="text-xs font-black text-slate-300 uppercase tracking-widest italic">Quality Excellence</span>
                <span class="text-xs font-black text-slate-300 uppercase tracking-widest italic">Sustainable Growth</span>
            </div>
        </div>
    </div>
</footer>

<script>
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    if (btn && menu) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }

    // Animation for adding to cart
    @if(session('success') && (strpos(session('success'), 'berhasil ditambahkan') !== false))
        const cartIcon = document.getElementById('cart-icon');
        if (cartIcon) {
            cartIcon.classList.add('animate__animated', 'animate__bounce');
            cartIcon.style.color = '#0d9488'; // teal-600
            setTimeout(() => {
                cartIcon.classList.remove('animate__animated', 'animate__bounce');
            }, 1000);
        }
    @endif
</script>

    @stack('scripts')
</body>
</html>
