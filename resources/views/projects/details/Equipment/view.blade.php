@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header">                  
        <h3>Project Equipment Details
            <div class="pull-right">
                <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
            </div>
        </h3>
        
    </div>
    <div class="card-body">
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="sp_id" class="control-label"><strong>Supplier.</strong></label>
                <input type="text" class="form-control-viewproj" id="sp_id" readonly value="{{ $equipment->suppliers->sp_name }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="brand_id" class="control-label"><strong>Brand</strong></label>
                <input type="text" class="form-control-viewproj" id="brand_id" readonly value="{{ $equipment->brands->brand_name }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="eqp_property_no" class="control-label"><strong>Property No.</strong></label>
                <input type="text" class="form-control-viewproj" id="eqp_property_no" readonly value="{{ $equipment->eqp_property_no }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="eqp_specs" class="control-label"><strong>Equipment Specifications</strong></label>
                <input type="text" class="form-control-viewproj" id="eqp_specs" readonly value="{!!  nl2br(e($equipment->eqp_specs)) !!}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="eqp_qty" class="control-label"><strong>Quantity</strong></label>
                <input type="text" class="form-control-viewproj" id="eqp_qty" readonly value="{{ $equipment->eqp_qty }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="eqp_amount_approved" class="control-label"><strong>Amount Approved</strong></label>
                <input type="text" class="form-control-viewproj" id="eqp_amount_approved" readonly value="Php {{ number_format($equipment->eqp_amount_approved,2) }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="eqp_amount_acquired" class="control-label"><strong>Amount Aqcuired</strong></label>
                <input type="text" class="form-control-viewproj" id="eqp_amount_acquired" readonly value="Php {{ number_format($equipment->eqp_amount_acquired,2) }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="eqp_receipt_no" class="control-label"><strong>Receipt No.</strong></label>
                <input type="text" class="form-control-viewproj" id="eqp_receipt_no" readonly value="Php {{ number_format($equipment->eqp_amount_acquired,2) }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="eqp_receipt_date" class="control-label"><strong>Receipt Date</strong></label>
                <input type="text" class="form-control-viewproj" id="eqp_receipt_date" readonly value="{{ $equipment->eqp_receipt_date}}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="eqp_date_acquired" class="control-label"><strong>Date Acquired</strong></label>
                <input type="text" class="form-control-viewproj" id="eqp_date_acquired" readonly value="{{ $equipment->eqp_date_acquired}}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="eqp_warranty" class="control-label"><strong>Warranty</strong></label>
                <input type="text" class="form-control-viewproj" id="eqp_warranty" readonly value="{{ $equipment->eqp_warranty}}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="eqp_date_tagged" class="control-label"><strong>Date Tagged</strong></label>
                <input type="text" class="form-control-viewproj" id="eqp_date_tagged" readonly value="{{ $equipment->eqp_date_tagged}}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="eqp_remarks" class="control-label"><strong>Remarks</strong></label>
                <input type="text" class="form-control-viewproj" id="eqp_remarks" readonly value="{{ $equipment->eqp_remarks}}">
            </div>
        </div>
    </div>
</div>
<script>
   
</script>
@endsection