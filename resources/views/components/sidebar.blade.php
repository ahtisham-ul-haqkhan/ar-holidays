@php
    $currentRoute = Route::currentRouteName();
@endphp

<!-- Sidebar Overlay for Mobile -->
<div 
    id="sidebar-overlay" 
    onclick="toggleSidebar()" 
    class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden hidden transition-opacity duration-300">
</div>

<!-- Main Sidebar Container -->
<aside 
    id="main-sidebar" 
    class="fixed top-0 bottom-0 left-0 z-50 w-72 bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white flex flex-col border-r border-slate-800/80 shadow-2xl transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0">
    
    <!-- Brand Header -->
    <div class="px-6 py-5 border-b border-slate-800/80 bg-slate-950/40 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" class="group flex items-center gap-3">
            <div class="relative flex items-center justify-center w-11 h-11 rounded-xl bg-gradient-to-br from-red-600 to-rose-700 shadow-lg shadow-red-600/30 p-2 transition-transform duration-300 group-hover:scale-105">
                <img src="{{ asset('images/ar-holidays-icon.svg') }}" alt="AR Holidays" class="w-full h-full object-contain filter drop-shadow brightness-0 invert" onerror="this.onerror=null; this.src='{{ asset('images/ar-holidays-logo.svg') }}'">
            </div>
            <div class="flex flex-col">
                <div class="flex items-center gap-1.5">
                    <span class="text-xl font-extrabold tracking-tight text-white uppercase font-heading">AR <span class="text-red-500">Holidays</span></span>
                </div>
                <span class="text-[10px] font-medium tracking-wider text-slate-400 uppercase flex items-center gap-1">
                    <i class="fa-solid fa-plane-departure text-[9px] text-red-500"></i>
                    Surf Your Dream With Us
                </span>
            </div>
        </a>

        <!-- Close button for mobile -->
        <button 
            type="button" 
            onclick="toggleSidebar()" 
            class="lg:hidden w-8 h-8 rounded-lg bg-slate-800/80 hover:bg-slate-700 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>
    </div>


    <!-- Navigation Menu Items (Scrollable) -->
    <nav class="flex-1 px-4 py-4 space-y-6 overflow-y-auto custom-scrollbar">
        
        <!-- Section: Overview -->
        <div>
            <p class="px-3 text-[11px] font-bold tracking-wider text-slate-400 uppercase">Dashboard & Analytics</p>
            <div class="mt-2 space-y-1">
                <a 
                    href="{{ route('dashboard') }}" 
                    class="group flex items-center justify-between px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-200 {{ $currentRoute === 'dashboard' ? 'bg-gradient-to-r from-red-600 to-rose-700 text-white shadow-lg shadow-red-600/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors {{ $currentRoute === 'dashboard' ? 'bg-white/20 text-white' : 'bg-slate-800 text-red-400 group-hover:bg-red-600/20 group-hover:text-red-400' }}">
                            <i class="fa-solid fa-chart-line text-sm"></i>
                        </span>
                        <span>Main Dashboard</span>
                    </div>
                    @if($currentRoute === 'dashboard')
                        <span class="w-1.5 h-5 rounded-full bg-white"></span>
                    @endif
                </a>
            </div>
        </div>

        <!-- Section: CUSTOMER MANAGEMENT (Special Focus) -->
        <div>
            <div class="flex items-center justify-between px-3">
                <p class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Customer Management</p>
                <span class="text-[10px] font-semibold bg-red-600/30 text-red-300 px-1.5 py-0.5 rounded">Static UI</span>
            </div>
            
            <div class="mt-2 space-y-1">
                <!-- Customer Index -->
                <a 
                    href="{{ route('customers.index') }}" 
                    class="group flex items-center justify-between px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-200 {{ str_starts_with($currentRoute, 'customers.index') ? 'bg-gradient-to-r from-red-600 to-rose-700 text-white shadow-lg shadow-red-600/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors {{ str_starts_with($currentRoute, 'customers.index') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-300 group-hover:bg-red-600/20 group-hover:text-red-400' }}">
                            <i class="fa-solid fa-users text-sm"></i>
                        </span>
                        <span>All Customers</span>
                    </div>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ str_starts_with($currentRoute, 'customers.index') ? 'bg-white/25 text-white' : 'bg-slate-800 text-slate-300' }}">
                        1,420
                    </span>
                </a>

             
              
            </div>
        </div>

        <!-- Section: Travel & Holidays -->
        <div>
            <p class="px-3 text-[11px] font-bold tracking-wider text-slate-400 uppercase">Travel & Packages</p>
            <div class="mt-2 space-y-1">
                <a href="{{ route('dashboard') }}#flight-search" class="group flex items-center justify-between px-3.5 py-2.5 rounded-xl font-medium text-sm text-slate-300 hover:bg-slate-800/60 hover:text-white transition-all">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-slate-800 text-slate-300 flex items-center justify-center group-hover:bg-red-600/20 group-hover:text-red-400 transition-colors">
                            <i class="fa-solid fa-plane text-sm"></i>
                        </span>
                        <span>Flight Bookings</span>
                    </div>
                    <span class="text-xs bg-red-600 text-white px-2 py-0.5 rounded-full font-semibold">12</span>
                </a>

                <a href="{{ route('dashboard') }}" class="group flex items-center justify-between px-3.5 py-2.5 rounded-xl font-medium text-sm text-slate-300 hover:bg-slate-800/60 hover:text-white transition-all">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-slate-800 text-slate-300 flex items-center justify-center group-hover:bg-red-600/20 group-hover:text-red-400 transition-colors">
                            <i class="fa-solid fa-kaaba text-sm"></i>
                        </span>
                        <span>Umrah & Hajj Desk</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Section: Finance & Invoices -->
        <div>
            <p class="px-3 text-[11px] font-bold tracking-wider text-slate-400 uppercase">Billing & Ledgers</p>
            <div class="mt-2 space-y-1">
                <a href="{{ route('dashboard') }}" class="group flex items-center justify-between px-3.5 py-2.5 rounded-xl font-medium text-sm text-slate-300 hover:bg-slate-800/60 hover:text-white transition-all">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-slate-800 text-slate-300 flex items-center justify-center group-hover:bg-red-600/20 group-hover:text-red-400 transition-colors">
                            <i class="fa-solid fa-file-invoice-dollar text-sm"></i>
                        </span>
                        <span>Vouchers & Invoices</span>
                    </div>
                </a>
                <a href="{{ route('dashboard') }}" class="group flex items-center justify-between px-3.5 py-2.5 rounded-xl font-medium text-sm text-slate-300 hover:bg-slate-800/60 hover:text-white transition-all">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-slate-800 text-slate-300 flex items-center justify-center group-hover:bg-red-600/20 group-hover:text-red-400 transition-colors">
                            <i class="fa-solid fa-receipt text-sm"></i>
                        </span>
                        <span>Sales Report</span>
                    </div>
                </a>
            </div>
        </div>

    </nav>

    <!-- Support & Agency Card at Footer of Sidebar -->
    <div class="p-4 border-t border-slate-800/80 bg-slate-950/60">
        <!-- <div class="p-3.5 rounded-xl bg-gradient-to-r from-red-950/40 via-slate-900 to-slate-900 border border-red-900/30 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-red-600 flex items-center justify-center text-white shrink-0 shadow-md shadow-red-600/30">
                <i class="fa-solid fa-headset text-lg"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-white truncate">24/7 Agent Support</p>
                <p class="text-[11px] text-red-400 font-mono font-medium truncate">+92 300 8472910</p>
            </div>
        </div> -->
        
        <div class="mt-3 pt-3 border-t border-slate-800/50 flex items-center justify-between text-[11px] text-slate-400">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <span>System  Online</span>
            </div>
            <span class="text-slate-400">AR Holidays</span>
        </div>
    </div>
</aside>

