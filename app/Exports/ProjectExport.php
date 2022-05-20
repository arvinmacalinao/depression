<?php

namespace App\Exports;

use App\Models\PsiProject;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProjectExport implements FromCollection
{

    protected $psi_projects;
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($psi_projects)
    {
        $this->psi_projects = $psi_projects;
    }

    public function collection()
    {
        return $this->psi_projects;
    }
}
