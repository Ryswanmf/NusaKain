<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3 md:space-x-5 w-full">
            <a href="{{ route('admin.landing.pages.index') }}" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-white border border-slate-100 text-slate-400 hover:text-teal-600 rounded-xl md:rounded-2xl transition-all shadow-sm active:scale-90 flex-shrink-0">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div class="min-w-0">
                <h2 class="font-black text-xl md:text-3xl text-slate-900 tracking-tight truncate">
                    {{ __('Edit Halaman') }}
                </h2>
                <p class="hidden xs:block text-[11px] md:text-sm text-slate-500 font-medium mt-0.5">Konten: {{ $page->title }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        <form action="{{ route('admin.landing.pages.update', $page) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="max-w-4xl bg-white p-8 md:p-12 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-8 md:space-y-10">
                
                <div class="space-y-2 md:space-y-3">
                    <label for="title" class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Judul Halaman</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}" required
                        class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base">
                </div>

                <div class="space-y-2 md:space-y-3">
                    <label for="content" class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Isi Konten (HTML/Text)</label>
                    <textarea name="content" id="content" rows="12" required
                        class="w-full px-5 py-4 md:px-8 md:py-6 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-medium text-slate-600 text-sm md:text-base leading-relaxed">{{ old('content', $page->content) }}</textarea>
                    <p class="text-[10px] text-slate-400 font-bold italic mt-2 ml-1">Anda dapat menggunakan tag HTML dasar untuk mengatur format teks.</p>
                </div>

                <div class="pt-4 border-t border-slate-50 flex flex-col sm:flex-row gap-4">
                    <button type="submit" class="flex-1 py-5 bg-slate-900 text-white rounded-xl md:rounded-[2rem] font-black text-base md:text-lg hover:bg-teal-600 transition-all shadow-2xl shadow-slate-300 active:scale-95 flex items-center justify-center">
                        <svg class="w-5 h-5 md:w-6 md:h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Perbarui Halaman
                    </button>
                    <a href="{{ route('admin.landing.pages.index') }}" class="sm:w-48 py-5 bg-slate-100 text-slate-400 rounded-xl md:rounded-[2rem] font-black text-sm uppercase tracking-widest text-center hover:bg-slate-200 transition-all">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
