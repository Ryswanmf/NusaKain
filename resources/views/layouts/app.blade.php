<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Nusakain - Modern Navbar')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="pt-24 bg-gray-50/50">

<nav class="bg-white/80 backdrop-blur-md fixed w-full top-0 z-50 border-b border-gray-100/80">
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

        <div class="hidden md:flex items-center bg-gray-100/50 px-2 py-1.5 rounded-full border border-gray-200/50">
            <a href="/" class="px-5 py-2 text-[14px] font-medium {{ Request::is('/') ? 'text-teal-600 bg-white shadow-sm' : 'text-slate-600 hover:text-teal-600' }} rounded-full transition-all">Beranda</a>
            <a href="{{ route('produk.index') }}" class="px-5 py-2 text-[14px] font-medium {{ Request::routeIs('produk.*') ? 'text-teal-600 bg-white shadow-sm' : 'text-slate-600 hover:text-teal-600' }} rounded-full transition-all">Produk</a>
            <a href="{{ route('portofolio.index') }}" class="px-5 py-2 text-[14px] font-medium {{ Request::routeIs('portofolio.*') ? 'text-teal-600 bg-white shadow-sm' : 'text-slate-600 hover:text-teal-600' }} rounded-full transition-all">Portofolio</a>
            <a href="{{ route('blog.index') }}" class="px-5 py-2 text-[14px] font-medium {{ Request::routeIs('blog.*') ? 'text-teal-600 bg-white shadow-sm' : 'text-slate-600 hover:text-teal-600' }} rounded-full transition-all">Blog</a>
            <a href="{{ route('kontak.index') }}" class="px-5 py-2 text-[14px] font-medium {{ Request::routeIs('kontak.*') ? 'text-teal-600 bg-white shadow-sm' : 'text-slate-600 hover:text-teal-600' }} rounded-full transition-all">Kontak</a>
            <a href="{{ route('tentang.index') }}" class="px-5 py-2 text-[14px] font-medium {{ Request::routeIs('tentang.*') ? 'text-teal-600 bg-white shadow-sm' : 'text-slate-600 hover:text-teal-600' }} rounded-full transition-all">Tentang Kami</a>
        </div>

        <div class="flex-1 flex items-center justify-end space-x-4">
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-[14px] font-bold text-slate-700 hover:text-teal-600 transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-[14px] font-bold text-slate-700 hover:text-teal-600 transition-colors">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-[14px] font-bold text-white bg-teal-600 rounded-full hover:bg-teal-700 transition-all shadow-lg shadow-teal-100 active:scale-95">
                           Daftar Gratis
                        </a>
                    @endif
                @endauth
            </div>

            <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg bg-gray-100 text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-gray-100 px-6 py-6 space-y-4">
        <a href="#" class="block text-base font-semibold text-teal-600">Beranda</a>
        <a href="#" class="block text-base font-medium text-slate-600">Produk</a>
        <a href="#" class="block text-base font-medium text-slate-600">Portofolio</a>
        <a href="#" class="block text-base font-medium text-slate-600">Blog</a>
        <a href="#" class="block text-base font-medium text-slate-600">Kontak</a>
        <a href="#" class="block text-base font-medium text-slate-600">Tentang Kami</a>
        <hr>
        <div class="flex flex-col space-y-3">
            <a href="#" class="text-center font-bold text-slate-700">Log in</a>
            <a href="#" class="text-center py-3 bg-teal-600 text-white rounded-xl font-bold">Daftar Sekarang</a>
        </div>
    </div>
</nav>

@yield('content')

<footer class="mt-20 border-t border-gray-100 bg-white py-12">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-teal-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <span class="font-bold text-slate-900">Nusakain.</span>
        </div>
        <p class="text-slate-500 text-sm">© 2026 Nusakain Indonesia. All rights reserved.</p>
        <div class="flex space-x-6">
            <a href="#" class="text-slate-400 hover:text-teal-600 transition-colors">Instagram</a>
            <a href="#" class="text-slate-400 hover:text-teal-600 transition-colors">WhatsApp</a>
        </div>
    </div>
</footer>

<script>
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>

</body>
</html>
