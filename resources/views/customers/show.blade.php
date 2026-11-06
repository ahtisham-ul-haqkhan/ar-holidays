@extends('layouts.app')

@section('title', ($customer->name ?? 'Customer') . ' · AR Holidays')

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
                <a href="{{ route('customers.index') }}" class="hover:text-red-600 transition-colors">Customers</a>
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
                <span class="text-slate-800 font-semibold">{{ $customer->name ?? 'Customer' }}</span>
            </nav>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight font-heading flex items-center gap-2">
                <span>{{ $customer->title }} {{ $customer->name ?? 'Customer' }}</span>
                @if($customer->status === 'Active')
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
                href="{{ route('customers.index') }}" 
                class="px-3.5 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-2xs transition-colors flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Back</span>
            </a>
            <a 
                href="{{ route('customers.edit', $customer->id) }}" 
                class="px-4 py-1.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold tracking-wide uppercase flex items-center gap-1.5 shadow-md shadow-red-600/25 transition-all transform active:scale-95">
                <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                <span>Edit Profile</span>
            </a>
        </div>
    </div>

    <!-- Details Card -->
    <div class="bg-white rounded-3xl p-5 sm:p-7 border border-slate-200/80 shadow-xs space-y-5">
        <div class="pb-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <div class="flex items-center gap-2.5">
                    <h1 class="text-base sm:text-lg font-bold text-slate-900 font-heading uppercase tracking-wider">
                        Customer Profile Details
                    </h1>
                    @if($customer->status === 'Active')
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
                    {{ $customer->title }} {{ $customer->name ?? 'Customer' }} &middot; Registered: {{ $customer->created_at ? $customer->created_at->format('d M Y') : 'N/A' }}
                </p>
            </div>

            <!-- Just Edit Button -->
            <div class="flex items-center gap-2 shrink-0">
                <a 
                    href="{{ route('customers.edit', $customer->id) }}" 
                    class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold flex items-center gap-2 shadow-xs transition-colors">
                    <i class="fa-solid fa-user-pen text-xs"></i>
                    <span>Edit</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-xs">
            
            <!-- Title -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px]">Title</span>
                <p class="text-sm font-bold text-slate-900">{{ $customer->title ?: '—' }}</p>
            </div>

            <!-- Full Name -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px]">Full Name</span>
                <p class="text-sm font-bold text-slate-900">{{ $customer->name ?: '—' }}</p>
            </div>

            <!-- CNIC -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px] flex items-center justify-between">
                    <span>CNIC</span>
                    <span class="text-emerald-600 font-semibold text-[10px]">Unique</span>
                </span>
                <p class="text-sm font-mono font-bold text-slate-900">{{ $customer->cnic }}</p>
            </div>

            <!-- Date of Birth -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px]">Date of Birth</span>
                <p class="text-sm font-semibold text-slate-900">
                    {{ $customer->dob ? $customer->dob->format('d F Y') : '—' }}
                </p>
            </div>

            <!-- Gender -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px]">Gender</span>
                <p class="text-sm font-semibold text-slate-900">{{ $customer->gender ?: '—' }}</p>
            </div>

            <!-- Passport -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px]">Passport Number</span>
                <p class="text-sm font-mono font-bold text-slate-900">{{ $customer->passport ?: '—' }}</p>
            </div>

            <!-- Email -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px]">Email Address</span>
                <p class="text-sm font-medium text-slate-900">
                    @if($customer->email)
                        <a href="mailto:{{ $customer->email }}" class="text-red-600 hover:underline">
                            {{ $customer->email }}
                        </a>
                    @else
                        —
                    @endif
                </p>
            </div>

            <!-- Contact Number -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px]">Contact Number</span>
                <p class="text-sm font-mono font-medium text-slate-900">
                    @if($customer->number)
                        <a href="tel:{{ $customer->number }}" class="text-slate-900 hover:text-red-600">
                            {{ $customer->number }}
                        </a>
                    @else
                        —
                    @endif
                </p>
            </div>

            <!-- Status -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px]">Account Status</span>
                <p class="text-sm font-semibold text-slate-900">{{ $customer->status }}</p>
            </div>

            <!-- Address (Full width) -->
            <div class="sm:col-span-2 lg:col-span-3 p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px]">Address</span>
                <p class="text-sm text-slate-800 leading-relaxed">{{ $customer->address ?: '—' }}</p>
            </div>

        </div>
    </div>

</div>
@endsection
