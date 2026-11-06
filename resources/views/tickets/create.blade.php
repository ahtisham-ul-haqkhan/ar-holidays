@extends('layouts.app')

@section('title', 'Issue Flight Ticket · AR Holidays')

@section('content')
<div class="space-y-4 w-full max-w-7xl mx-auto pb-10">

    <!-- Top Action & Breadcrumb Bar (Compact) -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 pb-2.5 border-b border-slate-200/80">
        <div>
            <nav class="flex items-center gap-1.5 text-[11px] text-slate-400 font-medium mb-1">
                <a href="{{ route('dashboard') }}" class="hover:text-red-600 transition-colors flex items-center gap-1">
                    <i class="fa-solid fa-house text-[9px]"></i>
                    <span>Dashboard</span>
                </a>
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
                <span class="text-slate-500">Flight Bookings</span>
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
                <span class="text-slate-800 font-semibold">Issue Ticket</span>
            </nav>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight font-heading flex items-center gap-2">
                <span>Issue Flight Ticket</span>
                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-red-50 text-red-600 border border-red-100 uppercase tracking-wide">One Way</span>
            </h1>
        </div>

        <a 
            href="{{ route('dashboard') }}" 
            class="px-3.5 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-2xs transition-colors flex items-center gap-1.5 self-start sm:self-auto">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>Back to Dashboard</span>
        </a>
    </div>

    <!-- Single Consolidated Form Card -->
    <form id="issue-ticket-form" method="POST" action="javascript:void(0)" class="space-y-4">
        @csrf
        <!-- Fixed One Way Trip Type -->
        <input type="hidden" name="trip_type" value="one_way">

        <div class="bg-white rounded-3xl p-5 sm:p-7 border border-slate-200/80 shadow-xs space-y-6">

            <!-- SECTION 1: Client Profile & Booking Identification -->
            <div class="space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-[11px] font-bold">
                            <i class="fa-solid fa-user-tag"></i>
                        </span>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 font-heading">
                            1. Client & Ticket Identification
                        </h3>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-[10px] font-semibold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200">
                            * Required Fields
                        </span>
                        <a 
                            href="{{ route('customers.create') }}" 
                            target="_blank" 
                            class="text-[11px] font-bold text-red-600 hover:text-red-700 flex items-center gap-1">
                            <i class="fa-solid fa-plus text-[9px]"></i> Quick Add Customer
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                    
                    <!-- Customer Dropdown -->
                    <div class="sm:col-span-3 space-y-1.5">
                        <label for="customer_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Client / Billing Profile <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="customer_id" 
                            name="customer_id" 
                            required 
                            onchange="fillPassengerData(this)"
                            class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-semibold text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
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

                    <!-- Passport Number -->
                    <div class="sm:col-span-3 space-y-1.5">
                        <label for="passport_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Passport Number
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                                <i class="fa-solid fa-passport text-xs"></i>
                            </span>
                            <input 
                                type="text" 
                                id="passport_number" 
                                name="passport_number" 
                                placeholder="e.g. PK8829104" 
                                class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-mono font-bold text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 uppercase transition-all">
                        </div>
                    </div>

                    <!-- GDS PNR Code -->
                    <div class="sm:col-span-3 space-y-1.5">
                        <label for="pnr_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
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
                                class="w-full uppercase font-mono font-bold tracking-widest pl-3.5 pr-8 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs text-slate-900 placeholder:text-slate-400 placeholder:font-sans placeholder:tracking-normal border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs">
                                <i class="fa-solid fa-ticket"></i>
                            </span>
                        </div>
                    </div>

                    <!-- E-Ticket Number -->
                    <div class="sm:col-span-3 space-y-1.5">
                        <label for="ticket_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center justify-between">
                            <span>E-Ticket Number (13-Digit)</span>
                            <!-- <span class="text-[10px] text-slate-400 font-normal">Max 13 Digits</span> -->
                        </label>
                        <input 
                            type="text" 
                            id="ticket_number" 
                            name="ticket_number" 
                            maxlength="14"
                            inputmode="numeric"
                            placeholder="e.g. 214-8923412345" 
                            oninput="formatTicketNumber(this)"
                            onkeydown="handleTicketKeydown(event, this)"
                            class="w-full font-mono font-bold pl-3.5 pr-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs text-slate-900 placeholder:text-slate-400 placeholder:font-sans border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        <!-- <p id="ticket_feedback" class="text-[10px] text-slate-400 mt-0.5">Format: 214-8923412345 (13 digits)</p> -->
                    </div>

                </div>
            </div>

            <!-- SECTION 2: Flight Route & Itinerary (One Way) -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                    <span class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold">
                        <i class="fa-solid fa-plane"></i>
                    </span>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 font-heading">
                        2. Flight Route & Itinerary (One Way)
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                    
                    <!-- Airline / Vendor -->
                    <div class="sm:col-span-3 space-y-1.5">
                        <label for="vendor_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Airline Carrier / Vendor <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="vendor_id" 
                            name="vendor_id" 
                            required 
                            class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-semibold text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
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
                    <div class="sm:col-span-3 space-y-1.5">
                        <label for="flight_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Flight Number <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="flight_number" 
                            name="flight_number" 
                            placeholder="e.g. PK-785 / EK-601" 
                            required 
                            class="w-full font-mono uppercase pl-3.5 pr-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs text-slate-900 placeholder:text-slate-400 placeholder:font-sans border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    </div>

                    <!-- Origin Airport -->
                    <div class="sm:col-span-3 space-y-1.5">
                        <label for="origin" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Departure (Origin) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="origin" 
                            name="origin" 
                            placeholder="e.g. ISB - Islamabad" 
                            required 
                            class="w-full pl-3.5 pr-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs text-slate-900 placeholder:text-slate-400 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    </div>

                    <!-- Destination Airport -->
                    <div class="sm:col-span-3 space-y-1.5">
                        <label for="destination" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Arrival (Destination) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="destination" 
                            name="destination" 
                            placeholder="e.g. JED - Jeddah Intl" 
                            required 
                            class="w-full pl-3.5 pr-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs text-slate-900 placeholder:text-slate-400 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    </div>

                    <!-- Departure Date & Time -->
                    <div class="sm:col-span-4 space-y-1.5">
                        <label for="departure_datetime" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Departure Date & Time <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="datetime-local" 
                            id="departure_datetime" 
                            name="departure_datetime" 
                            required 
                            class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    </div>

                    <!-- Cabin Class -->
                    <div class="sm:col-span-4 space-y-1.5">
                        <label for="cabin_class" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Cabin Class
                        </label>
                        <select 
                            id="cabin_class" 
                            name="cabin_class" 
                            class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-800 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                            <option value="Economy">Economy Class</option>
                            <option value="Premium Economy">Premium Economy</option>
                            <option value="Business">Business Class</option>
                            <option value="First Class">First Class</option>
                        </select>
                    </div>

                    <!-- Baggage Allowance -->
                    <div class="sm:col-span-4 space-y-1.5">
                        <label for="baggage" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Baggage Allowance
                        </label>
                        <input 
                            type="text" 
                            id="baggage" 
                            name="baggage" 
                            placeholder="e.g. 30 Kg (2 Pieces) / 20 Kg" 
                            class="w-full pl-3.5 pr-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs text-slate-900 placeholder:text-slate-400 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    </div>

                </div>
            </div>

            <!-- SECTION 3: Financials & Profit Ledger -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                    <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs font-bold">
                        <i class="fa-solid fa-calculator"></i>
                    </span>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 font-heading">
                        3. Financials & Profit Ledger
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-12 gap-5 items-start">
                    
                    <!-- Vendor Cost / Buying Price -->
                    <div class="sm:col-span-4 space-y-1.5">
                        <label for="buying_price" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Vendor Cost / Buying Price (PKR) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">PKR</span>
                            <input 
                                type="text" 
                                inputmode="numeric"
                                id="buying_price" 
                                name="buying_price" 
                                placeholder="e.g. 145,000" 
                                required 
                                oninput="formatCurrencyInput(this)"
                                class="w-full font-mono font-bold text-slate-900 pl-12 pr-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        </div>
                        <p class="text-[10px] text-slate-400 mt-1">Amount to be settled with Airline / Vendor.</p>
                    </div>

                    <!-- Customer Sale Price -->
                    <div class="sm:col-span-4 space-y-1.5">
                        <label for="selling_price" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Customer Sale Price (PKR) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">PKR</span>
                            <input 
                                type="text" 
                                inputmode="numeric"
                                id="selling_price" 
                                name="selling_price" 
                                placeholder="e.g. 165,000" 
                                required 
                                oninput="formatCurrencyInput(this)"
                                class="w-full font-mono font-bold text-slate-900 pl-12 pr-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        </div>
                        <p class="text-[10px] text-slate-400 mt-1">Total invoice charged to customer account.</p>
                    </div>

                    <!-- Dynamic Real-Time Profit Display -->
                    <div class="sm:col-span-4">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Net Profit Margin
                        </label>
                        <div id="profit-badge-container" class="p-3 rounded-xl bg-slate-50 border border-slate-200 transition-all">
                            <div class="flex items-center justify-between text-xs font-semibold text-slate-600 mb-1">
                                <span class="text-[11px]">Agency Margin:</span>
                                <span id="profit-percentage" class="font-bold text-slate-500 text-[11px]">0.0%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span id="profit-amount" class="text-base sm:text-lg font-extrabold font-mono text-slate-800">
                                    PKR 0
                                </span>
                                <span id="profit-status-pill" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-200 text-slate-600">
                                    Awaiting Input
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Payment Status -->
                    <div class="sm:col-span-6 space-y-1.5">
                        <label for="customer_payment_status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Client Payment Status
                        </label>
                        <select 
                            id="customer_payment_status" 
                            name="customer_payment_status" 
                            class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-semibold text-slate-800 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                            <option value="Paid Full">Paid Full</option>
                            <option value="Partial">Partial / Advance</option>
                            <option value="Pending" selected>Pending</option>
                        </select>
                    </div>

                    <!-- Payment Method -->
                    <div class="sm:col-span-6 space-y-1.5">
                        <label for="payment_method" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Payment Method
                        </label>
                        <select 
                            id="payment_method" 
                            name="payment_method" 
                            class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-semibold text-slate-800 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                            <option value="Cash">Cash Desk</option>
                            <option value="Bank Transfer">Bank / Raast</option>
                            <option value="Online Card">Credit / Debit Card</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>

                </div>
            </div>

            <!-- Form Actions (Inside Main Card) -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2 text-xs text-slate-500">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>Issuing Officer: <strong class="text-slate-800">{{ auth()->user()->name ?? 'Rehman Admin' }}</strong></span>
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                    <a 
                        href="{{ route('dashboard') }}" 
                        class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                        Cancel
                    </a>
                    <button 
                        type="button" 
                        onclick="handleFormSubmit()" 
                        class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold uppercase tracking-wider shadow-md shadow-red-600/30 transition-all flex items-center justify-center gap-2 transform active:scale-95">
                        <i class="fa-solid fa-ticket"></i>
                        <span>Issue Ticket</span>
                    </button>
                </div>
            </div>

        </div>

    </form>

