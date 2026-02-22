@extends('layouts.guest')

@section('title', 'Checkout - Nusakain')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight">Selesaikan <span class="text-teal-600">Pesanan.</span></h1>
        <p class="mt-4 text-slate-500 max-w-xl">Mohon lengkapi data pengiriman Anda untuk melanjutkan ke pembayaran.</p>
    </div>

    <form action="{{ route('cart.processCheckout') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
            <!-- Left: Shipping Form -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[2.5rem] p-8 md:p-12 border border-gray-100 shadow-sm space-y-8">
                    <h3 class="text-xl font-black text-slate-900 flex items-center">
                        <span class="w-10 h-10 bg-teal-50 text-teal-600 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </span>
                        Informasi Pengiriman
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Penerima</label>
                            <input type="text" name="receiver_name" value="{{ old('receiver_name', Auth::user()->name) }}" required
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor Telepon (WhatsApp)</label>
                            <input type="text" name="receiver_phone" value="{{ old('receiver_phone', Auth::user()->phone) }}" required
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold" placeholder="08xxxx">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Lengkap</label>
                        <textarea name="address_detail" rows="4" required placeholder="Nama Jalan, Blok, No. Rumah..."
                            class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">{{ old('address_detail') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Kode Pos</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code') }}" required
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="space-y-8">
                <div class="bg-slate-900 rounded-[2.5rem] p-8 md:p-10 text-white shadow-2xl shadow-slate-200 overflow-hidden relative group">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-teal-500/10 rounded-full blur-3xl group-hover:bg-teal-500/20 transition-all"></div>
                    
                    <h3 class="text-xl font-black mb-8 relative z-10">Ringkasan Pesanan</h3>
                    
                    <div class="space-y-4 mb-8 relative z-10">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between items-start text-sm">
                                <div class="flex flex-col min-w-0 pr-4">
                                    <span class="font-bold truncate">{{ $item->product->name }}</span>
                                    <span class="text-[10px] text-slate-400 uppercase tracking-widest">
                                        {{ $item->quantity }}m @if($item->variant) • {{ $item->variant->name }} @endif
                                    </span>
                                </div>
                                <span class="font-black whitespace-nowrap">
                                    @php $price = $item->variant ? ($item->variant->price ?? $item->product->price) : $item->product->price; @endphp
                                    Rp{{ number_format($price * $item->quantity, 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-6 border-t border-white/10 space-y-4 relative z-10">
                        <div class="flex justify-between text-xs font-bold text-slate-400">
                            <span>Subtotal Produk</span>
                            <span class="text-white">Rp{{ number_format($totalAmount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-xs font-bold text-slate-400">
                            <span>Estimasi Berat</span>
                            <span class="text-white">{{ $totalWeight / 1000 }} kg</span>
                        </div>
                        <div class="flex justify-between text-xs font-bold text-slate-400">
                            <span>Ongkos Kirim</span>
                            <span class="text-teal-400">Gratis (Promo)</span>
                        </div>
                        
                        <div class="pt-4 flex justify-between items-end">
                            <span class="text-sm font-bold uppercase tracking-widest">Total Bayar</span>
                            <span class="text-3xl font-black text-teal-400 italic">Rp{{ number_format($totalAmount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full mt-10 py-5 bg-teal-500 text-slate-900 rounded-2xl font-black text-lg hover:bg-teal-400 transition-all active:scale-95 shadow-lg shadow-teal-500/20">
                        Proses Pembayaran
                    </button>
                </div>

                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 flex items-start gap-4">
                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <p class="text-[10px] text-slate-500 leading-relaxed">
                        Pembayaran Anda aman dan terenkripsi. Kami menggunakan <strong>Midtrans</strong> sebagai partner resmi gerbang pembayaran.
                    </p>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection
