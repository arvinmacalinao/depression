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
        <h3>Project Fora/Trainings/Seminars
            <div class="pull-right">
                <a href="{{ route('New Project Training', $project->prj_id) }}" class="projectdetails-btn pr"><span class="fa fa-plus"></span> Add Training</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="" method="GET" autocomplete="off">
            <div class="form-row">
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Type</span>
                        </div>
                        <select class="form-control input-sm mr-2" id="qtype" name="qtype">
                            <option value="">ALL</option>
                            @foreach ($sel_types as $type)
                            <option value="{{ $type->fr_type_id }}">{{ $type->fr_type_name }}</option>
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
                            @foreach ($sel_years as $year)
                            <option value="{{ $year->fr_end_yr }}">{{ $year->fr_end_yr }}</option>
                            @endforeach
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
                            @foreach ($sel_quarters as $qtr)
                            <option value="{{ $qtr->quarter_id }}">{{ $qtr->quarter_name }}</option>
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
                <tr>
                    <th width="6%">&nbsp;</th>
                    <th width="3%">#</th>
                    <th >Type</th>
                    <th width="10%">Start</th>
                    <th width="10%">End</th>
                    <th width="20%">Fora/Trainings/Seminars Title</th>
                    <th >Implementor</th>
                    <th width="3%"># of Male</th>
                    <th width="3%"># of Female</th>
                    <th width="3%"># of PWD</th>
                    <th width="3%"># of Seniors</th>
                    <th width="3%"># of Firms</th>
                    <th width="3%"># of PO</th>
                    <th width="4%">Total Participants</th>
                    <th >CSF Rating</th>
                    <th >Encoded</th>
                    <th >Last Updated</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($trainings as $training)
                                <tr>
                                    <td width="6%">
                                        <a href="{{ route('View Project Training', ['id' => $project->prj_id, 'fr_id' => $training->fr_id]) }}" class="project-btn mr-1" title="View Details"><i class="fa fa-folder-open-o"></i></a>
                                        <a href="{{ route('Project Training Documents', ['id' => $project->prj_id, 'fr_id' => $training->fr_id]) }}" class="project-btn mr-1" title="View Documents"><i class="fa fa-file"></i></a>
                                        <a href="{{ route('Edit Project Training', ['id' => $project->prj_id, 'fr_id' => $training->fr_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('Delete Project Training', ['id' => $project->prj_id, 'fr_id' => $training->fr_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td >{{ $training->type->fr_type_name }}</td>
                                    <td class="text-wrap">{{ date('m/d/Y h:i a',strtotime($training->fr_start))  }}</td>
                                    <td class="text-wrap">{{ date('m/d/Y h:i a',strtotime($training->fr_end))  }}</td>
                                    <td class="text-wrap">{{ $training->fr_title }}</td>
                                    <td class="text-wrap">{{ $training->usergroup->ug_name }}</td>
                                    <td>{{ $training->fr_no_masculine }}</td>
                                    <td>{{ $training->fr_no_feminine }}</td>
                                    <td>{{ $training->fr_no_pwd }}</td>
                                    <td>{{ $training->fr_no_seniors }}</td>
                                    <td>{{ $training->fr_no_firms }}</td>
                                    <td>{{ $training->fr_no_po }}</td>
                                    <td>{{ $training->fr_no_participants }}</td>
                                    <td >{{ $training->fr_csf }}</td>
                                    <td>{{ date('m/d/Y h:i:s a',strtotime($training->date_encoded))  }} <br> by {{ $training->encoder }}</td>
                                    <td>{{ date('m/d/Y h:i:s a',strtotime($training->last_updated))  }} <br> by {{ $training->updater }}</td>
                                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <div class="card-footer">
        <div class="table-responsive">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th class="text-center">Total No. of Releases</th>
                    <th class="text-center">Total No. of Female</th>
                    <th class="text-center">Total No. of Male</th>
                    <th class="text-center">Total No. of PWD</th>
                    <th class="text-center">Total No. of Seniors</th>
                    <th class="text-center">Total No. of Firms</th>
                    <th class="text-center">Total No. of PO</th>
                    <th class="text-center">Total No. of Participants</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">
                        {{ $trainings->total() }}
                    </td>
                    <td class="text-center">
                        {{ $trainings->sum('fr_no_feminine') }}
                    </td>
                    <td class="text-center">
                        {{ $trainings->sum('fr_no_masculine') }}
                    </td>
                    <td class="text-center">
                        {{ $trainings->sum('fr_no_pwd') }}
                    </td>
                    <td class="text-center">
                        {{ $trainings->sum('fr_no_seniors') }}
                    </td>
                    <td class="text-center">
                        {{ $trainings->sum('fr_no_firms') }}
                    </td>
                    <td class="text-center">
                        {{ $trainings->sum('fr_no_po') }}
                    </td>
                    <td class="text-center">
                        {{ $trainings->sum('fr_no_participants') }}
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
    </div>
</div>

<script type="text/javascript">
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