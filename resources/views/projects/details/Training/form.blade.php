@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header">
        <h3>Project PIS Add
            <div class="pull-right">
                <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Project Training Save', ['id' => $id, 'fr_id' => $fr_id]) }}" method="POST">
            @csrf
            <div class="form-group form-group-sm">
                <label for="fr_type_id" class="control-label"><strong>Type</strong></label>
                <select class="form-control input-sm" id="fr_type_id" name="fr_type_id">
                @foreach ($sel_types as $type)
                <option value="{{ $type->fr_type_id }}"{{ old('fr_type_id', $training->fr_type_id) == $type->fr_type_id ? 'selected' : '' }}>{{ $type->fr_type_name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_requesting_party" class="control-label"><strong>Requesting Party/Address *</strong></label>
                <textarea class="form-control input-sm" placeholder="Requesting Party/Address" required="required" name="fr_requesting_party" id="fr_requesting_party" cols="50" rows="4">{{ old('fr_requesting_party', $training->fr_requesting_party) }}</textarea>
            </div>
            <div class="form-group form-group-sm">
                <label for="collaborators" class="control-label"><strong>Collaborating Agencies</strong></label>
                <select class="form-control input-sm chosen-select" id="collaborators" name="collaborators[]" multiple="multiple">
                    @foreach ($sel_collaborators as $collaborator)
                    <option value="{!! $collaborator->col_id !!}" {{ collect(old('collaborators', $training->ForaCollaborators->pluck('col_id') ?? []))->contains($collaborator->col_id) ? 'selected' : '' }}>{!! $collaborator->col_name !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group form-group-sm">
                <label for="sp_id" class="control-label"><Strong>Service Provider *</Strong></label>
                <select class="form-control input-sm" id="sp_id" name="sp_id">
                @foreach ($sel_suppliers as $supplier)
                <option value="{{ $supplier->sp_id }}" {{ old('sp_id', $training->sp_id) == $supplier->sp_id ? 'selected' : '' }}>{{ $supplier->sp_name }}</option>
                
                @endforeach
                </select>
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_sectors" class="control-label"><strong>Sectors</strong></label>
                <textarea class="form-control input-sm" placeholder="Sectors" required="required" name="fr_sectors" id="fr_sectors" cols="50" rows="4">{{ old('fr_sectors', $training->fr_sectors) }}</textarea>
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_title" class="control-label"><strong>Title *</strong></label>
                <input class="form-control input-sm" placeholder="Title" required="required" name="fr_title" id="fr_title" type="text" value="{{ old('fr_title', $training->fr_title) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_start" class="control-label"><Strong>Start *</Strong></label>
                <input class="form-control input-sm datetime_range_start" placeholder="Start" maxlength="10" required="required" name="fr_start" id="fr_start" type="text" value="{{ old('fr_start', $training->fr_start) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_start" class="control-label"><Strong>End *</Strong></label>
                <input class="form-control input-sm datetime_range_end" placeholder="Start" maxlength="10" required="required" name="fr_end" id="fr_end" type="text" value="{{ old('fr_end', $training->fr_end) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_location" class="control-label">Venue *</label>
                <textarea class="form-control input-sm" placeholder="Venue" required="required" name="fr_location" id="fr_location" cols="50" rows="4">{{ old('fr_location', $training->fr_location) }}</textarea>
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_cost" class="control-label">Cost</label>
                <input class="form-control input-sm" placeholder="Cost" min="0" step="any" name="fr_cost" id="fr_cost" type="number" value="{{ old('fr_cost', $training->fr_cost) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_csf" class="control-label">Overall CSF Rating *</label>
                <input class="form-control input-sm" placeholder="Overall CSF Rating" min="0" step="any" required="required" name="fr_csf" id="fr_csf" type="number" value="{{ old('fr_csf', $training->fr_csf) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="ug_id" class="control-label"><Strong>Implementor</Strong></label>
                <select class="form-control input-sm" id="ug_id" name="ug_id">
                @foreach ($sel_implementors as $implementor)
                <option value="{{ $implementor->ug_id }}" {{ old('ug_id', $training->ug_id) == $implementor->ug_id ? 'selected' : '' }}>{{ $implementor->ug_name }}</option>
                
                @endforeach
                </select>
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_remarks" class="control-label">Remarks</label>
                <textarea class="form-control input-sm" placeholder="Remarks" name="fr_remarks" id="fr_remarks" cols="50" rows="4">{{ old('fr_remarks', $training->fr_remarks) }}</textarea>
            </div>
            <div class="row-proj">
                <div class="container-form pl-0">
                   <p class="font-weight-bold text-light bg-secondary p-1"> Participant Demographics</p>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_no_feminine" class="control-label">No. of Female Participants *</label>
                <input class="form-control input-sm" placeholder="No. of Female Participants" min="0" step="1" required="required" name="fr_no_feminine" id="fr_no_feminine" type="number" value="{{ old('fr_no_feminine', $training->fr_no_feminine) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_no_masculine" class="control-label">No. of Male Participants *</label>
                <input class="form-control input-sm" placeholder="No. of Male Participants" min="0" step="1" required="required" name="fr_no_masculine" id="fr_no_masculine" type="number" value="{{ old('fr_no_masculine', $training->fr_no_masculine) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_no_pwd" class="control-label">No. of PWD Participants *</label>
                <input class="form-control input-sm" placeholder="No. of PWD Participants" min="0" step="1" required="required" name="fr_no_pwd" id="fr_no_pwd" type="number" value="{{ old('fr_no_pwd', $training->fr_no_pwd) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_no_seniors" class="control-label">No. of Senior Citizen Participants *</label>
                <input class="form-control input-sm" placeholder="No. of Senior Citizen Participants" min="0" step="1" required="required" name="fr_no_seniors" id="fr_no_seniors" type="number" value="{{ old('fr_no_seniors', $training->fr_no_seniors) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_no_firms" class="control-label">Total No. of Participating Firms *</label>
                <input class="form-control input-sm" placeholder="Total No. of Participating Firms" min="0" step="1" required="required" name="fr_no_firms" id="fr_no_firms" type="number" value="{{ old('fr_no_firms', $training->fr_no_firms) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="fr_no_po" class="control-label">Total No. of Participating PO *</label>
                <input class="form-control input-sm" placeholder="Total No. of Participating PO" min="0" step="1" required="required" name="fr_no_po" id="fr_no_po" type="number" value="{{ old('fr_no_po', $training->fr_no_po) }}">
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
                        <option value="{{ $province->province_id }}" {{ old('province_id', $training->province_id) == $province->province_id ? 'selected' : '' }}>{{ $province->province_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="city_id" class="control-label">Municipality/City</label>
                    <select class="form-control input-sm city_select" id="city_id" name="city_id">
                        @if($fr_id != 0)
                            @foreach ($sel_cities as $city)
                            <option value="{{ $city->city_id }}"  {{ old('city_id', $training->city_id) == $city->city_id ? 'selected' : '' }}>{{ $city->city_name }}</option>
                            @endforeach
                        @else
                        <option disabled selected value>--Select City--</option>
                        @endif
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="barangay_id" class="control-label">Barangay</label>
                    <select class="form-control input-sm barangay_select" id="barangay_id" name="barangay_id">
                        @if($fr_id != 0)
                            @foreach ($sel_barangays as $barangay)
                            <option value="{{ $barangay->barangay_id }}"  {{ old('city_id', $training->barangay_id) == $barangay->barangay_id ? 'selected' : '' }}>{{ $barangay->barangay_name }}</option>
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
                <input class="form-control input-sm" placeholder="Longitude" min="0" step="any" name="fr_longitude" id="prj_longitude" type="text" value="{{ old('fr_longitude', $training->fr_longitude) }}">
            </div>

            <div class="form-group">
                <label for="prj_latitude" class="control-label">Latitude</label>
                <input class="form-control input-sm" placeholder="Latitude" min="0" step="any" name="fr_latitude" id="prj_latitude" type="text" value="{{ old('fr_latitude', $training->fr_latitude) }}">
            </div>

            <div class="form-group">
                <label for="prj_elevation" class="control-label">Elevation</label>
                <input class="form-control input-sm" placeholder="Elevation" min="0" step="any" name="fr_elevation" id="elevation" type="number" value="{{ old('fr_elevation', $training->fr_elevation) }}">
            </div>
            <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">
        </form>
        
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
    $(".chosen-select").chosen();
    $('.datetimepicker').datetimepicker({
        sideBySide: true,
        icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
    });
    var datastart = $('.datetime_range_start').val() != "" ? new Date($('.datetime_range_start').val()) : false;
    var dateend = $('.datetime_range_end').val() != "" ? new Date($('.datetime_range_end').val()) : false;
        $('.datetime_range_start').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        maxDate: dateend,
        sideBySide: true,
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
            }
        });
    
        $('.datetime_range_end').datetimepicker({
        useCurrent: false, //Important! See issue #1075
        minDate: datastart,
        format: 'YYYY-MM-DD HH:mm:ss',
        sideBySide: true,
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
            }
        });
    
    $(".datetime_range_start").on("dp.change", function (e) {
      $('.datetime_range_end').data("DateTimePicker").minDate(e.date);
    });      
    
    $(".datetime_range_end").on("dp.change", function (e) {
        $('.datetime_range_start').data("DateTimePicker").maxDate(e.date);
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