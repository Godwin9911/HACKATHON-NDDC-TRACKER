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
            'PROJECT_TYPE',
            'LOCATION',
            'PROJECT_DESCRIPTION',
            'BUDGET_COST',
            'COMMITMENT',
            'AMOUNT_APPROVED_2016',
            'AMOUNT_APPROVED_2017',
            'STATUS',
        ];
    }

    public function map($project): array
    {
        return [
            $project->PROJECT_TYPE,
            $project->LOCATION,
            $project->PROJECT_DESCRIPTION,
            $project->BUDGET_COST,
            $project->COMMITMENT,
            $project->AMOUNT_APPROVED_2016,
            $project->AMOUNT_APPROVED_2017,
            $project->STATUS,
        ];
    }
}
