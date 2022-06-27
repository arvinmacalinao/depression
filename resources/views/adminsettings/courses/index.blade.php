@extends('./layouts.app', ['title' => 'Course'])

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

    <div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h2>Course</h2>
            <div></div>
                <div id="buttonz">
                    <a href="{{ URL::to('course/create') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>  Add Course</a>
                </div>

        </div>  
    </div>
    <div class="card-body">
    <form action="{{ route('course.index') }}" method="GET">
        <div class="row mb-5">

        
            <div class="col-sm-3">
                <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Category</span>
                </div>
                    <select class="form-control input-sm"  id="course_cat_id" name="course_cat_id">
                        @foreach($show_course_cats as $show_course_cat)
                            <option value="{{ $show_course_cat->course_cat_id }}">
                                {{ $show_course_cat->course_cat_name }}
                            </option>
                        @endforeach                   
                    </select>
                </div>
            </div>
        
            <div class="col-sm-3">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="coursename_search" id="coursename_search" placeholder="Course ..." aria-label="Course ..." aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </div>

        </div>
        </form>

            <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
                <thead>
                    <tr>
                        <th width="6%">&nbsp;</th>
                        <th width="4%">#</th>
                        <th >Category</th>
                        <th >Course</th>
                        <th >Years</th>
                    </tr>
                </thead> 

                <tbody>
                    @foreach($courses as $course) 
                        <tr>
                            <td>
                            <div class="d-flex justify-content-start">
                                <a class="btn btn-primary btn-xs" href="{{ route('course.edit', $course->course_id)}}"><span class="fa fa-pencil"></span></a>&nbsp;
                                <form action="{{ route('course.destroy', $course->course_id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary btn-xs show_confirm" type="submit"><span class="fa fa-close"></span></button>
                                </form>
                            </div>
                            </td>
                            <td>1</td>
                            <td>{!!  $course->coursecategory->course_cat_name  !!}</td>
                            <td>{!!  $course->course_name  !!}</td>
                            <td>{!!  $course->course_yearcount  !!}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
    </div>
    </div>
</div>

<script>
    var t =  $('#mydatatable').DataTable({
        deferRender:    true,
        searching:      false,
        paging:         true,
        pageLength:     20,
        orderable:      false,
        targets:        0,
        order: [[ 1, 'desc' ]]
    }); 

    t.on( 'order.dt search.dt', function () {
        t.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
</script>
@endsection