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
        <h3>Project Packaging & Labeling
            <div class="pull-right">
                <a href="{{ route('New Packaging', $project->prj_id) }}" class="projectdetails-btn pr"><span class="fa fa-plus"></span> Add</a>
                
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="" method="GET" autocomplete="off">
            <div class="form-row">
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Year</span>
                        </div>
                        <select class="form-control input-sm mr-2" id="qyear" name="qyear">
                            <option value="">ALL</option>
                            {{-- @foreach ($sel_years as $year)
                            <option value="{{ $year->lab_id }}">{{ $lab->lab_abbr }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Quarter</span>
                        </div>
                        <select class="form-control input-sm mr-2" id="qqtr" name="qqtr">
                            <option value="">ALL</option>
                            {{-- @foreach ($sel_ugs as $ug)
                            <option value="{{ $ug->ug_id }}">{{ $ug->ug_name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <input class="form-control input-sm" placeholder="Products..." type="text" maxlength="255" name="q" id="q" value="">
                        <input class="projectdetails-btn btn-sm" type="submit" name="search" id="search" value="Search">
                    </div>
                    {{-- {{ old('search', $project_search) }} --}}
                </div>
            </div>
        </form>
        
    </div>
    <div class="alert alert-warning" role="alert">
        <p class="mt-2">Please Update No. of New Markets Penetrated.<br>
            Please specify where the design was applied to as then product name if it is not applied to a particular product.<br>
            Ex. Company X Logo</p>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
            <thead>
                <tr>
                    <th width="6%">&nbsp;</th>
                    <th width="1%">#</th>
                    <th >Date</th>
                    <th >Product</th>
                    <th >No. of New Markets Penetrated</th>
                    <th >New Markets Penetrated</th>
                    <th >Increase in Sales</th>
                    <th >Remarks</th>
                    <th >Encoded</th>
                    <th >Updated</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($packagings as $packaging)
                                <tr>
                                    <td>
                                        <a href="{{ route('View Packaging', ['id' => $project->prj_id, 'pack_id' => $packaging->pkg_id]) }}" class="project-btn mr-1" title="View"><i class="fa fa-folder-open-o"></i></a>
                                        <a href="{{ route('Designs', ['id' => $project->prj_id, 'pack_id' => $packaging->pkg_id]) }}" class="project-btn mr-1" title="View Designs"><i class="fa fa-file-image-o"></i></a>
                                        <a href="{{ route('Edit Packaging', ['id' => $project->prj_id, 'pack_id' => $packaging->pkg_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('Delete Packaging', ['id' => $project->prj_id, 'pack_id' => $packaging->pkg_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td>{{ $packaging->pkg_date }}</td>
                                    <td>{{ $packaging->pkg_product_name }}</td>
                                    <td>{{ $packaging->pkg_no_new_markets }}</td>
                                    <td>{{ $packaging->pkg_market_location }}</td>
                                    <td>{{ $packaging->pkg_sales_after_intervention }}</td>
                                    <td>{{ $packaging->pkg_remarks }}</td>
                                    <td>{{ date('m/d/Y h:i:s a',strtotime($packaging->date_encoded))  }} <br> by {{ $packaging->encoder }}</td>
                                    <td>{{ date('m/d/Y h:i:s a',strtotime($packaging->last_updated))  }} <br> by {{ $packaging->updater }}</td>
                                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
<script>
    var t =  $('#mydatatable').DataTable({
        deferRender:    true,
        searching:      false,
        paging:         false,
        orderable:      false,
        targets:        0,
        order: [[ 1, 'asc' ]]
    }); 
</script>
@endsection