@extends('layouts.guest')

@section('title', 'Detail Pesanan #' . $order->order_number . ' - Nusakain')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12 md:py-24">
    <div class="mb-12 flex items-center space-x-4">
        <a href="{{ route('customer.orders') }}" class="w-12 h-12 flex items-center justify-center bg-white border border-slate-100 text-slate-400 hover:text-teal-600 rounded-2xl transition-all shadow-sm active:scale-90">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Detail Pesanan <span class="text-teal-600">#{{ $order->order_number }}</span></h1>
            <p class="mt-1 text-slate-500 font-medium">Informasi lengkap transaksi Anda.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-8 md:p-12 rounded-[3rem] border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-10 pb-6 border-b border-slate-50">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status Pengiriman</p>
                        @php
                            $statusClasses = [
                                'pending' => 'text-amber-600',
                                'processing' => 'text-blue-600',
                                'shipped' => 'text-indigo-600',
                                'completed' => 'text-green-600',
                                'cancelled' => 'text-red-600',
                            ];
                        @endphp
                        <p class="text-xl font-black uppercase tracking-tight {{ $statusClasses[$order->status] }}">{{ $order->status }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Waktu Transaksi</p>
                        <p class="text-sm font-bold text-slate-900">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <div class="space-y-8">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-6">
                            <div class="w-20 h-20 bg-slate-100 rounded-[1.5rem] overflow-hidden flex-shrink-0 border border-slate-50">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-lg font-black text-slate-900 truncate">{{ $item->product->name }}</h4>
                                <p class="text-xs font-bold text-slate-400 mt-1 uppercase">{{ $item->product->category }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-black text-slate-900">{{ $item->quantity }}m x Rp{{ number_format($item->unit_price, 0, ',', '.') }}</p>
                                <p class="text-xs font-bold text-teal-600 mt-1">Rp{{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 pt-10 border-t border-slate-100 flex justify-between items-end">
                    <span class="text-sm font-black text-slate-400 uppercase tracking-widest">Total Pembayaran</span>
                    <span class="text-4xl font-black text-slate-900 italic">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-teal-600 p-10 rounded-[3rem] text-white shadow-2xl shadow-teal-100 relative overflow-hidden group">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all"></div>
                <h3 class="text-xl font-black tracking-tight mb-4 relative z-10">Konfirmasi WA?</h3>
                <p class="text-teal-100 text-sm font-medium mb-10 relative z-10 leading-relaxed">Hubungi admin kembali jika Anda ingin menanyakan detail pengiriman.</p>
                <a href="https://wa.me/6289515915699?text=Halo Nusakain, saya ingin menanyakan status pesanan #{{ $order->order_number }}." 
                   target="_blank"
                   class="w-full inline-flex items-center justify-center py-4 bg-white text-teal-600 rounded-2xl font-black text-sm hover:bg-teal-50 transition-all relative z-10 shadow-lg active:scale-95">
                    Chat Admin
                </a>
            </div>

            <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-6">Metode Pembayaran</h3>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    </div>
                    <p class="text-sm font-bold text-slate-700">Bank Transfer / Manual (WA)</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
