@extends('./layouts.app')

@section('content')
<form method="post" action="{{ route('project.store') }}">
@csrf
    <div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Add Project</h3>
            <div class="pull-right">
                <a href="/projects" class="btn btn-primary">Back</a>
            </div>
        </div>
        
        
            <div class="card-body">
                <div class="row-proj">
                    <div class="col-sm-3">
                        <label>Project Code *</label>
                        <input class="form-control input-sm" placeholder="Project Code" maxlength="255" name="prj_code" id="prj_code" type="text" value="{{ old('prj_code', $project->prj_code) }}">
                    </div>
                    <div class="col-sm-3">
                        <label for="prj_type_id">Project Type</label>
                        <select class="form-control input-sm project-type-select" id="prj_type_id" name="prj_type_id">
                            @foreach ($sel_types as $type)
                            <option value="{{ $type->prj_type_id }}" {{ old('prj_type_id', $project->prj_type_id) == $type->prj_type_id ? 'selected' : '' }}>{{ $type->prj_type_name }}</option>
                            @endforeach                            
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label>Year Approved *</label>
                        <input class="form-control input-sm" placeholder="Year Approved" name="prj_year_approved" id="prj_year_approved" maxLength="4" min="1958" max="2022" type="number" value="{{ old('prj_year_approved', $project->prj_year_approved) }}">
                    </div>
                    <div class="form-group col-sm-2">
                        <label class="control-label"></label>
                        <div class="checkbox">
                        <label for="prj_startup_assistance" class="control-label">
                            <input type="checkbox" name="prj_startup_assistance" id="prj_startup_assistance" value="1"{{ old('prj_startup_assistance', $project->prj_startup_assistance) == '1' ? 'checked' : '' }}> <strong>Startup Assistance</strong>
                        </label>
                        </div>
                    </div>
    
                    <div class="form-group col-sm-2">
                        <label class="control-label"></label>
                        <div class="checkbox">
                        <label for="prj_drrm" class="control-label">
                            <input type="checkbox" name="prj_drrm" id="prj_drrm" value="1"{{ old('prj_drrm', $project->prj_drrm) == '1' ? 'checked' : '' }}> <strong>DRRM Related</strong>
                        </label>
                        </div>
                    </div>
                </div>
                <div class="row-proj">
                    <div class="container-fluid">
                        <label class="control-label">Project Title *</label>
                        <input class="form-control" placeholder="Project Title" type="text" maxLength="255" id="prj_title" name="prj_title" value="{{ old('prj_title', $project->prj_title) }}">
                    </div>
                </div>
                <div class="row-proj project-type-rtgg">
                    <div class="container-fluid">
                        <label class="control-label">Program Title</label>
                        <input class="form-control" placeholder="Program Title" type="text" maxLength="255" id="prj_program" name="prj_program" value="{{ old('prj_program', $project->prj_program) }}">
                    </div>
                </div>
                <div class="row-proj">
                    <div class="col-sm-6">
                        <label class="control-label">Project Duration From *</label>
                        <input class="form-control input-sm" placeholder="Project Duration From" maxLength="10" name="prj_duration_from" id="prj_duration_from" type="text" value="{{ old('prj_duration_from', $project->prj_duration_from) }}">
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label">Project Duration To *</label>
                        <input class="form-control input-sm" placeholder="Project Duration To" maxLength="10"  name="prj_duration_to" id="prj_duration_to" type="text" value="{{ old('prj_duration_to', $project->prj_duration_to) }}">
                    </div>
                </div>
                <div class="row-proj project-type-rtgg">
                    <div class="col-sm-6">
                        <label for="prj_lead" class="control-label">Coordinator/Leader *</label>
                        <select class="form-control input-sm" id="prj_lead" name="prj_lead">
                            @foreach ($sel_coordinators as $sel_coordinator)
                            <option value="{{ $sel_coordinator->u_name }}" {{ old('prj_lead', $project->prj_lead) == $type->prj_lead ? 'selected' : '' }}>{{ $sel_coordinator->u_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="prj_agency" class="control-label">Agency *</label>
                        <input class="form-control input-sm" placeholder="Agency" maxlength="255" name="prj_agency" id="prj_agency" type="text" value="{{ $proj_lead }}">
                    </div>
                </div>
                <div class="row-proj project-type-rtgg">
                    <div class="col-sm-6">
                        <label for="prj_coordinator" class="control-label">Signing Coordinator/Leader</label>
                        <select class="form-control input-sm" id="prj_coordinator" name="prj_coordinator">
                            @foreach ($sel_coordinators as $sel_coordinator)
                            <option value="{{ $sel_coordinator->u_name }}" {{ old('prj_coordinator', $project->prj_coordinator) == $type->prj_coordinator ? 'selected' : '' }}>{{ $sel_coordinator->u_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="prj_head" class="control-label">Agency Head or Authorized Representative</label>
                        <select class="form-control input-sm" id="prj_head" name="prj_head">
                            @foreach ($sel_heads as $sel_head)
                            <option value="{{ $sel_head->u_name }}" {{ old('prj_head', $project->prj_head) == $type->prj_head ? 'selected' : '' }}>{{ $sel_head->u_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="col-sm-6">
                        <label for="beneficiaries" class="control-label">Beneficiaries *</label>
                        <select class="form-control input-sm chosen-select" id="beneficiaries" name="beneficiaries[]" multiple="multiple" placeholder="Select some option">
                            @foreach ($sel_benefeciaries as $sel_benefeciary)                            
                            <option value="{!! $sel_benefeciary->coop_id !!}" {{ collect(old('beneficiaries', $project->ProjectBeneficiary->pluck('coop_id') ?? []))->contains($sel_benefeciary->coop_id) ? 'selected' : '' }}>{!! $sel_benefeciary->coop_name !!}</option>
                            @endforeach 
                        </select>
                    </div>


                    <div class="col-sm-6">
                        <label for="collaborators" class="control-label">Collaborating Agencies</label>
                        <select class="form-control input-sm chosen-select" id="collaborators" name="collaborators[]" multiple="multiple">
                            @foreach ($sel_collaborators as $sel_collaborator)
                            <option value="{!! $sel_collaborator->col_id !!}" {{ collect(old('collaborators', $project->ProjectCollaborator->pluck('col_id') ?? []))->contains($sel_collaborator->col_id) ? 'selected' : '' }}>{!! $sel_collaborator->col_name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row-proj">
                    <div class="container-fluid">
                        <label for="ug_id" class="control-label">Implementor</label>
                        <select class="form-control input-sm" id="ug_id" name="ug_id">
                            @foreach ($sel_usergroups as $sel_usergroup)
                            <option value="{{ $sel_usergroup->ug_id }}" {{ old('ug_id', $project->ug_id) == $sel_usergroup->ug_id ? 'selected' : '' }}>{{ $sel_usergroup->ug_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
    
                <div class="row-proj">
                    <div class="form-group col-sm-6">
                        <label for="prj_objective" class="control-label">Objective *</label>
                        <textarea class="form-control input-sm" placeholder="Objective" name="prj_objective" id="prj_objective" cols="50" rows="4">{{ old('prj_objective', $project->prj_objective ) }}</textarea>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="prj_expected_output" class="control-label">Expected Output *</label>
                        <textarea class="form-control input-sm" placeholder="Expected Output" name="prj_expected_output" id="prj_expected_output" cols="50" rows="4">{{ old('prj_expected_output', $project->prj_expected_output ) }}</textarea>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="form-group form-group-sm col-sm-6">
                        <label for="prj_fund_release_date" class="control-label">Date Funds Released To The Beneficiary</label>
                        <input class="form-control input-sm date-picker" placeholder="Date Tagged" maxlength="10" name="prj_fund_release_date" id="prj_fund_release_date" type="text" value="{{ old('prj_fund_release_date', $project->prj_fund_release_date) }}">
                    </div>
                    <div class="form-group form-group-sm col-sm-6">
                        <label for="prj_status_id" class="control-label">Project Status</label>
                        <select class="form-control input-sm" id="prj_status_id" name="prj_status_id">
                            @foreach ($sel_statuses as $sel_status)
                            <option value="{{ $sel_status->prj_status_id }}" {{ old('prj_status_id', $project->prj_status_id) == $sel_status->prj_status_id ? 'selected' : '' }}>{{ $sel_status->prj_status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row-proj">
                    <div class="container-form bg-dark">
                    <h3 class="text-light">Sector</h3>
                    </div>
                    <div class="container-fluid">
                        <select class="form-control input-sm" id="sector_id" name="sector_id">
                            @foreach ($sel_sectors as $sel_sector)
                            <option value="{{ $sel_sector->sector_id }}" {{ old('sector_id', $project->sector_id) == $sel_sector->sector_id ? 'selected' : '' }}>{{ $sel_sector->sector_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="container-form bg-dark">
                    <h3 class="text-light">Project Location</h3>
                    </div>
                </div>

                <div class="form-group">
                    <label for="prj_address" class="control-label">Street Address *</label>
                    <textarea class="form-control input-sm" placeholder="Street Address" name="prj_address" id="prj_address" cols="50" rows="3">{{ old('prj_address', $project->prj_address) }}</textarea>
                </div>
                
                <div class="row-proj">
                    <div class="col-sm-4">
                        <label for="province_id" class="control-label">Province</label>
                        <select class="form-control input-sm province_select" id="province_id" name="province_id" placeholder="Select Province">
                            {{-- <option selected="false">--Select Province--</option> --}}
                            @foreach ($sel_provinces as $sel_province)
                            <option value="{{ $sel_province->province_id }}" {{ old('province_id', $project->province_id) == $sel_province->province_id ? 'selected' : '' }}>{{ $sel_province->province_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label for="city_id" class="control-label">Municipality/City</label>
                        <select class="form-control input-sm city_select" id="city_id" name="city_id">
                            {{-- <option value="{{ old('city_id', $project->city_id) }}">{{ $project->city->city_name }}</option> --}}
                            {{-- <option selected="false"></option> --}}
                            @foreach ($sel_cities as $sel_city)
                            <option value="{{ $sel_city->city_id }}" {{ old('city_id', $project->city_id) == $sel_city->city_id ? 'selected' : '' }}>{{ $sel_city->city_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label for="barangay_id" class="control-label">Barangay</label>
                        {{-- <select class="form-control input-sm barangay_select" id="barangay_id" name="barangay_id">
                        </select> --}}
                        <select class="form-control input-sm barangay_select" id="barangay_id" name="barangay_id">
                            <option value="{{ old('barangay_id', $project->barangay_id) }}">{{ $project->barangay->barangay_name }}</option>
                            {{-- <option {{ old('barangay_id', $project->barangay_id) }}>{{ $project->barangay->barangay_name }}</option> --}}
                        </select>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="container-form bg-dark">
                    <h3 class="text-light">Costs</h3>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="prj_cost_setup" class="control-label">Project Cost</label>
                    <input class="form-control input-sm" placeholder="Project Cost" min="0" step="any" name="prj_cost_setup" id="prj_cost_setup" type="number" value="{{ old('prj_cost_setup', $project->prj_cost_setup) }}">
                </div>


                <div class="form-group">
                    <label for="prj_cost_benefactor" class="control-label">Beneficiaries&rsquo; Counterpart Project Cost</label>
                    <input class="form-control input-sm" placeholder="Beneficiaries&rsquo; Counterpart Project Cost" min="0" step="any" name="prj_cost_benefactor" id="prj_cost_benefactor" type="number" value="{{ old('prj_cost_benefactor', $project->prj_cost_benefactor) }}">
                </div>

                <div class="form-group">
                    <label for="prj_cost_benefactor_desc" class="control-label">Beneficiaries&rsquo; Counterpart Description</label>
                    <textarea class="form-control input-sm" placeholder="Beneficiaries&rsquo; Counterpart Description" rows="5" name="prj_cost_benefactor_desc">{{ old('prj_cost_benefactor_desc', $project->prj_cost_benefactor_desc) }}</textarea> 
                </div>

                <div class="form-group">
                    <label for="prj_cost_other" class="control-label">Other Project Cost</label>
                    <input class="form-control input-sm" placeholder="Other Project Cost" min="0" step="any" name="prj_cost_other" id="prj_cost_other" type="number" value="{{ old('prj_cost_other', $project->prj_cost_other) }}">
                </div>

                <div class="row-proj">
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="prj_fundingsource_local" id="prj_fundingsource_local" value="1"{{ old('prj_fundingsource_local', $project->prj_fundingsource_local) == '1' ? 'checked' : '' }}>
                                Locally Funded
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="prj_cost_local" class="control-label">Local Funding Amount</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prj_cost_local" id="prj_cost_local" type="number" value="{{ old('prj_cost_local', $project->prj_cost_local) }}">
                        </div>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="prj_fundingsource_external" id="prj_fundingsource_external" value="1"{{ old('prj_fundingsource_external', $project->prj_fundingsource_external) == '1' ? 'checked' : '' }}>
                                Externally Funded
                            </label>
                        </div>

                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="prj_cost_external" class="control-label">External Funding Amount</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prj_cost_external" id="prj_cost_external" type="number" value="{{ old('prj_cost_external', $project->prj_cost_external) }}">
                        </div>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="prj_cofunded_nga" id="prj_cofunded_nga" value="1"{{ old('prj_cofunded_nga', $project->prj_cofunded_nga) == '1' ? 'checked' : '' }}>
                                Cofunded with NGA
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="prj_cost_nga" class="control-label">NGA Cofunding Amount</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prj_cost_nga" id="prj_cost_nga" type="number" value="{{ old('prj_cost_nga', $project->prj_cost_nga) }}">
                        </div>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="prj_cofunded_lgu" id="prj_cofunded_lgu" value="1"{{ old('prj_cofunded_lgu', $project->prj_cofunded_lgu) == '1' ? 'checked' : '' }}>
                                Cofunded with LGU
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="prj_cost_lgu" class="control-label">LGU Cofunding Amount</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prj_cost_lgu" id="prj_cost_lgu" type="number" value="{{ old('prj_cost_lgu', $project->prj_cost_lgu) }}">
                        </div>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="container-form bg-dark">
                    <h3 class="text-light">Pre-PIS</h3>
                    </div>
                </div>

                <div class="card-form">
                    <h5>Total Assets</h5>
                    <div class="form-group">
                        <label for="prj_pis_total_assets_land" class="control-label">Land</label>
                        <input class="form-control input-sm" placeholder="Land" min="0" step="any" name="prj_pis_total_assets_land" id="prj_pis_total_assets_land" type="number" value="{{ old('prj_pis_total_assets_land', $project->prj_pis_total_assets_land) }}">
                    </div>

                    <div class="form-group">
                        <label for="prj_pis_total_assets_building" class="control-label">Building</label>
                        <input class="form-control input-sm" placeholder="Building" min="0" step="any" name="prj_pis_total_assets_building" id="prj_pis_total_assets_building" type="number" value="{{ old('prj_pis_total_assets_building', $project->prj_pis_total_assets_building) }}">
                    </div>

                    <div class="form-group">
                        <label for="prj_pis_total_assets_equipment" class="control-label">Equipment</label>
                        <input class="form-control input-sm" placeholder="Equipment" min="0" step="any" name="prj_pis_total_assets_equipment" id="prj_pis_total_assets_equipment" type="number" value="{{ old('prj_pis_total_assets_equipment', $project->prj_pis_total_assets_equipment) }}">
                    </div>

                    <div class="form-group">
                        <label for="prj_pis_total_assets_working_capital" class="control-label">Working Capital</label>
                        <input class="form-control input-sm" placeholder="Working Capital" min="0" step="any" name="prj_pis_total_assets_working_capital" id="prj_pis_total_assets_working_capital" type="number" value="{{ old('prj_pis_total_assets_working_capital', $project->prj_pis_total_assets_working_capital) }}">
                    </div>
                </div>
                <h1> </h1>
                <div class="card-form">
                    <h4>Total Employment Generated (Direct Employment)</h4>

                    <h5>Company Hire (Regular)</h5>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_regular_male" class="control-label">Male</label>
                                <input class="form-control input-sm" placeholder="Male" min="0" step="any" name="prj_pis_dir_ch_regular_male" id="prj_pis_dir_ch_regular_male" type="number" value="{{ old('prj_pis_dir_ch_regular_male', $project->prj_pis_dir_ch_regular_male) }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_regular_female" class="control-label">Female</label>
                                <input class="form-control input-sm" placeholder="Female" min="0" step="any" name="prj_pis_dir_ch_regular_female" id="prj_pis_dir_ch_regular_female" type="number" value="{{ old('prj_pis_dir_ch_regular_female', $project->prj_pis_dir_ch_regular_female) }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_regular_pwd" class="control-label">PWD</label>
                                <input class="form-control input-sm" placeholder="PWD" min="0" step="any" name="prj_pis_dir_ch_regular_pwd" id="prj_pis_dir_ch_regular_pwd" type="number" value="{{ old('prj_pis_dir_ch_regular_pwd', $project->prj_pis_dir_ch_regular_pwd) }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_regular_senior" class="control-label">Senior</label>
                                <input class="form-control input-sm" placeholder="Senior" min="0" step="any" name="prj_pis_dir_ch_regular_senior" id="prj_pis_dir_ch_regular_senior" type="number" value="{{ old('prj_pis_dir_ch_regular_senior', $project->prj_pis_dir_ch_regular_senior) }}">
                            </div>
                        </div>
                    </div>

                    <h5>Company Hire (Part-Time)</h5>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_part_time_male" class="control-label">Male</label>
                                <input class="form-control input-sm" placeholder="Male" min="0" step="any" name="prj_pis_dir_ch_part_time_male" id="prj_pis_dir_ch_part_time_male" type="number" value="{{ old('prj_pis_dir_ch_part_time_male', $project->prj_pis_dir_ch_part_time_male) }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_part_time_female" class="control-label">Female</label>
                                <input class="form-control input-sm" placeholder="Female" min="0" step="any" name="prj_pis_dir_ch_part_time_female" id="prj_pis_dir_ch_part_time_female" type="number" value="{{ old('prj_pis_dir_ch_part_time_female', $project->prj_pis_dir_ch_part_time_female) }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_part_time_pwd" class="control-label">PWD</label>
                                <input class="form-control input-sm" placeholder="PWD" min="0" step="any" name="prj_pis_dir_ch_part_time_pwd" id="prj_pis_dir_ch_part_time_pwd" type="number" value="{{ old('prj_pis_dir_ch_part_time_pwd', $project->prj_pis_dir_ch_part_time_pwd) }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_part_time_senior" class="control-label">Senior</label>
                                <input class="form-control input-sm" placeholder="Senior" min="0" step="any" name="prj_pis_dir_ch_part_time_senior" id="prj_pis_dir_ch_part_time_senior" type="number" value="{{ old('prj_pis_dir_ch_part_time_senior', $project->prj_pis_dir_ch_part_time_senior) }}">
                            </div>
                        </div>
                    </div>

                    <h5>Sub-Contractor Hire (Regular)</h5>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_regular_male" class="control-label">Male</label>
                                <input class="form-control input-sm" placeholder="Male" min="0" step="any" name="prj_pis_dir_sh_regular_male" id="prj_pis_dir_sh_regular_male" type="number" value="{{ old('prj_pis_dir_sh_regular_male', $project->prj_pis_dir_sh_regular_male) }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_regular_female" class="control-label">Female</label>
                                <input class="form-control input-sm" placeholder="Female" min="0" step="any" name="prj_pis_dir_sh_regular_female" id="prj_pis_dir_sh_regular_female" type="number" value="{{ old('prj_pis_dir_sh_regular_female', $project->prj_pis_dir_sh_regular_female) }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_regular_pwd" class="control-label">PWD</label>
                                <input class="form-control input-sm" placeholder="PWD" min="0" step="any" name="prj_pis_dir_sh_regular_pwd" id="prj_pis_dir_sh_regular_pwd" type="number" value="{{ old('prj_pis_dir_sh_regular_pwd', $project->prj_pis_dir_sh_regular_pwd) }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_regular_senior" class="control-label">Senior</label>
                                <input class="form-control input-sm" placeholder="Senior" min="0" step="any" name="prj_pis_dir_sh_regular_senior" id="prj_pis_dir_sh_regular_senior" type="number" value="{{ old('prj_pis_dir_sh_regular_senior', $project->prj_pis_dir_sh_regular_senior) }}">
                            </div>
                        </div>
                    </div>

                    <h5>Sub-Contractor Hire (Part-Time)</h5>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_part_time_male" class="control-label">Male</label>
                                <input class="form-control input-sm" placeholder="Male" min="0" step="any" name="prj_pis_dir_sh_part_time_male" id="prj_pis_dir_sh_part_time_male" type="number" value="{{ old('prj_pis_dir_sh_part_time_male', $project->prj_pis_dir_sh_part_time_male) }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_part_time_female" class="control-label">Female</label>
                                <input class="form-control input-sm" placeholder="Female" min="0" step="any" name="prj_pis_dir_sh_part_time_female" id="prj_pis_dir_sh_part_time_female" type="number" value="{{ old('prj_pis_dir_sh_part_time_female', $project->prj_pis_dir_sh_part_time_female) }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_part_time_pwd" class="control-label">PWD</label>
                                <input class="form-control input-sm" placeholder="PWD" min="0" step="any" name="prj_pis_dir_sh_part_time_pwd" id="prj_pis_dir_sh_part_time_pwd" type="number" value="{{ old('prj_pis_dir_sh_part_time_pwd', $project->prj_pis_dir_sh_part_time_pwd) }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_part_time_senior" class="control-label">Senior</label>
                                <input class="form-control input-sm" placeholder="Senior" min="0" step="any" name="prj_pis_dir_sh_part_time_senior" id="prj_pis_dir_sh_part_time_senior" type="number" value="{{ old('prj_pis_dir_sh_part_time_senior', $project->prj_pis_dir_sh_part_time_senior) }}">
                            </div>
                        </div>
                    </div>    
                </div>

                <h1> </h1>
                <div class="card-form">
                    <h4>Total Employment Generated (Indirect Employment)</h4>
                    <h5>Forward</h5>
                    <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_forward_male" class="control-label">Male</label>
                            <input class="form-control input-sm" placeholder="Male" min="0" step="any" name="prj_pis_indir_forward_male" id="prj_pis_indir_forward_male" type="number" value="{{ old('prj_pis_indir_forward_male', $project->prj_pis_indir_forward_male) }}">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_forward_female" class="control-label">Female</label>
                            <input class="form-control input-sm" placeholder="Female" min="0" step="any" name="prj_pis_indir_forward_female" id="prj_pis_indir_forward_female" type="number" value="{{ old('prj_pis_indir_forward_female', $project->prj_pis_indir_forward_female) }}">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_forward_pwd" class="control-label">PWD</label>
                            <input class="form-control input-sm" placeholder="PWD" min="0" step="any" name="prj_pis_indir_forward_pwd" id="prj_pis_indir_forward_pwd" type="number" value="{{ old('prj_pis_indir_forward_pwd', $project->prj_pis_indir_forward_pwd) }}">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_forward_senior" class="control-label">Senior</label>
                            <input class="form-control input-sm" placeholder="Senior" min="0" step="any" name="prj_pis_indir_forward_senior" id="prj_pis_indir_forward_senior" type="number" value="{{ old('prj_pis_indir_forward_senior', $project->prj_pis_indir_forward_senior) }}">
                        </div>
                    </div>
                </div>

                <h5>Backward</h5>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_backward_male" class="control-label">Male</label>
                            <input class="form-control input-sm" placeholder="Male" min="0" step="any" name="prj_pis_indir_backward_male" id="prj_pis_indir_backward_male" type="number" value="{{ old('prj_pis_indir_backward_male', $project->prj_pis_indir_backward_male) }}">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_backward_female" class="control-label">Female</label>
                            <input class="form-control input-sm" placeholder="Female" min="0" step="any" name="prj_pis_indir_backward_female" id="prj_pis_indir_backward_female" type="number" value="{{ old('prj_pis_indir_backward_female', $project->prj_pis_indir_backward_female) }}">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_backward_pwd" class="control-label">PWD</label>
                            <input class="form-control input-sm" placeholder="PWD" min="0" step="any" name="prj_pis_indir_backward_pwd" id="prj_pis_indir_backward_pwd" type="number" value="{{ old('prj_pis_indir_backward_pwd', $project->prj_pis_indir_backward_pwd) }}">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_backward_senior" class="control-label">Senior</label>
                            <input class="form-control input-sm" placeholder="Senior" min="0" step="any" name="prj_pis_indir_backward_senior" id="prj_pis_indir_backward_senior" type="number" value="{{ old('prj_pis_indir_backward_senior', $project->prj_pis_indir_backward_senior) }}">
                        </div>
                    </div>
                </div>

                <div class="card-form">
                    <h4>Total Volume of Production</h4>
                    <div class="form-group">
                        <label for="prj_pis_volume_production_local" class="control-label">Local</label>
                        <input class="form-control input-sm" placeholder="Local" min="0" step="any" name="prj_pis_volume_production_local" id="prj_pis_volume_production_local" type="number" value="{{ old('prj_pis_volume_production_local', $project->prj_pis_volume_production_local) }}">
                    </div>

                    <div class="form-group">
                        <label for="prj_pis_volume_production_export" class="control-label">Export</label>
                        <input class="form-control input-sm" placeholder="Export" min="0" step="any" name="prj_pis_volume_production_export" id="prj_pis_volume_production_export" type="number" value="{{ old('prj_pis_volume_production_export', $project->prj_pis_volume_production_export) }}">
                    </div>
                </div>            

                <div class="card-form">
                    <h4>Total Gross Sales</h4>
                    <div class="form-group">
                        <label for="prj_pis_gross_sales_local" class="control-label">Local</label>
                        <input class="form-control input-sm" placeholder="Local" min="0" step="any" name="prj_pis_gross_sales_local" id="prj_pis_gross_sales_local" type="number" value="{{ old('prj_pis_gross_sales_local', $project->prj_pis_gross_sales_local) }}">
                    </div>

                    <div class="form-group">
                        <label for="prj_pis_gross_sales_export" class="control-label">Export</label>
                        <input class="form-control input-sm" placeholder="Export" min="0" step="any" name="prj_pis_gross_sales_export" id="prj_pis_gross_sales_export" type="number" value="{{ old('prj_pis_gross_sales_export', $project->prj_pis_gross_sales_export) }}">
                    </div>
                </div>            

                <div class="card-form">
                    <h4>Countries of Destination</h4>
                    <div class="form-group">
                        <textarea class="form-control input-sm" placeholder="Countries of Destination" name="prj_pis_countries_of_destination" id="prj_pis_countries_of_destination" cols="50" rows="4">{{ old('prj_pis_countries_of_destination', $project->prj_pis_countries_of_destination) }}</textarea>
                    </div>
                </div>

                <div class="card-form">
                    <h4>Assistance Obtained From DOST</h4>
                    <ul class="ul-assistance-40">
                        <li>
                            A. Pre-Implementation
                        </li>
                        <li>
                            <div class="form-group">
                                1. Conceptualization
                                <textarea class="form-control input-sm" placeholder="Conceptualization" name="prj_pis_assistance_conceptualization" id="prj_pis_assistance_conceptualization" cols="50" rows="3">{{ old('prj_pis_assistance_conceptualization', $project->prj_pis_assistance_conceptualization) }}</textarea>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                2. Proposal Preparation
                                <textarea class="form-control input-sm" placeholder="Proposal Preparation" name="prj_pis_assistance_proposal_preparation" id="prj_pis_assistance_proposal_preparation" cols="50" rows="3">{{ old('prj_pis_assistance_proposal_preparation', $project->prj_pis_assistance_proposal_preparation) }}</textarea>
                            </div>
                        </li>
                        <li>
                            3. Others (Pls. Specify)
                        </li>
                        <li>
                            <ul class="ul-assistance-12">
                                <li>
                                    3.1 Production Technology
                                </li>
                                <li>
                                    <ul class="ul-assistance-12">
                                        <li>
                                            <div class="form-group">
                                                A. Process
                                                <textarea class="form-control input-sm" placeholder="Process" name="prj_pis_assistance_process" id="prj_pis_assistance_process" cols="50" rows="3">{{ old('prj_pis_assistance_process', $project->prj_pis_assistance_process) }}</textarea>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox">
                                                B. Equipment
                                                <textarea class="form-control input-sm" placeholder="Equipment" name="prj_pis_assistance_equipment" id="prj_pis_assistance_equipment" cols="50" rows="3">{{ old('prj_pis_assistance_equipment', $project->prj_pis_assistance_equipment) }}</textarea>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                C. Quality Control / Laboratory Testing / Analysis
                                                <textarea class="form-control input-sm" placeholder="Quality Control / Laboratory Testing / Analysis" name="prj_pis_assistance_quality_control" id="prj_pis_assistance_quality_control" cols="50" rows="3">{{ old('prj_pis_assistance_quality_control', $project->prj_pis_assistance_quality_control) }}</textarea>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="form-group">
                                        3.2 Packaging / Labeling
                                        <textarea class="form-control input-sm" placeholder="Packaging / Labeling" name="prj_pis_assistance_packaging_labeling" id="prj_pis_assistance_packaging_labeling" cols="50" rows="3">{{ old('prj_pis_assistance_packaging_labeling', $project->prj_pis_assistance_packaging_labeling) }}</textarea>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        3.3 Post-Harvest
                                        <textarea class="form-control input-sm" placeholder="Post-Harvest" name="prj_pis_assistance_post_harvest" id="prj_pis_assistance_post_harvest" cols="50" rows="3">{{ old('prj_pis_assistance_post_harvest', $project->prj_pis_assistance_post_harvest) }}</textarea>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        3.4 Marketing Assistance
                                        <textarea class="form-control input-sm" placeholder="Marketing Assistance" name="prj_pis_assistance_marketing" id="prj_pis_assistance_marketing" cols="50" rows="3">{{ old('prj_pis_assistance_marketing', $project->prj_pis_assistance_marketing) }}</textarea>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        3.5 Human Resource Training
                                        <textarea class="form-control input-sm" placeholder="Human Resource Training" name="prj_pis_assistance_training" id="prj_pis_assistance_training" cols="50" rows="3">{{ old('prj_pis_assistance_training', $project->prj_pis_assistance_training) }}</textarea>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        3.6 Consultancy Service
                                        <textarea class="form-control input-sm" placeholder="Consultancy Service" name="prj_pis_assistance_consultancy" id="prj_pis_assistance_consultancy" cols="50" rows="3">{{ old('prj_pis_assistance_consultancy', $project->prj_pis_assistance_consultancy) }}</textarea>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        3.7 Others (FPD Permit, LGU Registration, Bar Coding)
                                        <textarea class="form-control input-sm" placeholder="Others" name="prj_pis_assistance_others" id="prj_pis_assistance_others" cols="50" rows="3">{{ old('prj_pis_assistance_others', $project->prj_pis_assistance_others) }}</textarea>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="card-form">
                    <div class="form-group">
                        <label for="prj_remarks" class="control-label">Remarks</label>
                        <textarea class="form-control input-sm" placeholder="Remarks" name="prj_remarks" id="prj_remarks" cols="50" rows="4">{{ old('prj_remarks', $project->prj_remarks) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row-proj">
                    <div class="container-form bg-dark">
                    <h3 class="text-light">Project Map Coordinates</h3>
                    </div>
            </div>
            <div class="card-map">
            <div id="map" style="height: 330px; width: 100%;"></div>
            </div>
                
                <div id="map-location-picker" class="form-group map-location-picker">
                </div>

                <div class="form-group">
                    <label for="prj_longitude" class="control-label">Longitude</label>
                    <input class="form-control input-sm" placeholder="Longitude" min="0" step="any" name="prj_longitude" id="prj_longitude" type="text" value="{{ old('prj_longitude', $project->prj_longitude) }}">
                </div>

                <div class="form-group">
                    <label for="prj_latitude" class="control-label">Latitude</label>
                    <input class="form-control input-sm" placeholder="Latitude" min="0" step="any" name="prj_latitude" id="prj_latitude" type="text" value="{{ old('prj_latitude', $project->prj_latitude) }}">
                </div>

                <div class="form-group">
                    <label for="prj_elevation" class="control-label">Elevation</label>
                    <input class="form-control input-sm" placeholder="Elevation" min="0" step="any" name="prj_elevation" id="elevation" type="number" value="{{ old('prj_elevation', $project->prj_elevation) }}">
                </div>

                <div class="card-form">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="1" name="form_return"> Check to clear form after saving.
                        </label>
                    </div>
                </div>
                <div> </div>
                <input class="btn btn-primary btn-block" type="submit" name="store" id="store" value="SAVE">
           </div>
               
    </div>
    
</div>

</form>

<script type="text/javascript">
    //Project type form option
$(document).ready(function() {
    
    var type = $(".project-type-select :selected").val();
    var provinceid = $("#province_id :selected").val(); 
    var cityid = $("#city_id :selected").val();
    var barangayid = $("#barangay_id :selected").val();
    
    alert(barangayid);

    if(type == 6 || type == 12) {
        $(".project-type-rtgg").hide();    
    }

    $('#prj_duration_from').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayBtn: true,
        todayHighlight: true
    });
    $('#prj_duration_to').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayBtn: true,
        todayHighlight: true
    });
    $('#prj_fund_release_date').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayBtn: true,
        todayHighlight: true
    });
    
    $(".chosen-select").chosen();
    $(".project-type-select").on('change', function() {
            $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
        if(optionValue == 6){
            $(".project-type-rtgg").hide();
        }
        if(optionValue == 8){
            $(".project-type-rtgg").show();
        }
        if(optionValue == 9){
            $(".project-type-rtgg").show();
        }
        if(optionValue == 12){
            $(".project-type-rtgg").hide();
        }
        if(optionValue == 13){
            $(".project-type-rtgg").show();
        }
        if(optionValue == 14){
            $(".project-type-rtgg").show();
        }
        });
    });

    //ADDRESS SELECT OPTION
    $(".province_select").on('change', function() {
        $(this).find("option:selected").each(function(){
            var provincesID = $(this).attr("value");
            if(provincesID)
            {
                console.log(provincesID);
                $.ajax({
                    url:'/getCities/' + provincesID,
                    type: "GET",
                    dataType: "JSON",
                    success:function(data)
                    {
                        $(".city_select").empty(); //remove last selected itmes
                        $.each(data, function(key, value){
                            $(".city_select").append('<option value="'+ key+'">'+ value +'</option>');
                        })
                        $(".city_select").val(cityid);
                    }
                })
            }
            else
            {
                $(".city_select").empty();
                $(".barangay_select").empty();
            }
        });
    });
    $(".city_select").on('change', function() {
        $(this).find("option:selected").each(function(){
            var citiesID = $(this).attr("value");
            if(citiesID)
            {
                $.ajax({
                    url:'/getBarangays/' + citiesID,
                    type: "GET",
                    dataType: "JSON",
                    success:function(data)
                    {
                        $(".barangay_select").empty(); //remove last selected itmes
                        $.each(data, function(key, value){
                            $(".barangay_select").append('<option value="'+ key+'">'+ value +'</option>');
                        })
                        
                    }
                })
            }
            else
            {
                $(".barangay_select").empty();
            }
        });
    });
    if(provinceid){
        $.ajax({
            url:'/getCities/' + provinceid,
            type: "GET",
            dataType: "JSON",
            success:function(data)
            {
                $(".city_select").empty(); //remove last selected itmes            
                $.each(data, function(key, value, cityid){
                    $(".city_select").append('<option value="'+ key +'">'+ value +'</option>');                            
                })
                $(".city_select").val(cityid).trigger('change');
                $(".barangay_select").val(barangayid).trigger('change');
                
            }
        })
    }
    
    // if(cityid){
    //     $.ajax({
    //         url:'/getBarangays/' + citiesID,
    //         type: "GET",
    //         dataType: "JSON",
    //         success:function(data)
    //         {
    //             $(".barangay_select").empty(); //remove last selected itmes
    //                     $.each(data, function(key, value, barangayid){
    //                         $(".barangay_select").append('<option value="'+ key+'">'+ value +'</option>');
    //                     })
    //             $(".barangay_select").val(barangayid).trigger('change');
    //         }
    //     })
    // }   
});
</script>
@endsection()