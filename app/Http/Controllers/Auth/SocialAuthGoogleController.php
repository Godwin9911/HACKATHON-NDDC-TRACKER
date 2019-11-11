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
                $existUser = User::where('email', $googleUser->email)->where('google_id', $googleUser->id)->first();

                if($existUser) {
                    $token = Auth::guard()->login($existUser);
                }
                else {
                    $user = new User;
                    $user->name  = $googleUser->name;
                    $user->email = $googleUser->email;
                    $user->image = $googleUser->avatar;
                    $user->google_id = $googleUser->id;
                    $user->verifycode = $verifycode;
                    $user->save();
                    $token = Auth::guard()->login($existUser);
                }
                return redirect()->to('https://hackanthon-258716.firebaseapp.com/dashboard.html?auth='.$token);
            } 
            catch (Exception $e) {
                return response(['error' => $e->getMessage()]);
            }
        }else {
            return view('welcome');
        }
    }
}
