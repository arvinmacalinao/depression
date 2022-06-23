<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForaCollaborator extends Model
{
    protected $table = 'psi_fora_collaborators';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'fcol_id';
    protected $fillable = ['fr_id', 'col_id', 'fcol_timestamp', 'region_id', 'synched', 'sync_date', 'date_encoded', 'last_updated', 'encoder', 'updater'];
}
