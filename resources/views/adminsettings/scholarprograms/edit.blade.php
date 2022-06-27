@extends('./layouts.app', ['title' => 'Scholarship Programs'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('scholarprograms.update', $show_programs->scholar_prog_id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Scholarship Programs (Edit)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('scholarprograms') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>

            <div class="form-group">
                <label for="scholar_prog_name"> <b>Course Name *</b> </label>
                <input type="text" class="form-control" name="scholar_prog_name" id="scholar_prog_name" aria-describedby="scholar_prog_name" value="{!! $show_programs->scholar_prog_name !!}">
                @error('scholar_prog_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="scholar_prog_desc"> <b>Years *</b> </label>
                <input type="text" class="form-control" name="scholar_prog_desc" id="scholar_prog_desc" aria-describedby="scholar_prog_desc" value="{!! $show_programs->scholar_prog_desc !!}">
                @error('scholar_prog_desc')
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