<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function index() {
        $user = Auth::user();

        $Comment = Comment::where('user_id', $user->id)
                            ->with('project')
                            ->with('projectlikes')
                            ->get();

        $res['status'] = true;
        $res['project'] =  $project;
        return response()->json($res, 200);
    }

}
