<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;
use Exception;

class SocialAuthGoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback(Request $request)
    {
            try {
        
                $googleUser = Socialite::driver('google')->user();
                return response()->json($googleUser, 200);
                $existUser = User::where('email',$googleUser->email)->first();
                
    
                // if($existUser) {
                //     Auth::loginUsingId($existUser->id);
                // }
                // else {
                //     $user = new User;
                //     $user->name = $googleUser->name;
                //     $user->email = $googleUser->email;
                //     $user->google_id = $googleUser->id;
                //     $user->password = md5(rand(1,10000));
                //     $user->save();
                //     Auth::loginUsingId($user->id);
                // }
                // return redirect()->to('https://hackanthon-258716.firebaseapp.com/');
            } 
            catch (Exception $e) {
                return 'error';
            }
    }
}
