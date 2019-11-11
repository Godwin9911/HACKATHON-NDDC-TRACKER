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
                return response()->json($googleUser, 200);
                
                $this->expireTime();
                $existUser = User::where('email', $googleUser->email)->where('email', $googleUser->id)->first();

                if($existUser) {
                    Auth::loginUsingId($existUser->id);
                }
                else {
                    $user = new User;
                    $user->name = $googleUser->name;
                    $user->email = $googleUser->email;
                    $user->google_id = $googleUser->id;
                    $user->password = null;
                    $user->save();
                    Auth::loginUsingId($user->id);
                }
                return redirect()->to('https://hackanthon-258716.firebaseapp.com/');
            } 
            catch (Exception $e) {
                return 'error';
            }
        }else {
            return view('welcome');
        }
    }
}
