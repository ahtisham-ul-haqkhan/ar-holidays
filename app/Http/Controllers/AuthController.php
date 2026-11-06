<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     */
    public function __construct(
        protected AuthService $authService
    ) {}

    /**
     * Display the login interface.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle incoming login request.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $this->authService->validateLogin($request->all());

        if (! $this->authService->attemptLogin($credentials)) {
            throw ValidationException::withMessages([
                'email' => __('These credentials do not match our records.'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'))
            ->with('success', 'Welcome back, ' . (auth()->user()?->name ?? 'Admin') . '!');
    }

    /**
     * Log out the current user session.
     */
    public function logout(Request $request): RedirectResponse
    {
        $this->authService->logout($request);

        return redirect()->route('login')
            ->with('info', 'You have been successfully signed out.');
    }
}

