<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 md:gap-4 w-full">
            <div class="min-w-0">
                <h2 class="font-black text-2xl md:text-3xl text-slate-900 tracking-tight truncate">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-[11px] md:text-sm text-slate-500 font-medium mt-0.5 truncate text-teal-600 md:text-slate-500">Welcome, {{ Auth::user()->name }}!</p>
            </div>
            <div class="hidden xs:flex items-center bg-white px-4 py-2 md:px-5 md:py-2.5 rounded-xl md:rounded-2xl border border-slate-100 shadow-sm self-start md:self-auto">
                <svg class="w-4 h-4 md:w-5 md:h-5 text-teal-500 mr-2 md:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span class="text-[10px] md:text-sm font-black text-slate-700 uppercase tracking-wider whitespace-nowrap">{{ now()->format('d M Y') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        <!-- Highlights -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8 mb-8 md:mb-12">
            <!-- Total Orders -->
            <div class="bg-white p-6 md:p-8 rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4 md:mb-6">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-teal-50 text-teal-600 rounded-xl md:rounded-2xl flex items-center justify-center group-hover:bg-teal-600 group-hover:text-white transition-colors duration-500">
                        <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <div class="text-right">
                        <span class="text-[9px] md:text-[10px] font-black text-teal-500 bg-teal-50 px-2 py-1 rounded-full uppercase tracking-widest">+12.5%</span>
                    </div>
                </div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Pesanan</p>
                <h3 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tighter">1,284</h3>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white p-6 md:p-8 rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4 md:mb-6">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-blue-50 text-blue-600 rounded-xl md:rounded-2xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors duration-500">
                        <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="text-right">
                        <span class="text-[9px] md:text-[10px] font-black text-blue-500 bg-blue-50 px-2 py-1 rounded-full uppercase tracking-widest">+8.2%</span>
                    </div>
                </div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Pendapatan</p>
                <h3 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tighter">Rp 42.5M</h3>
            </div>

            <!-- New Customers -->
            <div class="bg-white p-6 md:p-8 rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4 md:mb-6">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-indigo-50 text-indigo-600 rounded-xl md:rounded-2xl flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div class="text-right">
                        <span class="text-[9px] md:text-[10px] font-black text-indigo-500 bg-indigo-50 px-2 py-1 rounded-full uppercase tracking-widest">+15.4%</span>
                    </div>
                </div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Pelanggan</p>
                <h3 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tighter">342</h3>
            </div>

            <!-- Low Stock Alert -->
            <div class="bg-white p-6 md:p-8 rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4 md:mb-6">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-rose-50 text-rose-600 rounded-xl md:rounded-2xl flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition-colors duration-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div class="text-right">
                        <span class="text-[9px] md:text-[10px] font-black text-rose-500 bg-rose-50 px-2 py-1 rounded-full uppercase tracking-widest">Penting</span>
                    </div>
                </div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Stok Menipis</p>
                <h3 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tighter">12 <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest ml-1">Jenis</span></h3>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
            <!-- Left: Table -->
            <div class="lg:col-span-2 bg-white rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
                <div class="p-6 md:p-10 border-b border-slate-50 flex items-center justify-between">
                    <div class="min-w-0">
                        <h3 class="text-lg md:text-xl font-black text-slate-900 tracking-tight">Pesanan Terbaru</h3>
                        <p class="hidden sm:block text-sm text-slate-400 font-medium">Monitoring transaksi masuk secara real-time.</p>
                    </div>
                    <button class="px-4 py-2 md:px-6 md:py-2.5 bg-slate-50 text-slate-900 rounded-lg md:rounded-xl text-[10px] md:text-xs font-black uppercase tracking-widest hover:bg-teal-600 hover:text-white transition-all shadow-sm flex-shrink-0">Lihat Semua</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] bg-slate-50/50">
                                <th class="px-6 md:px-10 py-4 md:py-5">ID & Produk</th>
                                <th class="px-6 md:px-10 py-4 md:py-5">Status</th>
                                <th class="px-6 md:px-10 py-4 md:py-5 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                                <td class="px-6 md:px-10 py-4 md:py-6">
                                    <div class="text-xs md:text-sm font-black text-slate-900">#NK-8821</div>
                                    <div class="text-[9px] md:text-[11px] text-slate-400 font-bold uppercase tracking-wider mt-0.5 line-clamp-1">Kain Batik Mega Mendung</div>
                                </td>
                                <td class="px-6 md:px-10 py-4 md:py-6">
                                    <span class="px-2 py-0.5 md:px-3 md:py-1 bg-green-50 text-green-600 text-[9px] md:text-[10px] font-black rounded-full uppercase tracking-widest whitespace-nowrap">Selesai</span>
                                </td>
                                <td class="px-6 md:px-10 py-4 md:py-6 text-right text-xs md:text-sm font-black text-slate-900 italic">Rp 1.25M</td>
                            </tr>
                            <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                                <td class="px-6 md:px-10 py-4 md:py-6">
                                    <div class="text-xs md:text-sm font-black text-slate-900">#NK-8822</div>
                                    <div class="text-[9px] md:text-[11px] text-slate-400 font-bold uppercase tracking-wider mt-0.5 line-clamp-1">Kain Tenun Jepara</div>
                                </td>
                                <td class="px-6 md:px-10 py-4 md:py-6">
                                    <span class="px-2 py-0.5 md:px-3 md:py-1 bg-blue-50 text-blue-600 text-[9px] md:text-[10px] font-black rounded-full uppercase tracking-widest whitespace-nowrap">Dikirim</span>
                                </td>
                                <td class="px-6 md:px-10 py-4 md:py-6 text-right text-xs md:text-sm font-black text-slate-900 italic">Rp 850K</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right: Quick Actions / Feedback -->
            <div class="space-y-6 md:space-y-8">
                <div class="bg-teal-600 p-8 md:p-10 rounded-[2rem] md:rounded-[2.5rem] shadow-xl shadow-teal-100 relative overflow-hidden group">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all"></div>
                    <h4 class="text-white font-black text-lg md:text-xl tracking-tight mb-2 relative z-10">Butuh Bantuan?</h4>
                    <p class="text-teal-100 text-xs md:text-sm font-medium mb-6 md:mb-8 relative z-10 leading-relaxed">Hubungi tim support Nusakain untuk kendala teknis.</p>
                    <a href="https://wa.me/6289515915699" target="_blank" class="inline-flex items-center px-6 py-3 bg-white text-teal-600 rounded-xl md:rounded-2xl text-[10px] md:text-xs font-black uppercase tracking-widest hover:bg-teal-50 transition-all relative z-10 shadow-lg shadow-teal-900/20 active:scale-95">
                        Chat Support
                    </a>
                </div>

                <div class="bg-white p-8 md:p-10 rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h4 class="text-slate-900 font-black text-xs md:text-sm uppercase tracking-widest mb-6">Informasi Sistem</h4>
                    <div class="space-y-5 md:space-y-6">
                        <div class="flex items-center justify-between pb-3 md:pb-4 border-b border-slate-50">
                            <span class="text-[10px] md:text-xs font-bold text-slate-400 uppercase">Versi App</span>
                            <span class="text-[10px] md:text-xs font-black text-slate-900 tracking-widest uppercase">v2.4.0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] md:text-xs font-bold text-slate-400 uppercase">Server</span>
                            <span class="text-[10px] md:text-xs font-black text-green-500 tracking-widest uppercase flex items-center">
                                <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                Online
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
