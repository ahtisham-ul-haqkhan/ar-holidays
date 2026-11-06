<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') · AR HOLIDAYS - Surf Your Dream With Us</title>

    <!-- Brand Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/ar-holidays-icon.svg') }}">

    <!-- Local Offline Compiled Assets (Tailwind CSS, FontAwesome 6, ApexCharts, Fonts) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        .font-heading {
            font-family: 'Outfit', sans-serif;
        }
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.4);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(229, 32, 46, 0.4);
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(229, 32, 46, 0.8);
        }
    </style>
</head>
<body class="h-full bg-slate-50 text-slate-800 antialiased selection:bg-red-500 selection:text-white">

    <div class="min-h-screen flex flex-col bg-slate-50">
        
        <!-- Sidebar Component -->
        @include('components.sidebar')

        <!-- Main Viewport Content Area -->
        <div class="lg:pl-72 flex flex-col flex-1 min-h-screen transition-all duration-300">
            
            <!-- Header Component -->
            @include('components.header')

            <!-- Flash Session Alerts (if any) -->
            @if(session('success'))
                <div class="px-4 sm:px-8 pt-4">
                    <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-xs animate-fade-in">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-emerald-500 text-white flex items-center justify-center shrink-0 text-sm">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <p class="text-xs sm:text-sm font-semibold">{{ session('success') }}</p>
                        </div>
                        <button type="button" onclick="this.closest('.animate-fade-in').parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 text-sm">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="px-4 sm:px-8 pt-4">
                    <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between shadow-xs animate-fade-in">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-rose-500 text-white flex items-center justify-center shrink-0 text-sm">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </span>
                            <p class="text-xs sm:text-sm font-semibold">{{ session('error') }}</p>
                        </div>
                        <button type="button" onclick="this.closest('.animate-fade-in').parentElement.remove()" class="text-rose-600 hover:text-rose-900 text-sm">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Dynamic Section Content -->
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-4 sm:py-5">
                @yield('content')
            </main>

            <!-- Footer Component -->
            @include('components.footer')

        </div>

    </div>

    <!-- Change Password Modal Component -->
    @include('components.change-password-modal')

    <!-- Mobile Sidebar JavaScript Toggle -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('main-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>
</body>
</html>

