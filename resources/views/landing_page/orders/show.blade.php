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
        <div class="ml-auto">
            <a href="{{ route('customer.orders.invoice', $order->order_number) }}" class="flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-700 rounded-2xl font-bold text-sm hover:bg-slate-50 transition-all shadow-sm active:scale-95">
                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Download Invoice
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2 space-y-8">
            <!-- New Order Timeline -->
            <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-slate-50">
                    @php
                        $progressWidth = match($order->status) {
                            'pending' => '20%',
                            'processing' => '45%',
                            'shipped' => '75%',
                            'completed' => '100%',
                            'cancelled' => '0%',
                            default => '0%'
                        };
                    @endphp
                    <div class="h-full bg-teal-500 transition-all duration-1000" style="width: {{ $progressWidth }}"></div>
                </div>
                
                <div class="grid grid-cols-4 gap-4 relative">
                    <div class="flex flex-col items-center text-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ in_array($order->status, ['pending', 'processing', 'shipped', 'completed']) ? 'bg-teal-500 text-white shadow-lg shadow-teal-200' : 'bg-slate-100 text-slate-300' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                        <span class="text-[9px] font-black uppercase tracking-widest {{ in_array($order->status, ['pending', 'processing', 'shipped', 'completed']) ? 'text-slate-900' : 'text-slate-300' }}">Dipesan</span>
                    </div>
                    <div class="flex flex-col items-center text-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ in_array($order->status, ['processing', 'shipped', 'completed']) ? 'bg-teal-500 text-white shadow-lg shadow-teal-200' : 'bg-slate-100 text-slate-300' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        </div>
                        <span class="text-[9px] font-black uppercase tracking-widest {{ in_array($order->status, ['processing', 'shipped', 'completed']) ? 'text-slate-900' : 'text-slate-300' }}">Diproses</span>
                    </div>
                    <div class="flex flex-col items-center text-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ in_array($order->status, ['shipped', 'completed']) ? 'bg-teal-500 text-white shadow-lg shadow-teal-200' : 'bg-slate-100 text-slate-300' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <span class="text-[9px] font-black uppercase tracking-widest {{ in_array($order->status, ['shipped', 'completed']) ? 'text-slate-900' : 'text-slate-300' }}">Dikirim</span>
                    </div>
                    <div class="flex flex-col items-center text-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $order->status === 'completed' ? 'bg-teal-500 text-white shadow-lg shadow-teal-200' : 'bg-slate-100 text-slate-300' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-[9px] font-black uppercase tracking-widest {{ $order->status === 'completed' ? 'text-slate-900' : 'text-slate-300' }}">Selesai</span>
                    </div>
                </div>
            </div>

            <!-- Payment Status Alert -->
            @if(in_array($order->payment_status, ['unpaid', 'pending']))
                <div class="p-8 bg-amber-50 rounded-[2.5rem] border border-amber-100 flex flex-col md:flex-row items-center justify-between gap-6 animate__animated animate__pulse animate__infinite">
                    <div class="flex items-center gap-5">
                        <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-amber-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-black text-slate-900 uppercase tracking-tight">Menunggu Pembayaran</p>
                            <p class="text-xs font-medium text-amber-700">Silakan selesaikan pembayaran Anda agar pesanan segera diproses.</p>
                        </div>
                    </div>
                    <button id="pay-button" class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-black text-sm hover:bg-teal-600 transition-all shadow-xl active:scale-95 whitespace-nowrap">
                        Bayar Sekarang
                    </button>
                </div>
            @elseif($order->payment_status === 'paid')
                <div class="p-8 bg-teal-50 rounded-[2.5rem] border border-teal-100 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-5">
                        <div class="w-12 h-12 bg-teal-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-teal-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="font-black text-slate-900 uppercase tracking-tight">Pembayaran Berhasil</p>
                            @if($order->status === 'completed')
                                <p class="text-xs font-medium text-teal-700">Pesanan telah selesai. Terima kasih telah berbelanja!</p>
                            @else
                                <p class="text-xs font-medium text-teal-700">Terima kasih! Pesanan Anda sedang kami siapkan.</p>
                            @endif
                        </div>
                    </div>
                    @if($order->status === 'completed')
                        <button onclick="openReviewModal()" class="px-10 py-4 bg-teal-600 text-white rounded-2xl font-black text-sm hover:bg-teal-700 transition-all shadow-xl active:scale-95 whitespace-nowrap">
                            Beri Review Produk
                        </button>
                    @else
                        <button disabled class="px-10 py-4 bg-teal-600 text-white rounded-2xl font-black text-sm cursor-default whitespace-nowrap shadow-lg">
                            Telah Dibayar
                        </button>
                    @endif
                </div>
            @endif

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
                    @if($order->status === 'shipped')
                        <form action="{{ route('customer.orders.confirm', $order) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="px-8 py-3 bg-teal-600 text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-teal-700 transition-all shadow-lg shadow-teal-100">
                                Konfirmasi Pesanan Diterima
                            </button>
                        </form>
                    @endif
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
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $item->product->category }}</span>
                                    @if($item->variant)
                                        <div class="w-1 h-1 bg-slate-200 rounded-full"></div>
                                        <span class="text-[10px] font-black text-teal-600 uppercase tracking-widest">{{ $item->variant->name }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-black text-slate-900">{{ $item->quantity }}m x Rp{{ number_format($item->unit_price, 0, ',', '.') }}</p>
                                <p class="text-xs font-bold text-teal-600 mt-1">Rp{{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 pt-10 border-t border-slate-100 space-y-4">
                    <div class="flex justify-between text-sm font-bold text-slate-400">
                        <span>Biaya Pengiriman</span>
                        <span class="text-slate-900">Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-end">
                        <span class="text-sm font-black text-slate-400 uppercase tracking-widest">Total Pembayaran</span>
                        <span class="text-4xl font-black text-slate-900 italic">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm space-y-8">
                <div>
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Alamat Pengiriman</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-slate-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Penerima</span>
                                <span class="text-sm font-bold text-slate-900 truncate">{{ $order->receiver_name }}</span>
                                <span class="text-xs font-medium text-slate-500">{{ $order->receiver_phone }}</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-slate-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Alamat Lengkap</span>
                                <span class="text-sm font-medium text-slate-600 leading-relaxed">{{ $order->address_detail }}</span>
                                <span class="text-xs font-bold text-slate-900 mt-1">{{ $order->postal_code }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-slate-50">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Metode Pembayaran</h3>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-teal-50 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </div>
                        <p class="text-sm font-black text-slate-900 uppercase tracking-tight">Midtrans <span class="text-[10px] text-teal-600">(Snap)</span></p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-900 p-10 rounded-[3rem] text-white shadow-2xl shadow-slate-200 relative overflow-hidden group">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all"></div>
                <h3 class="text-xl font-black tracking-tight mb-4 relative z-10">Ada Kendala?</h3>
                <p class="text-slate-400 text-sm font-medium mb-10 relative z-10 leading-relaxed">Hubungi admin jika Anda ingin mengubah detail pengiriman atau bertanya soal stok.</p>
                <a href="https://wa.me/6289515915699?text=Halo Nusakain, saya {{ Auth::user()->name }} ingin bertanya status pesanan #{{ $order->order_number }}." 
                   target="_blank"
                   class="w-full inline-flex items-center justify-center py-4 bg-white text-slate-900 rounded-2xl font-black text-sm hover:bg-teal-500 hover:text-white transition-all relative z-10 shadow-lg active:scale-95">
                    Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>
</main>

@if(in_array($order->payment_status, ['unpaid', 'pending']) && $order->snap_token)
    @php
        $snapUrl = config('services.midtrans.is_production') 
            ? 'https://app.midtrans.com/snap/snap.js' 
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
    @endphp
    <script src="{{ $snapUrl }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script type="text/javascript">
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $order->snap_token }}', {
                onSuccess: function (result) {
                    window.location.reload();
                },
                onPending: function (result) {
                    window.location.reload();
                },
                onError: function (result) {
                    alert("Pembayaran gagal!");
                },
                onClose: function () {
                    alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                }
            });
        });
    </script>
