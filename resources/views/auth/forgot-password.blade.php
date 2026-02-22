<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - Nusakain</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    <!-- Animated Background Blobs -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] -left-[10%] w-[40%] h-[40%] bg-teal-200/30 rounded-full blur-[120px] animate-blob"></div>
        <div class="absolute bottom-[-10%] -right-[10%] w-[40%] h-[40%] bg-cyan-200/30 rounded-full blur-[120px] animate-blob animation-delay-2000"></div>
        <div class="absolute top-[20%] right-[10%] w-[30%] h-[30%] bg-blue-100/30 rounded-full blur-[100px] animate-blob animation-delay-4000"></div>
    </div>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

    <div class="max-w-md w-full relative z-10">
        <!-- Logo -->
        <div class="text-center mb-10">
            <a href="/" class="inline-flex items-center space-x-3 group">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 group-hover:scale-105 transition-transform duration-300 overflow-hidden">
                    <img src="{{ asset('images/favicon.png') }}" class="w-full h-full object-cover p-1">
                </div>
                <span class="text-2xl font-extrabold text-slate-900 tracking-tight">Nusakain<span class="text-teal-600">.</span></span>
            </a>
        </div>

        <div class="bg-white rounded-[3rem] p-10 md:p-12 border border-gray-100 shadow-sm text-center">
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight text-left">Lupa <span class="text-teal-600">Password?</span></h1>
            <p class="mt-4 text-slate-500 font-medium leading-relaxed italic text-left">
                Jangan khawatir. Masukkan alamat email Anda dan kami akan mengirimkan tautan reset password.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mt-6" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="mt-10 space-y-6 text-left">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="text-sm font-bold text-slate-700 ml-1">Email Anda</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-5 bg-teal-600 text-white rounded-2xl font-black hover:bg-teal-700 transition-all shadow-xl shadow-teal-100 active:scale-[0.98]">
                        Kirim Link Reset
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-slate-500 font-medium">
                Kembali ke 
                <a href="{{ route('login') }}" class="text-teal-600 font-bold hover:underline underline-offset-4 decoration-2">Halaman Masuk</a>
            </p>

            <div class="mt-8 pt-8 border-t border-slate-50">
                <a href="/" class="inline-flex items-center text-sm font-bold text-slate-400 hover:text-teal-600 transition-colors group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        <p class="mt-10 text-center text-slate-400 text-xs font-bold uppercase tracking-widest">
            © 2026 Nusakain Indonesia.
        </p>
    </div>

</body>
</html>
