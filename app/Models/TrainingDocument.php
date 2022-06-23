<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingDocument extends Model
{
    protected $table = 'psi_fora_documents';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'frdoc_id';
    protected $fillable = ['frdoc_file', 'frdoc_filename', 'frdoc_remarks', 'fdoctype_id', 'fr_id', 'encoder', 'date_encoded', 'updater', 'last_updated', 'region_id', 'synched', 'sync_date'];
    

    // public function draftlevels()
    // {
    //     return $this->belongsTo('App\Models\DraftLevel', 'draftlevel_id', 'draftlevel_id');
    // }
    
    public function scopeTrainDocSearch($query, $tdoc_search)
    {
        return $query->where(function($query) use($tdoc_search) {
             $query->where('frdoc_file', 'like', "%$tdoc_search%")->orwhere('frdoc_filename', 'like', "%$tdoc_search%")
             ->orwhere('frdoc_remarks', 'like', "%$tdoc_search%");
        });
    }
    public function doctypes()
    {
        return $this->belongsTo('App\Models\TrainingDocumentType', 'fdoctype_id', 'fdoctype_id');
    }

    public function document1()
    {
        if(\Storage::disk('uploads')->exists('documents/'.$this->frdoc_file)) {
            return asset('storage/uploads/documents/'.$this->frdoc_file);
        }
    }
}
