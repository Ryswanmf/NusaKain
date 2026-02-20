@extends('layouts.guest')

@section('title', 'Tentang Kami - Nusakain Indonesia')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
    <!-- Hero Section -->
    <div class="mb-24 text-center">
        <span class="inline-block px-4 py-1.5 bg-teal-50 text-teal-600 text-sm font-bold rounded-full mb-6">Cerita Kami</span>
        <h1 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tight leading-tight">
            Menghubungkan <span class="text-teal-600 italic">Tradisi</span> <br>
            dengan <span class="text-teal-600 italic">Modernitas.</span>
        </h1>
        <p class="mt-8 text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed">
            Nusakain lahir dari keinginan untuk memberdayakan industri fashion lokal melalui penyediaan material tekstil berkualitas tinggi yang berkelanjutan.
        </p>
    </div>

    <!-- Vision & Mission -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-32">
        <div class="bg-white p-12 rounded-[3rem] border border-gray-100 shadow-sm">
            <div class="w-14 h-14 bg-teal-600 text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-teal-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </div>
            <h2 class="text-2xl font-black text-slate-900 mb-4">Visi Kami</h2>
            <p class="text-slate-500 leading-relaxed">Menjadi platform ekosistem tekstil terpercaya di Asia Tenggara yang menghubungkan pengrajin lokal dengan pasar global melalui inovasi dan kualitas.</p>
        </div>
        <div class="bg-white p-12 rounded-[3rem] border border-gray-100 shadow-sm">
            <div class="w-14 h-14 bg-slate-900 text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h2 class="text-2xl font-black text-slate-900 mb-4">Misi Kami</h2>
            <p class="text-slate-500 leading-relaxed">Menyediakan material kain premium, mendukung pertumbuhan UMKM fashion, dan mengedukasi masyarakat tentang keberlanjutan industri tekstil.</p>
        </div>
    </div>

    <!-- Team Section -->
    <div class="mb-24">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-black text-slate-900">Tim di Balik <span class="text-teal-600">Nusakain</span></h2>
            <p class="mt-4 text-slate-500">Kombinasi antara keahlian tradisional dan semangat inovasi muda.</p>
        </div>

        @if($team->isEmpty())
            <div class="text-center p-20 bg-gray-50 rounded-[3rem] border border-dashed border-gray-200">
                <p class="text-slate-400 font-bold italic">Sedang mengumpulkan foto tim terbaik kami!</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($team as $member)
                    <div class="group text-center">
                        <div class="aspect-square rounded-[3rem] overflow-hidden mb-6 bg-gray-100 shadow-sm">
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-xl font-black text-slate-900">{{ $member->name }}</h3>
                        <p class="text-sm font-bold text-teal-600 uppercase tracking-widest mt-1">{{ $member->position }}</p>
                        @if($member->bio)
                            <p class="mt-4 text-slate-500 text-sm leading-relaxed px-4">{{ $member->bio }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Stats -->
    <div class="bg-slate-900 rounded-[4rem] p-12 md:p-20 text-center text-white">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div>
                <p class="text-5xl font-black text-teal-400">10+</p>
                <p class="mt-3 text-slate-400 font-bold uppercase tracking-widest text-sm">Tahun Pengalaman</p>
            </div>
            <div>
                <p class="text-5xl font-black text-teal-400">500+</p>
                <p class="mt-3 text-slate-400 font-bold uppercase tracking-widest text-sm">UMKM Terbantu</p>
            </div>
            <div>
                <p class="text-5xl font-black text-teal-400">100k+</p>
                <p class="mt-3 text-slate-400 font-bold uppercase tracking-widest text-sm">Meter Kain Terjual</p>
            </div>
        </div>
    </div>
</main>
@endsection
