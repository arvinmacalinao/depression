@extends('./layouts.app', ['title' => 'Technologies'])

@section('content')
<div class="container-fluid mt-3"> 

    <form action="{{route('technologies.store')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Technologies (Add)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('technologies') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="tech_name"> <b>Technology Name *</b> </label>
                <input type="text" class="form-control" name="tech_name" id="tech_name" aria-describedby="tech_name">
                @error('tech_name')
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