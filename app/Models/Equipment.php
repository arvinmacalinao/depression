<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'psi_equipment';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'eqp_id';
    protected $fillable = ['eqp_specs', 'eqp_qty', 'eqp_amount_approved', 'eqp_amount_acquired', 'eqp_property_no', 'eqp_date_acquired', 'eqp_receipt_no', 'eqp_receipt_date', 'eqp_warranty', 'eqp_date_tagged', 'eqp_remarks', 'brand_id', 'prj_id', 'sp_id', 'encoder', 'date_encoded', 'updater', 'last_updated', 'imp_id', 'region_id', 'synched', 'sync_date', 'eqp_specs_acquired', 'eqp_qty_acquired', 'eqp_acquired', 'eqp_acquired_yesno'];
    

    // public function scopeProdUnit($query, $prod_unit) 
    // {
    //     if($prod_unit) {
    //         $query->where('unit_id', $prod_unit);
    //     }
        
    //     return $query;
    // }
    // public function scopeProdSearch($query, $prod_search)
    // {
    //     return $query->where(function($query) use($prod_search) {
    //          $query->where('prod_name', 'like', "%$prod_search%")->orwhere('unit_id', 'like', "%$prod_search%")
    //         ->orWhereHas('units', function($units) use($prod_search) {
    //             $units->where('unit_name', 'like', "%$prod_search%");
    //             });
    //     });
    // }

    public function brands()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'brand_id');
    }

    public function improvements()
    {
        return $this->belongsTo('App\Models\Improvement', 'imp_id', 'imp_id');
    }
}
