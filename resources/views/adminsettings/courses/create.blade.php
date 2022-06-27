@extends('./layouts.app', ['title' => 'Courses'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('course.store')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Courses (Add)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('course') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="course_cat_id" class="control-label"><b>Category *</b></label>
                <select class="form-control input-sm"  id="course_cat_id" name="course_cat_id">
                    @foreach($show_course_cats as $show_course_cat)
                        <option value="{{ $show_course_cat->course_cat_id }}">
                            {{ $show_course_cat->course_cat_name }}
                        </option>
                    @endforeach                   
                </select>
                @error('course_cat_id')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="course_name"> <b>Course Name *</b> </label>
                <input type="text" class="form-control" name="course_name" id="course_name" aria-describedby="course_name">
                @error('course_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="course_yearcount"> <b>Years *</b> </label>
                <input type="number" class="form-control" name="course_yearcount" id="course_yearcount" aria-describedby="course_yearcount">
                @error('course_yearcount')
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