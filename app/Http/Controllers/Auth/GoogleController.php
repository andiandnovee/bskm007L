<?php
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();   

    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Find   or create user
            $existingUser = User::where('email', $user->email)->first();
            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,   
                    'google_id' => $user->id,
                ]);
                Auth::login($newUser);
            }

            return redirect()->intended('/home');
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
