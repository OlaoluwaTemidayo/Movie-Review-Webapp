<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/movies';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // Validate the login request
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Retrieve the credentials from the request
        $credentials = $request->only('email', 'password');

        // Log the login attempt for debugging
        Log::info('Login attempt:', $credentials);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            Log::info('Login successful for:', $credentials);
            return redirect()->intended($this->redirectTo);
        }

        // Log the failed attempt
        Log::warning('Failed login attempt for:', $credentials);

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // This method can be customized if needed
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
}