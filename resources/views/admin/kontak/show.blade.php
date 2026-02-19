<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3 md:space-x-5 w-full">
            <a href="{{ route('admin.kontak.index') }}" class="w-10 h-10 md:w-12 h-12 flex items-center justify-center bg-white border border-slate-100 text-slate-400 hover:text-teal-600 rounded-xl md:rounded-2xl transition-all shadow-sm active:scale-90 flex-shrink-0">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div class="min-w-0">
                <h2 class="font-black text-xl md:text-3xl text-slate-900 tracking-tight truncate">
                    {{ __('Detail Pesan') }}
                </h2>
                <p class="hidden xs:block text-[11px] md:text-sm text-slate-500 font-medium mt-0.5 truncate">Dari {{ $kontak->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-10">
            <!-- Message Content -->
            <div class="lg:col-span-2 space-y-6 md:space-y-10">
                <div class="bg-white p-6 md:p-12 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm">
                    <div class="mb-6 md:mb-10">
                        <span class="text-[9px] md:text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2">Subjek Pesan</span>
                        <h1 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight">{{ $kontak->subject ?? '(Tanpa Subjek)' }}</h1>
                    </div>

                    <div class="space-y-4">
                        <span class="text-[9px] md:text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-4">Isi Pesan</span>
                        <div class="text-slate-700 leading-relaxed font-medium bg-slate-50 p-5 md:p-8 rounded-xl md:rounded-[2rem] italic text-sm md:text-base">
                            "{!! nl2br(e($kontak->message)) !!}"
                        </div>
                    </div>

                    <div class="mt-8 md:mt-12 pt-6 md:pt-10 border-t border-slate-50 flex flex-col sm:flex-row gap-4">
                        <a href="mailto:{{ $kontak->email }}?subject=Re: {{ $kontak->subject }}" 
                           class="inline-flex items-center justify-center px-8 py-4 bg-slate-900 text-white rounded-xl md:rounded-[2rem] font-black text-sm hover:bg-teal-600 transition-all shadow-xl active:scale-95">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Balas via Email
                        </a>
                        <form action="{{ route('admin.kontak.toggle-read', $kontak->id) }}" method="POST" class="w-full sm:w-auto">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full inline-flex items-center justify-center px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-xl md:rounded-[2rem] font-black text-sm hover:bg-slate-50 transition-all active:scale-95">
                                Tandai Belum Dibaca
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sender Sidebar -->
            <div class="space-y-6 md:space-y-10">
                <div class="bg-white p-6 md:p-10 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-6 md:space-y-8">
                    <h3 class="text-base md:text-lg font-black text-slate-900 tracking-tight mb-4 md:mb-6">Pengirim</h3>
                    
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 md:w-16 md:h-16 bg-teal-50 text-teal-600 rounded-xl md:rounded-[1.5rem] flex items-center justify-center font-black text-xl md:text-2xl uppercase">
                            {{ substr($kontak->name, 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <p class="font-black text-slate-900 leading-tight truncate">{{ $kontak->name }}</p>
                            <p class="text-[10px] md:text-xs text-slate-400 font-bold mt-1 uppercase">Pengunjung</p>
                        </div>
                    </div>

                    <div class="space-y-4 md:space-y-6 text-sm">
                        <div class="space-y-1">
                            <span class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest block">Email</span>
                            <span class="font-bold text-slate-700 break-all">{{ $kontak->email }}</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest block">Waktu</span>
                            <span class="font-bold text-slate-700 block">{{ $kontak->created_at->format('d M Y, H:i') }}</span>
                            <span class="text-[10px] text-slate-400 italic">({{ $kontak->created_at->diffForHumans() }})</span>
                        </div>
                    </div>
                </div>

                <div class="bg-red-50 p-6 md:p-10 rounded-[2rem] md:rounded-[3rem] border border-red-100 space-y-4 md:space-y-6">
                    <h3 class="text-[10px] md:text-xs font-black text-red-600 uppercase tracking-widest text-center">Zona Berbahaya</h3>
                    <form action="{{ route('admin.kontak.destroy', $kontak->id) }}" method="POST" onsubmit="return confirm('Hapus pesan selamanya?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-xl md:rounded-[1.5rem] font-black text-sm hover:bg-red-700 transition-all active:scale-95 shadow-lg">
                            Hapus Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
