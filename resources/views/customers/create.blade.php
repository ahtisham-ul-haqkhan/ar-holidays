@extends('layouts.app')

@section('title', 'Add New Customer · AR Holidays')

@section('content')
<div class="space-y-6 w-full">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-slate-500 font-medium">
        <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition-colors flex items-center gap-1">
            <i class="fa-solid fa-house text-[10px]"></i>
            <span>Dashboard</span>
        </a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <a href="{{ route('customers.index') }}" class="hover:text-red-600 transition-colors">Customers</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <span class="text-slate-800 font-semibold">New Customer</span>
    </nav>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-heading flex items-center gap-2.5">
                <span>Register New Customer</span>
                <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-red-50 text-red-600 border border-red-200">
                    Auto-Code: AR-90{{ rand(10, 99) }}
                </span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Enter passport credentials, visa validity dates, emergency contacts, and personalized travel preferences.
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a 
                href="{{ route('customers.index') }}" 
                class="px-4 py-2.5 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold transition-all shadow-xs">
                Cancel
            </a>
            <button 
                type="submit" 
                form="create-customer-form" 
                class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold tracking-wide uppercase shadow-md shadow-red-600/25 hover:shadow-lg transition-all flex items-center gap-2">
                <i class="fa-solid fa-check text-xs"></i>
                <span>Save Customer</span>
            </button>
        </div>
    </div>

    <!-- Form Container -->
    <form id="create-customer-form" method="POST" action="{{ route('customers.store') }}" class="space-y-6">
        @csrf

        <!-- Card 1: Personal Identification -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center font-bold text-sm">
                    1
                </span>
                <div>
                    <h2 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">Personal Information</h2>
                    <p class="text-xs text-slate-400">Primary legal details matching the traveler's passport.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                
                <!-- Title -->
                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Title *</label>
                    <select class="w-full px-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        @foreach($titles as $t)
                            <option value="{{ $t }}">{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- First & Middle Name -->
                <div class="sm:col-span-5 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">First / Given Name(s) *</label>
                    <input 
                        type="text" 
                        required 
                        placeholder="e.g. Muhammad" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Last Name -->
                <div class="sm:col-span-5 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Last / Surname *</label>
                    <input 
                        type="text" 
                        required 
                        placeholder="e.g. Hamza" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Date of Birth -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Date of Birth *</label>
                    <input 
                        type="date" 
                        required 
                        value="1992-06-15"
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Gender -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Gender *</label>
                    <select class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <!-- Nationality -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nationality *</label>
                    <select class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        @foreach($countries as $c)
                            <option value="{{ $c }}">{{ $c }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>

        <!-- Card 2: Contact & Address Information -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center font-bold text-sm">
                    2
                </span>
                <div>
                    <h2 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">Contact & Residency Details</h2>
                    <p class="text-xs text-slate-400">Communication channels for flight ticketing and visa updates.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                
                <!-- Email -->
                <div class="sm:col-span-6 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Email Address *</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                            <i class="fa-regular fa-envelope text-xs"></i>
                        </span>
                        <input 
                            type="email" 
                            required 
                            placeholder="traveler@example.com" 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                        >
                    </div>
                </div>

                <!-- Phone -->
                <div class="sm:col-span-3 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Mobile Number *</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                            <i class="fa-solid fa-phone text-xs"></i>
                        </span>
                        <input 
                            type="text" 
                            required 
                            placeholder="+92 300 1234567" 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                        >
                    </div>
                </div>

                <!-- WhatsApp -->
                <div class="sm:col-span-3 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">WhatsApp Number</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-emerald-500 pointer-events-none">
                            <i class="fa-brands fa-whatsapp text-xs"></i>
                        </span>
                        <input 
                            type="text" 
                            placeholder="+92 300 1234567" 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                        >
                    </div>
                </div>

                <!-- City -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">City of Residence</label>
                    <input 
                        type="text" 
                        placeholder="Lahore / Islamabad / Karachi" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Street Address -->
                <div class="sm:col-span-8 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Full Postal Address</label>
                    <input 
                        type="text" 
                        placeholder="House #, Street, Phase / Sector, City" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

            </div>
        </div>

        <!-- Card 3: Passport & Travel Documentation -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center font-bold text-sm">
                    3
                </span>
                <div>
                    <h2 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">Passport & Identification Archive</h2>
                    <p class="text-xs text-slate-400">Strictly verified for GDS ticketing and international visa requirements.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                
                <!-- Passport Number -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Passport Number *</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                            <i class="fa-solid fa-passport text-xs"></i>
                        </span>
                        <input 
                            type="text" 
                            required 
                            placeholder="e.g. PK8829104" 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-mono font-bold text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 uppercase transition-all"
                        >
                    </div>
                </div>

                <!-- Passport Country of Issue -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Issuing Country *</label>
                    <select class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        @foreach($countries as $c)
                            <option value="{{ $c }}">{{ $c }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Passport Expiry Date -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Passport Expiry Date *</label>
                    <input 
                        type="date" 
                        required 
                        value="2031-10-20"
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- CNIC / National ID -->
                <div class="sm:col-span-6 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">National ID / CNIC</label>
                    <input 
                        type="text" 
                        placeholder="35202-xxxxxxx-x" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-mono font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Loyalty / Club Tier -->
                <div class="sm:col-span-6 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">VIP Loyalty Tier</label>
                    <select class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        <option value="Standard">Standard Member</option>
                        <option value="Silver Member">Silver Member</option>
                        <option value="Gold Member">Gold Member</option>
                        <option value="Platinum VIP" selected>Platinum VIP (Exclusive Concierge)</option>
                    </select>
                </div>

            </div>
        </div>

        <!-- Card 4: Travel Preferences & Airline Memberships -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center font-bold text-sm">
                    4
                </span>
                <div>
                    <h2 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">Travel Preferences & Frequent Flyer</h2>
                    <p class="text-xs text-slate-400">Personalized options automatically sent to airlines during PNR reservation.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                
                <!-- Preferred Airline -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Preferred Carrier</label>
                    <select class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        @foreach($airlines as $a)
                            <option value="{{ $a }}">{{ $a }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Frequent Flyer No -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Frequent Flyer Number</label>
                    <input 
                        type="text" 
                        placeholder="e.g. EK-9821038" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-mono font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Seat Preference -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Seating Preference</label>
                    <select class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        <option value="Window">Window Seat</option>
                        <option value="Aisle">Aisle Seat</option>
                        <option value="Extra Legroom">Extra Legroom / Bulkhead</option>
                    </select>
                </div>

                <!-- Meal Preference -->
                <div class="sm:col-span-6 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Special Meal Code</label>
                    <select class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        <option value="MOML">Halal Muslim Meal (MOML)</option>
                        <option value="AVML">Asian Vegetarian Meal (AVML)</option>
                        <option value="DBML">Diabetic Meal (DBML)</option>
                        <option value="GFML">Gluten Free Meal (GFML)</option>
                        <option value="CHML">Child Meal (CHML)</option>
                    </select>
                </div>

                <!-- Emergency Contact Name & Phone -->
                <div class="sm:col-span-6 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Emergency Contact (Name & Phone)</label>
                    <input 
                        type="text" 
                        placeholder="e.g. Ayesha Hamza (+92 321 4455667)" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

            </div>
        </div>

        <!-- Form Action Bar -->
        <div class="p-6 bg-white rounded-3xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3 text-xs text-slate-500">
                <i class="fa-solid fa-lock text-red-600"></i>
                <span>All documents are encrypted with AES-256 for traveler privacy compliance.</span>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a 
                    href="{{ route('customers.index') }}" 
                    class="flex-1 sm:flex-none px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold text-center transition-colors">
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="flex-1 sm:flex-none px-6 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold uppercase tracking-wider shadow-md shadow-red-600/30 transition-all flex items-center justify-center gap-2 transform active:scale-95">
                    <i class="fa-solid fa-check"></i>
                    <span>Save Customer Profile</span>
                </button>
            </div>
        </div>

    </form>

</div>
@endsection

