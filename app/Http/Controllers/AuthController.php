<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $maxAttempts = 3;

        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        $hashedPassword = $credentials['password'];
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $hashedPassword])) {
            $user = Auth::user();

            // Check if the user is active
            if ($user->status === 'Aktif') {
                $request->session()->regenerate();

                // Clear login attempts upon successful login
                $this->clearLoginAttempts($request);

                $redirectTo = Role::redirectBasedOnRole($user->role_user);
                return redirect()->route($redirectTo);
            } else {
                Auth::logout();
                return redirect()->route('user.laporkanInsiden')->with('error', 'Your account is not active. Please contact the administrator.');
            }
        }

        // Increment login attempts upon failed login
        $this->incrementLoginAttempts($request);

        // Check if login attempts have exceeded the maximum
        if ($this->hasExceededMaxAttempts($request, $maxAttempts)) {
            return redirect()->route('user.laporkanInsiden')->with('error', 'Please contact the admin. Your account is temporarily locked. Please try again later.');
        }

        // Authentication failed
        return redirect()->route('user.laporkanInsiden')->with('error', 'Please check your username and password');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.laporkanInsiden');
    }

    // Increment login attempts and update user status if necessary
    protected function incrementLoginAttempts(Request $request)
    {
        $key = $this->getLoginAttemptsKey($request);

        $attempts = cache($key, 0);

        if ($attempts + 1 >= 3) {
            // Update user status to "Tidak Aktif" if exceeded max attempts
            User::where('email', $request->input('email'))->update(['status' => 'Tidak Aktif']);
        }

        cache([$key => $attempts + 1], now()->addMinutes(5));
    }

    // Clear login attempts
    protected function clearLoginAttempts(Request $request)
    {
        $key = $this->getLoginAttemptsKey($request);
        cache()->forget($key);
    }

    // Check if login attempts have exceeded the maximum
    protected function hasExceededMaxAttempts(Request $request, $maxAttempts)
    {
        $key = $this->getLoginAttemptsKey($request);
        $attempts = cache($key, 0);

        return $attempts >= $maxAttempts;
    }

    // Generate a unique key for tracking login attempts
    protected function getLoginAttemptsKey(Request $request)
    {
        return 'login_attempts_' . sha1($request->ip() . $request->input('email'));
    }
}
