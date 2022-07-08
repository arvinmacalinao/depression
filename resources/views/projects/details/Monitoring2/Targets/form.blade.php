@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header">
        <h3>Project Progress Report Targets (Add)
            <div class="pull-right">
                    <a href="{{ route('Progress Reports', $project->prj_id) }}" class="projectdetails-btn pr"><span class="fa fa-bullseye"></span> Progress Reports</a>
                    <a href="{{ URL::previous() }}" class="projectdetails-btn-success"><span class="fa fa-arrow-circle-left"></span> Back</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Progress Report Target Save', ['id' => $id, 'tar_id' => $tar_id]) }}" method="POST">
            @csrf
            <div class="form-group form-group-sm">
                <label for="prjprogtarget_target" class="control-label"><Strong>Target *</Strong></label>
                <textarea class="form-control input-sm" placeholder="Remarks" name="prjprogtarget_target" id="prjprogtarget_target" cols="50" rows="4">{{ old('prjprogtarget_target', $target->prjprogtarget_target) }}</textarea>
            </div>
            <div class="form-group form-group-sm">
                <label for="prjprogtarget_order" class="control-label">Order</label>
                @if ($tar_id != 0)
                <input type="number" min="1" step="1" class="form-control input-sm" placeholder="Order" name="prjprogtarget_order" id="prjprogtarget_order" value="{{ old('prjprogtarget_order', $target->prjprogtarget_order) }}">
                @else
                    <input type="number" min="1" step="1" class="form-control input-sm" placeholder="Order" name="prjprogtarget_order" id="prjprogtarget_order" value="{{ $ordervalue->prjprogtarget_order + 1 }}">
                @endif
               
            </div>
            <div class="form-group form-group-sm">
                <label>
                    <input type="checkbox" name="prjprogtarget_category" id="prjprogtarget_category" value="1" {{ old('prjprogtarget_category', $target->prjprogtarget_category) == '1' ? 'checked' : '' }}>
                    This is a category.
                </label>
            </div>
            <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">
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