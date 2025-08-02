<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthProviders\GoogleAuthProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function __construct(private readonly GoogleAuthProvider $google)
    {
        //
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
        ]);

        // For now, we'll just log the phone number
        Log::info('OTP requested for: ' . $request->phone_number);

        return response()->json(['message' => 'OTP sent successfully']);
    }

    public function redirectToGoogle()
    {
        return $this->google->redirect();
    }

    public function handleGoogleCallback()
    {
        return $this->google->callback();
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
