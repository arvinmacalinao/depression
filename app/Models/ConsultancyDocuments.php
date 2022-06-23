<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultancyDocuments extends Model
{
    protected $table = 'psi_consultancy_documents';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'condoc_id';
    protected $fillable = ['con_id', 'condoc_file', 'condoc_filename', 'condoc_remarks', 'encoder', 'date_encoded', 'updater', 'last_updated', 'region_id', 'synched', 'sync_date'];

    // public function draftlevels()
    // {
    //     return $this->belongsTo('App\Models\DraftLevel', 'draftlevel_id', 'draftlevel_id');
    // }
    
    public function scopeDocSearch($query, $doc_search)
    {
        return $query->where(function($query) use($doc_search) {
             $query->where('condoc_file', 'like', "%$doc_search%")->orwhere('condoc_filename', 'like', "%$doc_search%")
             ->orwhere('condoc_remarks', 'like', "%$doc_search%");
        });
    }

    public function document1()
    {
        if(\Storage::disk('uploads')->exists('documents/'.$this->condoc_file)) {
            return asset('storage/uploads/documents/'.$this->condoc_file);
        }
    }
}
