<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectBeneficiary extends Model
{
    protected $table = 'psi_project_beneficiaries';

    // public function beneficiaries(){
    //     return $this->belongsTo('App\Models\PsiProject', 'prj_id', 'prj_id');
    // }
    public function cooperator()
    {
        return $this->belongsTo('App\Models\Cooperator', 'coop_id', 'coop_id');
    } 
}
