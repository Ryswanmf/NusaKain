@extends('layouts.guest')

@section('title', 'FAQ - Pertanyaan Umum Nusakain')

@section('content')
<main class="max-w-4xl mx-auto px-6 py-24">
    <div class="text-center mb-20">
        <span class="inline-block px-4 py-1.5 bg-teal-50 text-teal-600 text-sm font-bold rounded-full mb-6">Bantuan</span>
        <h1 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tight leading-tight">
            Pertanyaan yang <br>
            <span class="text-teal-600 italic">Sering Diajukan.</span>
        </h1>
        <p class="mt-8 text-lg text-slate-500 leading-relaxed">
            Temukan jawaban cepat untuk pertanyaan umum seputar produk, pengiriman, dan layanan kami.
        </p>
    </div>

    <div class="space-y-6">
        @forelse($faqs as $faq)
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-500">
                <button class="w-full px-10 py-8 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq({{ $faq->id }})">
                    <span class="text-lg font-black text-slate-900 tracking-tight">{{ $faq->question }}</span>
                    <div class="w-10 h-10 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center group-hover:bg-teal-600 group-hover:text-white transition-all transform duration-300" id="icon-{{ $faq->id }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </button>
                <div class="hidden px-10 pb-8 transition-all duration-500" id="faq-{{ $faq->id }}">
                    <p class="text-slate-500 font-medium leading-relaxed border-t border-slate-50 pt-6">
                        {{ $faq->answer }}
                    </p>
                </div>
            </div>
        @empty
            <div class="text-center py-20 bg-slate-50 rounded-[3rem] border border-dashed border-slate-200">
                <p class="text-slate-400 font-bold italic">Halaman FAQ sedang diperbarui.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-20 p-12 bg-slate-900 rounded-[3rem] text-center text-white relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-2xl font-black mb-4">Masih punya pertanyaan?</h2>
            <p class="text-slate-400 mb-8 max-w-md mx-auto">Tim kami siap membantu menjawab pertanyaan spesifik Anda seputar material kain.</p>
            <a href="{{ route('kontak.index') }}" class="inline-flex items-center justify-center px-10 py-4 bg-teal-500 text-slate-900 rounded-2xl font-black hover:bg-teal-400 transition-all active:scale-95 shadow-lg shadow-teal-900/20">
                Hubungi Kami Sekarang
            </a>
        </div>
    </div>
</main>

<script>
    function toggleFaq(id) {
        const content = document.getElementById('faq-' + id);
        const icon = document.getElementById('icon-' + id);
        
        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>
@endsection
