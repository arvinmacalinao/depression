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
        <h3>Project Photos
            <div class="pull-right">
                <a href="{{ route('New Project Album', $project->prj_id) }}" class="projectdetails-btn pr"><span class="fa fa-plus"></span> Add Album</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="" method="GET" autocomplete="off">
            <div class="form-row">
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
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
            <thead>
                <tr>
                    <th width="6%">&nbsp;</th>
                    <th width="1%">#</th>
                    <th >Album Name</th>
                    <th >Description</th>
                    <th >Category</th>
                    <th >Date Uploaded</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($albums as $album)
                                <tr>
                                    <td>
                                        <a href="{{ route('View Project Album', ['id' => $project->prj_id, 'album_id' => $album->album_id]) }}" class="project-btn mr-1" title="View"><i class="fa fa-folder-open-o"></i></a>
                                        <a href="{{ route('Edit Project Album', ['id' => $project->prj_id, 'album_id' => $album->album_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('Delete Project Album', ['id' => $project->prj_id, 'album_id' => $album->album_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td><a href="" target="_blank" title="View {{ $album->album_name }}">{{ $album->album_name }}</a></td>
                                    <td>{{ $album->album_desc }}</td>
                                    <td>{{ $album->type->album_type_name }}</td>
                                    <td>{{ date('m/d/Y h:i:s a',strtotime($album->date_encoded))  }}</td>
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