@extends('layouts.guest')

@section('title', 'Katalog Produk Nusakain - Kualitas Kain Terbaik')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
    @if(session('success'))
        <div class="mb-8 p-5 bg-teal-50 border border-teal-100 text-teal-700 rounded-[2rem] flex items-center shadow-sm animate__animated animate__backInDown">
            <div class="bg-teal-500 p-1.5 rounded-full mr-4 text-white flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span class="font-bold text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight">Katalog <span class="text-teal-600">Produk.</span></h1>
        <p class="mt-4 text-slate-500 max-w-xl">Temukan beragam pilihan kain premium untuk memenuhi segala kebutuhan fashion Anda.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Sidebar Filter -->
        <aside class="lg:w-72 flex-shrink-0 space-y-10">
            <form action="{{ route('produk.index') }}" method="GET" class="space-y-10">
                <!-- Search -->
                <div class="space-y-4">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Cari Kain</h3>
                    <div class="relative group">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="w-full pl-5 pr-12 py-4 bg-white border border-slate-100 rounded-2xl shadow-sm focus:ring-2 focus:ring-teal-600 transition-all font-medium text-sm" 
                               placeholder="Contoh: Batik...">
                        <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-teal-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Categories -->
                <div class="space-y-4">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Kategori</h3>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('produk.index', request()->except('category')) }}" 
                           class="px-5 py-3 rounded-xl text-sm font-bold transition-all {{ !request('category') ? 'bg-teal-600 text-white shadow-lg shadow-teal-100' : 'bg-white text-slate-500 hover:bg-slate-50 border border-slate-100' }}">
                            Semua Kain
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('produk.index', array_merge(request()->query(), ['category' => $cat])) }}" 
                               class="px-5 py-3 rounded-xl text-sm font-bold transition-all {{ request('category') == $cat ? 'bg-teal-600 text-white shadow-lg shadow-teal-100' : 'bg-white text-slate-500 hover:bg-slate-50 border border-slate-100' }}">
                                {{ $cat }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Price Filter -->
                <div class="space-y-4">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Rentang Harga</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-full px-4 py-3 bg-white border border-slate-100 rounded-xl text-xs font-bold">
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-full px-4 py-3 bg-white border border-slate-100 rounded-xl text-xs font-bold">
                    </div>
                    <button type="submit" class="w-full py-3 bg-slate-900 text-white rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-teal-600 transition-all">Terapkan Harga</button>
                </div>

                @if(request()->anyFilled(['search', 'category', 'min_price', 'max_price']))
                    <a href="{{ route('produk.index') }}" class="flex items-center justify-center gap-2 w-full py-3 bg-rose-50 text-rose-600 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-rose-100 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        Reset Filter
                    </a>
                @endif
            </form>
        </aside>

        <!-- Product Grid -->
        <div class="flex-1">
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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-10">
            @foreach($products as $product)
                <div class="group bg-white rounded-[3rem] p-5 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 relative">
                    <!-- Image Container -->
                    <div class="aspect-[4/5] rounded-[2.5rem] overflow-hidden bg-slate-100 mb-8 relative">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif

                        <!-- Badges -->
                        <div class="absolute top-5 left-5 flex flex-col gap-2 z-20">
                            @if($product->created_at->diffInDays(now()) <= 7)
                                <span class="bg-teal-600 text-white text-[9px] font-black uppercase tracking-[0.2em] px-4 py-2 rounded-xl shadow-xl shadow-teal-600/30">
                                    Baru
                                </span>
                            @endif
                            @if($product->original_price && $product->original_price > $product->price)
                                @php
                                    $discount = round((($product->original_price - $product->price) / $product->original_price) * 100);
                                @endphp
                                <span class="bg-rose-500 text-white text-[9px] font-black uppercase tracking-[0.2em] px-4 py-2 rounded-xl shadow-xl shadow-rose-500/30">
                                    Hemat {{ $discount }}%
                                </span>
                            @endif
                        </div>

                        <!-- Quick View Overlay -->
                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center gap-3">
                            <a href="{{ route('produk.show', $product->slug) }}" class="w-14 h-14 bg-white text-slate-900 rounded-2xl flex items-center justify-center hover:bg-teal-500 hover:text-white transition-all transform translate-y-10 group-hover:translate-y-0 duration-500 shadow-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c3.477 0 6.517 1.761 8.541 4.419M2.458 12a11.026 11.026 0 001.083 2.081M12 19c-4.477 0-8.268-2.943-9.542-7"/></svg>
                            </a>
                            @auth
                                <button onclick="toggleWishlist(this, {{ $product->id }})" 
                                        class="w-14 h-14 bg-white {{ $inWishlist ?? false ? 'text-rose-500' : 'text-slate-400' }} rounded-2xl flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all transform translate-y-10 group-hover:translate-y-0 duration-500 delay-75 shadow-xl">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                </button>
                            @endauth
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="px-2">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[10px] font-black text-teal-600 uppercase tracking-[0.2em]">{{ $product->category ?? 'Premium Material' }}</span>
                            <div class="flex items-center bg-slate-50 px-2 py-1 rounded-lg">
                                <svg class="w-3 h-3 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <span class="text-[10px] font-black text-slate-400 ml-1">{{ number_format($product->rating, 1) }}</span>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-black text-slate-900 tracking-tight mb-4 group-hover:text-teal-600 transition-colors line-clamp-1 italic">{{ $product->name }}</h3>
                        
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex flex-col">
                                @if($product->original_price && $product->original_price > $product->price)
                                    <span class="text-xs font-bold text-slate-300 line-through tracking-tighter">Rp{{ number_format($product->original_price, 0, ',', '.') }}</span>
                                @endif
                                <span class="text-2xl font-black text-slate-900 italic">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            
                            @auth
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="w-12 h-12 bg-teal-600 text-white rounded-2xl flex items-center justify-center hover:bg-slate-900 transition-all shadow-lg shadow-teal-100 active:scale-90 group/cart">
                                        <svg class="w-6 h-6 transition-transform group-hover/cart:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('produk.show', $product->slug) }}" class="w-12 h-12 bg-slate-100 text-slate-400 rounded-2xl flex items-center justify-center hover:bg-teal-600 hover:text-white transition-all shadow-sm active:scale-90">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                </a>
                            @endauth
                        </div>

                        <div class="mt-6 pt-6 border-t border-slate-50 flex items-center justify-between">
                            <span class="flex items-center text-[9px] font-black uppercase tracking-widest {{ $product->stock > 0 ? 'text-green-500' : 'text-rose-500' }}">
                                <div class="w-1.5 h-1.5 rounded-full mr-2 {{ $product->stock > 0 ? 'bg-green-500' : 'bg-rose-500' }} animate-pulse"></div>
                                {{ $product->stock > 0 ? 'Ready Stock' : 'Out of Stock' }}
                            </span>
                            <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest">{{ (float)$product->stock }} Meter Tersedia</span>
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

@push('scripts')
<script>
    function toggleWishlist(btn, productId) {
        fetch('{{ route('wishlist.toggle') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            const svg = btn.querySelector('svg');
            if (data.status === 'added') {
                btn.classList.remove('bg-white/90', 'text-slate-400');
                btn.classList.add('bg-rose-500', 'text-white');
                svg.setAttribute('fill', 'currentColor');
            } else {
                btn.classList.add('bg-white/90', 'text-slate-400');
                btn.classList.remove('bg-rose-500', 'text-white');
                svg.setAttribute('fill', 'none');
            }
        });
    }
</script>
@endpush
