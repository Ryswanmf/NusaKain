@extends('layouts.guest')

@section('title', $product->name . ' - Nusakain Premium')

@section('meta_description', Str::limit(strip_tags($product->description), 160))
@section('meta_keywords', $product->name . ', ' . $product->category . ', kain premium, tekstil nusakain')
@section('meta_image', $product->image ? asset('storage/' . $product->image) : asset('images/hero-landingpage.png'))

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
            <div class="relative aspect-square rounded-[3rem] overflow-hidden bg-white border border-slate-100 shadow-sm mb-6">
                @if($product->image)
                    <a href="{{ asset('storage/' . $product->image) }}" class="glightbox" data-gallery="product-gallery">
                        <img id="main-image" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                             loading="lazy"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute bottom-6 right-6 w-12 h-12 bg-white/90 backdrop-blur rounded-2xl flex items-center justify-center text-slate-400 opacity-0 group-hover:opacity-100 transition-all shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                        </div>
                    </a>
                @else
                    <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-200">
                        <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
            </div>

            <!-- Gallery Thumbnails -->
            @if($product->gallery && count($product->gallery) > 0)
                <div class="grid grid-cols-4 gap-4 px-2">
                    <div onclick="changeImage('{{ asset('storage/' . $product->image) }}')" class="aspect-square rounded-2xl overflow-hidden border-2 border-teal-500 cursor-pointer transition-all hover:opacity-80">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                    </div>
                    @foreach($product->gallery as $galleryImg)
                        <div onclick="changeImage('{{ asset('storage/' . $galleryImg) }}')" class="aspect-square rounded-2xl overflow-hidden border-2 border-transparent hover:border-teal-500 cursor-pointer transition-all hover:opacity-80">
                            <img src="{{ asset('storage/' . $galleryImg) }}" class="w-full h-full object-cover">
                            <!-- Hidden Link for Lightbox Gallery -->
                            <a href="{{ asset('storage/' . $galleryImg) }}" class="glightbox hidden" data-gallery="product-gallery"></a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Info Section -->
        <div class="flex flex-col justify-center">
            <div class="mb-6 flex items-center justify-between lg:justify-start lg:space-x-6">
                <span class="px-4 py-1.5 bg-teal-50 text-teal-600 text-xs font-black uppercase tracking-widest rounded-full">
                    {{ $product->category ?? 'Koleksi Premium' }}
                </span>
                <div class="flex items-center text-amber-400">
                    @for($i=0; $i<5; $i++)
                        <svg class="w-4 h-4 {{ $i < floor($product->rating) ? 'fill-current' : 'text-slate-200 fill-current' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                    <span class="text-sm font-black ml-2 text-slate-400">{{ number_format($product->rating, 1) }}</span>
                </div>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight leading-tight mb-4">
                {{ $product->name }}
            </h1>

            <div class="flex flex-col mb-8">
                <div class="flex items-end gap-4">
                    <p class="text-4xl font-black text-teal-600 italic">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </p>
                    @if($product->original_price && $product->original_price > $product->price)
                        @php
                            $discount = round((($product->original_price - $product->price) / $product->original_price) * 100);
                        @endphp
                        <div class="flex flex-col mb-1">
                            <span class="text-sm font-bold text-slate-400 line-through">Rp{{ number_format($product->original_price, 0, ',', '.') }}</span>
                            <span class="text-[10px] font-black px-2 py-0.5 bg-rose-500 text-white rounded-md uppercase tracking-widest mt-1 text-center w-fit animate-bounce">Hemat {{ $discount }}%</span>
                        </div>
                    @endif
                    <span class="text-sm font-bold text-slate-400 mb-1 uppercase tracking-tighter">/ Meter</span>
                </div>
                <div class="flex items-center gap-3 mt-4">
                    <span class="text-sm font-bold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                        {{ $product->stock > 0 ? 'Stok: ' . $product->stock . ' Meter' : 'Stok Habis' }}
                    </span>
                </div>
            </div>

            <div class="prose prose-slate prose-lg mb-10">
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Deskripsi Produk</h3>
                <p class="text-slate-600 leading-relaxed font-medium">
                    {!! nl2br(e($product->description)) !!}
                </p>
            </div>

            <!-- Calculator Trigger Button -->
            <button onclick="openCalculator()" class="mb-10 flex items-center space-x-3 px-6 py-4 bg-teal-50 text-teal-600 rounded-2xl font-bold hover:bg-teal-100 transition-all group">
                <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                <span>Kalkulator Kebutuhan Kain</span>
            </button>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <form action="{{ route('cart.store') }}" method="POST" class="w-full">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    @auth
                        <button type="submit" class="w-full flex items-center justify-center px-8 py-5 bg-teal-600 text-white rounded-[2rem] font-black text-lg hover:bg-teal-700 transition-all shadow-xl shadow-teal-100 active:scale-95">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Ke Keranjang
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-5 bg-teal-600 text-white rounded-[2rem] font-black text-lg hover:bg-teal-700 transition-all shadow-xl shadow-teal-100 active:scale-95">
                            Login untuk Beli
                        </a>
                    @endauth
                </form>
                
                <a href="https://wa.me/6289515915699?text=Halo Nusakain, saya tertarik dengan produk {{ $product->name }}. Apakah stok masih tersedia?" 
                   target="_blank"
                   class="flex items-center justify-center px-8 py-5 bg-slate-900 text-white rounded-[2rem] font-black text-lg hover:bg-teal-600 transition-all shadow-xl shadow-slate-200 hover:shadow-teal-100 active:scale-95">
                    <svg class="w-6 h-6 mr-3 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.353-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.13.57-.074 1.758-.716 2.003-1.408.245-.693.245-1.287.172-1.408-.074-.122-.272-.196-.57-.346zM12 0C5.373 0 0 5.373 0 12c0 2.123.55 4.12 1.511 5.86L0 24l6.337-1.663C8.03 23.35 10.027 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.897 0-3.749-.512-5.352-1.48l-.385-.233-3.746.982.998-3.65-.255-.406C2.272 15.627 1.5 13.854 1.5 12c0-5.79 4.71-10.5 10.5-10.5 5.79 0 10.5 4.71 10.5 10.5S17.79 22.5 12 22.5z"/></svg>
                    Tanya Admin
                </a>
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

    <!-- Related Products Section -->
    @if($relatedProducts->count() > 0)
        <section class="mt-32">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Produk <span class="text-teal-600">Serupa</span></h2>
                <a href="{{ route('produk.index') }}?category={{ $product->category }}" class="text-sm font-bold text-teal-600 hover:underline underline-offset-4">Lihat Lainnya</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($relatedProducts as $related)
                    <div class="group relative bg-white rounded-[2.5rem] p-4 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="aspect-square rounded-[2rem] overflow-hidden bg-gray-100 mb-6">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @endif
                        </div>
                        <div class="px-2 pb-2">
                            <h3 class="text-lg font-black text-slate-900 line-clamp-1">{{ $related->name }}</h3>
                            <p class="text-sm font-black text-teal-600 mt-1">Rp{{ number_format($related->price, 0, ',', '.') }}</p>
                            <a href="{{ route('produk.show', $related->slug) }}" class="absolute inset-0 z-10"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</main>

