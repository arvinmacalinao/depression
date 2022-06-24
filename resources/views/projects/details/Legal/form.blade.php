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
        <h3><strong>Project Legal Documents (Add)</strong></h3>
    </div>
    <div class="card-body">
        {{--  --}}
        <form action="{{ route('Project Legal Save', ['id' => $id, 'legal_id' => $legal_id]) }}" method="POST" files="true" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="legal_file" class="control-label"><strong>Document *</strong></label>
                @if ($legal->legal_file != NULL)
                    <a href="{{ $legal->document1() }}" target="_blank" title="View {{ $legal->legal_filename }}"><span class="fa fa-file-text"></span> Current File ({{ $legal->legal_filename }})</a><br>
                @endif
                <input class="form-control input-sm" placeholder="Document" name="legal_file" id="legal_file" type="file" accept="application/ms*,application/vnd.ms*">
            </div>
            <div class="form-group">
                <label for="legal_remarks" class="control-label"><Strong>Remarks</Strong></label>
                <textarea class="form-control input-sm" placeholder="Remarks" name="legal_remarks" id="legal_remarks" cols="50" rows="4">{{ old('legal_remarks', $legal->legal_remarks) }}</textarea>
                
            </div>
        <input class="save-btn" type="submit" name="save" id="save" value="Save">
        </form>
    </div>
</div>
<script type="text/javascript"> 
  
</script>
@endsection
