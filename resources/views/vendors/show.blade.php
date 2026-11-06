@extends('layouts.app')

@section('title', $vendor->name . ' · Airline / Vendor · AR Holidays')

@section('content')
<div class="space-y-4 w-full pb-8">

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
                <span class="text-slate-800 font-semibold">{{ $vendor->name }}</span>
            </nav>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight font-heading flex items-center gap-2">
                <span>{{ $vendor->name }}</span>
                @if($vendor->status === 'Active')
                    <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                    </span>
                @else
                    <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600 border border-slate-200 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Inactive
                    </span>
                @endif
            </h1>
        </div>

        <div class="flex items-center gap-2 shrink-0 self-start sm:self-auto">
            <a 
                href="{{ route('vendors.index') }}" 
                class="px-3.5 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-2xs transition-colors flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Back</span>
            </a>
            <a 
                href="{{ route('vendors.edit', $vendor->id) }}" 
                class="px-4 py-1.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold tracking-wide uppercase flex items-center gap-1.5 shadow-md shadow-red-600/25 transition-all transform active:scale-95">
                <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                <span>Edit Airline</span>
            </a>
        </div>
    </div>

    <!-- Details Card -->
    <div class="bg-white rounded-3xl p-5 sm:p-7 border border-slate-200/80 shadow-xs space-y-5">
        <div class="pb-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <div class="flex items-center gap-2.5">
                    <h1 class="text-base sm:text-lg font-bold text-slate-900 font-heading uppercase tracking-wider">
                        Airline / Vendor Details
                    </h1>
                    @if($vendor->status === 'Active')
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                        </span>
                    @else
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Inactive
                        </span>
                    @endif
                </div>
                <p class="text-xs text-slate-400 mt-0.5">
                    {{ $vendor->name }} &middot; Registered: {{ $vendor->created_at ? $vendor->created_at->format('d M Y') : 'N/A' }}
                </p>
            </div>

            <!-- Just Edit Button -->
            <div class="flex items-center gap-2 shrink-0">
                <a 
                    href="{{ route('vendors.edit', $vendor->id) }}" 
                    class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold flex items-center gap-2 shadow-xs transition-colors">
                    <i class="fa-solid fa-user-pen text-xs"></i>
                    <span>Edit</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-xs">
            
            <!-- Airline Name -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1 sm:col-span-2">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px] flex items-center gap-1">
                    <i class="fa-solid fa-plane text-red-600 text-[10px]"></i>
                    Airline / Vendor Name
                </span>
                <p class="text-base font-extrabold text-slate-900 font-heading">{{ $vendor->name }}</p>
            </div>

            <!-- Operational Status -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px]">Operational Status</span>
                <p class="text-sm font-semibold text-slate-900">{{ $vendor->status }}</p>
            </div>

            <!-- Registered Date -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px]">Date Registered</span>
                <p class="text-sm font-semibold text-slate-900">
                    {{ $vendor->created_at ? $vendor->created_at->format('d F Y, h:i A') : '—' }}
                </p>
            </div>

            <!-- Last Updated -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px]">Last Updated</span>
                <p class="text-sm font-semibold text-slate-900">
                    {{ $vendor->updated_at ? $vendor->updated_at->format('d F Y, h:i A') : '—' }}
                </p>
            </div>

        </div>
    </div>

</div>
@endsection

