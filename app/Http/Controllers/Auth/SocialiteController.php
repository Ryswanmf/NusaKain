<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = \Laravel\Socialite\Facades\Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)
                            ->orWhere('email', $user->email)
                            ->first();

            if ($finduser) {
                // Update google_id if not present but email matches
                if (!$finduser->google_id) {
                    $finduser->update([
                        'google_id' => $user->id,
                        'avatar' => $user->avatar
                    ]);
                }
                
                Auth::login($finduser);
                
                if ($finduser->isAdmin()) {
                    return redirect()->intended('/dashboard');
                }
                return redirect()->intended('/');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'avatar' => $user->avatar,
                    'password' => Hash::make(Str::random(24)),
                    'role' => 'user'
                ]);

                Auth::login($newUser);

                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat masuk dengan Google.');
        }
    }
}
