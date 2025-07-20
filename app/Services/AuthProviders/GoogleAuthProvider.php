<?php

namespace App\Services\AuthProviders;

use App\Contracts\AuthProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Log;

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
                ->toMediaCollection(User::MEDIA_COLLECTION_AVATAR);
        }

        // Create customer if not exists
        if (! $user->customer) {
            $user->customer()->create();
        }

        Auth::login($user);
        DB::commit();
        return redirect('/')->with('success', 'Welcome back, ' . $user->name . '!');
    } catch (Exception $e) {
        Log::error('Google login error: ' . $e->getMessage(), [
            'user_id' => $googleUser?->id ?? null,
            'email' => $googleUser?->getEmail() ?? null,
        ]);

        DB::rollBack();
        return redirect('/')->with('error', 'Failed to log in. Please try again later.');
    }
}

}
