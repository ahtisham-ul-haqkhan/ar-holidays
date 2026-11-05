@extends('layouts.app')

@section('title', ($customer->name ?? 'Customer') . ' · AR Holidays')

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
        <span class="text-slate-800 font-semibold">{{ $customer->name ?? 'Customer #' . $customer->id }}</span>
    </nav>

    <!-- Top Profile Summary Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            
            <!-- Left Info -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-red-500 to-rose-700 text-white flex items-center justify-center font-bold text-2xl shadow-md shadow-red-500/20 shrink-0 uppercase">
                    {{ substr($customer->name ?? 'C', 0, 1) }}
                </div>

                <div class="space-y-1.5">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-heading flex items-center gap-2">
                            @if($customer->title)
                                <span class="text-lg text-slate-400 font-semibold">{{ $customer->title }}</span>
                            @endif
                            <span>{{ $customer->name ?? 'Unnamed Customer' }}</span>
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

                    <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                        <span class="font-mono font-bold text-slate-800 bg-slate-100 px-2 py-0.5 rounded">
                            CNIC: {{ $customer->cnic }}
                        </span>
                        @if($customer->passport)
                            <span class="flex items-center gap-1 font-mono font-semibold text-slate-700">
                                <i class="fa-solid fa-passport text-slate-400"></i>
                                Passport: {{ $customer->passport }}
                            </span>
                        @endif
                        <span class="text-slate-400">·</span>
                        <span class="text-slate-400">
                            Registered: {{ $customer->created_at ? $customer->created_at->format('d M Y') : 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2.5 shrink-0">
                <a 
                    href="{{ route('customers.index') }}" 
                    class="px-4 py-2.5 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold transition-all shadow-xs">
                    Back to List
                </a>
                <a 
                    href="{{ route('customers.edit', $customer->id) }}" 
                    class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold flex items-center gap-2 shadow-xs transition-colors">
                    <i class="fa-solid fa-user-pen text-xs"></i>
                    <span>Edit Profile</span>
                </a>
                <form 
                    action="{{ route('customers.destroy', $customer->id) }}" 
                    method="POST" 
                    onsubmit="return confirm('Are you sure you want to delete this customer?');" 
                    class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="px-4 py-2.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-bold flex items-center gap-1.5 transition-colors"
                        title="Delete customer">
                        <i class="fa-regular fa-trash-can text-xs"></i>
                        <span>Delete</span>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Details Card (Strictly Matching Migration Columns) -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
        <div class="pb-4 border-b border-slate-100">
            <h2 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">Customer Profile Details</h2>
            <p class="text-xs text-slate-400">All registered attributes for this customer profile.</p>
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
