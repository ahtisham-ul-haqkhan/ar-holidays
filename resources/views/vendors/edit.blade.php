@extends('layouts.app')

@section('title', 'Edit ' . $vendor->name . ' · AR Holidays')

@section('content')
<div class="space-y-4 w-full pb-10">

    <!-- Top Action & Breadcrumb Bar (Compact) -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 pb-2.5 border-b border-slate-200/80">
        <div>
            <nav class="flex items-center gap-1.5 text-[11px] text-slate-400 font-medium mb-1">
                <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition-colors flex items-center gap-1">
                    <i class="fa-solid fa-house text-[9px]"></i>
                    <span>Dashboard</span>
                </a>
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
                <a href="{{ route('vendors.index') }}" class="hover:text-red-600 transition-colors">Vendors</a>
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
                <a href="{{ route('vendors.show', $vendor->id) }}" class="hover:text-red-600 transition-colors">{{ $vendor->name }}</a>
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
                <span class="text-slate-800 font-semibold">Edit</span>
            </nav>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight font-heading flex items-center gap-2">
                <span>Edit Airline: {{ $vendor->name }}</span>
            </h1>
        </div>

        <a 
            href="{{ route('vendors.index') }}" 
            class="px-3.5 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-2xs transition-colors flex items-center gap-1.5 self-start sm:self-auto">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>All Vendors</span>
        </a>
    </div>

    <!-- Error Summary (if any) -->
    @if ($errors->any())
        <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
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
    <form id="edit-vendor-form" method="POST" action="{{ route('vendors.update', $vendor->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Card: Airline / Vendor Details -->
        <div class="bg-white rounded-3xl p-5 sm:p-7 border border-slate-200/80 shadow-xs space-y-5">
            <div class="pb-3 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-xs font-bold text-slate-900 font-heading uppercase tracking-wider">Airline / Vendor Information</h2>
                <span class="text-[10px] font-semibold text-rose-600 bg-rose-50 px-2.5 py-0.5 rounded-full border border-rose-200">
                    * Name is required & unique
                </span>
            </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">Airline / Vendor Information</h2>
                    <p class="text-xs text-slate-400">Update airline carrier credentials and status.</p>
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
                            value="{{ old('name', $vendor->name) }}" 
                            placeholder="e.g. PIA, Airblue, AirSial, Emirates" 
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
                            <option value="{{ $s }}" {{ old('status', $vendor->status) === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Form Actions (Inside Main Card) -->
                <div class="sm:col-span-12 pt-5 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-xs text-slate-500">
                        Created on {{ $vendor->created_at ? $vendor->created_at->format('d M Y, h:i A') : 'N/A' }}
                    </span>

                    <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                        <a 
                            href="{{ route('vendors.show', $vendor->id) }}" 
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

