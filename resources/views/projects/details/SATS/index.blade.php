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
        <div class="pull-right">
            {{--  --}}
            <a class="projectdetails-btn" href="{{ route('New Project SATS', ['id' => $project->prj_id]) }}" title="Edit"><span class="fa fa-plus"></span> Add Document</a>
        </div>
        <h3><strong>Project S & T Interventions</strong></h3>
    </div>
    <div class="card-body">
        <div class="row">
            <form action="" method="GET" autocomplete="off">
                <div class="form-row">
                    <div class="col-sm-auto mb-2  ml-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Type</span>
                            </div>
                            <select class="form-control input-sm" id="qtype" name="qtype">
                                <option value="">ALL</option>
                                @foreach ($sel_types as $type)
                                <option value="{{ $type->satt_id }}">{{ $type->satt_name }}</option>
                                @endforeach
                            </select>
                          </div>
                    </div>
                    <div class="col-sm-auto mb-2  ml-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Year</span>
                            </div>
                            <select class="form-control input-sm" id="qyear" name="qyear">
                            <option value="">ALL</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-sm-auto mb-2  ml-2">
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
                            <input class="form-control input-sm" placeholder="Filename..." type="text" maxlength="255" name="qsearch" id="qsearch" value="">
                            {{-- {{ old('search', $doc_search) }} --}}
                            <input class="projectdetails-btn btn-sm" type="submit"  value="Search">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
            <thead>
                <tr>
                    <th width="6%">&nbsp;</th>
                    <th width="3%" style="text-align: center">#</th>
                    <th width="10%">Intervention Date</th>
                    <th>Type</th>
                    <th width="30%">Document</th>
                    <th>Remarks</th>
                    <th>Encoded</th>
                    <th>Updated</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($sats as $sat)
                    <tr>
                        <td>               
                            <a href="{{ $sat->document1() }}" target="_blank" class="project-btn mr-1" title="View"><i class="fa fa-folder-open-o"></i></a>
                            <a href="{{ route('Edit Project SATS', ['id' => $project->prj_id, 'sat_id' => $sat->sat_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('Delete Project SATS', ['id' => $project->prj_id, 'sat_id' => $sat->sat_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td>{{ $sat->sat_date }}</td>
                        <td>
                            @if ($sat->satt_id == 0)
                            --
                            @else
                                {{ $sat->sattype->satt_name }}
                            @endif
                            </td>   
                        <td><a href="{{ $sat->document1() }}" target="_blank" title="View">{{ $sat->sat_filename }}</a></td>
                        <td>{{ $sat->sat_remarks }}</td>
                        <td>{{ date('m/d/Y h:i:s a',strtotime($sat->date_encoded))  }} <br> by {{ $sat->encoder }}</td>
                        <td>{{ date('m/d/Y h:i:s a',strtotime($sat->last_updated))  }} <br> by {{ $sat->encoder }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-12">
                {{-- <div class="d-flex justify-content-center">{{  $sats->appends(Request::all())->links() }}</div> --}}
            </div>
        </div>
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
</script>
@endsection