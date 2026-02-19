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

    <div class="mb-12 flex flex-col lg:flex-row lg:items-end justify-between gap-8">
        <div class="min-w-0">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Katalog <span class="text-teal-600">Produk</span></h1>
            <p class="mt-4 text-slate-500 max-w-xl">Temukan beragam pilihan kain premium untuk memenuhi segala kebutuhan fashion Anda.</p>
        </div>

        <form action="{{ route('produk.index') }}" method="GET" class="w-full lg:max-w-2xl">
            <div class="flex flex-col sm:flex-row gap-4">
                <!-- Search Input -->
                <div class="relative flex-1 group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-teal-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="w-full pl-12 pr-6 py-4 bg-white border border-slate-100 rounded-2xl shadow-sm focus:ring-2 focus:ring-teal-600 focus:border-transparent transition-all font-medium text-slate-900 placeholder-slate-400" 
                           placeholder="Cari kain...">
                </div>

                <!-- Category Filter -->
                <div class="relative sm:w-48">
                    <select name="category" onchange="this.form.submit()" 
                            class="w-full px-6 py-4 bg-white border border-slate-100 rounded-2xl shadow-sm focus:ring-2 focus:ring-teal-600 focus:border-transparent transition-all font-bold text-slate-700 appearance-none cursor-pointer">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>

                @if(request()->anyFilled(['search', 'category']))
                    <a href="{{ route('produk.index') }}" class="inline-flex items-center justify-center px-6 py-4 bg-slate-100 text-slate-500 rounded-2xl font-bold hover:bg-rose-50 hover:text-rose-600 transition-all active:scale-95 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </div>
        </form>
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
                <div class="aspect-square rounded-[2rem] overflow-hidden bg-gray-100 mb-6 relative group/img">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-400 bg-gray-50">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif

                    <!-- Wishlist Button Overlay -->
                    @auth
                        @php
                            $inWishlist = \App\Models\Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->exists();
                        @endphp
                        <button onclick="toggleWishlist(this, {{ $product->id }})" 
                                class="absolute top-4 right-4 w-10 h-10 {{ $inWishlist ? 'bg-rose-500 text-white' : 'bg-white/90 text-slate-400' }} backdrop-blur rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-all z-20">
                            <svg class="w-5 h-5" fill="{{ $inWishlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </button>
                    @endauth
                </div>
                    <div class="px-4 pb-4">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-[10px] font-black text-teal-600 uppercase tracking-widest">{{ $product->category ?? 'Kain' }}</span>
                            <div class="flex items-center text-amber-400">
                                <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <span class="text-[10px] font-black ml-1 text-slate-400">{{ number_format($product->rating, 1) }}</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 leading-tight line-clamp-1">{{ $product->name }}</h3>
                        <p class="text-2xl font-black text-slate-900 mt-4">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="mt-6 flex items-center justify-between">
                            <span class="text-xs font-bold px-3 py-1 bg-green-50 text-green-600 rounded-full">
                                {{ $product->stock > 0 ? 'Tersedia' : 'Habis' }}
                            </span>
                            <div class="flex items-center space-x-2">
                                @auth
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="w-10 h-10 bg-teal-600 text-white rounded-full flex items-center justify-center hover:bg-teal-700 transition-colors shadow-lg shadow-teal-100 active:scale-90">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        </button>
                                    </form>
                                @endauth
                                <a href="{{ route('produk.show', $product->slug) }}" class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors shadow-lg active:scale-90">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                </a>
                            </div>
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
