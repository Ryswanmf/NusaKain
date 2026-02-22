<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3 md:space-x-5 w-full">
            <a href="{{ route('admin.produk.index') }}" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-white border border-slate-100 text-slate-400 hover:text-teal-600 rounded-xl md:rounded-2xl transition-all shadow-sm active:scale-90 flex-shrink-0">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div class="min-w-0">
                <h2 class="font-black text-xl md:text-3xl text-slate-900 tracking-tight truncate">
                    {{ __('Tambah Produk') }}
                </h2>
                <p class="hidden xs:block text-[11px] md:text-sm text-slate-500 font-medium mt-0.5">Buat entri kain baru ke katalog.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-10">
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-6 md:space-y-10">
                    <div class="bg-white p-6 md:p-12 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-6 md:space-y-8">
                        <div class="space-y-2 md:space-y-3">
                            <label for="name" class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nama Produk</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base placeholder-slate-300" placeholder="Contoh: Batik Mega Mendung">
                            @error('name') <p class="text-red-500 text-[10px] md:text-xs mt-2 ml-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2 md:space-y-3">
                            <label for="description" class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Deskripsi Lengkap</label>
                            <textarea name="description" id="description" rows="6" md:rows="8"
                                class="w-full px-5 py-4 md:px-8 md:py-6 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-medium text-slate-600 text-sm md:text-base leading-relaxed placeholder-slate-300" placeholder="Detail produk...">{{ old('description') }}</textarea>
                            @error('description') <p class="text-red-500 text-[10px] md:text-xs mt-2 ml-2 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Product Variations -->
                    <div class="bg-white p-6 md:p-12 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-6 md:space-y-8">
                        <div class="flex items-center justify-between">
                            <h3 class="text-base md:text-lg font-black text-slate-900 tracking-tight">Variasi Produk</h3>
                            <button type="button" onclick="addVariant()" class="px-4 py-2 bg-teal-50 text-teal-600 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-teal-600 hover:text-white transition-all">
                                + Tambah Variasi
                            </button>
                        </div>
                        <p class="text-xs text-slate-400 font-medium -mt-4">Tambahkan pilihan seperti Warna, Ukuran, atau Grade kain.</p>
                        
                        <div id="variants-container" class="space-y-4">
                            <!-- Variants will be injected here -->
                        </div>

                        <template id="variant-template">
                            <div class="variant-item p-6 bg-slate-50 rounded-[1.5rem] border border-slate-100 relative group animate__animated animate__fadeIn">
                                <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 w-8 h-8 bg-rose-500 text-white rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div class="space-y-1">
                                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Varian</label>
                                        <input type="text" name="variants[INDEX][name]" required placeholder="Misal: Merah" class="w-full px-4 py-3 bg-white border-none rounded-xl focus:ring-2 focus:ring-teal-600 font-bold text-slate-900 text-sm">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">SKU</label>
                                        <input type="text" name="variants[INDEX][sku]" placeholder="NK-VAR-001" class="w-full px-4 py-3 bg-white border-none rounded-xl focus:ring-2 focus:ring-teal-600 font-bold text-slate-900 text-sm">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Harga (Opsional)</label>
                                        <input type="number" name="variants[INDEX][price]" placeholder="Kosongkan jika sama" class="w-full px-4 py-3 bg-white border-none rounded-xl focus:ring-2 focus:ring-teal-600 font-bold text-slate-900 text-sm">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Stok</label>
                                        <input type="number" name="variants[INDEX][stock]" value="0" required class="w-full px-4 py-3 bg-white border-none rounded-xl focus:ring-2 focus:ring-teal-600 font-bold text-slate-900 text-sm">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Berat (gr)</label>
                                        <input type="number" name="variants[INDEX][weight]" placeholder="Sama" class="w-full px-4 py-3 bg-white border-none rounded-xl focus:ring-2 focus:ring-teal-600 font-bold text-slate-900 text-sm">
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="bg-white p-6 md:p-12 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm">
                        <h3 class="text-base md:text-lg font-black text-slate-900 tracking-tight mb-6 md:mb-8">Informasi Komersial</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                            <div class="space-y-2 md:space-y-3">
                                <label for="price" class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Harga Diskon (Rp)</label>
                                <div class="relative">
                                    <span class="absolute left-5 md:left-8 top-1/2 -translate-y-1/2 text-teal-600 font-bold italic text-sm md:text-base">Rp</span>
                                    <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0"
                                        class="w-full pl-12 md:pl-16 pr-5 md:pr-8 py-4 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-black text-slate-900 text-sm md:text-base" placeholder="0">
                                </div>
                                @error('price') <p class="text-red-500 text-[10px] md:text-xs mt-2 ml-2 font-bold">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2 md:space-y-3">
                                <label for="original_price" class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Harga Coret (Rp)</label>
                                <div class="relative">
                                    <span class="absolute left-5 md:left-8 top-1/2 -translate-y-1/2 text-slate-400 font-bold italic text-sm md:text-base">Rp</span>
                                    <input type="number" name="original_price" id="original_price" value="{{ old('original_price') }}" min="0"
                                        class="w-full pl-12 md:pl-16 pr-5 md:pr-8 py-4 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-400 line-through text-sm md:text-base" placeholder="0">
                                </div>
                                @error('original_price') <p class="text-red-500 text-[10px] md:text-xs mt-2 ml-2 font-bold">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mt-6">
                            <div class="space-y-2 md:space-y-3">
                                <label for="stock" class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Stok (Meter)</label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" required min="0"
                                    class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-black text-slate-900 text-sm md:text-base" placeholder="0">
                                @error('stock') <p class="text-red-500 text-[10px] md:text-xs mt-2 ml-2 font-bold">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2 md:space-y-3">
                                <label for="weight" class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Berat (Gram)</label>
                                <div class="relative">
                                    <input type="number" name="weight" id="weight" value="{{ old('weight', 100) }}" required min="1"
                                        class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-black text-slate-900 text-sm md:text-base" placeholder="100">
                                    <span class="absolute right-5 md:right-8 top-1/2 -translate-y-1/2 text-slate-400 font-bold italic text-xs md:text-sm pointer-events-none">gr</span>
                                </div>
                                @error('weight') <p class="text-red-500 text-[10px] md:text-xs mt-2 ml-2 font-bold">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="space-y-6 md:space-y-10">
                    <div class="bg-white p-6 md:p-10 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-6 md:space-y-8">
                        <div class="space-y-2 md:space-y-3">
                            <label for="category" class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Kategori</label>
                            <input type="text" name="category" id="category" value="{{ old('category') }}"
                                class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base" placeholder="Katun, Denim, dll.">
                            @error('category') <p class="text-red-500 text-[10px] md:text-xs mt-2 ml-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-2 md:pt-4 space-y-3">
                            <label for="rating" class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Rating Produk (0 - 5)</label>
                            <input type="number" name="rating" id="rating" value="{{ old('rating', 5.0) }}" step="0.1" min="0" max="5"
                                class="w-full px-5 py-4 md:px-8 md:py-5 bg-slate-50 border-none rounded-xl md:rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base">
                            @error('rating') <p class="text-red-500 text-[10px] md:text-xs mt-2 ml-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-2 md:pt-4 flex items-center justify-between px-2">
                            <span class="text-xs md:text-[13px] font-black text-slate-900 uppercase tracking-widest">Publikasikan</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                                <div class="w-12 h-6 md:w-14 md:h-7 bg-slate-100 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] md:after:top-[4px] after:start-[2px] md:after:start-[4px] after:bg-white after:rounded-full after:h-[20px] after:w-[20px] md:after:h-[21px] md:after:w-[21px] after:transition-all peer-checked:bg-teal-500"></div>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white p-6 md:p-10 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-4 md:space-y-6">
                        <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1 block text-center">Gambar Produk</label>
                        <div class="relative group aspect-square bg-slate-50 rounded-2xl md:rounded-[2.5rem] border-2 border-dashed border-slate-200 flex flex-col items-center justify-center overflow-hidden transition-all hover:border-teal-400 hover:bg-teal-50/30">
                            <input type="file" name="image" id="image" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                            <img id="preview" class="hidden absolute inset-0 w-full h-full object-cover">
                            <div id="upload-placeholder" class="text-center p-4">
                                <div class="w-12 h-12 md:w-16 md:h-16 bg-white rounded-xl md:rounded-2xl shadow-sm flex items-center justify-center mx-auto mb-3 border border-slate-100">
                                    <svg class="w-6 h-6 md:w-8 md:h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                </div>
                                <p class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-widest">Pilih Gambar</p>
                            </div>
                        </div>
                        <p class="text-[10px] text-slate-400 text-center font-bold italic tracking-tighter uppercase">WebP format recommended for better performance</p>
                        @error('image') <p class="text-red-500 text-[10px] md:text-xs mt-2 text-center font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="bg-white p-6 md:p-10 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-4 md:space-y-6">
                        <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1 block text-center">Gallery Produk (Multi-upload)</label>
                        <div class="bg-slate-50 p-6 rounded-2xl border-2 border-dashed border-slate-200">
                            <input type="file" name="gallery[]" multiple class="w-full text-xs font-bold text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-teal-50 file:text-teal-600 hover:file:bg-teal-100 transition-all cursor-pointer">
                            <p class="mt-3 text-[10px] text-slate-400 text-center font-medium italic">Anda dapat memilih lebih dari satu foto sekaligus.</p>
                        </div>
                        @error('gallery') <p class="text-red-500 text-[10px] md:text-xs mt-2 text-center font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-3 md:space-y-4 pt-2">
                        <button type="submit" class="w-full py-5 md:py-6 bg-slate-900 text-white rounded-xl md:rounded-[2.5rem] font-black text-base md:text-lg hover:bg-teal-600 transition-all shadow-2xl shadow-slate-300 active:scale-95 flex items-center justify-center">
                            Simpan Produk
                        </button>
                        <a href="{{ route('admin.produk.index') }}" class="block w-full py-4 text-center text-slate-400 font-black text-[11px] md:text-[13px] uppercase tracking-widest hover:text-red-500 transition-colors">
                            Batalkan
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        let variantIndex = 0;
        function addVariant() {
            const container = document.getElementById('variants-container');
            const template = document.getElementById('variant-template').innerHTML;
            const html = template.replace(/INDEX/g, variantIndex);
            container.insertAdjacentHTML('beforeend', html);
            variantIndex++;
        }

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
