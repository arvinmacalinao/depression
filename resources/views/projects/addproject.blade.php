@extends('./layouts.app')

@section('content')
<form>
<div class="container-fluid">
    <div class="card">
        <h3 class="card-header">Add Project</h3>
            <div class="card-body">
                <div class="row-proj">
                    <div class="col-sm-3">
                        <label>Project Code *</label>
                        <input class="form-control input-sm" placeholder="Project Code" maxLength="255" required="required"></input>
                    </div>
                    <div class="col-sm-3">
                        <label for="prj_type_id">Project Type</label>
                        <select class="form-control input-sm project-type-select" id="prj_type_id" name="prj_type_id">
                            <!-- NO Option yet -->
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label>Year Approved *</label>
                        <input class="form-control input-sm" placeholder="Year Approved" maxLength="4" min="1958" max="2022" required="required" type="number" defaultValue="2022"></input>
                    </div>
                    <div class="col-sm-2 mt-3">
                        <div >
                            <input type="checkbox"/> Startup Assistance
                        </div>
                    </div>
                    <div class="col-sm-2 mt-3">
                        <div >
                        <input type="checkbox"/> DRRM Related
                        </div>
                    </div>
                </div>
                <div class="row-proj">
                    <div class="container-fluid">
                        <label class="control-label">Project Title *</label>
                        <input class="form-control" placeholder="Project Title" type="text" maxLength="255" required="required"></input>
                    </div>
                </div>
                <div class="row-proj">
                    <div class="container-fluid">
                        <label class="control-label">Program Title</label>
                        <input class="form-control" placeholder="Program Title" type="text" maxLength="255" required="required"></input>
                    </div>
                </div>
                <div class="row-proj">
                    <div class="col-sm-6">
                        <label class="control-label">Project Duration From *</label>
                        <input class="form-control input-sm" placeholder="Project Duration From" maxLength="10" required="required" name="prj_duration_from" id="prj_duration_from" type="text" value="02/21/2022"></input>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label">Project Duration To *</label>
                        <input class="form-control input-sm" placeholder="Project Duration To" maxLength="10"  required="required" name="prj_duration_to" id="prj_duration_to" type="text" value="02/21/2023"></input>
                    </div>
                </div>
                <div class="row-proj">
                    <div class="col-sm-6">
                        <label for="prj_lead" class="control-label">Coordinator/Leader *</label>
                        <input class="form-control input-sm" placeholder="Coordinator/Leader" maxlength="255" required="required" name="prj_lead" id="prj_lead" type="text" value="">
                    </div>
                    <div class="col-sm-6">
                        <label for="prj_agency" class="control-label">Agency *</label>
                        <input class="form-control input-sm" placeholder="Agency" maxlength="255" required="required" name="prj_agency" id="prj_agency" type="text" value="">
                    </div>
                </div>
                <div class="row-proj">
                <div class="col-sm-6">
                    <label for="prj_coordinator" class="control-label">Signing Coordinator/Leader</label>
                    <select class="form-control input-sm" id="prj_coordinator" name="prj_coordinator">
                        <!-- NO Option yet -->
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="prj_head" class="control-label">Agency Head or Authorized Representative</label>
                    <select class="form-control input-sm" id="prj_head" name="prj_head">
                        <!-- NO Option yet -->
                    </select>
                </div>
                </div>

                <div class="row-proj">
                    <div class="col-sm-6">
                        <label for="coop_id" class="control-label">Beneficiaries *</label>
                        <select class="form-control input-sm chosen-select" id="coop_id" name="coop_id[]" multiple="multiple">
                            <!-- NO Option yet -->
                        </select>
                    </div>


                    <div class="col-sm-6">
                        <label for="col_id" class="control-label">Collaborating Agencies</label>
                        <select class="form-control input-sm chosen-select" id="col_id" name="col_id[]" multiple="multiple">
                            <!-- NO Option yet -->
                        </select>
                    </div>
                </div>
                    <div class="row-proj">
                    <div class="col-sm-6">
                        <label for="prj_coordinator" class="control-label">Signing Coordinator/Leader</label>
                        <select class="form-control input-sm" id="prj_coordinator" name="prj_coordinator">
                            <!-- NO Option yet -->
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="prj_head" class="control-label">Agency Head or Authorized Representative</label>
                        <select class="form-control input-sm" id="prj_head" name="prj_head">
                            <!-- NO Option yet -->
                        </select>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="col-sm-6">
                        <label for="coop_id" class="control-label">Beneficiaries *</label>
                        <select class="form-control input-sm chosen-select" id="coop_id" name="coop_id[]" multiple="multiple">
                            <!-- NO Option yet -->
                        </select>
                    </div>


                    <div class="col-sm-6">
                        <label for="col_id" class="control-label">Collaborating Agencies</label>
                        <select class="form-control input-sm chosen-select" id="col_id" name="col_id[]" multiple="multiple">
                            <!-- NO Option yet -->
                        </select>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="container-fluid">
                        <label for="ug_id" class="control-label">Implementor</label>
                        <select class="form-control input-sm" id="ug_id" name="ug_id">
                            <!-- NO Option yet -->
                        </select>
                    </div>
                </div>
    
                <div class="row-proj">
                    <div class="form-group col-sm-6">
                        <label for="prj_objective" class="control-label">Objective *</label>
                        <textarea class="form-control input-sm" placeholder="Objective" required="required" name="prj_objective" id="prj_objective" cols="50" rows="4"></textarea>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="prj_expected_output" class="control-label">Expected Output *</label>
                        <textarea class="form-control input-sm" placeholder="Expected Output" required="required" name="prj_expected_output" id="prj_expected_output" cols="50" rows="4"></textarea>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="form-group form-group-sm col-sm-6">
                        <label for="prj_fund_release_date" class="control-label">Date Funds Released To The Beneficiary</label>
                        <input class="form-control input-sm date-picker" placeholder="Date Tagged" maxlength="10" name="prj_fund_release_date" id="prj_fund_release_date" type="text" value="">
                    </div>
                    <div class="form-group form-group-sm col-sm-6">
                        <label for="prj_status_id" class="control-label">Project Status</label>
                        <select class="form-control input-sm" id="prj_status_id" name="prj_status_id">
                            <!-- NO Option yet -->
                        </select>
                    </div>
                </div>
                <div class="row-proj">
                    <div class="container-form bg-dark">
                    <h3 class="text-light">Sector</h3>
                    </div>
                    <div class="container-fluid">
                        <select class="form-control input-sm" id="sector_id" name="sector_id">
                        <!-- NO Option yet -->
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
                    <textarea class="form-control input-sm" placeholder="Street Address" required="required" name="prj_address" id="prj_address" cols="50" rows="3"></textarea>
                </div>
                
                <div class="row-proj">
                    <div class="col-sm-4">
                        <label for="province_id" class="control-label">Province</label>
                        <select class="form-control input-sm province_select" id="province_id" name="province_id" required="required">
                            <!-- NO Option yet -->
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label for="city_id" class="control-label">Municipality/City</label>
                        <select class="form-control input-sm city_select" id="city_id" name="city_id" required="required">
                            <!-- NO Option yet -->
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label for="barangay_id" class="control-label">Barangay</label>
                        <select class="form-control input-sm barangay_select" id="barangay_id" name="barangay_id" required="required">
                            <!-- NO Option yet -->
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
                <input class="form-control input-sm" placeholder="Project Cost" min="0" step="any" name="prj_cost_setup" id="prj_cost_setup" type="number" value="">
                </div>


                <div class="form-group">
                    <label for="prj_cost_benefactor" class="control-label">Beneficiaries&rsquo; Counterpart Project Cost</label>
                    <input class="form-control input-sm" placeholder="Beneficiaries&rsquo; Counterpart Project Cost" min="0" step="any" name="prj_cost_benefactor" id="prj_cost_benefactor" type="number" value="">
                </div>

                <div class="form-group">
                    <label for="prj_cost_benefactor_desc" class="control-label">Beneficiaries&rsquo; Counterpart Description</label>
                    <textarea class="form-control input-sm" placeholder="Beneficiaries&rsquo; Counterpart Description" rows="5" name="prj_cost_benefactor_desc"></textarea> 
                </div>

                <div class="form-group">
                    <label for="prj_cost_other" class="control-label">Other Project Cost</label>
                    <input class="form-control input-sm" placeholder="Other Project Cost" min="0" step="any" name="prj_cost_other" id="prj_cost_other" type="number" value="">
                </div>

                <div class="row-proj">
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="prj_fundingsource_local" id="prj_fundingsource_local" value="1">
                                Locally Funded
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="prj_cost_local" class="control-label">Local Funding Amount</label>
                            <input class="form-control input-sm" placeholder="0" required="required" min="0" step="any" name="prj_cost_local" id="prj_cost_local" type="number" value="">
                        </div>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="prj_fundingsource_external" id="prj_fundingsource_external" value="1">
                                Externally Funded
                            </label>
                        </div>

                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="prj_cost_external" class="control-label">External Funding Amount</label>
                            <input class="form-control input-sm" placeholder="0" required="required" min="0" step="any" name="prj_cost_external" id="prj_cost_external" type="number" value="">
                        </div>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="prj_cofunded_nga" id="prj_cofunded_nga" value="1">
                                Cofunded with NGA
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="prj_cost_nga" class="control-label">NGA Cofunding Amount</label>
                            <input class="form-control input-sm" placeholder="0" required="required" min="0" step="any" name="prj_cost_nga" id="prj_cost_nga" type="number" value="">
                        </div>
                    </div>
                </div>

                <div class="row-proj">
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="prj_cofunded_lgu" id="prj_cofunded_lgu" value="1">
                                Cofunded with LGU
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="prj_cost_lgu" class="control-label">LGU Cofunding Amount</label>
                            <input class="form-control input-sm" placeholder="0" required="required" min="0" step="any" name="prj_cost_lgu" id="prj_cost_lgu" type="number" value="">
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
                        <input class="form-control input-sm" placeholder="Land" min="0" step="any" name="prj_pis_total_assets_land" id="prj_pis_total_assets_land" type="number" value="">
                    </div>

                    <div class="form-group">
                        <label for="prj_pis_total_assets_building" class="control-label">Building</label>
                        <input class="form-control input-sm" placeholder="Building" min="0" step="any" name="prj_pis_total_assets_building" id="prj_pis_total_assets_building" type="number" value="">
                    </div>

                    <div class="form-group">
                        <label for="prj_pis_total_assets_equipment" class="control-label">Equipment</label>
                        <input class="form-control input-sm" placeholder="Equipment" min="0" step="any" name="prj_pis_total_assets_equipment" id="prj_pis_total_assets_equipment" type="number" value="">
                    </div>

                    <div class="form-group">
                        <label for="prj_pis_total_assets_working_capital" class="control-label">Working Capital</label>
                        <input class="form-control input-sm" placeholder="Working Capital" min="0" step="any" name="prj_pis_total_assets_working_capital" id="prj_pis_total_assets_working_capital" type="number" value="">
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
                                <input class="form-control input-sm" placeholder="Male" min="0" step="any" name="prj_pis_dir_ch_regular_male" id="prj_pis_dir_ch_regular_male" type="number" value="">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_regular_female" class="control-label">Female</label>
                                <input class="form-control input-sm" placeholder="Female" min="0" step="any" name="prj_pis_dir_ch_regular_female" id="prj_pis_dir_ch_regular_female" type="number" value="">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_regular_pwd" class="control-label">PWD</label>
                                <input class="form-control input-sm" placeholder="PWD" min="0" step="any" name="prj_pis_dir_ch_regular_pwd" id="prj_pis_dir_ch_regular_pwd" type="number" value="">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_regular_senior" class="control-label">Senior</label>
                                <input class="form-control input-sm" placeholder="Senior" min="0" step="any" name="prj_pis_dir_ch_regular_senior" id="prj_pis_dir_ch_regular_senior" type="number" value="">
                            </div>
                        </div>
                    </div>

                    <h5>Company Hire (Part-Time)</h5>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_part_time_male" class="control-label">Male</label>
                                <input class="form-control input-sm" placeholder="Male" min="0" step="any" name="prj_pis_dir_ch_part_time_male" id="prj_pis_dir_ch_part_time_male" type="number" value="">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_part_time_female" class="control-label">Female</label>
                                <input class="form-control input-sm" placeholder="Female" min="0" step="any" name="prj_pis_dir_ch_part_time_female" id="prj_pis_dir_ch_part_time_female" type="number" value="">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_part_time_pwd" class="control-label">PWD</label>
                                <input class="form-control input-sm" placeholder="PWD" min="0" step="any" name="prj_pis_dir_ch_part_time_pwd" id="prj_pis_dir_ch_part_time_pwd" type="number" value="">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_ch_part_time_senior" class="control-label">Senior</label>
                                <input class="form-control input-sm" placeholder="Senior" min="0" step="any" name="prj_pis_dir_ch_part_time_senior" id="prj_pis_dir_ch_part_time_senior" type="number" value="">
                            </div>
                        </div>
                    </div>

                    <h5>Sub-Contractor Hire (Regular)</h5>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_regular_male" class="control-label">Male</label>
                                <input class="form-control input-sm" placeholder="Male" min="0" step="any" name="prj_pis_dir_sh_regular_male" id="prj_pis_dir_sh_regular_male" type="number" value="">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_regular_female" class="control-label">Female</label>
                                <input class="form-control input-sm" placeholder="Female" min="0" step="any" name="prj_pis_dir_sh_regular_female" id="prj_pis_dir_sh_regular_female" type="number" value="">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_regular_pwd" class="control-label">PWD</label>
                                <input class="form-control input-sm" placeholder="PWD" min="0" step="any" name="prj_pis_dir_sh_regular_pwd" id="prj_pis_dir_sh_regular_pwd" type="number" value="">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_regular_senior" class="control-label">Senior</label>
                                <input class="form-control input-sm" placeholder="Senior" min="0" step="any" name="prj_pis_dir_sh_regular_senior" id="prj_pis_dir_sh_regular_senior" type="number" value="">
                            </div>
                        </div>
                    </div>

                    <h5>Sub-Contractor Hire (Part-Time)</h5>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_part_time_male" class="control-label">Male</label>
                                <input class="form-control input-sm" placeholder="Male" min="0" step="any" name="prj_pis_dir_sh_part_time_male" id="prj_pis_dir_sh_part_time_male" type="number" value="">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_part_time_female" class="control-label">Female</label>
                                <input class="form-control input-sm" placeholder="Female" min="0" step="any" name="prj_pis_dir_sh_part_time_female" id="prj_pis_dir_sh_part_time_female" type="number" value="">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_part_time_pwd" class="control-label">PWD</label>
                                <input class="form-control input-sm" placeholder="PWD" min="0" step="any" name="prj_pis_dir_sh_part_time_pwd" id="prj_pis_dir_sh_part_time_pwd" type="number" value="">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prj_pis_dir_sh_part_time_senior" class="control-label">Senior</label>
                                <input class="form-control input-sm" placeholder="Senior" min="0" step="any" name="prj_pis_dir_sh_part_time_senior" id="prj_pis_dir_sh_part_time_senior" type="number" value="">
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
                            <input class="form-control input-sm" placeholder="Male" min="0" step="any" name="prj_pis_indir_forward_male" id="prj_pis_indir_forward_male" type="number" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_forward_female" class="control-label">Female</label>
                            <input class="form-control input-sm" placeholder="Female" min="0" step="any" name="prj_pis_indir_forward_female" id="prj_pis_indir_forward_female" type="number" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_forward_pwd" class="control-label">PWD</label>
                            <input class="form-control input-sm" placeholder="PWD" min="0" step="any" name="prj_pis_indir_forward_pwd" id="prj_pis_indir_forward_pwd" type="number" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_forward_senior" class="control-label">Senior</label>
                            <input class="form-control input-sm" placeholder="Senior" min="0" step="any" name="prj_pis_indir_forward_senior" id="prj_pis_indir_forward_senior" type="number" value="">
                        </div>
                    </div>
                </div>

                <h5>Backward</h5>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_backward_male" class="control-label">Male</label>
                            <input class="form-control input-sm" placeholder="Male" min="0" step="any" name="prj_pis_indir_backward_male" id="prj_pis_indir_backward_male" type="number" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_backward_female" class="control-label">Female</label>
                            <input class="form-control input-sm" placeholder="Female" min="0" step="any" name="prj_pis_indir_backward_female" id="prj_pis_indir_backward_female" type="number" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_backward_pwd" class="control-label">PWD</label>
                            <input class="form-control input-sm" placeholder="PWD" min="0" step="any" name="prj_pis_indir_backward_pwd" id="prj_pis_indir_backward_pwd" type="number" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="prj_pis_indir_backward_senior" class="control-label">Senior</label>
                            <input class="form-control input-sm" placeholder="Senior" min="0" step="any" name="prj_pis_indir_backward_senior" id="prj_pis_indir_backward_senior" type="number" value="">
                        </div>
                    </div>
                </div>

                <div class="card-form">
                    <h4>Total Volume of Production</h4>
                    <div class="form-group">
                        <label for="prj_pis_volume_production_local" class="control-label">Local</label>
                        <input class="form-control input-sm" placeholder="Local" min="0" step="any" name="prj_pis_volume_production_local" id="prj_pis_volume_production_local" type="number" value="">
                    </div>

                    <div class="form-group">
                        <label for="prj_pis_volume_production_export" class="control-label">Export</label>
                        <input class="form-control input-sm" placeholder="Export" min="0" step="any" name="prj_pis_volume_production_export" id="prj_pis_volume_production_export" type="number" value="">
                    </div>
                </div>            

                <div class="card-form">
                    <h4>Total Gross Sales</h4>
                    <div class="form-group">
                        <label for="prj_pis_gross_sales_local" class="control-label">Local</label>
                        <input class="form-control input-sm" placeholder="Local" min="0" step="any" name="prj_pis_gross_sales_local" id="prj_pis_gross_sales_local" type="number" value="">
                    </div>

                    <div class="form-group">
                        <label for="prj_pis_gross_sales_export" class="control-label">Export</label>
                        <input class="form-control input-sm" placeholder="Export" min="0" step="any" name="prj_pis_gross_sales_export" id="prj_pis_gross_sales_export" type="number" value="">
                    </div>
                </div>            

                <div class="card-form">
                    <h4>Countries of Destination</h4>
                    <div class="form-group">
                        <textarea class="form-control input-sm" placeholder="Countries of Destination" name="prj_pis_countries_of_destination" id="prj_pis_countries_of_destination" cols="50" rows="4"></textarea>
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
                                <textarea class="form-control input-sm" placeholder="Conceptualization" name="prj_pis_assistance_conceptualization" id="prj_pis_assistance_conceptualization" cols="50" rows="3"></textarea>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                2. Proposal Preparation
                                <textarea class="form-control input-sm" placeholder="Proposal Preparation" name="prj_pis_assistance_proposal_preparation" id="prj_pis_assistance_proposal_preparation" cols="50" rows="3"></textarea>
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
                                                <textarea class="form-control input-sm" placeholder="Process" name="prj_pis_assistance_process" id="prj_pis_assistance_process" cols="50" rows="3"></textarea>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox">
                                                B. Equipment
                                                <textarea class="form-control input-sm" placeholder="Equipment" name="prj_pis_assistance_equipment" id="prj_pis_assistance_equipment" cols="50" rows="3"></textarea>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                C. Quality Control / Laboratory Testing / Analysis
                                                <textarea class="form-control input-sm" placeholder="Quality Control / Laboratory Testing / Analysis" name="prj_pis_assistance_quality_control" id="prj_pis_assistance_quality_control" cols="50" rows="3"></textarea>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="form-group">
                                        3.2 Packaging / Labeling
                                        <textarea class="form-control input-sm" placeholder="Packaging / Labeling" name="prj_pis_assistance_packaging_labeling" id="prj_pis_assistance_packaging_labeling" cols="50" rows="3"></textarea>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        3.3 Post-Harvest
                                        <textarea class="form-control input-sm" placeholder="Post-Harvest" name="prj_pis_assistance_post_harvest" id="prj_pis_assistance_post_harvest" cols="50" rows="3"></textarea>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        3.4 Marketing Assistance
                                        <textarea class="form-control input-sm" placeholder="Marketing Assistance" name="prj_pis_assistance_marketing" id="prj_pis_assistance_marketing" cols="50" rows="3"></textarea>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        3.5 Human Resource Training
                                        <textarea class="form-control input-sm" placeholder="Human Resource Training" name="prj_pis_assistance_training" id="prj_pis_assistance_training" cols="50" rows="3"></textarea>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        3.6 Consultancy Service
                                        <textarea class="form-control input-sm" placeholder="Consultancy Service" name="prj_pis_assistance_consultancy" id="prj_pis_assistance_consultancy" cols="50" rows="3"></textarea>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        3.7 Others (FPD Permit, LGU Registration, Bar Coding)
                                        <textarea class="form-control input-sm" placeholder="Others" name="prj_pis_assistance_others" id="prj_pis_assistance_others" cols="50" rows="3"></textarea>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="card-form">
                    <div class="form-group">
                        <label for="prj_remarks" class="control-label">Remarks</label>
                        <textarea class="form-control input-sm" placeholder="Remarks" name="prj_remarks" id="prj_remarks" cols="50" rows="4"></textarea>
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
                    <input class="form-control input-sm" placeholder="Longitude" min="0" step="any" name="prj_longitude" id="longitude" type="number" value="">
                </div>

                <div class="form-group">
                    <label for="prj_latitude" class="control-label">Latitude</label>
                    <input class="form-control input-sm" placeholder="Latitude" min="0" step="any" name="prj_latitude" id="latitude" type="number" value="">
                </div>

                <div class="form-group">
                    <label for="prj_elevation" class="control-label">Elevation</label>
                    <input class="form-control input-sm" placeholder="Elevation" min="0" step="any" name="prj_elevation" id="elevation" type="number" value="">
                </div>

                <div class="card-form">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="1" name="form_return"> Check to clear form after saving.
                        </label>
                    </div>
                </div>
                
           </div>    
    </div>
</div>
</form>





@endsection()