@endif
@if($order->status === 'completed')
    <!-- Review Modal -->
    <div id="reviewModal" class="fixed inset-0 z-[100] flex items-center justify-center hidden p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeReviewModal()"></div>
        <div class="relative bg-white w-full max-w-xl rounded-[3rem] shadow-2xl overflow-hidden animate__animated animate__zoomIn animate__faster">
            <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <div class="p-8 md:p-12 text-center">
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-2">Bagaimana Kualitas Kain Kami?</h3>
                    <p class="text-slate-500 text-sm font-medium mb-10">Review Anda sangat membantu pembeli lain dalam memilih material.</p>

                    <div class="space-y-8 text-left">
                        <!-- Product Selection if multiple -->
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilih Produk</label>
                            <select name="product_id" required class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 font-bold text-slate-900 mt-2">
                                @foreach($order->items as $item)
                                    <option value="{{ $item->product_id }}">{{ $item->product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Star Rating -->
                        <div class="text-center">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-4">Rating Produk</label>
                            <div class="flex justify-center gap-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" onclick="setRating({{ $i }})" class="star-btn p-1 text-slate-200 hover:scale-110 transition-all duration-200" data-value="{{ $i }}">
                                        <svg class="w-10 h-10 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    </button>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating_input" value="5" required>
                        </div>

                        <!-- Comment -->
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Komentar & Pengalaman</label>
                            <textarea name="comment" rows="4" placeholder="Ceritakan kualitas kain, warna, atau pelayanan kami..."
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 font-bold text-slate-900 mt-2"></textarea>
                        </div>

                        <!-- Photo Upload -->
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Foto Produk (Opsional)</label>
                            <input type="file" name="image" accept="image/*" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 font-bold text-slate-900 mt-2 text-sm">
                        </div>
                    </div>

                    <div class="mt-10 flex flex-col gap-4">
                        <button type="submit" class="w-full py-5 bg-teal-600 text-white rounded-2xl font-black text-lg hover:bg-teal-700 transition-all shadow-xl shadow-teal-100 active:scale-95">
                            Kirim Review
                        </button>
                        <button type="button" onclick="closeReviewModal()" class="text-sm font-black text-slate-400 uppercase tracking-widest hover:text-rose-500 transition-colors">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openReviewModal() {
            document.getElementById('reviewModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            setRating(5); // Default
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function setRating(val) {
            document.getElementById('rating_input').value = val;
            const stars = document.querySelectorAll('.star-btn');
            stars.forEach((star, index) => {
                if (index < val) {
                    star.classList.remove('text-slate-200');
                    star.classList.add('text-amber-400');
                } else {
                    star.classList.add('text-slate-200');
                    star.classList.remove('text-amber-400');
                }
            });
        }
    </script>
@endif
@endsection
