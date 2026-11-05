@extends('layouts.app')

@section('title', 'Customers Directory · AR Holidays')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-slate-500 font-medium">
        <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition-colors flex items-center gap-1">
            <i class="fa-solid fa-house text-[10px]"></i>
            <span>Dashboard</span>
        </a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <span class="text-slate-800 font-semibold">Customers Management</span>
    </nav>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-heading flex items-center gap-2.5">
                <span>Customer Directory</span>
                <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-red-50 text-red-600 border border-red-200">
                    {{ count($customers) }} Travelers Listed
                </span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Comprehensive traveler profiles, passport document archives, VIP loyalty tiers, and booking dossiers.
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <button 
                type="button" 
                onclick="alert('Exporting customer database as CSV...')" 
                class="px-4 py-2.5 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold flex items-center gap-2 shadow-xs transition-all">
                <i class="fa-solid fa-file-export text-slate-400"></i>
                <span class="hidden sm:inline">Export CSV</span>
            </button>
            
            <a 
                href="{{ route('customers.create') }}" 
                class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold tracking-wide uppercase flex items-center gap-2 shadow-md shadow-red-600/25 hover:shadow-lg hover:shadow-red-600/30 transition-all transform active:scale-95">
                <i class="fa-solid fa-user-plus text-xs"></i>
                <span>Add New Customer</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Travelers</p>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-1 font-heading">{{ $stats['total'] }}</h3>
                <span class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-arrow-up text-[9px]"></i> +64 this month
                </span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">VIP Club</p>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-1 font-heading">{{ $stats['vip_count'] }}</h3>
                <span class="text-[11px] text-amber-600 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-crown text-[9px]"></i> Platinum & Gold
                </span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-star"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Active Bookings</p>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-1 font-heading">{{ $stats['active_bookings'] }}</h3>
                <span class="text-[11px] text-blue-600 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-plane text-[9px]"></i> In Transit
                </span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-ticket"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Visa Applications</p>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-1 font-heading">{{ $stats['pending_visas'] }}</h3>
                <span class="text-[11px] text-purple-600 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-hourglass-half text-[9px]"></i> Under Processing
                </span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-passport"></i>
            </div>
        </div>
    </div>

    <!-- Search & Filters Toolbar -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs space-y-4">
        <form method="GET" action="{{ route('customers.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            
            <!-- Search Input -->
            <div class="sm:col-span-6 relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </span>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $searchTerm }}" 
                    placeholder="Search by traveler name, email, phone, passport (e.g. PK8829104)..." 
                    class="w-full pl-9 pr-4 py-2 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                >
            </div>

            <!-- Status Dropdown -->
            <div class="sm:col-span-3">
                <select 
                    name="status" 
                    onchange="this.form.submit()" 
                    class="w-full px-3 py-2 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    <option value="All" {{ $selectedStatus === 'All' ? 'selected' : '' }}>All Statuses</option>
                    <option value="Active" {{ $selectedStatus === 'Active' ? 'selected' : '' }}>Active Travelers</option>
                    <option value="Pending Renewal" {{ $selectedStatus === 'Pending Renewal' ? 'selected' : '' }}>Pending Renewal</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="sm:col-span-3 flex items-center gap-2">
                <button 
                    type="submit" 
                    class="flex-1 py-2 px-3 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition-colors">
                    Filter
                </button>
                @if($searchTerm || $selectedStatus !== 'All')
                    <a 
                        href="{{ route('customers.index') }}" 
                        class="py-2 px-3 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-medium rounded-xl transition-colors">
                        Clear
                    </a>
                @endif
            </div>

        </form>
    </div>

    <!-- Customers Main Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50/80 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="py-3.5 px-6">Traveler</th>
                        <th class="py-3.5 px-4">Contact Info</th>
                        <th class="py-3.5 px-4">Passport & Country</th>
                        <th class="py-3.5 px-4">Travel History</th>
                        <th class="py-3.5 px-4">Loyalty Tier</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-slate-50/70 transition-colors group">
                            
                            <!-- Traveler Identity -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="relative">
                                        <img 
                                            src="{{ $customer['avatar'] }}" 
                                            alt="{{ $customer['full_name'] }}" 
                                            class="w-10 h-10 rounded-xl object-cover ring-2 ring-slate-100 shadow-xs group-hover:ring-red-200 transition-all">
                                        <span class="absolute -bottom-1 -right-1 w-3.5 h-3.5 rounded-full bg-emerald-500 ring-2 ring-white"></span>
                                    </div>
                                    <div>
                                        <a href="{{ route('customers.show', $customer['id']) }}" class="font-bold text-slate-900 text-sm hover:text-red-600 transition-colors">
                                            {{ $customer['full_name'] }}
                                        </a>
                                        <div class="flex items-center gap-1.5 mt-0.5 text-[11px] text-slate-400">
                                            <span class="font-mono font-semibold text-red-600 bg-red-50 px-1.5 py-0.2 rounded">{{ $customer['customer_code'] }}</span>
                                            <span>· {{ $customer['gender'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact Info -->
                            <td class="py-4 px-4">
                                <div class="space-y-1">
                                    <p class="text-slate-800 font-medium">{{ $customer['email'] }}</p>
                                    <div class="flex items-center gap-2 text-[11px] text-slate-400">
                                        <span>{{ $customer['phone'] }}</span>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $customer['whatsapp']) }}" target="_blank" class="text-emerald-500 hover:text-emerald-600" title="Chat on WhatsApp">
                                            <i class="fa-brands fa-whatsapp text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>

                            <!-- Passport Details -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <div class="space-y-0.5">
                                    <div class="flex items-center gap-1.5">
                                        <i class="fa-solid fa-passport text-slate-400 text-xs"></i>
                                        <span class="font-mono font-bold text-slate-800">{{ $customer['passport_number'] }}</span>
                                    </div>
                                    <p class="text-[11px] text-slate-400">Exp: {{ date('M Y', strtotime($customer['passport_expiry'])) }} · {{ $customer['nationality'] }}</p>
                                </div>
                            </td>

                            <!-- Travel History -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <div class="space-y-0.5">
                                    <p class="font-bold text-slate-800">{{ $customer['total_bookings'] }} Bookings</p>
                                    <p class="text-[11px] text-slate-400">Last: <strong class="text-slate-600 font-semibold">{{ $customer['last_destination'] }}</strong></p>
                                </div>
                            </td>

                            <!-- Loyalty Tier -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $customer['tier_badge_color'] }}">
                                    @if(str_contains($customer['loyalty_tier'], 'VIP') || str_contains($customer['loyalty_tier'], 'Platinum'))
                                        <i class="fa-solid fa-crown text-[10px]"></i>
                                    @else
                                        <i class="fa-solid fa-award text-[10px]"></i>
                                    @endif
                                    {{ $customer['loyalty_tier'] }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $customer['status_color'] }}">
                                    {{ $customer['status'] }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <a 
                                        href="{{ route('customers.show', $customer['id']) }}" 
                                        class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 flex items-center justify-center transition-colors shadow-xs" 
                                        title="View Customer Profile">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    <a 
                                        href="{{ route('customers.edit', $customer['id']) }}" 
                                        class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 flex items-center justify-center transition-colors shadow-xs" 
                                        title="Edit Profile">
                                        <i class="fa-solid fa-user-pen text-xs"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-xl mb-3">
                                    <i class="fa-solid fa-user-slash"></i>
                                </div>
                                <p class="text-sm font-semibold text-slate-700">No travelers found matching your criteria</p>
                                <p class="text-xs text-slate-400 mt-1">Try adjusting your search terms or filters.</p>
                                <a href="{{ route('customers.index') }}" class="mt-4 inline-block text-xs font-bold text-red-600 hover:underline">
                                    Reset Filters
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Pagination Bar -->
        <div class="px-6 py-4 bg-slate-50/70 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
            <span>Showing <strong class="text-slate-800">{{ count($customers) }}</strong> of 1,420 registered travelers</span>
            
            <div class="inline-flex items-center gap-1">
                <button type="button" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-400 cursor-not-allowed">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                </button>
                <button type="button" class="px-3 py-1.5 rounded-lg bg-red-600 text-white font-bold shadow-xs">1</button>
                <button type="button" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 font-semibold transition-colors">2</button>
                <button type="button" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 font-semibold transition-colors">3</button>
                <span class="px-2">...</span>
                <button type="button" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 font-semibold transition-colors">142</button>
                <button type="button" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 transition-colors">
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </button>
            </div>
        </div>
    </div>

</div>
@endsection