</div>

<!-- Interactive Client-side Script -->
<script>
    // 1. E-Ticket Number Formatter (Max 13 Digits: XXX-XXXXXXXXXX)
    function formatTicketNumber(el) {
        if (!el) return;
        const raw = el.value || '';
        const digits = raw.replace(/\D/g, '').slice(0, 13);
        let formatted = '';

        if (digits.length > 3) {
            formatted = digits.slice(0, 3) + '-' + digits.slice(3);
        } else {
            formatted = digits;
        }

        if (el.value !== formatted) {
            el.value = formatted;
        }

        const feedback = document.getElementById('ticket_feedback');
        if (feedback) {
            if (digits.length === 13) {
                feedback.textContent = '✓ Complete 13-digit E-Ticket (' + formatted + ')';
                feedback.className = 'text-[10px] text-emerald-600 font-bold mt-0.5';
                el.classList.remove('border-red-500');
                el.classList.add('border-emerald-500');
            } else if (digits.length > 0) {
                feedback.textContent = digits.length + ' of 13 digits entered';
                feedback.className = 'text-[10px] text-slate-500 mt-0.5';
                el.classList.remove('border-emerald-500');
            } else {
                feedback.textContent = 'Format: 214-8923412345 (Max 13 digits)';
                feedback.className = 'text-[10px] text-slate-400 mt-0.5';
                el.classList.remove('border-emerald-500');
            }
        }
    }
    window.formatTicketNumber = formatTicketNumber;

    // Smart backspace handling for ticket number dash
    function handleTicketKeydown(e, el) {
        if (e.key === 'Backspace') {
            const pos = el.selectionStart;
            if (pos === 4 && el.selectionStart === el.selectionEnd) {
                e.preventDefault();
                const val = el.value;
                el.value = val.slice(0, 2) + val.slice(4);
                formatTicketNumber(el);
                el.setSelectionRange(2, 2);
            }
        }
    }
    window.handleTicketKeydown = handleTicketKeydown;

    // 2. Real-time Currency / Number Comma Formatter (e.g. 145,000)
    function formatCurrencyInput(el) {
        if (!el) return;
        const raw = el.value || '';
        const cursor = el.selectionStart || 0;

        // Count digits before cursor in existing value
        const digitsBeforeCursor = raw.slice(0, cursor).replace(/\D/g, '').length;

        // Strip non-digits and leading zeros (allow single 0)
        let digits = raw.replace(/\D/g, '');
        if (digits.length > 1) {
            digits = digits.replace(/^0+/, '') || '0';
        }

        if (!digits) {
            el.value = '';
            calculateProfit();
            return;
        }

        // Add standard thousand comma separators
        const formatted = digits.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        el.value = formatted;

        // Restore cursor position accurately
        let newCursor = 0;
        let countedDigits = 0;
        while (newCursor < formatted.length && countedDigits < digitsBeforeCursor) {
            if (/\d/.test(formatted[newCursor])) {
                countedDigits++;
            }
            newCursor++;
        }
        el.setSelectionRange(newCursor, newCursor);

        calculateProfit();
    }
    window.formatCurrencyInput = formatCurrencyInput;

    // 3. Profit Calculation (Strips commas before arithmetic)
    function calculateProfit() {
        const buyingEl = document.getElementById('buying_price');
        const sellingEl = document.getElementById('selling_price');
        if (!buyingEl || !sellingEl) return;

        const buying = parseFloat((buyingEl.value || '').replace(/,/g, '')) || 0;
        const selling = parseFloat((sellingEl.value || '').replace(/,/g, '')) || 0;

        const profit = selling - buying;
        const container = document.getElementById('profit-badge-container');
        const amountEl = document.getElementById('profit-amount');
        const percentageEl = document.getElementById('profit-percentage');
        const pillEl = document.getElementById('profit-status-pill');

        if (!container || !amountEl || !percentageEl || !pillEl) return;

        if (buying === 0 && selling === 0) {
            container.className = 'p-3 rounded-xl bg-slate-50 border border-slate-200 transition-all';
            amountEl.className = 'text-base sm:text-lg font-extrabold font-mono text-slate-800';
            amountEl.innerText = 'PKR 0';
            percentageEl.innerText = '0.0%';
            percentageEl.className = 'font-bold text-slate-500 text-[11px]';
            pillEl.className = 'text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-200 text-slate-600';
            pillEl.innerText = 'Awaiting Input';
            return;
        }

        const percentage = buying > 0 ? ((profit / buying) * 100).toFixed(1) : '100.0';

        if (profit >= 0) {
            container.className = 'p-3 rounded-xl bg-emerald-50 border border-emerald-200 transition-all';
            amountEl.className = 'text-base sm:text-lg font-extrabold font-mono text-emerald-700';
            amountEl.innerText = '+ PKR ' + profit.toLocaleString();
            percentageEl.className = 'font-bold text-emerald-700 text-[11px]';
            percentageEl.innerText = '+' + percentage + '% Margin';
            pillEl.className = 'text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-200 text-emerald-800';
            pillEl.innerText = 'Net Profit';
        } else {
            container.className = 'p-3 rounded-xl bg-rose-50 border border-rose-200 transition-all';
            amountEl.className = 'text-base sm:text-lg font-extrabold font-mono text-rose-700';
            amountEl.innerText = '- PKR ' + Math.abs(profit).toLocaleString();
            percentageEl.className = 'font-bold text-rose-700 text-[11px]';
            percentageEl.innerText = percentage + '% Margin';
            pillEl.className = 'text-[10px] font-bold px-2 py-0.5 rounded-full bg-rose-200 text-rose-800';
            pillEl.innerText = 'Loss Alert';
        }
    }
    window.calculateProfit = calculateProfit;

    // 4. Fill Passenger / Customer Profile details
    function fillPassengerData(select) {
        if (!select) return;
        const option = select.options[select.selectedIndex];
        if (!option) return;

        const passport = option.getAttribute('data-passport');
        const passportInput = document.getElementById('passport_number');
        if (passport && passportInput && !passportInput.value) {
            passportInput.value = passport;
        }
    }
    window.fillPassengerData = fillPassengerData;

    // 5. Submit Prototype Action
    function handleFormSubmit() {
        const pnrInput = document.getElementById('pnr_number');
        const flightInput = document.getElementById('flight_number');
        const customerSelect = document.getElementById('customer_id');

        if (!customerSelect || !customerSelect.value) {
            alert('Please select a Customer / Billing Profile.');
            if (customerSelect) customerSelect.focus();
            return;
        }

        if (!pnrInput || !pnrInput.value.trim()) {
            alert('Please enter the GDS PNR Code.');
            if (pnrInput) pnrInput.focus();
            return;
        }

        if (!flightInput || !flightInput.value.trim()) {
            alert('Please enter the Flight Number.');
            if (flightInput) flightInput.focus();
            return;
        }

        alert('Ticket Form Prototype: PNR [' + pnrInput.value.trim() + '] details captured smoothly! Backend database storage will be connected next.');
    }
    window.handleFormSubmit = handleFormSubmit;

    // 6. DOM Event Listeners initialization
    document.addEventListener('DOMContentLoaded', function() {
        const ticketInput = document.getElementById('ticket_number');
        const buyingInput = document.getElementById('buying_price');
        const sellingInput = document.getElementById('selling_price');

        if (ticketInput) {
            ['input', 'keyup', 'paste', 'change'].forEach(evt => {
                ticketInput.addEventListener(evt, function() {
                    formatTicketNumber(this);
                });
            });
            if (ticketInput.value) formatTicketNumber(ticketInput);
        }

        if (buyingInput) {
            ['input', 'keyup', 'paste', 'change'].forEach(evt => {
                buyingInput.addEventListener(evt, function() {
                    formatCurrencyInput(this);
                });
            });
            if (buyingInput.value) formatCurrencyInput(buyingInput);
        }

        if (sellingInput) {
            ['input', 'keyup', 'paste', 'change'].forEach(evt => {
                sellingInput.addEventListener(evt, function() {
                    formatCurrencyInput(this);
                });
            });
            if (sellingInput.value) formatCurrencyInput(sellingInput);
        }
    });
</script>
@endsection
