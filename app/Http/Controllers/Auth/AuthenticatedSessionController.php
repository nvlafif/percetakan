<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $selectedRole = $request->input('role', 'admin');

        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->authenticate();
        }

        $request->session()->regenerate();

        $user = auth()->user();

        if ($selectedRole === 'admin' && ! $user->hasRole('admin')) {
            Auth::logout();

            return back()->withErrors(['email' => 'Akun ini bukan admin.']);
        }

        if ($selectedRole === 'kasir' && ! $user->hasRole('kasir')) {
            Auth::logout();

            return back()->withErrors(['email' => 'Akun ini bukan kasir.']);
        }

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('kasir.dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
