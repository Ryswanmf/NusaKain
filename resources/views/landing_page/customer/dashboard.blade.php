@extends('layouts.guest')

@section('title', 'Akun Saya - Nusakain')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12 md:py-24">
    <div class="mb-12 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Halo, <span class="text-teal-600">{{ Auth::user()->name }}!</span></h1>
            <p class="mt-2 text-slate-500 font-medium text-lg italic">Selamat datang kembali di ekosistem kain premium.</p>
        </div>
        <div class="hidden md:block">
            <a href="{{ route('profile.edit') }}" class="px-8 py-4 bg-white border border-slate-100 text-slate-900 rounded-2xl font-black text-sm hover:bg-teal-600 hover:text-white transition-all shadow-sm active:scale-95">
                Edit Profil
            </a>
        </div>
    </div>

    <!-- Stats Highlights -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-sm hover:shadow-xl transition-all group">
            <div class="w-12 h-12 bg-teal-50 text-teal-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Pesanan</p>
            <h3 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $stats['total_orders'] }}</h3>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-sm hover:shadow-xl transition-all group">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Belum Dibayar</p>
            <h3 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $stats['pending_payments'] }}</h3>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-sm hover:shadow-xl transition-all group">
            <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Wishlist</p>
            <h3 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $stats['wishlist_count'] }}</h3>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-sm hover:shadow-xl transition-all group">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Review Saya</p>
            <h3 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $stats['total_reviews'] }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Recent Orders -->
        <div class="lg:col-span-2 space-y-8">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-black text-slate-900 tracking-tight italic">Pesanan <span class="text-teal-600">Terakhir.</span></h3>
                <a href="{{ route('customer.orders') }}" class="text-xs font-black text-teal-600 uppercase tracking-widest hover:underline">Lihat Semua</a>
            </div>

            @forelse($recentOrders as $order)
                <div class="bg-white p-8 rounded-[3rem] border border-slate-50 shadow-sm flex flex-col md:flex-row items-center justify-between gap-8 group hover:shadow-xl transition-all">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">#{{ $order->order_number }}</p>
                            <h4 class="text-lg font-black text-slate-900 italic tracking-tight">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</h4>
                            <p class="text-xs font-medium text-slate-500 mt-1">{{ $order->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <span class="px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest 
                            {{ $order->payment_status === 'paid' ? 'bg-teal-50 text-teal-600' : 'bg-amber-50 text-amber-600' }}">
                            {{ $order->payment_status }}
                        </span>
                        <a href="{{ route('customer.orders.show', $order->order_number) }}" class="flex-1 md:flex-none text-center px-6 py-3 bg-slate-900 text-white rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-teal-600 transition-all active:scale-95">Detail</a>
                    </div>
                </div>
            @empty
                <div class="p-12 bg-slate-50 rounded-[3rem] border border-dashed border-slate-200 text-center">
                    <p class="text-slate-400 font-bold italic">Belum ada pesanan.</p>
                </div>
            @endforelse
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-8">
            <div class="bg-slate-900 p-10 rounded-[3.5rem] text-white shadow-2xl relative overflow-hidden group">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-teal-500/10 rounded-full blur-3xl group-hover:bg-teal-500/20 transition-all duration-700"></div>
                <h3 class="text-xl font-black mb-6 tracking-tight italic">Butuh <span class="text-teal-400">Bantuan?</span></h3>
                <p class="text-slate-400 text-sm font-medium mb-10 leading-relaxed">Hubungi kami jika Anda memiliki kendala mengenai material kain atau status pengiriman.</p>
                <a href="{{ route('kontak.index') }}" class="w-full flex items-center justify-center py-4 bg-white text-slate-900 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-teal-500 hover:text-white transition-all active:scale-95 relative z-10 shadow-lg">
                    Hubungi Admin
                </a>
            </div>

            <div class="p-8 bg-white rounded-[3rem] border border-slate-100 space-y-6 shadow-sm">
                <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 pb-4">Menu Akun</h4>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('wishlist.index') }}" class="flex items-center gap-3 p-4 hover:bg-slate-50 rounded-2xl transition-all font-bold text-slate-700 hover:text-teal-600 group">
                        <svg class="w-5 h-5 text-slate-300 group-hover:text-teal-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        Wishlist
                    </a>
                    <a href="{{ route('customer.orders') }}" class="flex items-center gap-3 p-4 hover:bg-slate-50 rounded-2xl transition-all font-bold text-slate-700 hover:text-teal-600 group">
                        <svg class="w-5 h-5 text-slate-300 group-hover:text-teal-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        Riwayat Belanja
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 p-4 hover:bg-rose-50 rounded-2xl transition-all font-bold text-rose-500 group">
                            <svg class="w-5 h-5 text-rose-300 group-hover:text-rose-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Keluar Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
