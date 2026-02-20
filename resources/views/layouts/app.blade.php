<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', $title ?? 'Nusakain - Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50/50 font-sans antialiased text-slate-900">

<div class="flex min-h-screen">
    @auth
        <!-- SIDEBAR -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl lg:shadow-none">
            <div class="flex flex-col h-full">
                <!-- Brand -->
                <div class="p-8 flex items-center justify-between">
                    <a href="/" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 bg-gradient-to-tr from-teal-400 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg shadow-teal-900/20 group-hover:scale-105 transition-transform duration-300">
                            <svg class="w-5 h-5 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-black tracking-tight">Nusakain<span class="text-teal-400">.</span></span>
                    </a>
                    <!-- Mobile Close Button -->
                    <button id="sidebar-close" class="lg:hidden p-2 text-slate-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Nav Links -->
                <nav class="flex-1 px-6 space-y-2 overflow-y-auto pb-8">
                    <p class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4">Utama</p>
                    
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('dashboard') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.produk.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('admin.produk.*') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span>Produk</span>
                    </a>

                    <a href="{{ route('admin.pesanan.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('admin.pesanan.*') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        <span>Pesanan</span>
                    </a>

                    <a href="{{ route('admin.portofolio.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('admin.portofolio.*') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        <span>Portofolio</span>
                    </a>

                    <a href="{{ route('admin.blog.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('admin.blog.*') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <span>Blog</span>
                    </a>

                    <a href="{{ route('admin.kontak.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('admin.kontak.*') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Pesan Masuk</span>
                    </a>

                    <a href="{{ route('admin.tentang-kami.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('admin.tentang-kami.*') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Tentang Kami</span>
                    </a>

                    <p class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mt-8 mb-4">Halaman Depan</p>

                    <a href="{{ route('admin.landing.hero') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('admin.landing.hero') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span>Hero & CTA</span>
                    </a>

                    <a href="{{ route('admin.landing.testimonials.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('admin.landing.testimonials.*') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        <span>Testimoni</span>
                    </a>

                    <a href="{{ route('admin.landing.partners.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('admin.landing.partners.*') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H5a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5"/></svg>
                        <span>Partner</span>
                    </a>

                    <a href="{{ route('admin.landing.pages.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('admin.landing.pages.*') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Legal</span>
                    </a>

                    <a href="{{ route('admin.landing.faqs.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('admin.landing.faqs.*') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>FAQ</span>
                    </a>

                    <p class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mt-8 mb-4">Pengaturan</p>

                    <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('admin.users.*') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>Kelola Pengguna</span>
                    </a>

                    <a href="{{ route('admin.landing.hero') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('admin.landing.hero') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Pengaturan Beranda</span>
                    </a>

                    <div class="h-[1px] bg-slate-800 my-4 mx-4"></div>

                    <a href="/riswan" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-slate-500 hover:bg-teal-500 hover:text-slate-900 transition-all font-black text-[10px] uppercase tracking-widest border border-slate-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span>Dashboard Filament</span>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl {{ Request::routeIs('profile.edit') ? 'bg-teal-500 text-slate-900 shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <span>Profil</span>
                    </a>
                </nav>

                <!-- User Profile Bottom -->
                <div class="p-6 border-t border-slate-800/50">
                    <div class="flex items-center justify-between p-4 bg-slate-800/50 rounded-2xl">
                        <div class="flex items-center space-x-3 min-w-0">
                            <div class="w-8 h-8 rounded-full bg-teal-500 flex items-center justify-center font-bold text-slate-900 text-xs uppercase flex-shrink-0">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="flex flex-col overflow-hidden">
                                <span class="text-xs font-bold truncate">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] text-slate-500 truncate">Admin</span>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0 ml-2">
                            @csrf
                            <button type="submit" class="text-slate-400 hover:text-red-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>
    @endauth

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 @auth lg:ml-72 @endauth flex flex-col min-w-0 overflow-hidden transition-all duration-300">
        @auth
            <!-- TOP HEADER -->
            <header class="h-16 md:h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-4 md:px-8 sticky top-0 z-40">
                <div class="flex items-center min-w-0 flex-1">
                    <button id="sidebar-toggle" class="lg:hidden p-2 -ml-2 mr-2 rounded-lg bg-gray-50 text-slate-600 hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                    </button>
                    <div class="min-w-0 truncate">
                        @if (isset($header))
                            <div class="text-sm md:text-base">
                                {{ $header }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center space-x-2 md:space-x-4 ml-4 flex-shrink-0">
                    <button class="hidden sm:flex p-2 rounded-xl text-slate-400 hover:bg-gray-50 hover:text-teal-600 transition-all">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></button>
                    <div class="hidden xs:block h-6 md:h-8 w-[1px] bg-gray-100 mx-1"></div>
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center font-black text-slate-400 text-xs md:text-sm uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>
        @endauth

        <!-- PAGE CONTENT -->
        <div class="p-4 md:p-8">
            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </main>
</div>

<!-- Mobile Backdrop -->
<div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 hidden transition-opacity duration-300"></div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebar-toggle');
        const close = document.getElementById('sidebar-close');
        const overlay = document.getElementById('sidebar-overlay');

        if (sidebar && toggle && overlay) {
            const openSidebar = () => {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            };

            const hideSidebar = () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            };

            toggle.addEventListener('click', openSidebar);
            if (close) close.addEventListener('click', hideSidebar);
            overlay.addEventListener('click', hideSidebar);
        }
    });
</script>

    @stack('scripts')
</body>
</html>
