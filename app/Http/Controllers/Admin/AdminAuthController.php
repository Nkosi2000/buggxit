<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle login submission.
     */
    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        // DEBUG: Log attempt details
        Log::debug('Admin login attempt', [
            'email' => $credentials['email'],
            'guard' => 'admin',
        ]);

        // Attempt authentication with the admin guard
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            Log::info('Admin login successful via Laravel auth', [
                'email' => $credentials['email'],
                'admin_id' => Auth::guard('admin')->id(),
            ]);

            return redirect()->intended(route('admin.dashboard'));
        }

        // If we get here, auth failed
        Log::warning('Admin login failed', [
            'email' => $credentials['email'],
            'error' => 'Invalid credentials or guard misconfiguration',
        ]);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        $adminId = Auth::guard('admin')->id();
        
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info('Admin logout', ['admin_id' => $adminId]);

        return redirect('/');
    }
}