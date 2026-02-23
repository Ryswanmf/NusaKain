@extends('layouts.guest')

@section('title', 'Keranjang Belanja - Nusakain')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12 md:py-24">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight italic">Keranjang <span class="text-teal-600">Belanja.</span></h1>
        <p class="mt-4 text-slate-500 font-medium max-w-lg">Tinjau pilihan kain premium Anda dan gunakan kode promo jika tersedia.</p>
    </div>

    @if(session('success'))
        <div class="mb-8 p-5 bg-teal-50 border border-teal-100 text-teal-700 rounded-[2rem] flex items-center shadow-sm animate__animated animate__fadeIn">
            <div class="bg-teal-500 p-1.5 rounded-full mr-4 text-white flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span class="font-bold text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
        <div class="lg:col-span-2 space-y-6">
            @forelse($cartItems as $item)
                <div class="bg-white p-6 md:p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col md:flex-row items-center gap-8 group hover:shadow-xl hover:-translate-y-1 transition-all duration-500 relative overflow-hidden">
                    <!-- Background Accent -->
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-teal-50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    
                    <div class="w-24 h-24 md:w-36 md:h-36 bg-slate-100 rounded-[2rem] overflow-hidden flex-shrink-0 border border-slate-50 relative z-10">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex-1 text-center md:text-left min-w-0 relative z-10">
                        <div class="flex items-center justify-center md:justify-start gap-3 mb-2">
                            <span class="px-3 py-1 bg-teal-50 text-teal-600 text-[10px] font-black uppercase tracking-widest rounded-full">{{ $item->product->category }}</span>
                            @if($item->variant)
                                <div class="w-1 h-1 bg-slate-200 rounded-full"></div>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $item->variant->name }}</span>
                            @endif
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 truncate tracking-tight">{{ $item->product->name }}</h3>
                        <p class="text-lg font-bold text-slate-400 mt-1">
                            Rp{{ number_format($item->variant ? ($item->variant->price ?? $item->product->price) : $item->product->price, 0, ',', '.') }} 
                            <span class="text-[10px] uppercase tracking-tighter ml-1">/ Meter</span>
                        </p>
                    </div>

                    <div class="flex items-center space-x-6 relative z-10">
                        <div class="flex flex-col items-center gap-2">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Jumlah (m)</span>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center bg-slate-50 border border-slate-100 rounded-2xl px-2 py-1 hover:border-teal-200 transition-colors">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ (float)$item->quantity }}" min="0.5" step="0.5" onchange="this.form.submit()" 
                                       class="w-20 bg-transparent border-none text-center font-black text-slate-900 focus:ring-0 text-lg">
                            </form>
                        </div>

                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-14 h-14 flex items-center justify-center bg-white border border-slate-100 text-slate-300 hover:bg-rose-500 hover:text-white hover:border-rose-500 rounded-2xl transition-all shadow-sm active:scale-90 group/btn">
                                <svg class="w-6 h-6 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-[3.5rem] p-20 text-center border border-slate-100 shadow-sm relative overflow-hidden">
                    <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-teal-50 rounded-full blur-3xl opacity-50"></div>
                    <div class="w-24 h-24 bg-slate-50 text-slate-300 rounded-[2.5rem] flex items-center justify-center mx-auto mb-8 shadow-inner">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-2">Wah, keranjangmu masih kosong.</h3>
                    <p class="text-slate-500 font-medium mb-10 max-w-xs mx-auto leading-relaxed">Mulai temukan material kain premium terbaik untuk koleksi fashion terbaru Anda.</p>
                    <a href="{{ route('produk.index') }}" class="inline-flex items-center px-12 py-5 bg-teal-600 text-white rounded-[2rem] font-black text-lg hover:bg-teal-700 transition-all shadow-xl shadow-teal-100 active:scale-95">
                        Mulai Belanja
                        <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            @endforelse
        </div>

        @if($cartItems->count() > 0)
            <div class="space-y-8 lg:sticky lg:top-32">
                <div class="bg-slate-900 p-8 md:p-12 rounded-[3.5rem] text-white shadow-2xl shadow-slate-200 relative overflow-hidden group">
                    <!-- Background Glow -->
                    <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-teal-500/10 rounded-full blur-[100px] group-hover:bg-teal-500/20 transition-all duration-1000"></div>
                    <div class="absolute -left-20 -top-20 w-48 h-48 bg-blue-500/5 rounded-full blur-[80px]"></div>
                    
                    <h3 class="text-2xl font-black tracking-tight mb-10 italic relative z-10 flex items-center gap-3">
                        Ringkasan <span class="text-teal-400">Order.</span>
                        <div class="h-px flex-1 bg-white/10 ml-2"></div>
                    </h3>
                    
                    <!-- Voucher Input -->
                    <div class="mb-10 relative z-10">
                        <div class="flex items-center gap-2 mb-3 ml-1">
                            <svg class="w-3.5 h-3.5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Punya Kode Promo?</label>
                        </div>
                        <div class="relative group">
                            <input type="text" id="voucher_code" placeholder="Masukkan kode voucher..." 
                                   class="w-full bg-white/5 border border-white/10 rounded-2xl pl-6 pr-28 py-4 text-sm font-bold focus:ring-2 focus:ring-teal-500/50 focus:border-transparent transition-all uppercase placeholder:text-slate-600 text-teal-400 group-hover:border-white/20">
                            <button id="voucher_btn" onclick="applyVoucher()" 
                                    class="absolute right-2 top-1.5 bottom-1.5 px-6 bg-teal-500 text-slate-900 rounded-xl font-black text-[10px] hover:bg-teal-400 transition-all uppercase active:scale-95 shadow-lg shadow-teal-500/20">
                                Pakai
                            </button>
                        </div>
                        <p id="voucher_message" class="text-[10px] mt-3 font-bold px-2 hidden animate__animated animate__headShake"></p>
                    </div>

                    <div class="space-y-6 mb-10 relative z-10">
                        <div class="flex justify-between items-center text-sm font-bold text-slate-400">
                            <span class="font-medium">Subtotal Belanja</span>
                            @php 
                                $subtotal = $cartItems->sum(fn($i) => ($i->variant ? ($i->variant->price ?? $i->product->price) : $i->product->price) * $i->quantity); 
                            @endphp
                            <span class="text-white text-base">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        
                        <div id="discount_row" class="flex justify-between items-center text-sm font-black text-rose-400 hidden animate__animated animate__fadeInUp bg-rose-500/5 p-4 rounded-2xl border border-rose-500/10">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                                <span>Voucher Potongan</span>
                            </div>
                            <span id="discount_amount" class="text-base">-Rp0</span>
                        </div>

                        <div class="flex justify-between items-center text-sm font-bold text-slate-400">
                            <div class="flex items-center gap-2 font-medium">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 01-6.001 0M18 7l-3 9m3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                                <span>Estimasi Berat</span>
                            </div>
                            @php 
                                $totalWeight = $cartItems->sum(fn($i) => ($i->variant->weight ?? $i->product->weight) * $i->quantity);
                            @endphp
                            <span class="text-slate-300">{{ number_format($totalWeight / 1000, 1) }} kg</span>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-white/10 mb-12 relative z-10">
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-black uppercase tracking-[0.3em] text-teal-500/80">Total Tagihan</span>
                            <span id="final_total" class="text-4xl font-black italic text-teal-400 tracking-tighter">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <a href="{{ route('cart.checkout') }}" class="group relative w-full flex items-center justify-center py-6 bg-teal-500 text-slate-900 rounded-[2.2rem] font-black text-xl hover:bg-white transition-all duration-500 shadow-xl shadow-teal-900/40 active:scale-95 z-10 overflow-hidden">
                        <span class="relative z-10 flex items-center">
                            Lanjut Checkout
                            <svg class="w-6 h-6 ml-3 group-hover:translate-x-2 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-teal-400 to-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </a>
                    
                    <p class="mt-6 text-center text-[10px] font-bold text-slate-500 uppercase tracking-widest relative z-10">Harga belum termasuk ongkos kirim</p>
                </div>

                <div class="p-8 bg-white rounded-[3rem] border border-slate-100 flex items-center gap-6 group hover:border-teal-500/30 transition-all duration-500 shadow-sm hover:shadow-xl">
                    <div class="w-14 h-14 bg-teal-50 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-inner group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500">
                        <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A3.323 3.323 0 0010.603 2.041m0 0L9 10.125m1.603-8.084L12 10.125m-1.603-8.084a3.323 3.323 0 014.215 4.467m-4.215-4.467L3 10.125m1.603-8.084L1 10.125m1.603-8.084a3.323 3.323 0 004.215 4.467m-4.215-4.467L10.125 12m0 0L12 3m-1.875 9L3 10.125m7.125 1.875L1 10.125m7.125 1.875L12 21m0 0l1.875-9m-1.875 9L21 10.125m-7.125 1.875L23 10.125m-7.125 1.875L12 3"/></svg>
                    </div>
                    <div class="flex flex-col gap-1">
                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-tighter">Garansi Kain Premium</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed font-medium">
                            Setiap meter kain yang Anda pesan telah melewati tahap QC (Quality Control) untuk brand fashion Anda.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</main>

