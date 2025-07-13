<?php

namespace App\Services\AuthProviders;

use App\Contracts\AuthProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleAuthProvider implements AuthProvider
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
{
    try {
        DB::beginTransaction();
        $googleUser = Socialite::driver('google')->user();

        // Try to find user by google_id
        $user = User::where('google_id', $googleUser->id)->first();

        if (!$user) {
            // If not found, try to find by email
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Update google_id if user exists by email
                $user->update([
                    'google_id' => $googleUser->id,
                    'name' => $googleUser->getName(),
                ]);
            } else {
                // Create new user if not found by email
                $user = User::create([
                    'google_id' => $googleUser->id,
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(32)),
                ]);
            }
        }

        if ($avatar = $googleUser->getAvatar()) {
            $user->addMediaFromUrl($avatar)
                ->toMediaCollection();
        }

        // Create customer if not exists
        if (!$user->customer) {
            $user->customer()->create();
        }

        Auth::login($user);
        DB::commit();
        return redirect('/')->with('success', 'Logged in successfully!');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect('/')->with('error', 'Failed to log in: ' . $e->getMessage());
    }
}

}
