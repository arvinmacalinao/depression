@extends('./layouts.app', ['title' => 'Collaborating Agencies'])

@section('content')



<div class="container-fluid mt-3">

    @if (session('status'))
        <div class="alert alert-success" role="alert" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('status') }}
        </div>
        @elseif(session('failed'))
        <div class="alert alert-danger" role="alert" id="danger-alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('failed') }}
        </div>
    @endif  

    <div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h2>Collaborating Agencies</h2>
            <div></div>
                <div id="buttonz">
                    <a href="{{ URL::to('collabagency/create') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>  Add Agency</a>
                </div>
        </div> 
    </div>
        <div class="card-body">
            <form action="{{ route('collabagency.index') }}" method="GET">
            <div class="row mb-5">
                <div class="col-sm-3">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Category</span>
                        </div>
                        <select class="form-control input-sm" id="sr_category" name="sr_category" style="width:auto;">
                            <option>All</option>
                            @foreach($sel_cats as $sel_cat)
                            <option value="{{ $sel_cat->ot_id }}">{{ $sel_cat->ot_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                    <div class="col-sm-3">
                        
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="agen_search" id="agen_search" placeholder="Agency ..." aria-label="Agency ..." aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        
                    </div>
            </div>
            <form>

            <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
                <thead>
                    <tr>
                        <th width="6%">&nbsp;</th>
                        <th width="4%">#</th>
                        <th>Agency</th>
                        <th>Category</th>
                    </tr>
                </thead> 

                <tbody>
                    @foreach($sel_agencys as $sel_agency) 
                        <tr>
                            <td>
                            <div class="d-flex justify-content-start">
                                <a class="btn btn-primary btn-xs" href="{{ route('collabagency.edit', $sel_agency->col_id)}}"><span class="fa fa-pencil"></span></a>&nbsp;
                                <form action="{{ route('collabagency.destroy', $sel_agency->col_id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary btn-xs" id="{{$sel_agency->col_id}}" type="submit"><span class="fa fa-close"></span></button>
                                </form>
                            </div>
                            </td>
                            <td>1</td>
                            <td>{{  $sel_agency->col_name  }}</td>
                            <td>{{  $sel_agency->organizationtypes->ot_name  }}</td>
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

    @foreach($sel_agencys as $sel_agency) 
        $('#{{$sel_agency->col_id}}').click(function(event) {
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
      @endforeach

    // $("#success-alert").fadeTo(3500, 500).slideUp(500, function(){
    //     $("#success-alert").slideUp(500);
    // });
</script>
@endsection