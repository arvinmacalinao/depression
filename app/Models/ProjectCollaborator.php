<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCollaborator extends Model
{
    protected $table = 'psi_project_collaborators';

    // public function collaborators(){
    //     return $this->belongsTo('App\Models\PsiProject', 'prj_id', 'prj_id');
    // }

    public function collaborator()
    {
        return $this->belongsTo('App\Models\Collaborator', 'col_id', 'col_id');
    } 
}
