@php
    $currentRoute = Route::currentRouteName();
@endphp

<header class="sticky top-0 z-30 flex items-center justify-between h-16 px-4 sm:px-8 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs transition-all">
    
    <!-- Left: Mobile Toggle & Desktop Nav -->
    <div class="flex items-center gap-3 lg:gap-4 flex-1 min-w-0">
        <!-- Mobile Sidebar Toggle -->
        <button 
            type="button" 
            onclick="toggleSidebar()" 
            class="lg:hidden w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors shadow-xs shrink-0">
            <i class="fa-solid fa-bars-staggered text-base"></i>
        </button>

        <!-- Header Navigation (Mirrored from Sidebar with Sleek Design) -->
        <nav class="hidden md:flex items-center gap-1 lg:gap-1.5 overflow-x-auto custom-scrollbar py-1">
            
            <!-- Dashboard -->
            <a 
                href="{{ route('dashboard') }}" 
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold transition-all shrink-0 {{ $currentRoute === 'dashboard' ? 'bg-red-50 text-red-600 border border-red-200/70 shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }}">
                <i class="fa-solid fa-chart-line text-[11px] {{ $currentRoute === 'dashboard' ? 'text-red-600' : 'text-slate-400' }}"></i>
                <span>Dashboard</span>
            </a>

            <!-- Customers -->
            <a 
                href="{{ route('customers.index') }}" 
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold transition-all shrink-0 {{ str_starts_with($currentRoute ?? '', 'customers') ? 'bg-red-50 text-red-600 border border-red-200/70 shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }}">
                <i class="fa-solid fa-users text-[11px] {{ str_starts_with($currentRoute ?? '', 'customers') ? 'text-red-600' : 'text-slate-400' }}"></i>
                <span>Customers</span>
                <span class="px-1.5 py-0.2 rounded-full text-[10px] font-bold {{ str_starts_with($currentRoute ?? '', 'customers') ? 'bg-red-600 text-white' : 'bg-slate-200/80 text-slate-700' }}">
                    {{ \App\Models\Customer::count() }}
                </span>
            </a>

            <!-- Airlines / Vendors -->
            <a 
                href="{{ route('vendors.index') }}" 
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold transition-all shrink-0 {{ str_starts_with($currentRoute ?? '', 'vendors') ? 'bg-red-50 text-red-600 border border-red-200/70 shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }}">
                <i class="fa-solid fa-plane-departure text-[11px] {{ str_starts_with($currentRoute ?? '', 'vendors') ? 'text-red-600' : 'text-slate-400' }}"></i>
                <span>Airlines</span>
                <span class="px-1.5 py-0.2 rounded-full text-[10px] font-bold {{ str_starts_with($currentRoute ?? '', 'vendors') ? 'bg-red-600 text-white' : 'bg-slate-200/80 text-slate-700' }}">
                    {{ \Illuminate\Support\Facades\Cache::remember('vendors_count_badge', 60, fn() => \App\Models\Vendor::count()) }}
                </span>
            </a>

            <!-- Flight Bookings -->
            <a 
                href="{{ route('tickets.create') }}" 
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold {{ request()->routeIs('tickets.create') ? 'bg-red-50 text-red-600 border border-red-200' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }} transition-all shrink-0">
                <i class="fa-solid fa-plane text-[11px] {{ request()->routeIs('tickets.create') ? 'text-red-600' : 'text-slate-400' }}"></i>
                <span>Flights</span>
                <span class="px-1.5 py-0.2 rounded-full text-[10px] font-bold bg-red-100 text-red-600">
                    New
                </span>
            </a>

            <!-- Umrah & Hajj -->
            <a 
                href="{{ route('dashboard') }}" 
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-100/80 transition-all shrink-0">
                <i class="fa-solid fa-kaaba text-[11px] text-slate-400"></i>
                <span>Umrah & Hajj</span>
            </a>

            <!-- Billing / Invoices -->
            <a 
                href="{{ route('dashboard') }}" 
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-100/80 transition-all shrink-0">
                <i class="fa-solid fa-file-invoice-dollar text-[11px] text-slate-400"></i>
                <span>Invoices</span>
            </a>

            <!-- Sales Report -->
            <a 
                href="{{ route('dashboard') }}" 
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-100/80 transition-all shrink-0">
                <i class="fa-solid fa-receipt text-[11px] text-slate-400"></i>
                <span>Reports</span>
            </a>

        </nav>
    </div>

    <!-- Right: User Profile Dropdown -->
    <div class="relative shrink-0 ml-4" id="user-menu-container">
        <button 
            type="button" 
            id="user-menu-button"
            onclick="toggleUserDropdown()" 
            class="flex items-center gap-2.5 px-3 py-1.5 rounded-2xl bg-slate-50 hover:bg-slate-100 border border-slate-200/80 transition-all shadow-2xs group focus:ring-2 focus:ring-red-500/20">
            <div class="relative flex items-center justify-center w-8 h-8 rounded-xl bg-gradient-to-br from-red-600 to-rose-700 text-white font-bold text-xs shadow-xs shrink-0">
                <span>{{ strtoupper(substr(auth()->user()->name ?? 'R', 0, 1)) }}</span>
                <span class="absolute bottom-0 right-0 w-2 h-2 rounded-full bg-emerald-500 ring-2 ring-white"></span>
            </div>
            <div class="hidden sm:flex flex-col text-left">
                <span class="text-xs font-bold text-slate-900 leading-none group-hover:text-red-600 transition-colors">
                    {{ auth()->user()->name ?? 'Rehman Admin' }}
                </span>
                <span class="text-[10px] text-slate-400 font-medium mt-0.5 truncate max-w-[130px]">
                    {{ auth()->user()->email ?? 'rahman@artravels.com' }}
                </span>
            </div>
            <i id="user-menu-chevron" class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200 ml-0.5 group-hover:text-slate-600"></i>
        </button>

        <!-- Dropdown Menu (Hidden by default) -->
        <div 
            id="user-dropdown-menu" 
            class="hidden absolute right-0 mt-2 w-64 rounded-2xl bg-white border border-slate-200/90 shadow-2xl py-2 z-50 transform transition-all duration-200 origin-top-right">
            
            <!-- User Header Inside Dropdown -->
            <div class="px-4 py-3 border-b border-slate-100 flex items-center gap-3 bg-slate-50/50">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-rose-700 text-white flex items-center justify-center font-bold text-sm shadow-xs shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'R', 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-slate-900 truncate">{{ auth()->user()->name ?? 'Rehman Admin' }}</p>
                    <p class="text-[10px] text-slate-400 truncate">{{ auth()->user()->email ?? 'rahman@artravels.com' }}</p>
                    <span class="inline-flex items-center gap-1 mt-1 px-1.5 py-0.2 rounded-md bg-emerald-50 text-emerald-700 font-bold text-[9px] border border-emerald-200/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Active Session
                    </span>
                </div>
            </div>

            <!-- Menu Items List (UL / LI) -->
            <ul class="py-1 text-xs text-slate-700">
                <li>
                    <button 
                        type="button" 
                        onclick="closeUserDropdown(); openChangePasswordModal();" 
                        class="w-full flex items-center gap-3 px-4 py-2.5 hover:bg-slate-50 hover:text-red-600 transition-colors text-left group">
                        <span class="w-7 h-7 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-xs group-hover:bg-red-600 group-hover:text-white transition-colors shrink-0">
                            <i class="fa-solid fa-key"></i>
                        </span>
                        <div class="flex flex-col">
                            <span class="font-bold leading-tight">Change Password</span>
                            <span class="text-[10px] text-slate-400 font-normal">Update security credentials</span>
                        </div>
                    </button>
                </li>
            </ul>

            <!-- Divider -->
            <div class="border-t border-slate-100 my-1"></div>

            <!-- Logout Item -->
            <div class="px-2 pt-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button 
                        type="submit" 
                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-rose-600 hover:bg-rose-50 transition-colors text-left group">
                        <i class="fa-solid fa-arrow-right-from-bracket text-xs text-rose-500 transition-transform group-hover:translate-x-0.5"></i>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Dropdown Interactive Script -->
    <script>
        function toggleUserDropdown() {
            const menu = document.getElementById('user-dropdown-menu');
            const chevron = document.getElementById('user-menu-chevron');
            if (!menu) return;
            const isHidden = menu.classList.contains('hidden');
            if (isHidden) {
                menu.classList.remove('hidden');
                if (chevron) chevron.classList.add('rotate-180');
            } else {
                menu.classList.add('hidden');
                if (chevron) chevron.classList.remove('rotate-180');
            }
        }

        function closeUserDropdown() {
            const menu = document.getElementById('user-dropdown-menu');
            const chevron = document.getElementById('user-menu-chevron');
            if (menu) menu.classList.add('hidden');
            if (chevron) chevron.classList.remove('rotate-180');
        }

        document.addEventListener('click', function(event) {
            const container = document.getElementById('user-menu-container');
            if (container && !container.contains(event.target)) {
                closeUserDropdown();
            }
        });
    </script>

</header>
