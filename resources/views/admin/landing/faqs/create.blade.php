<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-5">
            <a href="{{ route('admin.landing.faqs.index') }}" class="w-12 h-12 flex items-center justify-center bg-white border border-slate-100 text-slate-400 hover:text-teal-600 rounded-2xl transition-all shadow-sm active:scale-90">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                    {{ __('Tambah FAQ') }}
                </h2>
                <p class="text-sm text-slate-500 font-medium mt-1">Jawab pertanyaan yang sering muncul.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        <form action="{{ route('admin.landing.faqs.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2 space-y-10">
                    <div class="bg-white p-10 md:p-12 rounded-[3rem] border border-slate-100 shadow-sm space-y-8">
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Pertanyaan</label>
                            <input type="text" name="question" value="{{ old('question') }}" required
                                class="w-full px-8 py-5 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 placeholder-slate-300" placeholder="Contoh: Berapa lama waktu pengiriman?">
                        </div>

                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Jawaban</label>
                            <textarea name="answer" rows="6" required
                                class="w-full px-8 py-6 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-medium text-slate-600 leading-relaxed placeholder-slate-300" placeholder="Tuliskan jawaban lengkap..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="space-y-10">
                    <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm space-y-8">
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Urutan Tampil</label>
                            <input type="number" name="order" value="{{ old('order', 0) }}"
                                class="w-full px-8 py-5 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-black text-slate-900" placeholder="0">
                        </div>

                        <div class="pt-4 flex items-center justify-between px-2">
                            <span class="text-[13px] font-black text-slate-900 uppercase tracking-widest">Status Aktif</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                                <div class="w-14 h-7 bg-slate-100 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:rounded-full after:h-[21px] after:w-[21px] after:transition-all peer-checked:bg-teal-500 shadow-inner"></div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-6 bg-slate-900 text-white rounded-[2.5rem] font-black text-lg hover:bg-teal-600 transition-all shadow-2xl shadow-slate-300 hover:shadow-teal-200 active:scale-95 flex items-center justify-center">
                        Simpan FAQ
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
