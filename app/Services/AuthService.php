<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * Terminate user session and regenerate token.
     */
    public function logout(Request $request): void
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}

