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
    

    public function scopeEqBrand($query, $eq_brand) 
    {
        if($eq_brand) {
            $query->where('brand_id', $eq_brand);
        }
        return $query;
    }
    public function scopeEqSearch($query, $eq_search)
    {
        return $query->where(function($query) use($eq_search) {
             $query->where('eqp_property_no', 'like', "%$eq_search%")->orwhere('eqp_specs', 'like', "%$eq_search%")
            ->orwhere('eqp_remarks', 'like', "%$eq_search%")->orwhere('eqp_qty', 'like', "%$eq_search%")
            ->orWhereHas('brands', function($brands) use($eq_search) {
                $brands->where('brand_name', 'like', "%$eq_search%");
                })
            ->orWhereHas('improvements', function($improvements) use($eq_search) {
                    $improvements->where('imp_name', 'like', "%$eq_search%");
                });
        });
    }

    public function brands()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'brand_id');
    }

    public function improvements()
    {
        return $this->belongsTo('App\Models\Improvement', 'imp_id', 'imp_id');
    }

    public function suppliers()
    {
        return $this->belongsTo('App\Models\ServiceProvider', 'sp_id', 'sp_id');
    }
}
