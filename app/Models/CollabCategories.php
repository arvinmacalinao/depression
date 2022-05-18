<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollabCategories extends Model
{
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 
    
    protected $table = 'psi_organization_types';
    protected $primaryKey = 'ot_id';
}
