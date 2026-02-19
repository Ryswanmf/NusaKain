<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                    {{ __('Manajemen FAQ') }}
                </h2>
                <p class="text-sm text-slate-500 font-medium mt-1">Kelola pertanyaan yang sering diajukan pengunjung.</p>
            </div>
            <a href="{{ route('admin.landing.faqs.create') }}" class="inline-flex items-center justify-center px-8 py-3 text-[14px] font-bold text-white bg-slate-900 rounded-2xl hover:bg-teal-600 transition-all shadow-xl shadow-slate-200 hover:shadow-teal-100 active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Tambah FAQ
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        @if(session('success'))
            <div class="mb-8 p-5 bg-teal-50 border border-teal-100 text-teal-700 rounded-[2rem] flex items-center shadow-sm">
                <div class="bg-teal-500 p-1.5 rounded-full mr-4 text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] bg-slate-50/50">
                            <th class="px-8 py-6">Pertanyaan</th>
                            <th class="px-8 py-6 text-center">Urutan</th>
                            <th class="px-8 py-6 text-center">Status</th>
                            <th class="px-8 py-6 text-right">Kelola</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($faqs as $faq)
                            <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                                <td class="px-8 py-6">
                                    <div class="text-[15px] font-black text-slate-900 leading-tight">{{ $faq->question }}</div>
                                    <div class="text-[11px] text-slate-400 font-bold mt-1 line-clamp-1 italic">{{ $faq->answer }}</div>
                                </td>
                                <td class="px-8 py-6 text-center text-sm font-black text-slate-400">
                                    {{ $faq->order }}
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($faq->is_active)
                                        <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-black rounded-full uppercase tracking-widest">Aktif</span>
                                    @else
                                        <span class="px-3 py-1 bg-slate-100 text-slate-400 text-[10px] font-black rounded-full uppercase tracking-widest">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('admin.landing.faqs.edit', $faq->id) }}" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl transition-all shadow-sm active:scale-90">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.landing.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-red-500 hover:bg-red-600 hover:text-white rounded-xl transition-all shadow-sm active:scale-90">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-24 text-center">
                                    <p class="text-slate-400 font-bold italic">Belum ada FAQ terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
