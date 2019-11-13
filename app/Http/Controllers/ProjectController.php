<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImportExcelController;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Project;
use App\ProjectSave;

class ProjectController extends Controller
{
    public function index() {
        $project = Project::with('comments')
                            ->with('projectlikes')
                            ->get();

        $res['status'] = true;
        $res['project'] =  $project;
        return response()->json($res, 200);
    }

    //Search APi for the user
    public function search($d) {
      $querys = explode(',', $d);
      $result = [];  
     foreach ($querys as $query) {
                     $data = Project::where('PROJECT_TYPE', 'LIKE',  "%{$query}%")
                                 ->orWhere('LOCATION', 'LIKE', "%{$query}%")
                                 ->orWhere('LGA', 'LIKE', "%{$query}%")
                                 ->orWhere('PROJECT_DESCRIPTION', 'LIKE', "%{$query}%")
                                 ->withCount('comments')
                                 ->with('projectlikes')
                                 ->get();

                     array_push($result, $data);            
                }

        $res['status'] = true;
        $res['search'] =    $result;
        return response()->json($res, 200);
    }

    public function store(Request $request) {
            //start temporay transaction
            DB::beginTransaction();

            try{
                $project = Project::create([
                    'PROJECT_TYPE'        =>  $request->input('PROJECT_TYPE'),
                    'LOCATION'        => $request->input('LOCATION'),
                    'LGA'                => $request->input('LGA'),
                    'PROJECT_DESCRIPTION'        => $request->input('PROJECT_DESCRIPTION'),
                    'BUDGET_COST'        => $request->input('BUDGET_COST'),
                    'COMMITMENT'        => $request->input('COMMITMENT'),
                    'STATUS'    =>  'not-completed',
                ]);
    
                $msg['message']   = 'Project created successfully';
                $msg['user']      = $project;

                //if operation was successful save commit save to database
                DB::commit();
                $msg['status'] = 201;
               return response()->json($msg, 200);
    
            }catch(\Exception $e) {
                //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
                DB::rollBack();
    
                $err['error']  = "Error: Account not created, please try again!";
                $err['hint']   = $e->getMessage();
                $err['status'] = 501;
                return response()->json($err, 501);
            }
        }

        public function  savedProject() {
            $user = Auth::user();

            $saved_project = ProjectSave::where('user_id', $user->id)
                                         ->with('project')
                                         ->get();
            $res['status'] = true;
            $res['result'] = $saved_project;

            return response()->json($res, 200);                   

        }
        public function  saveAProject($project_id) {
            $user = Auth::user();

              DB::beginTransaction();

              try{
                   $user = ProjectSave::create([
                        'user_id'      =>  $user->id,
                        'project_id'   =>  $project_id
                    ]);

                    $msg['status'] = 201;
                    return response()->json($res, 200);  
                }catch(\Exception $e) {
                    //if any operation fails, Thanos snaps finger - user was not created rollback what is saved
                    DB::rollBack();

                    $err['error']  = "Error: Account not created, please try again!";
                    $err['hint']   = $e->getMessage();
                    $err['status'] = 501;
                    return response()->json($err, 200);  
                }

        }

        public function destroySavedProject($project_id)
            {
                $findProject = ProjectSave::find($project_id);
                if ($user) {         // removes user account
                    $findProject->delete();
                    $res['message'] = 'Project deleted successfully';
                    return response()->json($res, 200);
                } else {
                    $res['message'] = 'Project unsuccessfully, please try again!';
                    return response()->json($res, 501);
                }
            }

}
