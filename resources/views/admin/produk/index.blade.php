<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 w-full">
            <div class="min-w-0">
                <h2 class="font-black text-2xl md:text-3xl text-slate-900 tracking-tight truncate">
                    {{ __('Katalog Produk') }}
                </h2>
                <p class="text-[11px] md:text-sm text-slate-500 font-medium mt-0.5 truncate">Kelola stok dan informasi kain Anda.</p>
            </div>
            <a href="{{ route('admin.produk.create') }}" class="inline-flex items-center justify-center px-6 py-2.5 md:px-8 md:py-3 text-[12px] md:text-[14px] font-bold text-white bg-slate-900 rounded-xl md:rounded-2xl hover:bg-teal-600 transition-all shadow-xl shadow-slate-200 hover:shadow-teal-100 active:scale-95 self-start md:self-auto">
                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        @if(session('success'))
            <div class="mb-6 p-4 md:p-5 bg-teal-50 border border-teal-100 text-teal-700 rounded-2xl md:rounded-[2rem] flex items-center shadow-sm">
                <div class="bg-teal-500 p-1 rounded-full mr-3 text-white flex-shrink-0">
                    <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="font-bold text-xs md:text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-[1.5rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[600px] md:min-w-full">
                    <thead>
                        <tr class="text-[9px] md:text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] bg-slate-50/50">
                            <th class="px-4 md:px-8 py-4 md:py-6">Informasi Produk</th>
                            <th class="hidden sm:table-cell px-4 md:px-8 py-4 md:py-6">Kategori</th>
                            <th class="px-4 md:px-8 py-4 md:py-6 text-center">Stok</th>
                            <th class="px-4 md:px-8 py-4 md:py-6">Harga</th>
                            <th class="hidden md:table-cell px-4 md:px-8 py-4 md:py-6 text-center">Status</th>
                            <th class="px-4 md:px-8 py-4 md:py-6 text-right">Kelola</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($products as $product)
                            <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                                <td class="px-4 md:px-8 py-4 md:py-6">
                                    <div class="flex items-center space-x-3 md:space-x-5">
                                        <div class="relative w-10 h-10 md:w-16 md:h-16 bg-slate-100 rounded-lg md:rounded-[1.25rem] overflow-hidden flex-shrink-0 shadow-inner">
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-50">
                                                    <svg class="w-5 h-5 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-[13px] md:text-[15px] font-black text-slate-900 leading-tight truncate">{{ $product->name }}</div>
                                            <div class="text-[9px] md:text-[11px] text-slate-400 font-bold mt-0.5 md:mt-1 truncate">#NK-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden sm:table-cell px-4 md:px-8 py-4 md:py-6">
                                    <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[9px] md:text-[11px] font-black rounded-full uppercase tracking-wider">{{ $product->category ?? 'Umum' }}</span>
                                </td>
                                <td class="px-4 md:px-8 py-4 md:py-6 text-center">
                                    <span class="text-xs md:text-sm font-bold {{ $product->stock <= 5 ? 'text-red-600' : 'text-slate-700' }}">{{ $product->stock }}</span>
                                </td>
                                <td class="px-4 md:px-8 py-4 md:py-6">
                                    <div class="text-xs md:text-[15px] font-black text-slate-900 whitespace-nowrap italic">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                                </td>
                                <td class="hidden md:table-cell px-4 md:px-8 py-4 md:py-6 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-1.5 h-1.5 md:w-2 md:h-2 {{ $product->is_active ? 'bg-teal-500 animate-pulse' : 'bg-slate-300' }} rounded-full mb-1"></div>
                                        <span class="text-[9px] md:text-[10px] font-black {{ $product->is_active ? 'text-teal-600' : 'text-slate-400' }} uppercase tracking-widest">{{ $product->is_active ? 'Aktif' : 'Draft' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 md:px-8 py-4 md:py-6 text-right">
                                    <div class="flex items-center justify-end space-x-1 md:space-x-3">
                                        <a href="{{ route('admin.produk.edit', $product->id) }}" class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center bg-white border border-slate-100 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg md:rounded-xl transition-all shadow-sm active:scale-90">
                                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.produk.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center bg-white border border-slate-100 text-red-500 hover:bg-red-600 hover:text-white rounded-lg md:rounded-xl transition-all shadow-sm active:scale-90">
                                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-24 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 md:w-20 md:h-20 bg-slate-50 text-slate-200 rounded-2xl md:rounded-[2rem] flex items-center justify-center mb-6">
                                            <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                        </div>
                                        <h3 class="text-base md:text-lg font-black text-slate-900 tracking-tight">Gudang Kosong</h3>
                                        <p class="text-xs md:text-sm text-slate-400 font-medium mt-1">Anda belum memiliki produk apapun.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($products->hasPages())
                <div class="px-4 md:px-8 py-4 md:py-6 bg-slate-50/50 border-t border-slate-50">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
