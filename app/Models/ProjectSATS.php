<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSATS extends Model
{
    protected $table = 'psi_project_sats';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 
    protected $primaryKey = 'sat_id';
    protected $fillable = ['sat_date', 'sat_file', 'sat_filename', 'sat_remarks', 'satt_id', 'prj_id', 'encoder', 'date_encoded', 'updater', 'last_updated', 'region_id', 'synched', 'sync_date'];

    // public function type()
    // {
    //     return $this->belongsTo('App\Models\ProjectDocumentationType', 'doctype_id', 'doctype_id');
    // }
    
    // public function scopeDocumentationType($query, $doc_type) 
    // {
    //     if($doc_type) {
    //         $query->where('doctype_id', $doc_type);
    //     }
    //     return $query;
    // }

    // public function scopeDocumentationSearch($query, $doc_search)
    // {
    //     return $query->where(function($query) use($doc_search) {
    //          $query->where('doc_file', 'like', "%$doc_search%")->orwhere('doc_filename', 'like', "%$doc_search%")
    //          ->orwhere('doc_remarks', 'like', "%$doc_search%")->orWhereHas('type', function($type) use($doc_search) {
    //             $type->where('doctype_name', 'like', "%$doc_search%");
    //             });
    //     });
    // }

    public function document1()
    {
        if(\Storage::disk('uploads')->exists('documents/'.$this->doc_file)) {
            return asset('storage/uploads/documents/'.$this->doc_file);
        }
    }
}
