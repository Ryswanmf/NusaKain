<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 w-full">
            <div class="min-w-0">
                <h2 class="font-black text-2xl md:text-3xl text-slate-900 tracking-tight truncate">
                    {{ __('Tambah Pengguna') }}
                </h2>
                <p class="text-[11px] md:text-sm text-slate-500 font-medium mt-0.5 truncate text-teal-600 md:text-slate-500">Buat akun administrator atau pelanggan baru.</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-slate-100 text-slate-900 rounded-xl font-bold hover:bg-slate-200 transition-all">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="max-w-3xl bg-white p-8 md:p-12 rounded-[2rem] md:rounded-[3rem] border border-slate-100 shadow-sm space-y-6 md:space-y-8">
                
                <div class="space-y-2 md:space-y-3">
                    <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-5 py-4 bg-slate-50 border-none rounded-xl md:rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                    <div class="space-y-2 md:space-y-3">
                        <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-5 py-4 bg-slate-50 border-none rounded-xl md:rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="space-y-2 md:space-y-3">
                        <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Role</label>
                        <select name="role" required
                            class="w-full px-5 py-4 bg-slate-50 border-none rounded-xl md:rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base appearance-none">
                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>Pelanggan (User)</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator (Admin)</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                    <div class="space-y-2 md:space-y-3">
                        <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-5 py-4 bg-slate-50 border-none rounded-xl md:rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="space-y-2 md:space-y-3">
                        <label class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-5 py-4 bg-slate-50 border-none rounded-xl md:rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 text-sm md:text-base">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-5 bg-slate-900 text-white rounded-xl md:rounded-[2rem] font-black text-base md:text-lg hover:bg-teal-600 transition-all shadow-2xl shadow-slate-300 active:scale-95 flex items-center justify-center">
                        <svg class="w-5 h-5 md:w-6 md:h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Simpan Pengguna
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
