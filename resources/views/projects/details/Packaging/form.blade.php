@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@if(Session::has('message'))
<div class="alert alert-success mt-2" role="alert">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>{{ Session::get('message') }}</strong>
</div>
@endif
@include('projects.details.details')
<div class="card">
    <div class="card-header">
        <h3>Projects Packaging & Labeling (Add)
            <div class="pull-right">
                <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Packaging Save', ['id' => $id, 'pack_id' => $pack_id]) }}" method="POST">
            @csrf
            <div class="form-group form-group-sm">
                <label for="prod_name" class="control-label"><Strong>Date *</Strong></label>
                <input class="form-control input-sm date-picker" placeholder="Date" maxlength="10" required="required" name="pkg_date" id="pkg_date" type="text" value="{{ old('pkg_date', $packaging->pkg_date) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="pkg_product_name" class="control-label"><Strong>Product Name *</Strong></label>
                <input class="form-control input-sm" placeholder="Project Name" maxlength="255" required="required" name="pkg_product_name" id="pkg_product_name" type="text" value="{{ old('pkg_product_name', $packaging->pkg_product_name) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="pkg_brand_name" class="control-label"><Strong>Brand Name</Strong></label>
                <input class="form-control input-sm" placeholder="Brand Name" maxlength="255" name="pkg_brand_name" id="pkg_brand_name" type="text" value="{{ old('pkg_brand_name', $packaging->pkg_brand_name) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="pkg_product_description" class="control-label"><strong>Product Description</strong></label>
                <textarea class="form-control input-sm" placeholder="Product Description" name="pkg_product_description" id="pkg_product_description" cols="50" rows="4">{{ old('pkg_product_description', $packaging->pkg_product_description) }}</textarea>
            </div>
            <div class="form-group form-group-sm">
                <label for="pkg_competitors" class="control-label"><strong>What are the product's major competitors?</strong></label>
                <textarea class="form-control input-sm" placeholder="What are the product's major competitors?" name="pkg_competitors" id="pkg_competitors" cols="50" rows="4">{{ old('pkg_competitors', $packaging->pkg_competitors) }}</textarea>
            </div>
            <div class="form-group form-group-sm">
                <label for="pkg_selling_point" class="control-label"><strong>What is your product's selling point?</strong></label>
                
                <div class="radio"><label><input type="radio" name="pkg_selling_point" id="selling_point0" value="1" {{ old('pkg_selling_point', $packaging->pkg_selling_point == '1' ? 'checked' : '') }} checked="checked"> High Overall Quality</label></div>
                <div class="radio"><label><input type="radio" name="pkg_selling_point" id="selling_point1" value="2" {{ old('pkg_selling_point', $packaging->pkg_selling_point == '2' ? 'checked' : '') }}> Health / Safety Factor</label></div>
                <div class="radio"><label><input type="radio" name="pkg_selling_point" id="selling_point2" value="3" {{ old('pkg_selling_point', $packaging->pkg_selling_point == '3' ? 'checked' : '') }}> High Value</label></div>
                <div class="radio"><label><input type="radio" name="pkg_selling_point" id="selling_point3" value="4" {{ old('pkg_selling_point', $packaging->pkg_selling_point == '4' ? 'checked' : '') }}> Convenience</label></div>
                <div class="radio"><label><input type="radio" name="pkg_selling_point" id="selling_point4" value="5" {{ old('pkg_selling_point', $packaging->pkg_selling_point == '5' ? 'checked' : '') }}> Unique (No Competition)</label></div>
                <div class="radio"><label><input type="radio" name="pkg_selling_point" id="selling_point5" value="6" {{ old('pkg_selling_point', $packaging->pkg_selling_point == '6' ? 'checked' : '') }}> Others</label></div>
                <label for="pkg_selling_point_others" class="control-label"><strong>If "Others" is chosen, please specify...</strong></label>
                <textarea class="form-control input-sm" placeholder="If Others is chosen, please specify..." name="pkg_selling_point_others" id="pkg_selling_point_others" cols="50" rows="4">{{ old('pkg_selling_point_others', $packaging->pkg_selling_point_others) }}</textarea>
            </div>
            <div class="form-group form-group-sm">
                <label for="pkg_performance" class="control-label"><strong>How does your product perform against it's competitors in terms of sales?</strong></label>
                <textarea class="form-control input-sm" placeholder="How does your product perform against it's competitors in terms of sales?" name="pkg_performance" id="pkg_performance" cols="50" rows="4">{{ old('pkg_performance', $packaging->pkg_performance) }}</textarea>
            </div>
            <div class="form-group">
                <label for="pkg_distribution" class="control-label"><Strong>Where do you intend to sell your product?</Strong></label>
                <div class="radio"><label><input type="radio" name="pkg_distribution" id="distribution0" value="1" {{ old('pkg_distribution', $packaging->pkg_distribution == '1' ? 'checked' : '') }} checked="checked"> Nationwide</label></div>
                <div class="radio"><label><input type="radio" name="pkg_distribution" id="distribution1" value="2" {{ old('pkg_distribution', $packaging->pkg_distribution == '2' ? 'checked' : '') }}> Local Province/Region</label></div>
                <div class="radio"><label><input type="radio" name="pkg_distribution" id="distribution2" value="3" {{ old('pkg_distribution', $packaging->pkg_distribution == '3' ? 'checked' : '') }}> Export</label></div>
            </div>
            <br>
            <h5>If Applicable (Food, Chemicals...etc)</h5>
            <div class="form-group form-group-sm">
                <label for="performance" class="control-label"><strong>Ingredients</strong></label>
                <textarea class="form-control input-sm" placeholder="Ingredients" name="pkg_ingredients" id="pkg_ingredients" cols="50" rows="4">{{ old('pkg_ingredients', $packaging->pkg_ingredients) }}</textarea>
            </div>
            <div class="form-group form-group-sm">
                <label for="pkg_volume" class="control-label"><strong>Net Weight/Volume</strong></label>
                <input class="form-control input-sm" placeholder="Net Weight/Volume" maxlength="255" name="pkg_volume" id="pkg_volume" type="text" value="{{ old('pkg_volume', $packaging->pkg_volume) }}">
            </div>
        
            <div class="form-group form-group-sm">
                <label for="pkg_packaging_material" class="control-label"><strong>Packaging Material to be used</strong></label>
                <input class="form-control input-sm" placeholder="Packaging Material to be used" maxlength="255" name="pkg_packaging_material" id="pkg_packaging_material" type="text" value="{{ old('pkg_packaging_material', $packaging->pkg_packaging_material) }}">
            </div>
            
            <div class="form-group form-group-sm">
                <label for="pkg_label_size" class="control-label"><strong>Size of Label/Box</strong></label>
                <input class="form-control input-sm" placeholder="Size of Label/Box" maxlength="255" name="pkg_label_size" id="pkg_label_size" type="text" value="{{ old('pkg_label_size', $packaging->pkg_label_size) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="pkg_preferred_colors" class="control-label"><strong>Preferred Colors</strong></label>
                <input class="form-control input-sm" placeholder="Preferred Colors" maxlength="255" name="pkg_preferred_colors" id="pkg_preferred_colors" type="text" value="{{ old('pkg_preferred_colors', $packaging->pkg_preferred_colors) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="pkg_other_details" class="control-label"><strong>Other Specifications/Preference</strong></label>
                <textarea class="form-control input-sm" placeholder="Other Specifications/Preference" name="pkg_other_details" id="pkg_other_details" cols="50" rows="4">{{ old('pkg_other_details', $packaging->pkg_other_details) }}</textarea>
            </div>
            <br>
            <h5>New Markets Penetrated</h5>

            <div class="form-group has-feedback">
                <label for="pkg_no_new_markets" class="control-label"><Strong>No. of New Markets Penetrated</Strong></label>
                <input class="form-control input-sm" placeholder="No. of New Markets Penetrated" maxlength="255" required="required" name="pkg_no_new_markets" id="pkg_no_new_markets" type="number" min="0" step="1" value="{{ old('pkg_no_new_markets', $packaging->pkg_no_new_markets) }}">
            </div>
        
            <div class="form-group has-feedback">
                <label for="pkg_market_location" class="control-label"><strong>New Markets' Locations (One location per line)</strong></label>
                <textarea class="form-control input-sm" cols="45" name="pkg_market_location" id="pkg_market_location"></textarea>
            </div>
        
            <div class="form-group has-feedback">
                <label for="pkg_market_products_sold" class="control-label"><strong>Products Sold</strong></label>
                <input class="form-control input-sm" placeholder="Products Sold" maxlength="255" required="required" name="pkg_market_products_sold" id="pkg_market_products_sold" type="number" min="0" step="any" value="{{ old('pkg_market_products_sold', $packaging->pkg_market_products_sold) }}">
            </div>
        
            <div class="form-group has-feedback">
                <label for="pkg_market_date_established" class="control-label"><strong>Date Established</strong></label>
                <input class="form-control input-sm date-picker" placeholder="Date Established" maxlength="10" name="pkg_market_date_established" id="pkg_market_date_established" type="text" value="{{ old('pkg_market_date_established', $packaging->pkg_market_date_established) }}">
            </div>
        
            <br>
            <h5>Sales</h5>
        
            <div class="form-group">
                <label for="pkg_sales_before_intervention" class="control-label"><strong>Before Intervention</strong></label>
                <input class="form-control input-sm" placeholder="Before Intervention" maxlength="255" required="required" name="pkg_sales_before_intervention" id="pkg_sales_before_intervention" type="number" min="0" step="any" value="{{ old('pkg_sales_before_intervention', $packaging->pkg_sales_before_intervention) }}">
            </div>
        
            <div class="form-group">
                <label for="pkg_sales_after_intervention" class="control-label"><strong>After Intervention</strong></label>
                <input class="form-control input-sm" placeholder="After Intervention" maxlength="255" required="required" name="pkg_sales_after_intervention" id="pkg_sales_after_intervention" type="number" min="0" step="any" value="{{ old('pkg_sales_after_intervention', $packaging->pkg_sales_after_intervention) }}">
            </div>
            <br>

            <div class="form-group">
                <label for="pkg_avg_productivity_improvement" class="control-label"><strong>Average Productivity Improvement</strong></label>
                <input class="form-control input-sm" placeholder="Average Productivity Improvement" maxlength="255" required="required" name="pkg_avg_productivity_improvement" id="pkg_avg_productivity_improvement" type="number" min="0" step="any" value="{{ old('pkg_avg_productivity_improvement', $packaging->pkg_avg_productivity_improvement) }}">
            </div>
        
            <div class="form-group">
                <label for="pkg_cost" class="control-label"><strong>Cost *</strong></label>
                <input class="form-control input-sm" placeholder="Cost" min="0" step="any" required="required" name="pkg_cost" id="pkg_cost" type="number" value="{{ old('pkg_cost', $packaging->pkg_cost) }}">
            </div>
        
            <br>
            <div class="form-group">
                <label for="pkg_file" class="control-label"><strong>Document/Image Attachments</strong></label><br>
                Current File : <a href="https://impression.dostcalabarzon.ph/uploads/docs/packaging/" title=""></a><br>
                <input class="form-control form-control-sm" placeholder="Document" name="pkg_file" id="pkg_file" type="file" accept="application/ms*,application/vnd.ms*,image/*">
            </div>
        
            <br>
            <div class="form-group">
                <label for="pkg_remarks" class="control-label"><strong>Remarks</strong></label>
                <textarea class="form-control input-sm" style="height: calc(2em + .5rem + 2px)" placeholder="Remarks" name="pkg_remarks" id="pkg_remarks" cols="50" rows="4">{{ old('pkg_remarks', $packaging->pkg_remarks) }}</textarea>
            </div>

            <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">
        </form>
    </div>
</div>
<script type="text/javascript"> 
    $(document).ready(function() {

    $('.date-picker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayBtn: true,
        todayHighlight: true
    });
});


</script>
@endsection