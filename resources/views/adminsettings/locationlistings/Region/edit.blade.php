@extends('./layouts.app', ['title' => 'Location Listings - Regions (Edit)'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('Regions.update', $show_region->region_id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Location Listings - Regions (Edit)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('locationlistings/Regions') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="region_code"> <b>Code *</b> </label>
                <input type="text" class="form-control" name="region_code" id="region_code" aria-describedby="region_code" value="{!! $show_region->region_code !!}">
                @error('region_code')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="region_name"> <b>Name *</b> </label>
                <input type="text" class="form-control" name="region_name" id="region_name" aria-describedby="region_name" value="{!! $show_region->region_name !!}">
                @error('region_name')
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