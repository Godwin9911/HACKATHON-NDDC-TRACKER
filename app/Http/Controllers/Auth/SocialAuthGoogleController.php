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
        $state = $request->query('state');
        if($state) {
            try {
        
                $googleUser = Socialite::driver('google')->user();
                $existUser = User::where('email',$googleUser->email)->first();
                
                
    
                if($existUser) {
                    return reponse()->json($existUser, 200);
                }else {
                    return reponse()->json('Not Found', 404);
                }
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
        }else {
            return view('welcome');
        }
    }
}
