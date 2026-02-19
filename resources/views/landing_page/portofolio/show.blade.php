@extends('layouts.guest')

@section('title', $portfolio->title . ' - Portofolio Nusakain')

@section('meta_description', Str::limit(strip_tags($portfolio->description), 160))
@section('meta_keywords', $portfolio->title . ', ' . $portfolio->client_name . ', portofolio tekstil, kolaborasi brand')
@section('meta_image', $portfolio->image ? asset('storage/' . $portfolio->image) : asset('images/hero-landingpage.png'))

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
    <!-- Breadcrumb -->
    <nav class="flex mb-10" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm font-medium text-slate-400">
            <li class="inline-flex items-center">
                <a href="/" class="hover:text-teal-600 transition-colors">Beranda</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="{{ route('portofolio.index') }}" class="ml-1 md:ml-2 hover:text-teal-600 transition-colors">Portofolio</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 md:ml-2 text-slate-600 truncate max-w-[150px] md:max-w-full">{{ $portfolio->title }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
        <!-- Main Image (Landscape) -->
        <div class="lg:col-span-2 relative group">
            <div class="absolute -inset-4 bg-teal-50 rounded-[3rem] blur-2xl opacity-50 group-hover:bg-teal-100 transition-all duration-500"></div>
            <div class="relative aspect-video rounded-[3rem] overflow-hidden bg-white border border-slate-100 shadow-sm">
                @if($portfolio->image)
                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" 
                         loading="lazy"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-200">
                        <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
            </div>
        </div>

        <!-- Project Meta Info -->
        <div class="space-y-10">
            <div>
                <span class="px-4 py-1.5 bg-teal-50 text-teal-600 text-xs font-black uppercase tracking-widest rounded-full">
                    {{ $portfolio->category ?? 'Fashion Project' }}
                </span>
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight mt-6 leading-tight">
                    {{ $portfolio->title }}
                </h1>
            </div>

            <div class="space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Klien / Partner</span>
                    <span class="text-sm font-bold text-slate-700">{{ $portfolio->client_name ?? 'Nusakain Internal' }}</span>
                </div>
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Waktu Project</span>
                    <span class="text-sm font-bold text-slate-700">{{ $portfolio->project_date ? $portfolio->project_date->format('F Y') : '-' }}</span>
                </div>
            </div>

            <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-slate-100/50">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Narasi Project</h3>
                <p class="text-slate-600 leading-relaxed font-medium italic text-sm">
                    "{!! nl2br(e($portfolio->description)) !!}"
                </p>
            </div>

            <a href="{{ route('kontak.index') }}" class="flex items-center justify-center w-full px-8 py-5 bg-slate-900 text-white rounded-[2rem] font-black text-lg hover:bg-teal-600 transition-all shadow-xl shadow-slate-200 active:scale-95">
                Mulai Kolaborasi
            </a>
        </div>
    </div>
</main>
@endsection
