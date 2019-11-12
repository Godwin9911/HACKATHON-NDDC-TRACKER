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
        
        $res['status'] = true;
        $res['user'] = $user;
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
