@extends('layouts.guest')

@section('title', 'Hubungi Kami - Nusakain Indonesia')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
    <!-- Header Section -->
    <div class="mb-16 text-center md:text-left animate__animated animate__fadeIn">
        <span class="inline-block px-4 py-1.5 bg-teal-50 text-teal-600 text-xs font-bold rounded-full mb-4 uppercase tracking-widest">Kontak Kami</span>
        <h1 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tight leading-tight">
            Mari Berdiskusi Tentang <br>
            <span class="text-teal-600 italic">Project Anda.</span>
        </h1>
        <p class="mt-6 text-lg text-slate-500 max-w-2xl leading-relaxed">
            Punya pertanyaan atau ingin berkonsultasi mengenai material kain? Tim ahli Nusakain siap memberikan solusi terbaik untuk bisnis fashion Anda.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
        <!-- Contact Form -->
        <div class="bg-white rounded-[3rem] p-8 md:p-12 border border-gray-100 shadow-xl shadow-gray-100/50 animate__animated animate__fadeInLeft">
            @if(session('success'))
                <div class="mb-8 p-6 bg-teal-50 text-teal-700 rounded-3xl border border-teal-100 flex items-center gap-4 animate__animated animate__bounceIn">
                    <div class="w-10 h-10 bg-teal-500 rounded-full flex items-center justify-center text-white shadow-lg shadow-teal-200 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="font-black text-sm uppercase tracking-tight">Pesan Terkirim!</p>
                        <p class="text-xs font-medium opacity-80">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('kontak.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label for="name" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nama Lengkap</label>
                        <div class="relative group">
                            <input type="text" name="name" id="name" required placeholder="Budi Santoso"
                                class="w-full px-6 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 placeholder:text-slate-300 placeholder:font-medium">
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Email Anda</label>
                        <div class="relative group">
                            <input type="email" name="email" id="email" required placeholder="budi@example.com"
                                class="w-full px-6 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 placeholder:text-slate-300 placeholder:font-medium">
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    <label for="subject" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Subjek Pesan</label>
                    <input type="text" name="subject" id="subject" placeholder="Konsultasi Bahan Kain Garmen"
                        class="w-full px-6 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 placeholder:text-slate-300 placeholder:font-medium">
                </div>
                <div class="space-y-3">
                    <label for="message" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Isi Pesan</label>
                    <textarea name="message" id="message" rows="5" required placeholder="Halo Nusakain, saya ingin bertanya..."
                        class="w-full px-6 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all font-bold text-slate-900 placeholder:text-slate-300 placeholder:font-medium leading-relaxed"></textarea>
                </div>
                <button type="submit" class="group w-full py-6 bg-slate-900 text-white rounded-2xl font-black text-lg hover:bg-teal-600 transition-all shadow-2xl shadow-slate-200 active:scale-[0.98] flex items-center justify-center">
                    <span>Kirim Pesan</span>
                    <svg class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>
        </div>

        <!-- Info & Map -->
        <div class="space-y-12 animate__animated animate__fadeInRight">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 lg:grid-cols-1 lg:gap-12">
                <div class="flex items-start gap-6 group">
                    <div class="w-14 h-14 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-sm group-hover:bg-teal-600 group-hover:text-white transition-all duration-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900 tracking-tight">Kantor Pusat</h3>
                        <p class="mt-2 text-slate-500 leading-relaxed font-medium">
                            Jl. Tekstil Indonesia No. 45, <br>
                            Kawasan Industri Fashion, Bandung, Jawa Barat 40123
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-6 group">
                    <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900 tracking-tight">Hubungi Kami</h3>
                        <p class="mt-2 text-slate-500 leading-relaxed font-medium">
                            Email: halo@nusakain.com <br>
                            WhatsApp: +{{ $setting->whatsapp ?? '628123456789' }}
                        </p>
                        <div class="mt-4 flex items-center gap-3">
                            @if($setting->instagram)
                                <a href="{{ $setting->instagram }}" class="px-4 py-2 bg-pink-50 text-pink-600 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-pink-600 hover:text-white transition-all">Instagram</a>
                            @endif
                            @if($setting->facebook)
                                <a href="{{ $setting->facebook }}" class="px-4 py-2 bg-blue-50 text-blue-600 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all">Facebook</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Map -->
            <div class="relative bg-gray-100 rounded-[3rem] h-[350px] overflow-hidden group shadow-inner border border-gray-100">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347862248!2d107.5731164!3d-6.9034443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a50b091974e7e!2sBandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                    class="absolute inset-0 w-full h-full grayscale-[0.2] contrast-[1.1] opacity-90 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700"
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <div class="absolute inset-0 pointer-events-none ring-1 ring-inset ring-slate-900/5 rounded-[3rem]"></div>
            </div>
        </div>
    </div>
</main>
@endsection
