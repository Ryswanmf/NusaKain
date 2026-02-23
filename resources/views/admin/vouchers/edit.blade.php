@extends('layouts.app')

@section('content')
<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.vouchers.index') }}" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-400 hover:text-teal-600 rounded-xl transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    </a>
    <h1 class="text-2xl font-black text-slate-900 tracking-tight">Edit <span class="text-teal-600">Voucher.</span></h1>
</div>

<div class="max-w-4xl bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8 md:p-12">
    <form action="{{ route('admin.vouchers.update', $voucher) }}" method="POST">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Kode Voucher</label>
                <input type="text" name="code" value="{{ old('code', $voucher->code) }}" required
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold uppercase">
                @error('code') <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Tipe Potongan</label>
                <select name="type" required class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
                    <option value="fixed" {{ $voucher->type === 'fixed' ? 'selected' : '' }}>Nominal Tetap (IDR)</option>
                    <option value="percentage" {{ $voucher->type === 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nilai Potongan</label>
                <input type="number" name="value" value="{{ old('value', (int)$voucher->value) }}" required
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Minimal Pembelian</label>
                <input type="number" name="min_order_amount" value="{{ old('min_order_amount', (int)$voucher->min_order_amount) }}" required
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Limit Per User</label>
                <input type="number" name="limit_per_user" value="{{ old('limit_per_user', $voucher->limit_per_user) }}" required
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Total Kuota (Max Uses)</label>
                <input type="number" name="max_uses" value="{{ old('max_uses', $voucher->max_uses) }}"
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Mulai Berlaku</label>
                <input type="datetime-local" name="start_date" value="{{ old('start_date', $voucher->start_date?->format('Y-m-d\TH:i')) }}"
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Berakhir Pada</label>
                <input type="datetime-local" name="end_date" value="{{ old('end_date', $voucher->end_date?->format('Y-m-d\TH:i')) }}"
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-bold">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-12 py-5 bg-teal-600 text-white rounded-[2rem] font-black text-lg hover:bg-teal-700 transition-all shadow-xl shadow-teal-100 active:scale-95">
                Perbarui Voucher
            </button>
            <div class="flex items-center gap-2 px-6 py-4 bg-slate-50 rounded-2xl">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ $voucher->is_active ? 'checked' : '' }} id="is_active" class="w-5 h-5 text-teal-600 rounded focus:ring-teal-500">
                <label for="is_active" class="text-xs font-bold text-slate-700">Status Aktif</label>
            </div>
        </div>
    </form>
</div>
@endsection
