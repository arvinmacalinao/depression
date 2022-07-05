@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header">
        <h3>Project Sites (Add)
            <div class="pull-right">
                <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Project Sites Save', ['id' => $id, 'ps_id' => $ps_id]) }}" method="POST">
            @csrf
            <div class="form-group form-group-sm">
                <label for="brand_id" class="control-label"><Strong>Equipment</Strong></label>
                <select class="form-control input-sm" id="brand_id" name="brand_id">
                    @foreach ($sel_brands as $brand)
                    <option value="{{ $brand->brand_id }}" {{ old('brand_id', $site->brand_id) == $brand->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group form-group-sm">
                <label for="prj_site_date" class="control-label"><Strong>Date Deployed *</Strong></label>
                <input class="form-control input-sm date-picker" placeholder="Date Tagged" maxlength="10" name="prj_site_date" id="prj_site_date" type="text" value="{{ old('prj_site_date', $site->prj_site_date) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="prj_site_remarks" class="control-label"><strong>Remarks</strong></label>
                <textarea class="form-control input-sm" placeholder="Sectors" required="required" name="prj_site_remarks" id="prj_site_remarks" cols="50" rows="4">{{ old('prj_site_remarks', $site->prj_site_remarks) }}</textarea>
            </div>
            <div class="row-proj">
                <div class="container-form pl-0 mb-0">
                   <p class="font-weight-bold text-light bg-secondary p-1"> Location</p>
                </div>
                <div class="col-sm-4">
                    <label for="province_id" class="control-label">Province</label>
                        <select class="form-control input-sm province_select" id="province_id" name="province_id" placeholder="Select Province">
                        <option disabled selected value>--Select Province--</option>
                        @foreach ($sel_provinces as $province)
                        <option value="{{ $province->province_id }}" {{ old('province_id', $site->province_id) == $province->province_id ? 'selected' : '' }}>{{ $province->province_name }}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="city_id" class="control-label">Municipality/City</label>
                    <select class="form-control input-sm city_select" id="city_id" name="city_id">
                        @if($ps_id != 0)
                            @foreach ($sel_cities as $city)
                            <option value="{{ $city->city_id }}"  {{ old('city_id', $site->city_id) == $city->city_id ? 'selected' : '' }}>{{ $city->city_name }}</option>
                            @endforeach
                        @else
                        <option disabled selected value>--Select City--</option>
                        @endif
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="barangay_id" class="control-label">Barangay</label>
                    <select class="form-control input-sm barangay_select" id="barangay_id" name="barangay_id">
                        @if($ps_id != 0)
                            @foreach ($sel_barangays as $barangay)
                            <option value="{{ $barangay->barangay_id }}"  {{ old('city_id', $site->barangay_id) == $barangay->barangay_id ? 'selected' : '' }}>{{ $barangay->barangay_name }}</option>
                            @endforeach
                        @else
                        <option disabled selected value>--Select Barangay--</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="row-proj">
                <div class="container-form pl-0 mb-0">
                    <p class="font-weight-bold text-light bg-secondary p-1"> Project Map Coordinates</p>
                </div>
            </div>
            <div class="card-map">
                <div id="map" style="height: 330px; width: 100%;"></div>
            </div>

            <div id="map-location-picker" class="form-group map-location-picker">
            </div>

            <div class="form-group">
                <label for="prj_longitude" class="control-label">Longitude</label>
                <input class="form-control input-sm" placeholder="Longitude" min="0" step="any" name="prj_site_longitude" id="prj_longitude" type="text" value="{{ old('prj_site_longitude', $site->prj_site_longitude) }}">
            </div>

            <div class="form-group">
                <label for="prj_latitude" class="control-label">Latitude</label>
                <input class="form-control input-sm" placeholder="Latitude" min="0" step="any" name="prj_site_latitude" id="prj_latitude" type="text" value="{{ old('prj_site_latitude', $site->prj_site_latitude) }}">
            </div>

            <div class="form-group">
                <label for="prj_elevation" class="control-label">Elevation</label>
                <input class="form-control input-sm" placeholder="Elevation" min="0" step="any" name="prj_site_elevation" id="elevation" type="number" value="{{ old('prj_site_elevation', $site->prj_site_elevation) }}">
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

    $(".province_select").on('change', function() {
        $(this).find("option:selected").each(function(){
            var provincesID = $(this).attr("value");
            if(provincesID)
            {
                console.log(provincesID);
                $.ajax({
                    url:'/getCities/' + provincesID,
                    type: "GET",
                    dataType: "JSON",
                    success:function(data)
                    {
                        $(".city_select").empty(); //remove last selected itmes
                        $.each(data, function(key, value){
                            $(".city_select").append('<option value="'+ key+'">'+ value +'</option>');
                        })
                        $(".city_select").val(cityid);
                    }
                })
            }
            else
            {
                $(".city_select").empty();
                $(".barangay_select").empty();
            }
        });
    });
    $(".city_select").on('change', function() {
        $(this).find("option:selected").each(function(){
            var citiesID = $(this).attr("value");
            if(citiesID)
            {
                $.ajax({
                    url:'/getBarangays/' + citiesID,
                    type: "GET",
                    dataType: "JSON",
                    success:function(data)
                    {
                        $(".barangay_select").empty(); //remove last selected itmes
                        $(".barangay_select").append('<option value="">None</option>');
                        $.each(data, function(key, value){
                        $(".barangay_select").append('<option value="'+ key+'">'+ value +'</option>');
                        })
                        
                    }
                })
            }
            else
            {
                $(".barangay_select").empty();
            }
        });
    });
});
</script>
@endsection