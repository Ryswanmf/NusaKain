@extends('layouts.guest')

@section('title', $page->title . ' - Nusakain Indonesia')

@section('content')
<main class="max-w-4xl mx-auto px-6 py-24">
    <div class="mb-16">
        <h1 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tight leading-tight">
            {{ $page->title }}
        </h1>
        <div class="w-20 h-1.5 bg-teal-500 rounded-full mt-8"></div>
    </div>

    <div class="prose prose-slate prose-lg max-w-none">
        <div class="text-slate-600 leading-relaxed font-medium">
            {!! $page->content !!}
        </div>
    </div>

    <div class="mt-20 pt-10 border-t border-slate-100 flex items-center justify-between">
        <p class="text-xs text-slate-400 font-bold uppercase tracking-widest italic">Terakhir diperbarui: {{ $page->updated_at->format('d F Y') }}</p>
        <a href="/" class="text-sm font-black text-teal-600 hover:text-teal-700 transition-colors flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Beranda
        </a>
    </div>
</main>
@endsection
