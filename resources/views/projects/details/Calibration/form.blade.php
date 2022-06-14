@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header">
        <h3>New Project Testing & Calibrations
            <div class="pull-right">
                <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Calibration Save', ['id' => $id, 'cal_id' => $cal_id]) }}" method="POST">
            @csrf
                <div class="form-group form-group-sm">
                    <label for="ug_id" class="control-label"><Strong>Implementor</Strong></label>
                    <select class="form-control input-sm" id="ug_id" name="ug_id">
                        @foreach ($sel_ugs as $ug)
                            <option value="{{ $ug->ug_id }}"{{ old('ug_id', $calibration->ug_id) == $ug->ug_id ? 'selected' : '' }}>{{ $ug->ug_name }}</option>           
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-group-sm">
                    <label for="lab_id" class="control-label"><Strong>Lab</Strong></label>
                    <select class="form-control input-sm" id="lab_id" name="lab_id">
                        @foreach ($sel_labs as $lab)
                            <option value="{{ $lab->lab_id }}"{{ old('lab_id', $calibration->lab_id) == $lab->lab_id ? 'selected' : '' }}>{{ $lab->lab_abbr }}</option>           
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-group-sm">
                    <label for="cal_year" class="control-label"><Strong>Year</Strong></label>
                    <input class="form-control input-sm" placeholder="Year" maxlength="4" min="1800" max="2023" required="required" name="cal_year" id="cal_year" type="number" value="{{ old('cal_year', $calibration->cal_year) }}">
                    
                </div>
                <div class="form-group form-group-sm">
                    <label for="cal_month" class="control-label"><Strong>Month</Strong></label>
                    <select class="form-control input-sm" id="cal_month" name="cal_month">
                        @foreach ($sel_months as $month)
                        <option value="{{ $month->cal_month }}"{{ old('cal_month', $calibration->cal_month) == $month->cal_month ? 'selected' : '' }}>{{ $month->month_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-group-sm">
                    <label for="cal_no_parameters" class="control-label"><Strong>No. of Parameters Tested *</Strong></label>
                    <input class="form-control input-sm" placeholder="No. of Services Rendered" min="0" step="1" required="required" name="cal_no_parameters" id="cal_no_parameters" type="number" value="{{ old('cal_no_parameters', $calibration->cal_no_parameters) }}">
                </div>
                <div class="form-group form-group-sm">
                    <label for="cal_parameters" class="control-label">Parameters</label>
                    <textarea class="form-control" name="cal_parameters" id="cal_parameters" placeholder="Parameters">{{ old('cal_parameters', $calibration->cal_parameters) }}</textarea>
                </div>
                <div class="form-group form-group-sm">
                    <label for="cal_no_tests_free" class="control-label">No. of Non-Payed Tests Rendered *</label>
                    <input class="form-control input-sm" placeholder="No. of Non-Payed Services Rendered" min="0" step="1" required="required" name="cal_no_tests_free" id="cal_no_tests_free" type="number" value="{{ old('cal_no_tests_free', $calibration->cal_no_tests_free) }}">
                </div>
        
                <div class="form-group form-group-sm">
                    <label for="cal_no_products" class="control-label">No. of Products Tested *</label>
                    <input class="form-control input-sm" placeholder="No. of Services Rendered On Time" min="0" step="1" required="required" name="cal_no_products" id="cal_no_products" type="number" value="{{ old('cal_no_products', $calibration->cal_no_products) }}">
                </div>
        
                <div class="form-group form-group-sm">
                    <label for="cal_products" class="control-label">Products</label>
                    <textarea class="form-control" name="cal_products" id="cal_products" placeholder="Products">{{ old('cal_products', $calibration->cal_products) }}</textarea>
                </div>
        
                <div class="form-group form-group-sm">
                    <label for="cal_income" class="control-label">Income Generated *</label>
                    <input class="form-control input-sm" placeholder="Income Generated" min="0" step="any" required="required" name="cal_income" id="cal_income" type="number" value="{{ old('cal_income', $calibration->cal_income) }}">
                </div>
        
                <div class="form-group form-group-sm">
                    <label for="cal_cost" class="control-label">Cost *</label>
                    <input class="form-control input-sm" placeholder="Cost" min="0" step="any" required="required" name="cal_cost" id="cal_cost" type="number" value="{{ old('cal_cost', $calibration->cal_cost) }}">
                </div>
        
                <div class="form-group form-group-sm">
                <label for="cal_remarks" class="control-label">Remarks</label>
                <textarea class="form-control" name="cal_remarks" id="cal_remarks">{{ old('cal_remarks', $calibration->cal_remarks) }}</textarea>
                </div>
            <input class="save-btn mt-3" type="submit" name="save" id="save" value="Save">
        </form>
    </div>
</div>
@endsection