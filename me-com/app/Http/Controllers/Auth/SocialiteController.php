<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{

    public function facebookRedirect()
    {
        return  Socialite::driver('facebook')
        ->redirect();
    }

    public function facebookCallback()
    {
        try{
            $userSocial = Socialite::driver('facebook')->user();
            if(User::where('email', $userSocial->email)->exists()){
                $user = User::where('email', $userSocial->email)->first();
            }
            $user = User::where(
                [
                    'provider' => 'facebook',
                    'provider_id' => $userSocial->id
                ]
            )->first();
            if(!$user){
                $user = User::create([
                    'name' => $userSocial->name,
                    'email' => $userSocial->email,
                    'username' => $userSocial->nickname,
                    'photo' => $userSocial->avatar,
                    'provider' => 'facebook',
                    'provider_id' => $userSocial->id,
                    'provider_token' => $userSocial->token,
                    'email_verified_at' => now(),
                ]);
            }


        }catch(\Exception $e){
            return redirect()->route('register')->with('error', 'facebook authentication failed.');

        }


            Auth::login($user);

            return redirect('/dashboard');
            // $user->token
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

        } catch (\Exception $e) {
            return redirect()->route('register')->with('error', 'Google authentication failed.');
        }
}
    public  function redirect ($provider) {
        return Socialite::driver($provider)->redirect();
    }
   public  function callback($provider) {
    try{
        $userSocial = Socialite::driver($provider)->user();
        if(User::where('email', $userSocial->email)->exists()){
            $user = User::where('email', $userSocial->email)->first();
        }
        $user = User::where(
            [
                'provider' => $provider,
                'provider_id' => $userSocial->id
            ]
        )->first();
        if(!$user){
            $user = User::create([
                'name' => $userSocial->name,
                'email' => $userSocial->email,
                'username' => $userSocial->nickname,
                'photo' => $userSocial->avatar,
                'provider' => $provider,
                'provider_id' => $userSocial->id,
                'provider_token' => $userSocial->token,
                'email_verified_at' => now(),
            ]);
        }


    }catch(\Exception $e){
        return redirect()->route('register')->with('error', 'Google authentication failed.');

    }


        Auth::login($user);

        return redirect('/dashboard');
        // $user->token
    }


}