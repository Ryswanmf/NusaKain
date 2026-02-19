@extends('layouts.guest')

@section('title', 'Keranjang Belanja - Nusakain')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12 md:py-24">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight">Keranjang <span class="text-teal-600">Belanja.</span></h1>
        <p class="mt-4 text-slate-500 font-medium">Tinjau pesanan Anda sebelum melakukan pembayaran.</p>
    </div>

    @if(session('success'))
        <div class="mb-8 p-5 bg-teal-50 border border-teal-100 text-teal-700 rounded-[2rem] flex items-center shadow-sm">
            <div class="bg-teal-500 p-1.5 rounded-full mr-4 text-white flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span class="font-bold text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2 space-y-6">
            @forelse($cartItems as $item)
                <div class="bg-white p-6 md:p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col md:flex-row items-center gap-6 group hover:shadow-xl transition-all duration-500">
                    <div class="w-24 h-24 md:w-32 md:h-32 bg-slate-100 rounded-[2rem] overflow-hidden flex-shrink-0">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex-1 text-center md:text-left min-w-0">
                        <span class="text-[10px] font-black text-teal-600 uppercase tracking-widest">{{ $item->product->category }}</span>
                        <h3 class="text-xl font-black text-slate-900 mt-1 truncate">{{ $item->product->name }}</h3>
                        <p class="text-lg font-black text-slate-900 mt-2">Rp{{ number_format($item->product->price, 0, ',', '.') }} <span class="text-xs text-slate-400 font-bold uppercase tracking-tighter">/ Meter</span></p>
                    </div>

                    <div class="flex items-center space-x-4">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center bg-slate-50 rounded-full px-2 py-1">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" onchange="this.form.submit()" 
                                   class="w-16 bg-transparent border-none text-center font-black text-slate-900 focus:ring-0">
                        </form>

                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-12 h-12 flex items-center justify-center bg-white border border-slate-100 text-red-500 hover:bg-red-600 hover:text-white rounded-2xl transition-all shadow-sm active:scale-90">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-[3rem] p-16 text-center border border-slate-100 shadow-sm">
                    <div class="w-20 h-20 bg-slate-50 text-slate-300 rounded-[2rem] flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Wah, keranjangmu masih kosong.</h3>
                    <p class="mt-2 text-slate-500 font-medium mb-8">Yuk, cari kain premium untuk bisnismu sekarang!</p>
                    <a href="{{ route('produk.index') }}" class="px-10 py-4 bg-teal-600 text-white rounded-2xl font-black hover:bg-teal-700 transition-all shadow-xl shadow-teal-100">Mulai Belanja</a>
                </div>
            @endforelse
        </div>

        @if($cartItems->count() > 0)
            <div class="space-y-8">
                <div class="bg-slate-900 p-10 rounded-[3rem] text-white shadow-2xl shadow-slate-200">
                    <h3 class="text-xl font-black tracking-tight mb-8">Ringkasan Pesanan</h3>
                    <div class="space-y-4 border-b border-slate-800 pb-8 mb-8">
                        <div class="flex justify-between text-sm font-bold text-slate-400">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($cartItems->sum(fn($i) => $i->product->price * $i->quantity), 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm font-bold text-slate-400">
                            <span>Pajak (0%)</span>
                            <span>Rp0</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-end mb-10">
                        <span class="text-sm font-black uppercase tracking-widest text-teal-400">Total</span>
                        <span class="text-3xl font-black italic">Rp{{ number_format($cartItems->sum(fn($i) => $i->product->price * $i->quantity), 0, ',', '.') }}</span>
                    </div>
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center py-5 bg-teal-500 text-slate-900 rounded-[2rem] font-black text-lg hover:bg-teal-400 transition-all shadow-xl shadow-teal-900/20 active:scale-95">
                            Checkout Sekarang
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
