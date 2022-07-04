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
        <form action="" method="POST">
            {{-- {{ route('Product Save', ['id' => $id, 'pis_id' => $pis_id]) }} --}}
            @csrf
            <div class="form-group form-group-sm">
                <label for="sp_id" class="control-label"><Strong>Service Provider *</Strong></label>
                <select class="form-control input-sm" id="sp_id" name="sp_id">
                <option value=""></option>
                </select>
            </div>
            <div class="form-group form-group-sm">
                <label for="cal_parameters" class="control-label"><Strong>Date</Strong></label>
                <input class="form-control input-sm date-picker" placeholder="Date Tagged" maxlength="10" name="eqp_date_tagged" id="eqp_date_tagged" type="text" value="">
            </div>
            <div class="form-group form-group-sm">
                <label for="cal_no_tests_free" class="control-label"><Strong></Strong></label>
                <input class="form-control input-sm" placeholder="No. of Non-Payed Services Rendered" min="0" step="1" required="required" name="cal_no_tests_free" id="cal_no_tests_free" type="number" value="">
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