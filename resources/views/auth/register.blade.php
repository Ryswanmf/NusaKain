<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar - Nusakain</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50/50 min-h-screen flex items-center justify-center p-6 py-12">

    <div class="max-w-md w-full">
        <!-- Logo -->
        <div class="text-center mb-10">
            <a href="/" class="inline-flex items-center space-x-3 group">
                <div class="w-12 h-12 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200 group-hover:scale-105 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-2xl font-extrabold text-slate-900 tracking-tight">Nusakain<span class="text-blue-600">.</span></span>
            </a>
        </div>

        <div class="bg-white rounded-[3rem] p-10 md:p-12 border border-gray-100 shadow-sm">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Mulai <span class="text-blue-600">Bisnis Anda!</span></h1>
            <p class="mt-4 text-slate-500 font-medium">Bergabunglah bersama ratusan UMKM fashion lainnya.</p>

            <form method="POST" action="{{ route('register') }}" class="mt-10 space-y-6">
                @csrf

                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="text-sm font-bold text-slate-700 ml-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                        class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="text-sm font-bold text-slate-700 ml-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="username"
                        class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="text-sm font-bold text-slate-700 ml-1">Password</label>
                    <input type="password" name="password" id="password" required autocomplete="new-password"
                        class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="text-sm font-bold text-slate-700 ml-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                        class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-5 bg-blue-600 text-white rounded-2xl font-black hover:bg-blue-700 transition-all shadow-xl shadow-blue-100 active:scale-[0.98]">
                        Daftar Akun Gratis
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-slate-500 font-medium">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline underline-offset-4 decoration-2">Masuk Sekarang</a>
            </p>
        </div>

        <p class="mt-10 text-center text-slate-400 text-xs font-bold uppercase tracking-widest">
            © 2026 Nusakain Indonesia.
        </p>
    </div>

</body>
</html>
