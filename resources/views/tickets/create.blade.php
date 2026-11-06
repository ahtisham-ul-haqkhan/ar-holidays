@extends('layouts.app')

@section('title', 'Issue Flight Ticket · AR Holidays')

@section('content')
<div class="space-y-6 w-full max-w-7xl mx-auto pb-12">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-slate-500 font-medium">
        <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition-colors flex items-center gap-1">
            <i class="fa-solid fa-house text-[10px]"></i>
            <span>Dashboard</span>
        </a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <span class="text-slate-500">Flight Bookings</span>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <span class="text-slate-800 font-semibold">Issue Ticket</span>
    </nav>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200">
        <div>
            <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-red-50 text-red-600 text-[11px] font-bold border border-red-100 uppercase tracking-wider mb-2">
                <i class="fa-solid fa-plane-departure text-[10px]"></i>
                <span>GDS Ticket Issuance & Ledger Entry</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-heading">
                Issue Flight Ticket
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Record GDS PNR, airline payable cost, customer sale invoice, and real-time agency profit margin.
            </p>
        </div>

        <div class="flex items-center gap-2 shrink-0">
            <a 
                href="{{ route('dashboard') }}" 
                class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-2xs transition-colors flex items-center gap-2">
                <i class="fa-solid fa-arrow-left text-[11px]"></i>
                <span>Back to Dashboard</span>
            </a>
        </div>
    </div>

    <!-- Form Container (Static Create Form) -->
    <form id="issue-ticket-form" method="POST" action="javascript:void(0)" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- Left / Main Column: Flight Itinerary, GDS & Passenger (8 Cols) -->
            <div class="lg:col-span-8 space-y-6">

                <!-- 1. GDS & Booking Source -->
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs space-y-5">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-sm font-bold shadow-2xs">
                                <i class="fa-solid fa-satellite-dish"></i>
                            </span>
                            <div>
                                <h2 class="text-sm font-bold text-slate-900 font-heading">1. GDS Booking & System Credentials</h2>
                                <p class="text-[11px] text-slate-400">Global Distribution System source and live PNR records.</p>
                            </div>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                            Required
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- GDS Source -->
                        <div>
                            <label for="gds_source" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Booking GDS / Portal <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="gds_source" 
                                name="gds_source" 
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-xs font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                                <option value="Sabre GDS">Sabre GDS (1B)</option>
                                <option value="Amadeus">Amadeus GDS (1A)</option>
                                <option value="Galileo">Galileo / Travelport (1G)</option>
                                <option value="PIA Agent Portal">PIA Agent Direct Portal</option>
                                <option value="AirSial Web Portal">AirSial Web Desk</option>
                                <option value="Airblue Portal">Airblue Corporate</option>
                                <option value="FlyJinnah Portal">FlyJinnah Portal</option>
                                <option value="Direct Airline Web">Direct Airline Web Booking</option>
                            </select>
                        </div>

                        <!-- PNR Number -->
                        <div>
                            <label for="pnr_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                GDS PNR Code <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="pnr_number" 
                                    name="pnr_number" 
                                    placeholder="e.g. PK78XY" 
                                    maxlength="10" 
                                    required 
                                    class="w-full uppercase font-mono font-bold tracking-widest pl-3.5 pr-8 py-2.5 rounded-xl border border-slate-200 bg-white text-xs text-slate-900 placeholder:text-slate-400 placeholder:font-sans placeholder:tracking-normal focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs">
                                    <i class="fa-solid fa-ticket"></i>
                                </span>
                            </div>
                        </div>

                        <!-- E-Ticket Number -->
                        <div>
                            <label for="ticket_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                E-Ticket Number (13-Digit)
                            </label>
                            <input 
                                type="text" 
                                id="ticket_number" 
                                name="ticket_number" 
                                placeholder="e.g. 214-8923412345" 
                                class="w-full font-mono pl-3.5 pr-3 py-2.5 rounded-xl border border-slate-200 bg-white text-xs text-slate-900 placeholder:text-slate-400 placeholder:font-sans focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        </div>
                    </div>
                </div>

                <!-- 2. Flight Route & Itinerary -->
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs space-y-5">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold shadow-2xs">
                                <i class="fa-solid fa-plane"></i>
                            </span>
                            <div>
                                <h2 class="text-sm font-bold text-slate-900 font-heading">2. Flight Route & Itinerary</h2>
                                <p class="text-[11px] text-slate-400">Carrier, route sectors, flight timings, and cabin class.</p>
                            </div>
                        </div>

                        <!-- Trip Type Switcher -->
                        <div class="inline-flex rounded-xl bg-slate-100 p-1 text-[11px] font-bold text-slate-600">
                            <label class="px-3 py-1 rounded-lg cursor-pointer transition-colors has-[:checked]:bg-white has-[:checked]:text-red-600 has-[:checked]:shadow-2xs">
                                <input type="radio" name="trip_type" value="one_way" class="hidden" checked onchange="toggleReturnDate(false)">
                                One Way
                            </label>
                            <label class="px-3 py-1 rounded-lg cursor-pointer transition-colors has-[:checked]:bg-white has-[:checked]:text-red-600 has-[:checked]:shadow-2xs">
                                <input type="radio" name="trip_type" value="round_trip" class="hidden" onchange="toggleReturnDate(true)">
                                Round Trip
                            </label>
                            <label class="px-3 py-1 rounded-lg cursor-pointer transition-colors has-[:checked]:bg-white has-[:checked]:text-red-600 has-[:checked]:shadow-2xs">
                                <input type="radio" name="trip_type" value="multi_city" class="hidden" onchange="toggleReturnDate(false)">
                                Multi-City
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        
                        <!-- Airline / Vendor -->
                        <div class="sm:col-span-2">
                            <label for="vendor_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Airline Carrier / Vendor <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="vendor_id" 
                                name="vendor_id" 
                                required 
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                                <option value="" disabled selected>-- Select Airline Vendor --</option>
                                @forelse($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }} (Active Partner)</option>
                                @empty
                                    <option value="1">Pakistan International Airlines (PIA)</option>
                                    <option value="2">Airblue</option>
                                    <option value="3">AirSial</option>
                                    <option value="4">Emirates Airlines</option>
                                    <option value="5">Saudia Airlines</option>
                                    <option value="6">FlyDubai</option>
                                @endforelse
                            </select>
                        </div>

                        <!-- Flight Number -->
                        <div>
                            <label for="flight_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Flight Number <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="flight_number" 
                                name="flight_number" 
                                placeholder="e.g. PK-785 / EK-601" 
                                required 
                                class="w-full font-mono uppercase pl-3.5 pr-3 py-2.5 rounded-xl border border-slate-200 bg-white text-xs text-slate-900 placeholder:text-slate-400 placeholder:font-sans focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        </div>

                        <!-- Origin Airport -->
                        <div>
                            <label for="origin" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Departure (Origin) <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="origin" 
                                name="origin" 
                                placeholder="e.g. ISB - Islamabad" 
                                required 
                                class="w-full pl-3.5 pr-3 py-2.5 rounded-xl border border-slate-200 bg-white text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        </div>

                        <!-- Destination Airport -->
                        <div>
                            <label for="destination" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Arrival (Destination) <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="destination" 
                                name="destination" 
                                placeholder="e.g. JED - Jeddah Intl" 
                                required 
                                class="w-full pl-3.5 pr-3 py-2.5 rounded-xl border border-slate-200 bg-white text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        </div>

                        <!-- Cabin Class -->
                        <div>
                            <label for="cabin_class" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Cabin Class
                            </label>
                            <select 
                                id="cabin_class" 
                                name="cabin_class" 
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                                <option value="Economy">Economy Class</option>
                                <option value="Premium Economy">Premium Economy</option>
                                <option value="Business">Business Class</option>
                                <option value="First Class">First Class</option>
                            </select>
                        </div>

                        <!-- Departure Date & Time -->
                        <div>
                            <label for="departure_datetime" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Departure Date & Time <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="datetime-local" 
                                id="departure_datetime" 
                                name="departure_datetime" 
                                required 
                                class="w-full pl-3.5 pr-3 py-2 rounded-xl border border-slate-200 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        </div>

                        <!-- Return Date & Time (Conditional) -->
                        <div id="return-date-container" class="hidden">
                            <label for="return_datetime" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Return Date & Time <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="datetime-local" 
                                id="return_datetime" 
                                name="return_datetime" 
                                class="w-full pl-3.5 pr-3 py-2 rounded-xl border border-slate-200 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        </div>

                        <!-- Baggage Allowance -->
                        <div>
                            <label for="baggage" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Baggage Allowance
                            </label>
                            <input 
                                type="text" 
                                id="baggage" 
                                name="baggage" 
                                placeholder="e.g. 30 Kg (2 Pieces) / 20 Kg" 
                                class="w-full pl-3.5 pr-3 py-2.5 rounded-xl border border-slate-200 bg-white text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        </div>

                    </div>
                </div>

                <!-- 3. Passenger Details -->
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs space-y-5">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-sm font-bold shadow-2xs">
                                <i class="fa-solid fa-user-tag"></i>
                            </span>
                            <div>
                                <h2 class="text-sm font-bold text-slate-900 font-heading">3. Customer Account & Passenger Info</h2>
                                <p class="text-[11px] text-slate-400">Link booking to customer profile and passport identity.</p>
                            </div>
                        </div>
                        <a 
                            href="{{ route('customers.create') }}" 
                            target="_blank" 
                            class="text-xs font-bold text-red-600 hover:text-red-700 flex items-center gap-1">
                            <i class="fa-solid fa-plus text-[10px]"></i> Quick Add Customer
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        
                        <!-- Customer Dropdown -->
                        <div class="sm:col-span-2">
                            <label for="customer_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Client / Billing Profile <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="customer_id" 
                                name="customer_id" 
                                required 
                                onchange="fillPassengerData(this)"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                                <option value="" disabled selected>-- Select Registered Customer --</option>
                                @forelse($customers as $cust)
                                    <option 
                                        value="{{ $cust->id }}" 
                                        data-name="{{ $cust->name }}" 
                                        data-passport="{{ $cust->passport_number }}"
                                        data-cnic="{{ $cust->cnic }}"
                                        data-phone="{{ $cust->phone_primary }}">
                                        {{ $cust->title }} {{ $cust->name }} (CNIC: {{ $cust->cnic }})
                                    </option>
                                @empty
                                    <option value="1">Muhammad Ali Khan (CNIC: 37405-1234567-1)</option>
                                    <option value="2">Syeda Fatima Zahra (CNIC: 61101-9876543-2)</option>
                                    <option value="3">Chaudhry Tariq Mehmood (CNIC: 35202-5432109-7)</option>
                                @endforelse
                            </select>
                        </div>

                        <!-- Passenger Type -->
                        <div>
                            <label for="passenger_type" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Passenger Type
                            </label>
                            <select 
                                id="passenger_type" 
                                name="passenger_type" 
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                                <option value="Adult">Adult (12+ Yrs)</option>
                                <option value="Child">Child (2 - 11 Yrs)</option>
                                <option value="Infant">Infant (Under 2 Yrs)</option>
                            </select>
                        </div>

                        <!-- Passenger Name (Passport) -->
                        <div>
                            <label for="passenger_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Passenger Name (As on Passport) <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="passenger_name" 
                                name="passenger_name" 
                                placeholder="SURNAME / GIVEN NAME" 
                                required 
                                class="w-full uppercase pl-3.5 pr-3 py-2.5 rounded-xl border border-slate-200 bg-white text-xs text-slate-900 placeholder:text-slate-400 placeholder:font-sans focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        </div>

                        <!-- Passport Number -->
                        <div>
                            <label for="passport_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Passport Number
                            </label>
                            <input 
                                type="text" 
                                id="passport_number" 
                                name="passport_number" 
                                placeholder="e.g. AB1234567" 
                                class="w-full uppercase font-mono pl-3.5 pr-3 py-2.5 rounded-xl border border-slate-200 bg-white text-xs text-slate-900 placeholder:text-slate-400 placeholder:font-sans focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        </div>

                        <!-- WhatsApp / Mobile Phone -->
                        <div>
                            <label for="passenger_phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                WhatsApp / Mobile No
                            </label>
                            <input 
                                type="text" 
                                id="passenger_phone" 
                                name="passenger_phone" 
                                placeholder="0300-1234567" 
                                class="w-full pl-3.5 pr-3 py-2.5 rounded-xl border border-slate-200 bg-white text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        </div>

                    </div>
                </div>

            </div>

            <!-- Right Column: Financials, Profit Desk & Settlements (4 Cols) -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Financial Calculation Card -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-5">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                        <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold shadow-2xs">
                            <i class="fa-solid fa-calculator"></i>
                        </span>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900 font-heading">4. Financials & Profit Ledger</h2>
                            <p class="text-[11px] text-slate-400">Live margin and vendor payable calculation.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Buying Price (Vendor Cost) -->
                        <div>
                            <label for="buying_price" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Vendor Cost / Buying Price (PKR) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">PKR</span>
                                <input 
                                    type="number" 
                                    id="buying_price" 
                                    name="buying_price" 
                                    placeholder="e.g. 145000" 
                                    min="0" 
                                    step="100" 
                                    required 
                                    oninput="calculateProfit()"
                                    class="w-full font-mono font-bold text-slate-900 pl-12 pr-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1">Amount to be settled with Airline / GDS.</p>
                        </div>

                        <!-- Selling Price (Customer Charged) -->
                        <div>
                            <label for="selling_price" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Customer Sale Price (PKR) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">PKR</span>
                                <input 
                                    type="number" 
                                    id="selling_price" 
                                    name="selling_price" 
                                    placeholder="e.g. 165000" 
                                    min="0" 
                                    step="100" 
                                    required 
                                    oninput="calculateProfit()"
                                    class="w-full font-mono font-bold text-slate-900 pl-12 pr-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1">Total invoice charged to client.</p>
                        </div>

                        <!-- Dynamic Real-Time Profit Display -->
                        <div id="profit-badge-container" class="p-4 rounded-2xl bg-slate-50 border border-slate-200 transition-all">
                            <div class="flex items-center justify-between text-xs font-semibold text-slate-600 mb-1">
                                <span>Agency Net Profit Margin:</span>
                                <span id="profit-percentage" class="font-bold text-slate-500">0.0%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span id="profit-amount" class="text-lg font-extrabold font-mono text-slate-800">
                                    PKR 0
                                </span>
                                <span id="profit-status-pill" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-200 text-slate-600">
                                    Awaiting Input
                                </span>
                            </div>
                        </div>

                        <!-- Vendor Payable Status -->
                        <div>
                            <label for="vendor_payment_status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Airline Settlement Status
                            </label>
                            <select 
                                id="vendor_payment_status" 
                                name="vendor_payment_status" 
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                                <option value="Payable Due" selected>Payable Due (Add to Vendor Ledger)</option>
                                <option value="Paid Directly">Paid / Cleared (Cash / Direct Top-up)</option>
                            </select>
                        </div>

                        <!-- Customer Payment Status & Method -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="customer_payment_status" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                    Client Payment
                                </label>
                                <select 
                                    id="customer_payment_status" 
                                    name="customer_payment_status" 
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                                    <option value="Paid Full">Paid Full</option>
                                    <option value="Partial">Partial / Advance</option>
                                    <option value="Pending" selected>Pending</option>
                                </select>
                            </div>

                            <div>
                                <label for="payment_method" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                    Method
                                </label>
                                <select 
                                    id="payment_method" 
                                    name="payment_method" 
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                                    <option value="Cash">Cash Desk</option>
                                    <option value="Bank Transfer">Bank / Raast</option>
                                    <option value="Online Card">Credit / Debit</option>
                                    <option value="Cheque">Cheque</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- 5. Remarks & E-Ticket Document -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
                    <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                        <i class="fa-solid fa-file-invoice text-xs text-slate-400"></i>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Internal Notes & Attachment</h3>
                    </div>

                    <div>
                        <label for="remarks" class="block text-xs font-semibold text-slate-600 mb-1.5">
                            Special Agent Remarks
                        </label>
                        <textarea 
                            id="remarks" 
                            name="remarks" 
                            rows="2" 
                            placeholder="e.g. Non-refundable ticket, Umrah group pax, meal requested..." 
                            class="w-full px-3.5 py-2 rounded-xl border border-slate-200 bg-white text-xs text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">
                            Attach Airline E-Ticket (PDF)
                        </label>
                        <div class="border-2 border-dashed border-slate-200 hover:border-red-300 rounded-2xl p-4 text-center cursor-pointer transition-colors bg-slate-50/50">
                            <i class="fa-solid fa-cloud-arrow-up text-xl text-slate-400 mb-1"></i>
                            <p class="text-[11px] font-semibold text-slate-700">Click or Drag E-Ticket PDF</p>
                            <p class="text-[10px] text-slate-400">PDF, JPG up to 5MB</p>
                        </div>
                    </div>
                </div>

                <!-- Form Action Buttons -->
                <div class="bg-slate-900 rounded-3xl p-6 text-white shadow-lg shadow-slate-900/10 space-y-4">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-400">Issuing Officer:</span>
                        <span class="font-bold text-white">{{ auth()->user()->name ?? 'Rehman Admin' }}</span>
                    </div>

                    <div class="pt-2">
                        <button 
                            type="button" 
                            onclick="handleFormSubmit()" 
                            class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-500 hover:to-rose-600 text-white font-bold text-sm shadow-lg shadow-red-600/30 transition-all transform active:scale-98 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-ticket"></i>
                            <span>Issue & Save Flight Ticket</span>
                        </button>
                    </div>

                    <p class="text-[10px] text-slate-400 text-center">
                        Static prototype form. Ledger and GDS records will be connected upon database setup.
                    </p>
                </div>

            </div>

        </div>

    </form>

