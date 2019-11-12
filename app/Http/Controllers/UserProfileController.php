<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserProfileController extends Controller
{
    //

    public function index() {
        $user = Auth::user();
        $token = Auth::guard()->login($user);
        
        $res['status'] = true;
        $res['user'] = $user;
        $msg['token'] = 'Bearer '. $token;
        $msg['token_type'] = 'bearer';
        $msg['expires_in(minutes)'] = auth()->factory()->getTTL();

        return response()->json($res, 200);
    }

    public function all() {
       $user = User::all();
       $res['status'] = true;
       $rs['message'] = 'All user in the website';
    }

    public function role() {

    }

    public function update() {

    }
    
    public function destroy() {

    }
}
