<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Step 1: Redirect the user to Google's login page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Step 2: Google sends the user back here with their profile info.
     * We either log in an existing account or create a new one.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'email' => 'Something went wrong while logging in with Google. Please try again.',
            ]);
        }

        // Check if a user already signed up with this Google account
        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            // Check if an account already exists with this email (e.g. they registered manually before)
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Link the existing account to this Google ID
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            } else {
                // Brand new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => null,
                    'role' => 'customer',
                ]);
            }
        }

        Auth::login($user, true);

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }
}
