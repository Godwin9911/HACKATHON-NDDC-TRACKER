<?php

namespace App\Imports;

use App\Project;
use Maatwebsite\Excel\Concerns\ToModel;

class ProjectsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Project([
            'PROJECT_TYPE'     => $row[0],
            'LOCATION'    => $row[1], 
            'LGA'    => $row[2], 
            'PROJECT_DESCRIPTION'    => $row[3], 
            'BUDGET_COST'    => $row[4], 
            'COMMITMENT'    => $row[5], 
            'AMOUNT_APPROVED_2016'    => $row[6], 
            'AMOUNT_APPROVED_2017'    => $row[7],
            'STATUS'    => $row[8],
        ]);
    }
}
