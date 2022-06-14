<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentCategories extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 

    protected $table = 'psi_project_document_types';
    protected $primaryKey = 'doctype_id';

    public function scopeDocumentSearch($query, $doctype_name){
        $query->where(function($query) use($doctype_name){
            $query->where('doctype_name', 'like', "%$doctype_name%");
        });
    }

    

}
