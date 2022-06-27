@extends('./layouts.app', ['title' => 'Location Listings - Provinces (Edit)'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('Province.update', [$show_region->region_id, $show_province->province_id])}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h2>Location Listings - Provinces (Edit)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ route('Province.index',$show_region->region_id)}}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
                <h2 class="text-primary">{{$show_region->region_name}}</h2>
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="province_name"> <b>Code *</b> </label>
                <input type="text" class="form-control" name="province_name" id="province_name" aria-describedby="province_name" value="{!! $show_province->province_name !!}">
                @error('province_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="region_id" class="control-label"> <b>Region *</b> </label>
                <select class="form-control input-sm" id="region_id" name="region_id">
                @foreach($sel_regions as $sel_region)
                    <option value="{{ $sel_region->region_id }}" {{ ( $show_province->region_id == $sel_region->region_id ) ? 'selected' : '' }}>
                        {{ $sel_region->region_name }}
                    </option>
                @endforeach
                </select>
                @error('region_id')
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