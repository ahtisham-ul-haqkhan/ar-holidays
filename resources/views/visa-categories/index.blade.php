@extends('layouts.app')

@section('title', 'Visa Categories · AR Holidays')

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
                <span class="text-slate-800 font-semibold">Visa Categories</span>
            </nav>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight font-heading flex items-center gap-2">
                <span>Visa Categories</span>
                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-red-50 text-red-600 border border-red-200">
                    {{ $categories->total() }} Categories
                </span>
            </h1>
        </div>

        <div class="flex items-center gap-2 shrink-0 self-start sm:self-auto">
            <a 
                href="{{ route('visa-categories.create') }}" 
                class="px-4 py-2 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold tracking-wide uppercase flex items-center gap-2 shadow-md shadow-red-600/25 hover:shadow-lg transition-all transform active:scale-95">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Add Visa Category</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div class="bg-white rounded-xl px-4 py-3 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center text-sm shrink-0">
                    <i class="fa-solid fa-passport text-red-600"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Total Categories</p>
                    <h3 class="text-lg font-extrabold text-slate-900 font-heading leading-tight">{{ $stats['total'] }}</h3>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 font-medium">All Types</span>
        </div>

        <div class="bg-white rounded-xl px-4 py-3 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm shrink-0">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Active Categories</p>
                    <h3 class="text-lg font-extrabold text-emerald-600 font-heading leading-tight">{{ $stats['active'] }}</h3>
                </div>
            </div>
            <span class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Operational
            </span>
        </div>

        <div class="bg-white rounded-xl px-4 py-3 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center text-sm shrink-0">
                    <i class="fa-solid fa-ban"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Inactive</p>
                    <h3 class="text-lg font-extrabold text-slate-500 font-heading leading-tight">{{ $stats['inactive'] }}</h3>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 font-semibold flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Suspended
            </span>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white rounded-2xl p-3 sm:p-4 border border-slate-200/80 shadow-xs">
        <form method="GET" action="{{ route('visa-categories.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            
            <!-- Search Input -->
            <div class="sm:col-span-8 relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </span>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $searchTerm }}" 
                    placeholder="Search by category name (e.g. Tourist, Umrah, Work)..." 
                    class="w-full pl-9 pr-4 py-2 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                >
            </div>

            <!-- Status Dropdown -->
            <div class="sm:col-span-3">
                <select 
                    name="status" 
                    onchange="this.form.submit()" 
                    class="w-full px-3 py-2 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    <option value="All" {{ $selectedStatus === 'All' ? 'selected' : '' }}>All Statuses</option>
                    <option value="Active" {{ $selectedStatus === 'Active' ? 'selected' : '' }}>Active Only</option>
                    <option value="Inactive" {{ $selectedStatus === 'Inactive' ? 'selected' : '' }}>Inactive Only</option>
                </select>
            </div>

            <!-- Clear / Filter Button -->
            <div class="sm:col-span-1 flex items-center gap-2">
                @if(!empty($searchTerm) || $selectedStatus !== 'All')
                    <a 
                        href="{{ route('visa-categories.index') }}" 
                        title="Clear filters"
                        class="w-full h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center text-xs transition-colors">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @else
                    <button 
                        type="submit" 
                        class="w-full h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold flex items-center justify-center text-xs transition-colors">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                @endif
            </div>

        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/50 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3 px-5 w-16">#</th>
                        <th class="py-3 px-5">Visa Category Name</th>
                        <th class="py-3 px-5 w-40 text-center">Status</th>
                        <th class="py-3 px-5 w-36 text-center">Created Date</th>
                        <th class="py-3 px-5 w-28 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($categories as $category)
                        <tr class="hover:bg-slate-50/70 transition-colors group">
                            
                            <!-- Sequential Number -->
                            <td class="py-3.5 px-5 font-mono text-slate-400 font-semibold text-xs">
                                #{{ $loop->iteration + ($categories->firstItem() - 1) }}
                            </td>

                            <!-- Category Name -->
                            <td class="py-3.5 px-5 font-semibold text-slate-900">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-7 h-7 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-xs shrink-0 font-bold">
                                        <i class="fa-solid fa-passport"></i>
                                    </span>
                                    <a href="{{ route('visa-categories.show', $category->id) }}" class="hover:text-red-600 transition-colors">
                                        {{ $category->name }}
                                    </a>
                                </div>
                            </td>

                            <!-- Status Badge -->
                            <td class="py-3.5 px-5 text-center">
                                @if($category->status === 'Active')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Inactive
                                    </span>
                                @endif
                            </td>

                            <!-- Created Date -->
                            <td class="py-3.5 px-5 text-center font-mono text-slate-500 text-[11px]">
                                {{ $category->created_at ? $category->created_at->format('d M Y') : 'N/A' }}
                            </td>

                            <!-- Action Buttons -->
                            <td class="py-3.5 px-5 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a 
                                        href="{{ route('visa-categories.show', $category->id) }}" 
                                        title="View Details"
                                        class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 flex items-center justify-center transition-colors">
                                        <i class="fa-regular fa-eye text-[11px]"></i>
                                    </a>
                                    <a 
                                        href="{{ route('visa-categories.edit', $category->id) }}" 
                                        title="Edit Category"
                                        class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 flex items-center justify-center transition-colors">
                                        <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                                    </a>
                                    <form 
                                        method="POST" 
                                        action="{{ route('visa-categories.destroy', $category->id) }}" 
                                        onsubmit="return confirm('Are you sure you want to delete this visa category?')" 
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            title="Delete Category"
                                            class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 flex items-center justify-center transition-colors">
                                            <i class="fa-regular fa-trash-can text-[11px]"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-2 text-slate-400 text-lg">
                                    <i class="fa-solid fa-passport"></i>
                                </div>
                                <p class="text-xs font-semibold text-slate-700">No visa categories found</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Try adjusting your search criteria or register a new visa category.</p>
                                <a 
                                    href="{{ route('visa-categories.create') }}" 
                                    class="mt-3 inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-xs font-bold transition-all shadow-xs">
                                    <i class="fa-solid fa-plus text-[10px]"></i>
                                    <span>Add Category</span>
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
            <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <span class="text-xs text-slate-500">
                    Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} records
                </span>
                <div>
                    {{ $categories->links() }}
                </div>
            </div>
        @endif

    </div>

</div>
@endsection

