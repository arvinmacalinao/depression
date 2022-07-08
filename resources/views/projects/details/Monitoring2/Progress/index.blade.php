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
        <h3>Project Progress Reports
            <div class="pull-right">
                <div class="btn-group">
                    <a href="{{ route('Progress Reports Targets', $project->prj_id) }}" class="projectdetails-btn pr"><span class="fa fa-bullseye"></span> Targets</a>
                    <a href="{{ route('New Progress Reports', $project->prj_id) }}" class="projectdetails-btn-success"><span class="fa fa-plus"></span> Add Progress Report</a>
                </div>
            </div>
        </h3>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
            <thead>
                <tr>
                    <th width="6%">&nbsp;</th>
                    <th width="6%">#</th>
                    <th width="44%">Period From</th>
                    <th width="44%">Period To</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($progress as $row)
                                <tr>
                                    <td>
                                        {{-- {{ route('Edit PIS', ['id' => $project->prj_id, 'pis_id' => $get_pis->prjpis_id]) }}
                                        {{ route('Delete PIS', ['id' => $project->prj_id, 'pis_id' => $get_pis->prjpis_id]) }} --}}
                                        <div class="btn-group">
                                            <a href="" target="_blank" title="Print" class="project-btn"></span><i class="fa fa-print"></i></a>
                                            <a href="" class="project-btn" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            <a href="" class="project-btn" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                    <td style="text-align: center">{{ ++$i }}</td>
                                    <td>{{ date('F', mktime(0, 0, 0, $row->prjprogrep_month_from, 10)) }} {{ $row->prjprogrep_year_from }}</td>
                                    <td>{{ date('F', mktime(0, 0, 0, $row->prjprogrep_month_to, 10)) }} {{ $row->prjprogrep_year_to }}</td>
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
    }); 
</script>
@endsection