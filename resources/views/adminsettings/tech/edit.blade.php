@extends('./layouts.app', ['title' => 'Technologies'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('technologies.update', $show_tech->tech_id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Technologies (Edit)</h2>
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
                <input type="text" class="form-control" name="tech_name" id="tech_name" aria-describedby="tech_name" value="{!! $show_tech->tech_name !!}">
                @error('tech_name')
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