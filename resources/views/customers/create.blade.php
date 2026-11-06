@extends('layouts.app')

@section('title', 'Add New Customer · AR Holidays')

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
                <a href="{{ route('customers.index') }}" class="hover:text-red-600 transition-colors">Customers</a>
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
                <span class="text-slate-800 font-semibold">New Customer</span>
            </nav>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight font-heading">
                Register New Customer
            </h1>
        </div>

        <a 
            href="{{ route('customers.index') }}" 
            class="px-3.5 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-2xs transition-colors flex items-center gap-1.5 self-start sm:self-auto">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>All Customers</span>
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
    <form id="create-customer-form" method="POST" action="{{ route('customers.store') }}" class="space-y-4">
        @csrf

        <!-- Card: Customer Details -->
        <div class="bg-white rounded-3xl p-5 sm:p-7 border border-slate-200/80 shadow-xs space-y-5">
            <div class="pb-3 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-xs font-bold text-slate-900 font-heading uppercase tracking-wider">Customer Profile Information</h2>
                <span class="text-[10px] font-semibold text-rose-600 bg-rose-50 px-2.5 py-0.5 rounded-full border border-rose-200">
                    * CNIC is required & unique
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                
                <!-- Title -->
                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Title</label>
                    <select 
                        name="title" 
                        class="w-full px-3 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        <option value="">Select Title</option>
                        @foreach($titles as $t)
                            <option value="{{ $t }}" {{ old('title') === $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Full Name (Client & Server Validated) -->
                <div class="sm:col-span-6 space-y-1.5">
                    <label for="customer_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1">
                        <span>Full Name</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="customer_name"
                        required 
                        minlength="3" 
                        maxlength="100"
                        value="{{ old('name') }}" 
                        placeholder="e.g. Muhammad Hamza" 
                        oninput="validateCustomerName(this)"
                        onblur="validateCustomerName(this)"
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border @error('name') border-red-500 bg-red-50/30 @else border-slate-200 @enderror rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                    @error('name')
                        <p class="text-[11px] text-red-600 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                    <p id="name_feedback" class="text-[11px] font-semibold mt-1 hidden"></p>
                </div>

                <!-- CNIC (Required, Unique & Auto-Formatted) -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label for="customer_cnic" class="block text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center justify-between">
                        <span class="flex items-center gap-1">
                            <span>CNIC</span>
                            <span class="text-red-500">*</span>
                        </span>
                        <span class="text-[10px] text-slate-400 font-normal">Format: XXXXX-XXXXXXX-X</span>
                    </label>
                    <input 
                        type="text" 
                        name="cnic" 
                        id="customer_cnic"
                        required 
                        maxlength="15"
                        value="{{ old('cnic') }}" 
                        placeholder="35202-1234567-1" 
                        oninput="formatCnic(this)"
                        onkeydown="handleCnicKeydown(event, this)"
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-mono font-bold text-slate-900 border @error('cnic') border-red-500 bg-red-50/30 @else border-slate-200 @enderror rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                    @error('cnic')
                        <p class="text-[11px] text-red-600 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                    <p id="cnic_feedback" class="text-[10px] text-slate-400 mt-0.5">Format: 12345-1234567-1</p>
                </div>

                <!-- Date of Birth -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Date of Birth</label>
                    <input 
                        type="date" 
                        name="dob" 
                        value="{{ old('dob') }}" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    >
                </div>

                <!-- Gender -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Gender</label>
                    <select 
                        name="gender" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        <option value="">Select Gender</option>
                        @foreach($genders as $g)
                            <option value="{{ $g }}" {{ old('gender') === $g ? 'selected' : '' }}>{{ $g }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Passport -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Passport Number</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                            <i class="fa-solid fa-passport text-xs"></i>
                        </span>
                        <input 
                            type="text" 
                            name="passport" 
                            value="{{ old('passport') }}" 
                            placeholder="e.g. PK8829104" 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-mono font-bold text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 uppercase transition-all"
                        >
                    </div>
                </div>

                <!-- Email -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                            <i class="fa-regular fa-envelope text-xs"></i>
                        </span>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="traveler@example.com" 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                        >
                    </div>
                </div>

                <!-- Number -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Contact Number</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                            <i class="fa-solid fa-phone text-xs"></i>
                        </span>
                        <input 
                            type="text" 
                            name="number" 
                            value="{{ old('number') }}" 
                            placeholder="+92 300 1234567" 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-mono text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                        >
                    </div>
                </div>

                <!-- Status -->
                <div class="sm:col-span-4 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Status</label>
                    <select 
                        name="status" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                        @foreach($statuses as $s)
                            <option value="{{ $s }}" {{ old('status', 'Active') === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Address -->
                <div class="sm:col-span-12 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Address</label>
                    <textarea 
                        name="address" 
                        rows="3" 
                        placeholder="House #, Street, Phase / Sector, City" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">{{ old('address') }}</textarea>
                </div>

                <!-- Form Actions (Inside Main Card) -->
                <div class="sm:col-span-12 pt-5 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-xs text-slate-500">
                        Customer record will be saved directly into database.
                    </span>

                    <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                        <a 
                            href="{{ route('customers.index') }}" 
                            class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                            Cancel
                        </a>
                        <button 
                            type="submit" 
                            class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold uppercase tracking-wider shadow-md shadow-red-600/30 transition-all flex items-center justify-center gap-2 transform active:scale-95">
                            <i class="fa-solid fa-check"></i>
                            <span>Save Customer</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </form>

</div>

<script>
    // 1. Direct CNIC Formatter
    function formatCnic(el) {
        if (!el) return;
        const raw = el.value || '';
        const digits = raw.replace(/\D/g, '').slice(0, 13);
        let formatted = '';

        if (digits.length > 5) {
            formatted += digits.slice(0, 5) + '-';
            if (digits.length > 12) {
                formatted += digits.slice(5, 12) + '-' + digits.slice(12, 13);
            } else {
                formatted += digits.slice(5);
            }
        } else {
            formatted = digits;
        }

        if (el.value !== formatted) {
            el.value = formatted;
        }

        const feedback = document.getElementById('cnic_feedback');
        if (feedback) {
            if (digits.length === 13) {
                feedback.textContent = '✓ Complete 13-digit CNIC (' + formatted + ')';
                feedback.className = 'text-[10px] text-emerald-600 font-bold mt-0.5';
                el.classList.remove('border-red-500');
                el.classList.add('border-emerald-500');
            } else if (digits.length > 0) {
                feedback.textContent = digits.length + ' of 13 digits entered';
                feedback.className = 'text-[10px] text-slate-500 mt-0.5';
                el.classList.remove('border-emerald-500');
            } else {
                feedback.textContent = 'Format: 12345-1234567-1';
                feedback.className = 'text-[10px] text-slate-400 mt-0.5';
                el.classList.remove('border-emerald-500');
            }
        }
    }
    window.formatCnic = formatCnic;

    // Smart backspace handling for dashes
    function handleCnicKeydown(e, el) {
        if (e.key === 'Backspace') {
            const pos = el.selectionStart;
            if ((pos === 6 || pos === 14) && el.selectionStart === el.selectionEnd) {
                e.preventDefault();
                const val = el.value;
                el.value = val.slice(0, pos - 2) + val.slice(pos);
                formatCnic(el);
                const newPos = Math.max(0, pos - 2);
                el.setSelectionRange(newPos, newPos);
            }
        }
    }
    window.handleCnicKeydown = handleCnicKeydown;

    // 2. Direct Name Validation
    function validateCustomerName(el) {
        if (!el) return true;
        const val = el.value.trim();
        const feedback = document.getElementById('name_feedback');

        if (val.length === 0) {
            el.classList.add('border-red-500', 'bg-red-50/20');
            el.classList.remove('border-emerald-500', 'border-amber-500', 'bg-emerald-50/10', 'bg-amber-50/10');
            if (feedback) {
                feedback.textContent = 'Customer full name is required.';
                feedback.className = 'text-[11px] text-red-600 font-semibold mt-1 block';
            }
            return false;
        }

        if (val.length < 3) {
            el.classList.add('border-amber-500', 'bg-amber-50/20');
            el.classList.remove('border-red-500', 'border-emerald-500', 'bg-red-50/20', 'bg-emerald-50/10');
            if (feedback) {
                feedback.textContent = 'Name must be at least 3 characters.';
                feedback.className = 'text-[11px] text-amber-600 font-semibold mt-1 block';
            }
            return false;
        }

        let namePattern;
        try {
            namePattern = /^[\p{L}\s.'-]+$/u;
        } catch (e) {
            namePattern = /^[a-zA-Z\u0600-\u06FF\s.'-]+$/;
        }

        if (!namePattern.test(val)) {
            el.classList.add('border-red-500', 'bg-red-50/20');
            el.classList.remove('border-amber-500', 'border-emerald-500', 'bg-amber-50/20', 'bg-emerald-50/10');
            if (feedback) {
                feedback.textContent = 'Name can only contain letters, spaces, dots, and hyphens.';
                feedback.className = 'text-[11px] text-red-600 font-semibold mt-1 block';
            }
            return false;
        }

        el.classList.remove('border-red-500', 'border-amber-500', 'bg-red-50/20', 'bg-amber-50/20');
        el.classList.add('border-emerald-500', 'bg-emerald-50/10');
        if (feedback) {
            feedback.textContent = '✓ Name looks valid';
            feedback.className = 'text-[11px] text-emerald-600 font-semibold mt-1 block';
        }
        return true;
    }
    window.validateCustomerName = validateCustomerName;

    // 3. Form Submission Guard & Listeners
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('create-customer-form');
        const nameInput = document.getElementById('customer_name');
        const cnicInput = document.getElementById('customer_cnic');

        if (cnicInput) {
            formatCnic(cnicInput);
            ['input', 'keyup', 'paste', 'change'].forEach(evt => {
                cnicInput.addEventListener(evt, function () {
                    formatCnic(this);
                });
            });
        }

        if (nameInput) {
            ['input', 'keyup', 'blur'].forEach(evt => {
                nameInput.addEventListener(evt, function () {
                    validateCustomerName(this);
                });
            });
        }

        if (form) {
            form.addEventListener('submit', function (e) {
                const isNameValid = validateCustomerName(nameInput);
                if (!isNameValid) {
                    e.preventDefault();
                    if (nameInput) nameInput.focus();
                    return false;
                }

                if (cnicInput) {
                    const digits = cnicInput.value.replace(/\D/g, '');
                    if (digits.length !== 13) {
                        e.preventDefault();
                        cnicInput.focus();
                        const feedback = document.getElementById('cnic_feedback');
                        if (feedback) {
                            feedback.textContent = 'Please enter a complete 13-digit CNIC (current: ' + digits.length + ').';
                            feedback.className = 'text-[10px] text-red-600 font-bold mt-0.5';
                        }
                        cnicInput.classList.add('border-red-500');
                        return false;
                    }
                }
            });
        }
    });
</script>
@endsection
