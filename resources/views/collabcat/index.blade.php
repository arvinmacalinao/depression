@extends('./layouts.app', ['title' => 'Collaborating Agency Categories'])

@section('content')
<div class="container-fluid mt-3">
    <div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h2>Collaborating Agency Categories</h2>
            <div></div>
                <div id="buttonz">
                    <a href="{{ URL::to('collabcategories/create') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>  Add Category</a>
                </div>

        </div>  
    </div>
    <div class="card-body">
        <div class="row mb-5">
            <div class="col-sm-3">
                <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="Category ..." aria-label="Category ..." aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">Search</button>
                    </div>
                </div>
            </div>
        </div>

            <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
                <thead>
                    <tr>
                        <th width="6%">&nbsp;</th>
                        <th width="4%">#</th>
                        <th >Category</th>
                    </tr>
                </thead> 

                <tbody>
                    @foreach($sel_collabs as $sel_collab) 
                        <tr>
                            <td>
                            <div class="d-flex justify-content-start">
                                <a class="btn btn-primary btn-xs" href="{{ route('collabcategories.edit', $sel_collab->ot_id)}}"><span class="fa fa-pencil"></span></a>&nbsp;
                                <form action="{{ route('collabcategories.destroy', $sel_collab->ot_id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary btn-xs show_confirm" type="submit"><span class="fa fa-close"></span></button>
                                </form>
                            </div>
                            </td>
                            <td>1</td>
                            <td>{{  $sel_collab->ot_name  }}</td>
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