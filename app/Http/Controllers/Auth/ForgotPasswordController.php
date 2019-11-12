<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\NewPassword;

use App\User;

class ForgotPasswordController extends Controller
{
    //generate verify code for the user
    public function generatedPassword()
    {
         return mt_rand(1000,9999);
    }


    public function password(Request $request)
    {

    // Do a validation for the input
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        $userEmail = $request->input('email');
        $user = User::where('email', $userEmail)->where('google_id', null)->first();

           if ($user == null)
           {
                $res['success'] = false;
                $res['message'] = 'User not found or not permitted!';
                return response()->json($res, 402);
           }
        //start temporay transaction
        DB::beginTransaction();
        try{
            //generate a new verify code 
            $user->verifycode = $this->generatedPassword();
            $user->save();

             Mail::to($user->email)->send(new NewPassword($user));
            //Commit changes 
            DB::commit();

            $res['success'] = true;
            $res['message'] = 'Email has been sent. Please check your email inbox or spam folder for verification token!';
            return response()->json($res, 200); 
          } catch (\Exception $e) {

            //Rollback if there is an erro
             DB::rollBack();
             $res['success'] = false;
             $res['message'] = 'Email not sent. Please try again!';
             $res['hint'] = $e->getMessage();
             return response()->json($res, 501);
          }
    }

}
