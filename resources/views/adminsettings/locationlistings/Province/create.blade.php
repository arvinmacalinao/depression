@extends('./layouts.app', ['title' => 'Location Listings - Provinces (Add)'])

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

    <form action="{{ route('Province.store',$show_region->region_id)}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h2>Location Listings - Provinces (Add)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ route('Province.index',$show_region->region_id)}}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="province_name"> <b>Name *</b> </label>
                <input type="text" class="form-control" name="province_name" id="province_name" aria-describedby="province_name">
                @error('province_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
            <label for="region_id" class="control-label"> <b>Region *</b> </label>
                <select class="form-control input-sm" id="region_id" name="region_id">
                @foreach($sel_regions as $sel_region)
                    <option value="{{ $sel_region->region_id }}" {{ ( $show_region->region_id == $sel_region->region_id ) ? 'selected' : '' }}>
                        {{ $sel_region->region_code }}
                    </option>
                @endforeach
                </select>
                @error('region_id')
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