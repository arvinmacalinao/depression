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
        <h3>Project Progress Report Targets
            <div class="pull-right">
                <div class="btn-group">
                    <a href="{{ route('Progress Reports', $project->prj_id) }}" class="projectdetails-btn pr"><span class="fa fa-bullseye"></span> Progress Reports</a>
                    <a href="{{ route('New Progress Report Target', $project->prj_id) }}" class="projectdetails-btn-success"><span class="fa fa-plus"></span> Add Targets</a>
                </div>
                
            </div>
        </h3>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width: 100%" id="">
            <thead>
                <tr style="text-align: center">
                    <th width="3%">&nbsp;</th>
                    <th >Order</th>
                    <th width="60%">Target Activities for the Period (Relate to Form 2B-1)</th>
                    <th >Encoded</th>
                    <th >Updated</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($targets as $target)
                                <tr class="{{ $target->prjprogtarget_category >= 1 ? "is-marked" : ""}}">
                                    <td>
                                        <a href="{{ route('Edit Progress Report Target', ['id' => $project->prj_id, 'tar_id' => $target->prjprogtarget_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('Delete Progress Report Target', ['id' => $project->prj_id, 'tar_id' => $target->prjprogtarget_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                    <td style="text-align: center">{{ $target->prjprogtarget_order }}</td>
                                    <td>{{ $target->prjprogtarget_target }}</td>
                                    <td>{{ date('m/d/Y h:i:s a',strtotime($target->date_encoded))  }} <br> by {{ $target->encoder }}</td>
                                    <td>{{ date('m/d/Y h:i:s a',strtotime($target->last_updated))  }} <br> by {{ $target->updater }}</td>
                                </tr>
                @endforeach
                {{-- @if ($target->prjprogtarget_category >= 0)
                    <tr>
                        <td colspan="6">
                            {{ $target->prjprogtarget_target }}
                        </td>
                    </tr>
                @else --}}
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
        order: [[ 1, 'desc' ]]
    }); 
</script>
@endsection