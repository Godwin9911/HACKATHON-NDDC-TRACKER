<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Exports\ProjectsExport;
use App\Imports\ProjectsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class importExcelController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function indexAsJson()
    {
        $rpoject = Project::all();
        return response()->json(['message' => 'All projects', 'projects' => $rpoject]);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportExcel($type) 
    {
        return Excel::download(new ProjectsExport, 'projects.'.$type);
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExcel(Request $request) 
    {
        try{
            Excel::import(new ProjectsImport,$request->import_file);
            $data = Excel::toArray(new ProjectsImport,$request->import_file);
            $data_count = count($data[0]);

            $result =  DB::table('projects')
                ->orderBy('id', 'desc')
                ->limit($data_count)
                ->get()->toArray();
                
           $result_count = array_key_last( $result );
           //Delete the first entry header form the table 
           Project::where('id',  $result[$result_count]->id)->delete();
           
                
            $res['status']  = true;
            $res['message'] = 'Successful Imported'; 
            return response()->json($res, 200);
        }catch(\Exception $e) {
            $res['status'] = fasle;
            $res['message'] = 'Not implemented, please try gaian!';
            return response()->json($res, 501);
        }
      
    }
}
