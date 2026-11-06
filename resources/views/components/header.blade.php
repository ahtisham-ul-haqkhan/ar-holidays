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
                    {{ \App\Models\Vendor::count() }}
                </span>
            </a>

            <!-- Flight Bookings -->
            <a 
                href="{{ route('dashboard') }}#flight-search" 
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-100/80 transition-all shrink-0">
                <i class="fa-solid fa-plane text-[11px] text-slate-400"></i>
                <span>Flights</span>
                <span class="px-1.5 py-0.2 rounded-full text-[10px] font-bold bg-red-100 text-red-600">
                    12
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

    <!-- Right: Admin Profile & Logout -->
    <div class="flex items-center gap-2 sm:gap-3 shrink-0 ml-4">
        <div class="flex items-center gap-2.5 px-2 py-1 rounded-2xl hover:bg-slate-50 transition-colors">
            <!-- <div class="relative">
                <img 
                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&auto=format&fit=crop&q=80" 
                    alt="Admin" 
                    class="w-9 h-9 rounded-xl object-cover ring-2 ring-red-500/20 shadow-xs"
                >
                <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2 ring-white"></span>
            </div> -->
            <div class="hidden sm:flex flex-col text-left">
                <span class="text-xs font-bold text-slate-900 leading-none">
                    {{ auth()->user()->name ?? 'Rehman Admin' }}
                </span>
                <span class="text-[10px] text-slate-400 font-medium mt-1 truncate max-w-[130px]">
                    {{ auth()->user()->email ?? 'rahman@artravels.com' }}
                </span>
            </div>
        </div>

        <!-- Logout Form -->
        <form method="POST" action="{{ route('logout') }}" class="inline-flex">
            @csrf
            <button 
                type="submit" 
                title="Sign Out" 
                class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-red-600 border border-slate-200/80 hover:border-red-200 flex items-center justify-center transition-all duration-200 shadow-xs group">
                <i class="fa-solid fa-arrow-right-from-bracket text-xs transition-transform group-hover:translate-x-0.5"></i>
            </button>
        </form>
    </div>

</header>
