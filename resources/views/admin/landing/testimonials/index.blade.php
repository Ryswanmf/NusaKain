<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 w-full">
            <div class="min-w-0">
                <h2 class="font-black text-2xl md:text-3xl text-slate-900 tracking-tight truncate">
                    {{ __('Testimoni Partner') }}
                </h2>
                <p class="text-[11px] md:text-sm text-slate-500 font-medium mt-0.5 truncate">Apa kata UMKM fashion tentang Nusakain.</p>
            </div>
            <a href="{{ route('admin.landing.testimonials.create') }}" class="inline-flex items-center justify-center px-6 py-2.5 md:px-8 md:py-3 text-[12px] md:text-[14px] font-bold text-white bg-slate-900 rounded-xl md:rounded-2xl hover:bg-teal-600 transition-all shadow-xl active:scale-95 self-start md:self-auto">
                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Tambah Testimoni
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        @if(session('success'))
            <div class="mb-8 p-5 bg-teal-50 border border-teal-100 text-teal-700 rounded-2xl md:rounded-[2rem] flex items-center shadow-sm">
                <div class="bg-teal-500 p-1.5 rounded-full mr-4 text-white flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            @forelse($testimonials as $t)
                <div class="bg-white p-6 md:p-8 rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col justify-between group hover:shadow-xl transition-all duration-500">
                    <div>
                        <div class="flex items-center justify-between mb-4 md:mb-6">
                            <div class="flex text-yellow-400">
                                @for($i=0; $i<5; $i++)
                                    <svg class="w-3 h-3 md:w-4 md:h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <div class="flex space-x-1 md:space-x-2">
                                <a href="{{ route('admin.landing.testimonials.edit', $t->id) }}" class="w-8 h-8 flex items-center justify-center bg-slate-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.landing.testimonials.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center bg-slate-50 text-red-500 rounded-lg hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="text-slate-600 font-medium italic leading-relaxed mb-6 md:mb-8 text-sm md:text-base">"{{ $t->content }}"</p>
                    </div>
                    <div class="flex items-center space-x-3 md:space-x-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-{{ $t->avatar_color }}-500 flex items-center justify-center font-black text-white text-xs md:text-sm flex-shrink-0 uppercase">
                            {{ $t->avatar_text }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-slate-900 font-black tracking-tight leading-tight truncate">{{ $t->name }}</p>
                            <p class="text-[9px] md:text-[11px] text-slate-400 font-bold uppercase tracking-widest mt-0.5 truncate">{{ $t->position }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="md:col-span-2 py-20 text-center bg-white rounded-[2.5rem] border border-dashed border-slate-200">
                    <p class="text-slate-400 font-bold italic">Belum ada testimoni partner.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-8 md:mt-10">
            {{ $testimonials->links() }}
        </div>
    </div>
</x-app-layout>
