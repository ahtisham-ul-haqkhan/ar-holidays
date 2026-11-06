@extends('layouts.app')

@section('title', $category->name . ' · Visa Category · AR Holidays')

@section('content')
<div class="space-y-4 w-full max-w-4xl pb-8">

    <!-- Top Action & Breadcrumb Bar (Compact) -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 pb-2.5 border-b border-slate-200/80">
        <div>
            <nav class="flex items-center gap-1.5 text-[11px] text-slate-400 font-medium mb-1">
                <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition-colors flex items-center gap-1">
                    <i class="fa-solid fa-house text-[9px]"></i>
                    <span>Dashboard</span>
                </a>
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
                <a href="{{ route('visa-categories.index') }}" class="hover:text-red-600 transition-colors">Visa Categories</a>
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
                <span class="text-slate-800 font-semibold">{{ $category->name }}</span>
            </nav>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight font-heading flex items-center gap-2">
                <span>{{ $category->name }}</span>
                @if($category->status === 'Active')
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
                href="{{ route('visa-categories.index') }}" 
                class="px-3.5 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-2xs transition-colors flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Back</span>
            </a>
            <a 
                href="{{ route('visa-categories.edit', $category->id) }}" 
                class="px-4 py-1.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold tracking-wide uppercase flex items-center gap-1.5 shadow-md shadow-red-600/25 transition-all transform active:scale-95">
                <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                <span>Edit Category</span>
            </a>
        </div>
    </div>

    <!-- Details Card -->
    <div class="bg-white rounded-3xl p-5 sm:p-7 border border-slate-200/80 shadow-xs space-y-5">
        
        <div class="pb-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-xs font-bold text-slate-900 font-heading uppercase tracking-wider">Category Overview</h2>
            <span class="text-xs text-slate-400 font-mono">
                Created: {{ $category->created_at ? $category->created_at->format('d M Y, h:i A') : 'N/A' }}
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Category Name</p>
                <p class="text-base font-extrabold text-slate-900 mt-1 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-xs font-bold">
                        <i class="fa-solid fa-passport"></i>
                    </span>
                    <span>{{ $category->name }}</span>
                </p>
            </div>

            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Status</p>
                <div class="mt-1.5">
                    @if($category->status === 'Active')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Active & Operational
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                            <span class="w-2 h-2 rounded-full bg-slate-400"></span> Inactive / Archived
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
            <span>Last Updated: {{ $category->updated_at ? $category->updated_at->diffForHumans() : 'N/A' }}</span>
            <form 
                method="POST" 
                action="{{ route('visa-categories.destroy', $category->id) }}" 
                onsubmit="return confirm('Are you sure you want to delete this visa category?')" 
                class="inline">
                @csrf
                @method('DELETE')
                <button 
                    type="submit" 
                    class="text-rose-600 hover:text-rose-800 font-semibold flex items-center gap-1.5 transition-colors">
                    <i class="fa-regular fa-trash-can"></i>
                    <span>Delete Category</span>
                </button>
            </form>
        </div>

    </div>

</div>
@endsection

