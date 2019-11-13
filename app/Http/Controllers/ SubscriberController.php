<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Subscriber;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscriber = Subscriber::all();
        return response()->json($subscriber);
    }


    public function send(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email'  =>  'required|email',
        ]);

        if ($validator->fails()) {

            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        } else {
        	$check_exist =Subscriber::where('email', $request->email)->exists();
        	if($check_exist){
        		    return response()->json(['message' => 'Already Subscribed!'], 400);
        	}else {
        		$data = array(
                   'email' => $request->email
	            );

	            Subscriber::create($data);
	            return response()->json(['message' => 'Thanks for contacting us!']);
        	}

        }
    }

    public function show($id)
    {
        $subscriber = Support::where('id', $id)->first();

        return response()->json(['message' => 'One subscribers message', 'support' => $subscribers]);
    }
    public function destroy($id)
    {
        $subscriber = Support::where('id', $id)->first();
        $support->delete();
        return response()->json(['message' => 'subscribers Message was successfully deleted']);
    }
}

}
