@extends('./layouts.app', ['title' => 'Location Listings - Cities (Edit)'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('City.update', [$show_province->province_id, $show_city->city_id])}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h2>Location Location Listings - Cities (Edit)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ route('City.index',$show_province->province_id)}}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
                <h2 class="text-primary">{{$show_province->province_name}}</h2>
                <h4 class="text-muted">{{$show_region->region_code}} ({{$show_region->region_name}})</h4>
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="city_name"> <b>Name *</b> </label>
                <input type="text" class="form-control" name="city_name" id="city_name" aria-describedby="city_name" value="{!! $show_city->city_name !!}">
                @error('city_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="district_id" class="control-label"> <b>District</b> </label>
                <select class="form-control input-sm" id="district_id" name="district_id">
                @foreach($sel_disctricts as $sel_disctrict)
                    <option value="{{ $sel_disctrict->district_id }}" {{ ( $show_city->district_id == $sel_disctrict->district_id ) ? 'selected' : '' }}>
                        {{ $sel_disctrict->district_name }}
                    </option>
                @endforeach
                </select>
                @error('district_id')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="province_id" class="control-label"> <b>Province</b> </label>
                <select class="form-control input-sm" id="province_id" name="province_id">
                @foreach($sel_provinces as $sel_province)
                    <option value="{{ $sel_province->province_id }}" {{ ( $show_city->province_id == $sel_province->province_id ) ? 'selected' : '' }}>
                        {{ $sel_province->province_name }}
                    </option>
                @endforeach
                </select>
                @error('province_id')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <input class="btn btn-primary btn-block" type="submit" name="update" id="update" value="Update">
            </form>           
        </div>
    </div>
    </form>
</div>
@endsection