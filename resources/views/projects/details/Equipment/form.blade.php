@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header">
        <h3>New Project Equipment
            <div class="pull-right">
                <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Equipment Save', ['id' => $id, 'eq_id' => $eq_id]) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="brand_id" class="control-label"><Strong>Equipment Name</Strong></label>
                        <select class="form-control input-sm" id="brand_id" name="brand_id">
                            @foreach ($sel_brands as $brand)
                            <option value="{{ $brand->brand_id }}"{{ old('brand_id', $equipment->brand_id) == $brand->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="imp_id" class="control-label"><Strong>Improvement For</Strong></label>
                        <select class="form-control input-sm" id="imp_id" name="imp_id">
                            @foreach ($sel_improvements as $improvement)
                            <option value="{{ $improvement->imp_id }}"{{ old('imp_id', $equipment->imp_id) == $improvement->sp_id ? 'selected' : '' }}>{{ $improvement->imp_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <span class="label label-primary mb-2" style="display: inline-block"><h4>Approved Specifications</h4></span>
                    <div class="form-group">
                        <label for="eqp_specs" class="control-label"><Strong>Equipment Specification *</Strong></label>
                        <textarea class="form-control input-sm" placeholder="Equipment Specification" name="eqp_specs" id="eqp_specs" cols="50" rows="4">{{ old('eqp_specs', $equipment->eqp_specs) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="eqp_qty" class="control-label"><Strong>Quantity Approved *</Strong></label>
                        <input class="form-control input-sm" placeholder="Quantity" min="0" step="1" required="required" name="eqp_qty" id="eqp_qty" type="number" value="{{ old('eqp_qty', $equipment->eqp_qty) }}">
                    </div>
                    <div class="form-group">
                        <label for="eqp_amount_approved" class="control-label"><Strong>Amount Approved *</Strong></label>
                        <input class="form-control input-sm" placeholder="Amount Approved" min="0" step="any" required="required" name="eqp_amount_approved" id="eqp_amount_approved" type="number" value="{{ old('eqp_amount_approved', $equipment->eqp_amount_approved) }}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <span class="label label-primary mb-2 d-flex justify-content-between" style="display: inline-block"><h4> Acquired Specifications</h4>
                        <div class="checkbox pull-right title-checkbox-wrapper">
                            <input class="title-checkbox " type="checkbox" name="eqp_acquired" value="1"{{ old('eqp_acquired', $equipment->eqp_acquired) == '1' ? 'checked' : ''}}>
                            Equipment Aquired
                        </div>
                    </span>
                    
                    <div class="form-group">
                    <label for="eqp_specs_acquired" class="control-label"><Strong>Acquired Equipment Specification</Strong></label>
                    <textarea class="form-control input-sm" placeholder="Acquired Equipment Specification" name="eqp_specs_acquired" id="eqp_specs_acquired" cols="50" rows="4">{{ old('eqp_specs_acquired', $equipment->eqp_specs_acquired) }}</textarea>
                    </div>
    
                    <div class="form-group">
                    <label for="eqp_qty_acquired" class="control-label"><Strong>Quantity Acquired *</Strong></label>
                    <input class="form-control input-sm" placeholder="Quantity" min="0" step="1" required="required" name="eqp_qty_acquired" id="eqp_qty_acquired" type="number" value="{{ old('eqp_qty_acquired', $equipment->eqp_qty_acquired) }}">
                    </div>
    
                    <div class="form-group">
                    <label for="eqp_amount_acquired" class="control-label"><Strong>Amount Acquired *</Strong></label>
                    <input class="form-control input-sm" placeholder="Amount Acquired" min="0" step="any" required="required" name="eqp_amount_acquired" id="eqp_amount_acquired" type="number" value="{{ old('eqp_amount_acquired', $equipment->eqp_amount_acquired) }}">
                    </div>
        
                    <div class="form-group">
                    <label for="eqp_date_acquired" class="control-label"><Strong>Date Acquired</Strong></label>
                    <input class="form-control input-sm date-picker" placeholder="Date Acquired" maxlength="10" name="eqp_date_acquired" id="eqp_date_acquired" type="text" value="{{ old('eqp_date_acquired', $equipment->eqp_date_acquired) }}">
                    </div>
    
                    <div class="form-group form-group-sm">
                    <label for="sp_id" class="control-label"><Strong>Supplier</Strong></label>
                    <select class="form-control input-sm" id="sp_id" name="sp_id">
                    <option disabled selected value>Select supplier</option>
                    @foreach ($sel_suppliers as $supplier)
                    <option value="{{ $supplier->sp_id }}"{{ old('sp_id', $equipment->sp_id) == $supplier->sp_id ? 'selected' : '' }}>{{ $supplier->sp_name }}</option>
                    @endforeach
                    </select>
                    </div>
    
                    <div class="form-group">
                    <label for="eqp_receipt_no" class="control-label"><Strong>Reciept No.</Strong></label>
                    <input class="form-control input-sm" placeholder="Reciept No." maxlength="255" name="eqp_receipt_no" id="eqp_receipt_no" type="text" value="{{ old('eqp_receipt_no', $equipment->eqp_receipt_no) }}">
                    </div>
    
                    <div class="form-group">
                    <label for="eqp_receipt_date" class="control-label"><Strong>Receipt Date</Strong></label>
                    <input class="form-control input-sm date-picker" placeholder="Receipt Date" maxlength="10" name="eqp_receipt_date" id="eqp_receipt_date" type="text" value="{{ old('eqp_receipt_date', $equipment->eqp_receipt_date) }}">
                    </div>
    
                    <div class="form-group">
                    <label for="eqp_property_no" class="control-label"><Strong>Property No.</Strong></label>
                    <input class="form-control input-sm" placeholder="Property No." maxlength="255" name="eqp_property_no" id="eqp_property_no" type="text" value="{{ old('eqp_property_no', $equipment->eqp_property_no) }}">
                    </div>
    
                    <div class="form-group">
                    <label for="eqp_date_tagged" class="control-label"><Strong>Date Tagged</Strong></label>
                    <input class="form-control input-sm date-picker" placeholder="Date Tagged" maxlength="10" name="eqp_date_tagged" id="eqp_date_tagged" type="text" value="{{ old('eqp_date_tagged', $equipment->eqp_date_tagged) }}">
                    </div>
    
                    <div class="form-group">
                    <label for="eqp_warranty" class="control-label"><Strong>Warranty</Strong></label>
                    <input class="form-control input-sm" placeholder="Warranty" name="eqp_warranty" id="eqp_warranty" type="text" value="{{ old('eqp_warranty', $equipment->eqp_warranty) }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="eqp_remarks" class="control-label"><Strong>Remarks</Strong></label>
                <textarea class="form-control input-sm" placeholder="Remarks" name="eqp_remarks" id="eqp_remarks" cols="50" rows="4">{{ old('eqp_remarks', $equipment->eqp_remarks) }}</textarea>
            </div>

            <input class="save-btn mt-3" type="submit" name="save" id="save" value="Save">
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