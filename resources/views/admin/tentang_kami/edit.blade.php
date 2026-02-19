<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-5">
            <a href="{{ route('admin.tentang-kami.index') }}" class="w-12 h-12 flex items-center justify-center bg-white border border-slate-100 text-slate-400 hover:text-teal-600 rounded-2xl transition-all shadow-sm active:scale-90">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                    {{ __('Edit Anggota Tim') }}
                </h2>
                <p class="text-sm text-slate-500 font-medium mt-1">Perbarui profil <span class="text-teal-600 font-bold">{{ $member->name }}</span>.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        <form action="{{ route('admin.tentang-kami.update', $member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Profile Info -->
                <div class="lg:col-span-2 space-y-10">
                    <div class="bg-white p-10 md:p-12 rounded-[3rem] border border-slate-100 shadow-sm space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label for="name" class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nama Lengkap</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $member->name) }}" required
                                    class="w-full px-8 py-5 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 placeholder-slate-300" placeholder="Nama anggota tim">
                                @error('name') <p class="text-red-500 text-xs mt-2 ml-2 font-bold">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-3">
                                <label for="position" class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Jabatan / Peran</label>
                                <input type="text" name="position" id="position" value="{{ old('position', $member->position) }}" required
                                    class="w-full px-8 py-5 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 placeholder-slate-300" placeholder="Jabatan">
                                @error('position') <p class="text-red-500 text-xs mt-2 ml-2 font-bold">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label for="bio" class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Biografi Singkat</label>
                            <textarea name="bio" id="bio" rows="6"
                                class="w-full px-8 py-6 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-medium text-slate-600 leading-relaxed placeholder-slate-300" placeholder="Tuliskan biografi...">{{ old('bio', $member->bio) }}</textarea>
                            @error('bio') <p class="text-red-500 text-xs mt-2 ml-2 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Settings Sidebar -->
                <div class="space-y-10">
                    <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm space-y-8">
                        <div class="space-y-3">
                            <label for="order" class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Urutan Tampil</label>
                            <input type="number" name="order" id="order" value="{{ old('order', $member->order) }}"
                                class="w-full px-8 py-5 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-black text-slate-900" placeholder="0">
                            @error('order') <p class="text-red-500 text-xs mt-2 ml-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-4 flex items-center justify-between px-2">
                            <span class="text-[13px] font-black text-slate-900 uppercase tracking-widest">Tampilkan di Web</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_visible" value="1" class="sr-only peer" {{ $member->is_visible ? 'checked' : '' }}>
                                <div class="w-14 h-7 bg-slate-100 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:rounded-full after:h-[21px] after:w-[21px] after:transition-all peer-checked:bg-teal-500 shadow-inner"></div>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm space-y-6">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1 block text-center">Foto Profil</label>
                        <div class="relative group aspect-square bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200 flex flex-col items-center justify-center overflow-hidden transition-all hover:border-teal-400 hover:bg-teal-50/30">
                            <input type="file" name="image" id="image" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                            @if($member->image)
                                <img id="preview" src="{{ asset('storage/' . $member->image) }}" class="absolute inset-0 w-full h-full object-cover">
                            @else
                                <img id="preview" class="hidden absolute inset-0 w-full h-full object-cover">
                            @endif
                            <div id="upload-placeholder" class="{{ $member->image ? 'hidden' : '' }} text-center p-6">
                                <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Ubah Foto</p>
                            </div>
                        </div>
                        <p class="text-[10px] text-slate-400 text-center font-bold italic tracking-tighter">Square recommended (Max. 2MB)</p>
                        @error('image') <p class="text-red-500 text-xs mt-2 text-center font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-4 pt-2">
                        <button type="submit" class="w-full py-6 bg-slate-900 text-white rounded-[2.5rem] font-black text-lg hover:bg-teal-600 transition-all shadow-2xl shadow-slate-300 hover:shadow-teal-200 active:scale-95 flex items-center justify-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.tentang-kami.index') }}" class="block w-full py-5 text-center text-slate-400 font-black text-[13px] uppercase tracking-widest hover:text-red-500 transition-colors">
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
