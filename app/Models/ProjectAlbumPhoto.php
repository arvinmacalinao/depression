<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectAlbumPhoto extends Model
{
    protected $table = 'psi_project_album_photos';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'photo_id';
    protected $fillable = ['photo_file', 'photo_filename', 'photo_desc', 'album_id', 'encoder', 'date_encoded', 'updater', 'last_updated', 'region_id', 'synched', 'sync_date'];

    public function albumphotos()
    {
        if(\Storage::disk('uploads')->exists('images/'.$this->photo_file)) {
            return asset('storage/uploads/images/'.$this->photo_file);
        }
    }
}
