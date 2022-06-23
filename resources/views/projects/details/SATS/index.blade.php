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
            {{-- {{ route('New Project documentation', ['id' => $project->prj_id]) }} --}}
            <a class="projectdetails-btn" href="" title="Edit"><span class="fa fa-plus"></span> Add Document</a>
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
                              <span class="input-group-text" id="inputGroup-sizing-sm">Document Type</span>
                            </div>
                            <select class="form-control input-sm" id="qtype" name="qtype">
                                <option value="">ALL</option>
                                {{-- @foreach ($sel_doctypes as $type)
                                <option value="{{ $type->doctype_id }}">{{ $type->doctype_name }}</option>
                                @endforeach --}}
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
                    <th>Intervention Date</th>
                    <th>Type</th>
                    <th>Document</th>
                    <th>Remarks</th>
                    <th>Encoded</th>
                    <th>Updated</th>
                </tr>
            </thead> 
            <tbody>
                {{-- @foreach ($documentations as $documentation)
                    <tr>
                        <td>
                            <a href="{{ $documentation->document1() }}" target="_blank" class="project-btn mr-1" title="View"><i class="fa fa-folder-open-o"></i></a>
                            <a href="{{ route('Edit Project Documentation', ['id' => $project->prj_id, 'doc_id' => $documentation->doc_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('Delete Project Documentation', ['id' => $project->prj_id, 'doc_id' => $documentation->doc_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td><a href="{{ $documentation->document1() }}" target="_blank" title="View">{{ $documentation->doc_filename }}</a></td>
                        <td>
                        @if ($documentation->doctype_id == 0)
                        -
                        @else
                            {{ $documentation->type->doctype_name }}
                        @endif
                        </td>   
                        <td>{{ $documentation->doc_remarks }}</td>
                        <td>{{ date('m/d/Y h:i a',strtotime($documentation->date_encoded)) }}</td>
                    </tr>
                @endforeach --}}
            </tbody>
        
        </table>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-12">
                {{-- <div class="d-flex justify-content-center">{{  $documentations->appends(Request::all())->links() }}</div> --}}
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
</script>
@endsection