@extends('layouts.app')

@section('title', 'Travel Dashboard · AR Holidays')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">

    <!-- Top Hero Banner (AR Holidays Themed) -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-slate-900 to-red-950 text-white p-6 sm:p-8 lg:p-10 shadow-xl border border-slate-800">
        
        <!-- Background Vector Airplane Silhouette & Gradients -->
        <div class="absolute -right-10 -bottom-10 w-96 h-96 opacity-10 pointer-events-none transform -rotate-12">
            <img src="{{ asset('images/ar-holidays-icon.svg') }}" alt="Watermark" class="w-full h-full object-contain brightness-0 invert">
        </div>
        <div class="absolute top-0 right-1/4 w-72 h-72 bg-red-600/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-3 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-500/20 border border-red-500/30 text-red-300 text-xs font-semibold">
                    <i class="fa-solid fa-plane-departure text-[11px]"></i>
                    <span>AR HOLIDAYS · TRAVEL OPERATIONS DESK</span>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight font-heading">
                    Welcome Back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-red-400">Rehman Admin</span> 👋
                </h1>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-light">
                    Surf Your Dream With Us. Today you have <strong class="text-white font-semibold">18 flights in transit</strong>, <strong class="text-white font-semibold">5 visa approvals pending</strong>, and <strong class="text-red-400 font-semibold">14 new customer inquiries</strong> waiting.
                </p>
                <div class="pt-2 flex flex-wrap items-center gap-3 text-xs text-slate-300">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-circle-check text-emerald-400"></i> Amadeus & Sabre GDS Connected</span>
                    <span class="text-slate-600">|</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-clock text-amber-400"></i> Local Time: {{ now()->format('h:i A (T)') }}</span>
                </div>
            </div>

            <!-- Quick Action Buttons -->
            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <a 
                    href="{{ route('customers.create') }}" 
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-500 hover:to-rose-600 text-white font-semibold text-sm shadow-lg shadow-red-600/30 transition-all transform active:scale-95">
                    <i class="fa-solid fa-user-plus text-xs"></i>
                    <span>New Customer</span>
                </a>
                <a 
                    href="{{ route('customers.index') }}" 
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-800/80 hover:bg-slate-700 border border-slate-700 text-white font-medium text-sm transition-all">
                    <i class="fa-solid fa-users text-xs text-red-400"></i>
                    <span>Manage Customers</span>
                </a>
                <a 
                    href="#flight-search" 
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-medium text-sm backdrop-blur-sm border border-white/10 transition-all">
                    <i class="fa-solid fa-plane text-xs"></i>
                    <span>Book Flight</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 4 Key Performance Metrics (KPI Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach($kpis as $kpi)
            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ $kpi['title'] }}</span>
                    <span class="w-10 h-10 rounded-xl {{ $kpi['bg_light'] }} flex items-center justify-center transition-transform group-hover:scale-110">
                        <i class="fa-solid fa-{{ $kpi['icon'] }} text-base"></i>
                    </span>
                </div>
                
                <div class="mt-4">
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-heading">{{ $kpi['value'] }}</h3>
                    <div class="mt-2 flex items-center gap-2">
                        <span class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200/60">
                            <i class="fa-solid fa-arrow-trend-up text-[10px]"></i>
                            {{ $kpi['change'] }}
                        </span>
                        <span class="text-xs text-slate-400">{{ $kpi['period'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Flight & Holiday Quick Search Widget (Sabre Style) -->
    <div id="flight-search" class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-red-600"></span>
                    <h2 class="text-lg font-bold text-slate-900 font-heading">Flight & Tour Instant Search Engine</h2>
                </div>
                <p class="text-xs text-slate-500 mt-1">Live GDS airline seat availability, group tour tariffs and hotel inventory.</p>
            </div>
            
            <!-- Trip Type Toggle -->
            <div class="inline-flex p-1 bg-slate-100 rounded-xl text-xs font-semibold text-slate-600">
                <button type="button" class="px-3.5 py-1.5 rounded-lg bg-red-600 text-white shadow-xs">Round Trip</button>
                <button type="button" class="px-3.5 py-1.5 rounded-lg hover:text-slate-900 transition-colors">One Way</button>
                <button type="button" class="px-3.5 py-1.5 rounded-lg hover:text-slate-900 transition-colors">Multi City</button>
                <button type="button" class="px-3.5 py-1.5 rounded-lg hover:text-slate-900 transition-colors">Holiday Tour</button>
            </div>
        </div>

        <!-- Search Form Row -->
        <form onsubmit="event.preventDefault(); alert('Searching live GDS flight routes for AR Holidays travelers...');" class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            
            <!-- Origin -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">From (Origin)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                        <i class="fa-solid fa-plane-departure text-xs text-red-500"></i>
                    </span>
                    <input 
                        type="text" 
                        value="Lahore (LHE)" 
                        class="w-full pl-9 pr-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-semibold text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>
            </div>

            <!-- Destination -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">To (Destination)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                        <i class="fa-solid fa-plane-arrival text-xs text-red-500"></i>
                    </span>
                    <input 
                        type="text" 
                        value="Dubai, UAE (DXB)" 
                        class="w-full pl-9 pr-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-semibold text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>
            </div>

            <!-- Departure Date -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Departure Date</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                        <i class="fa-regular fa-calendar text-xs"></i>
                    </span>
                    <input 
                        type="date" 
                        value="{{ date('Y-m-d', strtotime('+7 days')) }}" 
                        class="w-full pl-9 pr-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-semibold text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>
            </div>

            <!-- Passengers & Class -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Travelers & Class</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                        <i class="fa-solid fa-user-group text-xs"></i>
                    </span>
                    <select class="w-full pl-9 pr-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-semibold text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        <option>2 Adults · Economy</option>
                        <option>1 Adult · Business Class</option>
                        <option>2 Adults, 2 Kids · Family</option>
                        <option>1 Adult · First Class</option>
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="space-y-1.5 flex flex-col justify-end">
                <button 
                    type="submit" 
                    class="w-full py-2.5 px-4 bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md shadow-red-600/20 hover:shadow-lg hover:shadow-red-600/30 transition-all flex items-center justify-center gap-2 transform active:scale-95">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    <span>Search Fares</span>
                </button>
            </div>

        </form>
    </div>

    <!-- Main Two Column Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Recent Bookings Table & Customer Activity (8 Cols) -->
        <div class="lg:col-span-8 space-y-8">
            
            <!-- Recent Bookings Table -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 font-heading">Recent Flight & Tour Bookings</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Real-time GDS transactions and holiday package reservations.</p>
                    </div>
                    <a href="{{ route('customers.index') }}" class="text-xs font-bold text-red-600 hover:text-red-700 flex items-center gap-1">
                        View All
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50/80 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-100">
                            <tr>
                                <th class="py-3.5 px-6">Traveler</th>
                                <th class="py-3.5 px-4">Flight / Tour</th>
                                <th class="py-3.5 px-4">Departure</th>
                                <th class="py-3.5 px-4">Amount</th>
                                <th class="py-3.5 px-4">Status</th>
                                <th class="py-3.5 px-6 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                            @foreach($recentBookings as $bkg)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $bkg['avatar'] }}" alt="{{ $bkg['customer'] }}" class="w-9 h-9 rounded-xl object-cover ring-1 ring-slate-200 shrink-0">
                                            <div>
                                                <p class="font-bold text-slate-900 text-sm leading-tight">{{ $bkg['customer'] }}</p>
                                                <p class="text-[11px] text-slate-400 font-mono">PNR: {{ $bkg['pnr'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="space-y-0.5">
                                            <p class="font-semibold text-slate-800">{{ $bkg['destination'] }}</p>
                                            <p class="text-[11px] text-slate-400">{{ $bkg['flight'] }}</p>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap text-slate-600">
                                        <i class="fa-regular fa-calendar-check text-[11px] mr-1 text-slate-400"></i>
                                        {{ $bkg['date'] }}
                                    </td>
                                    <td class="py-4 px-4 font-bold text-slate-900">
                                        {{ $bkg['amount'] }}
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $bkg['badge'] }}">
                                            {{ $bkg['status'] }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right whitespace-nowrap">
                                        <a href="{{ route('customers.show', 1) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 transition-colors" title="View Dossier">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>Showing recent 5 bookings from Sabre GDS</span>
                    <span class="text-emerald-600 font-semibold flex items-center gap-1">
                        <i class="fa-solid fa-arrows-rotate text-[10px]"></i> Live Sync Active
                    </span>
                </div>
            </div>

            <!-- Customer Management Highlight Box -->
            <div class="rounded-3xl p-6 sm:p-8 bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 text-white border border-slate-800 shadow-xl relative overflow-hidden">
                <div class="absolute -right-12 -top-12 w-64 h-64 bg-red-600/10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-2 max-w-lg">
                        <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded bg-red-500/20 text-red-400 text-[11px] font-bold">
                            <i class="fa-solid fa-id-card"></i>
                            <span>TRAVELER DIRECTORY & PASSPORT REPOSITORY</span>
                        </div>
                        <h3 class="text-xl font-bold font-heading">Manage Your Clients with High-Precision Profiling</h3>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Organize passport validity dates, visas, frequent flyer points, medical meal preferences, and past travel itineraries in one sleek static interface.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                        <a href="{{ route('customers.create') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 text-white font-semibold text-xs tracking-wide uppercase hover:from-red-500 hover:to-rose-600 shadow-lg shadow-red-600/30 text-center transition-all">
                            + Add New Client
                        </a>
                        <a href="{{ route('customers.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 border border-slate-700 text-white font-semibold text-xs tracking-wide uppercase text-center transition-all">
                            View Customer List
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Trending Holiday Packages & Customer Quick Bar (4 Cols) -->
        <div class="lg:col-span-4 space-y-8">
            
            <!-- Quick Customer Spotlight Card -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider font-heading flex items-center gap-2">
                        <i class="fa-solid fa-crown text-amber-500"></i> VIP Travelers
                    </h3>
                    <a href="{{ route('customers.index') }}" class="text-xs font-semibold text-red-600 hover:underline">View All</a>
                </div>

                <div class="mt-4 space-y-3">
                    <a href="{{ route('customers.show', 1) }}" class="flex items-center justify-between p-3 rounded-2xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-200 group">
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Hamza" class="w-10 h-10 rounded-xl object-cover ring-2 ring-amber-500/30">
                            <div>
                                <p class="text-xs font-bold text-slate-900 group-hover:text-red-600 transition-colors">Muhammad Hamza</p>
                                <p class="text-[11px] text-slate-400">14 Trips · Dubai (DXB)</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-amber-50 text-amber-700 border border-amber-200">Platinum</span>
                    </a>

                    <a href="{{ route('customers.show', 2) }}" class="flex items-center justify-between p-3 rounded-2xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-200 group">
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&auto=format&fit=crop&q=80" alt="Fatima" class="w-10 h-10 rounded-xl object-cover ring-2 ring-red-500/30">
                            <div>
                                <p class="text-xs font-bold text-slate-900 group-hover:text-red-600 transition-colors">Fatima Zahra</p>
                                <p class="text-[11px] text-slate-400">8 Trips · Baku (GYD)</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-red-50 text-red-700 border border-red-200">Gold</span>
                    </a>

                    <a href="{{ route('customers.show', 3) }}" class="flex items-center justify-between p-3 rounded-2xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-200 group">
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80" alt="Bilal" class="w-10 h-10 rounded-xl object-cover ring-2 ring-amber-500/30">
                            <div>
                                <p class="text-xs font-bold text-slate-900 group-hover:text-red-600 transition-colors">Bilal Siddiqui</p>
                                <p class="text-[11px] text-slate-400">19 Trips · London (LHR)</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-amber-50 text-amber-700 border border-amber-200">Platinum</span>
                    </a>
                </div>

                <div class="mt-4 pt-4 border-t border-slate-100">
                    <a href="{{ route('customers.create') }}" class="w-full py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold flex items-center justify-center gap-2 transition-colors">
                        <i class="fa-solid fa-plus text-[10px] text-red-600"></i>
                        <span>Register New Traveler</span>
                    </a>
                </div>
            </div>

            <!-- Top Trending Holiday Packages (Curated for AR Holidays) -->
            <div id="holiday-packages" class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-5">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider font-heading">Trending Holiday Packages</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Top seller tours with high commission rates.</p>
                    </div>
                    <span class="text-xs font-bold text-red-600 bg-red-50 px-2 py-1 rounded-lg">2026/27</span>
                </div>

                <div class="space-y-4">
                    @foreach($packages as $pkg)
                        <div class="p-3.5 rounded-2xl border border-slate-200/80 hover:border-red-300 hover:shadow-md transition-all duration-200 group bg-slate-50/50 hover:bg-white">
                            <div class="relative h-32 rounded-xl overflow-hidden mb-3">
                                <img src="{{ $pkg['image'] }}" alt="{{ $pkg['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <span class="absolute top-2.5 left-2.5 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-slate-950/80 text-white backdrop-blur-xs">
                                    {{ $pkg['badge'] }}
                                </span>
                                <span class="absolute bottom-2.5 right-2.5 text-xs font-extrabold px-2 py-0.5 rounded-md bg-red-600 text-white shadow-md">
                                    {{ $pkg['price'] }} <span class="text-[10px] font-normal">/ pax</span>
                                </span>
                            </div>

                            <h4 class="text-xs font-bold text-slate-900 leading-snug group-hover:text-red-600 transition-colors">
                                {{ $pkg['name'] }}
                            </h4>
                            
                            <div class="mt-2 flex items-center justify-between text-[11px] text-slate-500">
                                <span><i class="fa-regular fa-clock text-slate-400 mr-1"></i> {{ $pkg['days'] }}</span>
                                <span class="text-amber-500 font-semibold"><i class="fa-solid fa-star text-[10px]"></i> {{ $pkg['rating'] }}</span>
                            </div>

                            <div class="mt-3 pt-3 border-t border-slate-200/60 flex items-center justify-between">
                                <span class="text-[10px] text-slate-400 line-through">Reg: {{ $pkg['original_price'] }}</span>
                                <button type="button" onclick="alert('Package details for {{ $pkg['name'] }} opened.')" class="text-xs font-bold text-red-600 hover:text-red-700 flex items-center gap-1">
                                    Book Tour <i class="fa-solid fa-chevron-right text-[10px]"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Visa Desk Status Pill -->
            <div id="visa-desk" class="bg-gradient-to-br from-red-600 to-rose-700 rounded-3xl p-6 text-white shadow-xl shadow-red-600/20">
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-white text-lg">
                        <i class="fa-solid fa-passport"></i>
                    </span>
                    <div>
                        <h4 class="text-sm font-bold font-heading">Visa & Immigration Desk</h4>
                        <p class="text-xs text-red-100">42 Visas in Process</p>
                    </div>
                </div>

                <div class="mt-4 space-y-2 text-xs">
                    <div class="flex justify-between text-red-100">
                        <span>UAE 2-Yr Multiple</span>
                        <span class="font-bold text-white">98% Success</span>
                    </div>
                    <div class="w-full bg-black/20 rounded-full h-1.5 overflow-hidden">
                        <div class="bg-white h-full rounded-full" style="width: 98%"></div>
                    </div>

                    <div class="flex justify-between text-red-100 pt-1">
                        <span>Azerbaijan E-Visa</span>
                        <span class="font-bold text-white">3 Hours Fast Track</span>
                    </div>
                    <div class="w-full bg-black/20 rounded-full h-1.5 overflow-hidden">
                        <div class="bg-white h-full rounded-full" style="width: 100%"></div>
                    </div>
                </div>

                <a href="{{ route('customers.index') }}" class="mt-4 block w-full py-2 bg-white text-red-700 text-xs font-bold text-center rounded-xl hover:bg-red-50 transition-colors">
                    Check Passport / Visa Records
                </a>
            </div>

        </div>

    </div>

</div>
@endsection
