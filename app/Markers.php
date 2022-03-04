<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Markers extends Model
{
    protected $fillable = [
        'prj_lat', 'prj_long', 'project_name', 'project_desc'
    ];
}
