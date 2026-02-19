<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                    {{ __('Halaman Legal') }}
                </h2>
                <p class="text-sm text-slate-500 font-medium mt-1">Kelola konten Syarat Ketentuan dan Kebijakan Privasi.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        @if(session('success'))
            <div class="mb-8 p-5 bg-teal-50 border border-teal-100 text-teal-700 rounded-[2rem] flex items-center shadow-sm">
                <div class="bg-teal-500 p-1.5 rounded-full mr-4 text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($pages as $page)
                <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm flex flex-col justify-between group hover:shadow-xl transition-all duration-500">
                    <div>
                        <div class="w-14 h-14 bg-slate-900 text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-slate-100 group-hover:bg-teal-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">{{ $page->title }}</h3>
                        <p class="text-slate-500 text-sm font-medium leading-relaxed mb-8">Terakhir diperbarui: {{ $page->updated_at->format('d M Y') }}</p>
                    </div>
                    <a href="{{ route('admin.landing.pages.edit', $page->id) }}" class="inline-flex items-center justify-center px-8 py-4 bg-slate-50 text-slate-900 rounded-[1.5rem] font-black text-sm hover:bg-teal-600 hover:text-white transition-all active:scale-95">
                        Edit Konten
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
