@extends('layouts.guest')

@section('title', 'Produk Tersimpan - Nusakain')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12 md:py-24">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight">Koleksi <span class="text-rose-500">Tersimpan.</span></h1>
        <p class="mt-4 text-slate-500 font-medium">Daftar kain pilihan Anda untuk referensi belanja mendatang.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($wishlistItems as $item)
            <div class="group relative bg-white rounded-[2.5rem] p-4 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="aspect-square rounded-[2rem] overflow-hidden bg-gray-100 mb-6 relative">
                    @if($item->product->image)
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-50">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                    
                    <!-- Remove Button -->
                    <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" class="absolute top-4 right-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-10 h-10 bg-white/90 backdrop-blur text-rose-500 rounded-full flex items-center justify-center shadow-lg hover:bg-rose-500 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                        </button>
                    </form>
                </div>
                
                <div class="px-4 pb-4">
                    <span class="text-[10px] font-black text-teal-600 uppercase tracking-widest">{{ $item->product->category }}</span>
                    <h3 class="text-lg font-black text-slate-900 mt-1 line-clamp-1">{{ $item->product->name }}</h3>
                    <p class="text-sm font-black text-slate-900 mt-2">Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                    
                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('produk.show', $item->product->slug) }}" class="flex-1 text-center py-3 bg-slate-900 text-white rounded-xl font-bold text-xs hover:bg-teal-600 transition-all">Detail</a>
                        <form action="{{ route('cart.store') }}" method="POST" class="flex-shrink-0">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                            <button type="submit" class="w-10 h-10 bg-teal-50 text-teal-600 rounded-xl flex items-center justify-center hover:bg-teal-600 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-[3rem] p-16 text-center border border-gray-100 shadow-sm">
                <div class="w-20 h-20 bg-slate-50 text-slate-200 rounded-[2rem] flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Belum ada koleksi tersimpan.</h3>
                <p class="mt-2 text-slate-500 font-medium mb-8">Klik ikon hati pada produk untuk menyimpannya di sini.</p>
                <a href="{{ route('produk.index') }}" class="px-10 py-4 bg-teal-600 text-white rounded-2xl font-black hover:bg-teal-700 transition-all shadow-xl shadow-teal-100">Jelajahi Produk</a>
            </div>
        @endforelse
    </div>
</main>
@endsection
