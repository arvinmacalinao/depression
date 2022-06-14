@extends('./layouts.app', ['title' => 'Sectors'])

@section('content')
<div class="container-fluid mt-3"> 

    <form action="{{route('sectors.store')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Sectors (Add)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('sectors') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="sector_name"> <b>Sector Name *</b> </label>
                <input type="text" class="form-control" name="sector_name" id="sector_name" aria-describedby="sector_name">
                @error('sector_name')
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