@push('scripts')
<script>
    let currentSubtotal = {{ $subtotal ?? 0 }};
    let isVoucherApplied = false;

    function applyVoucher() {
        const codeInput = document.getElementById('voucher_code');
        const messageEl = document.getElementById('voucher_message');
        const btn = document.getElementById('voucher_btn');
        const code = codeInput.value.trim();

        if (!code) {
            showVoucherMessage('Silakan masukkan kode voucher.', 'error');
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin h-4 w-4 mx-auto" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';

        fetch('{{ route("vouchers.validate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                code: code,
                total_amount: currentSubtotal
            })
        })
        .then(response => response.json())
        .then(data => {
            btn.disabled = false;
            btn.innerText = 'Pakai';

            if (data.success) {
                isVoucherApplied = true;
                showVoucherMessage(data.message, 'success');
                
                // Update UI
                const discountRow = document.getElementById('discount_row');
                const discountAmount = document.getElementById('discount_amount');
                const finalTotalEl = document.getElementById('final_total');

                discountRow.classList.remove('hidden');
                discountAmount.innerText = '-Rp' + data.discount.toLocaleString('id-ID');
                finalTotalEl.innerText = 'Rp' + data.new_total.toLocaleString('id-ID');
                
                // Success styling
                document.getElementById('voucher_code').classList.add('ring-2', 'ring-teal-500');
            } else {
                showVoucherMessage(data.message, 'error');
            }
        })
        .catch(error => {
            btn.disabled = false;
            btn.innerText = 'Pakai';
            showVoucherMessage('Gagal memverifikasi voucher. Coba lagi nanti.', 'error');
        });
    }

    function showVoucherMessage(msg, type) {
        const el = document.getElementById('voucher_message');
        el.innerText = msg;
        el.classList.remove('hidden', 'text-teal-400', 'text-rose-400');
        el.classList.add(type === 'success' ? 'text-teal-400' : 'text-rose-400');
    }
</script>
@endpush
@endsection
