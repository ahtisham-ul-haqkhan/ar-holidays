@extends('layouts.app')

@section('title', 'Aviation & Travel Operations Dashboard · AR Holidays')

@section('content')
<div class="space-y-8 w-full">

    <!-- Top Hero Banner (AR Holidays Themed) -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-slate-900 to-red-950 text-white p-6 sm:p-8 lg:p-10 shadow-xl border border-slate-800">
        
        <!-- Background Vector Airplane Silhouette & Gradients -->
        <div class="absolute -right-10 -bottom-10 w-96 h-96 opacity-10 pointer-events-none transform -rotate-12">
            <img src="{{ asset('images/ar-holidays-icon.svg') }}" alt="Watermark" class="w-full h-full object-contain brightness-0 invert">
        </div>
        <div class="absolute top-0 right-1/4 w-72 h-72 bg-red-600/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-3 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-500/20 border border-red-500/30 text-red-300 text-xs font-semibold">
                    <i class="fa-solid fa-plane-departure text-[11px]"></i>
                    <span>AR HOLIDAYS · TRAVEL & AVIATION ERP</span>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight font-heading">
                    Welcome Back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-red-400">{{ auth()->user()->name ?? 'Rehman Admin' }}</span> 👋
                </h1>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-light">
                    Surf Your Dream With Us. Real-time overview of <strong class="text-white font-semibold">airline ticket sales</strong>, <strong class="text-amber-400 font-semibold">vendor payables</strong>, and <strong class="text-emerald-400 font-semibold">visa desk approvals</strong>.
                </p>
                <div class="pt-2 flex flex-wrap items-center gap-3 text-xs text-slate-300">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-circle-check text-emerald-400"></i> Amadeus & Sabre GDS Connected</span>
                    <span class="text-slate-600">|</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-building-columns text-amber-400"></i> 11 Airline Vendor Accounts</span>
                    <span class="text-slate-600">|</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-clock text-slate-400"></i> {{ now()->format('d M Y, h:i A') }}</span>
                </div>
            </div>

            <!-- Quick Action Buttons -->
            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <a 
                    href="{{ route('customers.create') }}" 
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-500 hover:to-rose-600 text-white font-semibold text-sm shadow-lg shadow-red-600/30 transition-all transform active:scale-95">
                    <i class="fa-solid fa-user-plus text-xs"></i>
                    <span>New Customer</span>
                </a>
                <a 
                    href="{{ route('vendors.index') }}" 
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-800/80 hover:bg-slate-700 border border-slate-700 text-white font-medium text-sm transition-all">
                    <i class="fa-solid fa-plane-departure text-xs text-red-400"></i>
                    <span>Vendor Airlines</span>
                </a>
                <a 
                    href="#vendor-payables" 
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-medium text-sm backdrop-blur-sm border border-white/10 transition-all">
                    <i class="fa-solid fa-receipt text-xs"></i>
                    <span>Vendor Payables</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 4 Core Business KPIs -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach($kpis as $kpi)
            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ $kpi['title'] }}</span>
                    <span class="w-10 h-10 rounded-xl {{ $kpi['bg_light'] }} flex items-center justify-center transition-transform group-hover:scale-110">
                        <i class="fa-solid fa-{{ $kpi['icon'] }} text-base"></i>
                    </span>
                </div>
                
                <div class="mt-4">
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-heading">{{ $kpi['value'] }}</h3>
                    <p class="text-xs font-medium text-slate-500 mt-0.5">{{ $kpi['sub_value'] }}</p>
                    <div class="mt-3 flex items-center gap-2">
                        @if($kpi['trend'] === 'warning')
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full border border-amber-200">
                                <i class="fa-solid fa-clock text-[9px]"></i>
                                {{ $kpi['change'] }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200/60">
                                <i class="fa-solid fa-arrow-trend-up text-[9px]"></i>
                                {{ $kpi['change'] }}
                            </span>
                        @endif
                        <span class="text-xs text-slate-400">{{ $kpi['period'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Monthly Ticket Sales Graph (ApexCharts) -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-red-600 animate-pulse"></span>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 font-heading">
                        Monthly Ticket Sales & Revenue Trend
                    </h2>
                </div>
                <p class="text-xs text-slate-500 mt-1">
                    Month-by-month flight ticket booking volume and revenue generated across domestic and international routes.
                </p>
            </div>

            <!-- Quick Chart Indicators -->
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200/80 text-xs">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-600"></span>
                    <span class="font-bold text-slate-700">Tickets Sold</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200/80 text-xs">
                    <span class="w-2.5 h-2.5 rounded-full bg-slate-800"></span>
                    <span class="font-bold text-slate-700">Revenue (PKR M)</span>
                </div>
            </div>
        </div>

        <!-- ApexChart Container -->
        <div class="w-full">
            <div id="ticket-sales-chart" class="w-full h-80"></div>
        </div>

        <!-- Quick Graph Summary Bar -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 border-t border-slate-100 text-xs">
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/60">
                <p class="text-slate-400 font-medium">Peak Sales Month</p>
                <p class="text-base font-extrabold text-slate-900 mt-0.5">December (1,485 Tickets)</p>
            </div>
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/60">
                <p class="text-slate-400 font-medium">Total Annual Volume</p>
                <p class="text-base font-extrabold text-red-600 mt-0.5">9,050 Tickets</p>
            </div>
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/60">
                <p class="text-slate-400 font-medium">Annual Gross Billing</p>
                <p class="text-base font-extrabold text-slate-900 mt-0.5">PKR 364.5 Million</p>
            </div>
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/60">
                <p class="text-slate-400 font-medium">Monthly Average</p>
                <p class="text-base font-extrabold text-emerald-600 mt-0.5">754 Tickets / Month</p>
            </div>
        </div>

    </div>

    <!-- Main Section: Vendor Payables & Visa Sales Reports -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Side: Airline Vendor Payables Ledger (8 Columns) -->
        <div id="vendor-payables" class="lg:col-span-8 space-y-8">
            
            <!-- Vendor Payables Table -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-bold">
                                <i class="fa-solid fa-building-columns"></i>
                            </span>
                            <div>
                                <h2 class="text-base font-bold text-slate-900 font-heading">
                                    Airline Vendors & Payables Ledger
                                </h2>
                                <p class="text-xs text-slate-500">
                                    Total amount due to partner airline carriers (Kitnay paise vendor ko dene hain).
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                            Total Due: PKR 24.6M
                        </span>
                        <a href="{{ route('vendors.index') }}" class="text-xs font-bold text-red-600 hover:text-red-700 flex items-center gap-1">
                            Vendors Directory <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <!-- Payables Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-600 font-bold uppercase tracking-wider border-b border-slate-200">
                            <tr>
                                <th class="py-3.5 px-6">Airline / Carrier</th>
                                <th class="py-3.5 px-4 text-center">Tickets</th>
                                <th class="py-3.5 px-4">Gross Billed</th>
                                <th class="py-3.5 px-4">Amount Paid</th>
                                <th class="py-3.5 px-4 font-black text-red-600">Payable Due</th>
                                <th class="py-3.5 px-4">Settlement Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                            @foreach($vendorPayables as $vp)
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-2.5">
                                            <span class="w-8 h-8 rounded-lg {{ $vp['logo_badge'] }} flex items-center justify-center font-bold text-xs shrink-0 shadow-2xs">
                                                {{ $vp['code'] }}
                                            </span>
                                            <div>
                                                <p class="font-bold text-slate-900 text-xs">{{ $vp['vendor'] }}</p>
                                                <p class="text-[10px] text-slate-400">Due: {{ $vp['due_date'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-center font-mono font-bold text-slate-800">
                                        {{ $vp['tickets_issued'] }}
                                    </td>
                                    <td class="py-4 px-4 text-slate-600">
                                        {{ $vp['gross_amount'] }}
                                    </td>
                                    <td class="py-4 px-4 text-emerald-700 font-medium">
                                        {{ $vp['paid_amount'] }}
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="font-extrabold text-slate-900 text-xs {{ $vp['payable_due'] === 'PKR 0' ? 'text-emerald-600 font-bold' : 'text-red-600' }}">
                                            {{ $vp['payable_due'] }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $vp['status_color'] }}">
                                            {{ $vp['status'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4 bg-slate-50/60 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>BSP & Airline GDS direct settlement billing cycles</span>
                    <span class="font-bold text-slate-700">Next Clearance: 15 Nov 2026</span>
                </div>
            </div>

            <!-- Recent Issued Flight Tickets Table -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 font-heading">Recent Flight Tickets Issued</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Live issued PNR tickets synced with Sabre & Amadeus.</p>
                    </div>
                    <a href="{{ route('customers.index') }}" class="text-xs font-bold text-red-600 hover:text-red-700 flex items-center gap-1">
                        View All Tickets <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-600 font-bold uppercase tracking-wider border-b border-slate-200">
                            <tr>
                                <th class="py-3.5 px-6">Traveler</th>
                                <th class="py-3.5 px-4">Carrier & Route</th>
                                <th class="py-3.5 px-4">Date</th>
                                <th class="py-3.5 px-4">Fare Amount</th>
                                <th class="py-3.5 px-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                            @foreach($recentBookings as $bkg)
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $bkg['avatar'] }}" alt="{{ $bkg['customer'] }}" class="w-8 h-8 rounded-xl object-cover ring-1 ring-slate-200 shrink-0">
                                            <div>
                                                <p class="font-bold text-slate-900 text-xs">{{ $bkg['customer'] }}</p>
                                                <p class="text-[10px] text-slate-400 font-mono">PNR: {{ $bkg['pnr'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div>
                                            <p class="font-semibold text-slate-800">{{ $bkg['destination'] }}</p>
                                            <p class="text-[10px] text-slate-400">{{ $bkg['flight'] }}</p>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-slate-600 whitespace-nowrap">
                                        {{ $bkg['date'] }}
                                    </td>
                                    <td class="py-4 px-4 font-bold text-slate-900">
                                        {{ $bkg['amount'] }}
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $bkg['badge'] }}">
                                            {{ $bkg['status'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Right Side: Visa Sales & Category Performance Report (4 Columns) -->
        <div class="lg:col-span-4 space-y-8">
            
            <!-- Visa Sales Report Card -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-5">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold">
                                <i class="fa-solid fa-passport"></i>
                            </span>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider font-heading">
                                    Visa Sales Report
                                </h3>
                                <p class="text-[10px] text-slate-400">Total Visas Processed & Sold</p>
                            </div>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-xl">
                        842 Visas
                    </span>
                </div>

                <!-- Visa Breakdown List -->
                <div class="space-y-3.5">
                    @foreach($visaSalesReport as $visa)
                        <div class="p-3.5 rounded-2xl border border-slate-200/80 bg-slate-50/50 hover:bg-white hover:border-red-200 hover:shadow-xs transition-all space-y-2">
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg {{ $visa['color'] }} flex items-center justify-center text-xs shrink-0 shadow-2xs">
                                        <i class="fa-solid fa-{{ $visa['icon'] }}"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-slate-900 leading-tight">
                                            {{ $visa['category'] }}
                                        </h4>
                                        <p class="text-[10px] text-slate-400">{{ $visa['destination'] }}</p>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded-md bg-white border border-slate-200 text-xs font-extrabold text-slate-900 shrink-0">
                                    {{ $visa['visas_sold'] }} Sold
                                </span>
                            </div>

                            <div class="grid grid-cols-3 gap-2 pt-2 border-t border-slate-200/60 text-[10px]">
                                <div>
                                    <span class="text-slate-400">Revenue</span>
                                    <p class="font-bold text-slate-800">{{ $visa['total_revenue'] }}</p>
                                </div>
                                <div>
                                    <span class="text-slate-400">Approval</span>
                                    <p class="font-bold text-emerald-600">{{ $visa['approval_rate'] }}</p>
                                </div>
                                <div>
                                    <span class="text-slate-400">Avg Time</span>
                                    <p class="font-bold text-slate-800">{{ $visa['avg_processing'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-slate-500 font-medium">Total Visa Revenue:</span>
                    <span class="font-extrabold text-slate-900">PKR 52.4 Million</span>
                </div>
            </div>

            <!-- Airline Ticket Market Share Widget -->
            <div class="bg-gradient-to-br from-slate-950 via-slate-900 to-black rounded-3xl p-6 text-white shadow-xl border border-slate-800 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-chart-pie text-red-500 text-sm"></i>
                        <h4 class="text-xs font-bold uppercase tracking-wider font-heading">
                            Airline Share Breakdown
                        </h4>
                    </div>
                    <span class="text-[10px] font-semibold text-slate-400">3,485 Tickets</span>
                </div>

                <div class="space-y-3 text-xs">
                    <div>
                        <div class="flex justify-between text-slate-300 mb-1">
                            <span>PIA (National Carrier)</span>
                            <span class="font-bold text-white">842 (24%)</span>
                        </div>
                        <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-emerald-500 h-full rounded-full" style="width: 24%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-slate-300 mb-1">
                            <span>Airblue (Domestic & Gulf)</span>
                            <span class="font-bold text-white">615 (18%)</span>
                        </div>
                        <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-blue-500 h-full rounded-full" style="width: 18%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-slate-300 mb-1">
                            <span>Emirates (International)</span>
                            <span class="font-bold text-white">590 (17%)</span>
                        </div>
                        <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-red-500 h-full rounded-full" style="width: 17%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-slate-300 mb-1">
                            <span>Saudia (Umrah & Riyadh)</span>
                            <span class="font-bold text-white">520 (15%)</span>
                        </div>
                        <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-amber-500 h-full rounded-full" style="width: 15%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-slate-300 mb-1">
                            <span>AirSial & Other Airlines</span>
                            <span class="font-bold text-white">918 (26%)</span>
                        </div>
                        <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-purple-500 h-full rounded-full" style="width: 26%"></div>
                        </div>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-800 flex items-center justify-between text-[11px] text-slate-400">
                    <span>GDS Auto-Ticketing Desk</span>
                    <span class="text-emerald-400 font-semibold flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Live Synced
                    </span>
                </div>
            </div>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const months = @json($monthlyChart['months']);
        const tickets = @json($monthlyChart['tickets']);
        const revenue = @json($monthlyChart['revenue_millions']);

        const options = {
            series: [
                {
                    name: 'Tickets Sold',
                    type: 'area',
                    data: tickets
                },
                {
                    name: 'Revenue (PKR M)',
                    type: 'line',
                    data: revenue
                }
            ],
            chart: {
                height: 320,
                type: 'line',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                fontFamily: 'Plus Jakarta Sans, sans-serif'
            },
            colors: ['#e5202e', '#0f172a'],
            stroke: {
                width: [2, 3],
                curve: 'smooth'
            },
            fill: {
                type: ['gradient', 'solid'],
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    shadeIntensity: 0.5,
                    gradientToColors: ['#fee2e2'],
                    inverseColors: false,
                    opacityFrom: 0.5,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            markers: {
                size: [4, 5],
                colors: ['#e5202e', '#0f172a'],
                strokeColors: '#ffffff',
                strokeWidth: 2,
                hover: {
                    size: 7
                }
            },
            xaxis: {
                categories: months,
                labels: {
                    style: {
                        colors: '#64748b',
                        fontSize: '11px',
                        fontWeight: 600
                    }
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: [
                {
                    title: {
                        text: 'Tickets Sold',
                        style: {
                            color: '#e5202e',
                            fontSize: '11px',
                            fontWeight: 700
                        }
                    },
                    labels: {
                        style: {
                            colors: '#64748b',
                            fontSize: '11px'
                        },
                        formatter: function (val) {
                            return Math.round(val);
                        }
                    }
                },
                {
                    opposite: true,
                    title: {
                        text: 'Revenue (PKR M)',
                        style: {
                            color: '#0f172a',
                            fontSize: '11px',
                            fontWeight: 700
                        }
                    },
                    labels: {
                        style: {
                            colors: '#64748b',
                            fontSize: '11px'
                        },
                        formatter: function (val) {
                            return val.toFixed(1) + 'M';
                        }
                    }
                }
            ],
            tooltip: {
                shared: true,
                intersect: false,
                theme: 'light',
                y: {
                    formatter: function (val, opts) {
                        if (opts.seriesIndex === 0) {
                            return val + ' Tickets';
                        }
                        return 'PKR ' + val.toFixed(1) + ' Million';
                    }
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                labels: {
                    colors: '#475569'
                }
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4
            }
        };

        const chart = new ApexCharts(document.querySelector("#ticket-sales-chart"), options);
        chart.render();
    });
</script>
@endsection
