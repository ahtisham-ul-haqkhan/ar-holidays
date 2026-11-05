<header class="sticky top-0 z-30 flex items-center justify-between h-20 px-4 sm:px-8 bg-white/90 backdrop-blur-md border-b border-slate-200/80 shadow-xs transition-all">
    
    <!-- Left: Hamburger & Global Search -->
    <div class="flex items-center gap-4 flex-1 max-w-xl">
        <!-- Mobile Sidebar Toggle -->
        <button 
            type="button" 
            onclick="toggleSidebar()" 
            class="lg:hidden w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors shadow-xs">
            <i class="fa-solid fa-bars-staggered text-base"></i>
        </button>

        <!-- Search Bar with Travel Filters -->
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                <i class="fa-solid fa-magnifying-glass text-sm"></i>
            </div>
            <input 
                type="text" 
                placeholder="Search by customer name, passport number, PNR, flight code..." 
                class="w-full pl-10 pr-24 py-2.5 text-xs sm:text-sm bg-slate-50 hover:bg-slate-100/70 focus:bg-white text-slate-900 placeholder-slate-400 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all shadow-xs"
            >
            <div class="absolute inset-y-0 right-0 flex items-center pr-2.5 gap-1">
                <span class="hidden sm:inline-flex items-center px-1.5 py-0.5 text-[10px] font-semibold text-slate-400 bg-slate-200/60 rounded border border-slate-300/60">
                    ⌘K
                </span>
            </div>
        </div>
    </div>

    <!-- Right: Quick Actions & Profile -->
    <div class="flex items-center gap-3 sm:gap-4 ml-4">
        
        <!-- Live Sabre GDS Indicator (Desktop) -->
        <div class="hidden xl:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-emerald-50 border border-emerald-200/60 text-xs text-emerald-800">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </span>
            <span class="font-medium">Sabre & Amadeus Active</span>
        </div>

        <!-- Quick "+ Add Customer" Button (Highlighted) -->
        <a 
            href="{{ route('customers.create') }}" 
            class="hidden sm:inline-flex items-center gap-2 px-4 py-2 text-xs sm:text-sm font-semibold text-white bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 rounded-xl shadow-md shadow-red-600/20 hover:shadow-lg hover:shadow-red-600/30 transition-all transform active:scale-95">
            <i class="fa-solid fa-user-plus text-xs"></i>
            <span>Add Customer</span>
        </a>

        <!-- Notifications Dropdown Trigger -->
        <div class="relative">
            <button 
                type="button" 
                class="relative w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors">
                <i class="fa-regular fa-bell text-base"></i>
                <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-600 ring-2 ring-white"></span>
            </button>
        </div>

        <!-- Divider -->
        <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>

        <!-- User / Admin Profile Pill -->
        <div class="flex items-center gap-3 pl-1">
            <div class="relative">
                <img 
                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&auto=format&fit=crop&q=80" 
                    alt="Travel Admin" 
                    class="w-10 h-10 rounded-xl object-cover ring-2 ring-red-500/20 shadow-xs"
                >
                <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-emerald-500 ring-2 ring-white"></span>
            </div>
            <div class="hidden md:flex flex-col text-left">
                <span class="text-xs font-bold text-slate-900 flex items-center gap-1">
                    Rehman Admin
                    <i class="fa-solid fa-shield-halved text-[10px] text-red-600"></i>
                </span>
                <span class="text-[11px] text-slate-500 font-medium">Head of Operations</span>
            </div>
        </div>

    </div>
</header>

