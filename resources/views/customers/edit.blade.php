@extends('layouts.app')

@section('title', 'Edit ' . ($customer->name ?? 'Customer') . ' · AR Holidays')

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
        <a href="{{ route('customers.show', $customer->id) }}" class="hover:text-red-600 transition-colors">{{ $customer->name ?? 'Customer' }}</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <span class="text-slate-800 font-semibold">Edit</span>
    </nav>

    <!-- Page Header -->
    <div class="pb-2 border-b border-slate-200">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-heading flex items-center gap-2.5">
            <span>Edit Customer: {{ $customer->name ?? 'Customer #' . $customer->id }}</span>
            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 border border-slate-200">
                ID #{{ $customer->id }}
            </span>
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">
            Update customer identity records, passport, and contact credentials.
        </p>
    </div>

    <!-- Error Summary (if any) -->
    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
            <div class="flex items-center gap-2 font-bold mb-1">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>Please fix the following errors:</span>
            </div>
            <ul class="list-disc list-inside space-y-0.5 text-rose-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Container -->
    <form id="edit-customer-form" method="POST" action="{{ route('customers.update', $customer->id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Card: Customer Details -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="pb-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">Customer Profile Information</h2>
                    <p class="text-xs text-slate-400">Personal, identity, and contact information.</p>
                </div>
                <span class="text-[11px] font-semibold text-rose-600 bg-rose-50 px-2.5 py-1 rounded-full border border-rose-200">
                    * CNIC is required & unique
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                
                <!-- Title -->
                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Title</label>
                    <select 
                        name="title" 
                        class="w-full px-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        <option value="">Select Title</option>
                        @foreach($titles as $t)
                            <option value="{{ $t }}" {{ old('title', $customer->title) === $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Full Name -->
                <div class="sm:col-span-6 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Full Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name', $customer->name) }}" 
                        placeholder="e.g. Muhammad Hamza" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- CNIC (Required & Unique) -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1">
                        <span>CNIC *</span>
                        <span class="text-red-600">(Unique)</span>
                    </label>
                    <input 
                        type="text" 
                        name="cnic" 
                        required 
                        value="{{ old('cnic', $customer->cnic) }}" 
                        placeholder="35202-1234567-1" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-mono font-bold text-slate-900 border @error('cnic') border-red-500 bg-red-50/30 @else border-slate-200 @enderror rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Date of Birth -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Date of Birth</label>
                    <input 
                        type="date" 
                        name="dob" 
                        value="{{ old('dob', $customer->dob ? $customer->dob->format('Y-m-d') : '') }}" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Gender -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Gender</label>
                    <select 
                        name="gender" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        <option value="">Select Gender</option>
                        @foreach($genders as $g)
                            <option value="{{ $g }}" {{ old('gender', $customer->gender) === $g ? 'selected' : '' }}>{{ $g }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Passport -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Passport Number</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                            <i class="fa-solid fa-passport text-xs"></i>
                        </span>
                        <input 
                            type="text" 
                            name="passport" 
                            value="{{ old('passport', $customer->passport) }}" 
                            placeholder="e.g. PK8829104" 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-mono font-bold text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 uppercase transition-all"
                        >
                    </div>
                </div>

                <!-- Email -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                            <i class="fa-regular fa-envelope text-xs"></i>
                        </span>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email', $customer->email) }}" 
                            placeholder="traveler@example.com" 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                        >
                    </div>
                </div>

                <!-- Number -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Contact Number</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                            <i class="fa-solid fa-phone text-xs"></i>
                        </span>
                        <input 
                            type="text" 
                            name="number" 
                            value="{{ old('number', $customer->number) }}" 
                            placeholder="+92 300 1234567" 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-mono text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                        >
                    </div>
                </div>

                <!-- Status -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Status</label>
                    <select 
                        name="status" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        @foreach($statuses as $s)
                            <option value="{{ $s }}" {{ old('status', $customer->status) === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Address -->
                <div class="sm:col-span-12 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Address</label>
                    <textarea 
                        name="address" 
                        rows="3" 
                        placeholder="House #, Street, Phase / Sector, City" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">{{ old('address', $customer->address) }}</textarea>
                </div>

                <!-- Form Actions (Inside Main Card) -->
                <div class="sm:col-span-12 pt-5 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-xs text-slate-500">
                        Created on {{ $customer->created_at ? $customer->created_at->format('d M Y, h:i A') : 'N/A' }}
                    </span>

                    <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                        <a 
                            href="{{ route('customers.show', $customer->id) }}" 
                            class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                            Cancel
                        </a>
                        <button 
                            type="submit" 
                            class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold uppercase tracking-wider shadow-md shadow-red-600/30 transition-all flex items-center justify-center gap-2 transform active:scale-95">
                            <i class="fa-solid fa-check"></i>
                            <span>Save Changes</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </form>

</div>
@endsection
