@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
    <div class="card">
        <div class="card-header">
            <h3>Project Details
                <div class="pull-right">
                    <a href="{{ route('Edit Project', $project->prj_id) }}" class="projectdetails-btn pr"><span class="fa fa-pencil"></span> Edit Details</a>
                </div>
            </h3>
                
        </div>
        <div class="card-body">
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-3 pl-1">
                    <label for="prj_code" class="control-label"><strong>Project</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_code" readonly value="{{ $project->prj_code }}">
                </div>
                <div class="form-group col-3 pl-1">
                    <label for="qsector" class="control-label"><strong>Sector</strong></label>
                    <input type="text" class="form-control-viewproj" id="qsector" readonly value="{{ $project->sector->sector_name }}">
                </div>
                <div class="form-group col-3 pl-1">
                    <label for="prj_year_approved" class="control-label"><strong>Year Approved</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_year_approved" readonly value="{{ $project->prj_year_approved }}">
                </div>
                <div class="form-group col-3 pl-1">
                    <label for="prj_status_id" class="control-label"><strong>Status</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_status_id" readonly value="{{ $project->status->prj_status_name }}">
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-6 pl-1">
                    <label for="coop_names" class="control-label"><strong>Benefeciaries</strong></label>


                    <select name="beneficiaries[]" id="beneficiaries" class="form-control input-sm chosen-select" multiple data-placeholder=" ">
                        @foreach($project->ProjectBeneficiary as $get_beneficiaries)
                            <option value="{!! $get_beneficiaries->coop_id !!}" {{ collect(old('beneficiaries', $get_beneficiaries->pluck('coop_id') ?? []))->contains($get_beneficiaries->coop_id) ? 'selected' : '' }}>{!! $get_beneficiaries->cooperator->coop_name !!}</option>
                        @endforeach
                    </select>
                    
                    
                </div>
                <div class="form-group col-6 pl-1">
                    <label for="collaborators" class="control-label"><strong>Collaborating Agencies</strong></label>
                    
                    <select name="collaborators[]" id="collaborators" class="form-control input-sm chosen-select" multiple data-placeholder=" ">
                        @foreach($project->ProjectCollaborator as $get_collaborators)
                            <option value="{!! $get_collaborators->col_id !!}" {{ collect(old('collaborators', $get_collaborators->pluck('col_id') ?? []))->contains($get_collaborators->col_id) ? 'selected' : '' }}>{!! $get_collaborators->collaborator->col_name !!}</option>
                        @endforeach
                    </select>
                    

                    
                   
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-6 pl-1">
                    <label for="prj_expected_output" class="control-label"><strong>Expected Output</strong></label>
                    <textarea class="form-control-viewproj" rows="5" id="prj_expected_output" readonly>{{ $project->prj_expected_output }}</textarea>
                </div>
                <div class="form-group col-6 pl-1">
                    <label for="prj_objective" class="control-label"><strong>Objectives</strong></label>
                    <textarea class="form-control-viewproj"  rows="5" id="prj_objective" readonly>{{ $project->prj_objective }}</textarea>
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-12 pl-1">
                    <label for="ug_name" class="control-label"><strong>Implementor</strong></label>
                    <input type="text" class="form-control-viewproj" id="ug_name" readonly value="{{ $project->usergroup->ug_name }}">
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-12 pl-1">
                    <label for="prj_fund_release_date" class="control-label"><strong>Date Funds Released To The Beneficiary</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_fund_release_date" readonly value="{{ $project->prj_fund_release_date }}">
                </div>
            </div>
            <div class="row ml-1 pl-0 mr-1 text-light mb-3" style="background-color: gray">
                <p class="d-flex p-2"><h4>Project Location</h4></p>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-12 pl-1">
                    <label for="prj_address" class="control-label"><strong>Address</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_address" readonly value="{{ $project->prj_address }}">
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-4 pl-1">
                    <label for="province_name" class="control-label"><strong>Province</strong></label>
                    <input type="text" class="form-control-viewproj" id="province_name" readonly value="{{ $project->province->province_name }}">
                </div>
                <div class="form-group col-4 pl-1">
                    <label for="city_name" class="control-label"><strong>City/Town</strong></label>
                    <input type="text" class="form-control-viewproj" id="city_name" readonly value="{{ $project->city->city_name }}">
                </div>
                <div class="form-group col-4 pl-1">
                    <label for="barangay_name" class="control-label"><strong>Barangay</strong></label>
                    <input type="text" class="form-control-viewproj" id="barangay_name" readonly value="{{ $project->barangay->barangay_name }}">
                </div>
            </div>
            <div class="row ml-1 pl-0 mr-1 text-light mb-3" style="background-color: gray">
                <p class="d-flex p-2"><h4>Project Cost</h4></p>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-3 pl-1">
                    <label for="prj_cost_setup" class="control-label"><strong>Project Cost</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_cost_setup" readonly value="Php {{ number_format($project->prj_cost_setup, 2) }}">
                </div>
                <div class="form-group col-3 pl-1">
                    <label for="prj_cost_other" class="control-label"><strong>Other Project Cost</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_cost_other" readonly value="Php {{ number_format($project->prj_cost_other, 2) }}">
                </div>
                <div class="form-group col-3 pl-1">
                    <label for="prj_cost_benefactor" class="control-label"><strong>Beneficiaries&rsquo; Counterpart Project Cost</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_cost_benefactor" readonly value="Php {{ number_format($project->prj_cost_benefactor, 2) }}">
                </div>
                <div class="form-group col-3 pl-1">
                    <label for="prj_cost_benefactor_desc" class="control-label"><strong>Beneficiaries&rsquo; Counterpart Description</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_cosprj_cost_benefactor_desct_setup" readonly value="{{ $project->prj_cost_benefactor_desc }}">
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-3 pl-1">
                    <label for="prj_fundingsource_local" class="control-label"><strong>Locally Funded</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_fundingsource_local" readonly value="{{ $project->prj_fundingsource_local == '1' ? 'Yes' : 'NO'  }}">
                </div>
                <div class="form-group col-9 pl-1">
                    <label for="prj_cost_local" class="control-label"><strong>Local Funding Amount</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_cost_local" readonly value="{{ $project->prj_cost_local }}">
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-3 pl-1">
                    <label for="prj_fundingsource_external" class="control-label"><strong>Externally Funded</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_fundingsource_external" readonly value="{{ $project->prj_fundingsource_external == '1' ? 'Yes' : 'NO'  }}">
                </div>
                <div class="form-group col-9 pl-1">
                    <label for="prj_cost_external" class="control-label"><strong>External Funding Amount</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_cost_external" readonly value="{{ $project->prj_cost_external }}">
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-3 pl-1">
                    <label for="prj_cofunded_nga" class="control-label"><strong>Cofunded with NGA</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_cofunded_nga" readonly value="{{ $project->prj_cofunded_nga == '1' ? 'Yes' : 'NO'  }}">
                </div>
                <div class="form-group col-9 pl-1">
                    <label for="prj_cost_nga" class="control-label"><strong>NGA Funding Amount</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_cost_nga" readonly value="{{ $project->prj_cost_nga }}">
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-3 pl-1">
                    <label for="prj_cofunded_lgu" class="control-label"><strong>Cofunded with LGU</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_cofunded_lgu" readonly value="{{ $project->prj_cofunded_lgu == '1' ? 'Yes' : 'NO' }}">
                </div>
                <div class="form-group col-9 pl-1">
                    <label for="prj_cost_nga" class="control-label"><strong>LGU Funding Amount</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_cost_nga" readonly value="{{ $project->prj_cost_lgu }}">
                </div>
            </div>
            <div class="row ml-1 pl-0 mr-1 text-light mb-3" style="background-color: gray">
                <p class="d-flex p-2"><h4>Project Map Coordinates</h4></p>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-3 pl-1">
                    <label for="prj_cofunded_lgu" class="control-label"><strong>Longitude</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_cofunded_lgu" readonly value="{{ $project->prj_longitude }}">
                </div>
                <div class="form-group col-3 pl-1">
                    <label for="prj_cost_nga" class="control-label"><strong>Latitude</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_cost_nga" readonly value="{{ $project->prj_latitude }}">
                </div>
                <div class="form-group col-3 pl-1">
                    <label for="prj_cost_nga" class="control-label"><strong>Elevation</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_cost_nga" readonly value="{{ $project->prj_elevation }}">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".chosen-select").chosen().parent().find('.chosen-container').css({'pointer-events': 'none','opacity':100});
    });
</script>
@endsection