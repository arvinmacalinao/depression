@extends('./layouts.app', ['title' => 'Course Categories'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('coursecategory.update', $show_course->course_cat_id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Course Categories (Edit)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('coursecategory') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="course_cat_name"> <b>Category Name *</b> </label>
                <input type="text" class="form-control" name="course_cat_name" id="course_cat_name" aria-describedby="course_cat_name" value="{!! $show_course->course_cat_name !!}">
                @error('course_cat_name')
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