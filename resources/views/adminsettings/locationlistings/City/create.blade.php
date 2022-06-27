@extends('./layouts.app', ['title' => 'Location Listings - Cities (Add)'])

@section('content')
<div class="container-fluid mt-3">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('status') }}
        </div>
        @elseif(session('failed'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('failed') }}
        </div>
    @endif  

    <form action="{{ route('City.store',$show_province->province_id)}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h2>Location Listings - Cities (Add)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ route('Province.index',$show_region->region_id)}}" type="button" class="btn btn-primary btn-sm">Back</a>
                        </div>
                </div>

                <h2 class="text-primary">{{$show_province->province_name}}</h2>
                <h4 class="text-muted">{{$show_region->region_code}} ({{$show_region->region_name}})</h4>
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="city_name"> <b>Name *</b> </label>
                <input type="text" class="form-control" name="city_name" id="city_name" aria-describedby="city_name">
                @error('city_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
            <label for="district_id" class="control-label"> <b>District</b> </label>
                <select class="form-control input-sm" id="district_id" name="district_id">
                @foreach($sel_disctricts as $sel_disctrict)
                    <option value="{{ $sel_disctrict->district_id }}">
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
                    <option value="{{ $sel_province->province_id }}" {{ ( $show_province->province_id == $sel_province->province_id ) ? 'selected' : '' }}>
                        {{ $sel_province->province_name }}
                    </option>
                @endforeach
                </select>
                @error('province_id')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">
            </form>           
        </div>
    </div>
    </form>
</div>
@endsection