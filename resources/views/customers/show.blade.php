@extends('layouts.app')

@section('title', $customer['full_name'] . ' · Traveler Profile · AR Holidays')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-slate-500 font-medium">
        <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition-colors flex items-center gap-1">
            <i class="fa-solid fa-house text-[10px]"></i>
            <span>Dashboard</span>
        </a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <a href="{{ route('customers.index') }}" class="hover:text-red-600 transition-colors">Customers</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <span class="text-slate-800 font-semibold">{{ $customer['full_name'] }}</span>
    </nav>

    <!-- Top Profile Summary Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs relative overflow-hidden">
        <div class="absolute top-0 right-0 w-80 h-80 bg-red-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            
            <!-- Left Info -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                <div class="relative shrink-0">
                    <img 
                        src="{{ $customer['avatar'] }}" 
                        alt="{{ $customer['full_name'] }}" 
                        class="w-24 h-24 rounded-2xl object-cover ring-4 ring-slate-100 shadow-md">
                    <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-emerald-500 ring-4 ring-white flex items-center justify-center text-white text-[9px]">
                        <i class="fa-solid fa-check"></i>
                    </span>
                </div>

                <div class="space-y-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-heading">
                            {{ $customer['full_name'] }}
                        </h1>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $customer['tier_badge_color'] }}">
                            <i class="fa-solid fa-crown text-[10px] mr-1"></i>
                            {{ $customer['loyalty_tier'] }}
                        </span>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $customer['status_color'] }}">
                            {{ $customer['status'] }}
                        </span>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 text-xs text-slate-500">
                        <span class="flex items-center gap-1.5 font-mono font-bold text-red-600 bg-red-50 px-2 py-0.5 rounded">
                            <i class="fa-solid fa-id-badge text-[11px]"></i>
                            {{ $customer['customer_code'] }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i class="fa-solid fa-passport text-slate-400"></i>
                            Passport: <strong class="text-slate-700 font-mono">{{ $customer['passport_number'] }}</strong>
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i class="fa-solid fa-location-dot text-slate-400"></i>
                            {{ $customer['city'] }}, {{ $customer['nationality'] }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i class="fa-regular fa-calendar text-slate-400"></i>
                            Client Since: {{ $customer['member_since'] }}
                        </span>
                    </div>

                    <!-- Direct Contact Badges -->
                    <div class="pt-1 flex flex-wrap items-center gap-2">
                        <a href="mailto:{{ $customer['email'] }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium transition-colors">
                            <i class="fa-regular fa-envelope text-slate-500 text-[11px]"></i>
                            {{ $customer['email'] }}
                        </a>
                        <a href="tel:{{ $customer['phone'] }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium transition-colors">
                            <i class="fa-solid fa-phone text-slate-500 text-[11px]"></i>
                            {{ $customer['phone'] }}
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $customer['whatsapp']) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-semibold transition-colors">
                            <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                            WhatsApp Message
                        </a>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap sm:flex-col gap-2.5 shrink-0">
                <a 
                    href="{{ route('customers.edit', $customer['id']) }}" 
                    class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold text-center flex items-center justify-center gap-2 shadow-xs transition-colors">
                    <i class="fa-solid fa-user-pen text-xs"></i>
                    <span>Edit Profile</span>
                </a>
                <button 
                    type="button" 
                    onclick="alert('Creating new flight booking for {{ $customer['full_name'] }}...')" 
                    class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold uppercase tracking-wider text-center flex items-center justify-center gap-2 shadow-md shadow-red-600/20 transition-all">
                    <i class="fa-solid fa-plane-departure text-xs"></i>
                    <span>New Booking</span>
                </button>
            </div>

        </div>
    </div>

    <!-- 4 Stats Cards for Traveler -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Bookings</p>
            <h3 class="text-2xl font-extrabold text-slate-900 mt-1 font-heading">{{ $customer['total_bookings'] }} Trips</h3>
            <p class="text-[11px] text-slate-400 mt-0.5">Flights & Holiday Tours</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Revenue</p>
            <h3 class="text-2xl font-extrabold text-slate-900 mt-1 font-heading">{{ $customer['total_spend'] }}</h3>
            <p class="text-[11px] text-emerald-600 font-semibold mt-0.5"><i class="fa-solid fa-circle-check text-[10px]"></i> Zero Outstanding Balance</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Passport Status</p>
            <h3 class="text-lg font-bold text-slate-900 mt-1 truncate">{{ $customer['passport_status'] }}</h3>
            <p class="text-[11px] text-slate-400 mt-0.5">Expires: {{ date('d M Y', strtotime($customer['passport_expiry'])) }}</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Frequent Carrier</p>
            <h3 class="text-lg font-bold text-slate-900 mt-1 truncate">{{ $customer['preferences']['airline'] }}</h3>
            <p class="text-[11px] text-red-600 font-semibold mt-0.5">Priority Check-in Active</p>
        </div>
    </div>

    <!-- Tabbed Profile Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Travel History & Bookings (8 Cols) -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- Bookings History Table -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 font-heading">Travel & Booking Dossier</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Past and upcoming itineraries booked through AR Holidays.</p>
                    </div>
                    <button type="button" onclick="alert('Creating new ticket voucher...')" class="text-xs font-bold text-red-600 hover:text-red-700 flex items-center gap-1">
                        + Issue Ticket
                    </button>
                </div>

                <div class="divide-y divide-slate-100">
                    @foreach($customer['bookings'] as $bkg)
                        <div class="p-6 hover:bg-slate-50/70 transition-colors">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="text-sm font-bold text-slate-900">{{ $bkg['title'] }}</h3>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $bkg['status_color'] }}">
                                            {{ $bkg['status'] }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">
                                        {{ $bkg['airline'] }} · <strong class="text-slate-700">{{ $bkg['destination'] }}</strong>
                                    </p>
                                </div>

                                <div class="text-right sm:text-right">
                                    <p class="text-base font-extrabold text-slate-900 font-heading">{{ $bkg['amount'] }}</p>
                                    <p class="text-[11px] font-mono text-slate-400">PNR: {{ $bkg['pnr'] }}</p>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-2 text-xs text-slate-500">
                                <div class="flex items-center gap-4">
                                    <span><i class="fa-regular fa-calendar-days text-slate-400 mr-1"></i> Dep: {{ $bkg['departure'] }}</span>
                                    <span><i class="fa-solid fa-rotate-left text-slate-400 mr-1"></i> Ret: {{ $bkg['return'] }}</span>
                                    <span><i class="fa-solid fa-users text-slate-400 mr-1"></i> {{ $bkg['passengers'] }} Pax</span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <button type="button" onclick="alert('E-ticket for {{ $bkg['pnr'] }} downloaded.')" class="px-3 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium transition-colors">
                                        <i class="fa-solid fa-download text-[10px] mr-1"></i> E-Ticket PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Documents & Visas Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-4">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 font-heading">Passport & Visa Archives</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Verified travel documents on file for rapid visa submissions.</p>
                    </div>
                    <button type="button" onclick="alert('Upload document dialog opened.')" class="px-3 py-1.5 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 text-xs font-semibold transition-colors">
                        + Upload Document
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($customer['documents'] as $doc)
                        <div class="p-4 rounded-2xl border border-slate-200/80 hover:border-slate-300 transition-colors flex items-center justify-between gap-3 bg-slate-50/50">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-red-600 text-base shadow-xs">
                                    <i class="fa-solid fa-file-shield"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900">{{ $doc['title'] }}</h4>
                                    <p class="text-[11px] text-slate-400">Validity: {{ $doc['expiry'] }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $doc['status'] === 'Verified' || $doc['status'] === 'Valid' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                {{ $doc['status'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <!-- Right Column: Personal & Preferences Details (4 Cols) -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Personal Information Sheet -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider font-heading pb-3 border-b border-slate-100">
                    Traveler Credentials
                </h3>

                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-slate-400 font-medium">Full Name (as per Passport):</span>
                        <p class="font-bold text-slate-900 mt-0.5">{{ $customer['full_name'] }}</p>
                    </div>

                    <div>
                        <span class="text-slate-400 font-medium">National Identity (CNIC):</span>
                        <p class="font-mono font-bold text-slate-900 mt-0.5">{{ $customer['cnic'] }}</p>
                    </div>

                    <div>
                        <span class="text-slate-400 font-medium">Date of Birth:</span>
                        <p class="font-medium text-slate-800 mt-0.5">{{ date('d F Y', strtotime($customer['dob'])) }}</p>
                    </div>

                    <div>
                        <span class="text-slate-400 font-medium">Gender / Nationality:</span>
                        <p class="font-medium text-slate-800 mt-0.5">{{ $customer['gender'] }} · {{ $customer['nationality'] }}</p>
                    </div>

                    <div>
                        <span class="text-slate-400 font-medium">Residential Address:</span>
                        <p class="font-medium text-slate-800 mt-0.5">{{ $customer['address'] }}</p>
                    </div>
                </div>
            </div>

            <!-- In-Flight Travel Preferences -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider font-heading pb-3 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-sliders text-red-600"></i> Airline Preferences
                </h3>

                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-slate-400 font-medium">Preferred Seating:</span>
                        <p class="font-bold text-slate-800 mt-0.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-chair text-slate-400"></i>
                            {{ $customer['preferences']['seat'] }}
                        </p>
                    </div>

                    <div>
                        <span class="text-slate-400 font-medium">Dietary & Meal Code:</span>
                        <p class="font-bold text-slate-800 mt-0.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-utensils text-slate-400"></i>
                            {{ $customer['preferences']['meal'] }}
                        </p>
                    </div>

                    <div>
                        <span class="text-slate-400 font-medium">Hotel Accommodation Standard:</span>
                        <p class="font-bold text-slate-800 mt-0.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-hotel text-slate-400"></i>
                            {{ $customer['preferences']['hotel'] }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact Card -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-3">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider font-heading pb-3 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-kit-medical text-red-600"></i> Emergency Contact
                </h3>

                <div class="text-xs space-y-1">
                    <p class="font-bold text-slate-900 text-sm">{{ $customer['emergency_contact']['name'] }}</p>
                    <p class="text-slate-500">Relationship: <strong class="text-slate-700 font-semibold">{{ $customer['emergency_contact']['relation'] }}</strong></p>
                    <p class="text-slate-500">Phone: <strong class="text-slate-700 font-mono font-semibold">{{ $customer['emergency_contact']['phone'] }}</strong></p>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection

