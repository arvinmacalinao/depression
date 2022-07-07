@extends('./layouts.app', ['title' => 'Users'])

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
            <h2>User</h2>
            <div></div>
                <div id="buttonz">
                    <a href="{{ URL::to('users/create') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>  Add Users</a>
                    <a href="{{ URL::to('users/create') }}" type="button" class="btn btn-danger btn-sm"><i class="fa fa-key" aria-hidden="true"></i>  Reset Passwords</a>
                </div>

        </div>  
    </div>
    <div class="card-body">
        <div class="row mb-5">
            <div class="col-sm-3">

            <form action="{{ route('users.index') }}" method="GET">

            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Usergroup</span>
                </div>
                <select class="form-control input-sm" id="ug_id" name="ug_id">
                    <option value="">All</option>
                    @foreach($sel_ugs as $sel_ug)
                        <option value="{{ $sel_ug->ug_id }}" >
                            {!! $sel_ug->ug_name !!}
                        </option>
                    @endforeach
                </select>
            </div>
            

            </div>

                <div class="col-sm-3">
                    <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Region</span>
                    </div>
                    <select class="form-control input-sm" id="region_id" name="region_id">
                        <option value="">All</option>
                        @foreach($sel_regions as $sel_region)
                            <option value="{{ $sel_region->region_id }}" >
                                {!!  $sel_region->region_code !!} ({!!  $sel_region->region_name !!})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="user_search" id="user_search" placeholder="User ..." aria-label="User ..." aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </div>
            </form>
        </div>

            <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
                <thead>
                    <tr>
                        <th width="6%">&nbsp;</th>
                        <th width="4%">#</th>
                        <th >Enabled</th>
                        <th >Username</th>
                        <th >Name</th>
                        <th >User Group</th>
                        <th >Phone</th>
                        <th >Email</th>
                        <th >Region</th>
                    </tr>
                </thead> 

                <tbody>
                    @foreach($sel_users as $sel_user) 
                        <tr>
                            <td>
                            <div class="d-flex justify-content-start">
                                <a class="btn btn-primary btn-xs" href="{{ route('users.edit', $sel_user->u_id)}}"><span class="fa fa-pencil"></span></a>&nbsp;
                                <form action="{{ route('users.destroy', $sel_user->u_id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary btn-xs show_confirm" type="submit"><span class="fa fa-close"></span></button>
                                </form>
                            </div>
                            </td>
                            <td class="text-center">1</td>
                            <td class="text-center"><span class="{{ ( $sel_user->u_enabled == '1' ) ? 'fa fa-check' : 'fa fa-close' }}"></span></td>
                            <td>{!!  $sel_user->u_username  !!}</td>
                            <td>{!!  $sel_user->u_fname  !!}&nbsp;{!!  $sel_user->u_mname  !!}&nbsp;{!!  $sel_user->u_lname  !!}</td>
                            <td>{!!  $sel_user->usergroups->ug_name  !!}</td>
                            <td>{!!  $sel_user->u_mobile !!}</td>
                            <td>{!!  $sel_user->u_email  !!}</td>
                            <td>{!!  $sel_user->regions->region_code !!} ({!!  $sel_user->regions->region_name !!})</td>
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