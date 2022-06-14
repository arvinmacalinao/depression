@extends('./layouts.app', ['title' => 'Equipment Names (Add)'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('equipmentnames.store')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Equipment Names (Add)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('equipmentnames') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="brand_name">Equipment Name *</label>
                <input type="text" class="form-control" name="brand_name" id="brand_name" aria-describedby="brand_name">
                @error('brand_name')
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