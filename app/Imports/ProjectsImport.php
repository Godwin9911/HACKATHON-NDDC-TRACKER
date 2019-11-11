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
            'PROJECT'     => $row[0],
            'LOCATION'    => $row[1], 
            'DESCRIPTION'    => $row[2], 
        ]);
    }
}
