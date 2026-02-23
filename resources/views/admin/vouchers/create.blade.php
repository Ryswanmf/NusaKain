@extends('layouts.app')

@section('content')
<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.vouchers.index') }}" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-400 hover:text-teal-600 rounded-xl transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    </a>
    <h1 class="text-2xl font-black text-slate-900 tracking-tight">Tambah <span class="text-teal-600">Voucher Baru.</span></h1>
</div>

<div class="max-w-4xl bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8 md:p-12">
    <form action="{{ route('admin.vouchers.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Kode Voucher</label>
                <input type="text" name="code" value="{{ old('code') }}" required placeholder="MISAL: NUSAKAIN10"
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold uppercase">
                @error('code') <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Tipe Potongan</label>
                <select name="type" required class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
                    <option value="fixed">Nominal Tetap (IDR)</option>
                    <option value="percentage">Persentase (%)</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nilai Potongan</label>
                <input type="number" name="value" value="{{ old('value') }}" required placeholder="Misal: 50000 atau 10"
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Minimal Pembelian</label>
                <input type="number" name="min_order_amount" value="{{ old('min_order_amount', 0) }}" required
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Limit Per User</label>
                <input type="number" name="limit_per_user" value="{{ old('limit_per_user', 1) }}" required
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Total Kuota (Max Uses)</label>
                <input type="number" name="max_uses" value="{{ old('max_uses') }}" placeholder="Kosongkan jika tak terbatas"
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Mulai Berlaku</label>
                <input type="datetime-local" name="start_date" value="{{ old('start_date') }}"
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Berakhir Pada</label>
                <input type="datetime-local" name="end_date" value="{{ old('end_date') }}"
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
            </div>
        </div>

        <button type="submit" class="w-full md:w-auto px-12 py-5 bg-teal-600 text-white rounded-[2rem] font-black text-lg hover:bg-teal-700 transition-all shadow-xl shadow-teal-100 active:scale-95">
            Simpan Voucher
        </button>
    </form>
</div>
@endsection
