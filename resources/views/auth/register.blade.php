<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar - Nusakain</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-6 relative overflow-hidden font-sans">
    <!-- Sophisticated Background -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] w-[50%] h-[50%] bg-gradient-to-br from-teal-100/30 to-transparent rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[50%] h-[50%] bg-gradient-to-tl from-blue-100/30 to-transparent rounded-full blur-[120px] animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03]"></div>
    </div>

    <div class="max-w-[380px] w-full relative z-10" 
         x-data="{ loading: false }" 
         x-init="setTimeout(() => $el.classList.remove('opacity-0', 'translate-y-8'), 100)"
         class="opacity-0 translate-y-8 transition-all duration-1000 ease-out">
        
        <!-- Premium Glass Card -->
        <div class="bg-white/90 backdrop-blur-2xl rounded-[2.5rem] shadow-[0_40px_80px_-15px_rgba(0,0,0,0.08)] border border-white/60 relative overflow-hidden">
            <!-- Distinct Header Section -->
            <div class="relative pt-8 pb-5 px-6 text-center overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-b from-slate-50/80 to-transparent"></div>
                
                <!-- Integrated Logo -->
                <div class="relative z-10 mb-2">
                    <a href="/" class="inline-block group">
                        <div class="relative">
                            <div class="absolute -inset-2 bg-teal-500/10 rounded-full blur-lg group-hover:bg-teal-500/20 transition-all duration-700"></div>
                            <img src="{{ asset('images/favicon.png') }}" alt="Logo" class="w-10 h-10 mx-auto drop-shadow-2xl animate-nusabot relative z-10 transition-transform group-hover:scale-110">
                        </div>
                    </a>
                </div>

                <div class="relative z-10">
                    <h1 class="text-xl font-black text-slate-900 tracking-tight leading-tight">
                        Registrasi <span class="text-teal-600">Baru.</span>
                    </h1>
                    <p class="text-[7px] font-black text-slate-400 uppercase tracking-[0.3em] mt-1">Signature Membership</p>
                </div>
            </div>

            <div class="px-6 pb-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-3" @submit="loading = true">
                    @csrf

                    <!-- Name -->
                    <div class="space-y-1">
                        <label for="name" class="text-[8px] font-black text-slate-400 ml-2 uppercase tracking-[0.2em]">Nama</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-teal-600 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama Lengkap"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50/50 border-2 border-transparent rounded-[1.2rem] focus:ring-4 focus:ring-teal-500/10 focus:border-teal-600 focus:bg-white transition-all text-xs font-semibold placeholder:text-slate-300">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-1 ml-2 text-[9px]" />
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-1">
                        <label for="email" class="text-[8px] font-black text-slate-400 ml-2 uppercase tracking-[0.2em]">Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-teal-600 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50/50 border-2 border-transparent rounded-[1.2rem] focus:ring-4 focus:ring-teal-500/10 focus:border-teal-600 focus:bg-white transition-all text-xs font-semibold placeholder:text-slate-300">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 ml-2 text-[9px]" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <!-- Password -->
                        <div class="space-y-1" x-data="{ show: false }">
                            <label for="password" class="text-[8px] font-black text-slate-400 ml-2 uppercase tracking-[0.2em]">Sandi</label>
                            <div class="relative group">
                                <input :type="show ? 'text' : 'password'" name="password" id="password" required autocomplete="new-password" placeholder="••••••••"
                                    class="w-full px-4 py-3 bg-slate-50/50 border-2 border-transparent rounded-[1.2rem] focus:ring-4 focus:ring-teal-500/10 focus:border-teal-600 focus:bg-white transition-all text-xs font-semibold placeholder:text-slate-300">
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-300 hover:text-teal-600 transition-colors">
                                    <svg x-show="!show" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-1">
                            <label for="password_confirmation" class="text-[8px] font-black text-slate-400 ml-2 uppercase tracking-[0.2em]">Ulangi</label>
                            <div class="relative group">
                                <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" placeholder="••••••••"
                                    class="w-full px-4 py-3 bg-slate-50/50 border-2 border-transparent rounded-[1.2rem] focus:ring-4 focus:ring-teal-500/10 focus:border-teal-600 focus:bg-white transition-all text-xs font-semibold placeholder:text-slate-300">
                            </div>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 ml-2 text-[9px]" />

                    <div class="pt-3">
                        <button type="submit" 
                                :disabled="loading"
                                class="w-full py-3 bg-slate-900 text-white rounded-[1rem] font-black hover:bg-teal-600 hover:shadow-[0_15px_30px_-8px_rgba(13,148,136,0.25)] transition-all active:scale-[0.98] uppercase tracking-[0.25em] text-[9px] flex items-center justify-center gap-2">
                            <template x-if="!loading">
                                <span>Daftar Akun</span>
                            </template>
                            <template x-if="loading">
                                <svg class="animate-spin h-3 w-3 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            </template>
                        </button>
                    </div>

                    <div class="relative py-2 flex items-center gap-3">
                        <div class="flex-grow border-t border-slate-100"></div>
                        <span class="text-[7px] font-black text-slate-300 uppercase tracking-[0.2em]">Atau Connect</span>
                        <div class="flex-grow border-t border-slate-100"></div>
                    </div>

                    <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-2 py-3 bg-white border-2 border-slate-100 text-slate-700 rounded-[1rem] font-black hover:border-teal-600 transition-all active:scale-[0.98] group shadow-sm">
                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform" viewBox="0 0 24 24">
                            <path fill="#EA4335" d="M5.266 9.765A7.077 7.077 0 0 1 12 4.909c1.69 0 3.218.6 4.418 1.582L19.91 3C17.782 1.145 15.055 0 12 0 7.27 0 3.198 2.698 1.24 6.65l4.026 3.115Z"/>
                            <path fill="#FBBC05" d="M16.04 18.013c-1.09.693-2.415 1.078-3.84 1.078a7.077 7.077 0 0 1-6.734-4.858L1.44 17.358C3.398 21.302 7.47 24 12 24c3.135 0 5.946-1.039 8.066-2.81l-4.026-3.177Z"/>
                            <path fill="#4285F4" d="M23.49 12.275c0-.826-.074-1.62-.21-2.386H12v4.514h6.44a5.517 5.517 0 0 1-2.395 3.614l4.026 3.177c2.356-2.177 3.714-5.382 3.714-8.919Z"/>
                            <path fill="#34A853" d="M5.266 14.235a7.077 7.077 0 0 1 0-4.47L1.24 6.65a11.977 11.977 0 0 0 0 10.708l4.026-3.123Z"/>
                        </svg>
                        <span class="text-[8px] uppercase tracking-[0.2em]">Google account</span>
                    </a>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="group inline-flex items-center gap-2">
                        <span class="text-[8px] font-black text-slate-300 uppercase tracking-[0.2em]">Ada Akses?</span>
                        <span class="text-[9px] font-black text-teal-600 uppercase tracking-widest group-hover:text-slate-900 transition-all underline underline-offset-2 decoration-slate-100">Masuk</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-6 flex flex-col items-center gap-3">
            <a href="/" class="group flex items-center gap-3 text-[8px] font-black text-slate-400 hover:text-teal-600 transition-all uppercase tracking-[0.4em]">
                <div class="w-7 h-7 rounded-xl bg-white shadow-sm flex items-center justify-center group-hover:-translate-x-1 transition-transform border border-slate-50">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </div>
                Portal
            </a>
        </div>
    </div>
</body>
</html>