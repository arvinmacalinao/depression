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
            <a class="projectdetails-btn" href="" title="Edit"><span class="fa fa-plus"></span> Add Document</a>
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
        <form action=" {{ route('Document Save', ['id' => $id, 'con_id' => $con_id, 'doc_id' => $doc_id]) }}" method="POST" files="true" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="condoc_file" class="control-label"><strong>Document *</strong></label>
                @if ($document->condoc_file != NULL)
                    <a href="{{ $document->document1() }}" target="_blank" title="View {{ $document->condoc_filename }}"><span class="fa fa-file-text"></span> Current File ({{ $document->condoc_filename }})</a><br>
                @endif
                <input class="form-control input-sm" placeholder="Document" name="condoc_file" id="condoc_file" type="file" accept="application/ms*,application/vnd.ms*">
            </div>
            <div class="form-group">
                <label for="condoc_remarks" class="control-label"><Strong>Remarks</Strong></label>
                <textarea class="form-control input-sm" placeholder="Remarks" name="condoc_remarks" id="condoc_remarks" cols="50" rows="4">{{ old('condoc_remarks', $document->condoc_remarks) }}</textarea>
            </div>
        <input class="save-btn" type="submit" name="save" id="save" value="Save">
        </form>
    </div>
</div>

@endsection