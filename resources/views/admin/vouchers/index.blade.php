@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-black text-slate-900 tracking-tight">Kelola <span class="text-teal-600">Voucher.</span></h1>
    <a href="{{ route('admin.vouchers.create') }}" class="px-6 py-3 bg-teal-600 text-white rounded-xl font-bold text-sm hover:bg-teal-700 transition-all shadow-lg shadow-teal-100">
        Tambah Voucher
    </a>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-teal-50 border border-teal-100 text-teal-700 rounded-xl font-bold text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-50/50">
                    <th class="px-8 py-5">Kode</th>
                    <th class="px-8 py-5">Tipe</th>
                    <th class="px-8 py-5">Nilai</th>
                    <th class="px-8 py-5">Minimal Order</th>
                    <th class="px-8 py-5">Kuota</th>
                    <th class="px-8 py-5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($vouchers as $voucher)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-6 font-black text-slate-900 uppercase tracking-tighter">{{ $voucher->code }}</td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $voucher->type === 'percentage' ? 'bg-blue-50 text-blue-600' : 'bg-indigo-50 text-indigo-600' }}">
                                {{ $voucher->type === 'percentage' ? 'Persen' : 'Nominal' }}
                            </span>
                        </td>
                        <td class="px-8 py-6 font-bold text-slate-700">
                            {{ $voucher->type === 'percentage' ? $voucher->value . '%' : 'Rp' . number_format($voucher->value, 0, ',', '.') }}
                        </td>
                        <td class="px-8 py-6 text-sm font-medium text-slate-500">Rp{{ number_format($voucher->min_order_amount, 0, ',', '.') }}</td>
                        <td class="px-8 py-6 text-sm font-medium text-slate-500">{{ $voucher->used_count }} / {{ $voucher->max_uses ?? '∞' }}</td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.vouchers.edit', $voucher) }}" class="p-2 text-slate-400 hover:text-teal-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" onsubmit="return confirm('Hapus voucher ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-8 py-12 text-center text-slate-400 font-medium italic">Belum ada voucher yang dibuat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
        {{ $vouchers->links() }}
    </div>
</div>
@endsection
