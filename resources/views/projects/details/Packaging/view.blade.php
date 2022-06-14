@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header mb-0 pb-0" >
        <div class="pull-right">
            <a class="projectdetails-btn" href="{{ route('Designs', ['id' => $project->prj_id, 'pack_id' => $packaging->pkg_id]) }}" title="Edit"><span class="fa fa-file-image-o"></span> View Designs</a>
            <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
        </div>
        <h3><strong>Projects Packaging & Labeling Details</strong></h3>
        <h4 class="m-0">
            <strong>Product Name : </strong><span class="project-title"><strong>{{ $packaging->pkg_product_name }}</strong></span><br>
            <strong>Brand Name : </strong><span class="project-title"><strong>{{ $packaging->pkg_brand_name }}</strong></span><br>
        </h4>
        <p> 
            Encoded on {{ date('m/d/Y h:i:s a',strtotime($packaging->date_encoded))  }} by {{ $packaging->encoder }} <br>
            Last updated {{ date('m/d/Y h:i:s a',strtotime($packaging->date_encoded))  }} by {{ $packaging->encoder }}   
        </p>
    </div>
    <div class="card-header">                  
        <div class="row ml-0 pl-0">
            <div class="form-group form-group-sm col-12 pl-1">
                <label for="pkg_product_description" class="control-label"><strong>Product Description</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_product_description" id="pkg_product_description" readonly value="{{ $packaging->pkg_product_description }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group form-group-sm col-12 pl-1">
                <label for="pkg_competitors" class="control-label"><strong>What are the product's major competitors?</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_competitors" id="pkg_competitors" readonly value="{!! $packaging->pkg_competitors !!}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group form-group-sm col-12 pl-1">
                <label for="pkg_selling_point" class="control-label"><strong>What is your product's selling point?</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_selling_point" id="pkg_selling_point" readonly value="@if($packaging->pkg_selling_point < 6){!! $packaging->sellingpoints->sp_label !!}@else{!! $packaging->pkg_selling_point_others !!}@endif">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group form-group-sm col-12 pl-1">
                <label for="pkg_performance" class="control-label"><strong>How does your product perform against it's competitors in terms of sales?</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_performance" id="pkg_performance" readonly value="{!! $packaging->pkg_performance !!}">
            </div>
        </div>
        <div class="row ml-0 pl-0 mb-2">
            <div class="form-group form-group-sm col-12 pl-1">
                <label for="dist_label" class="control-label"><strong>Where do you intend to sell your product?</strong></label>
                <input type="text" class="form-control-viewproj" name="dist_label" id="dist_label" readonly value="{!! $packaging->distributions->dist_label !!}">
            </div>
        </div>
        <div class="row ml-1 pl-0 mr-1 text-light mb-2" style="background-color: gray; text-">
            <p class="d-flex pl-2 "><h4>If Applicable (Food, Chemicals...etc)</h4></p>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group form-group-sm col-12 pl-1">
                <label for="pkg_ingredients" class="control-label"><strong>Ingredients</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_ingredients" id="pkg_ingredients" readonly value="{!! $packaging->pkg_ingredients !!}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group form-group-sm col-12 pl-1">
                <label for="pkg_volume" class="control-label"><strong>Net Weight/Volume</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_volume" id="pkg_volume" readonly value="{!! $packaging->pkg_volume !!}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group form-group-sm col-12 pl-1">
                <label for="pkg_packaging_material" class="control-label"><strong>Packaging Material to be used</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_packaging_material" id="pkg_packaging_material" readonly value="{!! $packaging->pkg_packaging_material !!}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group form-group-sm col-12 pl-1">
                <label for="pkg_label_size" class="control-label"><strong>Size of Label/Box</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_label_size" id="pkg_label_size" readonly value="{!! $packaging->pkg_label_size !!}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group form-group-sm col-12 pl-1">
                <label for="pkg_preferred_colors" class="control-label"><strong>Preferred Colors</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_preferred_colors" id="pkg_preferred_colors" readonly value="{!! $packaging->pkg_preferred_colors !!}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group form-group-sm col-12 pl-1">
                <label for="pkg_other_details" class="control-label"><strong>Other Specifications/Preference</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_other_details" id="pkg_other_details" readonly value="{!! $packaging->pkg_other_details !!}">
            </div>
        </div>
        <div class="row ml-1 pl-0 mr-1 text-light mb-2" style="background-color: gray; text-">
            <p class="d-flex pl-2 "><h4>New Markets Penetrated</h4></p>
        </div>
        <div class="row ml-0 pl-0  mr-3 ml-3">
            <div class="form-group form-group-sm col-4 pl-1">
                <label for="pkg_market_location" class="control-label"><strong>Location</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_market_location" id="pkg_market_location" readonly value="{!! $packaging->pkg_market_location !!}">
            </div>
            <div class="form-group form-group-sm col-4 pl-1">
                <label for="pkg_market_products_sold" class="control-label"><strong>Products Sold</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_market_products_sold" id="pkg_market_products_sold" readonly value="{!! $packaging->pkg_market_products_sold !!}">
            </div>
            <div class="form-group form-group-sm col-4 pl-1">
                <label for="pkg_market_date_established" class="control-label"><strong>Date Established</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_market_date_established" id="pkg_market_date_established" readonly value="{!! $packaging->pkg_market_date_established !!}">
            </div>
        </div>
        
        <div class="row ml-1 pl-0 mr-1 text-light mb-2" style="background-color: gray; text-">
            <p class="d-flex pl-2 "><h4>Sales</h4></p>
        </div>
        <div class="row ml-0 pl-0  mr-3 ml-3">
            <div class="form-group form-group-sm col-6 pl-1">
                <label for="pkg_sales_before_intervention" class="control-label"><strong>Before Intervention</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_sales_before_intervention" id="pkg_sales_before_intervention" readonly value="{!! $packaging->pkg_sales_before_intervention !!}">
            </div>
            <div class="form-group form-group-sm col-6 pl-1">
                <label for="pkg_sales_after_intervention" class="control-label"><strong>After Intervention</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_sales_after_intervention" id="pkg_sales_after_intervention" readonly value="{!! $packaging->pkg_sales_after_intervention !!}">
            </div>
        </div>

        <div class="row ml-1 pl-0 mr-1 text-light mb-2" style="background-color: gray; text-">
            <p class="d-flex pl-2 "><h4>Employment After</h4></p>
        </div>
        <div class="row ml-0 pl-0 mr-3 ml-3">
            <div class="form-group form-group-sm col-4 pl-1">
                <label for="pkg_employment_after_direct" class="control-label"><strong>Direct</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_employment_after_direct" id="pkg_employment_after_direct" readonly value="{!! $packaging->pkg_employment_after_direct !!}">
            </div>
            <div class="form-group form-group-sm col-4 pl-1">
                <label for="pkg_employment_after_indirect" class="control-label"><strong>Indirect</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_employment_after_indirect" id="pkg_employment_after_indirect" readonly value="{!! $packaging->pkg_employment_after_indirect !!}">
            </div>
            <div class="form-group form-group-sm col-4 pl-1">
                <label for="pkg_employment_after_months_employed" class="control-label"><strong>Months Employed</strong></label>
                <input type="text" class="form-control-viewproj" name="pkg_employment_after_months_employed" id="pkg_employment_after_months_employed" readonly value="{!! $packaging->pkg_employment_after_months_employed !!}">
            </div>
        </div>

        <div class="row ml-1 pl-0 mr-1 text-light" style="background-color: gray; text-">
            <p class="d-flex pl-2 "><h4>Average Productivity Improvement</h4></p>
        </div>
        <div class="row ml-0 pl-0 m-3">
            <div class="form-group form-group-sm col-12 pl-1">
                <input type="text" class="form-control-viewproj" name="pkg_avg_productivity_improvement" id="pkg_avg_productivity_improvement" readonly value="{!! $packaging->pkg_avg_productivity_improvement !!}">
            </div>
        </div>
        
        <div class="row ml-1 pl-0 mr-1 text-light" style="background-color: gray; text-">
            <p class="d-flex pl-2 "><h4>Document/image Attachment</h4></p>
        </div>
        <div class="row ml-0 pl-0 m-3">
            <div class="form-group form-group-sm col-12 pl-1">
                <input type="text" class="form-control-viewproj" name="pkg_file" id="pkg_file" readonly value="{!! $packaging->pkg_file !!}">
            </div>
        </div>
        <div class="row ml-1 pl-0 mr-1 text-light" style="background-color: gray; text-">
            <p class="d-flex pl-2 "><h4>Remarks</h4></p>
        </div>
        <div class="row ml-0 pl-0 m-3">
            <div class="form-group form-group-sm col-12 pl-1">
                <input type="text" class="form-control-viewproj" name="pkg_remarks" id="pkg_remarks" readonly value="{!! $packaging->pkg_remarks !!}">
            </div>
        </div>

    </div>
</div>

<script>
   
</script>
@endsection