<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectAlbum extends Model
{
    protected $table = 'psi_project_albums';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'album_id';
    protected $fillable = ['album_name', 'album_desc', 'album_event_date', 'prj_id', 'date_encoded', 'encoder', 'last_updated', 'updater', 'region_id', 'synched', 'sync_date', 'album_type_id'];
    

    public function type()
    {
        return $this->belongsTo('App\Models\ProjectAlbumType', 'album_type_id', 'album_type_id');
    }

    public function AlbumPhotos()
    {
        return $this->belongsToMany('App\Models\ProjectAlbumPhoto', 'psi_project_album_photos', 'photo_id', 'photo_file', 'photo_filename', 'encoder', 'date_encoded', 'updater', 'last_updated');
    }
    // public function distributions()
    // {
    //     return $this->belongsTo('App\Models\Distribution', 'pkg_distribution', 'dist_id');
    // }

    // public function PackagingDesigns()
    // {
    //     return $this->hasMany('App\Models\PackagingDesign', 'pkg_id', 'pkg_id');
    // }
    public function photos()
    {
        return $this->belingsTo('App\Models\ProjectAlbumPhoto', 'album_id', 'album_id');
    }
}
