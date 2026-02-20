<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 w-full">
            <div class="min-w-0">
                <h2 class="font-black text-2xl md:text-3xl text-slate-900 tracking-tight truncate">
                    {{ __('Manajemen Pengguna') }}
                </h2>
                <p class="text-[11px] md:text-sm text-slate-500 font-medium mt-0.5 truncate text-teal-600 md:text-slate-500">Kelola akses administrator dan akun pelanggan.</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center px-6 py-2.5 md:px-8 md:py-3 text-[12px] md:text-[14px] font-bold text-white bg-slate-900 rounded-xl md:rounded-2xl hover:bg-teal-600 transition-all shadow-xl shadow-slate-200 hover:shadow-teal-100 active:scale-95 self-start md:self-auto">
                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Tambah Pengguna
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        @if(session('success'))
            <div class="mb-6 p-4 md:p-5 bg-teal-50 border border-teal-100 text-teal-700 rounded-2xl md:rounded-[2rem] flex items-center shadow-sm">
                <div class="bg-teal-500 p-1 rounded-full mr-3 text-white flex-shrink-0">
                    <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="font-bold text-xs md:text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-[1.5rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[600px] md:min-w-full">
                    <thead>
                        <tr class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] bg-slate-50/50">
                            <th class="px-4 md:px-8 py-4 md:py-6">Pengguna</th>
                            <th class="px-4 md:px-8 py-4 md:py-6 text-center">Role</th>
                            <th class="hidden md:table-cell px-4 md:px-8 py-4 md:py-6">Terdaftar</th>
                            <th class="px-4 md:px-8 py-4 md:py-6 text-right">Kelola</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($users as $user)
                            <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                                <td class="px-4 md:px-8 py-4 md:py-6">
                                    <div class="flex items-center space-x-3 md:space-x-4">
                                        <div class="w-10 h-10 md:w-12 md:h-12 bg-slate-100 rounded-xl flex items-center justify-center font-black text-slate-400 text-xs md:text-sm uppercase flex-shrink-0">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div class="flex flex-col overflow-hidden">
                                            <span class="text-xs md:text-sm font-black text-slate-900 truncate">{{ $user->name }}</span>
                                            <span class="text-[10px] md:text-xs text-slate-400 font-medium truncate">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 md:px-8 py-4 md:py-6 text-center">
                                    <span class="px-3 py-1 {{ $user->role === 'admin' ? 'bg-rose-50 text-rose-600' : 'bg-teal-50 text-teal-600' }} text-[9px] md:text-[10px] font-black rounded-full uppercase tracking-widest whitespace-nowrap">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="hidden md:table-cell px-4 md:px-8 py-4 md:py-6 text-[10px] md:text-xs font-bold text-slate-400">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="px-4 md:px-8 py-4 md:py-6 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="p-2 text-slate-400 hover:text-teal-600 hover:bg-teal-50 rounded-lg transition-all">
                                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" {{ auth()->id() === $user->id ? 'disabled opacity-20' : '' }}>
                                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
