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
            <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
        </div>
        <h3><strong>Project Fora/Trainings/Seminars Details</strong></h3>
        <h4 class="m-0">
            <span class="project-title"><strong>{{ $training->fr_title }}</strong></span><br>
        </h4>
        <p class="pt-2">
            Encoded on {{ date('m/d/Y h:i:s a',strtotime($training->date_encoded))  }} by {{ $training->encoder }}<br>
            Last updated {{ date('m/d/Y h:i:s a',strtotime($training->date_encoded))  }} by {{ $training->encoder }} 
        </p>
    </div>
    <div class="card-body">
        <form action="{{ route('Project Training Document Save', ['id' => $id, 'fr_id' => $fr_id, 'frdoc_id' => $frdoc_id]) }}" method="POST" files="true" enctype="multipart/form-data">
            {{--  --}}
            @csrf
            <div class="form-group">
                <label for="frdoc_file" class="control-label"><strong>Document *</strong></label>
                @if ($document->frdoc_file != NULL)
                    <a href="{{ $document->document1() }}" target="_blank" title="View {{ $document->frdoc_filename }}"><span class="fa fa-file-text"></span> Current File ({{ $document->frdoc_filename }})</a><br>
                @endif
                <input class="form-control input-sm" placeholder="Document" name="frdoc_file" id="frdoc_file" type="file" accept="application/ms*,application/vnd.ms*">
            </div>
            <div class="form-group">
                <label for="fdoctype_id" class="control-label"><Strong>Document Type</Strong></label>
                <select class="form-control input-sm" id="fdoctype_id" name="fdoctype_id">
                @foreach ($sel_doctypes as $type)
                <option value="{{ $type->fdoctype_id }}"{{ old('fdoctype_id', $document->fdoctype_id) == $type->fdoctype_id ? 'selected' : '' }}>{{ $type->fdoctype_name }}</option>
                @endforeach
                <option value="">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="frdoc_remarks" class="control-label"><Strong>Remarks</Strong></label>
                <textarea class="form-control input-sm" placeholder="Remarks" name="frdoc_remarks" id="frdoc_remarks" cols="50" rows="4">{{ old('frdoc_remarks', $document->frdoc_remarks) }}</textarea>
            </div>
        <input class="save-btn" type="submit" name="save" id="save" value="Save">
        </form>
    </div>
</div>

@endsection