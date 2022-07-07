@extends('./layouts.app', ['title' => 'Location Listings - Barangays (Edit)'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('Barangay.update', [$show_city->city_id, $show_barangay->barangay_id])}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h2>Location Location Listings - Barangays (Edit)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ route('Barangay.index',$show_city->city_id)}}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
                <h2 class="text-primary">{{$show_city->city_name}}</h2>
                <h4 class="text-muted">{{$show_province->province_name}}</h4>
                <h4 class="text-muted">{{$show_region->region_code}} ({{$show_region->region_name}})</h4>
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="barangay_name"> <b>Name *</b> </label>
                <input type="text" class="form-control" name="barangay_name" id="barangay_name" aria-describedby="barangay_name" value="{!! $show_barangay->barangay_name !!}">
                @error('barangay_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
            <label for="city_id" class="control-label"> <b>City</b> </label>
                <select class="form-control input-sm" id="city_id" name="city_id">
                @foreach($sel_citys as $sel_city)
                    <option value="{{ $sel_city->city_id }}" {{ ( $show_city->city_id == $sel_city->city_id ) ? 'selected' : '' }}>
                        {{ $sel_city->city_name }}
                    </option>
                @endforeach
                </select>
                @error('city_id')
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