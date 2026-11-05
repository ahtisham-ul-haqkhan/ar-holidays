@extends('layouts.app')

@section('title', 'Add New Airline / Vendor · AR Holidays')

@section('content')
<div class="space-y-6 w-full">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-slate-500 font-medium">
        <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition-colors flex items-center gap-1">
            <i class="fa-solid fa-house text-[10px]"></i>
            <span>Dashboard</span>
        </a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <a href="{{ route('vendors.index') }}" class="hover:text-red-600 transition-colors">Vendors</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <span class="text-slate-800 font-semibold">New Airline / Vendor</span>
    </nav>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-heading">
                Register New Airline / Vendor
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Add partner airline carriers such as PIA, Airblue, AirSial, Emirates, or FlyDubai.
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a 
                href="{{ route('vendors.index') }}" 
                class="px-4 py-2.5 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold transition-all shadow-xs">
                Cancel
            </a>
            <button 
                type="submit" 
                form="create-vendor-form" 
                class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold tracking-wide uppercase shadow-md shadow-red-600/25 hover:shadow-lg transition-all flex items-center gap-2">
                <i class="fa-solid fa-check text-xs"></i>
                <span>Save Vendor</span>
            </button>
        </div>
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
    <form id="create-vendor-form" method="POST" action="{{ route('vendors.store') }}" class="space-y-6">
        @csrf

        <!-- Card: Airline / Vendor Details -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="pb-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">Airline / Vendor Information</h2>
                    <p class="text-xs text-slate-400">Specify airline carrier name and operational status.</p>
                </div>
                <span class="text-[11px] font-semibold text-rose-600 bg-rose-50 px-2.5 py-1 rounded-full border border-rose-200">
                    * Name is required & unique
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                
                <!-- Airline Name -->
                <div class="sm:col-span-8 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1">
                        <span>Airline / Vendor Name *</span>
                        <span class="text-red-600">(Unique)</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                            <i class="fa-solid fa-plane text-xs"></i>
                        </span>
                        <input 
                            type="text" 
                            name="name" 
                            required 
                            value="{{ old('name') }}" 
                            placeholder="e.g. PIA, Airblue, AirSial, Emirates, Qatar Airways" 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border @error('name') border-red-500 bg-red-50/30 @else border-slate-200 @enderror rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                        >
                    </div>
                </div>

                <!-- Status -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Operational Status</label>
                    <select 
                        name="status" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        @foreach($statuses as $s)
                            <option value="{{ $s }}" {{ old('status', 'Active') === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>

        <!-- Form Action Bar -->
        <div class="p-6 bg-white rounded-3xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
            <span class="text-xs text-slate-500">
                Airline / Vendor record will be stored in SQLite database.
            </span>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a 
                    href="{{ route('vendors.index') }}" 
                    class="flex-1 sm:flex-none px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold text-center transition-colors">
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="flex-1 sm:flex-none px-6 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold uppercase tracking-wider shadow-md shadow-red-600/30 transition-all flex items-center justify-center gap-2 transform active:scale-95">
                    <i class="fa-solid fa-check"></i>
                    <span>Save Airline / Vendor</span>
                </button>
            </div>
        </div>

    </form>

</div>
@endsection
