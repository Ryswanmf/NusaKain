@extends('layouts.guest')

@section('title', 'Katalog Produk Nusakain - Kualitas Kain Terbaik')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight">Katalog <span class="text-teal-600">Produk</span></h1>
        <p class="mt-4 text-slate-500 max-w-xl">Temukan beragam pilihan kain premium untuk memenuhi segala kebutuhan fashion Anda.</p>
    </div>

    @if($products->isEmpty())
        <div class="bg-white rounded-3xl p-12 text-center border border-gray-100 shadow-sm">
            <div class="w-20 h-20 bg-teal-50 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            </div>
            <h2 class="text-xl font-bold text-slate-900">Belum ada produk tersedia.</h2>
            <p class="text-slate-500 mt-2">Nantikan koleksi terbaru kami segera!</p>
            <a href="/" class="mt-6 inline-block px-8 py-3 bg-teal-600 text-white rounded-xl font-bold hover:bg-teal-700 transition-all">Kembali ke Beranda</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
                <div class="group relative bg-white rounded-[2.5rem] p-4 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="aspect-square rounded-[2rem] overflow-hidden bg-gray-100 mb-6">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400 bg-gray-50">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="px-4 pb-4">
                        <span class="text-xs font-bold text-teal-600 uppercase tracking-wider">{{ $product->category ?? 'Kain' }}</span>
                        <h3 class="text-xl font-bold text-slate-900 mt-1">{{ $product->name }}</h3>
                        <p class="text-2xl font-black text-slate-900 mt-4">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="mt-6 flex items-center justify-between">
                            <span class="text-xs font-bold px-3 py-1 bg-green-50 text-green-600 rounded-full">
                                {{ $product->stock > 0 ? 'Tersedia' : 'Habis' }}
                            </span>
                            <a href="{{ route('produk.show', $product->slug) }}" class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors shadow-lg active:scale-90">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    @endif
</main>
@endsection
