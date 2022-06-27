@extends('./layouts.app', ['title' => 'Schools'])

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
            <h2>Schools</h2>
            <div></div>
                <div id="buttonz">
                    <a href="{{ URL::to('schools/create') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>  Add School</a>
                </div>

        </div>  
    </div>
    <div class="card-body">
        <div class="row mb-5">
            <div class="col-sm-3">

            <form action="{{ route('schools.index') }}" method="GET">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="schoolname_search" id="schoolname_search" placeholder="School ..." aria-label="School ..." aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>

            </div>
        </div>

            <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
                <thead>
                    <tr>
                        <th width="6%">&nbsp;</th>
                        <th width="4%">#</th>
                        <th >School</th>
                        <th >Address</th>
                        <th >Coordinator</th>
                        <th >Email</th>
                        <th >Phone</th>
                        <th >Mobile</th>
                    </tr>
                </thead> 

                <tbody>
                    @foreach($schools as $school) 
                        <tr>
                            <td>
                            <div class="d-flex justify-content-start">
                                <a class="btn btn-primary btn-xs" href="{{ route('schools.edit', $school->school_id)}}"><span class="fa fa-pencil"></span></a>&nbsp;
                                <form action="{{ route('schools.destroy', $school->school_id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary btn-xs show_confirm" type="submit"><span class="fa fa-close"></span></button>
                                </form>
                            </div>
                            </td>
                            <td>1</td>
                            <td>{!!  $school->school_acronym  !!}</td>
                            <td class="text-wrap">{!!  $school->school_address  !!}</td>
                            <td class="text-wrap">{!!  $school->school_coordinator  !!}</td>
                            <td>{!!  $school->school_email  !!}</td>
                            <td class="text-wrap">{!!  $school->school_phone  !!}</td>
                            <td>{!!  $school->school_mobile  !!}</td>
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