</div>

<!-- Interactive Client-side Script -->
<script>
    function toggleReturnDate(show) {
        const container = document.getElementById('return-date-container');
        if (show) {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }

    function calculateProfit() {
        const buying = parseFloat(document.getElementById('buying_price').value) || 0;
        const selling = parseFloat(document.getElementById('selling_price').value) || 0;

        const profit = selling - buying;
        const container = document.getElementById('profit-badge-container');
        const amountEl = document.getElementById('profit-amount');
        const percentageEl = document.getElementById('profit-percentage');
        const pillEl = document.getElementById('profit-status-pill');

        if (buying === 0 && selling === 0) {
            container.className = 'p-4 rounded-2xl bg-slate-50 border border-slate-200 transition-all';
            amountEl.className = 'text-lg font-extrabold font-mono text-slate-800';
            amountEl.innerText = 'PKR 0';
            percentageEl.innerText = '0.0%';
            pillEl.className = 'text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-200 text-slate-600';
            pillEl.innerText = 'Awaiting Input';
            return;
        }

        const percentage = buying > 0 ? ((profit / buying) * 100).toFixed(1) : '100.0';

        if (profit >= 0) {
            container.className = 'p-4 rounded-2xl bg-emerald-50 border border-emerald-200 transition-all';
            amountEl.className = 'text-lg font-extrabold font-mono text-emerald-700';
            amountEl.innerText = '+ PKR ' + profit.toLocaleString();
            percentageEl.className = 'font-bold text-emerald-700';
            percentageEl.innerText = '+' + percentage + '% Margin';
            pillEl.className = 'text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-200 text-emerald-800';
            pillEl.innerText = 'Net Profit';
        } else {
            container.className = 'p-4 rounded-2xl bg-rose-50 border border-rose-200 transition-all';
            amountEl.className = 'text-lg font-extrabold font-mono text-rose-700';
            amountEl.innerText = '- PKR ' + Math.abs(profit).toLocaleString();
            percentageEl.className = 'font-bold text-rose-700';
            percentageEl.innerText = percentage + '% Margin';
            pillEl.className = 'text-[10px] font-bold px-2 py-0.5 rounded-full bg-rose-200 text-rose-800';
            pillEl.innerText = 'Loss Alert';
        }
    }

    function fillPassengerData(select) {
        const option = select.options[select.selectedIndex];
        if (!option) return;

        const name = option.getAttribute('data-name');
        const passport = option.getAttribute('data-passport');
        const phone = option.getAttribute('data-phone');

        if (name) document.getElementById('passenger_name').value = name;
        if (passport) document.getElementById('passport_number').value = passport;
        if (phone) document.getElementById('passenger_phone').value = phone;
    }

    function handleFormSubmit() {
        const pnr = document.getElementById('pnr_number').value;
        const flight = document.getElementById('flight_number').value;
        
        if (!pnr || !flight) {
            alert('Please enter at least GDS PNR Code and Flight Number.');
            return;
        }

        alert('Ticket Form Prototype: PNR [' + pnr + '] details captured smoothly! Backend storage will be connected next.');
    }
</script>
@endsection

