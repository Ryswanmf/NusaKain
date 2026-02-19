<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3 md:space-x-5 w-full">
            <a href="{{ route('admin.pesanan.index') }}" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-white border border-slate-100 text-slate-400 hover:text-teal-600 rounded-xl md:rounded-2xl transition-all shadow-sm active:scale-90 flex-shrink-0">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div class="min-w-0">
                <h2 class="font-black text-xl md:text-3xl text-slate-900 tracking-tight truncate">
                    Detail Pesanan <span class="text-teal-600">#{{ $pesanan->order_number }}</span>
                </h2>
                <p class="hidden xs:block text-[11px] md:text-sm text-slate-500 font-medium mt-0.5 truncate">Dipesan pada {{ $pesanan->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        @if(session('success'))
            <div class="mb-6 p-4 bg-teal-50 text-teal-700 rounded-2xl border border-teal-100 font-bold text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-6 md:p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900 tracking-tight mb-8 uppercase tracking-widest text-[11px] text-slate-400">Daftar Produk</h3>
                    <div class="space-y-6">
                        @foreach($pesanan->items as $item)
                            <div class="flex items-center gap-6 pb-6 border-b border-slate-50 last:border-0 last:pb-0">
                                <div class="w-16 h-16 bg-slate-50 rounded-2xl overflow-hidden flex-shrink-0">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-black text-slate-900 truncate">{{ $item->product->name }}</h4>
                                    <p class="text-xs font-bold text-slate-400 mt-1 uppercase">{{ $item->product->category }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-black text-slate-900">{{ $item->quantity }}m x Rp{{ number_format($item->unit_price, 0, ',', '.') }}</p>
                                    <p class="text-[11px] font-bold text-teal-600 mt-1">Rp{{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-10 pt-10 border-t border-slate-100">
                        <div class="flex justify-between items-end">
                            <span class="text-sm font-black text-slate-400 uppercase tracking-[0.2em]">Total Pembayaran</span>
                            <span class="text-3xl font-black text-slate-900 italic">Rp{{ number_format($pesanan->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-8">
                <!-- Status Management -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-6">Kelola Status</h3>
                    <form action="{{ route('admin.pesanan.update-status', $pesanan->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 font-bold text-slate-900 mb-4">
                            <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $pesanan->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $pesanan->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="completed" {{ $pesanan->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $pesanan->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black text-sm hover:bg-teal-600 transition-all shadow-xl shadow-slate-200 active:scale-95">
                            Update Status
                        </button>
                    </form>
                </div>

                <!-- Customer Info -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-6">Informasi Pelanggan</h3>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-full bg-teal-50 text-teal-600 flex items-center justify-center font-black uppercase">
                            {{ substr($pesanan->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-black text-slate-900 leading-tight">{{ $pesanan->user->name }}</p>
                            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-tighter mt-1">{{ $pesanan->user->email }}</p>
                        </div>
                    </div>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pesanan->user->phone ?? '') }}" target="_blank" class="block w-full py-3 text-center bg-teal-50 text-teal-600 rounded-xl font-bold text-xs hover:bg-teal-100 transition-all">
                        Hubungi via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