<!-- Calculator Modal -->
<div id="calcModal" class="fixed inset-0 z-[100] flex items-center justify-center hidden p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeCalculator()"></div>
    <div class="relative bg-white w-full max-w-lg rounded-[3rem] shadow-2xl overflow-hidden animate__animated animate__zoomIn animate__faster">
        <div class="p-8 md:p-12 text-center">
            <div class="w-16 h-16 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-2">Estimasi Kebutuhan Kain</h3>
            <p class="text-slate-500 text-sm font-medium mb-10">Pilih jenis pakaian untuk mendapatkan saran panjang kain.</p>

            <div class="space-y-6 text-left">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Jenis Pakaian</label>
                    <select id="garmentType" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 font-bold text-slate-900">
                        <option value="1.5">Kemeja Lengan Pendek</option>
                        <option value="2.0">Kemeja Lengan Panjang</option>
                        <option value="2.5">Gamis / Dress Simple</option>
                        <option value="3.5">Gamis Lebar / Syar'i</option>
                        <option value="1.5">Celana Panjang</option>
                        <option value="1.0">Rok Pendek</option>
                        <option value="2.0">Rok Panjang / A-Line</option>
                    </select>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Ukuran Tubuh</label>
                    <div class="grid grid-cols-3 gap-3">
                        <button onclick="setSize(1)" id="size-S" class="size-btn py-3 rounded-xl bg-slate-50 font-bold text-slate-600 hover:bg-teal-50 hover:text-teal-600 transition-all">S / M</button>
                        <button onclick="setSize(1.2)" id="size-L" class="size-btn py-3 rounded-xl bg-teal-600 font-bold text-white shadow-lg">L / XL</button>
                        <button onclick="setSize(1.5)" id="size-XXL" class="size-btn py-3 rounded-xl bg-slate-50 font-bold text-slate-600 hover:bg-teal-50 hover:text-teal-600 transition-all">XXL+</button>
                    </div>
                </div>

                <div class="mt-10 p-6 bg-teal-50 rounded-[2rem] text-center border border-teal-100/50">
                    <p class="text-xs font-bold text-teal-600 uppercase tracking-widest mb-1">Hasil Estimasi</p>
                    <p class="text-4xl font-black text-teal-700 italic"><span id="resultLength">2.4</span> <span class="text-lg not-italic">Meter</span></p>
                </div>
            </div>

            <button onclick="closeCalculator()" class="mt-8 text-sm font-black text-slate-400 uppercase tracking-widest hover:text-rose-500 transition-colors">Tutup</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentMultiplier = 1.2;

    function openCalculator() {
        document.getElementById('calcModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        calculate();
    }

    function closeCalculator() {
        document.getElementById('calcModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function changeImage(src) {
        const mainImg = document.getElementById('main-image');
        mainImg.src = src;
        mainImg.parentElement.href = src;
        
        // Update thumbnail borders
        event.currentTarget.parentElement.querySelectorAll('div').forEach(el => {
            el.classList.remove('border-teal-500');
            el.classList.add('border-transparent');
        });
        event.currentTarget.classList.add('border-teal-500');
        event.currentTarget.classList.remove('border-transparent');
    }

    function setSize(multiplier) {
        currentMultiplier = multiplier;
        // Reset all buttons
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.classList.remove('bg-teal-600', 'text-white', 'shadow-lg');
            btn.classList.add('bg-slate-50', 'text-slate-600');
        });
        // Style selected
        event.target.classList.add('bg-teal-600', 'text-white', 'shadow-lg');
        event.target.classList.remove('bg-slate-50', 'text-slate-600');
        calculate();
    }

    document.getElementById('garmentType').addEventListener('change', calculate);

    function calculate() {
        const base = parseFloat(document.getElementById('garmentType').value);
        const result = (base * currentMultiplier).toFixed(2);
        document.getElementById('resultLength').innerText = result;
    }

    // Initialize GLightbox
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        zoomable: true
    });
</script>
@endpush
@endsection
