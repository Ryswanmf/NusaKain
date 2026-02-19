<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 w-full">
            <div class="min-w-0">
                <h2 class="font-black text-2xl md:text-3xl text-slate-900 tracking-tight truncate">
                    {{ __('Pesan Masuk') }}
                </h2>
                <p class="text-[11px] md:text-sm text-slate-500 font-medium mt-0.5 truncate">Daftar pertanyaan dan saran dari pengunjung.</p>
            </div>
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
                            <th class="px-4 md:px-8 py-4 md:py-6">Pengirim</th>
                            <th class="px-4 md:px-8 py-4 md:py-6">Subjek</th>
                            <th class="hidden sm:table-cell px-4 md:px-8 py-4 md:py-6 text-center">Status</th>
                            <th class="hidden md:table-cell px-4 md:px-8 py-4 md:py-6">Tanggal</th>
                            <th class="px-4 md:px-8 py-4 md:py-6 text-right">Kelola</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($messages as $msg)
                            <tr class="group hover:bg-slate-50/50 transition-all duration-300 {{ !$msg->is_read ? 'bg-teal-50/20' : '' }}">
                                <td class="px-4 md:px-8 py-4 md:py-6">
                                    <div class="flex items-center space-x-3 md:space-x-4">
                                        <div class="w-8 h-8 md:w-10 md:h-10 bg-slate-100 rounded-full flex items-center justify-center font-bold text-slate-400 text-[10px] md:text-xs uppercase flex-shrink-0">
                                            {{ substr($msg->name, 0, 1) }}
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-[13px] md:text-[14px] font-black text-slate-900 leading-tight truncate">{{ $msg->name }}</div>
                                            <div class="text-[9px] md:text-[11px] text-slate-400 font-bold mt-0.5 tracking-tight truncate">{{ $msg->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 md:px-8 py-4 md:py-6">
                                    <div class="text-[13px] md:text-[14px] {{ !$msg->is_read ? 'font-black text-slate-900' : 'font-medium text-slate-600' }} line-clamp-1">
                                        {{ $msg->subject ?? '(Tanpa Subjek)' }}
                                    </div>
                                </td>
                                <td class="hidden sm:table-cell px-4 md:px-8 py-4 md:py-6 text-center">
                                    @if(!$msg->is_read)
                                        <span class="px-2 py-0.5 md:px-3 md:py-1 bg-teal-100 text-teal-600 text-[9px] md:text-[10px] font-black rounded-full uppercase tracking-widest">Baru</span>
                                    @else
                                        <span class="px-2 py-0.5 md:px-3 md:py-1 bg-slate-100 text-slate-400 text-[9px] md:text-[10px] font-black rounded-full uppercase tracking-widest">Dibaca</span>
                                    @endif
                                </td>
                                <td class="hidden md:table-cell px-4 md:px-8 py-4 md:py-6 text-[12px] md:text-[13px] font-bold text-slate-500 whitespace-nowrap">
                                    {{ $msg->created_at->diffForHumans() }}
                                </td>
                                <td class="px-4 md:px-8 py-4 md:py-6 text-right">
                                    <div class="flex items-center justify-end space-x-1 md:space-x-3">
                                        <a href="{{ route('admin.kontak.show', $msg->id) }}" class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center bg-white border border-slate-100 text-teal-600 hover:bg-teal-600 hover:text-white rounded-lg md:rounded-xl transition-all shadow-sm active:scale-90">
                                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.kontak.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
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
                                <td colspan="5" class="px-8 py-24 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 md:w-20 md:h-20 bg-slate-50 text-slate-200 rounded-2xl md:rounded-[2rem] flex items-center justify-center mb-6">
                                            <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        </div>
                                        <h3 class="text-base md:text-lg font-black text-slate-900 tracking-tight">Kotak Masuk Bersih</h3>
                                        <p class="text-xs md:text-sm text-slate-400 font-medium mt-1">Belum ada pesan baru.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($messages->hasPages())
                <div class="px-4 md:px-8 py-4 md:py-6 bg-slate-50/50 border-t border-slate-50">
                    {{ $messages->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
