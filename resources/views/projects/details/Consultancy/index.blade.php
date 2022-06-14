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
        <h3>Project Consultancies
            <div class="pull-right">
                <a href="{{ route('New Consultancy', $project->prj_id) }}" class="projectdetails-btn pr"><span class="fa fa-plus"></span> Add Consultancy</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="" method="GET" autocomplete="off">
            <div class="form-row">
                <div class="col-sm-auto pr-0">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Category</span>
                        </div>
                        <select class="form-control input-sm mr-2" id="qlab" name="qlab">
                            <option value="">ALL</option>
                            @foreach ($sel_category as $category)
                            <option value="{{ $category->con_type_id }}">{{ $category->con_type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto pr-0">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Year</span>
                        </div>
                            <select class="form-control input-sm mr-2" id="qimp" name="qimp">
                            <option value="">ALL</option>
                            @foreach ($sel_years as $year)
                                <option value="{{ $year->con_end_yr }}">{{ $year->con_end_yr }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto pr-0">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Quarter</span>
                        </div>
                        <select class="form-control input-sm" id="qyear" name="qyear">
                            <option value="">ALL</option>
                            @foreach ($sel_quarters as $quarter)
                                <option value="{{ $quarter->quarter_id }}">{{ $quarter->quarter_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="input-group input-group-sm">
                        <input class="projectdetails-btn btn-sm" type="submit" name="search" id="search" value="Search">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
            <thead>
                <tr>
                    <th width="6%">&nbsp;</th>
                    <th >#</th>
                    <th >Category</th>
                    <th >Service Provider</th>
                    <th >No. of Participants</th>
                    <th >No. of Firms Assisted</th>
                    <th >No. of PO Assisted</th>
                    <th >Start</th>
                    <th >End</th>
                    <th >Encoded</th>
                    <th >Updated</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($consultancies as $consultancy)
                    <tr>
                        <td>
                            <a href="{{ route('Consultancy Documents', ['id' => $project->prj_id, 'con_id' => $consultancy->con_id]) }}" class="project-btn mr-1" title="View"><i class="fa fa-folder-open-o"></i></a>
                            <a href="{{ route('Edit Consultancy', ['id' => $project->prj_id, 'con_id' => $consultancy->con_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('Delete Consultancy', ['id' => $project->prj_id, 'con_id' => $consultancy->con_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td>{{ $consultancy->consultancytype->con_type_name }}</td>
                        <td>{{ $consultancy->serviceprovider->sp_name }}</td>
                        <td style="text-align: center">{{ $consultancy->con_no_participants }}</td>
                        <td style="text-align: center">{{ $consultancy->con_no_firms }}</td>
                        <td style="text-align: center">{{ $consultancy->con_no_po }}</td>
                        <td>{{ date('m/d/Y',strtotime($consultancy->con_start)) }}</td>
                        <td>{{ date('m/d/Y',strtotime($consultancy->con_end)) }}</td>
                        <td>{{ date('m/d/Y h:i:s a',strtotime($consultancy->date_encoded))  }} <br> by {{ $consultancy->encoder }}</td>
                        <td>{{ date('m/d/Y h:i:s a',strtotime($consultancy->last_updated))  }} <br> by {{ $consultancy->updater }}</td>
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