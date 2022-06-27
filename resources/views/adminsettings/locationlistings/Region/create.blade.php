@extends('./layouts.app', ['title' => 'Location Listings - Regions'])

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

    <form action="{{route('Regions.store')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Location Listings - Regions (Add)</h2>
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
                <input type="text" class="form-control" name="region_code" id="region_code" aria-describedby="region_code">
                @error('region_code')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="region_name"> <b>Name *</b> </label>
                <input type="text" class="form-control" name="region_name" id="region_name" aria-describedby="region_name">
                @error('region_name')
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