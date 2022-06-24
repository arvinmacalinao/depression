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
        <h3><strong>Project S & T Interventions (Add)</strong></h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Project SATS Save', ['id' => $id, 'sat_id' => $sat_id]) }}" method="POST" files="true" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="sat_date" class="control-label"><Strong>Intervention Date *</Strong></label>
                <input class="form-control input-sm date-picker" placeholder="Date Acquired" maxlength="10" name="sat_date" id="sat_date" type="text" value="{{ old('sat_date', $sat->sat_date) }}">
                </div>
            <div class="form-group">
                <label for="satt_id" class="control-label"><Strong>Type *</Strong></label>
                <select class="form-control input-sm" id="satt_id" name="satt_id">
                @foreach ($sel_types as $type)
                <option value="{{ $type->satt_id }}" {{ old('satt_id', $sat->satt_id) == $type->satt_id ? 'selected' : '' }}>{{ $type->satt_name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sat_file" class="control-label"><strong>Document *</strong></label>
                @if ($sat->sat_file != NULL)
                    <a href="{{ $sat->document1() }}" target="_blank" title="View {{ $sat->sat_filename }}"><span class="fa fa-file-text"></span> Current File ({{ $sat->sat_filename }})</a><br>
                @endif
                <input class="form-control input-sm" placeholder="Document" name="sat_file" id="sat_file" type="file" accept="application/ms*,application/vnd.ms*">
            </div>
            <div class="form-group">
                <label for="sat_remarks" class="control-label"><Strong>Remarks</Strong></label>
                <textarea class="form-control input-sm" placeholder="Remarks" name="sat_remarks" id="sat_remarks" cols="50" rows="4">{{ old('sat_remarks', $sat->sat_remarks) }}</textarea>
            </div>
        <input class="save-btn" type="submit" name="save" id="save" value="Save">
        </form>
    </div>
</div>
<script type="text/javascript"> 
    $(document).ready(function() {

    $('.date-picker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayBtn: true,
        todayHighlight: true
    });
});


</script>
@endsection
