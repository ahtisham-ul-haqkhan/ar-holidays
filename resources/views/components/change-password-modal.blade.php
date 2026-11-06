<!-- Change Password Modal -->
<div 
    id="change-password-modal" 
    class="fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 transition-all duration-300 {{ (isset($errors) && ($errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation'))) ? '' : 'hidden' }}">
    
    <!-- Modal Card -->
    <div 
        class="bg-white rounded-3xl max-w-lg w-full border border-slate-200/80 shadow-2xl overflow-hidden transform transition-all duration-300 scale-100"
        onclick="event.stopPropagation()">
        
        <!-- Modal Header -->
        <div class="px-6 sm:px-8 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-rose-700 text-white flex items-center justify-center shadow-md shadow-red-600/30">
                    <i class="fa-solid fa-key text-sm"></i>
                </div>
                <div>
                    <h3 class="text-base sm:text-lg font-extrabold text-slate-900 font-heading">
                        Change Account Password
                    </h3>
                    <p class="text-[11px] text-slate-400 font-medium">
                        {{ auth()->user()->email ?? 'rahman@artravels.com' }}
                    </p>
                </div>
            </div>

            <button 
                type="button" 
                onclick="closeChangePasswordModal()" 
                class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition-colors">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        <!-- Form Body -->
        <form method="POST" action="{{ route('password.update') }}" class="p-6 sm:p-8 space-y-4" autocomplete="off">
            @csrf

            <!-- Current Password -->
            <div class="space-y-1.5">
                <label for="modal_current_password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Current Password <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                        <i class="fa-solid fa-lock text-xs"></i>
                    </span>
                    <input 
                        id="modal_current_password" 
                        type="password" 
                        name="current_password" 
                        required 
                        placeholder="Enter your current password" 
                        class="w-full pl-9 pr-10 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border @error('current_password') border-red-500 bg-red-50/20 @else border-slate-200 @enderror rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all outline-none"
                    >
                    <button 
                        type="button" 
                        onclick="toggleInputVisibility('modal_current_password', 'icon_current_pw')" 
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                        <i id="icon_current_pw" class="fa-solid fa-eye text-xs"></i>
                    </button>
                </div>
                @error('current_password')
                    <p class="text-[11px] text-red-600 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div class="space-y-1.5">
                <label for="modal_new_password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    New Password <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                        <i class="fa-solid fa-shield-halved text-xs"></i>
                    </span>
                    <input 
                        id="modal_new_password" 
                        type="password" 
                        name="password" 
                        required 
                        oninput="validatePasswordStrength(this.value)"
                        placeholder="Choose a strong new password" 
                        class="w-full pl-9 pr-10 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border @error('password') border-red-500 bg-red-50/20 @else border-slate-200 @enderror rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all outline-none"
                    >
                    <button 
                        type="button" 
                        onclick="toggleInputVisibility('modal_new_password', 'icon_new_pw')" 
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                        <i id="icon_new_pw" class="fa-solid fa-eye text-xs"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-[11px] text-red-600 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm New Password -->
            <div class="space-y-1.5">
                <label for="modal_confirm_password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Confirm New Password <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                        <i class="fa-solid fa-check-double text-xs"></i>
                    </span>
                    <input 
                        id="modal_confirm_password" 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        placeholder="Re-type your new password" 
                        class="w-full pl-9 pr-10 py-2.5 bg-slate-50 hover:bg-slate-100/60 focus:bg-white text-xs font-medium text-slate-900 border @error('password_confirmation') border-red-500 bg-red-50/20 @else border-slate-200 @enderror rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all outline-none"
                    >
                    <button 
                        type="button" 
                        onclick="toggleInputVisibility('modal_confirm_password', 'icon_confirm_pw')" 
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                        <i id="icon_confirm_pw" class="fa-solid fa-eye text-xs"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="text-[11px] text-red-600 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Rules Dynamic Checklist (Placed Below Confirm New Password) -->
            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Security Requirements:</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5 text-[11px]">
                    <div id="rule-length" class="flex items-center gap-1.5 text-slate-500 transition-colors">
                        <i class="fa-solid fa-circle-dot text-[9px] rule-icon"></i>
                        <span>8 to 64 characters</span>
                    </div>
                    <div id="rule-number" class="flex items-center gap-1.5 text-slate-500 transition-colors">
                        <i class="fa-solid fa-circle-dot text-[9px] rule-icon"></i>
                        <span>At least 1 numeric (0-9)</span>
                    </div>
                    <div id="rule-special" class="flex items-center gap-1.5 text-slate-500 transition-colors sm:col-span-2">
                        <i class="fa-solid fa-circle-dot text-[9px] rule-icon"></i>
                        <span>At least 1 special character (@$!%*#?&...)</span>
                    </div>
                </div>
            </div>

            <!-- Modal Action Buttons -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <button 
                    type="button" 
                    onclick="closeChangePasswordModal()" 
                    class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                    Cancel
                </button>
                <button 
                    type="submit" 
                    class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold uppercase tracking-wider shadow-md shadow-red-600/30 transition-all flex items-center gap-2 transform active:scale-95">
                    <i class="fa-solid fa-check"></i>
                    <span>Update Password</span>
                </button>
            </div>

        </form>

    </div>
</div>

<script>
    function openChangePasswordModal() {
        const modal = document.getElementById('change-password-modal');
        modal.classList.remove('hidden');
        setTimeout(() => {
            document.getElementById('modal_current_password').focus();
        }, 100);
    }

    function closeChangePasswordModal() {
        const modal = document.getElementById('change-password-modal');
        modal.classList.add('hidden');
    }

    // Close on ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeChangePasswordModal();
        }
    });

    // Toggle password eye visibility
    function toggleInputVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Dynamic real-time validation indicator
    function validatePasswordStrength(val) {
        const lengthValid = val.length >= 8 && val.length <= 64;
        const numberValid = /[0-9]/.test(val);
        const specialValid = /[^A-Za-z0-9]/.test(val);

        updateRuleStyle('rule-length', lengthValid);
        updateRuleStyle('rule-number', numberValid);
        updateRuleStyle('rule-special', specialValid);
    }

    function updateRuleStyle(elementId, isValid) {
        const el = document.getElementById(elementId);
        const icon = el.querySelector('.rule-icon');
        if (isValid) {
            el.classList.remove('text-slate-500');
            el.classList.add('text-emerald-600', 'font-semibold');
            icon.classList.remove('fa-circle-dot');
            icon.classList.add('fa-circle-check');
        } else {
            el.classList.remove('text-emerald-600', 'font-semibold');
            el.classList.add('text-slate-500');
            icon.classList.remove('fa-circle-check');
            icon.classList.add('fa-circle-dot');
        }
    }
</script>
