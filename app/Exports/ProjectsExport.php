<?php

namespace App\Exports;

use App\Project;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProjectsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Project::all();
    }

    public function headings(): array
    {
        return [
            'PROJECT',
            'LOCATION',
            'DESCRIPTION',
        ];
    }

    public function map($project): array
    {
        return [
            $project->PROJECT,
            $project->LOCATION,
            $project->DESCRIPTION,
        ];
    }
}
