@extends('layouts.guest')

@section('title', $portfolio->title . ' - Portofolio Nusakain')

@section('meta_description', Str::limit(strip_tags($portfolio->description), 160))
@section('meta_keywords', $portfolio->title . ', ' . $portfolio->client_name . ', portofolio tekstil, kolaborasi brand')
@section('meta_image', $portfolio->image ? asset('storage/' . $portfolio->image) : asset('images/hero-landingpage.png'))

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12 md:py-24">
    <!-- Breadcrumb -->
    <nav class="flex mb-12" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
            <li class="inline-flex items-center">
                <a href="/" class="hover:text-teal-600 transition-colors">Beranda</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    <a href="{{ route('portofolio.index') }}" class="ml-1 md:ml-2 hover:text-teal-600 transition-colors">Portofolio</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center text-teal-600">
                    <svg class="w-3 h-3 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    <span class="ml-1 md:ml-2 truncate max-w-[150px] md:max-w-full">{{ $portfolio->title }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 lg:gap-24">
        <!-- Main Image Area -->
        <div class="lg:col-span-2 space-y-12">
            <div class="relative group">
                <div class="absolute -inset-4 bg-teal-50 rounded-[3.5rem] blur-2xl opacity-50 group-hover:bg-teal-100 transition-all duration-700"></div>
                <div class="relative aspect-[16/10] rounded-[3rem] overflow-hidden bg-white border border-slate-100 shadow-2xl">
                    @if($portfolio->image)
                        <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" 
                             loading="lazy"
                             class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-200">
                            <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Narrative Content -->
            <div class="bg-white p-10 md:p-16 rounded-[4rem] border border-slate-50 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-teal-50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                
                <h2 class="text-[10px] font-black text-teal-600 uppercase tracking-[0.4em] mb-8 flex items-center gap-4">
                    Narasi Project
                    <div class="h-px flex-1 bg-teal-100/50"></div>
                </h2>
                
                <div class="prose prose-slate max-w-none">
                    <p class="text-slate-600 leading-[1.8] font-medium text-xl italic tracking-tight">
                        "{!! nl2br(e($portfolio->description)) !!}"
                    </p>
                </div>
            </div>
        </div>

        <!-- Sticky Meta Info -->
        <div class="lg:sticky lg:top-32 h-fit space-y-12">
            <div>
                <span class="px-5 py-2 bg-teal-50 text-teal-600 text-[10px] font-black uppercase tracking-[0.2em] rounded-xl border border-teal-100">
                    {{ $portfolio->category ?? 'Material Showcase' }}
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter mt-8 leading-[1.1] italic">
                    {{ $portfolio->title }}
                </h1>
            </div>

            <div class="space-y-8 py-10 border-y border-slate-100">
                <div class="flex items-center justify-between">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Klien / Partner</span>
                        <span class="text-lg font-black text-slate-900 mt-1 tracking-tight uppercase">{{ $portfolio->client_name ?? 'Nusakain Internal' }}</span>
                    </div>
                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H5a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5"/></svg>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Waktu Project</span>
                        <span class="text-lg font-black text-slate-900 mt-1 tracking-tight">{{ $portfolio->project_date ? $portfolio->project_date->format('F Y') : '-' }}</span>
                    </div>
                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <a href="{{ route('kontak.index') }}" class="group relative flex items-center justify-center w-full px-8 py-6 bg-slate-900 text-white rounded-[2.2rem] font-black text-xl hover:bg-teal-600 transition-all duration-500 shadow-2xl shadow-slate-900/20 active:scale-95 overflow-hidden">
                    <span class="relative z-10 flex items-center">
                        Mulai Kolaborasi
                        <svg class="w-6 h-6 ml-3 group-hover:translate-x-2 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </span>
                </a>
                <p class="text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
                    Wujudkan visi brand fashion Anda bersama material premium kami.
                </p>
            </div>
        </div>
    </div>

    <!-- Related Portfolios -->
    @if($relatedPortfolios->count() > 0)
        <section class="mt-40">
            <div class="flex items-center justify-between mb-16">
                <div>
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight italic">Eksplorasi <span class="text-teal-600">Lainnya.</span></h2>
                    <p class="text-slate-400 font-bold mt-2 uppercase text-[10px] tracking-[0.2em]">Kolaborasi brand fashion pilihan lainnya</p>
                </div>
                <a href="{{ route('portofolio.index') }}" class="px-6 py-3 bg-slate-50 text-slate-900 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-teal-600 hover:text-white transition-all">Lihat Semua</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($relatedPortfolios as $related)
                    <a href="{{ route('portofolio.show', $related->slug) }}" class="group block space-y-6">
                        <div class="relative aspect-[16/10] rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-700">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            @endif
                            <div class="absolute inset-0 bg-slate-900/20 group-hover:bg-slate-900/0 transition-colors duration-500"></div>
                        </div>
                        <div class="px-2">
                            <span class="text-[9px] font-black text-teal-600 uppercase tracking-[0.2em]">{{ $related->category }}</span>
                            <h3 class="text-xl font-black text-slate-900 mt-2 group-hover:text-teal-600 transition-colors italic tracking-tight">{{ $related->title }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</main>
@endsection
