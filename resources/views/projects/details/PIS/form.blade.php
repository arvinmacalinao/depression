@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header">
        <h3>Project PIS Add
            <div class="pull-right">
                <a href="" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('PIS Save', ['id' => $id, 'pis_id' => $pis_id]) }}" method="POST">
            @csrf
            <div class="card mb-3">
                <div class="card-header">
                    
                    <div class="row mb-2 mt-2">
                        <div class="form-group col-sm-6">
                            <label for="prjpis_year" class="control-label">Year *</label>
                            <input class="form-control input-sm" placeholder="2022" maxlength="4" min="1800" max="2022" name="prjpis_year" id="prjpis_year" type="number" value="{{ old('prjpis_year', $pis->prjpis_year) }}">
                        </div>
                        <div class="form-group form-group-sm col-sm-6">
                            <label for="sem_id" class="control-label">Semester</label>
                            <select class="form-control input-sm" id="sem_id" name="sem_id">
                                @foreach ($sel_pis_semesters as $sem)
                                <option value="{{ $sem->sem_id }}" {{ old('sem_id', $project->prj_type_id) == $type->prj_type_id ? 'selected' : '' }}>{{ $sem->semester->sem_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Total Assests</h5>
                    <div class="row mb-2 mt-2">
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_land" class="control-label">Land</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_total_assets_land" id="prjpis_total_assets_land" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_building" class="control-label">Building</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_total_assets_building" id="prjpis_total_assets_building" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_equipment" class="control-label">Equipment</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_total_assets_equipment" id="prjpis_total_assets_equipment" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_working_capital" class="control-label">Working Capital</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_total_assets_working_capital" id="prjpis_total_assets_working_capital" type="number" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Total Employment Generated (Direct Employment)</h5>
                    <h5>Company Hire (Regular)</h5>
                    <div class="row mb-2 mt-2">
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_land" class="control-label">Male</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_ch_regular_male" id="prjpis_dir_ch_regular_male" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_building" class="control-label">Female</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_ch_regular_female" id="prjpis_dir_ch_regular_female" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_equipment" class="control-label">PWD</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_ch_regular_pwd" id="prjpis_dir_ch_regular_pwd" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_working_capital" class="control-label">Senior</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_ch_regular_senior" id="prjpis_dir_ch_regular_senior" type="number" value="0">
                        </div>
                    </div>
                    <h5>Company Hire (Part-Time)</h5>
                    <div class="row mb-2 mt-2">
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_land" class="control-label">Male</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_ch_part_time_male" id="prjpis_dir_ch_part_time_male" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_building" class="control-label">Female</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_ch_part_time_female" id="prjpis_dir_ch_part_time_female" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_equipment" class="control-label">PWD</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_ch_part_time_pwd" id="prjpis_dir_ch_part_time_pwd" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_working_capital" class="control-label">Senior</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_ch_part_time_senior" id="prjpis_dir_ch_part_time_senior" type="number" value="0">
                        </div>
                    </div>
                    <h5>Sub-Contractor Hire (Regular)</h5>
                    <div class="row mb-2 mt-2">
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_land" class="control-label">Male</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_sh_regular_male" id="prjpis_dir_sh_regular_male" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_building" class="control-label">Female</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_sh_regular_female" id="prjpis_dir_sh_regular_female" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_equipment" class="control-label">PWD</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_sh_regular_pwd" id="prjpis_dir_sh_regular_pwd" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_working_capital" class="control-label">Senior</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_sh_regular_senior" id="prjpis_dir_sh_regular_senior" type="number" value="0">
                        </div>
                    </div>
                    <h5>Sub-Contractor Hire (Part-Time)</h5>
                    <div class="row mb-2 mt-2">
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_land" class="control-label">Male</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_sh_part_time_male" id="prjpis_dir_sh_part_time_male" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_building" class="control-label">Female</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_sh_part_time_female" id="prjpis_dir_sh_part_time_female" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_equipment" class="control-label">PWD</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_sh_part_time_pwd" id="prjpis_dir_sh_part_time_pwd" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_working_capital" class="control-label">Senior</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_dir_sh_part_time_senior" id="prjpis_dir_sh_part_time_senior" type="number" value="0">
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Total Employment Generated (Indirect Employment)</h5>
                    <h5>Forward</h5>
                    <div class="row mb-2 mt-2">
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_land" class="control-label">Male</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_indir_forward_male" id="prjpis_indir_forward_male" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_building" class="control-label">Female</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_indir_forward_female" id="prjpis_indir_forward_female" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_equipment" class="control-label">PWD</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_indir_forward_pwd" id="prjpis_indir_forward_pwd" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_working_capital" class="control-label">Senior</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_indir_forward_senior" id="prjpis_indir_forward_senior" type="number" value="0">
                        </div>
                    </div>
                    <h5>Backward</h5>
                    <div class="row mb-2 mt-2">
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_land" class="control-label">Male</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_indir_backward_male" id="prjpis_indir_backward_male" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_building" class="control-label">Female</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_indir_backward_female" id="prjpis_indir_backward_female" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_equipment" class="control-label">PWD</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_indir_backward_pwd" id="prjpis_indir_backward_pwd" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="prjpis_total_assets_working_capital" class="control-label">Senior</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_indir_backward_senior" id="prjpis_indir_backward_senior" type="number" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                <h5>Total Volume of Production</h5>
                    <div class="row mb-2 mt-2">
                        <div class="form-group col-sm-6">
                            <label for="prjpis_year" class="control-label">Local</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_volume_production_local" id="prjpis_volume_production_local" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="prjpis_year" class="control-label">Export</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_volume_production_export" id="prjpis_volume_production_export" type="number" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                <h5>Total Gross Sales</h5>
                    <div class="row mb-2 mt-2">
                        <div class="form-group col-sm-6">
                            <label for="prjpis_year" class="control-label">Local</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_gross_sales_local" id="prjpis_gross_sales_local" type="number" value="0">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="prjpis_year" class="control-label">Export</label>
                            <input class="form-control input-sm" placeholder="0" min="0" step="any" name="prjpis_gross_sales_export" id="prjpis_gross_sales_export" type="number" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                <h5>Countries of Destination</h5>
                    <div class="row mb-2 mt-2">
                        <div class="form-group col-sm-12">
                            <textarea class="form-control input-sm" placeholder="Countries of Destination" name="prjpis_countries_of_destination" id="prjpis_countries_of_destination" cols="50" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                <h5>Assistance Obtained From DOST</h5>
                    <ul class="ul-assistance-40">
                        <li>
                            A. 1 Production Technology
                        </li>
                        <li>
                            <ul class="ul-assistance-12">
                                <li>
                                    <div class="form-group">
                                        <input type="checkbox" name="prjpis_assistance_process" id="prjpis_assistance_process" value="1" > 
                                        A. 1.1 Process
                                        <textarea class="form-control input-sm" placeholder="Process" name="prjpis_assistance_process_text" id="prjpis_assistance_process_text" cols="50" rows="3"></textarea>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <input type="checkbox" name="prjpis_assistance_equipment" id="prjpis_assistance_equipment" value="1" >
                                        A. 1.2 Equipment
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <input type="checkbox" name="prjpis_assistance_quality_control" id="prjpis_assistance_quality_control" value="1" > 
                                        A. 1.2 Quality Control / Laboratory Testing / Analysis
                                        <textarea class="form-control input-sm" placeholder="Quality Control / Laboratory Testing / Analysis" name="prjpis_assistance_quality_control_text" id="prjpis_assistance_consultancy_text" cols="50" rows="3"></textarea>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="checkbox" name="prjpis_assistance_packaging_labeling" id="prjpis_assistance_packaging_labeling" value="1" > 
                                A. 2 Packaging / Labeling
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="checkbox" name="prjpis_assistance_post_harvest" id="prjpis_assistance_post_harvest" value="1" > 
                                A. 3 Post-Harvest
                                <textarea class="form-control input-sm" placeholder="Post-Harvest" name="prjpis_assistance_post_harvest_text" id="prjpis_assistance_post_harvest_text" cols="50" rows="3"></textarea>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="checkbox" name="prjpis_assistance_marketing" id="prjpis_assistance_marketing" value="1" > 
                                A. 4 Marketing Assistance
                                <textarea class="form-control input-sm" placeholder="Marketing Assistance" name="prjpis_assistance_marketing_text" id="prjpis_assistance_marketing_text" cols="50" rows="3"></textarea>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="checkbox" name="prjpis_assistance_training" id="prjpis_assistance_training" value="1" > 
                                A. 5 Human Resource Training
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="checkbox" name="prjpis_assistance_consultancy" id="prjpis_assistance_consultancy" value="1" > 
                                A. 6 Consultancy Service
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="checkbox" name="prjpis_assistance_others" id="prjpis_assistance_others" value="1" > 
                                A. 7 Others (FPD Permit, LGU Registration, Bar Coding)
                                <textarea class="form-control input-sm" placeholder="Others" name="prjpis_assistance_others_text" id="prjpis_assistance_others_text" cols="50" rows="3"></textarea>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                <h5>Remarks</h5>
                    <div class="row mb-2 mt-2">
                        <div class="form-group col-sm-12">
                            <textarea class="form-control input-sm" placeholder="Remarks" name="prjpis_remarks" id="prjpis_remarks" cols="50" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">
        </form>
    </div>
</div>
@endsection