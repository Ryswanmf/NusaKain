<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 md:gap-4 w-full">
            <div class="min-w-0">
                <h2 class="font-black text-2xl md:text-3xl text-slate-900 tracking-tight truncate">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-[11px] md:text-sm text-slate-500 font-medium mt-0.5 truncate text-teal-600 md:text-slate-500">Welcome, {{ Auth::user()->name }}!</p>
            </div>
            <div class="hidden xs:flex flex-wrap items-center gap-3 self-start md:self-auto">
                <!-- Date Filter -->
                <div class="flex items-center bg-white p-1 rounded-2xl border border-slate-100 shadow-sm">
                    <input type="date" id="start_date" class="bg-transparent border-none text-[10px] font-black text-slate-600 focus:ring-0 w-28 uppercase" title="Tanggal Mulai">
                    <span class="text-slate-300 text-[10px] font-black px-1">—</span>
                    <input type="date" id="end_date" class="bg-transparent border-none text-[10px] font-black text-slate-600 focus:ring-0 w-28 uppercase" title="Tanggal Selesai">
                </div>

                <div class="flex items-center bg-white px-4 py-2 md:px-5 md:py-2.5 rounded-xl md:rounded-2xl border border-slate-100 shadow-sm">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-teal-500 mr-2 md:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-[10px] md:text-sm font-black text-slate-700 uppercase tracking-wider whitespace-nowrap">{{ now()->format('d M Y') }}</span>
                </div>
                
                <!-- Export Buttons -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.reports.excel') }}" id="btn-export-excel" class="p-2.5 md:p-3 bg-green-50 text-green-600 rounded-xl md:rounded-2xl hover:bg-green-600 hover:text-white transition-all shadow-sm border border-green-100 group/btn" title="Unduh Excel">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </a>
                    <a href="{{ route('admin.reports.pdf') }}" id="btn-export-pdf" class="p-2.5 md:p-3 bg-rose-50 text-rose-600 rounded-xl md:rounded-2xl hover:bg-rose-600 hover:text-white transition-all shadow-sm border border-rose-100 group/btn" title="Unduh PDF">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9h1m1 0h1m1 0h1m-3 4h1m1 0h1m1 0h1m-3 4h1m1 0h1m1 0h1"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        <!-- Highlights -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 mb-10 md:mb-16">
            <!-- Total Orders -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center group-hover:bg-teal-600 group-hover:text-white transition-colors duration-500 shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <div class="text-right">
                        <span class="text-[9px] font-black text-teal-500 bg-teal-50 px-3 py-1 rounded-lg uppercase tracking-widest border border-teal-100">Live</span>
                    </div>
                </div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-1">Total Pesanan</p>
                <h3 class="text-3xl font-black text-slate-900 tracking-tighter italic">{{ number_format($stats['total_orders']) }}</h3>
            </div>

            <!-- Total Revenue -->
            <div class="bg-slate-900 p-8 rounded-[2.5rem] text-white shadow-2xl hover:shadow-teal-900/20 hover:-translate-y-1 transition-all duration-500 group relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-20 h-20 bg-teal-500/10 rounded-full blur-2xl"></div>
                <div class="flex items-center justify-between mb-6 relative z-10">
                    <div class="w-14 h-14 bg-white/10 text-teal-400 rounded-2xl flex items-center justify-center group-hover:bg-teal-500 group-hover:text-slate-900 transition-colors duration-500 shadow-lg">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-1 relative z-10">Pendapatan Lunas</p>
                @php
                    $revenue = $stats['total_revenue'];
                    if ($revenue >= 1000000) {
                        $formattedRevenue = 'Rp ' . number_format($revenue / 1000000, 1) . 'M';
                    } elseif ($revenue >= 1000) {
                        $formattedRevenue = 'Rp ' . number_format($revenue / 1000, 0) . 'K';
                    } else {
                        $formattedRevenue = 'Rp ' . number_format($revenue, 0, ',', '.');
                    }
                @endphp
                <h3 class="text-3xl font-black text-teal-400 tracking-tighter italic relative z-10">{{ $formattedRevenue }}</h3>
            </div>

            <!-- Net Profit -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-500 shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <div class="text-right">
                        <span class="text-[9px] font-black text-indigo-500 bg-indigo-50 px-3 py-1 rounded-lg uppercase tracking-widest border border-indigo-100">Profit</span>
                    </div>
                </div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-1">Keuntungan Bersih</p>
                @php
                    $profit = $stats['net_profit'];
                    if ($profit >= 1000000) {
                        $formattedProfit = 'Rp ' . number_format($profit / 1000000, 1) . 'M';
                    } elseif ($profit >= 1000) {
                        $formattedProfit = 'Rp ' . number_format($profit / 1000, 0) . 'K';
                    } else {
                        $formattedProfit = 'Rp ' . number_format($profit, 0, ',', '.');
                    }
                @endphp
                <h3 class="text-3xl font-black text-slate-900 tracking-tighter italic">{{ $formattedProfit }}</h3>
            </div>

            <!-- Low Stock Alert -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition-colors duration-500 shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    @if($stats['low_stock'] > 0)
                        <div class="animate-pulse">
                            <span class="text-[9px] font-black text-rose-500 bg-rose-50 px-3 py-1 rounded-lg uppercase tracking-widest border border-rose-100 italic">Attention</span>
                        </div>
                    @endif
                </div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-1">Stok Menipis (< 5m)</p>
                <h3 class="text-3xl font-black text-slate-900 tracking-tighter italic">{{ number_format($stats['low_stock']) }} <span class="text-xs text-slate-300 not-italic ml-1">Produk</span></h3>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">
            <!-- Charts Section -->
            <div class="lg:col-span-2 space-y-10 md:space-y-16">
                <div class="bg-white p-8 md:p-12 rounded-[3rem] border border-slate-100 shadow-sm relative overflow-hidden group">
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-teal-50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                    
                    <div class="flex items-center justify-between mb-12 relative z-10">
                        <div>
                            <h3 class="text-2xl font-black text-slate-900 tracking-tight italic">Analitik <span class="text-teal-600">Penjualan.</span></h3>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Tren pesanan 7 hari terakhir</p>
                        </div>
                        <div class="flex items-center gap-4 bg-slate-50 px-4 py-2 rounded-xl border border-slate-100">
                            <span class="w-2.5 h-2.5 bg-teal-500 rounded-full animate-pulse"></span>
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Live Data</span>
                        </div>
                    </div>
                    <div class="h-[350px] w-full relative z-10">
                        <canvas id="ordersChart"></canvas>
                    </div>
                </div>

                <!-- Recent Orders Table -->
                <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col group">
                    <div class="p-8 md:p-12 border-b border-slate-50 flex items-center justify-between bg-white relative overflow-hidden">
                        <div class="absolute -left-10 -top-10 w-32 h-32 bg-slate-50 rounded-full blur-2xl group-hover:bg-teal-50 transition-colors duration-1000"></div>
                        <div class="relative z-10">
                            <h3 class="text-2xl font-black text-slate-900 tracking-tight italic">Pesanan <span class="text-teal-600">Terbaru.</span></h3>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Monitoring transaksi real-time</p>
                        </div>
                        <a href="{{ route('admin.pesanan.index') }}" class="relative z-10 px-8 py-3.5 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-teal-600 transition-all shadow-xl shadow-slate-200 hover:shadow-teal-100 active:scale-95 flex items-center gap-2">
                            <span>Lihat Semua</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                    <div class="overflow-x-auto relative z-10">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] bg-slate-50/50">
                                    <th class="px-10 py-6">ID Pesanan</th>
                                    <th class="px-10 py-6">Pelanggan</th>
                                    <th class="px-10 py-6">Status</th>
                                    <th class="px-10 py-6 text-right">Total Akhir</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($recentOrders as $order)
                                    <tr class="group/row hover:bg-slate-50/50 transition-all duration-500">
                                        <td class="px-10 py-8">
                                            <div class="text-sm font-black text-slate-900 tracking-tighter uppercase">#{{ $order->order_number }}</div>
                                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">{{ $order->created_at->format('d M, H:i') }}</div>
                                        </td>
                                        <td class="px-10 py-8">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-black text-[10px] uppercase shadow-sm group-hover/row:bg-teal-500 group-hover/row:text-white transition-all duration-500">
                                                    {{ substr($order->user->name ?? $order->receiver_name, 0, 1) }}
                                                </div>
                                                <span class="text-sm font-bold text-slate-700">{{ $order->user->name ?? $order->receiver_name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-10 py-8">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                    'processing' => 'bg-blue-50 text-blue-600 border-blue-100',
                                                    'shipped' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
                                                    'completed' => 'bg-teal-50 text-teal-600 border-teal-100',
                                                    'cancelled' => 'bg-rose-50 text-rose-600 border-rose-100',
                                                ];
                                            @endphp
                                            <span class="px-4 py-1.5 {{ $statusColors[$order->status] ?? 'bg-slate-50' }} text-[9px] font-black rounded-lg uppercase tracking-[0.2em] border shadow-sm">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="px-10 py-8 text-right">
                                            <span class="text-base font-black text-slate-900 italic tracking-tighter">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Product Reviews -->
                <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col group">
                    <div class="p-8 md:p-12 border-b border-slate-50 flex items-center justify-between bg-white relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-slate-50 rounded-full blur-2xl group-hover:bg-amber-50 transition-colors duration-1000"></div>
                        <div class="relative z-10">
                            <h3 class="text-2xl font-black text-slate-900 tracking-tight italic">Review <span class="text-amber-500">Produk.</span></h3>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Ulasan terbaru dari pembeli</p>
                        </div>
                    </div>
                    <div class="overflow-x-auto relative z-10">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] bg-slate-50/50">
                                    <th class="px-10 py-6">Produk & Review</th>
                                    <th class="px-10 py-6">Rating</th>
                                    <th class="px-10 py-6 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($recentReviews as $review)
                                    <tr class="group/row hover:bg-slate-50/50 transition-all duration-500">
                                        <td class="px-10 py-8">
                                            <div class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">{{ $review->product->name }}</div>
                                            <p class="text-sm font-bold text-slate-700 italic">"{{ Str::limit($review->comment, 60) }}"</p>
                                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-2">Oleh {{ $review->user->name }} • {{ $review->created_at->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-10 py-8">
                                            <div class="flex items-center gap-1">
                                                @for($i=1; $i<=5; $i++)
                                                    <svg class="w-3 h-3 {{ $i <= $review->rating ? 'text-amber-400' : 'text-slate-100' }} fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                @endfor
                                            </div>
                                        </td>
                                        <td class="px-10 py-8 text-right">
                                            <span class="px-3 py-1 {{ $review->is_visible ? 'bg-teal-50 text-teal-600' : 'bg-rose-50 text-rose-600' }} text-[8px] font-black rounded-lg uppercase tracking-widest border">
                                                {{ $review->is_visible ? 'Tampil' : 'Disembunyikan' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-10 py-12 text-center text-[10px] font-black text-slate-300 uppercase tracking-widest">Belum ada review baru</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar: Stats & Info -->
            <div class="space-y-10 md:space-y-12">
                <!-- Support Card -->
                <div class="bg-teal-600 p-10 rounded-[3.5rem] shadow-2xl shadow-teal-900/20 relative overflow-hidden group">
                    <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all duration-1000"></div>
                    <div class="absolute -left-10 -top-10 w-32 h-32 bg-black/10 rounded-full blur-2xl"></div>
                    
                    <h4 class="text-white font-black text-2xl tracking-tight mb-3 relative z-10 italic">Butuh <span class="text-slate-900">Bantuan?</span></h4>
                    <p class="text-teal-100 text-xs font-medium mb-10 relative z-10 leading-relaxed uppercase tracking-widest">Hubungi tim technical support Nusakain untuk bantuan sistem.</p>
                    
                    <a href="https://wa.me/6289515915699" target="_blank" class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-white hover:text-teal-600 transition-all relative z-10 shadow-xl active:scale-95">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.353-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.13.57-.074 1.758-.716 2.003-1.408.245-.693.245-1.287.172-1.408-.074-.122-.272-.196-.57-.346zM12 0C5.373 0 0 5.373 0 12c0 2.123.55 4.12 1.511 5.86L0 24l6.337-1.663C8.03 23.35 10.027 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.897 0-3.749-.512-5.352-1.48l-.385-.233-3.746.982.998-3.65-.255-.406C2.272 15.627 1.5 13.854 1.5 12c0-5.79 4.71-10.5 10.5-10.5 5.79 0 10.5 4.71 10.5 10.5S17.79 22.5 12 22.5z"/></svg>
                        <span>Chat Support</span>
                    </a>
                </div>

                <!-- Category Chart -->
                <div class="bg-white p-10 md:p-12 rounded-[3.5rem] border border-slate-100 shadow-sm group hover:border-teal-500/30 transition-all duration-500">
                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-[0.3em] mb-10 italic">Distribusi <span class="text-teal-600">Kategori.</span></h4>
                    <div class="h-[280px] w-full mb-8">
                        <canvas id="categoryChart"></canvas>
                    </div>
                    <p class="text-[10px] text-slate-400 font-bold text-center uppercase tracking-widest leading-relaxed px-4">Proporsi material kain berdasarkan kategori terpopuler.</p>
                </div>

                <!-- System Info -->
                <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm relative overflow-hidden group">
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-slate-50 rounded-full blur-2xl group-hover:bg-blue-50 transition-colors duration-1000"></div>
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-[0.3em] mb-8 italic relative z-10">Informasi <span class="text-teal-600">Sistem.</span></h4>
                    <div class="space-y-6 relative z-10">
                        <div class="flex items-center justify-between pb-4 border-b border-slate-50">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">App Version</span>
                            <span class="text-[10px] font-black text-slate-900 tracking-[0.2em] uppercase bg-slate-100 px-3 py-1 rounded-lg">v2.5.0-Gold</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Server Health</span>
                            <span class="text-[10px] font-black text-green-500 tracking-widest uppercase flex items-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2 shadow-[0_0_8px_rgba(34,197,94,0.6)] animate-pulse"></div>
                                Optimal
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update Export Links based on date filter
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const btnExcel = document.getElementById('btn-export-excel');
            const btnPdf = document.getElementById('btn-export-pdf');

            const baseExcelUrl = "{{ route('admin.reports.excel') }}";
            const basePdfUrl = "{{ route('admin.reports.pdf') }}";

            function updateExportLinks() {
                const start = startDateInput.value;
                const end = endDateInput.value;
                const params = new URLSearchParams();
                
                if (start) params.append('start_date', start);
                if (end) params.append('end_date', end);

                const queryString = params.toString() ? '?' + params.toString() : '';
                
                btnExcel.href = baseExcelUrl + queryString;
                btnPdf.href = basePdfUrl + queryString;
            }

            startDateInput.addEventListener('change', updateExportLinks);
            endDateInput.addEventListener('change', updateExportLinks);

            // Gradient Setup for Chart
            const ctxOrders = document.getElementById('ordersChart').getContext('2d');
            const gradient = ctxOrders.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(13, 148, 136, 0.2)');
            gradient.addColorStop(1, 'rgba(13, 148, 136, 0)');

            // Orders Chart (Line)
            new Chart(ctxOrders, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartData['labels']) !!},
                    datasets: [{
                        label: 'Pesanan Masuk',
                        data: {!! json_encode($chartData['orders']) !!},
                        borderColor: '#0d9488',
                        backgroundColor: gradient,
                        borderWidth: 5,
                        fill: true,
                        tension: 0.45,
                        pointRadius: 0,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: '#0d9488',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { intersect: false, mode: 'index' },
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { size: 12, weight: 'bold' },
                            bodyFont: { size: 12 },
                            padding: 15,
                            cornerRadius: 16,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false }, 
                            ticks: { font: { weight: 'bold', size: 10 }, color: '#94a3b8' }
                        },
                        x: { 
                            grid: { display: false }, 
                            ticks: { font: { weight: 'bold', size: 10 }, color: '#94a3b8' }
                        }
                    }
                }
            });

            // Category Chart (Doughnut)
            const ctxCat = document.getElementById('categoryChart').getContext('2d');
            new Chart(ctxCat, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($categoryDistribution->pluck('category')) !!},
                    datasets: [{
                        data: {!! json_encode($categoryDistribution->pluck('total')) !!},
                        backgroundColor: ['#0d9488', '#0ea5e9', '#6366f1', '#f59e0b', '#ec4899', '#8b5cf6'],
                        borderWidth: 8,
                        borderColor: '#ffffff',
                        hoverOffset: 20
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: { 
                            position: 'bottom', 
                            labels: { 
                                usePointStyle: true, 
                                padding: 30, 
                                font: { weight: '900', size: 10, family: 'sans-serif' },
                                color: '#64748b'
                            } 
                        }
                    }
                }
            });
        });
    </script>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Orders Chart (Line)
            const ctxOrders = document.getElementById('ordersChart').getContext('2d');
            new Chart(ctxOrders, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartData['labels']) !!},
                    datasets: [{
                        label: 'Pesanan',
                        data: {!! json_encode($chartData['orders']) !!},
                        borderColor: '#0d9488', // teal-600
                        backgroundColor: 'rgba(13, 148, 136, 0.1)',
                        borderWidth: 4,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 0,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { display: false }, border: { display: false } },
                        x: { grid: { display: false }, border: { display: false } }
                    }
                }
            });

            // Category Chart (Doughnut)
            const ctxCat = document.getElementById('categoryChart').getContext('2d');
            new Chart(ctxCat, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($categoryDistribution->pluck('category')) !!},
                    datasets: [{
                        data: {!! json_encode($categoryDistribution->pluck('total')) !!},
                        backgroundColor: ['#0d9488', '#0ea5e9', '#6366f1', '#f59e0b', '#ec4899', '#8b5cf6'],
                        borderWidth: 0,
                        cutout: '80%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { weight: 'bold', size: 10 } } }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
