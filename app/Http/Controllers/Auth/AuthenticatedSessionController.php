<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

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
        $request->authenticate(); // Otentikasi user

        $request->session()->regenerate(); // Regenerasi session--------------------------------------

        $user = Auth::user();

        if ($user->role === UserRole::Admin) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === UserRole::Penjual) {
            return redirect()->route('penjual.cek-status');
        } else {
            return redirect()->route('pembeli.dashboard');
        }

        // return redirect()->intended($redirectRoute);
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
