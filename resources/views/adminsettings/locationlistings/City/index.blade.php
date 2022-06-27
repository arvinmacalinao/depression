@extends('./layouts.app', ['title' => 'Location Listings - Cities'])

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
            <h2>Location Listings - Cities</h2>
            <div></div>
                <div id="buttonz">
                    <a href="{{ route('City.create',$show_province->province_id)}}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>  Add City/Municipality</a>
                    <a href="{{ route('Province.index',$show_region->region_id)}}" type="button" class="btn btn-primary btn-sm">Back</a>
                </div>

        </div>  
        <h2 class="text-primary">{{$show_province->province_name}}</h2>
        <h4 class="text-muted">{{$show_region->region_code}} ({{$show_region->region_name}})</h4>
    </div>
    <div class="card-body">
        <div class="row mb-5">
            <div class="col-sm-3">

            <form action="{{ route('City.index', $show_province->province_id) }}" method="GET">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="city_search" id="city_search" placeholder="City/Municipality ..." aria-label="City/Municipality ..." aria-describedby="basic-addon2">
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
                        <th >City/Municipality</th>
                        <th >District</th>
                    </tr>
                </thead> 

                <tbody>
                    @foreach($sel_citys as $sel_city) 
                        <tr>
                            <td>
                            <div class="d-flex justify-content-start">
                                <a class="btn btn-primary btn-xs" href="{{ route('Barangay.index', $sel_city->city_id)}}"><span class="fa fa-folder-open"></span></a>&nbsp;
                                <a class="btn btn-primary btn-xs" href="{{ route('City.edit', [$show_province->province_id,$sel_city->city_id])}}"><span class="fa fa-pencil"></span></a>&nbsp;
                                <form action="{{ route('City.destroy', [$show_province->province_id,$sel_city->city_id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary btn-xs show_confirm" type="submit"><span class="fa fa-close"></span></button>
                                </form>
                            </div>
                            </td>
                            <td>1</td>
                            <td> <a href="{{ route('Barangay.index', $sel_city->city_id)}}">{!!  $sel_city->city_name  !!}</a></td>
                            <td>{{$sel_city->district->district_name}}</td>
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