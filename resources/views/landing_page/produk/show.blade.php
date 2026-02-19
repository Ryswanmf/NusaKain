@extends('layouts.guest')

@section('title', $product->name . ' - Nusakain Premium')

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
                    <a href="{{ route('produk.index') }}" class="ml-1 md:ml-2 hover:text-teal-600 transition-colors">Produk</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 md:ml-2 text-slate-600 truncate max-w-[150px] md:max-w-full">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        <!-- Image Section -->
        <div class="relative group">
            <div class="absolute -inset-4 bg-teal-50 rounded-[3rem] blur-2xl opacity-50 group-hover:bg-teal-100 transition-all duration-500"></div>
            <div class="relative aspect-square rounded-[3rem] overflow-hidden bg-white border border-slate-100 shadow-sm">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-200">
                        <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
            </div>
        </div>

        <!-- Info Section -->
        <div class="flex flex-col justify-center">
            <div class="mb-6">
                <span class="px-4 py-1.5 bg-teal-50 text-teal-600 text-xs font-black uppercase tracking-widest rounded-full">
                    {{ $product->category ?? 'Koleksi Premium' }}
                </span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight leading-tight mb-4">
                {{ $product->name }}
            </h1>

            <div class="flex items-center space-x-4 mb-8">
                <p class="text-3xl font-black text-teal-600 italic">
                    Rp{{ number_format($product->price, 0, ',', '.') }}
                    <span class="text-sm font-bold text-slate-400 not-italic uppercase tracking-tighter">/ Meter</span>
                </p>
                <div class="h-6 w-[1px] bg-slate-200"></div>
                <span class="text-sm font-bold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                    {{ $product->stock > 0 ? 'Stok: ' . $product->stock . ' Meter' : 'Stok Habis' }}
                </span>
            </div>

            <div class="prose prose-slate prose-lg mb-10">
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Deskripsi Produk</h3>
                <p class="text-slate-600 leading-relaxed font-medium">
                    {!! nl2br(e($product->description)) !!}
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="https://wa.me/6289515915699?text=Halo Nusakain, saya tertarik dengan produk {{ $product->name }}. Apakah stok masih tersedia?" 
                   target="_blank"
                   class="flex items-center justify-center px-8 py-5 bg-slate-900 text-white rounded-[2rem] font-black text-lg hover:bg-teal-600 transition-all shadow-xl shadow-slate-200 hover:shadow-teal-100 active:scale-95">
                    <svg class="w-6 h-6 mr-3 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.353-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.13.57-.074 1.758-.716 2.003-1.408.245-.693.245-1.287.172-1.408-.074-.122-.272-.196-.57-.346zM12 0C5.373 0 0 5.373 0 12c0 2.123.55 4.12 1.511 5.86L0 24l6.337-1.663C8.03 23.35 10.027 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.897 0-3.749-.512-5.352-1.48l-.385-.233-3.746.982.998-3.65-.255-.406C2.272 15.627 1.5 13.854 1.5 12c0-5.79 4.71-10.5 10.5-10.5 5.79 0 10.5 4.71 10.5 10.5S17.79 22.5 12 22.5z"/></svg>
                    Tanya Admin
                </a>
                <button class="flex items-center justify-center px-8 py-5 bg-white text-slate-700 border border-slate-200 rounded-[2rem] font-black text-lg hover:bg-slate-50 transition-all active:scale-95">
                    Simpan Produk
                </button>
            </div>

            <div class="mt-12 flex items-center space-x-8 p-6 bg-slate-50 rounded-[2rem] border border-slate-100/50">
                <div class="flex flex-col">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pengiriman</span>
                    <span class="text-xs font-bold text-slate-700 mt-1">Seluruh Indonesia</span>
                </div>
                <div class="h-8 w-[1px] bg-slate-200"></div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Garansi</span>
                    <span class="text-xs font-bold text-slate-700 mt-1">Kualitas Premium</span>
                </div>
                <div class="h-8 w-[1px] bg-slate-200"></div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pembayaran</span>
                    <span class="text-xs font-bold text-slate-700 mt-1">Transfer Bank</span>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
