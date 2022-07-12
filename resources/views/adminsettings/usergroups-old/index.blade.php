@extends('./layouts.app', ['title' => 'Usergroup'])

@section('content')
<div class="container-fluid mt-3">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h2>User Groups</h2>
                <div></div>
                <div id="buttonz">
                    <a href="{{ URL::to('usergroups/create') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>  Add Group</a>
                    <a href="{{ URL::to('usergroup/refactor') }}" type="button" class="btn btn-danger btn-sm"><i class="fa fa-retweet" aria-hidden="true"></i>  Implementor Refactoring</a>
                </div>

            </div>       

        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Region</span>
                        </div>
                        <select class="form-control input-sm" id="sr_region" name="sr_region" style="width:auto;">
                            <option>All</option>
                            @foreach($sel_regions as $sel_region)
                                <option>{{ $sel_region->region_text }}</option>
                            @endforeach
                        </select>
                        </div>
                </div>

                <div class="col-sm-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Province</span>
                        </div>
                        <select class="form-control input-sm" id="sr_prj_type" name="sr_prj_type" style="width:auto;">
                            <option>All</option>
                            @foreach($sel_provinces as $sel_province)
                                <option>{{ $sel_province->province_name }}</option>
                            @endforeach
                        </select>
                        </div>
                </div>

                
                    <div class="col-sm-2">
                        <form action="" method="get">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" placeholder="Search.." aria-describedby="button-addon2" id="sr_input_usrgrp">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-sm" type="submit" id="btn_search">Search</button>
                            </div>
                        </div>
                        </form>
                    </div>
                

            </div>

            <div class="alert alert-warning">
                Regional Office usergroups should be prefixed with "RO-"<br>
                PSTC usergroups should be prefixed with "PSTC-"<br>
                Usergroups prefixed with "Laboratory-" are now depreciated and should be replaced/removed.  
            </div>

            <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
                <thead>
                    <tr>
                        <th width="4%">&nbsp;</th>
                        <th>#</th>
                        <th width="16%">User Group</th>
                        <th width="16%"># of Users</th>
                        <th width="16%">Display Name</th>
                        <th width="16%">Region</th>
                        <th width="16%">Province</th>
                        <th width="16%">Parent</th>
                    </tr>
                </thead> 

                <tbody>
                    @foreach($d_usergroups as $d_usergroup)    
                    <tr>
                        <td>
                        <div class="d-flex justify-content-start">
                            <a class="btn btn-primary btn-xs" href="{{ route('usergroups.edit', $d_usergroup->ug_id)}}"><span class="fa fa-pencil"></span></a>&nbsp;
                            <form action="{{ route('usergroups.destroy', $d_usergroup->ug_id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary btn-xs show_confirm" type="submit"><span class="fa fa-close"></span></button>
                            </form>
                        </div>

                        </td>
                        <td>1</td>
                        <td>{!!  $d_usergroup->ug_name  !!}</td>
                        <td>{{  $d_usergroup->num_users  }}</td>
                        <td>{{  $d_usergroup->ug_display_name  }}</td>
                        <td>{{  $d_usergroup->region_text  }}</td>
                        <td>{{  $d_usergroup->province_name  }}</td>
                        <td>{{  $d_usergroup->ug_parent_name  }}</td>                        
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

    $("#sr_region").val($("#sr_region option:eq(8)").val());

    // @if(session('status'))
    //     console.log({{ session('status') }});
    // @elseif(session('failed'))
    //     console.log({{ session('failed') }});
    // @endif 

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