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
        <h3>Project Testing & Calibrations
            <div class="pull-right">
                <a href="{{ route('New Calibration', $project->prj_id) }}" class="projectdetails-btn pr"><span class="fa fa-plus"></span> Add Testing/Calibration</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="" method="GET" autocomplete="off">
            <div class="form-row">
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Laboratory</span>
                        </div>
                        <select class="form-control input-sm mr-2" id="qlab" name="qlab">
                            <option value="">ALL</option>
                            @foreach ($sel_labs as $lab)
                            <option value="{{ $lab->lab_id }}">{{ $lab->lab_abbr }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Implementor</span>
                        </div>
                        <select class="form-control input-sm mr-2" id="qimp" name="qimp">
                            <option value="">ALL</option>
                            @foreach ($sel_ugs as $ug)
                            <option value="{{ $ug->ug_id }}">{{ $ug->ug_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Year</span>
                        </div>
                        <select class="form-control input-sm" id="qyear" name="qyear">
                            <option value="">ALL</option>
                            @foreach ($sel_years as $year)
                            <option value="{{ $year->cal_year }}">{{ $year->cal_year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto mb-2">
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
                <tr style="text-align: center">
                    <th width="6%">&nbsp;</th>
                    <th width="1%">#</th>
                    <th >Laboratory</th>
                    <th >Year</th>
                    <th width="3%">Month</th>
                    <th width="10%" style="text-align: center">No. of Parameters Tested</th>
                    <th >Parameters</th>
                    <th width="10%">No. of Products Tested</th>
                    <th >Products</th>
                    <th >Remarks</th>
                    <th >Encoded</th>
                    <th >Updated</th>
                    <th >Implementor</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($calibrations as $calibration)
                                <tr>
                                    <td>
                                        <a href="{{ route('Edit Calibration', ['id' => $project->prj_id, 'cal_id' => $calibration->cal_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('Delete Calibration', ['id' => $project->prj_id, 'cal_id' => $calibration->cal_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td>{{ $calibration->laboratories->lab_name }}</td>
                                    <td style="text-align: center">{{ $calibration->cal_year }}</td>
                                    <td>{{ date("F", mktime(0, 0, 0, $calibration->cal_month, 1)) }}</td>
                                    <td style="text-align: center">{{ $calibration->cal_no_parameters }}</td>
                                    <td>{{ $calibration->cal_parameters }}</td>
                                    <td style="text-align: center">{{ $calibration->cal_no_products }}</td>
                                    <td>{{ $calibration->cal_products }}</td>
                                    <td>{{ $calibration->cal_remarks }}</td>
                                    <td>{{ date('m/d/Y h:i:s a',strtotime($calibration->date_encoded))  }} <br> by {{ $calibration->encoder }}</td>
                                    <td>{{ date('m/d/Y h:i:s a',strtotime($calibration->last_updated))  }} <br> by {{ $calibration->updater }}</td>
                                    <td>{{ $calibration->usergroups->ug_name }}</td>
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