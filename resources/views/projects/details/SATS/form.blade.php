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
        <h3><strong>Project Documentation (Add)</strong></h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Project Documentation Save', ['id' => $id, 'doc_id' => $doc_id]) }}" method="POST" files="true" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="doctype_id" class="control-label"><Strong>Document Type *</Strong></label>
                <select class="form-control input-sm" id="doctype_id" name="doctype_id">
                @foreach ($sel_doctypes as $type)
                <option value="{{ $type->doctype_id }}" {{ old('doctype_id', $documentation->doctype_id) == $type->doctype_id ? 'selected' : '' }}>{{ $type->doctype_name }}</option>
                @endforeach
                <option value="">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="doc_file" class="control-label"><strong>Document *</strong></label>
                @if ($documentation->doc_file != NULL)
                    <a href="{{ $documentation->document1() }}" target="_blank" title="View {{ $documentation->doc_filename }}"><span class="fa fa-file-text"></span> Current File ({{ $documentation->doc_filename }})</a><br>
                @endif
                <input class="form-control input-sm" placeholder="Document" name="doc_file" id="doc_file" type="file" accept="application/ms*,application/vnd.ms*">
            </div>
            <div class="form-group">
                <label for="doc_remarks" class="control-label"><Strong>Remarks</Strong></label>
                <textarea class="form-control input-sm" placeholder="Remarks" name="doc_remarks" id="doc_remarks" cols="50" rows="4">{{ old('doc_remarks', $documentation->doc_remarks) }}</textarea>
            </div>
        <input class="save-btn" type="submit" name="save" id="save" value="Save">
        </form>
    </div>
</div>

@endsection