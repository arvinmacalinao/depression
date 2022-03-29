<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class psi_projects extends Model
{
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $guarded = [];
}
