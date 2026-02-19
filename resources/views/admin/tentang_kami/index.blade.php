<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 w-full">
            <div class="min-w-0">
                <h2 class="font-black text-2xl md:text-3xl text-slate-900 tracking-tight truncate">
                    {{ __('Manajemen Tim') }}
                </h2>
                <p class="text-[11px] md:text-sm text-slate-500 font-medium mt-0.5 truncate">Kelola profil orang-orang hebat Nusakain.</p>
            </div>
            <a href="{{ route('admin.tentang-kami.create') }}" class="inline-flex items-center justify-center px-6 py-2.5 md:px-8 md:py-3 text-[12px] md:text-[14px] font-bold text-white bg-slate-900 rounded-xl md:rounded-2xl hover:bg-teal-600 transition-all shadow-xl active:scale-95 self-start md:self-auto">
                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Tambah Anggota
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
                            <th class="px-4 md:px-8 py-4 md:py-6">Anggota Tim</th>
                            <th class="px-4 md:px-8 py-4 md:py-6">Jabatan</th>
                            <th class="px-4 md:px-8 py-4 md:py-6 text-center whitespace-nowrap">Urutan</th>
                            <th class="hidden sm:table-cell px-4 md:px-8 py-4 md:py-6 text-center">Visibilitas</th>
                            <th class="px-4 md:px-8 py-4 md:py-6 text-right">Kelola</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($members as $member)
                            <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                                <td class="px-4 md:px-8 py-4 md:py-6">
                                    <div class="flex items-center space-x-3 md:space-x-5">
                                        <div class="relative w-10 h-10 md:w-14 md:h-14 bg-slate-100 rounded-xl overflow-hidden flex-shrink-0 shadow-inner">
                                            @if($member->image)
                                                <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-50">
                                                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-[13px] md:text-[15px] font-black text-slate-900 leading-tight truncate">{{ $member->name }}</div>
                                            <div class="text-[9px] md:text-[11px] text-slate-400 font-bold mt-0.5 md:mt-1 uppercase tracking-wider">Profil Tim</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 md:px-8 py-4 md:py-6">
                                    <span class="text-xs md:text-sm font-bold text-teal-600 truncate max-w-[120px] block">{{ $member->position }}</span>
                                </td>
                                <td class="px-4 md:px-8 py-4 md:py-6 text-center text-xs md:text-sm font-black text-slate-400">
                                    {{ $member->order }}
                                </td>
                                <td class="hidden sm:table-cell px-4 md:px-8 py-4 md:py-6 text-center">
                                    @if($member->is_visible)
                                        <span class="px-2 py-0.5 md:px-3 md:py-1 bg-green-50 text-green-600 text-[9px] md:text-[10px] font-black rounded-full uppercase tracking-widest">Muncul</span>
                                    @else
                                        <span class="px-2 py-0.5 md:px-3 md:py-1 bg-slate-100 text-slate-400 text-[9px] md:text-[10px] font-black rounded-full uppercase tracking-widest">Sembunyi</span>
                                    @endif
                                </td>
                                <td class="px-4 md:px-8 py-4 md:py-6 text-right">
                                    <div class="flex items-center justify-end space-x-1 md:space-x-3">
                                        <a href="{{ route('admin.tentang-kami.edit', $member->id) }}" class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center bg-white border border-slate-100 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg md:rounded-xl transition-all shadow-sm active:scale-90">
                                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.tentang-kami.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Hapus profil anggota tim?')">
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
                                    <p class="text-slate-400 font-bold italic">Belum ada anggota tim terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($members->hasPages())
                <div class="px-4 md:px-8 py-4 md:py-6 bg-slate-50/50 border-t border-slate-50">
                    {{ $members->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
