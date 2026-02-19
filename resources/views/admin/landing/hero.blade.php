<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 md:gap-4 w-full">
            <div class="min-w-0">
                <h2 class="font-black text-2xl md:text-3xl text-slate-900 tracking-tight truncate">
                    {{ __('Pengaturan Beranda') }}
                </h2>
                <p class="text-[11px] md:text-sm text-slate-500 font-medium mt-0.5 truncate text-teal-600 md:text-slate-500">Kelola konten utama halaman depan.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        @if(session('success'))
            <div class="mb-6 p-4 md:p-5 bg-teal-50 border border-teal-100 text-teal-700 rounded-2xl md:rounded-[2rem] flex items-center shadow-sm">
                <div class="bg-teal-500 p-1.5 rounded-full mr-3 text-white flex-shrink-0">
                    <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="font-bold text-xs md:text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.landing.hero.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-10">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6 md:space-y-10">
                    <!-- Hero Section -->
                    <div class="bg-white p-6 md:p-12 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-6 md:space-y-8">
                        <h3 class="text-base md:text-lg font-black text-slate-900 tracking-tight mb-4 md:mb-6 flex items-center">
                            <span class="w-8 h-8 bg-teal-50 text-teal-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </span>
                            Hero Section
                        </h3>

                        <div class="space-y-2 md:space-y-3">
                            <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Hero Badge</label>
                            <input type="text" name="hero_badge" value="{{ old('hero_badge', $setting->hero_badge) }}"
                                class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base" placeholder="Badge">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                            <div class="space-y-2 md:space-y-3">
                                <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Judul Utama</label>
                                <input type="text" name="hero_title_primary" value="{{ old('hero_title_primary', $setting->hero_title_primary) }}"
                                    class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base">
                            </div>
                            <div class="space-y-2 md:space-y-3">
                                <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Judul Italic</label>
                                <input type="text" name="hero_title_italic" value="{{ old('hero_title_italic', $setting->hero_title_italic) }}"
                                    class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base">
                            </div>
                        </div>

                        <div class="space-y-2 md:space-y-3">
                            <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Deskripsi Hero</label>
                            <textarea name="hero_description" rows="4"
                                class="w-full px-5 py-4 md:px-8 md:py-6 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-medium text-slate-600 text-sm md:text-base leading-relaxed">{{ old('hero_description', $setting->hero_description) }}</textarea>
                        </div>
                    </div>

                    <!-- Contact Info Section -->
                    <div class="bg-white p-6 md:p-12 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-6 md:space-y-8">
                        <h3 class="text-base md:text-lg font-black text-slate-900 tracking-tight mb-4 md:mb-6 flex items-center">
                            <span class="w-8 h-8 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </span>
                            Kontak & Alamat
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                            <div class="space-y-2 md:space-y-3">
                                <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Email Publik</label>
                                <input type="email" name="contact_email" value="{{ old('contact_email', $setting->contact_email) }}"
                                    class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base">
                            </div>
                            <div class="space-y-2 md:space-y-3">
                                <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">WhatsApp</label>
                                <input type="text" name="contact_phone" value="{{ old('contact_phone', $setting->contact_phone) }}"
                                    class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base">
                            </div>
                        </div>

                        <div class="space-y-2 md:space-y-3">
                            <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Alamat Lengkap</label>
                            <textarea name="contact_address" rows="3"
                                class="w-full px-5 py-4 md:px-8 md:py-6 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-medium text-slate-600 text-sm md:text-base leading-relaxed">{{ old('contact_address', $setting->contact_address) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Settings -->
                <div class="space-y-6 md:space-y-10">
                    <div class="bg-white p-6 md:p-10 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-4 md:space-y-6">
                        <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1 block text-center">Hero Image</label>
                        <div class="relative group aspect-square bg-slate-50 rounded-2xl md:rounded-[3rem] border-2 border-dashed border-slate-200 flex flex-col items-center justify-center overflow-hidden transition-all hover:border-teal-400 hover:bg-teal-50/30">
                            <input type="file" name="hero_image" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                            @if($setting->hero_image)
                                <img id="preview" src="{{ asset('storage/' . $setting->hero_image) }}" class="absolute inset-0 w-full h-full object-contain p-4">
                            @else
                                <img id="preview" class="hidden absolute inset-0 w-full h-full object-contain p-4">
                            @endif
                            <div id="upload-placeholder" class="{{ $setting->hero_image ? 'hidden' : '' }} text-center p-4">
                                <div class="w-12 h-12 md:w-16 md:h-16 bg-white rounded-xl md:rounded-2xl shadow-sm flex items-center justify-center mx-auto mb-3 border border-slate-100">
                                    <svg class="w-6 h-6 md:w-8 md:h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                </div>
                                <p class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-widest text-center">Ganti Hero</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 md:space-y-4 pt-2">
                        <button type="submit" class="w-full py-5 md:py-6 bg-slate-900 text-white rounded-xl md:rounded-[2.5rem] font-black text-base md:text-lg hover:bg-teal-600 transition-all shadow-2xl shadow-slate-300 active:scale-95 flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Simpan Perubahan
                        </button>
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
