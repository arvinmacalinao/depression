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
                    <a class="projectdetails-btn" href="{{ route('New Document', ['id' => $project->prj_id, 'con_id' => $consultancy->con_id]) }}" title="Edit"><span class="fa fa-plus"></span> Add Document</a>
                    <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
                </div>
                <h3><strong>Project Consultancy Documents</strong></h3>
                <p> 
                    Service Provider : {{ $consultancy->serviceprovider->sp_name }}<br>
                    Category : {{ $consultancy->consultancytype->con_type_name }}<br>
                    Consultancy Start : {{ $consultancy->con_start }}<br>
                    Consultancy End : {{ $consultancy->con_end }}<br>
                    Consultancy Encoded on {{ date('m/d/Y h:i:s a',strtotime($consultancy->date_encoded))  }} by {{ $consultancy->encoder }} <br>
                    Consultancy Last updated {{ date('m/d/Y h:i:s a',strtotime($consultancy->date_encoded))  }} by {{ $consultancy->encoder }} 
                </p>
    </div>
    <div class="card-body">
        <div class="row">
            <form action="" method="GET" autocomplete="off">
                <div class="col-sm-auto">
                    <div class="input-group input-group-sm">
                        <input class="form-control input-sm" placeholder="Filename ..." type="text" maxlength="255" name="qsearch" id="qsearch" value="">
                        <input class="projectdetails-btn btn-sm" type="submit" name="search" id="search" value="Search">
                    </div>
                    {{-- {{ old('search', $project_search) }} --}}
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
                    <th >Document</th>
                    <th >Remarks</th>
                    <th >Date Uploaded</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($documents as $document)
                    <tr>
                        <td>
                            <a href="{{ $document->document1() }}" target="_blank" class="project-btn mr-1" title="View"><i class="fa fa-folder-open-o"></i></a>
                            <a href="{{ route('Edit Document', ['id' => $project->prj_id, 'con_id' => $consultancy->con_id, 'doc_id' => $document->condoc_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('Delete Document', ['id' => $project->prj_id, 'con_id' => $consultancy->con_id, 'doc_id' => $document->condoc_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td><a href="{{ $document->document1() }}" target="_blank" title="View">{{ $document->condoc_filename }}</a></td>
                        <td>{{ $document->condoc_remarks }}</td>
                        <td>{{ date('m/d/Y',strtotime($document->date_encoded)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>
    <div class="card-footer">
        
    </div>
</div>
<script>
   
</script>
@endsection