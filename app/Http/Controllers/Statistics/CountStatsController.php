<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\User;
use App\Comment;
use App\Subscriber;
use Carbon\Carbon;

class CountStatsController extends Controller
{
    //Get total number of registered visits on the system 

    public function index(){
        $totalUser = User::count();
        $totalContractors = User::where('role', 1)->count();
        $totalReviewers = User::where('role', 2)->count();
        $totalCommunity = User::where('role', 3)->count();

        $totalProject       =      Project::count();
        $totalComment       =      Comment::count();
        $totalSubcribers    =      Subscriber::count();
        $totalBudget        =      Project::sum('BUDGET_COST');

            $res['totalUser']  = $totalUser;
            $res['totalContractors']  =  $totalContractors;
            $res['totalReviewers']  =  $totalReviewers;
            $res['totalCommunity']  =  $totalCommunity; 
            $res['totalProject']  = $totalProject;
            $res['totalComment']  = $totalComment;
            $res['totalSubcribers']  = $totalSubcribers ;
            $res['totalBudget ']  =  $totalBudget ;
            return response()->json($res, 200);
    }

}
