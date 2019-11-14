<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\User;

class CommentController extends Controller
{
    public function index() {
        $user = Auth::user();

        $comment = Comment::where('user_id', $user->id)
                            ->with('project')
                            ->with('commentlikes')
                            ->with('commentreplys')
                            ->with('commentreplylikes')
                            ->get();

        $res['status'] = true;
        $res['project'] =  $comment;
        return response()->json($res, 200);
    }

    public function projectComment($id) {
        $comment = Comment::where('project_id', $id)
                            ->with('commentlikes')
                            ->with('commentreplys')
                            ->with('commentreplylikes')
                            ->get();

        $res['status'] = true;
        $res['project'] = $comment;
        return response()->json($res, 200);
    }

     public function createComment(Request $request, $project_id, $user_id = null, $anonymous = 'no') {

           // Do a validation for the input
        $this->validate($request, [
            'comment' => 'required|string'
        ]);

         //start temporay transaction
        DB::beginTransaction();
        try{
                $comment = new Comment;
                   $comment->comment = $request->input('comment');

                    if($anonymous == 'yes') {
                        $comment->user_name= 'Anonymous';
                     }else {
                        $user = User::where('id', $user_id)->first();
                        $comment->user_id  = $user->id;
                        $comment->user_image = $user->image ?? 'no-image.png';
                        $comment->user_name = $user->name ?? $user->email;
                     }

                      $comment->project_id  = $project_id;
                      $comment->save();

                 DB::commit();
                    $res['status'] = true;
                    $res['message'] = 'Comment created';
                    $res['project'] = $comment;
                    return response()->json($res, 200);

        }catch(\Exception $e) {
            //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
            DB::rollBack();

            $err['error']  = "Error: Comment not created, please try again!";
            $err['hint']   = $e->getMessage();
            $err['status'] = 501;
            return $err;
        }


    }

}
