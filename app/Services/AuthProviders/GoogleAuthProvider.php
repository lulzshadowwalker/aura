
<?php

namespace App\Services\AuthProviders;

use App\Contracts\AuthProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
            ]);

            if ($avatar = $googleUser->getAvatar()) {
                $user->addMediaFromUrl($avatar)
                    ->toMediaCollection();
            }

            $user->customer()->create();

            Auth::login($user);
            DB::commit();
            return redirect('/')->with('success', 'Logged in successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/')->with('error', 'Failed to log in: ' . $e->getMessage());
        }
    }
}
