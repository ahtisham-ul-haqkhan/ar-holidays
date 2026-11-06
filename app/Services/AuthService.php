<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Validate user login credentials.
     *
     * @param  array<string, mixed>  $data
     * @return array{email: string, password: string, remember: bool}
     *
     * @throws ValidationException
     */
    public function validateLogin(array $data): array
    {
        $validated = Validator::make($data, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Please enter your registered email address.',
            'email.email' => 'Please provide a valid email format.',
            'password.required' => 'Password is required to authenticate.',
        ])->validate();

        $remember = filter_var($data['remember'] ?? false, FILTER_VALIDATE_BOOLEAN)
            || in_array($data['remember'] ?? '', ['on', '1', 1, true, 'true'], true);

        return [
            'email' => (string) $validated['email'],
            'password' => (string) $validated['password'],
            'remember' => (bool) $remember,
        ];
    }

    /**
     * Attempt to authenticate the user.
     *
     * @param  array{email: string, password: string, remember: bool}  $credentials
     */
    public function attemptLogin(array $credentials): bool
    {
        return Auth::attempt(
            [
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ],
            $credentials['remember']
        );
    }

    /**
     * Validate and update the user's password.
     * Requirements: Special character, Numeric digit, Min 8, Max 64, Confirmed.
     *
     * @param  array<string, mixed>  $data
     *
     * @throws ValidationException
     */
    public function updatePassword(User $user, array $data): void
    {
        $validator = Validator::make($data, [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'max:64', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
        ], [
            'current_password.required' => 'Current password is required.',
            'password.required' => 'New password is required.',
            'password.min' => 'New password must be at least 8 characters long.',
            'password.max' => 'New password may not exceed 64 characters.',
            'password.confirmed' => 'New password confirmation does not match.',
            'password_confirmation.required' => 'Please confirm your new password.',
        ]);

        $validator->after(function ($validator) use ($data, $user) {
            // Verify current password
            if (! empty($data['current_password']) && ! Hash::check($data['current_password'], $user->password)) {
                $validator->errors()->add('current_password', 'The provided current password does not match our records.');
            }

            $newPassword = (string) ($data['password'] ?? '');

            if ($newPassword !== '') {
                // Must contain at least one numeric digit
                if (! preg_match('/[0-9]/', $newPassword)) {
                    $validator->errors()->add('password', 'Password must include at least one numeric digit (0-9).');
                }

                // Must contain at least one special character
                if (! preg_match('/[^A-Za-z0-9]/', $newPassword)) {
                    $validator->errors()->add('password', 'Password must include at least one special character (e.g. @$!%*#?&).');
                }
            }
        });

        $validated = $validator->validate();

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);
    }

    /**
     * Terminate user session and regenerate token.
     */
    public function logout(Request $request): void
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
