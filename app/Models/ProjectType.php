<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{   
    protected $table = 'psi_project_types';
    
    public function prj_name(){
        return $this->belongsTo('App\Models\Project', 'prj_id', 'prj_id');
    }
}
