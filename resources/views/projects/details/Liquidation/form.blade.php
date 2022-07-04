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
        <h3><strong>Project Liquidation (Add)</strong></h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Project Liquidation Save', ['id' => $id, 'liq_id' => $liq_id]) }}" method="POST" files="true" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="liqtype_id" class="control-label"><Strong>Type *</Strong></label>
                <select class="form-control input-sm" id="liqtype_id" name="liqtype_id">
                @foreach ($sel_types as $type)
                <option value="{{ $type->liqtype_id }}" {{ old('liqtype_id', $liquidation->liqtype_id) == $type->liqtype_id ? 'selected' : '' }}>{{ $type->liqtype_name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="liq_file" class="control-label"><strong>Document *</strong></label>
                @if ($liquidation->liq_file != NULL)
                    <a href="{{ $liquidation->document1() }}" target="_blank" title="View {{ $liquidation->liq_filename }}"><span class="fa fa-file-text"></span> Current File ({{ $liquidation->liq_filename }})</a><br>
                @endif
                <input class="form-control input-sm" placeholder="Document" name="liq_file" id="liq_file" type="file" accept="application/ms*,application/vnd.ms*">
            </div>
            <div class="form-group">
                <label for="liq_remarks" class="control-label"><Strong>Remarks</Strong></label>
                <textarea class="form-control input-sm" placeholder="Remarks" name="liq_remarks" id="liq_remarks" cols="50" rows="4">{{ old('liq_remarks', $liquidation->liq_remarks) }}</textarea>
            </div>
        <input class="save-btn" type="submit" name="save" id="save" value="Save">
        </form>
    </div>
</div>
<script type="text/javascript"> 
  
</script>
@endsection
