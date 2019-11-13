<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Setting;
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
        $res['token'] = 'Bearer '. $token;
        $res['token_type'] = 'bearer';
        $res['expires_in(minutes)'] = auth()->factory()->getTTL();

        return response()->json($res, 200);
    }

    public function all()
    {	
		$all = [];
        $community_members = [];
        $contractors = [];
        $reviewers = [];

        $users = User::with(['comments' => function ($query) {
            $query->with('projects');
		}])->get();
		
        array_push($all, $users);

        foreach ($users as $user) {
            if ($user->role == 1) {
                array_push($contractors, $user);
            } else if ($user->role == 2) {
                array_push($reviewers, $user);
            }else if ($user->role == 3) {
                array_push($community_members, $user);
            }
        }
        $res['status']    = true;
        $res['contractors']  = $contractors;
        $res['reviewers'] = $reviewers;
        $res['community_members']  = $community_members;
        $res['all']    = $all;
        return response()->json($res, 200);
    }
    
    public function showOne($id) {
        $user = User::where('id', $id)->get();
        $res['status'] = true;
        $res['user'] = $user;
        return response()->json($res, 200);
    }

  
    public function update(Request $request, ImageController $image)
    {  // update user information
        $user = Auth::user();

        $this->validate($request, [
            'bio' => 'nullable|string',
            'gender' => 'string',
            'city'    => 'nullable|string',
            'country' => 'nullable|string',
            'email'    => 'nullable|unique:users,email,' . $user->id,
            'name'     => 'required|string'
        ]);


        //start temporay transaction
        DB::beginTransaction();
        try {
            $user->bio      = $request->input('bio');
            $user->gender  = $request->input('gender');
            $user->email     = $request->input('email');
            $user->city  = $request->input('city');
            $user->country  = $request->input('country');
            $user->name     = $request->input('name');

            //Upload image
            $data = null;
            if ($request->hasFile('image')) {
                $data = $this->upload($request, $image, $user);
                if ($data['status_code'] !=  200) {
                    return response()->json($data, $data['status_code']);
                }
                $user->image = $data['image'];
            }

            $user->save();

            //if operation was successful save commit save to database
            DB::commit();
            $res['status']  = true;
            $res['user']    = $user;
            $res['image_info']   = $data;
            $res['message'] = 'Your Account Was Successfully Updated';

            return response()->json($res, 200);
        } catch (\Exception $e) {
            //rollback what is saved
            DB::rollBack();

            $res['status'] = false;
            $res['message'] = 'An Error Occured While Trying To Update Your Account Information';
            $res['hint'] = $e->getMessage();

            return response()->json($res, 501);
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $this->validatePassword($request);

        $old_password = $request->input('old_password');
        $password = $request->input('password');

        if($user->user_mode == 'nddc-tracker'){
            $checker = Hash::check($old_password, $user->password);

            if($checker) {
    
                $user->password = Hash::make($password);
                $user->save();
    
                $msg['success'] = 'Password Changed Successfully';
                return response()->json($msg, 200);
            } else {
                $msg['error'] = 'Invalid Credentials';
                return response()->json($msg, 400);
            }
        }

    }
    public function setting(Request $request, Setting $setting)
    {
        $user = Auth::user();

        $this->validate($request, [
            'feedback_update' => 'string|regex:/(^([no,yes]+)?$)/u',
            'saved_project_update' => 'string|regex:/(^([no,yes]+)?$)/u',
            'project_location_update'    => 'string|regex:/(^([no,yes]+)?$)/u',
            'new_project_update' => 'string|regex:/(^([no,yes]+)?$)/u',
            'newsletter_update'    => 'string|regex:/(^([no,yes]+)?$)/u',
        ]);

        try{
            $setting->feedback_update      = $request->input('feedback_update');
            $setting->saved_project_update  = $request->input('saved_project_update');
            $setting->project_location_update     = $request->input('project_location_update');
            $setting->new_project_update  = $request->input('new_project_update');
            $setting->newsletter_update  = $request->input('newsletter_update');
            $setting->user_id  =  $user->id;
            $setting->save();

            $msg['success'] = 'Setting Updated Successfully';
            $msg['setting'] = $setting;
            return response()->json($msg, 200);

         } catch (\Exception $e) {

            //rollback what is saved
            DB::rollBack();

            $res['status'] = false;
            $res['message'] = 'An Error Occured While Trying To Update Your Account Information';
            $res['hint'] = $e->getMessage();

            return response()->json($res, 501);
        }

    }

    public function check() {
        $user = Auth::user();

        if($user){
            return response()->json(200);
        }else {
            return response()->json(401);
        }
    }

    public function destroy()
    {
        $user = Auth::user();

        if ($user) {         // removes user account
            $user->delete();
            $res['message'] = 'User deleted successfully';
            return response()->json($res, 200);
        } else {
            $res['message'] = 'User unsuccessfully, user not found or an error occured, please try again!';
            return response()->json($res, 501);
        }
    }

    public function validatePassword(Request $request)
    {
       $rules = [
        'old_password'=> 'required|string',
        'password' => 'required|min:8|different:old_password|confirmed'
        ];
        $messages = [
            'required' => ':attribute is required'
        ];
        $this->validate($request, $rules);
    }


    public function upload($request, $image)
    {
        $user = Auth::user();

        $this->validate($request, [
            'image' => "image|max:4000",
        ]);
        //Image Engine
        $res = $image->imageUpload($request, $user);
        return $res;
    }
}
