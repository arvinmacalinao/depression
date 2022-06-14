<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'psi_project_products';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'prod_id';
    protected $fillable = ['prod_name', 'prod_unit', 'unit_id', 'prj_id', 'encoder', 'date_encoded', 'updater', 'last_updated', 'region_id', 'synched', 'sync_date'];
    

    public function scopeProdUnit($query, $prod_unit) 
    {
        if($prod_unit) {
            $query->where('unit_id', $prod_unit);
        }
        
        return $query;
    }
    public function scopeProdSearch($query, $prod_search)
    {
        return $query->where(function($query) use($prod_search) {
             $query->where('prod_name', 'like', "%$prod_search%")->orwhere('unit_id', 'like', "%$prod_search%")
            ->orWhereHas('units', function($units) use($prod_search) {
                $units->where('unit_name', 'like', "%$prod_search%");
                });
        });
    }

    public function units()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_id', 'unit_id');
    }
}
