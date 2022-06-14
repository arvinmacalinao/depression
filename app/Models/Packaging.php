<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
    protected $table = 'psi_packaging';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'pkg_id';
    protected $fillable = ['pkg_date', 'pkg_remarks', 'pkg_product_name', 'pkg_brand_name', 'pkg_product_description', 'pkg_competitors', 'pkg_competitor_1', 'pkg_competitor_2', 'pkg_competitor_3', 'pkg_competitor_4', 'pkg_competitor_5', 'pkg_competitor_6', 'pkg_selling_point', 'pkg_selling_point_others', 'pkg_performance', 'pkg_distribution', 'pkg_ingredients', 'pkg_volume', 'pkg_packaging_material', 'pkg_label_size', 'pkg_preferred_colors', 'pkg_other_details', 'pkg_market_location', 'pkg_market_products_sold', 'pkg_market_date_established', 'pkg_sales_before_intervention', 'pkg_sales_after_intervention', 'pkg_employment_after_direct', 'pkg_employment_after_indirect', 'pkg_employment_after_months_employed', 'pkg_avg_productivity_improvement', 'coop_id', 'prj_id', 'ug_id', 'encoder', 'date_encoded', 'updater', 'last_updated', 'pkg_file', 'pkg_filename', 'pkg_no_new_markets', 'region_id', 'synched', 'sync_date', 'pkg_cost'];
    

    public function sellingpoints()
    {
        return $this->belongsTo('App\Models\SellingPoint', 'pkg_selling_point', 'sp_id');
    }

    public function distributions()
    {
        return $this->belongsTo('App\Models\Distribution', 'pkg_distribution', 'dist_id');
    }

    public function PackagingDesigns()
    {
        return $this->hasMany('App\Models\PackagingDesign', 'pkg_id', 'pkg_id');
    }
}
