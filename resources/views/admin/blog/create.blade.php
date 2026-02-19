<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3 md:space-x-5 w-full">
            <a href="{{ route('admin.blog.index') }}" class="w-10 h-10 md:w-12 h-12 flex items-center justify-center bg-white border border-slate-100 text-slate-400 hover:text-teal-600 rounded-xl md:rounded-2xl transition-all shadow-sm active:scale-90 flex-shrink-0">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div class="min-w-0">
                <h2 class="font-black text-xl md:text-3xl text-slate-900 tracking-tight truncate">
                    {{ __('Tulis Artikel') }}
                </h2>
                <p class="hidden xs:block text-[11px] md:text-sm text-slate-500 font-medium mt-0.5 truncate">Bagikan wawasan tekstil terbaru Anda.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-10">
                <div class="lg:col-span-2 space-y-6 md:space-y-10">
                    <div class="bg-white p-6 md:p-12 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-6 md:space-y-8">
                        <div class="space-y-2 md:space-y-3">
                            <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Judul Artikel</label>
                            <input type="text" name="title" value="{{ old('title') }}" required
                                class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base placeholder-slate-300" placeholder="Judul artikel">
                        </div>

                        <div class="space-y-2 md:space-y-3">
                            <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Ringkasan</label>
                            <textarea name="excerpt" rows="3"
                                class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-medium text-slate-600 text-sm md:text-base leading-relaxed placeholder-slate-300">{{ old('excerpt') }}</textarea>
                        </div>

                        <div class="space-y-2 md:space-y-3">
                            <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Isi Konten</label>
                            <textarea name="content" rows="12" md:rows="15" required
                                class="w-full px-5 py-4 md:px-8 md:py-6 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-medium text-slate-600 text-sm md:text-base leading-relaxed placeholder-slate-300" placeholder="Tuliskan isi artikel lengkap...">{{ old('content') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 md:space-y-10">
                    <div class="bg-white p-6 md:p-10 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-6 md:space-y-8">
                        <div class="space-y-2 md:space-y-3">
                            <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Kategori</label>
                            <input type="text" name="category" value="{{ old('category') }}"
                                class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base" placeholder="Edukasi, Berita, dll.">
                        </div>

                        <div class="space-y-2 md:space-y-3">
                            <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Tgl Terbit</label>
                            <input type="date" name="published_at" value="{{ old('published_at', date('Y-m-d')) }}"
                                class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base">
                        </div>

                        <div class="pt-2 md:pt-4 flex items-center justify-between px-2">
                            <span class="text-xs md:text-[13px] font-black text-slate-900 uppercase tracking-widest">Publikasikan</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_published" value="1" class="sr-only peer" checked>
                                <div class="w-12 h-6 md:w-14 md:h-7 bg-slate-100 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] md:after:top-[4px] after:start-[2px] md:after:start-[4px] after:bg-white after:rounded-full after:h-[20px] after:w-[20px] md:after:h-[21px] md:after:w-[21px] after:transition-all peer-checked:bg-teal-500"></div>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white p-6 md:p-10 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-4 md:space-y-6">
                        <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1 block text-center">Gambar Sampul</label>
                        <div class="relative group aspect-video bg-slate-50 rounded-2xl md:rounded-[2.5rem] border-2 border-dashed border-slate-200 flex flex-col items-center justify-center overflow-hidden transition-all hover:border-teal-400 hover:bg-teal-50/30">
                            <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                            <img id="preview" class="hidden absolute inset-0 w-full h-full object-cover">
                            <div id="upload-placeholder" class="text-center p-4">
                                <div class="w-12 h-12 md:w-16 md:h-16 bg-white rounded-xl md:rounded-2xl shadow-sm flex items-center justify-center mx-auto mb-3 border border-slate-100">
                                    <svg class="w-6 h-6 md:w-8 md:h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                </div>
                                <p class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-widest">Pilih Gambar</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 md:space-y-4 pt-2">
                        <button type="submit" class="w-full py-5 md:py-6 bg-slate-900 text-white rounded-xl md:rounded-[2.5rem] font-black text-base md:text-lg hover:bg-teal-600 transition-all shadow-2xl shadow-slate-300 active:scale-95 flex items-center justify-center">
                            Posting Artikel
                        </button>
                        <a href="{{ route('admin.blog.index') }}" class="block w-full py-4 text-center text-slate-400 font-black text-[11px] md:text-[13px] uppercase tracking-widest hover:text-red-500 transition-colors">
                            Batalkan
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('upload-placeholder');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
