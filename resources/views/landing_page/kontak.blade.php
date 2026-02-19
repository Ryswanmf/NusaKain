@extends('layouts.guest')

@section('title', 'Hubungi Kami - Nusakain Indonesia')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight">Hubungi <span class="text-teal-600">Kami</span></h1>
        <p class="mt-4 text-slate-500 max-w-xl">Punya pertanyaan atau ingin berkonsultasi mengenai material kain? Tim kami siap membantu Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
        <!-- Contact Form -->
        <div class="bg-white rounded-[3rem] p-8 md:p-12 border border-gray-100 shadow-sm">
            @if(session('success'))
                <div class="mb-8 p-6 bg-green-50 text-green-700 rounded-3xl border border-green-100 flex items-center gap-4">
                    <svg class="w-8 h-8 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="font-bold text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('kontak.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-bold text-slate-700 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" required placeholder="Contoh: Budi Santoso"
                            class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all">
                    </div>
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-bold text-slate-700 ml-1">Email</label>
                        <input type="email" name="email" id="email" required placeholder="budi@example.com"
                            class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all">
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="subject" class="text-sm font-bold text-slate-700 ml-1">Subjek</label>
                    <input type="text" name="subject" id="subject" placeholder="Ingin bertanya tentang kain katun"
                        class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all">
                </div>
                <div class="space-y-2">
                    <label for="message" class="text-sm font-bold text-slate-700 ml-1">Pesan Anda</label>
                    <textarea name="message" id="message" rows="5" required placeholder="Tuliskan pesan Anda di sini..."
                        class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all"></textarea>
                </div>
                <button type="submit" class="w-full py-5 bg-teal-600 text-white rounded-2xl font-black hover:bg-teal-700 transition-all shadow-xl shadow-teal-100 active:scale-[0.98]">
                    Kirim Pesan Sekarang
                </button>
            </form>
        </div>

        <!-- Info & Map -->
        <div class="space-y-12">
            <div class="space-y-8">
                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900">Kantor Pusat</h3>
                        <p class="mt-2 text-slate-500 leading-relaxed">
                            Jl. Tekstil Indonesia No. 45, <br>
                            Kawasan Industri Fashion, Bandung, Jawa Barat 40123
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900">Hubungi Langsung</h3>
                        <p class="mt-2 text-slate-500 leading-relaxed">
                            Email: hello@nusakain.com <br>
                            WhatsApp: +62 812 3456 7890
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900">Jam Operasional</h3>
                        <p class="mt-2 text-slate-500 leading-relaxed">
                            Senin - Jumat: 09.00 - 17.00 WIB <br>
                            Sabtu: 09.00 - 14.00 WIB
                        </p>
                    </div>
                </div>
            </div>

            <!-- Simple Placeholder Map -->
            <div class="relative bg-gray-100 rounded-[3rem] h-[300px] overflow-hidden group">
                <div class="absolute inset-0 flex items-center justify-center">
                    <p class="text-slate-400 font-bold italic tracking-widest uppercase">Interactive Map Loading...</p>
                </div>
                <div class="absolute inset-0 bg-blue-600/5 group-hover:bg-blue-600/0 transition-colors"></div>
            </div>
        </div>
    </div>
</main>
@endsection
