<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Mail\WelcomeMail;

class RegisterController extends Controller
{

    public function community_member(Request $request) {
        $msg = $this->create($request, $user_type='community_member', $role='1');
        return response()->json($msg, $msg['status']);
    }

    public function create($request, $user_type, $role)
    {
        $this->validateRequest($request);
        $verifycode = mt_rand(100000,999999);

        //start temporay transaction
        DB::beginTransaction();

        try{
           $user = User::create([
                'email'        =>  $request->input('email'),
                'image'        =>  'noimage.jpg',
                'password'     =>  Hash::make($request->input('password')),
                'role'         =>  $role,
                'user_type'    =>  $user_type,
                'accept_terms' =>  'yes',
                'verifycode'   =>  $verifycode 
            ]);

            $msg['message']   = 'Account created successfully';
            $msg['message-2'] = 'A verification code has been sent to your email, please use to veriify your account, also check your spam folder for email';
            $msg['user']      = $user;

            //Send a mail form account verification
            Mail::to($user->email)->send(new WelcomeMail($user));
            //if operation was successful save commit save to database
            DB::commit();
            $msg['status'] = 201;
            return $msg;

        }catch(\Exception $e) {
            //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
            DB::rollBack();

            $err['error']  = "Error: Account not created, please try again!";
            $err['hint']   = $e->getMessage();
            $err['status'] = 501;
            return $err;
        }
    }

    public function validateRequest(Request $request){
            $rules = [
                'email'        => 'required|email|unique:users',
                'name'         => 'required|string',
                'password'     => 'required|min:8',
            ];
            $messages = [
                'required' => ':attribute is required',
                'email'    => ':attribute not a valid format',
            ];
        $this->validate($request, $rules, $messages);
    }
}
