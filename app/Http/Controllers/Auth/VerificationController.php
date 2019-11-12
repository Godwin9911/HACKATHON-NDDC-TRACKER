<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
      //generate new password for the user
        public function generatedPassword()
        {
            return substr(md5(time()), 0, 6);
        }

        public function verify(Request $request, User $user) {

            $this->validate($request, [
                'verifycode' => 'required|max:6'
            ]);

            $verifycode = $request->input('verifycode');

            $checkCode = User::where('verifycode', $verifycode)->exists();

            if ($checkCode) {

                $user = User::where('verifycode', $verifycode)->first();

                $token = Auth::guard()->login($user);
            
                if ($user->email_verified_at == null){
                    //generate a new verify code 
                    $user->verifycode = $this->generatedPassword();
                    $user->email_verified_at = date("Y-m-d H:i:s");
                    $user->save();
                    
                    $msg["message"] = "Account is verified. You can now login.";
                    $msg['verified'] = "True";
                    $msg['user'] = $user;
                    $msg['token'] = 'Bearer ' . $token;
                    $msg['image_link'] = 'https://res.cloudinary.com/getfiledata/image/upload/';
                    $msg['image_format'] = 'w_200,c_thumb,ar_4:4,g_face/';
                    $msg['token_type'] = 'bearer';
                    $msg['expires_in(minutes)'] = auth()->factory()->getTTL();

                    return response()->json($msg, 200);
                    
                } else {
                    $msg["message"] = "Account verified already. Please Login";
                    $msg['note'] = 'please redirect to login page';
                    $msg['verified'] = "Done";

                    return response()->json($msg, 208);
                }

            } else{

                $msg["message"] = "Account with code does not exist!";

                return response()->json($msg, 400);

            }
                
            
        }

        public function resedToken(Request $request) {
            // Do a validation for the input
            $this->validate($request, [
                'email' => 'required',
            ]);
    
               $user = User::where('email', $request->input('email'))->where('google_id', null)->first();
               if ($user == null) {
                    $res['success'] = false;
                    $res['message'] = 'User not found!';
                    return response()->json($res, 400);
               }else {
                 //start temporay transaction
                    DB::beginTransaction();
                    try{
                        //Send Sms to new phone number
                        //We use mail for now untill sms is implemented
                        Mail::to($user->email)->send(new VerifyToken($user));
                        //Commit changes 
                        DB::commit();
    
                        $res['success'] = true;
                        $res['message'] = 'OTP token has been sent. Please check your email to verify account!';
                        return response()->json($res, 200);
    
                      } catch (\Exception $e) {
    
                        //Rollback if there is an erro
                        DB::rollBack();
                        $res['success'] = false;
                        $res['message'] = 'OTP Token not sent. Please try again!';
                        $res['hint']    = $e->getMessage();
                        return response()->json($res, 501);
                     }
               }
        }

}
