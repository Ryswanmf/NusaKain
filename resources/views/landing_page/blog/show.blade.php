@extends('layouts.guest')

@section('title', $post->title . ' - Blog Nusakain')

@section('meta_description', Str::limit(strip_tags($post->content), 160))
@section('meta_keywords', $post->title . ', ' . $post->category . ', blog tekstil, tips fashion, nusakain')
@section('meta_image', $post->image ? asset('storage/' . $post->image) : asset('images/hero-landingpage.png'))

@section('content')
<main class="max-w-4xl mx-auto px-6 py-12">
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
                    <a href="{{ route('blog.index') }}" class="ml-1 md:ml-2 hover:text-teal-600 transition-colors">Blog</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 md:ml-2 text-slate-600 truncate max-w-[150px] md:max-w-full">{{ $post->title }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <article>
        <div class="mb-12">
            <span class="inline-block px-4 py-1.5 bg-teal-50 text-teal-600 text-xs font-black uppercase tracking-widest rounded-full mb-6">
                {{ $post->category ?? 'Wawasan Tekstil' }}
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tight leading-tight mb-8">
                {{ $post->title }}
            </h1>
            <div class="flex items-center space-x-4 text-sm font-bold text-slate-400 uppercase tracking-widest">
                <span>{{ $post->published_at ? $post->published_at->format('d F Y') : $post->created_at->format('d F Y') }}</span>
                <span class="w-1.5 h-1.5 bg-slate-200 rounded-full"></span>
                <span>Nusakain Editor</span>
            </div>
        </div>

        <div class="relative group mb-16">
            <div class="absolute -inset-4 bg-teal-50 rounded-[3rem] blur-2xl opacity-50"></div>
            <div class="relative aspect-video rounded-[3.5rem] overflow-hidden shadow-sm border border-slate-100">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" loading="lazy" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
            </div>
        </div>

        <div class="prose prose-slate prose-lg max-w-none">
            <div class="text-slate-600 leading-relaxed font-medium space-y-6">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>
    </article>

    <div class="mt-24 pt-12 border-t border-slate-100">
        <div class="bg-slate-50 p-12 rounded-[3.5rem] text-center">
            <h3 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">Ingin informasi kain lainnya?</h3>
            <p class="text-slate-500 font-medium mb-8 max-w-md mx-auto text-lg">Hubungi tim ahli kami untuk konsultasi pemilihan material terbaik bagi brand Anda.</p>
            <a href="https://wa.me/6289515915699" target="_blank" class="inline-flex items-center justify-center px-10 py-4 bg-teal-600 text-white rounded-2xl font-black hover:bg-teal-700 transition-all shadow-xl shadow-teal-100">
                Tanya Lewat WhatsApp
            </a>
        </div>
    </div>
</main>
@endsection
