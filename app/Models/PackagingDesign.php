<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagingDesign extends Model
{
    protected $table = 'psi_packaging_designs';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'design_id';
    protected $fillable = ['design_date', 'design_description', 'draftlevel_id', 'pkg_id', 'design_image1', 'design_image2', 'design_filename1', 'design_filename2', 'region_id', 'synched', 'sync_date', 'date_encoded', 'last_updated', 'encoder', 'updater'];

    public function draftlevels()
    {
        return $this->belongsTo('App\Models\DraftLevel', 'draftlevel_id', 'draftlevel_id');
    }

    public function photo1()
    {
        if(\Storage::disk('uploads')->exists('designs/'.$this->design_image1)) {
            return asset('storage/uploads/designs/'.$this->design_image1);
        }
    }

    public function photo2()
    {
        if(\Storage::disk('uploads')->exists('designs/'.$this->design_image2)) {
            return asset('storage/uploads/designs/'.$this->design_image2);
        }
    }
    

}
