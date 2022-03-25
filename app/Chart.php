<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    //Table Name
    protected $table = "psi_projects";
    //Prmary Key
    public $primaryKey = 'prj_id';
}
