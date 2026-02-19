@extends('layouts.guest')

@section('title', 'Pesanan Saya - Nusakain')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12 md:py-24">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight">Pesanan <span class="text-teal-600">Saya.</span></h1>
        <p class="mt-4 text-slate-500 font-medium">Pantau riwayat belanja kain premium Anda di sini.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[600px]">
                <thead>
                    <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] bg-slate-50/50">
                        <th class="px-8 py-6">ID Pesanan</th>
                        <th class="px-8 py-6">Tanggal</th>
                        <th class="px-8 py-6 text-center">Status</th>
                        <th class="px-8 py-6">Total</th>
                        <th class="px-8 py-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($orders as $order)
                        <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                            <td class="px-8 py-6">
                                <span class="text-sm font-black text-slate-900">#{{ $order->order_number }}</span>
                            </td>
                            <td class="px-8 py-6 text-sm font-medium text-slate-500">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                            <td class="px-8 py-6 text-center">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-amber-50 text-amber-600',
                                        'processing' => 'bg-blue-50 text-blue-600',
                                        'shipped' => 'bg-indigo-50 text-indigo-600',
                                        'completed' => 'bg-green-50 text-green-600',
                                        'cancelled' => 'bg-red-50 text-red-600',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $statusClasses[$order->status] }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-sm font-black text-slate-900 italic">
                                Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('customer.orders.show', $order->order_number) }}" class="inline-flex items-center px-5 py-2 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-teal-600 transition-all active:scale-95 shadow-lg shadow-slate-200 hover:shadow-teal-100">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-24 text-center">
                                <div class="w-16 h-16 bg-slate-50 text-slate-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                </div>
                                <h3 class="text-xl font-black text-slate-900 tracking-tight">Belum ada pesanan.</h3>
                                <p class="mt-2 text-slate-500 font-medium mb-8">Anda belum melakukan pemesanan kain apapun.</p>
                                <a href="{{ route('produk.index') }}" class="px-8 py-3 bg-teal-600 text-white rounded-xl font-bold hover:bg-teal-700 transition-all">Mulai Belanja</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-50">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</main>
@endsection
