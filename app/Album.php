<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'psi_project_albums';

    public function scopeAlbumSearch($query, $album_name){
        $query->where(function($query) use($album_name){
            $query->where('album_name', 'like', "%$album_name%")
            ->orWhereHas('project', function($project) use($album_name) {
                $project->where('prj_title', 'like', "%$album_name%");
            });
        });
    }

    public function project(){
        return $this->belongsTo('App\Markers', 'prj_id', 'prj_id');
    }
}
