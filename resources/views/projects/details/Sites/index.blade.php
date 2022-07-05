@extends('./layouts.app')

@section('content')
<div class="container-fluid">
    @if(Session::has('message'))
    <div class="alert alert-success mt-2" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ Session::get('message') }}</strong>
    </div>
    @endif
@include('projects.details.details')
<div class="card">
    <div class="card-header">                  
        <h3>Project Products
            <div class="pull-right">
                <a class="projectdetails-btn-success pr" href="" title="Print" target="_blank"><span class="fa fa-print"></span> Print</a>
                <a href="{{ route('New Project Sites', $project->prj_id) }}" class="projectdetails-btn pr"><span class="fa fa-plus"></span> Add Sites</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="" method="GET" autocomplete="off">
            <div class="form-row">
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Equipment</span>
                        </div>
                        <select class="form-control input-sm mr-2" id="qbrand" name="qbrand">
                            <option value="">ALL</option>
                            @foreach ($sel_brands as $brand)
                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                            
                            
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Year</span>
                        </div>
                        <select class="form-control input-sm mr-2" id="qyear" name="qyear">
                            <option value="">ALL</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Quarter</span>
                        </div>
                        <select class="form-control input-sm" id="qqtr" name="qqtr">
                            <option value="">ALL</option>
                            @foreach ($sel_qtrs as $qtr)
                            <option value="{{ $qtr->quarter_id }}">{{ $qtr->quarter_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <input class="form-control input-sm" placeholder="Keywords..." type="text" maxlength="255" name="qsearch" id="qsearch" value="{{ old('qsearch', $site_search) }}">
                        <input class="projectdetails-btn btn-sm" type="submit"  value="Search">
                    </div>
                </div>
            </div>
        </form>
        <div class="card-map">
            <div id="map3" style="height: 330px; width: 100%;"></div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
            <thead>
                <tr>
                    <th width="6%">&nbsp;</th>
                    <th >#</th>
                    <th >Date</th>
                    <th >Equipment</th>
                    <th >Province</th>
                    <th >City/Municipality</th>
                    <th >Barangay</th>
                    <th >Longitude</th>
                    <th >Latitued</th>
                    <th >Elevation</th>
                    <th >Remarks</th>
                    <th >Encoded</th>
                    <th >Last Updated</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($sites as $site)
                                <tr>
                                    <td>
                                        
                                        <a href="{{ route('Edit Project Sites', ['id' => $project->prj_id, 'ps_id' => $site->prj_site_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('Delete Project Sites', ['id' => $project->prj_id, 'ps_id' => $site->prj_site_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $site->prj_site_date }}</td>
                                    <td>{{ $site->brand->brand_name }}</td>
                                    <td>{{ $site->province->province_name }}</td>
                                    <td>{{ $site->city->city_name }}</td>
                                    <td>{{ $site->barangay->barangay_name ?? '--'}}</td>
                                    <td>{{ $site->prj_site_longitude }}</td>
                                    <td>{{ $site->prj_site_latitude }}</td>
                                    <td>{{ $site->prj_site_elevation }}</td>
                                    <td>{{ $site->prj_site_remarks }}</td>
                                    <td>{{ date('m/d/Y h:i:s a',strtotime($site->date_encoded))  }} <br> by {{ $site->encoder }}</td>
                                    <td>{{ date('m/d/Y h:i:s a',strtotime($site->last_updated))  }} <br> by {{ $site->updater }}</td>
                                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-12">
                <div class="d-flex justify-content-center">{{  $sites->appends(Request::all())->links() }}</div>
                
                {{-- {{ $psi_projects->appends(Request::only('search'))->links('vendor.pagination.bootstrap-4') }} --}}
            </div>
        </div>
    </div>
</div>
<script>
    let map;

    function initialize() { // Initialize Google Maps
        map = new google.maps.Map(document.getElementById("map3"), {
            center: { llat: 14.171, lng: 121.223 },
            zoom: 16,
        });

    }

    
    
    var t =  $('#mydatatable').DataTable({
        deferRender:    true,
        searching:      false,
        paging:         false,
        orderable:      false,
        targets:        0,
    });
    var min = 2000;
    max = new Date().getFullYear();
    select = document.getElementById('qyear');

    for (var i = min; i<=max; i++){
        var opt = document.createElement('option');
        opt.value = i;
        opt.innerHTML = i;
        select.appendChild(opt);
    }

    select.value = new Date().getFullYear();
    $("#qyear").prop("selectedIndex", 0);

    $(document).ready( function () {

        table.on( 'draw.dt', function () {
            var PageInfo = $('#mydatatable').DataTable().page.info();
            table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
            });
    }).draw();

});
</script>
@endsection