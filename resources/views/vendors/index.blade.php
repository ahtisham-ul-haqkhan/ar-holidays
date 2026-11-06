@extends('layouts.app')

@section('title', 'Vendors & Airlines Directory · AR Holidays')

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
                <span class="text-slate-800 font-semibold">Vendors / Airlines</span>
            </nav>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight font-heading flex items-center gap-2">
                <span>Airlines & Vendors</span>
                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-red-50 text-red-600 border border-red-200">
                    {{ $vendors->total() }} Airlines
                </span>
            </h1>
        </div>

        <div class="flex items-center gap-2 shrink-0 self-start sm:self-auto">
            <a 
                href="{{ route('vendors.create') }}" 
                class="px-4 py-2 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold tracking-wide uppercase flex items-center gap-2 shadow-md shadow-red-600/25 hover:shadow-lg transition-all transform active:scale-95">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Add Airline / Vendor</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards (Compact Height) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div class="bg-white rounded-xl px-4 py-3 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center text-sm shrink-0">
                    <i class="fa-solid fa-plane-departure text-red-600"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Total Airlines</p>
                    <h3 class="text-lg font-extrabold text-slate-900 font-heading leading-tight">{{ $stats['total'] }}</h3>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 font-medium">All Carriers</span>
        </div>

        <div class="bg-white rounded-xl px-4 py-3 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm shrink-0">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Active Airlines</p>
                    <h3 class="text-lg font-extrabold text-emerald-600 font-heading leading-tight">{{ $stats['active'] }}</h3>
                </div>
            </div>
            <span class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
            </span>
        </div>

        <div class="bg-white rounded-xl px-4 py-3 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center text-sm shrink-0">
                    <i class="fa-solid fa-ban"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Inactive Airlines</p>
                    <h3 class="text-lg font-extrabold text-slate-500 font-heading leading-tight">{{ $stats['inactive'] }}</h3>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 font-semibold flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Inactive
            </span>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs">
        <form method="GET" action="{{ route('vendors.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            
            <!-- Search Input -->
            <div class="sm:col-span-7 relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </span>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $searchTerm }}" 
                    placeholder="Search by airline name (e.g. PIA, Airblue, Emirates)..." 
                    class="w-full pl-9 pr-4 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                >
            </div>

            <!-- Status Dropdown -->
            <div class="sm:col-span-3">
                <select 
                    name="status" 
                    onchange="this.form.submit()" 
                    class="w-full px-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    <option value="All" {{ $selectedStatus === 'All' ? 'selected' : '' }}>All Statuses</option>
                    <option value="Active" {{ $selectedStatus === 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ $selectedStatus === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="sm:col-span-2 flex items-center gap-2">
                <button 
                    type="submit" 
                    class="flex-1 py-2.5 px-4 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition-colors">
                    Search
                </button>
                @if($searchTerm || $selectedStatus !== 'All')
                    <a 
                        href="{{ route('vendors.index') }}" 
                        class="py-2.5 px-3 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-medium rounded-xl transition-colors"
                        title="Clear Filters">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>

        </form>
    </div>

    <!-- Vendors Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-600 font-bold uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-5">#</th>
                        <th class="py-3.5 px-5">Airline / Vendor Name</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Added On</th>
                        <th class="py-3.5 px-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($vendors as $vendor)
                        <tr class="hover:bg-slate-50/70 transition-colors group">
                            
                            <!-- Serial No -->
                            <td class="py-4 px-5 text-slate-400 font-mono text-[11px]">
                                #{{ $loop->iteration }}
                            </td>

                            <!-- Airline / Vendor Name -->
                            <td class="py-4 px-5">
                                <a href="{{ route('vendors.show', $vendor->id) }}" class="font-bold text-slate-900 text-sm hover:text-red-600 transition-colors flex items-center gap-2.5">
                                    <span class="w-7 h-7 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-xs">
                                        <i class="fa-solid fa-plane"></i>
                                    </span>
                                    <span>{{ $vendor->name }}</span>
                                </a>
                            </td>

                            <!-- Status -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                @if($vendor->status === 'Active')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Inactive
                                    </span>
                                @endif
                            </td>

                            <!-- Date Added -->
                            <td class="py-4 px-4 text-slate-500 whitespace-nowrap">
                                {{ $vendor->created_at ? $vendor->created_at->format('d M Y') : '—' }}
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-5 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <a 
                                        href="{{ route('vendors.show', $vendor->id) }}" 
                                        class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 flex items-center justify-center transition-colors shadow-xs" 
                                        title="View Vendor Details">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    <a 
                                        href="{{ route('vendors.edit', $vendor->id) }}" 
                                        class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 flex items-center justify-center transition-colors shadow-xs" 
                                        title="Edit Vendor">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>
                                    <form 
                                        action="{{ route('vendors.destroy', $vendor->id) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Are you sure you want to delete this vendor?');" 
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-rose-50 text-slate-400 hover:text-rose-600 flex items-center justify-center transition-colors shadow-xs" 
                                            title="Delete Vendor">
                                            <i class="fa-regular fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-xl mb-3">
                                    <i class="fa-solid fa-plane-slash"></i>
                                </div>
                                <p class="text-sm font-semibold text-slate-700">No airlines / vendors found</p>
                                <p class="text-xs text-slate-400 mt-1">Try adjusting your search query or add a new airline.</p>
                                <a href="{{ route('vendors.create') }}" class="mt-4 inline-block px-4 py-2 bg-red-600 text-white font-bold text-xs rounded-xl shadow-xs hover:bg-red-700 transition-colors">
                                    + Add Airline / Vendor
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($vendors->hasPages())
            <div class="px-6 py-4 bg-slate-50/70 border-t border-slate-100">
                {{ $vendors->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
