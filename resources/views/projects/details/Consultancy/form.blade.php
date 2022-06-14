@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header">
        <h3>Project PIS Add
            <div class="pull-right">
                <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Consultancy Save', ['id' => $id, 'con_id' => $con_id]) }}" method="POST">
            @csrf
            <div class="form-group form-group-sm">
                <label for="sp_id" class="control-label"><Strong>Service Provider *</Strong></label>
                <select class="form-control input-sm" id="sp_id" name="sp_id">
                @foreach ($sel_suppliers as $supplier)
                <option value="{{ $supplier->sp_id }}"{{ old('sp_id', $consultancy->sp_id) == $supplier->sp_id ? 'selected' : '' }}>{{ $supplier->sp_name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group form-group-sm">
                <label for="sp_id" class="control-label"><Strong>Consultancy Type</Strong></label>
                <select class="form-control input-sm" id="con_type_id" name="con_type_id">
                @foreach ($sel_categories as $category)
                <option value="{{ $category->con_type_id }}"{{ old('con_type_id', $consultancy->con_type_id) == $category->con_type_id ? 'selected' : '' }}>{{ $category->con_type_name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group form-group-sm">
                <label for="cal_parameters" class="control-label"><Strong>Consultancy Start *</Strong></label>
                <input class="form-control input-sm date-picker" placeholder="Consultancy Start" maxlength="10" required="required" name="con_start" id="from_date_time" type="text" value="{{ old('from_date_time', $consultancy->con_start) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="cal_parameters" class="control-label"><Strong>Consultancy End *</Strong></label>
                <input class="form-control input-sm date-picker" placeholder="Consultancy End" maxlength="10" required="required" name="con_end" id="to_date_time" type="text" value="{{ old('to_date_time', $consultancy->con_end) }}">
            </div>
    
            <div class="form-group form-group-sm">
                <label for="cal_no_products" class="control-label"><Strong>No. of Participants *</Strong></label>
                <input class="form-control input-sm" placeholder="No. of Participants" min="0" step="1" required="required" name="con_no_participants" id="con_no_participants" type="number" value="{{ old('con_no_participants', $consultancy->con_no_participants) }}">
            </div>
    
            <div class="form-group form-group-sm">
                <label for="cal_products" class="control-label"><Strong>No. of Firms *</Strong></label>
                <input class="form-control input-sm" placeholder="No. of Firms" min="0" step="1" required="required" name="con_no_firms" id="con_no_firms" type="number" value="{{ old('con_no_firms', $consultancy->con_no_firms) }}">
            </div>
    
            <div class="form-group form-group-sm">
                <label for="cal_income" class="control-label"><Strong>No. of PO *</Strong></label>
                <input class="form-control input-sm" placeholder="No. of PO" min="0" step="1" required="required" name="con_no_po" id="con_no_po" type="number" value="{{ old('con_no_po', $consultancy->con_no_po) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="cal_income" class="control-label"><Strong>Cost *</Strong></label>
                <input class="form-control input-sm" placeholder="Cost" min="0" step="any" required="required" name="con_cost" id="con_cost" type="number" value="{{ old('con_cost', $consultancy->con_cost) }}">
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