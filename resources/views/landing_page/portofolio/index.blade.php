@extends('layouts.app')

@section('title', 'Portofolio Nusakain - Kolaborasi & Proyek Kami')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight">Portofolio <span class="text-teal-600">Proyek</span></h1>
        <p class="mt-4 text-slate-500 max-w-xl">Melihat jejak kolaborasi Nusakain dengan berbagai brand fashion dan desainer ternama.</p>
    </div>

    @if($portfolios->isEmpty())
        <div class="bg-white rounded-3xl p-12 text-center border border-gray-100 shadow-sm">
            <div class="w-20 h-20 bg-teal-50 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <h2 class="text-xl font-bold text-slate-900">Belum ada portofolio tersedia.</h2>
            <p class="text-slate-500 mt-2">Kami sedang merangkum proyek-proyek menarik kami!</p>
            <a href="/" class="mt-6 inline-block px-8 py-3 bg-teal-600 text-white rounded-xl font-bold hover:bg-teal-700 transition-all">Kembali ke Beranda</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($portfolios as $portfolio)
                <div class="group relative bg-white rounded-[3rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500">
                    <div class="aspect-[4/3] overflow-hidden">
                        @if($portfolio->image)
                            <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-gray-50 flex items-center justify-center text-slate-300">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-4 py-1.5 bg-teal-50 text-teal-600 text-[10px] font-black uppercase tracking-widest rounded-full">
                                {{ $portfolio->category ?? 'General' }}
                            </span>
                            <span class="text-slate-400 text-xs font-semibold uppercase tracking-widest">
                                {{ $portfolio->project_date ? $portfolio->project_date->format('M Y') : '' }}
                            </span>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 leading-tight group-hover:text-teal-600 transition-colors">{{ $portfolio->title }}</h3>
                        <p class="mt-3 text-slate-500 text-sm leading-relaxed line-clamp-2">{{ $portfolio->description }}</p>
                        
                        @if($portfolio->client_name)
                        <div class="mt-6 pt-6 border-t border-gray-50 flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Klien</p>
                                <p class="text-sm font-bold text-slate-900">{{ $portfolio->client_name }}</p>
                            </div>
                            <a href="{{ route('portofolio.show', $portfolio->slug) }}" class="p-3 bg-gray-50 text-slate-900 rounded-2xl group-hover:bg-teal-600 group-hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-12">
            {{ $portfolios->links() }}
        </div>
    @endif
</main>
@endsection
