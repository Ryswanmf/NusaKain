<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Masuk - Nusakain</title>
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
        <div class="bg-white rounded-[3rem] p-10 md:p-12 border border-gray-100 shadow-sm text-center">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight text-left">Selamat <span class="text-teal-600">Datang!</span></h1>
            <p class="mt-4 text-slate-500 font-medium text-left">Silakan masuk ke akun Anda untuk melanjutkan.</p>

            <!-- Session Status -->
            <x-auth-session-status class="mt-6" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="mt-10 space-y-6 text-left">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="text-sm font-bold text-slate-700 ml-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-sm font-bold text-slate-700 ml-1">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-bold text-teal-600 hover:text-teal-700">Lupa Password?</a>
                        @endif
                    </div>
                    <input type="password" name="password" id="password" required autocomplete="current-password"
                        class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-teal-600 focus:bg-white transition-all">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center ml-1">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded-lg border-gray-300 text-teal-600 shadow-sm focus:ring-teal-500" name="remember">
                        <span class="ms-2 text-sm text-slate-500 font-medium italic">Ingat Saya</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-5 bg-teal-600 text-white rounded-2xl font-black hover:bg-teal-700 transition-all shadow-xl shadow-teal-100 active:scale-[0.98]">
                        Masuk Sekarang
                    </button>
                </div>

                <div class="relative py-4">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-100"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase">
                        <span class="bg-white px-4 text-slate-400 font-bold tracking-widest">Atau masuk dengan</span>
                    </div>
                </div>

                <div>
                    <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 py-4 bg-white border-2 border-slate-100 text-slate-700 rounded-2xl font-bold hover:bg-slate-50 hover:border-slate-200 transition-all active:scale-[0.98]">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#EA4335" d="M5.266 9.765A7.077 7.077 0 0 1 12 4.909c1.69 0 3.218.6 4.418 1.582L19.91 3C17.782 1.145 15.055 0 12 0 7.27 0 3.198 2.698 1.24 6.65l4.026 3.115Z"/>
                            <path fill="#FBBC05" d="M16.04 18.013c-1.09.693-2.415 1.078-3.84 1.078a7.077 7.077 0 0 1-6.734-4.858L1.44 17.358C3.398 21.302 7.47 24 12 24c3.135 0 5.946-1.039 8.066-2.81l-4.026-3.177Z"/>
                            <path fill="#4285F4" d="M23.49 12.275c0-.826-.074-1.62-.21-2.386H12v4.514h6.44a5.517 5.517 0 0 1-2.395 3.614l4.026 3.177c2.356-2.177 3.714-5.382 3.714-8.919Z"/>
                            <path fill="#34A853" d="M5.266 14.235a7.077 7.077 0 0 1 0-4.47L1.24 6.65a11.977 11.977 0 0 0 0 10.708l4.026-3.123Z"/>
                        </svg>
                        Google
                    </a>
                </div>
            </form>

            @if (Route::has('register'))
                <p class="mt-10 text-center text-sm text-slate-500 font-medium">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-teal-600 font-bold hover:underline underline-offset-4 decoration-2">Daftar Gratis</a>
                </p>
            @endif

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
