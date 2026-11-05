@extends('layouts.app')

@section('title', 'Edit ' . $customer['full_name'] . ' · AR Holidays')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-slate-500 font-medium">
        <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition-colors flex items-center gap-1">
            <i class="fa-solid fa-house text-[10px]"></i>
            <span>Dashboard</span>
        </a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <a href="{{ route('customers.index') }}" class="hover:text-red-600 transition-colors">Customers</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <a href="{{ route('customers.show', $customer['id']) }}" class="hover:text-red-600 transition-colors">{{ $customer['full_name'] }}</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <span class="text-slate-800 font-semibold">Edit</span>
    </nav>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-heading flex items-center gap-2.5">
                <span>Edit Customer: {{ $customer['full_name'] }}</span>
                <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-red-50 text-red-600 border border-red-200">
                    {{ $customer['customer_code'] }}
                </span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Update verified passport records, contact details, emergency numbers, and carrier loyalty status.
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a 
                href="{{ route('customers.show', $customer['id']) }}" 
                class="px-4 py-2.5 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold transition-all shadow-xs">
                Cancel
            </a>
            <button 
                type="submit" 
                form="edit-customer-form" 
                class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold tracking-wide uppercase shadow-md shadow-red-600/25 hover:shadow-lg transition-all flex items-center gap-2">
                <i class="fa-solid fa-check text-xs"></i>
                <span>Save Changes</span>
            </button>
        </div>
    </div>

    <!-- Form Container -->
    <form id="edit-customer-form" method="POST" action="{{ route('customers.update', $customer['id']) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Card 1: Personal Identification -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center font-bold text-sm">
                    1
                </span>
                <div>
                    <h2 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">Personal Identity Information</h2>
                    <p class="text-xs text-slate-400">Legal passenger information matching government issued passport.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                
                <!-- Title -->
                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Title *</label>
                    <select class="w-full px-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        @foreach($titles as $t)
                            <option value="{{ $t }}" {{ str_starts_with($customer['full_name'], $t) ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- First Name -->
                <div class="sm:col-span-5 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">First / Given Name(s) *</label>
                    <input 
                        type="text" 
                        required 
                        value="{{ $customer['first_name'] }}" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Last Name -->
                <div class="sm:col-span-5 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Last / Surname *</label>
                    <input 
                        type="text" 
                        required 
                        value="{{ $customer['last_name'] }}" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Date of Birth -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Date of Birth *</label>
                    <input 
                        type="date" 
                        required 
                        value="{{ $customer['dob'] }}"
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Gender -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Gender *</label>
                    <select class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        <option value="Male" {{ $customer['gender'] === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $customer['gender'] === 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ $customer['gender'] === 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <!-- Nationality -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nationality *</label>
                    <select class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        @foreach($countries as $c)
                            <option value="{{ $c }}" {{ str_contains($customer['nationality'], $c) ? 'selected' : '' }}>{{ $c }}</option>
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
                    <p class="text-xs text-slate-400">Communication lines for flight alerts, ticketing & visa receipts.</p>
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
                            value="{{ $customer['email'] }}" 
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
                            value="{{ $customer['phone'] }}" 
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
                            value="{{ $customer['whatsapp'] }}" 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                        >
                    </div>
                </div>

                <!-- City -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">City of Residence</label>
                    <input 
                        type="text" 
                        value="{{ $customer['city'] }}" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Street Address -->
                <div class="sm:col-span-8 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Full Postal Address</label>
                    <input 
                        type="text" 
                        value="{{ $customer['address'] }}" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

            </div>
        </div>

        <!-- Card 3: Passport & Identification -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center font-bold text-sm">
                    3
                </span>
                <div>
                    <h2 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">Passport & Tier Status</h2>
                    <p class="text-xs text-slate-400">Strictly verified for GDS ticketing and international travel clearance.</p>
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
                            value="{{ $customer['passport_number'] }}" 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-mono font-bold text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 uppercase transition-all"
                        >
                    </div>
                </div>

                <!-- Passport Country of Issue -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Issuing Country *</label>
                    <select class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        @foreach($countries as $c)
                            <option value="{{ $c }}" {{ $customer['passport_country'] === $c ? 'selected' : '' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Passport Expiry Date -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Passport Expiry Date *</label>
                    <input 
                        type="date" 
                        required 
                        value="{{ $customer['passport_expiry'] }}"
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- CNIC / National ID -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">National ID / CNIC</label>
                    <input 
                        type="text" 
                        value="{{ $customer['cnic'] }}" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-mono font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Loyalty / Club Tier -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">VIP Loyalty Tier</label>
                    <select class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        <option value="Standard" {{ $customer['loyalty_tier'] === 'Standard' ? 'selected' : '' }}>Standard Member</option>
                        <option value="Silver Member" {{ $customer['loyalty_tier'] === 'Silver Member' ? 'selected' : '' }}>Silver Member</option>
                        <option value="Gold Member" {{ $customer['loyalty_tier'] === 'Gold Member' ? 'selected' : '' }}>Gold Member</option>
                        <option value="Platinum VIP" {{ str_contains($customer['loyalty_tier'], 'Platinum') ? 'selected' : '' }}>Platinum VIP (Concierge)</option>
                    </select>
                </div>

                <!-- Account Status -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Traveler Status</label>
                    <select class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        <option value="Active" {{ $customer['status'] === 'Active' ? 'selected' : '' }}>Active Traveler</option>
                        <option value="Pending Renewal" {{ $customer['status'] === 'Pending Renewal' ? 'selected' : '' }}>Pending Renewal</option>
                        <option value="Suspended">Suspended / Blocked</option>
                    </select>
                </div>

            </div>
        </div>

        <!-- Form Action Bar -->
        <div class="p-6 bg-white rounded-3xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
            <button 
                type="button" 
                onclick="if(confirm('Are you sure you want to remove this customer dossier? This action cannot be undone.')){ alert('Customer marked as archived.'); window.location='{{ route('customers.index') }}'; }" 
                class="text-xs font-semibold text-rose-600 hover:text-rose-800 flex items-center gap-1.5">
                <i class="fa-solid fa-trash text-xs"></i>
                <span>Delete Customer Dossier</span>
            </button>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a 
                    href="{{ route('customers.show', $customer['id']) }}" 
                    class="flex-1 sm:flex-none px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold text-center transition-colors">
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="flex-1 sm:flex-none px-6 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold uppercase tracking-wider shadow-md shadow-red-600/30 transition-all flex items-center justify-center gap-2 transform active:scale-95">
                    <i class="fa-solid fa-check"></i>
                    <span>Save Changes</span>
                </button>
            </div>
        </div>

    </form>

</div>
@endsection

