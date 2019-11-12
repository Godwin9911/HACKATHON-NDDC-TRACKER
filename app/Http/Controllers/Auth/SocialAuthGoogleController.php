<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Socialite;
use Exception;

class SocialAuthGoogleController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }
    public function expireTime() {
        $myTTL = 120960; //minutes
        return $this->jwt->factory()->setTTL($myTTL);
    }

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
                $this->expireTime();
                $verifycode = mt_rand(100000,999999);
                $existUser = User::where('email', $googleUser->email)->first();

                if($existUser) {
                    $on_platform_check = User::where('email', $googleUser->email)->where('google_id', $googleUser->id)->first();
                    if($on_platform_check) {
                        $token = Auth::guard()->login($existUser);
                    }else {
                        return redirect()->to('https://hackanthon-258716.firebaseapp.com/retrieve-data.html?status=true&code=403&message=Not-allowed');
                    }
                }
                else {
                    $user = new User;
                    $user->name  = $googleUser->name;
                    $user->email = $googleUser->email;
                    $user->image = $googleUser->avatar;
                    $user->google_id = $googleUser->id;
                    $user->email_verified_at = date("Y-m-d H:i:s");
                    $user->user_type = 'community_member';
                    $user->role = '1';
                    $user->accept_terms =  'yes';
                    $user->verifycode = $verifycode;
                    $user->save();
                    $token = Auth::guard()->login($user);
                }
                return redirect()->to('https://hackanthon-258716.firebaseapp.com/retrieve-data.html?status=true&code=200&auth='.$token);
            } 
            catch (Exception $e) {
                return redirect()->to('https://hackanthon-258716.firebaseapp.com/retrieve-data.html?status=false&code=501&error='.$e->getMessage());
            }
        }else {
            return redirect()->to('https://hackanthon-258716.firebaseapp.com');
        }
    }
}
