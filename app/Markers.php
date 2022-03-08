<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Markers extends Model
{
    //Table Name
    protected $table = "map_markers";
    //Prmary Key
    public $primaryKey = 'id';
}
