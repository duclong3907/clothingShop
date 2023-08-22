<?php

namespace App\Http\Controllers\Google;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function googlepage(){

        return socialite::driver('google')->redirect();
    }

    public function googlecallback(){
        try{
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('/redirect');
            }
            else{
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->password = encrypt('12345678');
                $newUser->save();

                Auth::login($newUser);

                return redirect()->intended('/redirect');
            }
        } catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
