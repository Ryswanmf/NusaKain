<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-5">
            <a href="{{ route('admin.landing.pages.index') }}" class="w-12 h-12 flex items-center justify-center bg-white border border-slate-100 text-slate-400 hover:text-teal-600 rounded-2xl transition-all shadow-sm active:scale-90">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                    {{ __('Edit Halaman Legal') }}
                </h2>
                <p class="text-sm text-slate-500 font-medium mt-1">Mengedit: <span class="text-teal-600 font-bold">{{ $page->title }}</span></p>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        <form action="{{ route('admin.landing.pages.update', $page->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="bg-white p-10 md:p-12 rounded-[3rem] border border-slate-100 shadow-sm space-y-8">
                <div class="space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Judul Halaman</label>
                    <input type="text" name="title" value="{{ old('title', $page->title) }}" required
                        class="w-full px-8 py-5 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900">
                </div>

                <div class="space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Isi Konten (HTML/Text)</label>
                    <textarea name="content" rows="20"
                        class="w-full px-8 py-6 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-medium text-slate-600 leading-relaxed">{{ old('content', $page->content) }}</textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full md:w-auto px-12 py-6 bg-slate-900 text-white rounded-[2.5rem] font-black text-lg hover:bg-teal-600 transition-all shadow-2xl shadow-slate-300 hover:shadow-teal-200 active:scale-95 flex items-center justify-center">
                        Simpan Konten Halaman
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
