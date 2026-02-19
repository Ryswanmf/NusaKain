<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-5">
            <a href="{{ route('admin.landing.testimonials.index') }}" class="w-12 h-12 flex items-center justify-center bg-white border border-slate-100 text-slate-400 hover:text-teal-600 rounded-2xl transition-all shadow-sm active:scale-90">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                    {{ __('Edit Testimoni') }}
                </h2>
                <p class="text-sm text-slate-500 font-medium mt-1">Perbarui kata-kata partner Nusakain.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        <form action="{{ route('admin.landing.testimonials.update', $testimonial->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2 space-y-10">
                    <div class="bg-white p-10 md:p-12 rounded-[3rem] border border-slate-100 shadow-sm space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nama Partner</label>
                                <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" required
                                    class="w-full px-8 py-5 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 placeholder-slate-300">
                            </div>
                            <div class="space-y-3">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Jabatan / Brand</label>
                                <input type="text" name="position" value="{{ old('position', $testimonial->position) }}"
                                    class="w-full px-8 py-5 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 placeholder-slate-300">
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Isi Testimoni</label>
                            <textarea name="content" rows="6" required
                                class="w-full px-8 py-6 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-medium text-slate-600 leading-relaxed placeholder-slate-300">{{ old('content', $testimonial->content) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="space-y-10">
                    <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm space-y-8">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest text-center">Avatar Initials</h3>
                        
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Inisial (Max 2 Huruf)</label>
                            <input type="text" name="avatar_text" value="{{ old('avatar_text', $testimonial->avatar_text) }}" maxlength="2"
                                class="w-full px-8 py-5 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-black text-center text-xl text-slate-900" placeholder="AS">
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Warna Background</label>
                            <select name="avatar_color" class="w-full px-8 py-5 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900">
                                <option value="teal" {{ $testimonial->avatar_color == 'teal' ? 'selected' : '' }}>Teal (Nusakain Blue)</option>
                                <option value="indigo" {{ $testimonial->avatar_color == 'indigo' ? 'selected' : '' }}>Indigo</option>
                                <option value="emerald" {{ $testimonial->avatar_color == 'emerald' ? 'selected' : '' }}>Emerald</option>
                                <option value="rose" {{ $testimonial->avatar_color == 'rose' ? 'selected' : '' }}>Rose</option>
                                <option value="amber" {{ $testimonial->avatar_color == 'amber' ? 'selected' : '' }}>Amber</option>
                                <option value="slate" {{ $testimonial->avatar_color == 'slate' ? 'selected' : '' }}>Slate</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-6 bg-slate-900 text-white rounded-[2.5rem] font-black text-lg hover:bg-teal-600 transition-all shadow-2xl shadow-slate-300 hover:shadow-teal-200 active:scale-95 flex items-center justify-center">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
