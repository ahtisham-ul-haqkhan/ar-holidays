<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sign In · AR Holidays - Rehman Travels Portal</title>

    <!-- Brand Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/ar-holidays-icon.svg') }}">

    <!-- Local Offline Compiled Assets (Tailwind CSS & FontAwesome) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        .font-heading {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="h-full min-h-screen bg-slate-950 text-slate-100 antialiased selection:bg-red-600 selection:text-white">

    <!-- Full-Bleed Edge-to-Edge Grid Container -->
    <div class="min-h-screen w-full grid grid-cols-1 lg:grid-cols-12">
        
        <!-- Left Side: Grand Travel Wallpaper with Subtle Dark Layer (lg:col-span-7 xl:col-span-8) -->
        <div class="hidden lg:flex lg:col-span-7 xl:col-span-8 p-10 xl:p-16 flex-col justify-between relative overflow-hidden min-h-screen bg-slate-950 bg-cover bg-center"
             style="background-image: url('{{ asset('images/login-travel-bg.jpg') }}');">
            
            <!-- Subtle Black Translucent Layer Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/65 to-slate-950/45 backdrop-blur-[1px] pointer-events-none"></div>

            <!-- Soft Brand Glow Accents -->
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-red-600/25 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-rose-700/20 rounded-full blur-[120px] pointer-events-none"></div>

            <!-- Top Brand Logo -->
            <div class="relative z-10 flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-red-600 to-rose-700 p-2.5 shadow-xl shadow-red-600/40 flex items-center justify-center ring-2 ring-white/20">
                    <img 
                        src="{{ asset('images/ar-holidays-icon.svg') }}" 
                        alt="AR Holidays Logo" 
                        class="w-full h-full object-contain filter drop-shadow brightness-0 invert"
                        onerror="this.onerror=null; this.src='{{ asset('images/ar-holidays-logo.svg') }}'"
                    >
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-2xl font-black tracking-tight text-white uppercase font-heading drop-shadow-md">
                            AR <span class="text-red-500">Holidays</span>
                        </span>
                    </div>
                    <p class="text-[10px] font-semibold tracking-wider text-slate-300 uppercase flex items-center gap-1.5 drop-shadow-sm">
                        <i class="fa-solid fa-plane-departure text-[9px] text-red-500"></i>
                        Surf Your Dream With Us
                    </p>
                </div>
            </div>

            <!-- Center Content / Value Props -->
            <div class="relative z-10 my-auto py-10 space-y-6 max-w-xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-xs font-semibold shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                    <span>Enterprise Travel & Aviation ERP</span>
                </div>

                <h2 class="text-3xl xl:text-5xl font-black text-white font-heading tracking-tight leading-tight drop-shadow-lg">
                    Fly Higher, Manage Smarter & Travel Further.
                </h2>

                <p class="text-sm xl:text-base text-slate-200 leading-relaxed drop-shadow-md max-w-lg">
                    Centralized management suite for AR Holidays & Rehman Travels airline ticketing, PNR tracking, corporate customer records, and financial ledgers.
                </p>

                <!-- Glassmorphism Feature Badges -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-4">
                    <div class="p-3.5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 text-white space-y-1 shadow-sm hover:bg-white/15 transition-all">
                        <div class="w-7 h-7 rounded-lg bg-red-600/80 text-white flex items-center justify-center text-xs shadow-xs">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <p class="text-xs font-bold leading-snug">Secure Admin</p>
                        <p class="text-[10px] text-slate-300">256-Bit SSL protection</p>
                    </div>

                    <div class="p-3.5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 text-white space-y-1 shadow-sm hover:bg-white/15 transition-all">
                        <div class="w-7 h-7 rounded-lg bg-red-600/80 text-white flex items-center justify-center text-xs shadow-xs">
                            <i class="fa-solid fa-plane"></i>
                        </div>
                        <p class="text-xs font-bold leading-snug">Multi Airlines</p>
                        <p class="text-[10px] text-slate-300">GDS & Carrier sync</p>
                    </div>

                    <div class="p-3.5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 text-white space-y-1 shadow-sm hover:bg-white/15 transition-all">
                        <div class="w-7 h-7 rounded-lg bg-red-600/80 text-white flex items-center justify-center text-xs shadow-xs">
                            <i class="fa-solid fa-address-card"></i>
                        </div>
                        <p class="text-xs font-bold leading-snug">Customer Hub</p>
                        <p class="text-[10px] text-slate-300">Identity & Passports</p>
                    </div>
                </div>
            </div>

            <!-- Bottom Live System Bar -->
            <div class="relative z-10 pt-4 border-t border-white/15 flex items-center justify-between text-xs text-slate-300">
                <span class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="font-medium text-white">Sabre & Amadeus Gateways Active</span>
                </span>
                <span class="font-mono text-slate-300 text-[11px]">System v2.4</span>
            </div>

        </div>

        <!-- Right Side: Compact, Sleek Login Form (lg:col-span-5 xl:col-span-4) -->
        <div class="lg:col-span-5 xl:col-span-4 bg-white dark:bg-slate-900 flex flex-col justify-between p-6 sm:p-10 xl:p-12 min-h-screen border-l border-slate-200 dark:border-slate-800 shadow-2xl overflow-y-auto">
            
            <!-- Mobile Brand Header (Visible only on small screens) -->
            <div class="flex lg:hidden items-center justify-between pb-5 border-b border-slate-200 dark:border-slate-800 mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-rose-700 p-2 shadow-md shadow-red-600/30 flex items-center justify-center">
                        <img src="{{ asset('images/ar-holidays-icon.svg') }}" alt="Logo" class="w-full h-full object-contain filter drop-shadow brightness-0 invert">
                    </div>
                    <div>
                        <span class="text-lg font-black tracking-tight text-slate-900 dark:text-white uppercase font-heading">
                            AR <span class="text-red-600">Holidays</span>
                        </span>
                        <p class="text-[9px] font-medium text-slate-500 dark:text-slate-400 uppercase">
                            Surf Your Dream With Us
                        </p>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                    Admin
                </span>
            </div>

            <!-- Compact Form Centered Container (max-w-sm) -->
            <div class="w-full max-w-sm mx-auto my-auto py-2">
                
                <!-- Form Heading -->
                <div class="space-y-1.5 mb-6 text-left">
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-600 dark:text-red-400 text-[11px] font-bold uppercase tracking-wider">
                        <i class="fa-solid fa-lock text-[9px]"></i>
                        <span>Secure Access</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight font-heading">
                        Welcome Back
                    </h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        Sign in to access your AR Holidays operations desk.
                    </p>
                </div>

                <!-- Session Flash Messages -->
                <div class="mb-4 space-y-2">
                    @if (session('success'))
                        <div class="p-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/60 text-emerald-800 dark:text-emerald-300 text-xs flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="p-3 rounded-xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800/60 text-blue-800 dark:text-blue-300 text-xs flex items-center gap-2">
                            <i class="fa-solid fa-circle-info text-blue-600"></i>
                            <span>{{ session('info') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="p-3 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800/60 text-rose-800 dark:text-rose-300 text-xs">
                            <div class="flex items-center gap-1.5 font-bold mb-1">
                                <i class="fa-solid fa-circle-exclamation text-rose-600"></i>
                                <span>Authentication Failed:</span>
                            </div>
                            <ul class="list-disc list-inside space-y-0.5 text-rose-700 dark:text-rose-400 text-[11px]">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login.submit') }}" class="space-y-4" autocomplete="off">
                    @csrf

                    <!-- Email Field -->
                    <div class="space-y-1">
                        <label for="email" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                                <i class="fa-solid fa-envelope text-xs"></i>
                            </span>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email', 'rahman@artravels.com') }}" 
                                required 
                                autofocus 
                                placeholder="name@artravels.com" 
                                class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 dark:bg-slate-800/80 hover:bg-slate-100/70 focus:bg-white dark:focus:bg-slate-800 text-xs font-medium text-slate-900 dark:text-white border @error('email') border-red-500 bg-red-50/20 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all outline-none"
                            >
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-1">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <span class="text-[11px] text-slate-400 hover:text-red-600 transition-colors cursor-pointer select-none" onclick="alert('Please contact admin to reset password.')">
                                Forgot?
                            </span>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                                <i class="fa-solid fa-lock text-xs"></i>
                            </span>
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                required 
                                placeholder="••••••••" 
                                class="w-full pl-9 pr-10 py-2.5 bg-slate-50 dark:bg-slate-800/80 hover:bg-slate-100/70 focus:bg-white dark:focus:bg-slate-800 text-xs font-medium text-slate-900 dark:text-white border @error('password') border-red-500 bg-red-50/20 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all outline-none"
                            >
                            <button 
                                type="button" 
                                onclick="togglePasswordVisibility()" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors"
                                title="Show / Hide Password"
                            >
                                <i id="password-toggle-icon" class="fa-solid fa-eye text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="flex items-center justify-between pt-0.5">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                id="remember" 
                                value="1"
                                class="w-3.5 h-3.5 rounded text-red-600 bg-slate-100 dark:bg-slate-800 border-slate-300 dark:border-slate-700 focus:ring-red-500 focus:ring-offset-0 cursor-pointer"
                                {{ old('remember', true) ? 'checked' : '' }}
                            >
                            <span class="text-xs font-medium text-slate-600 dark:text-slate-300">Remember for 30 days</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-2.5 sm:py-3 px-5 rounded-xl bg-gradient-to-r from-red-600 via-rose-600 to-red-700 hover:from-red-700 hover:to-rose-800 active:scale-[0.99] text-white text-xs font-bold uppercase tracking-wider shadow-md shadow-red-600/30 hover:shadow-red-600/40 transition-all duration-200 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                        <span>Sign In to Dashboard</span>
                    </button>
                </form>

                <!-- Demo Credentials Helper -->
                <div class="mt-5 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-800 flex items-center justify-between gap-2 text-xs">
                    <div class="flex items-center gap-2 text-slate-600 dark:text-slate-300 min-w-0">
                        <div class="w-6 h-6 rounded-lg bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 flex items-center justify-center shrink-0 text-[10px]">
                            <i class="fa-solid fa-key"></i>
                        </div>
                        <div class="truncate text-[11px]">
                            <span class="font-bold text-slate-900 dark:text-white">Demo:</span>
                            <span class="font-mono text-red-600 dark:text-red-400">rahman@artravels.com</span>
                        </div>
                    </div>
                    <button 
                        type="button" 
                        onclick="fillDemoCredentials()" 
                        class="px-2.5 py-1 rounded-lg bg-white dark:bg-slate-700 hover:bg-slate-100 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-600 text-[10px] font-bold transition-all shadow-2xs whitespace-nowrap">
                        <i class="fa-solid fa-wand-magic-sparkles text-[9px] text-red-500 mr-1"></i>
                        Auto Fill
                    </button>
                </div>

            </div>

            <!-- Footer Copyright -->
            <div class="pt-4 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-[11px] text-slate-400 w-full max-w-sm mx-auto">
                <span>&copy; {{ date('Y') }} AR Holidays</span>
                <!-- <a href="https://rehmantravel.com" target="_blank" class="hover:text-red-500 transition-colors flex items-center gap-1">
                    <span>rehmantravel.com</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                </a> -->
            </div>

        </div>

    </div>

    <!-- JavaScript Interactions: Password Visibility & Demo Auto-Fill -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('password-toggle-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function fillDemoCredentials() {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            
            emailInput.value = 'rahman@artravels.com';
            passwordInput.value = 'password';
            
            // Visual feedback flash
            passwordInput.focus();
            passwordInput.classList.add('ring-2', 'ring-red-500');
            setTimeout(() => {
                passwordInput.classList.remove('ring-2', 'ring-red-500');
            }, 600);
        }
    </script>

</body>
</html>
